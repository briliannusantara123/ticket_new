<?php

namespace App\Http\Controllers;
use Auth;
use App\Company;
use DB;
use Carbon\Carbon;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
    	return view('auths.login');
    }
    public function postlogin(Request $request)
    {
    	if(Auth::attempt($request->only('username','password'))){
    		return redirect('/dashboard');
    	}
    	return redirect('/login');
    }
    public function logout()
    {
    	Auth::logout();
    	return redirect('/login');
    }
    
}
