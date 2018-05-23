<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\service;
use App\newsservice;
use App\table;
use App\tableasuser;
use Illuminate\Support\Facades\Auth;

class MyController extends Controller
{
    public $template = array (
		'sidebar'	=>'templates.public.index.sidebar',
		'content'	=>'templates.public.index.index'
	);
	public $data = array('title'=>'VQS - Viêt Quatily', 'table'=>array(),'process'=>array());

	public function __construct()
	{
		$this->data['service'] = $this->getservice_all();
		$this->data['template'] = $this->template;
		/*if(session::has('id_user'))
		{
			$id_user  = Session::get('id_user');
			$id_phanquyen = Session::get('id_phanquyen');
			if( $id_phanquyenn==1 || $id_phanquyen==2 )
			{
				$table = table::get();		
			}
			else
			{
				$table_ofuser = tableasuser::where('id_user',$id_user)->get();	
				$arTable = array();
				foreach ($table_ofuser as $key => $item) {
					$arTable[] = $item['id_table'];
				}
				$table = table::whereIn('id',$arTable)->get();
				
			}
			$this->data['table'] = $table;
			
		}*/
	
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
