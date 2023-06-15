<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Company;
use App\Jabatan;
use DB;

class UsersController extends Controller
{
    public function index()
    {
        $company = Company::all();
        $jabatan = Jabatan::all();
    	$users = DB::table('users')
                        ->leftJoin('company', 'company.idc', '=', 'users.id_company')
                        ->select('users.code', 'users.username', 'users.nik', 'users.email', 'users.telp','users.id','role','company.nama','users.last_login')
                        ->get();
        $cek = DB::table('users')->count();

        if ($cek == 0) {
            $urut =  100001;
            $nomer = $urut;
            
        }else{
            // echo "dawdaw";
            $ambil = User::all()->last();
            $urut =  100001 + $ambil->id;
            $nomer = $urut;
        }
    	return view('users.index',compact('users','company','jabatan','urut'));
    }
    public function create(Request $request)
    {
        $users =User::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'id_company' => $request->id_company,
            'email' => $request->email,
            'role' => $request->role,
            'code' => $request->code,
            'nik' => $request->nik,
            'telp' => $request->telp,
        ]);
        return redirect('/users')->with('success','Berhasil Menambahkan User');
    }
     public function edit($id)
    {
        $users = User::find($id);
        $user = Datauser::all();
       
        return view('users.edit',compact('users','user'));
    }
    public function update(Request $request,$id)
    {
        $users = User::find($id);
        $users->update($request->all());
        return redirect('/users')->with('success','Data Berhasil Di Ubah');
    }
    public function delete($id)
    {
        $users = User::find($id);
        $users->delete($users);
       
        return redirect('/users')->with('success','Users Berhasil Di Hapus');
    }
    public function deleted(Request $request,$id)
    {
        $users = User::find($id);
        $users->update($request->all());
        return redirect('/users')->with('success','Data Berhasil Di Hapus');
    }
}
