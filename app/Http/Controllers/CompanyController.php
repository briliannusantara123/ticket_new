<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use DB;
use Carbon\Carbon;

class CompanyController extends Controller
{
    public function index()
    {
    	$company = Company::all();
        $cek = DB::table('company')->count();

        if ($cek == 0) {
            $urut =  100001;
            $nomer = $urut;
            
        }else{
            // echo "dawdaw";
            $ambil = Company::all()->last();
            $urut =  100001 + $ambil->idc;
            $nomer = $urut;
        }
        $date = Carbon::now();
        $ldate = $date->day;
        
    	return view('company.index',compact('company','nomer','urut','ldate'));
    }
    public function create(Request $request)
    {
        $company =Company::create($request->all());
        return redirect('/company')->with('success','Berhasil Menambahkan Company');
    }
     public function edit($idc)
    {
        $company = Company::find($idc);
       
        return view('company.edit',['company' =>$company]);
    }
    public function update(Request $request,$idc)
    {
        $company = Company::find($idc);
        $company->update($request->all());
        return redirect('/company')->with('success','Data Berhasil Di Ubah');
    }
    public function delete($id)
    {
        $company = Company::find($id);
        $company->delete($company);
        return redirect('/company')->with('success','Data Company Berhasil Di Hapus');
    }
    public function company($company_idc)
    {
        $data = DB::table('projects')->JOIN('company','projects.id_company','=','company.idc')->where('id_company',$company_idc)->get();
        return response()->json($data);
    }
}
