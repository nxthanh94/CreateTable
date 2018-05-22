<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class newspage extends Model
{
	protected $table = 'newspage';
    protected $primaryKey = 'id';
    public $timestamps = true;
}
