<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Utransaction extends Model
{
	
    function get_user_info()
    {
        return  $this->belongsTo('App\User','user_id','id')->select(['id', 'username','fullname','email']);
    }
    function get_approved_info()
    {
        return  $this->belongsTo('App\User','approve_by','id')->select(['id', 'username','fullname','email']);
    }
}
