<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Activation;
use Sentinel;
use Mail;

class ActivationController extends Controller
{
    public function activate($email, $activationCode)
    {
        $user = User::whereEmail($email)->first();
        if(isset($user->id) && $user->id !='')
        {
            $sentinelUser = Sentinel::findById($user->id);
            

            if(Activation::complete($sentinelUser, $activationCode))
            {
                $user->status=1;
                if(isset($user->air_drop) && $user->air_drop =='1')
                {
                   $user->kwatt_balance=10; 
                   $user->air_drop='2';
                }
                else if(isset($user->air_drop) && $user->air_drop =='11')
                {
                   $user->kwatt_balance=11; 
                   $user->air_drop='12';
                }
                $user->save();
                
                Mail::send('emails.welcome',[
                    'user' => $user,
                ],function($message) use ($user) {
                    $message->to($user->email);
                    $message->subject("Hello $user->username, Congratulations");
                });
                return redirect('/login')->with(['success'=>" Your account is successfully Activated !!!"]);
            }
            else
            {
                Activation::remove($sentinelUser);
                return redirect('/login')->with(['error'=>" This link is expires. please try to login !!!"]);
            }
        }
        else
        {
            //$sentinelUser = Sentinel::findById(13);
           // Activation::remove($sentinelUser);
           return redirect('/login')->with(['error'=>" This link is expires. please try to login !!!"]); 
        }
        
    }
}
