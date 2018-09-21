<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
  function referral()
  {
    return  $this->belongsTo('App\Models\Referal', 'parent_id', 'user_id')->select('*');
  }

}
