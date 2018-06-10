<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Session;
use App\User;
use Mail;

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
	public function forgotpassword()
	{
		$this->template = array (
		'sidebar'	=>'templates.public.index.sidebar',
		'content'	=>'templates.public.login.forgotpw'
		);
		$this->data['title'] = 'Nhập email để nhận lại mật khẩu!';
    	$this->data['template'] = $this->template;
    	$this->data['action'] = 'login.reset';
    	return view('templates.public.index',$this->data);
	}
	public function resetpassword(Request $request)
	{
		$this->validate($request,[
			'email' =>'required|email',
			'email_com' => 'required|email|same:email',
		],
		[
			'email.required' =>'Email không được rổng',
			'email.email' =>'Email không hợp lệ',
			'email_com.required' =>'Email nhập lại không được rổng',
			'email_com.email' =>'Email nhập lại không hợp lệ',
			'email_com.same' =>'Email không trùng nhau',
		]
		);
		$user = user::where('email',$request->email)->get();
		if(count($user)==1)
		{
			$newpassword ='123456';
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		   	$newpassword = rand(0, 999999);
			Mail::send('templates.public.login.resetpw', array('name'=>$user[0]["name"],'email'=>$user[0]["email"], 'content'=>$newpassword), function($message){
		        $message->to('plachym.it@gmail.com', 'Reset password')->subject('New password!');
		    });
			$request->session()->flash('msg','Vui lòng kiểm tra email để nhận lại mật khẩu');
		}
		else
		{
			 $request->session()->flash('msg','Email không tồn tại');
		}
		return redirect()->route('login.forgot');
	}
}
