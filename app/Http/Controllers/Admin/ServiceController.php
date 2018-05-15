<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\service;

class ServiceController extends Controller
{
	public function index(){
		$arItems = service::get();

		return view('admin.service.index',[
			'arItems' => $arItems
		]);
	}

	public function getadd(){
		return view('admin.service.add');
	}

	public function postadd(Request $request){
		$this->validate($request, [
			'name' => 'required|min:5|max:255',
		],
		[
			'name.required' => 'Không được để trống',
			'name.min' => 'Chiều dài danh mục từ 5-255 ký tự',
			'name.max' => 'Chiều dài danh mục từ 5-255 ký tự',
		]);

		$arService = new service;

		$arService->name = $request->name;

		$arService->save();

		$request->session()->flash('msg','Thêm thành công');
		return redirect()->route('admin.service.index');
	}

	public function getedit($id){
		$arItems = service::find($id);

		return view('admin.service.edit',[
			'arItems' => $arItems,
		]);
	}

	public function postedit($id, Request $request){
		$this->validate($request, [
			'name' => 'required|min:5|max:255',
		],
		[
			'name.required' => 'Không được để trống',
			'name.min' => 'Chiều dài danh mục từ 5-255 ký tự',
			'name.max' => 'Chiều dài danh mục từ 5-255 ký tự',
		]);

		$arItems = service::find($id);
        $arItems->name = $request->name;
        $arItems->update();

        $request->session()->flash('msg','Sửa thành công');
        return redirect()->route('admin.service.index');
    }

    public function del($id, Request $request){
    	$arItems = service::find($id);
    	$arItems->delete();
    	
    	$request->session()->flash('msg','Xóa thành công');
    	return redirect()->route('admin.service.index');

    }
}
