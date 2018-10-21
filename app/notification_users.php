<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class notification_users extends Model
{
    protected $table = 'notification_users';
    protected $primaryKey = 'id';
    public $timestamps = true;
}
