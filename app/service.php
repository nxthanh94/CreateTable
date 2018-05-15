<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class service extends Model
{
    protected $table = 'service';
    protected $primaryKey = 'id';
    public $timestamps = true;
}
