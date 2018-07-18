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
	public $email_to ="minhnhutc2@gmail.com";
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
		   	$newpassword = rand(0, 999999);
		   	$this->email_to = $user[0]["email"];
			Mail::send('templates.public.login.resetpw', array('name'=>$user[0]["name"],'email'=>$user[0]["email"], 'content'=>$newpassword), function($message){
		        $message->to($this->email_to, 'Reset password')->subject('New password!');
		    });
			$user_rspw = User::find($user[0]["id"]) ;
			$user_rspw->password = bcrypt(trim($newpassword));
			$user_rspw->update();
			$request->session()->flash('msg','Vui lòng kiểm tra email để nhận lại mật khẩu ');
		}
		else
		{
			 $request->session()->flash('msg','Email không tồn tại');
		}
		return redirect()->route('login.forgot');
	}
	public function profile($id_user)
	{
		
		$this->template = array (
		'sidebar'	=>'templates.public.index.sidebar',
		'content'	=>'templates.public.login.profile'
		);
		$this->data['title'] = 'Hồ sơ cá nhân';
    	$this->data['template'] = $this->template;
    	$this->data['action'] = 'profile';
    	$this->data['arUsers'] = User::find($id_user);
    	
    	return view('templates.public.index',$this->data);
	}
	public function editprofile($id_user,Request $request)
	{
		$this->validate($request, [
            'name' => 'required|min:5|max:255',
            'username' => 'required|min:5|max:255',
            'email' => 'required|email',
            'password' => 'max:100',
            'password2' => 'same:password',
            'phone' => 'required|min:10|numeric',
            'diachi' => 'required|max:255',
            
            'picture' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ],
        [
            'name.required' => 'Không được để trống',
            'name.min' => 'Chiều dài danh mục từ 5-255 ký tự',
            'name.max' => 'Chiều dài danh mục từ 5-255 ký tự',
            'username.required' => 'Không được để trống',
            'username.min' => 'Chiều dài danh mục từ 5-255 ký tự',
            'username.max' => 'Chiều dài danh mục từ 5-255 ký tự',
            'email.required' => 'Không được để trống',
            'email.email' => 'Định dạng sai',
            'password.max' => 'Chiều dài danh mục từ 5-100 ký tự',
            'password2.same' => 'Mật khẩu không trùng khớp',
            'phone.required' => 'Không được để trống',
            'phone.min' => 'Chiều dài tối thiểu 10 ký tự',
            'phone.numeric' => 'Thông tin phải là số',
            'diachi.required' => 'Không được để trống',
            'diachi.max' => 'Chiều dài danh mục tối đa 255 ký tự',
            'picture.image' => 'Bạn chỉ được phép up hình ảnh',
            'picture.mimes' => 'Định dạng sai, bạn nên up jpg,png,jpeg,gif,svg',
            'picture.max' => 'Bạn chỉ được phép up ảnh tối đa 2M',
        ]);
        $arUsers = User::find($id_user);

        $picNameOld = $arUsers['picture'];
        $picNameNew = $request->picture;
        if($picNameNew != ''){
            $image = $request->file('picture');
            $filename  = time() . '.' . $image->getClientOriginalExtension();
            $path = storage_path('app/files/avata/' . $filename);
            Image::make($image->getRealPath())->resize(100, 100)->save($path);
            $tmp = explode('/',$filename);
            $picName = end($tmp);

            if($picNameOld != ''){
                Storage::delete("files/avata/{$picNameOld}");
            }
        }else{
            $picName = $picNameOld;
        }

        $arUsers->name     = $request->name; 
        if(trim($request->password) != '')
        {
            $arUsers->password = bcrypt(trim($request->password)) ;
        }
        $arUsers->username = $request->username;
        $arUsers->name = $request->name;
        $arUsers->email = $request->email;
        $arUsers->phone = $request->phone;
        $arUsers->diachi = $request->diachi;
        $arUsers->picture = $picName;

        $arUsers->update();
        return redirect()->route('index');
	}
}
