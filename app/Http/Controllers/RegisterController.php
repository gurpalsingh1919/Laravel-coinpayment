<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use Sentinel;
use Activation;
use App\User;
use Form;
use Illuminate\Support\Facades\Redirect;
use Cookie;
use Hash;
class RegisterController extends Controller
{

    public function register(Request $request)
    {
        $email='';
        //echo $request->email;die;
        if(isset($request->email) && !empty($request->email))
        {
            $email=$request->email;
        }
       return view('auth.register',compact('email'));
    }
    public function airdrop_sign_up(Request $request)
    {
        $email='';
        //echo $request->email;die;
        if(isset($request->email) && !empty($request->email))
        {
            $email=$request->email;
        }

        return view('auth.airDropSignup',compact('email'));

    }
    public function second_airdrop_sign_up()
    {
        $email='';
        //echo $request->email;die;
        if(isset($request->email) && !empty($request->email))
        {
            $email=$request->email;
        }

        return view('auth.airDropSignup',compact('email'));
    }
    public function refferalcode(Request $request)
    {

        //echo "<pre>";print_r($request->all());die;
        if(isset($request->ref) && $request->ref !='')
        {
           // $url=config('constants.web_url');
            $url='https://4new.io/';
            $token=$request->ref;
            $expire = 6*30*24*3600;
            Cookie::queue('affiliate_token',  $token, $expire);
            if(isset($request->page) && $request->page=='affiliate')
            {
                $url='https://4new.io/affiliate';
            }
            elseif(isset($request->page) && $request->page=='webinar')
            {
                $url='https://kwatt.4new.io/live-webinar?ref='.$token.'&page=webinar';
               // https://kwatt.4new.io/aff?ref=BlO9rx3ERWv&page=webinar
            }
            elseif(isset($request->page) && $request->page=='reg')
            {
                $url='https://kwatt.4new.io/register';
            }

            return Redirect::to($url);
        }
    }

    public function referral(Request $request, $ref)
    { 
        //$request->session()->put('referral', $ref);
        //return Redirect::to('https://4new.io/');
        //return Redirect::to('https://4new.io/');
        return redirect('register');
    }


    public function registerPost(Request $request)
    {

       // $user_result=user::where('email',$request->email)->first();
       // echo $request->email;
      //  echo "<pre>";print_r($user_result['id']);die;
        //$filename='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        //echo config('constants.unique_string'); die;
        $this->validate($request,[
            'email'=>'required|email|unique:users,email',
            'first_name'=>'required',
            'last_name'=>'required',
            //'username'=>'required|max:255|unique:users,username',
            'password' =>'required|min:8',
            'password1' =>'required|min:8|same:password',
            'terms_and_Condition' => 'required'
            //'sponser' =>'nullable|email',
        ]);
        
        //echo "<pre>";print_r($user_result);die;
        /*if ($request->sponser) {
            $sponser = User::where('email', $request->sponser)->first();
            if (is_null($sponser)) {
                return redirect()->back()->with(['error' => "Please enter Valid Sponser Email !", 'validator' => '1']);
            }
        }*/
       // $alphadigit=config('constants.unique_string');
        $alphadigit='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $reftoken=substr(str_shuffle(str_repeat($alphadigit, 11)), 0, 11);  

        $username=$request->first_name.' '.$request->last_name;
        $user =  Sentinel::register(array(
            'fullname'     =>$username,
            'username'     =>$username,
            'email'        => $request->email,
            'password'     => $request->password1,
        ));
        $user->fullname = $username;
        $user->username = $username;
        $user->ref_token = $reftoken;
        //echo $request->air_drop;die;
        if(isset($request->air_drop) && $request->air_drop =='1')
        {
            $user->air_drop = '1';
        }
        if(isset($request->air_drop) && $request->air_drop =='11')
        {
            $user->air_drop = '11';
        }
        $user->save();
        

        $parent_id=0;
        $activation = Activation::create($user);
        $role = Sentinel::findRoleBySlug('user');
        $role->users()->attach($user);

        $cookies=Cookie::get('affiliate_token');
        if(isset($cookies) && $cookies !='')
        {
           $user_result=user::where('ref_token',$cookies)->first();
           $parent_id =$user_result['id'];
           User::where('email', $request->email)->update(array('parent_id' => $parent_id));
        }


        /*if($request->sponser)
        {
            $sponser_data = User::where('email', $request->sponser)->first();
            if($sponser_data) {
                $parent_id = $sponser_data->id;
                User::where('email', $request->email)->update(array('parent_id' => $parent_id, 'username' => $request->first_name.' '.$request->last_name, 'fullname' => $request->first_name.' '.$request->last_name));
                //$userdata = User::where('username', $request->first_name.' '.$request->last_name)->get();
            }
        }*/

        $link = url('').'/activate/'.$request->email.'/'.$activation->code;
        $text = 'Welcome; please confirm your email address to complete your account registration.';
      
        $this->sendActivationEmail($user,$text,$link);
        $this->sendThanksEmail($user);
        $this->registerUserOnHubspot($request->first_name,$request->last_name,$request->email);
        

        $message="<b>IMPORTANT - PLEASE CHECK EMAIL NOW:</b><br/>
Thank you! You are now registered, but you MUST CONFIRM YOUR EMAIL FIRST.<br/>
Confirmation email has been sent to your registered email address, please confirm before attempting a login here.<br/>
Please go and check your email now, open the email and click the confirmation link.<br/>
Once you have clicked this link, you will have confirmed your email, you can login to get KWATT tokens!";
        return redirect('login')->with('success',$message);
    }
    public function registerUserOnHubspot($firstname,$lastname,$email)
    {
        $cookies=Cookie::get('hubspotutk');
        $hubspotutk      = $cookies; 
        $ip_addr         = $_SERVER['REMOTE_ADDR']; 
        $hs_context      = array(
            'hutk' => $hubspotutk,
            'ipAddress' => $ip_addr,
            'pageUrl' => 'https://kwatt.4new.io/register',
            'pageName' => 'Kwatt Registration'
        );
        $hs_context_json = json_encode($hs_context);

        $str_post = "firstname=" . urlencode($firstname) 
            . "&lastname=" . urlencode($lastname) 
            . "&email=" . urlencode($email) 
            . "&hs_context=" . urlencode($hs_context_json);

        //var_dump($str_post);

        $endpoint = 'https://forms.hubspot.com/uploads/form/4431012/1196b1d0-4746-4e3b-bee9-c35b10c569d8';


        $ch = @curl_init();
        @curl_setopt($ch, CURLOPT_POST, true);
        @curl_setopt($ch, CURLOPT_POSTFIELDS, $str_post);
        @curl_setopt($ch, CURLOPT_URL, $endpoint);
        @curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/x-www-form-urlencoded'
        ));

        @curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response    = @curl_exec($ch);
        $status_code = @curl_getinfo($ch, CURLINFO_HTTP_CODE); 
        @curl_close($ch);
        //echo $status_code . " " . $response;
    }
    public function resendactivation(Request $request)
    {
        $email=$request->email;
        // $user_data = User::where('email', $email)->first();
        // echo "<pre>";print_r($user_data['id']);die;
        $arraymessage ='';
        if(isset($email) && $email !='')
        {
            $user_data = User::where('email', $email)->first();
            $user_id=$user_data['id'];
            $user = Sentinel::findById($user_id);
            $activation = Activation::create($user);
            $link = url('').'/activate/'.$request->email.'/'.$activation->code;
            $text = 'Welcome; please confirm your email address to complete your account registration.';
            $this->sendActivationEmail($user,$text,$link);
            
            $arraymessage = array('status'=>'1','message'=>'Reactivation code has been sent to your registered email.Please check the email address that you have registered with to complete your registration.');
            //return redirect('login')->with('success','Reactivation code has been sent to your registered email.Please check the email address that you have registered with to complete your registration.');
        }
        else
        {
           $arraymessage = array('status'=>'0','message'=>'Please Enter Email Address');
            // return redirect('login')->with('success','Please Enter Email Address');
        }
        return $arraymessage;
    }

    // User Activation Mail Function
    private function sendActivationEmail($user,$text,$link){
        Mail::send('emails.activation',[
            'user' => $user,
            'text' => $text,
            'link' => $link,
        ],function($message) use ($user, $text) {
            $message->to($user->email);
            $message->subject("Hello $user->username, $text");
        });
    }
    private function sendThanksEmail($user)
    {
        Mail::send('emails.thanks',[
            'user' => $user
            
        ],function($message) use ($user) {
            $message->to($user->email);
            $message->subject("Hello $user->username, Welcome to the 4NEW family!");
        });
    }
}
