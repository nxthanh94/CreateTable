<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\table;
use App\collums;

class GroupcollumsController extends Controller
{
	public $data_frm =array(
		'id'			=>null,
		'name'			=>'';
		'id_collums'	=>null,
	);
    public function getadd($id_table)
    {
    	$data = array(
    		
    	);
    }
}
