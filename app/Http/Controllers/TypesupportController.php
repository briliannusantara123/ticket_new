<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Typesupport;
use DB;

class TypesupportController extends Controller
{
    public function index()
    {
    	$typesupport = Typesupport::all();
        $cek = DB::table('type_support')->count();

        if ($cek == 0) {
            $urut =  100001;
            $nomer = $urut;
            
        }else{
            // echo "dawdaw";
            $ambil = Typesupport::all()->last();
            $urut =  100001 + $ambil->id;
            $nomer = $urut;
        }
    	return view('typesupport.index',compact('typesupport','nomer','urut'));
    }
    public function create(Request $request)
    {
        $typesupport =Typesupport::create($request->all());
        return redirect('/typesupport')->with('success','Berhasil Menambahkan Typesupport');
    }
     public function edit($id)
    {
        $typesupport = Typesupport::find($id);
       
        return view('typesupport.edit',['typesupport' =>$typesupport]);
    }
    public function update(Request $request,$id)
    {
        $typesupport = Typesupport::find($id);
        $typesupport->update($request->all());
        return redirect('/typesupport')->with('success','Data Berhasil Di Ubah');
    }
    public function delete($id)
    {
        $typesupport = Typesupport::find($id);
        $typesupport->delete($typesupport);
        return redirect('/typesupport')->with('success','Data Typesupport Berhasil Di Hapus');
    }
}
