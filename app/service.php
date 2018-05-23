<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class service extends Model
{
    protected $table = 'service';
    protected $primaryKey = 'id';
    public $timestamps = true;
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

