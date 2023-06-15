<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Company;
use App\Requestheader;
use App\Requestlines;
use App\Projects;
use App\Project_relation;
use DB;
use Carbon\Carbon;

class RequestlinesController extends Controller
{

     
    public function create(Request $request)
    {
        $rh =Requestlines::create($request->all());
        return redirect('/requestheader')->with('success','data berhasil disimpan');
    }
    public function edit($idl)
    {
        $rl = Requestlines::with('user')->find($idl);
        $idp = $rl->id_project;
        $developer = DB::table('project_relation')
                        ->join('projects','projects.id','=','project_relation.id_project')
                        ->join('users','users.id','=','project_relation.id_user')
                        ->where('project_relation.id_project',$idp)
                        ->get();
                        
        $user = User::all();
        $idc = auth()->user()->id_company;
        $idd = $rl->id_developer;
        $ih = $rl->id_header;
        $rh = Requestheader::find($rl->id_header);
        $projects = DB::table('projects')
                        ->where('id_company', $idc)
                        ->orderBy('id_company','desc')
                        ->get();
        $pp1 = Requestlines::where('id_header',$ih)
                            ->where('status', 5)
                            ->orderBy('status','asc')
                            ->get()
                            ->count();
        $pp2 = Requestlines::where('id_header',$ih)
                            ->where('status', 10)
                            ->orderBy('status','asc')
                            ->get()
                            ->count();
        $pp3 = Requestlines::where('id_header',$ih)
                            ->where('status', 6)
                            ->orderBy('status','asc')
                            ->get()
                            ->count();
        $pp4 = Requestlines::where('id_header',$ih)
                            ->where('status', 11)
                            ->orderBy('status','asc')
                            ->get()
                            ->count();
        $ppt= $pp1 + $pp2 + $pp3 + $pp4;
        
        return view('requestheader.requestlinesedit',compact('rl','user','projects','developer','ppt','rh'));
    }
    public function update(Request $request,$idl)
    {
        $idc = auth()->user()->id_company;
        $rl = Requestlines::with('company')->join('request_header', 'request_header.id', '=', 'request_lines.id_header')->select('request_lines.idl','request_lines.code','request_lines.id_header','request_lines.id_company','request_lines.id_project','request_lines.description','request_lines.status','request_lines.id_developer','request_lines.date_solve','request_lines.date_close','request_lines.gambar','request_lines.email_client','request_lines.email_consultant','request_lines.message_testing','request_header.ticket_paid',)->find($idl);
        $company = Company::find($request->id_company);
        $rh = Requestheader::find($rl->id_header);
        $ldate = Carbon::now();
        
        if(auth()->user()->role == 1){
            if ($rl->status == 10) {
               $rl->update([
                'status' => "10",
            ]);
            if ($rl->email_client == !NULL) {
           \Mail::raw($rl->code.$rl->description.'Sedang Di Analysis Consultant', function($message) use($rl){
            $message->to($rl->email_client,$rl->email_client);
            $message->subject('Proses Requestlines');
            $message->from($rl->email_consultant,'PT Mikro Sinergi Informatika');
         });
        }
            }elseif ($rl->status == 5) {
               $rl->update([
                'id_developer' => $rl->id_developer,
                'status' => 11,
            ]);
            }elseif ($rl->status == 11) {
               $rl->update([
                'status' => 10,
            ]);
            }
        }
        
        if (auth()->user()->role == 2) {
           if ($rl->status == 7) {

                $rls = Requestlines::all();
                $rl->update([
                'ticket' => $request->ticket,
                'id_developer' => $request->id_developer,
                'status' => "9",
                'date_close' => $ldate, 
                ]);
                
                    Requestheader::where('id', $request->id_header)->update([
                    'status' => '3',

            ]);
                
            }elseif ($rl->status == 8) {
                $rl->update([
                'ticket' => $request->ticket,
                'id_developer' => $request->id_developer,
                'status' => "9",
            ]);
            
        }
        }

        if (auth()->user()->role == 2) {
            if ($rl->status == 1) {
                $rl->update([
                'ticket' => $request->ticket,
                'id_developer' => $request->id_developer,
                'status' => "2",
            ]);
            if ($rl->email_client == !NULL) {
           \Mail::raw($rl->code.$rl->description.'Sedang Di Analysis Consultant', function($message) use($rl){
            $message->to($rl->email_client,$rl->email_client);
            $message->subject('Proses Requestlines');
            $message->from($rl->email_consultant,'PT Mikro Sinergi Informatika');
         });
        }
            }elseif ($rl->status == 2) {
                $rl->update([
                'ticket' => $request->ticket,
                'id_developer' => $request->id_developer,
                'status' => "5",
            ]);
                if ($rl->email_client == !NULL) {
           \Mail::raw($rl->code.'-'.$rl->description.'-'.'Consultant Mengirimkan Negosiasi Penggunaan Ticket Sebanyak' .$request->ticket, function($message) use($rl){
            $message->to($rl->email_client,$rl->email_client);
            $message->subject('Proses Negosiasi Ticket Di Requestlines');
            $message->from($rl->email_consultant,'PT Mikro Sinergi Informatika');
         });
        }
            }elseif ($rl->status == 10) {
                $rl->update([
                'ticket' => $request->ticket,
                'message_testing' => $request->message_testing,
                'status' => "6",
            ]);
            if ($rl->email_client == !NULL) {
           \Mail::raw($rl->code.'-'.$rl->description.'-'.'Pengerjaan Telah Selesai,Anda Bisa Mencoba Aplikasi Anda', function($message) use($rl){
            $message->to($rl->email_client,$rl->email_client);
            $message->subject('Testing Aplikasi Setelah Pengerjaan Projectlines');
            $message->from($rl->email_consultant,'PT Mikro Sinergi Informatika');
         });
        }
            }
            
        }elseif (auth()->user()->role == 3) {
            if ($rl->status == 7) {
                $rls = Requestlines::all();
                $rl->update([
                'ticket' => $request->ticket,
                'id_developer' => $request->id_developer,
                'status' => "9",
                'date_close' => $ldate, 
                ]);
                
                    Requestheader::where('id', $request->id_header)->update([
                    'status' => '3',

            ]);
                
            }
            
            if ($rl->status == 5) {
                $rls = Requestlines::all();
                $rl->update([
                'id_developer' => $request->id_developer,
                'status' => "5", 
                ]);
                
                    Requestheader::where('id', $request->id_header)->update([
                    'id_developer' => $request->id_developer,

            ]);
                
            }
            if ($rl->status == 6) {
                $rl->update([ 
                'status' => 7,
                'solve_by' => "MSI",
                'date_solve' => $ldate,
            ]);
                if ($rl->email_consultant == !NULL) {
           \Mail::raw($rl->code.'-'.$rl->description.'-'.'Status Telah di Ubah Menjadi Solve Oleh Consultant', function($message) use($rl){
            $message->to($rl->email_client,$rl->email_client);
            $message->subject('Solve Project');
            $message->from("briliannusantara123@gmail.com",'PT Mikro Sinergi Informatika');
         });
        }
        }

            if ($rl->status == 1) {
                $rl->update([
                'ticket' => $request->ticket,
                'id_developer' => $request->id_developer,
                'id_project' => $request->id_project,
                'priority' => $request->priority,
                'dead_line' => $request->dead_line,
                'status' => "2",
            ]);
            }elseif ($rl->status == 2) {
                $project = Projects::find($rl->id_project);
            $jumlah = $project->ticket_used;
            $jumlah_akhir = $jumlah + 1;
            $rl->update([
                'id_developer' => $request->id_developer,
                'status' => 5,
            ]);
            if ($rl->email_client == !NULL) {
           \Mail::raw($rl->code.'-'.$rl->description.'-'. 'Sedang Dalam Proses Pengerjaan', function($message) use($rl){
            $message->to($rl->email_client,$rl->email_client);
            $message->subject('Proses Pengerjaan Di Requestlines');
            $message->from($rl->email_consultant,'PT Mikro Sinergi Informatika');
         });
        }
        Requestheader::where('id', $request->id_header)->update([
            'status' => '2',
            'id_developer' => $request->id_developer,
            
            ]);
        $ih = $rl->id_header;
        $cek = DB::table('request_lines')->where('id_header',$ih)->count();
        if ($cek == 1) {
        if ($request->ticket_paid == 1) {
            // code...
        }elseif($request->ticket_paid == NULL){
            Projects::where('id', $rl->id_project)->update([
            'ticket_used' => $jumlah_akhir,
            

            ]);
            Requestheader::where('id', $request->id_header)->update([
            'status' => '2',
            'id_developer' => $request->id_developer,
            'ticket_paid' => 1,
            ]);

       
        }
        }else{
        if ($rl->ticket_paid == Null) {
               Requestheader::where('id', $request->id_header)->update([
            'status' => '2',
            'id_developer' => $request->id_developer,
            'ticket_paid' => 1,
            ]);
               Projects::where('id', $rl->id_project)->update([
            'ticket_used' => $jumlah_akhir,
            

            ]);
            }
            } 
               
        }elseif ($rl->status == 10) {
                $rl->update([
                'ticket' => $request->ticket,
                'message_testing' => $request->message_testing,
                'status' => "6",
            ]);
            if ($rl->email_client == !NULL) {
           \Mail::raw($rl->code.'-'.$rl->description.'-'.'Pengejaan Telah Selesai,Anda Bisa Mencoba Aplikasi Anda', function($message) use($rl){
            $message->to($rl->email_client,$rl->email_client);
            $message->subject('Testing Aplikasi Setelah Pengerjaan Projectlines');
            $message->from($rl->email_consultant,'PT Mikro Sinergi Informatika');
         });
        }
            }elseif ($rl->status == 12) {
                $rl->update([
                'ticket' => $request->ticket,
                'message_testing' => $request->message_testing,
                'status' => "6",
            ]);
            if ($rl->email_client == !NULL) {
           \Mail::raw($rl->code.'-'.$rl->description.'-'.'Pengejaan Telah Selesai,Anda Bisa Mencoba Aplikasi Anda', function($message) use($rl){
            $message->to($rl->email_client,$rl->email_client);
            $message->subject('Testing Aplikasi Setelah Pengerjaan Projectlines');
            $message->from($rl->email_consultant,'PT Mikro Sinergi Informatika');
         });
        }
            }

            }elseif (auth()->user()->role == 4) {
            if ($rl->status == 1) {
                $rl->update([
                'description' => $request->description,
                'id_project' => $request->id_project,
                'priority' => $request->priority,
                'dead_line' => $request->dead_line,
                'status' => "1",
            ]);
            } elseif ($rl->status == 2) {
                $rl->update([
                'description' => $request->description,
                'status' => "2",
            ]);
            }elseif ($rl->status == 2) {
                $rl->update([
                'description' => $request->description,
                'status' => "2",
            ]);
            }elseif ($rl->status == 6) {
                $rl->update([
                'ticket' => $request->ticket,
                'id_developer' => $request->id_developer, 
                'status' => $request->status,
            ]);
                if ($request->status == 7) {
                    $rl->update([
                        'date_solve' => $ldate,
                        'solve_by' => $rl->company->nama,
                    ]);
               if ($rl->email_consultant == !NULL) {
           \Mail::raw($rl->code.'-'.$rl->description.'-'.'Client Sudah Mengubah Status Menjadi Solve Dan Aplikasi Tidak Ada Kendala', function($message) use($rl){
            $message->to($rl->email_consultant,$rl->email_consultant);
            $message->subject('Solve Project');
            $message->from($rl->email_client,'Client '.$rl->company->nama);
         });
        }
            }else{
                if ($rl->email_consultant == !NULL) {
           \Mail::raw($rl->code.'-'.$rl->description.'-'. 'Client Mengubah Status Menjadi Re-Progress karna Adanya Kendala Di Aplikasi', function($message) use($rl){
            $message->to($rl->email_consultant,$rl->email_consultant);
            $message->subject('Re-Progress Project');
            $message->from($rl->email_client,'Client '.$rl->company->nama);
         });
        }
            }
            }elseif ($rl->status == 7) {
                $rls = Requestlines::all();
                $rl->update([
                'ticket' => $request->ticket,
                'id_developer' => $request->id_developer,
                'status' => "9",
                'date_close' => $ldate, 
                ]);
                
                    Requestheader::where('id', $request->id_header)->update([
                    'status' => '3',

            ]);
                
            }
        }
        if (auth()->user()->role == 4) {
            if ($rl->status == 1) {
                return redirect()->back()->with('success','Data Berhasil Di Ubah');
            }
        }

        if ($rl->status == 1) {
                return redirect('requestheader')->with('success','Requestlines Berhasil Di Analysis');
            }
        return redirect('requestheader')->with('success','Status Di Requestlines Berhasil Di Ubah');
    }
    public function delete($idl)
    {
        $rl = Requestlines::find($idl);
        $ldate = Carbon::now();
        $rl->update([
            'status' => '8',
            'date_cancel' => $ldate, 
        ]);
        return redirect()->back()->with('success','Requestlines Berhasil Di Cancel');
    }
     public function analysis($idl)
    {
        $rl = Requestlines::find($idl);
        $rl->update([
            'status' => '2'
        ]);
        if ($rl->email_client == !NULL) {
           \Mail::raw($rl->code.'-'.$rl->description.'-'.'Sedang Di Analysis Consultant', function($message) use($rl){
            $message->to($rl->email_client,$rl->email_client);
            $message->subject('Proses Requestlines');
            $message->from($rl->email_consultant,'PT Mikro Sinergi Informatika');
         });
        }
        
        return redirect()->back()->with('success','Requestlines Berhasil Di Analysis');
    }
    public function done($idl)
    {
        $rl = Requestlines::find($idl);
        $rl->update([
            'status' => '12'
        ]);
        if ($rl->email_client == !NULL) {
           \Mail::raw($rl->code.'-'.$rl->description.'-'.'Selesai di Kerjakan Oleh Consultant', function($message) use($rl){
            $message->to($rl->email_client,$rl->email_client);
            $message->subject('Proses Requestlines');
            $message->from($rl->email_consultant,'PT Mikro Sinergi Informatika');
         });
        }
        
        return redirect()->back()->with('success','Requestlines Berhasil Di Analysis');
    }
   public function mtesting($idl)
    {
        $rl = Requestlines::find($idl);
        return view('requestheader.mtesting',compact('rl'));
    }
}
