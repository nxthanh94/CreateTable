<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\phanquyen;
use App\service;
use App\serviceuser;
use Illuminate\Support\Facades\DB;
use Image;

class UsersController extends Controller
{
    public function index(){
    	$arItems = User::all();
        return view('admin.user.index',[
          'arItems' => $arItems
      ]);
    }

    public function getadd(){
        $arPhanquyen = phanquyen::all();
        $arService = service::all();
        return view('admin.user.add',[
            'arPhanquyen' => $arPhanquyen,
            'arService' =>$arService
        ]);
    }

    public function postadd(Request $request){
        $this->validate($request, [
            'name' => 'required|min:5|max:255',
            'username' => 'required|unique:users,username|min:5|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5|max:100',
            'password2' => 'required|same:password',
            'phone' => 'required|min:10|numeric',
            'diachi' => 'required|max:255',
            'phanquyen' => 'required',
            'picture' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ],
        [
            'name.required' => 'Không được để trống',
            'name.min' => 'Chiều dài danh mục từ 5-255 ký tự',
            'name.max' => 'Chiều dài danh mục từ 5-255 ký tự',
            'username.required' => 'Không được để trống',
            'username.unique' => 'Username đã tồn tại',
            'username.min' => 'Chiều dài danh mục từ 5-255 ký tự',
            'username.max' => 'Chiều dài danh mục từ 5-255 ký tự',
            'email.required' => 'Không được để trống',
            'email.unique' => 'Email đã tồn tại',
            'email.email' => 'Định dạng sai',
            'password.required' => 'Không được để trống',
            'password.min' => 'Chiều dài danh mục từ 5-100 ký tự',
            'password.max' => 'Chiều dài danh mục từ 5-100 ký tự',
            'password2.required' => 'Không được để trống',
            'password2.same' => 'Mật khẩu không trùng khớp',
            'phone.required' => 'Không được để trống',
            'phone.min' => 'Chiều dài tối thiểu 10 ký tự',
            'phone.numeric' => 'Thông tin phải là số',
            'diachi.required' => 'Không được để trống',
            'diachi.max' => 'Chiều dài danh mục tối đa 255 ký tự',
            'phanquyen.required' => 'Không được để trống',
            'picture.image' => 'Bạn chỉ được phép up hình ảnh',
            'picture.mimes' => 'Định dạng sai, bạn nên up jpg,png,jpeg,gif,svg',
            'picture.max' => 'Bạn chỉ được phép up ảnh tối đa 2M',
        ]);
        
        $arUsers = new User;

        $picName = $request->picture;

        if($request->picture != ''){
            $image = $request->file('picture');
            $filename  = time() . '.' . $image->getClientOriginalExtension();
            $path = storage_path('app/files/avata/' . $filename);
            Image::make($image->getRealPath())->resize(100, 100)->save($path);
            $tmp = explode('/',$filename);
            $picName = end($tmp);
        }

        $arUsers->username = $request->username;
        $arUsers->password = bcrypt(trim($request->password));
        $arUsers->name = $request->name;
        $arUsers->email = $request->email;
        $arUsers->phone = $request->phone;
        $arUsers->diachi = $request->diachi;
        $arUsers->id_phanquyen = $request->phanquyen;
        $arUsers->picture = $picName;

        $arUsers->save();
        $id_user = $arUsers->id;
        $id_service = $request->id_service;
        if($request->phanquyen == 1 || $request->phanquyen==2)
        {
            $service = service::all();
            foreach ($service as $item) {
                $serviceuser = new serviceuser;
                $serviceuser->id_user = $id_user;
                $serviceuser->id_service = $item['id'];
                $serviceuser->save();
            }
        }
        else
        {
            foreach ($id_service as $item) {
                $serviceuser = new serviceuser;
                $serviceuser->id_user = $id_user;
                $serviceuser->id_service = $item;
                $serviceuser->save();
            }
        }
        
        $request->session()->flash('msg','Thêm thành công');
        return redirect()->route('admin.user.index');
    }
    
    public function getEdit($id, Request $request){

        $arUsers = User::find($id);
        $arService = service::all();
        //var_dump($arService);exit();
        $arPhanquyen = phanquyen::all();
        $arItems = User::all();
        $service_check = serviceuser::where('id_user',$id)->get();
        $arservice_check =array();
        foreach ($service_check as $value) {
            $arservice_check['srv'.$value['id']] = $value['id_service'];
        }       
        if((Auth::user()->id != 1) && ($id == 1 || $arUsers['id_phanquyen'] == 2 && (Auth::user()->id != $id))){
            $request->session()->flash('msg','Bạn không được sửa thành viên này');
            return redirect()->route('admin.users.index');
        }else{
            return view('admin.user.edit',[
                'arUsers' => $arUsers,
                'arPhanquyen' => $arPhanquyen,
                'arservice' =>$arService,
                'arservice_check' =>$arservice_check,
            ]);
        }


        
    }

    public function postedit($id, Request $request){
        $this->validate($request, [
            'name' => 'required|min:5|max:255',
            'username' => 'required|min:5|max:255',
            'email' => 'required|email',
            'password' => 'max:100',
            'password2' => 'same:password',
            'phone' => 'required|min:10|numeric',
            'diachi' => 'required|max:255',
            'phanquyen' => 'required',
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
            'phanquyen.required' => 'Không được để trống',
            'picture.image' => 'Bạn chỉ được phép up hình ảnh',
            'picture.mimes' => 'Định dạng sai, bạn nên up jpg,png,jpeg,gif,svg',
            'picture.max' => 'Bạn chỉ được phép up ảnh tối đa 2M',
        ]);
        $arUsers = User::find($id);

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
        $arUsers->id_phanquyen = $request->phanquyen;
        $arUsers->picture = $picName;

        $arUsers->update();

        $request->session()->flash('msg','Sửa thành công');
        return redirect()->route('admin.user.index');
    }

    public function del($id, Request $request){
       $arUsers = User::find($id);
       if($arUsers['username'] != 'admin'){
        $picNameOld = $arUsers['picture'];
        if($picNameOld != ""){
            Storage::delete("files/avata/{$picNameOld}");
        }
        $arUsers->delete();
        $arService_user =serviceuser::where('id_user',$id)->get();
        foreach ($arService_user as $item) {
            $serviceuser = serviceuser::find($item['id']);
            $serviceuser ->delete();
        }
        $request->session()->flash('msg','Xóa thành công');
        return redirect()->route('admin.user.index');
        }else{
            $request->session()->flash('msg','Không thể xóa tài khoản này');
            return redirect()->route('admin.user.index');
        }
    }
    public function addservice(Request $request)
    {
        $id = $request->id;
        $id_service = $request->id_service;
        $user = serviceuser::where('id_user',$id)->where('id_service',$id_service)->get();
        if(count($user)==0)
        {
            $serviceuser = new serviceuser;
            $serviceuser->id_user = $id;
            $serviceuser->id_service = $id_service;
            $serviceuser->save();
        }
        else
        {
            $serviceuser = serviceuser::find($user[0]['id']);
            $serviceuser->delete(); 
        }
        echo json_encode(count($user));
    }
    public function getlist($id_service)
    {
         $arItems = User::join('serviceuser','users.id','=','serviceuser.id_user')->where('users.id_phanquyen','=',3)->where('serviceuser.id_service','=',$id_service)->select('users.*')->get();
        $data = array(
             'arItems'  => $arItems,
             'title'    => 'User dịch vụ'
        );
       
        return view('admin.user.list',$data);
    }



}