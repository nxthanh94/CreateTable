<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\service;
use App\newsservice;
class ServiceController extends MyController
{
	
    public $template = array (
		'sidebar'	=>'templates.public.index.sidebar',
		'content'	=>'templates.public.service.content'
	);
	public function getid($slug,$id)
	{
		$this->data['news_detail']	= newsservice::find($id);
		$this->data['template'] = $this->template;
		return view('templates.public.index',$this->data);
	}
	
	
}
