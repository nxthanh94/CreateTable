<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\newspage;
use App\service;
use App\newsservice;

class IndexController extends MyController
{
	
    public function index()
    {

    	$about = newspage::where('type_news','about')->get();
    	$this->data['title'] = 'Giới thiệu phần mềm Viêt Soft';
    	$this->data['about'] = $about[0];
    	return  view('templates.public.index',$this->data);
    }
}
