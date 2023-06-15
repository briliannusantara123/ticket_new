<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jabatan;
use DB;

class JabatanController extends Controller
{
    public function index()
    {
    	$jabatan = Jabatan::all();
        $cek = DB::table('jabatan')->count();

        if ($cek == 0) {
            $urut =  100001;
            $nomer = $urut;
            
        }else{
            // echo "dawdaw";
            $ambil = Jabatan::all()->last();
            $urut =  100001 + $ambil->id;
            $nomer = $urut;
        }
    	return view('jabatan.index',compact('jabatan','nomer','urut'));
    }
    public function create(Request $request)
    {
        $jabatan =Jabatan::create($request->all());
        return redirect('/jabatan')->with('success','Berhasil Menambahkan jabatan');
    }
     public function edit($id)
    {
        $jabatan = Jabatan::find($id);
       
        return view('jabatan.edit',['jabatan' =>$jabatan]);
    }
    public function update(Request $request,$id)
    {
        $jabatan = Jabatan::find($id);
        $jabatan->update($request->all());
        return redirect('/jabatan')->with('success','Data Berhasil Di Ubah');
    }
    public function delete($id)
    {
        $jabatan = Jabatan::find($id);
        $jabatan->delete($jabatan);
        return redirect('/jabatan')->with('success','Data Jabatan Berhasil Di Hapus');
    }
}
