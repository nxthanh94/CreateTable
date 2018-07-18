<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\table;
use App\process;
use App\process_table;
use PDF;

class ProcessController extends MyController
{
    public $template = array (
		'sidebar'	=>'templates.public.index.sidebar',
		'content'	=>'templates.public.process.content'
	);
	public function getid($slug,$id)
	{
		$process = process::find($id);

		$table = table::where('id_process',$id)->get();
		$this->data['title'] = $process['name'];
		$this->data['template'] = $this->template;
		$this->data['process_info'] = $process;
		$this->data['table_pro'] = $table;
		$this->data['create_pdf'] = route('process.export-ddf',$id);
		return view('templates.public.index',$this->data);
	}
	public function exportPdf($id)
	{
		$process = process::find($id);

		$table = table::where('id_process',$id)->get();
		$this->data['title'] = $process['name'];
		$this->data['template'] = $this->template;
		$this->data['process_info'] = $process;
		$this->data['table_pro'] = $table;
		$this->data['create_pdf'] = route('process.export-ddf',$id);
		PDF::setOptions(['dpi' => 150, 'defaultFont' => 'Times-New-Roman']);
        $pdf = PDF::loadView('templates.public.process.exportpdf',$this->data);
        return $pdf->download($process['name'].'.pdf');	
	}
}
