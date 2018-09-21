<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
	
    function user_info()
    {
        return  $this->hasOne('App\User', 'id','user_id');
    }
}
