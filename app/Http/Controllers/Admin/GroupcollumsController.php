<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\table;
use App\collums;
use App\groupcollums;

class GroupcollumsController extends Controller
{
	public $value_frm =array(
		'id'			=>null,
		'name'			=>'',
		'id_collums'	=>null,
	);
	public function index($id_table)
	{
		$data = array(
			'arItems'	=> groupcollums::where('id_table',$id_table)->get(),
			'title' => 'Quản lý group',
			'id_table'=> $id_table
		);
		return view('admin.groupcollums.index',$data);

	}
    public function getadd($id_table)
    {
    	$data = array(
    		'title' 	=>'Group cột',
    		'action'	=>'admin.groupcollums.add',
    		'collums'	=> collums::where('id_table',$id_table)->where('id_group', null)->get(),
    		'id_table'	=> $id_table,
    		'value_frm'	=> $this->value_frm,
    	);
    	return view('admin.groupcollums.addgroup',$data);
    }
    public function postadd($id_table, Request $request)
    {
    	$data_frm = $request->all();
    	$table = new groupcollums;
    	$table->name = $data_frm['name'];
    	$table->id_table = $id_table;
    	$table->save();
    	$id_group = $table->id;
    	foreach ($data_frm['id_collums'] as  $item) {
    		$collums = collums::find($item);
    		$collums->id_group = $id_group;
    		$collums->update();
    	}
    }
    public function getedit($id)
    {
    	$group = groupcollums::where('id',$id)->get();
    	$collums = collums::where('id_table',$group[0]['id_table'])->get();
    	$collums_group = collums::where('id_group',$id)->get();
    	$arrID_group = array();
    	foreach ($collums_group as $item) {
    		$arrID_group['x'.$item['id']] = $item['id'];
    	}
    	$data = array(
    		'title'		=>'Sửa group',
    		'value_frm'	=>$group[0],
    		'collums'	=>$collums,
    		'collums_group' => $arrID_group,
    		'action'		=> 'admin.groupcollums.edit',
    	);
    	return view('admin.groupcollums.editgroup',$data);
    }
    public function postedit($id, Request $request)
    {
    	$collums = collums::where('id_group',$id)->get();
    	$data_frm = $request->all();
    	$table = groupcollums::find($id);
    	$table->name = $data_frm['name'];
    	$table->update();
    	$request->session()->flash('msg','Group đã chưa được tạo');
        return redirect()->route('admin.groupcollums.index',$collums[0]['id_table']);
    }
}
