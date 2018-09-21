<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{	
     public function user_info(){
    	return $this->belongsTo('App\User', 'user_id', 'id')->select(['id', 'username','fullname','email']);
    }
}
