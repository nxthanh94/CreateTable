<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\table;
use App\process;
use App\process_table;

class ProcessController extends MyController
{
    public $template = array (
		'sidebar'	=>'templates.public.index.sidebar',
		'content'	=>'templates.public.process.content'
	);
	public function getid($slug,$id)
	{
		$process = process::find($id);

		$table = process_table::join('table','table.id','=','process_table.id_table')
                                            ->where('process_table.id_process','=',$process['id'])
                                            ->select('table.*')->get();
		$this->data['title'] = $process['name'];
		$this->data['template'] = $this->template;
		$this->data['process_info'] = $process;
		$this->data['table_pro'] = $table;
		return view('templates.public.index',$this->data);
	}
}
