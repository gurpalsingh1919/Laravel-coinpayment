<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buy extends Model
{
    public function user(){
    	return $this->belongsTo('App\User', 'user_id', 'id')->select(['id', 'username','fullname','email']);
    }

    function user_info()
    {
        return  $this->hasOne('App\User', 'id','user_id');
    }
}
