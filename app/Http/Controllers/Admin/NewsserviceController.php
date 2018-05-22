<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\newsservice;
use App\service;

class NewsserviceController extends Controller
{
    public $value_frm = array(
    	'id'=>null,
    	'name'=>null,
    	'id_service' =>null,
    	'content' =>null,
    );
    public function index()
    {
    	$data = array(
    		'title' => 'Quản lý bài viết dịch vụ',
    		'arItems' =>newsservice::get(),
    	);
    	return view('admin.newsservice.index',$data);
    }
    public function getadd()
    {
    	$data = array(
    		'value_frm' => $this->value_frm,
    		'service'	=> service::get(),
    		'title'		=> 'Thêm bài viết',
    		'action'	=> 'admin.newsservice.add',
    	);
    	return view ('admin.newsservice.add',$data);
    }
    public function postadd(Request $request)
    {
    	$data_frm = $request->all();
    	$this->validate($request, [
			'name' => 'required|min:5|max:255',
			'content' => 'required',
			'id_service' => 'required',
		],
		[
			'name.required' => 'Không được để trống',
			'name.min' => 'Chiều dài danh mục từ 5-255 ký tự',
			'name.max' => 'Chiều dài danh mục từ 5-255 ký tự',
			'content.required' => 'Không được để trống',
			'id_service.required' => 'Không được để trống',
		]);
		$newsservice = new newsservice;
		$newsservice->name = $data_frm['name'];
		$newsservice->id_service = $data_frm['id_service'];
		$newsservice->content = $data_frm['content'];
		$newsservice->save();
		$request->session()->flash('msg','Thêm thành công');
		return redirect()->route('admin.newsservice.index');
    }
    public function getedit($id)
    {
    	$this->value_frm = newsservice::find($id);
    	$data = array(
    		'value_frm' => $this->value_frm,
    		'service'	=> service::get(),
    		'title'		=> 'Thêm bài viết',
    		'action'	=> 'admin.newsservice.edit',
    	);
    	return view ('admin.newsservice.edit',$data);
    }
    public function postedit($id, Request $request)
    {
    	$data_frm = $request->all();
    	$this->validate($request, [
			'name' => 'required|min:5|max:255',
			'content' => 'required',
			'id_service' => 'required',
		],
		[
			'name.required' => 'Không được để trống',
			'name.min' => 'Chiều dài danh mục từ 5-255 ký tự',
			'name.max' => 'Chiều dài danh mục từ 5-255 ký tự',
			'content.required' => 'Không được để trống',
			'id_service.required' => 'Không được để trống',
		]);

    	$newsservice = newsservice::find($id);
		$newsservice->name = $data_frm['name'];
		$newsservice->id_service = $data_frm['id_service'];
		$newsservice->content = $data_frm['content'];
		$newsservice->update();
		$request->session()->flash('msg','Sửa thành công');
		return redirect()->route('admin.newsservice.index');
    }
    public function del($id, Request $request){
    	$arItems = newsservice::find($id);
    	$arItems->delete();
    	$request->session()->flash('msg','Xóa thành công');
    	return redirect()->route('admin.newsservice.index');

    }
}
