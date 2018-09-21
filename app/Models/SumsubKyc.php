<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SumsubKyc extends Model
{
     public function user()
     {
        return $this->belongsTo('App\User', 'user_id', 'id')->select(['id', 'username','fullname','email']);
     }
}
