<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function getLogin(){
		return view('auth.login');
	}
	public function postLogin(Request $request){
	$username = trim($request->username);
	$password = trim($request->password);

	if (Auth::attempt(['username' => $username, 'password' => $password])) {
            if(Auth::user()->id_phanquyen == 1){
            	return redirect()->route('admin.index.index');
            }
            else{
            	return redirect()->route('public.index');
            }
    }else{
    	$request->session()->flash('msg','Sai username or mật khẩu');
    	return redirect()->route('public.auth.login');
        }
	}
	public function logout(){
		Auth::logout();
		return redirect()->route('public.index');
	}
}
