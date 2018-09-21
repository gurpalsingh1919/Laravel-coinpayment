<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Reminder;
use Mail;
use Sentinel;
use Carbon\Carbon;
use Hash;
class ForgotController extends Controller
{
    public function forgotPassword(){
        return view('auth.forgot_password');
    }
    public function postForgotPassword(Request $request){

        $this->validate($request,[
            'email' => 'required|email',
        ]);

        $user = User::whereEmail($request->email)->first();
        //echo "<pre>";print_r($user->count());die;
        if(isset($user) && $user->count() >0){
            $sentinelUser = Sentinel::findById($user->id);
            if($user->count()==0)
                return redirect()->back()->with(['success'=>'Reset Code already sended to your email.']);

            $alpha_numeric = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            $reset_string = substr(str_shuffle(str_repeat($alpha_numeric, 8)), 0, 8);

            $reminder = Reminder::exists($sentinelUser) ? : Reminder::create($sentinelUser);
             $credentials = [
                'reset_code' => $reset_string
            ];
             Reminder::where('id', $reminder->id)->update($credentials);

             $this->sendResetPasswordEmail($user,$reminder->code,$reset_string);

            return redirect()->back()->with(['success'=>"Thanks! We have sent you a link in an email to reset your password." ]);
        }
        else{
            return redirect()->back()->with(['error'=>'Request failed: This email is not registered in our system, please re-enter and try again.']);
        }
    }


    public function resetPassword($email, $resetCode){


        $user = User::where('email',$email)->first();
        if(isset($user) && $user->count()==0)
            abort(404);

        $sentinelUser = Sentinel::findById($user->id);
        if($reminder = Reminder::exists($sentinelUser) ? : Reminder::create($sentinelUser)){
            $now = Carbon::now();
            $date = $reminder->created_at;
            $created = new Carbon($date);
            $totalDuration = $now->diffInSeconds($created);
            if($totalDuration>480){

                $credentials = [
                    'completed' => '1'
                ];
                $update = Reminder::where('id', $reminder->id)->update($credentials);
                return redirect('login')->with(['error'=>'Your reset password link has been expired !!!']);
            }
            if($reminder->token==0)

                return view('auth.forgot-token', compact('email', 'resetCode'));
            if($resetCode==$reminder->code){
                $forgot_token=$reminder->code;
                return view('auth.reset-password',compact('user','forgot_token'));
            }
            else
                return redirect('/login')->with(['error'=>'Your reset password link has been expired !!!']);
        }
        else{
            return redirect('/login')->with(['error'=>'Something went wrong !!!']);
        }
    }

    public function postResetPassword(Request $request,$email,$resetCode){
        $this->validate($request,[
            'token' => 'required|min:6|max:12',
        ]);
        $cur=1;

        $user = User::where('email',$email)->first();
        if(isset($user) && $user->count()==0)
            abort(404);

        $sentinelUser = Sentinel::findById($user->id);
        if($reminder = Reminder::exists($sentinelUser) ? : Reminder::create($sentinelUser)){
            if($cur==1 && $reminder->token==0 && $resetCode==$reminder->code){
                if($request->token==$reminder->reset_code)
                {
                    $credentials = [
                        'token' => '1'
                    ];
                    $update = Reminder::where('id', $reminder->id)->update($credentials);
                    $url=url('/').'/reset/'.$email.'/'.$reminder->code;
                    return redirect($url)->with(['success'=>"Please set your new password !!!"]);
                }
                else
                {
                    return redirect()->back()->with(['error'=>'Token mistmath please try again !!!']);
                }
            }
            if($reminder->token==1 && $resetCode==$reminder->code){
                Reminder::complete($sentinelUser,$resetCode,$request->password);

                return redirect('/login')->with(['success'=>"Please login with your new password."]);
            }
            else{
                return redirect('/login')->with(['error'=>'Link has been expired !!!']);
            }
        }
        else{
            return redirect('/login')->with(['error'=>'Link has been expired !!!']);
        }
    }

    public function postNewResetPassword(Request $request){
        //echo "<pre>";print_r($request->all());die;

       $this->validate($request,[
            'password' => array('confirmed','required','min:8','max:32'),
            'password_confirmation' => 'required',
        ]);

        $token=$request->forgot_token;
        $email=$request->email;
        $reminder=Reminder::where('code', $token)->first();
        $users_id=$reminder->user_id;
        $user = Sentinel::findByCredentials(['email' => $email]);

        //echo $user->id.'----'.$users_id;die;
        if($user->id !=$users_id)
        {
            return redirect()->back()->with(['error'=>'Token mistmath please try again !!!']);
        }
        if ((Hash::check($request->get('password'), $user->password))) {
            // The passwords matches
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }

        Sentinel::update($user, array('password' => $request->password));
        session(['new' => '']);
        return redirect('/login')->with(['success'=>" Your Password Reset successfully !!!"]);
    }

    // Forgot & Reset Passowrd Code Mail Function
    private function sendResetPasswordEmail($user, $code, $reset_string){
        Mail::send('emails.forgot-password',[
            'user' => $user,
            'code' => $code,
            'reset_code' => $reset_string
        ],function ($message) use ($user) {
            $message->to($user->email);
            $message->subject("Hello $user->fullname, Password Reset Request");
        });
    }
}
