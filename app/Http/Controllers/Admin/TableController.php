<?php

namespace App\Http\Controllers\admin;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\MessageBag;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\service;
use App\table;

class TableController extends Controller
{
    public $value_frm = array(
            'id'=>null,
            'name' =>'',
            'id_sevice' => 0,
            'id_user' => 0,
            'name_table' =>'',
            'header' => '',
            'footer' => '',
    );

    public function index()
    {


        $data = array(
            'arItems'=>table::get(),
            
            'title'=>'Quảng lý table'
        );
        return view('admin.table.index',$data);
    }
    public function addtable()
    {
        $data = array(
            'value_frm'=>$this->value_frm,
            'service'=>service::get(),
            'title'=>'Thêm bảng',
            'action'=>'admin.table.posttbale',
        );
        return view('admin.table.table_frm',$data);
    }
    public function addtable_value(Request $request )
    {
       
        $this->value_frm = $request->all();
        $validator  = Validator::make( $this->value_frm , [
            'name' => 'required|min:5|max:255',
        ],[
            'name.required' =>'Tên không được rổng',
            'name.min' =>'Tên không được nhỏ hơn 5 ký tự',
            'name.max' =>'Tên không được lớn hơn 255 ký tự',
        ]);
        
        if ($validator ->fails()) {


           $data = array(
            'value_frm'=>$this->value_frm,
            'title'=>'Thêm bảng',
            'action'=>'admin.table.posttbale',
            'errors' => $validator->errors(),
            );
            return view('admin.table.table_frm',$data);
        }
        else
        {
            $table = new table;
            $table->name = $this->value_frm['name'];
            $table->header =  $this->value_frm['header'];
            $table->footer =  $this->value_frm['footer'];
            $table->id_user = 0;
            $table->id_sevice = $this->value_frm['linhvuc'];
            $table->name_table = 'tb'.str_replace("-","_",str_slug($this->value_frm['name'])).time();
            $table->save();
            $request->session()->flash('msg','Thêm thành công');
            return redirect()->route('admin.table.index');
        }

    }
    public function getedit($id)
    {
        $value_item = table::find($id);
        $value_service = service::get();
        $data = array(
            'title'=>'sữa bảng',
            'value_frm'=>$value_item,
            'service'=>$value_service,
            'action'=>'admin.table.edit',
        );
        return view('admin.table.table_frm',$data);
    }
    public function postedit($id, Request $request)
    {
        $this->value_frm = $request->all();
        $validator  = Validator::make( $this->value_frm , [
            'name' => 'required|min:5|max:255',
        ],[
            'name.required' =>'Tên không được rổng',
            'name.min' =>'Tên không được nhỏ hơn 5 ký tự',
            'name.max' =>'Tên không được lớn hơn 255 ký tự',
        ]);
        
        if ($validator ->fails()) {


            $value_item = table::find($id);
            $value_service = service::get();
            $data = array(
                'title'=>'sữa bảng',
                'value_frm'=>$value_item,
                'service'=>$value_service,
                'action'=>'admin.table.edit',
            );
            return view('admin.table.table_frm',$data);
        }
        else
        {
            $table =  table::find($id);
            $table->name = $this->value_frm['name'];
            $table->header =  $this->value_frm['header'];
            $table->footer =  $this->value_frm['footer'];
            $table->id_sevice = $this->value_frm['linhvuc'];
            $table->update();
            $request->session()->flash('msg','Thêm thành công');
            return redirect()->route('admin.table.index');
        }
    }
    public function del($id, Request $request){
        $table = table::where('id',$id)->get();
        Schema::dropIfExists($table[0]['name_table']);
        $arItems = table::find($id);
        $arItems->delete();
        
        $request->session()->flash('msg','Xóa thành công');
        return redirect()->route('admin.table.index');
    }
}
