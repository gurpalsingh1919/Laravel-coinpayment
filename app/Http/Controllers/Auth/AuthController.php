<?php

namespace App\Http\Controllers\Auth;

use Cache;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Http\Requests\ValidateSecretRequest;
use App\User;
use App\Models\Setting;
use Sentinel;


class AuthController extends Controller
{ 
    protected $redirectTo = '/user-dashboard';
    
   public function getValidateToken()
    {

         $setting_data=Setting::get();
        if (session('2fa:user:id')) {
            return view('auth/validate',compact('setting_data'));
        }
        return redirect('login',compact('setting_data'));
    }
   
    public function postValidateToken(ValidateSecretRequest $request)
    {
        //get user id and create cache key
        $userId = $request->session()->pull('2fa:user:id');
        $key    = $userId . ':' . $request->totp;

        //use cache to store token to blacklist
        Cache::add($key, true, 4);

        //login and redirect user
        $sentinel = app('sentinel');
        $user = $sentinel->findById($userId);
        $sentinel->login($user);

        return redirect('dashboard');
    }

    public function postValidateTokenDesable(ValidateSecretRequest $request)
    {

        //get user id and create cache key
        $userId = $request->session()->pull('2fa:user:id');
        $key    = $userId . ':' . $request->totp;

        //use cache to store token to blacklist
        Cache::add($key, true, 4);

        //login and redirect user
        $sentinel = app('sentinel');
        $user = $sentinel->findById($userId);
        $sentinel->login($user);
        return 1;
    }

    public function postValidateTokenenable(ValidateSecretRequest $request)
    {
        //get user id and create cache key
        //return $request->all();
        $userId = $request->session()->pull('2fa:user:id');
        $key    = $userId. ':' .$request->totp;

        //use cache to store token to blacklist
        Cache::add($key, true, 4);

        //login and redirect user
        $sentinel = app('sentinel');
        $user = $sentinel->findById($userId);
        $sentinel->login($user);
        return 1;
        
    }
   
}
