<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Requestheader;
use App\Requestlines;
use App\Company;
use App\Projects;
use App\User;
use App\Transaksi;
use DB;
use Carbon\Carbon;
use App\Project_relation;


class RequestheaderController extends Controller
{
     public function index()
    {
        
        $company  = company::all();
        $datauser = User::all();
        $idcuser  = auth()->user()->id_company;
        $idu      = auth()->user()->id;
        if (auth()->user()->role == 3) {
            $rh = DB::table('request_header')
                        ->Join('company', 'request_header.id_company', '=', 'company.idc')
                        ->join('users', 'users.id', '=', 'request_header.user_id')
                        ->join('projects', 'projects.id', '=', 'request_header.id_project')
                        ->select('request_header.code', 'request_header.description','request_header.id_company','request_header.id','request_header.status','request_header.message_client','request_header.message_admin','company.nama','users.username','request_header.user_id','request_header.ticket','request_header.priority','request_header.dead_line','projects.nama_projects')
                        ->where('request_header.user_id',$idu)
                        ->orderBy('id_company','desc')
                        ->get();
        }
        if (auth()->user()->role == 4) {
            $rh = DB::table('request_header')
                        ->Join('company', 'request_header.id_company', '=', 'company.idc')
                        ->leftjoin('users', 'users.id', '=', 'request_header.user_id')
                        ->join('projects', 'projects.id', '=', 'request_header.id_project')
                        ->select('request_header.code', 'request_header.description','request_header.id_company','request_header.id','request_header.status','request_header.message_client','request_header.message_admin','company.nama','users.username','request_header.user_id','request_header.ticket','request_header.priority','request_header.dead_line','projects.nama_projects')
                        ->where('request_header.id_company',$idcuser)
                        ->orderBy('id_company','asc')
                        ->get();
        }if (auth()->user()->role == 1) {
            $rh = DB::table('request_header')
                        ->Join('company', 'request_header.id_company', '=', 'company.idc')
                        ->leftjoin('users', 'users.id', '=', 'request_header.user_id')
                        ->join('projects', 'projects.id', '=', 'request_header.id_project')
                        ->select('request_header.code', 'request_header.description','request_header.id_company','request_header.id','request_header.status','request_header.message_client','request_header.message_admin','company.nama','users.username','request_header.user_id','request_header.ticket','request_header.priority','request_header.dead_line','request_header.id_developer','projects.nama_projects')
                        ->where('request_header.id_developer',$idu)
                        ->orderBy('id_developer','asc')
                        ->get();
        }if(auth()->user()->role == 2){
            $rh = DB::table('request_header')
                        ->Join('company', 'request_header.id_company', '=', 'company.idc')
                        ->leftjoin('users', 'users.id', '=', 'request_header.user_id')
                        ->join('projects', 'projects.id', '=', 'request_header.id_project')
                        ->select('request_header.code', 'request_header.description','request_header.id_company','request_header.id','request_header.status','request_header.message_client','request_header.message_admin','company.nama','users.username','request_header.user_id','request_header.ticket','request_header.priority','request_header.dead_line','projects.nama_projects')
                        
                        ->orderBy('id_company','asc')
                        ->get();
        }
    	
        
    	return view('requestheader.index',compact('rh','company','datauser'));
    }
    public function edit($id)
    {
        $rh   = Requestheader::find($id);
        $user = User::all();
        return view('requestheader.edit',compact('rh','user'));
    }
    
     public function creates()
    {
        $idc     = auth()->user()->id_company;
        if (auth()->user()->role == 4) {
            $projects = DB::table('projects')
                        ->where('id_company', $idc)
                        ->orderBy('id_company','desc')
                        ->get();
            $cs = DB::table('project_relation')
                        ->join('users','project_relation.id_user','=','users.id')
                        ->where('role',3)
                        ->where('id_project',2)
                        ->get();
        }else{
            $projects = DB::table('projects')
                        ->orderBy('created_at','asc')
                        ->get();
            $cs = DB::table('project_relation')
                        ->join('users','project_relation.id_user','=','users.id')
                        ->where('role',3)
                        ->where('id_project',2)
                        ->get();
        }
        $company  = company::all();
        $datauser = User::all();
        $rh = DB::table('request_header')
                        ->get();
        $cek = DB::table('request_header')->count();

        if ($cek == 0) {
            $urut  =  100001;
            $nomer = $urut;
            
        }else{
            // echo "dawdaw";
            $ambil = Requestheader::all()->last();
            $urut  =  100001 + $ambil->id;
            $nomer = $urut;
        }
        return view('requestheader.create',compact('rh','nomer','urut','company','datauser','projects','cs'));
    }
    public function create(Request $request)
    {
        $idu = $request->user_id;
        $user = User::find($idu);

        $rh                   = new Requestheader;
        $rh->code             = $request->code;
        $rh->id_project       = $request->id_project;
        $rh->id_company       = $request->id_company;
        $rh->user_id          = $request->user_id ;
        $rh->description      = $request->description;
        $rh->status           = $request->status;
        $rh->message_client   = $request->message_client;
        $rh->message_admin    = $request->message_admin;
        $rh->email_consultant = $user->email;
        $rh->email_client     = $request->email_client;
        $rh->priority         = $request->priority;
        $rh->ticket           = $request->ticket;
        $rh->dead_line        = $request->dead_line;
        $rh->save();
        
        \Mail::raw($request->company.' Membuat Request Header Dengan Description '.$request->description, function($message) use($request,$rh){
            $message->to('briliannusantara123@gmail.com');
            $message->subject('Client Membuat Requestheader');
            $message->from($rh->email_client,'Client '.$request->company);
         });
        return redirect('/requestheader')->with('success','data berhasil disimpan');
    }
    public function requestlines($id)
    {
        $idc     = auth()->user()->id_company;
        $idu     = auth()->user()->id;
        $company = Company::all();

        $ldate   = Carbon::now();
        $hari    = $ldate->day;
        

        if (auth()->user()->role == 4) {
            $projects = DB::table('projects')
                        ->where('id_company', $idc)
                        ->orderBy('id_company','desc')
                        ->get();
        }else{
            $projects = DB::table('projects')
                        ->orderBy('created_at','asc')
                        ->get();
        }
        
        
        $users = User::all();

        $rh = Requestheader::with('company')->find($id);

        if (auth()->user()->role == 1) {
            $rl = DB::table('request_lines')
                ->join('request_header','request_lines.id_header', '=' , 'request_header.id')
                ->Join('company', 'request_lines.id_company', '=', 'company.idc')
                ->Join('projects', 'request_lines.id_project', '=', 'projects.id')
                ->leftJoin('users', 'users.id', '=', 'request_lines.id_developer')
                ->select('request_lines.code','request_lines.idl','request_lines.description','request_lines.status','request_lines.date_solve','request_lines.date_close','company.nama','users.username','projects.nama_projects','request_lines.id_header','request_header.id','request_lines.id_company','company.idc','request_lines.gambar','company.ticket_used','request_lines.id_developer','request_lines.date_cancel','request_lines.solve_by')
                ->where('id_header', $id)
                ->where('request_lines.id_developer', $idu)
                ->orderBy('id_developer','desc')
                ->get();

                
        }else{
        $rl = DB::table('request_lines')
                ->join('request_header','request_lines.id_header', '=' , 'request_header.id')
                ->Join('company', 'request_lines.id_company', '=', 'company.idc')
                ->Join('projects', 'request_lines.id_project', '=', 'projects.id')
                ->leftJoin('users', 'users.id', '=', 'request_lines.id_developer')
                ->select('request_lines.code','request_lines.idl','request_lines.description','request_lines.status','request_lines.date_solve','request_lines.date_close','company.nama','users.username','projects.nama_projects','request_lines.id_header','request_header.id','request_lines.id_company','company.idc','request_lines.gambar','company.ticket_used','request_lines.date_cancel','request_lines.id_developer','request_lines.solve_by')
                ->where('id_header', $id)
                ->orderBy('id_header','desc')
                ->get();

                

        }
        //subDays
        

        $cek = DB::table('request_lines')->count();

        if ($cek == 0) {
            $urut =  100001;
            $nomer = $urut;
            
        }else{
            // echo "dawdaw";
            $ambil = Requestlines::all()->last();
            $urut =  100001 + $ambil->idl;
            $nomer = $urut;
        }

       
        return view('requestheader.requestlines',compact('rh','rl','nomer','urut','company','users','projects','hari'));
    }
    public function requestlines_post(Request $request)
    {
        $rh = Requestheader::with('company')->find($request->id_header);
        $idc = auth()->user()->id_company;

        $gambar = $request->file('gambar');
        $new_gambar = time().$gambar->getClientOriginalName();

        $tprojectline = Requestlines::create([
            'code'             => $request->code,
            'id_header'        =>  $request->id_header,
            'id_company'       =>  $request->id_company,
            'id_project'       =>  $request->id_project,
            'description'      =>  $request->description,
            'priority'         =>  $request->priority,
            'ticket'           =>  $request->ticket,
            'status'           =>  $request->status,
            'id_developer'     =>  $request->id_developer,
            'dead_line'        =>  $request->dead_line,
            'date_solve'       =>  $request->date_solve,
            'date_close'       => $request->date_close,
            'email_client'     => $request->email_client,
            'email_consultant' => $request->email_consultant,
            'user_id'          => $request->user_id,
            'gambar'           => 'storage/'.$new_gambar,
        ]);
           \Mail::raw('Client Membuat Masalah Baru Di Requestlines dengan description '.$request->description, function($message) use($rh){
            $message->to('briliannusantara123@gmail.com');
            $message->subject('Client Membuat Masalah Di Requestlines');
            $message->from('briliannusantara123@gmail.com','Client '.$rh->company->nama);
         });
        
         $cek = DB::table('request_lines')->where('id_company',$idc)->count();
         if ($cek == 1) {
             Requestheader::where('id', $request->id_header)->update([
            'status' => '1',

            ]);
         }else{
            Requestheader::where('id', $request->id_header)->update([
            'status' => '2',

            ]);
         }
        

        $gambar->move('storage/', $new_gambar);
        return redirect()->back()->with('success','Masalah Berhasil Di Tambahkan');
    }
     
   public function update(Request $request,$id)
    {
        $rh = Requestheader::find($id);
        $rh->update($request->all());
        return redirect('/requestheader')->with('success','Berhasil Mengubah Requestheader');
    }
    public function delete($id)
    {
        $rh = Requestheader::find($id);
        if (auth()->user()->role == 4) {
            $rh->update([
            'status' => '4'
        ]);
        }elseif (auth()->user()->role == 2) {
             $rh->update([
            'status' => '5'
        ]);
        }
        
        return redirect('/requestheader')->with('success','Requestheader Berhasil Di Cancel');
    }
    public function close($id)
    {
        $rh = Requestheader::find($id);
        $rh->update([
            'status' => '6'
        ]);
        return redirect('/requestheader')->with('success','Requestheader Berhasil Di Cancel');
    }
    public function projectrelation($projectrelation_id)
    {
        $data = \DB::table('project_relation')->JOIN('users','project_relation.id_user','=','users.id')->where('id_project',$projectrelation_id)->get();
        return response()->json($data);
    }
    
}
