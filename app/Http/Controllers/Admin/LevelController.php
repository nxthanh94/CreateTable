<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\phanquyen;

class LevelController extends Controller
{
	public function index(){
		$arItems = phanquyen::get();

		return view('admin.level.index',[
			'arItems' => $arItems
		]);
	}

	public function getadd(){
		return view('admin.level.add');
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

		$arService = new phanquyen;

		$arService->name = $request->name;

		$arService->save();

		$request->session()->flash('msg','Thêm thành công');
		return redirect()->route('admin.level.index');
	}

	public function getedit($id){
		$arItems = phanquyen::find($id);

		return view('admin.level.edit',[
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

		$arItems = phanquyen::find($id);
        $arItems->name = $request->name;
        $arItems->update();

        $request->session()->flash('msg','Sửa thành công');
        return redirect()->route('admin.level.index');
    }

    public function del($id, Request $request){
    	$arItems = phanquyen::find($id);
    	$arItems->delete();
    	
    	$request->session()->flash('msg','Xóa thành công');
    	return redirect()->route('admin.level.index');

    }
}
