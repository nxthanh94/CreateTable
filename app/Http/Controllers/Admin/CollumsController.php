<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\service;
use App\table;
use App\collums;

class CollumsController extends Controller
{
	public $value_frm = array(
		'id'=>null,
		'name'=>'',
		'lable'=>'',
		'type'=>'varchar',
		'value'=>null,
		'id_table'=>null,
		'id_sevice' =>null,
	);
	public $type = array(
		'int'=>'Số nguyên ',
		'float' => 'Số thực',
		'tinyInteger'=>'Logic',
		'date'=>'Ngày tháng',
		'string'=>'Tên',
		'text'=>'Văn bản'
	);
    public $colums_table;
    public function index($id_table)
    {
        $collums = collums::where('id_table',$id_table)->orderBy('stt','asc')->get();
        if(count($collums)>0)
        {
             $data = array(
            'arItems'=> $collums,
            'title'=>'Quảng lý table',
            );
            return view('admin.collums.index',$data);
        }
        else
        {
            return redirect()->route('admin.collums.add');
        }
       
    }
    public function addget()
    {
    	$data = array(
    		'value_frm'	=>$this->value_frm,
    		'table'		=> table::get(),
    		'service'	=> service::get(),
    		'action' 	=> 'admin.collums.add',
    		'title' 	=>'Thêm cột',
    		'type' 		=>$this->type,
    	);
    	return view('admin.collums.collums_frm',$data);
    }
    public function addpost(Request $request)
    {
    	$data_frm = $request->all();
    	$data_name = $data_frm['name'];
    	$data_name = array_unique($data_name);
    	if(count($data_name)!=count($data_frm['name']))
    	{
    		$data_frm['id'] =null;
    		$data = array(
    		'value_frm'	=> $data_frm,
    		'table'		=> table::get(),
    		'service'	=> service::get(),
    		'action' 	=> 'admin.collums.add',
    		'title' 	=> 'Thêm cột',
    		'type' 		=> $this->type,
	    	);
	    	return view('admin.collums.collums_frm',$data);
    	}
    	else
    	{
            $id_table = $data_frm['id_table'];
            $name_table = table::where('id',$id_table)->get();
            if(!Schema::hasTable($name_table[0]['name_table']))
            {
                for ($i=0 ; $i < count($data_frm['name']) ; $i++) { 
                $table = new collums;
                $labe = str_replace("-","_",str_slug($data_frm['name'][$i]));
                $table->id_table = $data_frm['id_table'];
                $table->id_sevice = $data_frm['id_sevice'];
                $table->null = 1;
                $table->stt = $i+1;
                $table->name = $data_frm['name'][$i];
                $table->type = $data_frm['type'][$i];
                $table->label =$labe;
                $table->save();
                }
                
                $colums = collums::where('id_table',$id_table)->get();
                //$colums = array_unique($data_name);
                if($this->create_table_user($colums,$name_table[0]['name_table'])==true)
                {
                    $request->session()->flash('msg','Thêm thành công');
                    return redirect()->route('admin.table.index');
                }
                else
                {
                    $request->session()->flash('msg','Bảng đã được tạo không thể tạo thêm bảng này!');
                    return redirect()->route('admin.table.index');
                }
            }
            else
            {
                $request->session()->flash('msg','Bảng đã được tạo không thể tạo thêm bảng này!');
                return redirect()->route('admin.table.index');
            }
    	}

    }
    public function gettable_ajax(Request $request)
    {
    	if($request->ajax())
    	{
    		$id = $request->id_sevice;
    		$table_list = table::where('id_sevice',$id)->get();
    		$text ='';
    		foreach ($table_list as $key => $item) {
    			$text .= '<option value="'.$item['id'].'">'.$item['name'].'</option>';
    		}
    		$return['value'] = $text;
    		echo json_encode($return);
    	}
    	
    }
    public function change_value(Request $request)
    {
        if($request->ajax())
        {
            $table_name = $request->table;
            $id = $request->id;
            $collums = $request->collums;
            $value = $request->value;
            DB::table($table_name)
            ->where('id', $id)
            ->update([$collums => $value]);
            $return['tb'] = 'ok';
            echo json_encode($return);
        }
    }
    public function create_table_user($colums,$table_name)
    {
        
        
            $this->colums_table = $colums;
            schema::create($table_name,function($table){
                $table->Increments('id');
                $table->Integer('stt');
                foreach ($this->colums_table as $item) {
                    switch ($item['type']) {
                        case 'int':
                            $table->integer($item['label']);
                            break;

                        case 'float':
                            $table->float($item['label']);
                            break;

                        case 'tinyInteger':
                            $table->tinyInteger($item['label']);
                            break;

                        case 'date':
                            $table->date($item['label']);
                            break;

                        case 'string':
                            $table->string($item['label']);
                            break;

                        case 'text':
                            $table->text($item['label']);
                            break;
                        default:
                            break;
                    }
                }
            });
            return true;
	   
    }
    public function edit_table_colum($table_name,$collums)
    {
        $this->colums_table = $collums;
        Schema::table($table_name, function($table)
        {
             foreach ($this->colums_table as $item) {
                switch ($item['type']) {
                        case 'int':
                            $table->integer($item['label'])->change();;
                            break;

                        case 'float':
                            $table->float($item['label'])->change();;
                            break;

                        case 'tinyInteger':
                            $table->tinyInteger($item['label'])->change();;
                            break;

                        case 'date':
                            $table->date($item['label'])->change();;
                            break;

                        case 'string':
                            $table->string($item['label'])->change();;
                            break;

                        case 'text':
                            $table->text($item['label'])->change();;
                            break;
                        default:
                            break;
                    }
            }
        });
    }
    public function  rename_table_collums($table_name,$old_collums,$new_collums)
    {
        $data  = array('old_collums' =>$old_collums ,'new_collums' => $new_collums );
        $this->collums = $data;
        Schema::table($table_name, function($table)
        {
            $table->renameColumn($this->collums['old_collums'], $this->collums['new_collums']);
        });
    }
    public function del_table_collums($table_name, $collums)
    {
        $this->collums =$collums;
        Schema::table($table_name, function($table)
        {
            $table->dropColumn($this->collums);
        });
    }
    public function getedit($id)
    {
        $data = array(
            'title' =>'Sửa cột',
            'action'=>'admin.collums.edit',
            'type'=>$this->type,
            'value_frm'=>collums::find($id),
        );
        return view('admin.collums.collums_frm_edit',$data);
    }
    public function postedit($id, Request $request)
    {
        
        $value_old = collums::where('id',$id)->get();
        $table =  collums::find($id);
        $table->name= $request->name;
        $table->type= $request->type;
        $table->label = str_replace("-","_",str_slug($request->name));
        $table->update();
        $collums = collums::where('id',$id)->get();
        $table_name = table::where('id',$value_old[0]['id_table'])->get();
        $this->rename_table_collums($table_name[0]['name_table'],$value_old[0]['label'],$collums[0]['label']);
        if($request->type!=$value_old[0]['type'])
        {
            $collums = collums::where('id',$id)->get();
            $this->edit_table_colum($table_name[0]['name_table'],$collums);

            $request->session()->flash('msg','Xóa thành công');
            return redirect()->route('admin.collums.index',$table_name[0]['id']);
        }
        else
        {
            return redirect()->route('admin.collums.edit',$id);
        }
    }
    public function del($id, Request $request)
    {
         $value_del =  collums::where('id',$id)->get();
         $table_name = table::where('id',$value_del[0]['id_table'])->get();
         if(count($value_del)>0)
         {
            $this->del_table_collums($table_name[0]['name_table'],$value_del[0]['label']);
            $table = collums::find($id);
            $table->delete(); 
            $request->session()->flash('msg','Xóa thành công');
            return redirect()->route('admin.collums.index',$table_name[0]['id']);
        }
         else
        {
             $request->session()->flash('msg','Cột không tồn tại');
            return redirect()->route('admin.table.index');
        }
    }
}