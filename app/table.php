<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class table extends Model
{
    protected $table ='table';
    protected $primarykey = 'id';
    public $timestamps =true;
}
