<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\process;

class ProcessController extends Controller
{
	public function index(){
		$arItems = process::get();

		return view('admin.process.index',[
			'arItems' => $arItems
		]);
	}

	public function getadd(){
		return view('admin.process.add');
	}

	public function postadd(Request $request){
		$this->validate($request, [
			'name' => 'required|min:5|max:255',
			'content' => 'required',
		],
		[
			'name.required' => 'Không được để trống',
			'name.min' => 'Chiều dài danh mục từ 5-255 ký tự',
			'name.max' => 'Chiều dài danh mục từ 5-255 ký tự',
			'content.required' => 'Không được để trống',
		]);

		$arProcess = new process;

		$arProcess->name = $request->name;
		$arProcess->content = $request->content;

		$arProcess->save();

		$request->session()->flash('msg','Thêm thành công');
		return redirect()->route('admin.process.index');
	}

	public function getedit($id){
		$arItems = process::find($id);

		return view('admin.process.edit',[
			'arItems' => $arItems,
		]);
	}

	public function postedit($id, Request $request){
		$this->validate($request, [
			'name' => 'required|min:5|max:255',
			'content' => 'required',
		],
		[
			'name.required' => 'Không được để trống',
			'name.min' => 'Chiều dài danh mục từ 5-255 ký tự',
			'name.max' => 'Chiều dài danh mục từ 5-255 ký tự',
			'content.required' => 'Không được để trống',
		]);

		$arItems = process::find($id);
        $arItems->name = $request->name;
        $arItems->content = $request->content;
        $arItems->update();

        $request->session()->flash('msg','Sửa thành công');
        return redirect()->route('admin.process.index');
    }

    public function del($id, Request $request){
    	$arItems = process::find($id);
    	$arItems->delete();
    	
    	$request->session()->flash('msg','Xóa thành công');
    	return redirect()->route('admin.process.index');

    }
}
