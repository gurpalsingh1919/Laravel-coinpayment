<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillingInfo extends Model
{
     public function user()
     {
        return $this->belongsTo('App\User', 'user_id', 'id')->select(['id', 'username','fullname','email']);
     }
}
