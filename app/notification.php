<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class notification extends Model
{
    protected $table = 'notification';
    protected $primaryKey = 'id';
    public $timestamps = true;
}
