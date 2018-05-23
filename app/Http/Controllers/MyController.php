<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\service;
use App\newsservice;

class MyController extends Controller
{
    public $template = array (
		'sidebar'	=>'templates.public.index.sidebar',
		'content'	=>'templates.public.index.index'
	);
	public $data = array('title'=>'VQS - Viêt Quatily');
	public function __construct()
	{
		$this->data['service'] = $this->getservice_all();
		$this->data['template'] = $this->template;
	}
	public function getservice_all()
	{
		$ArService = array();
    	$service_cat = service::get();

    	foreach ($service_cat as $item) {
    		$item_newsservice = newsservice::where('id_service',$item['id'])->get();
    		$ArService[] = array(
    			'service_cat'=>$item,
    			'newsservice'=>$item_newsservice,
    		);
    	}
    	return $ArService;
	}
}
