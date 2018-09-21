<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Referal extends Model
{
     public function user(){
    	return $this->belongsTo('App\User', 'user_id', 'id')->select(['id', 'username','fullname','email']);
    }

    public function ref_user(){
    	return $this->belongsTo('App\User', 'ref_user_id', 'id')->select(['id', 'username','fullname','email']);
    }
     public function aff_user(){
    	return $this->belongsTo('App\User', 'ref_user_id', 'id')->select(['id', 'fullname']);
    }


    public function token(){
    	return $this->belongsTo('App\Models\Buy', 'token_id', 'id')->select(['id', 'token','type','ico_amount']);
    }

   
}
