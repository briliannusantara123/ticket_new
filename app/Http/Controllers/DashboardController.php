<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Company;
use App\Requestlines;
use App\Requestheader;
use App\Projects;
use Carbon\Carbon;

class DashboardController extends Controller
{
     public function index()
    {
        $cid = auth()->user()->id_company;
        $id = auth()->user()->id;
    	$proj = DB::table('projects')->count();
    	$paket = DB::table('paket')->count();
    	$projects = DB::table('projects')->count();
    	$typesupport = DB::table('type_support')->count();
    	$userlogin = DB::table('users')->count();
        $transaksi = DB::table('transaksi')->count();
        $project = DB::table('projects')
                        ->where('id_company',$cid)
                        ->sum('projects.ticket');
        $ts = DB::table('projects')
                        ->where('id_company',$cid)
                        ->sum('projects.ticket_used');
        $rh = DB::table('request_header')
                        ->where('id_company',$cid)
                        ->orderBy('id','asc')
                        ->count();
        $rl = DB::table('request_lines')
                        ->where('id_company',$cid)
                        ->orderBy('idl','asc')
                        ->count();
        $rla = Requestlines::where('status', 5)
                            ->where('id_company',$cid)
                            ->orderBy('status','asc')
                            ->get()
                            ->count();
        $rlb = Requestlines::where('status', 6)
                            ->where('id_company',$cid)
                            ->orderBy('status','asc')
                            ->get()
                            ->count();
        $rlc = Requestlines::where('status', 11)
                            ->where('id_company',$cid)
                            ->orderBy('status','asc')
                            ->get()
                            ->count();
        $rld = Requestlines::where('status', 10)
                            ->where('id_company',$cid)
                            ->orderBy('status','asc')
                            ->get()
                            ->count();
        
        $pa = Requestlines::where('id_developer',$id)
                            ->orderBy('status','asc')
                            ->get()
                            ->count();
        $pp2 = Requestlines::where('status', 10)
                            ->where('id_developer',$id)
                            ->orderBy('status','asc')
                            ->get()
                            ->count();
        $pp3 = Requestlines::where('status', 6)
                            ->where('id_developer',$id)
                            ->orderBy('status','asc')
                            ->get()
                            ->count();
        $pp4 = Requestlines::where('status', 11)
                            ->where('id_developer',$id)
                            ->orderBy('status','asc')
                            ->get()
                            ->count();
        $rl1= Requestlines::where('status', 5)
                            ->where('user_id',$id)
                            ->orderBy('status','asc')
                            ->get()
                            ->count();
        $rl2= Requestlines::where('status', 6)
                            ->where('user_id',$id)
                            ->orderBy('status','asc')
                            ->get()
                            ->count();
        $rl3= Requestlines::where('status', 10)
                            ->where('user_id',$id)
                            ->orderBy('status','asc')
                            ->get()
                            ->count();
        $rl4= Requestlines::where('status', 11)
                            ->where('user_id',$id)
                            ->orderBy('status','asc')
                            ->get()
                            ->count();
        $rls = Requestlines::where('user_id',$id)->count();
        $rlt = $rl1 + $rl2 + $rl3 + $rl4;
        $r = $rla + $rlb + $rlc + $rld;
        $ppt= $pp2 + $pp3 + $pp4;

        $rhc = Requestheader::where('status',2)
                             ->where('user_id',$id)
                             ->get()
                             ->count();
        $rhw = Requestheader::where('user_id',$id)
                             ->get()
                             ->count();

        $idc = auth()->user()->id_company;
        $company = Company::find($idc);
        
       if (auth()->user()->role == 4) {
        $wa = Carbon::parse($company->ticket_active);
        $wah = $wa->diffInDays();
           if ($company->notif == NULL) {
            if ($wah == 30) {
            if ($company->email == !NULL) {
           \Mail::raw('Ticket Active Anda Sisa 30 Hari Lagi', function($message) use($company){
            $message->to($company->email,$company->email);
            $message->subject('Masa Aktif Ticket');
            $message->from('briliannusantara123@gmail.com','PT Mikro Sinergi Informatika');
         });
        }
        Company::where('idc', $idc)->update([
                'notif' => '1',

            ]);
        }
        }
       }

    	return view('dashboard.index',compact('proj','paket','projects','typesupport','userlogin','project','rlt','ppt','pa','rhc','rhw','transaksi','rh','rl','r','rls','ts'));
    }
}
