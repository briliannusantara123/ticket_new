<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paket;
use DB;

class PaketController extends Controller
{
    public function index()
    {
    	$paket = Paket::all();
        $cek = DB::table('paket')->count();

        if ($cek == 0) {
            $urut =  100001;
            $nomer = $urut;
            
        }else{
            // echo "dawdaw";
            $ambil = Paket::all()->last();
            $urut =  100001 + $ambil->id;
            $nomer = $urut;
        }
    	return view('paket.index',compact('paket','nomer','urut'));
    }
    public function create(Request $request)
    {
        $paket =Paket::create($request->all());
        return redirect('/paket')->with('success','Berhasil Menambahkan Paket');
    }
     public function edit($id)
    {
        $paket = Paket::find($id);
       
        return view('paket.edit',['paket' =>$paket]);
    }
    public function update(Request $request,$id)
    {
        $paket = Paket::find($id);
        $paket->update($request->all());
        return redirect('/paket')->with('success','Data Berhasil Di Ubah');
    }
    public function delete($id)
    {
        $paket = Paket::find($id);
        $paket->delete($paket);
        return redirect('/paket')->with('success','Data Paket Berhasil Di Hapus');
    }
}
