<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserKyc extends Model
{
    public function user(){
    	return $this->belongsTo('App\User', 'users_id', 'id')->select(['id', 'username','fullname','email']);
    }
}
