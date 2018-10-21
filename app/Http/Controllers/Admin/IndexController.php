<?php

namespace App\Http\Controllers\Admin;

use App\service;
use App\table;
use App\user;
use App\process;
use App\tableasuser;
use Illuminate\Http\Request;
use App\notification;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index(){
        $table = table::get();
        $service = service::get();
        $users = user::get();
        $rePort = [];
        $process = process::get();
        $notification = notification::where('general', '=', 1)->orderBy('id','DSC')->limit(10,0)->get();
        $data = [
            'table' => $table,
            'service' => $service,
            'users' => $users,
            'rePort' => $rePort,
            'process' => $process,
            'notification' => $notification,
        ];
    	return view('admin.index.index', $data);
    }
}
