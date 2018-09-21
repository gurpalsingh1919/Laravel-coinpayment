<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Login;
use Sentinel;
use Activation;
use Mail;

class LoginController extends Controller
{
    public function login()
    {
        //echo "sdfasd";die;
        if(Sentinel::check())
        {
            return redirect('dashboard');
        }
        return view('auth.login');
    }

    public function loginPost(Request $request)
    {
        $this->validate($request,[
            'email'=>'required|email',
            'password'=>'required',
            
          ]);

        $user = User::where('email', $request->email)->first(['id','status']);

        if ($user)
        {
            if($user->status == 0)
            {
                return redirect()->back()->with(['error' => "Your account is not activated !!!",'status'=>2,'resend_email'=>$request->email]);
            }

           $act = Activation::where('user_id', $user->id)->orderBy('id', 'DESC')->first(['completed']);
            if ($act)
            {
                if ($act->completed == 0)
                {
                    return redirect()->back()->with(['error' => "Your account is not activated !!!",'status'=>2,'resend_email'=>$request->email]);
                }
            }
            else 
            {
                return redirect()->back()->with(['error' => "You have not completed your activation process. Please resend activation and completed the process",'status'=>2,'resend_email'=>$request->email]);
            }
        } 
        else
        {
            return redirect()->back()->with(['error' => "You are not registered yet.",'status'=>0]);
        }        
        try
        {
            if(Sentinel::authenticate($request->all()))
            {
                $slug = Sentinel::getUser()->roles()->first()->slug;
                if($slug == 'admin')
                {

                    if(Sentinel::getUser()->google2fa_enable == 1)
                    {
                        if(Sentinel::getUser()->status==0)
                        { $this->logout();
                            return redirect()->back()->with(['error'=>' You Are Block From Admin So Can Not Login..','status'=>0]);
                        }
                        $request->session()->put('2fa:user:id', Sentinel::getUser()->id);
                        $this->logout();
                        return redirect('2fa/validate');
                    }

                   // return redirect('admin-user-list');
                    return redirect('admin-dashboard');

                }
                elseif($slug == 'user')
                {

                    $login = new Login();
                    $login->user_id = Sentinel::getUser()->id;
                    //$login->ip_address = $_SERVER['REMOTE_ADDR'] ;
                    $login->ip_address =$this->getClientIP();
                    $login->save();

                    if(Sentinel::getUser()->google2fa_enable == 1)
                    {
                        if(Sentinel::getUser()->status==0)
                        { 
                            $this->logout();
                            return redirect()->back()->with(['error'=>' You Are Block From Admin So Can Not Login..','status'=>0]);
                        }
                        $request->session()->put('2fa:user:id', Sentinel::getUser()->id);
                        $this->logout();
                        return redirect('2fa/validate');
                    }
                    else
                    {
                        //return redirect('dashboard');
                       // echo Sentinel::getUser()->air_drop;die;
                        $airdrop=0;
                        if(isset(Sentinel::getUser()->air_drop))
                        {
                            $user_id=Sentinel::getUser()->id;
                            $userdetail = User::find($user_id);
                            if(Sentinel::getUser()->air_drop ==2)
                            {
                                $userdetail->air_drop ='3';
                                $userdetail->save();
                                $airdrop=1;
                            }
                            else if(Sentinel::getUser()->air_drop ==12)
                            {
                                $userdetail->air_drop ='13';
                                $userdetail->save();
                                $airdrop=11;
                            }
                           
                            
                        }
                        return redirect('dashboard')->with(['error_code'=>5,'air_drop'=>$airdrop]);
                        //flash()->success('Success!', 'User successfully created!');
                    }
                }
                else 
                { 
                    return redirect()->back()->with(['error'=>'Wrong email and password.','status'=>0]);  
                }
            }
            else
            {    
                return redirect()->back()->with(['error'=>'Wrong email and password.','status'=>0]);  
            }

        }
        catch(ThrottlingException $e)
        {
            $delay = $e->getDelay();
            return redirect()->back()->with(['error'=>"You are Banned with $delay seconds",'status'=>0]);
        }
        catch(NotActivatedException $e)
        {
            return redirect()->back()->with(['error'=>"You account is not activated!",'status'=>2,'resend_email'=>$request->email]);
        }
    }

    public static function getClientIP()
    {
       
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
    /*$ip = '';
    $_SERVER['REMOTE_ADDR'] = $_SERVER['HTTP_X_REAL_IP'];
    if (getenv('HTTP_CLIENT_IP'))
        $ip = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ip = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ip = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ip = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ip = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ip = getenv('REMOTE_ADDR');
    else
        $ip = 'UNKNOWN';
    return $ip;*/
    }

    public function logout(){

        if(Sentinel::check())
        {
            Sentinel::logout();
            Sentinel::logout(null, true);
            return redirect('/login');
        }
        else
        {
            return redirect('/login');
        }


    }

}
