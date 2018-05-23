<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Session;

class LoginController extends MyController
{
	public $template = array (
		'sidebar'	=>'templates.public.index.sidebar',
		'content'	=>'templates.public.login.index'
	);
    public function index()
    {
    	$this->data['title'] = 'Đăng nhập vào hệ thống';
    	$this->data['template'] = $this->template;
    	$this->data['action'] = 'login.check';
    	return view('templates.public.index',$this->data);
    }
    public function checklogin(Request $request){
    	$username = trim($request->username);
		$password = trim($request->password);

    	if (Auth::attempt(['username' => $username, 'password' => $password]))
    	{
            
            	
            	return redirect()->route('index');

      
	    }
	    else
	    {
	    	$request->session()->flash('msg','Sai username or mật khẩu');
	    	return redirect()->route('login');
		}
		
    }
    public function logout(){
			Auth::logout();
			return redirect()->route('index');
	}
}
