<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\process;
use App\table;
use App\process_table;
use App\service;

class ProcessController extends Controller
{
	public function index(){
		$arItems = process::get();

		return view('admin.process.index',[
			'arItems' => $arItems
		]);
	}

	public function getadd(){
		$data  = array(
			'table' => table::get(), 
			'service'=> service::get(),
		);
		return view('admin.process.add',$data);
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
		$id_Process = $arProcess->id;
		$table = $request->id_table;
		foreach ($table as $value) {
			$process_table = new process_table;
			$process_table->id_table =$value;
			$process_table->id_process = $id_Process;
			$process_table->save();
		}
		$request->session()->flash('msg','Thêm thành công');
		return redirect()->route('admin.process.index');
	}

	public function getedit($id){
		$arItems = process::find($id);
		$table_check = process_table::where('id_process',$id)->get();
		$arrtable_check = array();
		foreach ($table_check as $item) {
			$arrtable_check['t'.$item['id']] = $item['id_table'];
		}
		
		return view('admin.process.edit',[
			'arItems' => $arItems,
			'table' => table::get(), 
			'service'=> service::get(),
			'table_check'=> $arrtable_check,
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
    	$process_table = process_table::where('id_process',$id)->get();
    	foreach ($process_table as $value) {
    		$arProcess_table = process_table::find($value['id']);
    		$arProcess_table->delete();
    	}
    	$request->session()->flash('msg','Xóa thành công');
    	return redirect()->route('admin.process.index');

    }
    public function changevalueajax(Request $request)
    {
    	$id = $request->id;
    	$id_process = $request->id_process;
    	$table = process_table::where('id_table',$id)->get();
    	
    	if(count($table)==0)
    	{
    		$process_table = new process_table;
    		$process_table->id_process = $id_process;
    		$process_table->id_table = $id;
    		$process_table->save();
    	}
    	else
    	{
    		$item_table = process_table::where('id_table',$id)->get();
    		$process_table = process_table::find($item_table[0]['id']);
    		$process_table->delete(); 
    	}
    	echo json_encode($id);
    }
}