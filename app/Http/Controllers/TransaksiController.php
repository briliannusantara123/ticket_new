<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksi;
use App\Company;
use App\Typesupport;
use App\Paket;
use App\Projects;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailNotify;
use DB;
use Carbon\Carbon;


class TransaksiController extends Controller
{
    public function index()
    {
        $cid = auth()->user()->id_company;
        $company = Company::all();
        $support = Typesupport::all();
        $paket = Paket::all();
        $project = Projects::all();
        if(auth()->user()->role == 4){
        $transaksi = DB::table('transaksi')
                        ->leftJoin('company', 'company.idc', '=', 'transaksi.id_company')
                        ->leftJoin('paket', 'paket.id', '=', 'transaksi.id_paket')
                        ->leftJoin('type_support', 'type_support.id', '=', 'transaksi.id_support')
                        ->leftJoin('projects','projects.id','=','transaksi.id_project')
                        ->select('transaksi.code', 'transaksi.invoice', 'transaksi.description', 'transaksi.jumlah_ticket', 'transaksi.activedate','transaksi.id','company.nama','type_support.nama_support','transaksi.id_company','paket.nama_paket','transaksi.status','transaksi.harga','transaksi.message_admin','transaksi.message_client','transaksi.created_at','projects.nama_projects')
                        ->where('transaksi.id_company',$cid)
                        
                        ->get();  
        }else{
    	$transaksi = DB::table('transaksi')

                        ->leftJoin('company', 'company.idc', '=', 'transaksi.id_company')
                        ->leftJoin('paket', 'paket.id', '=', 'transaksi.id_paket')
                        ->leftJoin('type_support', 'type_support.id', '=', 'transaksi.id_support')
                        ->leftJoin('projects','projects.id','=','transaksi.id_project')
                        ->select('transaksi.code', 'transaksi.invoice', 'transaksi.description', 'transaksi.jumlah_ticket', 'transaksi.activedate','transaksi.id','company.nama','type_support.nama_support','transaksi.id_company','paket.nama_paket','transaksi.status','transaksi.harga','transaksi.message_admin','transaksi.message_client','transaksi.created_at','transaksi.created_at','projects.nama_projects')
                        
                        ->get();
        }
        $cek = DB::table('transaksi')->count();

        if ($cek == 0) {
            $aid = 1;
            $urut =  100001;
            $nomer = $urut;
            
        }else{
            // echo "dawdaw";
            $ambil = Transaksi::all()->last();
            $aid = $ambil->id;
            $urut =  100001 + $ambil->id;
            $nomer = $urut;
        }

            $ldate = Carbon::now()->isoFormat('D');
            //DD MMMM Y

    	return view('transaksi.index',compact('transaksi','nomer','urut','company','support','paket','ldate','aid','project'));
    }
    public function creates()
    {
        $company = Company::all();
        $support = Typesupport::all();
        $paket = Paket::all();
        $transaksi = DB::table('transaksi')

                        ->leftJoin('company', 'company.idc', '=', 'transaksi.id_company')
                        ->leftJoin('paket', 'paket.id', '=', 'transaksi.id_paket')
                        ->leftJoin('type_support', 'type_support.id', '=', 'transaksi.id_support')
                        ->select('transaksi.code', 'transaksi.invoice', 'transaksi.description', 'transaksi.jumlah_ticket', 'transaksi.activedate','transaksi.id','company.nama','type_support.nama_support','transaksi.id_company','paket.nama_paket','transaksi.status')

                        ->get();
        $cek = DB::table('transaksi')->count();

        if ($cek == 0) {
            $urut =  100001;
            $aid = 1;
            $nomer = $urut;
            
        }else{
            // echo "dawdaw";
            $ambil = Transaksi::all()->last();
            $aid = $ambil->id;
            $urut =  100001 + $ambil->id;
            $nomer = $urut;
        }

         $ldate = Carbon::now()->isoFormat('D');

        return view('transaksi.creates',compact('transaksi','nomer','urut','company','support','paket','ldate','aid'));
    }
    public function create(Request $request)
    {
        $tr = Transaksi::with('company')->find($request->id_company);


        $transaksi = new Transaksi;
        $transaksi->code = $request->code;
        $transaksi->id_company = $request->id_company;
        $transaksi->id_project = $request->id_project;
        $transaksi->invoice = $request->invoice;
        $transaksi->description = $request->description;
        $transaksi->id_paket = $request->id_paket;
        $transaksi->jumlah_ticket = $request->jumlah_ticket;
        if (auth()->user()->role == 2) {
           $transaksi->status = 2;
        }else{
        $transaksi->status = $request->status;
        }
        $transaksi->harga = $request->harga;
        $transaksi->activedate = $request->activedate;
        $transaksi->id_support = $request->id_support;
        $transaksi->message_client = $request->message_client;
        $transaksi->message_admin = $request->message_admin;
        $transaksi->email_client = $request->email_client;
        $transaksi->email_company = $request->email_company;
        $transaksi->save();
        if(auth()->user()->role == 4) {
        \Mail::raw($request->code.'-'.$request->description.'-'.'Berhasil Menambahkan Request Pembelian Ticket,Tunggu Pihak Kami Memproses Pembelian Ticket Anda', function($message) use($transaksi){
            $message->to($transaksi->email_client,$transaksi->email_client);
            $message->subject('Pembelian Quota Ticket');
            $message->from('briliannusantara123@gmail.com','PT Mikro Sinergi Informatika');
         });
        \Mail::raw($tr->company->nama.' Mengirim Request Pembelian Ticket Sebanyak '.$request->jumlah_ticket, function($message) use($tr,$transaksi){
            $message->to('briliannusantara123@gmail.com');
            $message->subject('Pembelian Quota Ticket');
            $message->from($transaksi->email_client,'Client '.$tr->company->nama);
         });
         }      
        if (auth()->user()->role == 4) {
            return redirect('/transaksi')->with('success','Berhasil Menambahkan transaksi');
        }else{
          return redirect('/transaksi')->with('success','Berhasil Menambahkan transaksi');
        }
       $ldate = Carbon::now()->isoFormat('D');
    }
     public function edit($id)
    {
        $transaksi = Transaksi::join('company','company.idc','=','transaksi.id_company')->find($id);
        $company = Company::all();
        $support = Typesupport::all();
        $paket = Paket::all();
        return view('transaksi.edit',compact('transaksi','company','support','paket'));
    }
    public function update(Request $request,$id)
    {
        $transaksi = Transaksi::find($id);
            if (auth()->user()->role == 4) {
                $transaksi->update([
                'jumlah_ticket' => $request->jumlah_ticket,
                'description' => $request->description,
                'message_client' => $request->message_client,
                'status' => 4,
            ]);
            }
             if ($transaksi->status == 1) {
                $transaksi->update([
                'jumlah_ticket' => $request->jumlah_ticket,
                'description' => $request->description,
                'status' => 2,

            ]);
            if($transaksi->email_client == !NULL) {
             \Mail::raw($transaksi->code.'-'.$transaksi->description.'-'.'Request Pembelian Quota Ticket Sedang Di Proses', function($message) use($transaksi){
            $message->to($transaksi->email_client,$transaksi->email_client);
            $message->subject('Pembelian Quota Ticket');
            $message->from('briliannusantara123@gmail.com','PT Mikro Sinergi Informatika');
         });
         }
            }elseif ($transaksi->status == 2) {
                $project = Projects::find($transaksi->id_project);
            $ws = Carbon::now();
            $wk = Carbon::parse($project->ticket_active);
            if($project->ticket_active == Null){
            $jml = $ws->addDays($request->activedate);
            }else {
            $jml = $wk->addDays($request->activedate);
            }
            $jumlah = $project->ticket;
            $jumlah_akhir = $jumlah + $request->jumlah_ticket;
            $transaksi->update([
                'jumlah_ticket' => $request->jumlah_ticket,
                'description' => $request->description,
                'message_admin' => $request->message_admin,
                'status' => $request->status,
            ]);
            if($request->email == !NULL) {
            if($request->status == 3){
            Mail::to($request->email)->send(new MailNotify($jumlah = $request->jumlah_ticket));
            
            }
            if($request->status == 5){
            \Mail::raw($transaksi->code.'-'.$transaksi->description.'-'.'Request Pembelian Quota Ticket Di Cancel Oleh Admin', function($message) use($transaksi){
            $message->to($transaksi->email_client,$transaksi->email_client);
            $message->subject('Pembelian Quota Ticket');
            $message->from('briliannusantara123@gmail.com','PT Mikro Sinergi Informatika');
         });
        }
            }
            if ($request->status == 3) {
               Projects::where('id', $transaksi->id_project)->update([
            'ticket' => $jumlah_akhir,
            'ticket_active' => $jml,
            ]);
            }
            
            }
            elseif ($transaksi->status == 3) {
                $transaksi->update([
                'jumlah_ticket' => $request->jumlah_ticket,
                'description' => $request->description,
                'status' => 6,
            ]);
        }
        
        return redirect('/transaksi')->with('success','Status Berhasil Di Ubah');
    }
     public function delete($id)
    {
        $transaksi = Transaksi::find($id);
        $transaksi->delete($transaksi);
        return redirect('/transaksi')->with('success','Data Transaksi Berhasil Di Hapus');
    }
    public function transaksi($company_idc)
    {
        $data = \DB::table('projects')->JOIN('company','projects.id_company','=','company.idc')->where('id_company',$company_idc)->get();
        return response()->json($data);
    }
}
