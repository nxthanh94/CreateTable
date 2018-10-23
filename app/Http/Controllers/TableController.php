<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\service;
use App\process;
use App\table;
use App\collums;
use App\groupcollums;
use Excel;
use PDF;
use QrCode;
use Illuminate\Support\Facades\DB;

class TableController extends MyController
{
	public $template = array (
		'sidebar'	=>'templates.public.index.sidebar',
		'content'	=>'templates.public.table.content'
	);

    public function getid($slug,$id)
    {
    	$collums = collums::where('id_table',$id)->orderBy('stt','ASC')->get();$table_info = table::find($id);
        if(Schema::hasTable($table_info['name_table']))
        {
            $table = DB::table($table_info['name_table'])->orderBy('stt','ASC')->get();
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
        else
        {
            echo 'Bảng chưa được tạo hoàn chỉnh! vui lòng về lại <a href="'.route('index').'">trang chủ</a>';
        }
    	
    }
    public function addrow(Request $request)
    {
    	$id = $request->name_table;
    	$id_user = $request->id_user;
    	$table_info = table::find($id);
    	$collums = collums::where('id_table',$table_info['id'])->orderBy('stt','ASC')->get();
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
        $collums = collums::where('id_table',$id)->orderBy('stt','ASC')->get();
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
        $return['stt'] =$this->create_stt($table_info['name_table'])-1;
        echo json_encode($return);
    }
    public function delrow(Request $request)
    {
        $id = $request->id;
        $id_table =$request->id_table;
        $return = '';
        if(count($id)>0)
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
    public function viewtable($slug, $id)
    {
        $this->template = array (
        'sidebar'   =>'templates.public.index.sidebar',
        'content'   =>'templates.public.table.viewtable'
        );

        $table_info = table::find($id);
        $collums = collums::where('id_table',$id)->where('showview', 1)->orderBy('stt','ASC')->get();
        $value_table = DB::table($table_info['name_table'])->orderBy('stt','ASC')->get();
        $groupcollums = groupcollums::where('id_table',$id)->get();
        $header = $table_info['header'];
        $footer = $table_info['footer'];
        $style ='';
        $text_str = '<table class="table table-bordered" style="'.$style.'">';
        $text_content = '';
        $text_end = '</table>';
        $text_content   .= $this->create_header_table_html($collums,$groupcollums);
        $text_content   .= $this->create_content_table_html($collums,$value_table);
        $this->data['title'] = $table_info['name'];
        $this->data['template'] = $this->template;
        $this->data['table_info'] = $table_info;
        $this->data['content'] = $header.$text_str.$text_content.$text_end.$footer;
        return view('templates.public.index',$this->data);
    }
    public function create_header_table_html($collums,$groupcollums)
    {
       $return ="";
        if(count($groupcollums)<=0)
        {
            $text_str = '<thead style="font-weight: bold; width: 100%"><tr>';
            $text_content = '';
            $text_end = '</thead></tr>';
            $text_content .= '<th>';
            $text_content .= 'STT';
            $text_content .= '</th>';
            foreach ($collums as $item) {
                $text_content .= '<th>';
                $text_content .= $item['name'];
                $text_content .= '</th>';
            }
            $return = $text_str.$text_content.$text_end;
        }
        else
        {
            $text_str = '<thead style="font-weight: bold; width: 100%">';
            $text_content = '';
            $text_end = '</thead>';
            $text_content_str ='<tr align="center">';
            $text_content_end ='</tr >';
            $text_content .= '<td rowspan="2">';
            $text_content .= 'STT';
            $text_content .= '</td>';
            //row 2
            $text_content_str2 ='<tr>';
            $text_content_end2 ='</tr>';
            $text_content2 = '';
            for ($i =0; $i<count($collums); $i++) {
               if($collums[$i]['id_group']>0)
               {
                    $item_groupcollums = groupcollums::find($collums[$i]['id_group']);
                    if(count($item_groupcollums)>0)
                    {
                        $collums_group = collums::where('id_group',$item_groupcollums['id'])->get();
                        $text_content .= '<td align="center" colspan="'.count($collums_group).'">';
                        $text_content .=  $item_groupcollums['name'];
                        $text_content .= '</td>';
                        foreach ($collums_group as  $value) {
                            $text_content2 .= '<td>';
                            $text_content2 .= $value['name'];
                            $text_content2 .= '</td>';
                        }
                        $i = $i + count($collums_group) -1;
                    }
                    else
                    {
                        $text_content .= '<td align="center" rowspan="2">';
                        $text_content .= $collums[$i]['name'];
                        $text_content .= '</td>';
                    }
               }
               else
               {
                    $text_content .= '<td align="center" rowspan="2">';
                    $text_content .= $collums[$i]['name'];
                    $text_content .= '</td>';
               }
               $return = $text_str.$text_content_str.$text_content.$text_content_end.$text_content_str2.$text_content2.$text_content_end2.$text_end;
            }
        }
        return  $return;
    }
    public function create_row_table_html ($collums,$value)
    {
        $text_str = '<tr style="width: 100%">';
        $text_content = '';
        $text_end = '</tr>';
         $text_content .= '<td>';
                $text_content .= $value['stt'];
                $text_content .= '</td>';
        foreach ($collums as $item) {
            $text_content .= '<td>';
            $text_content .= $value[$item['label']];
            $text_content .= '</td>';
        }
        return $text_str.$text_content.$text_end;
    }
    public function create_content_table_html($collums,$data)
    {
        $text_str = '<tbody style="width: 100%">';
        $text_content = '';
        $text_end = '</tbody>';
        foreach ($data as $item) {
            $value = $this->changearray($item);
            $text_content .= $this->create_row_table_html($collums,$value);
        }
        return $text_str.$text_content.$text_end;
    }
    public function exportexcel($slug,$id)
    {
        $table_info = table::find($id);
        $table = DB::table($table_info['name_table'])->take(7)->get();
        $table_value = array();
        foreach ($table as $value) {
            unset($value->id);
            unset($value->id_user);
            $table_value[] = $this->changearray($value);
        }  
        Excel::create($table_info['name_table'], function($excel) use ($table_value){
        $excel->sheet('sheet 1', function($sheet) use ($table_value)
            {
                $sheet->fromArray($table_value);
            });
        })->download('xlsx');
    }
    public function exportpdf($slug,$id)
    {
        $this->template = array (
        'sidebar'   =>'templates.public.index.sidebar',
        'content'   =>'templates.public.table.viewtable'
        );

        $table_info = table::find($id);
        $collums = collums::where('id_table',$id)->where('showview', 1)->orderBy('stt','ASC')->get();
        $value_table = DB::table($table_info['name_table'])->orderBy('stt','ASC')->get();
        $groupcollums = groupcollums::where('id_table',$id)->get();
        $header = $table_info['header'];
        $footer = $table_info['footer'];
        $style ='width: 100%;';
        $text_str = '<table border="1" style="'.$style.'">';
        $text_content = '';
        $text_end = '</table>';
        $text_content   .= $this->create_header_table_html($collums,$groupcollums);
        $text_content   .= $this->create_content_table_html($collums,$value_table);
        $this->data['title'] = $table_info['name'];
        $this->data['template'] = $this->template;
        $this->data['table_info'] = $table_info;
        $this->data['content'] = $header.$text_str.$text_content.$text_end.$footer;
        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'Times-New-Roman']);
        $pdf = PDF::loadView('templates.public.table.viewpdf',$this->data);
        return $pdf->download($table_info['name_table'].'.pdf');
    }

    public function create_qrcode(Request $request)
    {
        if($request->ajax() && count($request->id) > 0)
        {
            $tableId = $request->id_table;
            $id = $request->id[0];
            $text_qrcode =route('table.qrcodeview', [$tableId, $id]);
        }

        $img_qrcode = '<img src="data:image/png;base64,'.base64_encode(QrCode::encoding('UTF-8')->format('png')->size(200)->generate( $text_qrcode)).'">';
        $data = ['img_qrcode' =>$img_qrcode , 'tb' =>'ok'];
        return json_encode($data);
    }

    public function viewQrCode($tableId, $id)
    {
        $table_info = table::find($tableId);
        $userId = process::find($table_info->id_process)->id_user;
        $processUser =process::where('id_user', $userId)->select('id')->get();
        $qrcodeId = DB::table($table_info->name_table)->where('id',$id)->get();
        $qrcodeId = (array) $qrcodeId[0];
        $collums = collums::where('id_table',$tableId)->orderBy('stt','ASC')->get();
        $collumsQrCode = collums::where('id_table',$tableId)->where('ex_qrcode', 1)->get();
        $tableQrCode = [];

        if(count($collumsQrCode) > 0){

            $isDate = $this->findCollumDate($collums);
            $labelDate = '';
            $valueDate = '';
            if($isDate !== false && is_numeric($isDate)) {
                $labelDate = $collums[$isDate]['label'];
                $valueDate = $qrcodeId[$labelDate];
            }
            $tableQrCode = collums::where('label', $collumsQrCode[0]['label'])->wherein('id_process', $processUser)->get();
        }

        $dataQrCode = [];

        if(count($tableQrCode) > 0){
            foreach($tableQrCode as $item)
            {
                $tableItem = table::find($item->id_table);
                $collums = collums::where('id_table',$item->id_table)->where('showqrcode', 1)->orderBy('stt','ASC')->get();
                if ($isDate !== false && is_numeric($isDate)) {
                    $isDateTable =  $this->findCollumDate($collums);
                    $labelDateTable = '';
                    if($isDate !== false && is_numeric($isDate)) {
                        $labelDateTable = $collums[$isDateTable]['label'];
                        $valueTable = DB::table($tableItem->name_table)->where($collumsQrCode[0]['label'],$qrcodeId[$collumsQrCode[0]['label']])->whereDate($labelDateTable, '>=', $valueDate)->orderBy('stt','ASC')->get();
                    }
                }else {
                    $valueTable = DB::table($tableItem->name_table)->where($collumsQrCode[0]['label'],$qrcodeId[$collumsQrCode[0]['label']])->orderBy('stt','ASC')->get();
                }
                $dataQrCode[] = [
                    'ten' => $tableItem->name,
                    'items' => $valueTable,
                    'collums' => $collums
                ];
            }
        }

        return view('templates.public.table.view_qrcode', ['data'=>$dataQrCode]);
    }

    public function findCollumDate($collums)
    {
        $isDate = false;
        foreach ($collums as $key => $collum)
        {
            if ($collum['type'] == 'date') {
                $isDate = $key;
            }
        }
        return $isDate;
    }

    public function create_text_qrcode ($collums,$value)
    {
        $text_content = "";
        foreach ($collums as $item) {
            $text_content .= mb_strtoupper($item['name'], "UTF-8").': ';
            $text_content .= $value[$item['label']];
            $text_content .= '%0D%0A';
        }
        return $text_content;
    }

    public function search(Request $request)
    {
         if($request->ajax()){
            $table_info = table::find($request->id_table);
            $field = collums::find($request->field_search);
            if(count($field) > 0){
                if($field['type'] == 'sting' || $field['type'] = 'text'){
                    $table = DB::table($table_info['name_table'])->where($field['label'],'like','%'.$request->free_text.'%')->orderBy('stt','ASC')->get();;
                }else{
                    $table = DB::table($table_info['name_table'])->where($field['label'],$request->free_text)->orderBy('stt','ASC')->get();;
                }
                $collums = collums::where('id_table',$request->id_table)->orderBy('stt','ASC')->get();
                $text_row ="";
                foreach ($table as $key => $item) {
                    $ar_row = $this->changearray($item);
                    $text_row .= $this->create_row($table_info['name_table'],$collums,$ar_row);
                }
                return json_encode(['data'=> $text_row, 'code' => 200]);
            }else{
                return json_encode(['data'=> 'Không tìm thấy dữ liệu', 'code' => 401]);
            }
         }

    }
}
