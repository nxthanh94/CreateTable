<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\collums;
use App\relationship;
use App\table;
use Validator;

class RelationshipController extends Controller
{
    public $value_frm = array(
        'id'=>null,
        'id_table_pri' =>0,
        'col_pri' => 0,
        'id_table_for' => 0,
        'col_for' => 0,
        'get_id' => 1,
        'id_process' => 0,
    );

    public function index($id_process)
    {
        $relationship = relationship::where('id_process', $id_process)->get();
        $data = [
            'arItems' => $relationship,
            'id_process' =>$id_process,
            'title'=>'Quản lý quan hệ bảng'
        ];
        return view('admin.relationship.index',$data);
    }

    public function create($id_process)
    {
        $tableList = table::where('id_process', $id_process)->get();
        $data = array(
            'value_frm' => $this->value_frm,
            'tableList' => $tableList,
            'title'=>'Thêm quan hệ bảng',
            'action'=>route('admin.relationship.createpost', $id_process),
            'id'=>$id_process,
        );
        return view('admin.relationship.relationship_frm',$data);
    }

    public function doCreate($id_process, Request $request)
    {
        try {
            DB::beginTransaction();
            $this->value_frm = $request->all();
            $validator  = Validator::make( $this->value_frm , [
                'id_table_pri' => 'required|integer|min:1',
                'col_pri' => 'required|integer|min:1',
                'id_table_for' => 'required|integer|min:1',
                'col_for' => 'required|integer|min:1',
            ]);
            $doubleTable = false;
            if($request->id_table_pri == $request->id_table_for) {
                $doubleTable = true;
            }

            if ($validator ->fails() || $doubleTable) {
                $tableList = table::where('id_process', $id_process)->get();
                $data = array(
                    'value_frm' => $this->value_frm,
                    'tableList' => $tableList,
                    'title'=>'Thêm quan hệ bảng',
                    'action'=>route('admin.relationship.createpost', $id_process),
                    'id'=>$id_process,
                    'errors' => $validator->errors(),
                );
                return view('admin.relationship.relationship_frm',$data);
            }
            else
            {
                $relationship = new relationship;
                $relationship->id_table_pri = $request->id_table_pri;
                $relationship->col_pri = $request->col_pri;
                $relationship->id_table_for = $request->id_table_for;
                $relationship->col_for = $request->col_for;
                $relationship->id_process = $id_process;
                $relationship->save();
                $request->session()->flash('msg','Thêm thành công');
                return redirect()->route('admin.relationship.index',$id_process);
            }

        } catch (Exception $ex) {
            $request->session()->flash('msg','Thêm không công');
            return redirect()->route('admin.relationship.index',$id_process);
            DB::rollBack();
        }
    }

    public function edit($id)
    {
        $relationship = relationship::find($id);
        if(!empty($relationship)) {
            $id_process = $relationship['id_process'];
            $tableList = table::where('id_process', $id_process)->get();
            $colPri = collums::where('id_table', $relationship['id_table_pri'])->get();
            $colFor = collums::where('id_table', $relationship['id_table_for'])->get();
            $data = array(
                'value_frm' => $relationship,
                'tableList' => $tableList,
                'title'=>'Sửa quan hệ bảng',
                'action'=>route('admin.relationship.editpost', $id),
                'id'=> $id_process,
                'colPri' => $colPri,
                'colFor' => $colFor,
            );
            return view('admin.relationship.relationship_frm',$data);
        } else {
            return redirect()->back()->with('msg', 'Không tìm thấy quan hệ của bảng');
        }
    }

    public function doEdit($id, Request $request)
    {
        try {
            $relationship = relationship::find($id);
            if(!empty($relationship)) {
                DB::beginTransaction();
                $id_process = $relationship['id_process'];
                $this->value_frm = $request->all();
                $validator  = Validator::make( $this->value_frm , [
                    'id_table_pri' => 'required|integer|min:1',
                    'col_pri' => 'required|integer|min:1',
                    'id_table_for' => 'required|integer|min:1',
                    'col_for' => 'required|integer|min:1',
                ]);
                $doubleTable = false;
                if($request->id_table_pri == $request->id_table_for) {
                    $doubleTable = true;
                }

                if ($validator ->fails() || $doubleTable) {
                    $tableList = table::where('id_process', $id_process)->get();
                    $colPri = collums::where('id_table', $relationship['id_table_pri'])->get();
                    $colFor = collums::where('id_table', $relationship['id_table_for'])->get();
                    $data = array(
                        'value_frm' => $relationship,
                        'tableList' => $tableList,
                        'title'=>'Sửa quan hệ bảng',
                        'action'=>route('admin.relationship.editpost', $id),
                        'id'=> $id_process,
                        'colPri' => $colPri,
                        'colFor' => $colFor,
                        'errors' => $validator->errors(),
                    );
                    return view('admin.relationship.relationship_frm',$data);
                }
                else
                {
                    $relationship->id_table_pri = $request->id_table_pri;
                    $relationship->col_pri = $request->col_pri;
                    $relationship->id_table_for = $request->id_table_for;
                    $relationship->col_for = $request->col_for;
                    $relationship->id_process = $id_process;
                    $relationship->update();
                    $request->session()->flash('msg','Sửa thành công');
                    return redirect()->route('admin.relationship.index',$id_process);
                }
            } else {
                return redirect()->back()->with('msg', 'Không tìm thấy quan hệ của bảng');
            }

        } catch (Exception $ex) {
            $request->session()->flash('msg','Thêm không công');
            return redirect()->route('admin.relationship.index',$id_process);
            DB::rollBack();
        }
    }

    public function del($id)
    {
        $relationship = relationship::find($id);
        if(!empty($relationship)) {
            $id_process = $relationship['id_process'];
            $relationship->delete();
            return redirect()->route('admin.relationship.index',$id_process)->with('msg','Xóa thành công');
        } else {
            return redirect()->back()->with('msg', 'Không tìm thấy quan hệ của bảng');
        }
    }

    public function ajaxGetCollums(Request $request)
    {
        if ($request->ajax() && !empty($request->table_id)) {
            $collums = collums::where('id_table', $request->table_id)->get();
            $value = '<option value="">--</option>';
            if (!empty($collums)) {
                foreach ($collums as $collum)
                {
                    $value .=  '<option value="'.$collum['id'].'">'.$collum['name'].'</option>';
                }
            }
            return json_encode($value);
        }
    }
}
