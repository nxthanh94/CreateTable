<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\service;
use App\table;
use App\collums;
use App\groupcollums;
use Illuminate\Support\Facades\DB;

class TableController extends MyController
{
	public $template = array (
		'sidebar'	=>'templates.public.index.sidebar',
		'content'	=>'templates.public.table.content'
	);
    public function getid($slug,$id)
    {
    	$collums = collums::where('id_table',$id)->get();
    	$table_info = table::find($id);
    	$table = DB::table($table_info['name_table'])->get();
        $text_row ="";
        foreach ($table as $key => $item) {
            $ar_row = $this->changearray($item);
            $text_row .= $this->create_row($table_info['name_table'],$collums,$ar_row);
        }
    	$this->data['title'] = $table_info['name'];
    	$this->data['collums'] = $collums;
    	$this->data['rows'] = $text_row;
    	$this->data['template'] = $this->template;
    	$this->data['table_info'] = $table_info;
        $this->data['stt'] = $this->create_stt($table_info['name_table']) - 1;
    	return view('templates.public.index',$this->data);
    }
    public function addrow(Request $request)
    {
    	$id = $request->name_table;
    	$id_user = $request->id_user;
    	$table_info = table::find($id);
    	$collums = collums::where('id_table',$table_info['id'])->get();
    	$data_df = $this->create_value_df($collums);
    	$data_df['id_user'] = $id;
    	$data_df['stt'] = $this->create_stt($table_info['name_table']);
        DB::table($table_info['name_table'])->insert($data_df);
        $id_row = DB::table($table_info['name_table'])->max('id');
        $row = DB::table($table_info['name_table'])->where('id','=',$id_row)->get();
        $ar_row = $this->changearray($row[0]);
        $text_row = $this->create_row($table_info['name_table'],$collums,$ar_row);
        $return['value'] = $text_row;
        $return['stt'] =$data_df['stt'];
        echo json_encode($return);

    }
    public function copyrow(Request $request)
    {
        $id = $request->id_table;
        $stt = $request->stt;
        $table_info = table::find($id);
        $collums = collums::where('id_table',$id)->get();
        $rowcopy =  DB::table($table_info['name_table'])->where('stt','=',$stt)->get();
        $text_row ="";
        foreach ($rowcopy as $key => $item) {
            $val_copy = $this->changearray($item);
            $val_copy['stt']= $this->create_stt($table_info['name_table']);
            $text_row .= $this->create_row($table_info['name_table'],$collums, $val_copy);
            unset($val_copy['id']);
            
            DB::table($table_info['name_table'])->insert($val_copy );
            
        }
        $return['value'] = $text_row;
        $return['stt'] =$this->create_stt($table_info['name_table']);
        echo json_encode($return);
    }
    public function delrow(Request $request)
    {
        $id = $request->id;
        $id_table =$request->id_table;
        $return = '';
        if(count($id)>1)
        {
             $table_info = table::find($id_table);
            foreach ($id as $value) {
                $this->del_id($value,$table_info['name_table']);
            }
            $return ='ok';
        }
        else
        {
            $return ='Xoá không thành công';
        }
        echo json_encode(array('tb'=>$return));

    }
    public function del_id($id,$name_table)
    {
        DB::table($name_table)->where('id', '=', $id)->delete();
    }
    public function create_value_df($collums)
    {
    	$data_df = array();
    	foreach ($collums as $item) {
            switch ($item['type']) {
                case 'int':
                    $data_df[$item['label']] = 0;
                    break;

                case 'float':
                    $data_df[$item['label']] = 0;
                    break;

                case 'tinyInteger':
                    $data_df[$item['label']] = 0;
                    break;

                 case 'date':
                    $data_df[$item['label']] = date('Y-m-d');
                    break;

                case 'string':
                    $data_df[$item['label']] = "";
                    break;

                case 'text':
                    $data_df[$item['label']] = "";
                    break;
                default:
                    $data_df[$item['label']] = null;
                    break;
                }
        }
        return $data_df;
    }
    public function create_row($name_table,$collums,$value)
    {

        $text = '<tr>';
        $text .= '<td>';
        $text .= '<input type="checkbox" class="checkbox_item checkbox" name="check_id" value="'.$value['id'].'">';
        $text .= '</td>';
        $text .= '<td>';
        $stt = $value['stt'];
        $table = "'".$name_table."'";
        $name_collums = "'stt'";
        $id = $value['id'];
        $val = 'this.value';
        $option = 'onblur="updatecollums('.$table.','.$id.','.$name_collums.','. $val.');"';

        $text .= '<input type="text" class="text_stt" name="stt" value="'.$stt.'" '.$option.'>';
        $text .= '</td>';
        foreach ($collums as $item) {
            $text .= '<td>';
            $table = "'".$name_table."'";
            $name_collums = "'".$item['label']."'";
            $id = $value['id'];
            $val = 'this.value';
            $option = 'onblur="updatecollums('.$table.','.$id.','.$name_collums.','. $val.');"';
            switch ($item['type']) {
                case 'int':
                    $text .= '<input type="text"  name="'.$item['label'].'" value="'.$value[$item['label']].'" '.$option.'>';
                    break;

                case 'float':
                    $text .= '<input type="text" name="'.$item['label'].'" value="'.$value[$item['label']].'" '.$option.'>';
                    break;

                case 'tinyInteger':
                {
                    $checked ='';
                    if($value[$item['label']]==1)
                    {
                        $checked ='checked="true"';
                    }
                    $text .= '<input type="checkbox" class="checkbox" name="'.$item['label'].'" '. $checked.' value="'.$value[$item['label']].'" '.$option.'>';
                    break;    
                }
                 case 'date':
                    $text .= '<input type="date"name="'.$item['label'].'"  value="'.$value[$item['label']].'" '.$option.'>';
                    break;
                    break;

                case 'string':
                   
                    $text .= '<input type="text" name="'.$item['label'].'"  value="'.$value[$item['label']].'" '.$option.'>';
                    break;

                case 'text':
                    $text .= '<input type="text" name="'.$item['label'].'"  value="'.$value[$item['label']].'" '.$option.'>';
                    break;
                default:
                    $text .= '<input type="text" name="'.$item['label'].'"  value="'.$value[$item['label']].'" '.$option.'>';
                    break;
                }
             $text .= '</td>';
        }
        $text .= '</tr>';
        return $text;
    }
    public function updatecollums(Request $request)
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
    public function create_stt($name_table)
    {
        $stt = DB::table($name_table)->max('stt');
        if($stt==null)
        {
            $stt = 1;
        }
        else
        {
           $stt = $stt +1; 
        }
        return $stt;
    }
    public function changearray($array)
    {
        $return = array();
        foreach ($array as $key => $value) {
            $return[$key] = $value;
        }
        return $return;
    }
    
}
