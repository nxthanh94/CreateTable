<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\newspage;

class IndexController extends Controller
{
	public $template = array (
		'sidebar'	=>'templates.public.thems.layout.sidebar',
		'content'	=>'templates.public.index.index'
	);
    public function index()
    {
    	$about = newspage::where('type_news','about')->get();
    	$data = array(
    		'template'	=>$this->template,
    		'title'		=>'Giới thiệu phần mềm Viêt Soft',
    		'about'		=>$about[0],
    	);
    	return  view('templates.public.index',$data);
    }
}
