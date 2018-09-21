<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','btc_address','total_btc','total_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    function referral()
  {
    return  $this->hasMany('App\Models\Referal', 'user_id', 'parent_id')->select('ref_amount')->groupBy('user_id');
  }

   public function kycdetails()
    {
        //echo "asdfasd";die;
        return  $this->hasMany('App\Models\UserKyc', 'users_id', 'id');
    }
}
