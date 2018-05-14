<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserEditRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\phanquyen;
use App\hoadon;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function index(){
    	$arItems = DB::table('users as u')->
    	join('phanquyen as p', 'u.id_phanquyen','=','p.id')->
    	select('*','tenpq','u.id as uid')->get();
    	return view('admin.users.index',[
    		'arItems' => $arItems
    	]);
    }

    public function getadd(){
    	return view('admin.users.add');
    }

    public function postadd(UserRequest $request){
    	$username = $request->username;
    	$password = bcrypt(trim($request->password));
    	$name = $request->name;
    	$email = $request->email;
    	$sdt = $request->phone;
    	$phanquyen = $request->phanquyen;
    	$arUsers = array(
            'username' => $username,
            'password' => $password,
            'name' 	   => $name,
            'email' => $email,
            'dienthoai' => $sdt,
            'id_phanquyen'     => $phanquyen,
        	);

    	
		User::insert($arUsers);

    	$request->session()->flash('msg','Thêm thành công');
    	return redirect()->route('admin.users.index');
    }
    
    public function getEdit($id, Request $request){
        $arUsers = User::find($id);
        $arItems = User::all();
        if((Auth::user()->id != 1) && ($id == 1 || $arUsers['id_phanquyen'] == 2 && (Auth::user()->id != $id))){
            $request->session()->flash('msg','Bạn không được sửa thành viên này');
            return redirect()->route('admin.users.index');
        }else{
            return view('admin.users.edit',[
            'arUsers' => $arUsers 
            ]);
        }


        
    }

    public function postedit($id, UserEditRequest $request){
    	$arUsers = User::find($id);

    	$arUsers->username = trim($request->username);
        $arUsers->name     = $request->name; 
        if(trim($request->password) != ''){
           $arUsers->password = bcrypt(trim($request->password)) ;
        }
        $arUsers->email = trim($request->email);
        $arUsers->dienthoai = trim($request->phone);
        $arUsers->id_phanquyen = trim($request->phanquyen);

    	$arUsers->update();

    	$request->session()->flash('msg','Sửa thành công');
    	return redirect()->route('admin.users.index');
    }

    public function del($id, Request $request){
    	$arUsers = User::find($id);
        $parent = hoadon::where('id_users','=',$id)->count();
            if($arUsers['username'] != 'admin' && $parent == 0){
                $arUsers->delete();
                $request->session()->flash('msg','Xóa thành công');
                return redirect()->route('admin.users.index');
            }else{
                $request->session()->flash('msg','Không thể xóa tài khoản này');
                return redirect()->route('admin.users.index');
            }
       
    	

    	
    }


}
