<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
     public function user_from(){
    	return $this->belongsTo('App\User', 'from_user', 'id')->select(['id', 'username','fullname','email']);
    }

     public function user_to(){
    	return $this->belongsTo('App\User', 'to_user', 'id')->select(['id', 'username','fullname','email']);
    }

     
}
