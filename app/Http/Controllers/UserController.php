<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Kwattledger;
use App\Models\Rate;
use App\Models\Login;
use App\Models\Referal;
use App\Models\Buy;
use App\User;
use Illuminate\View\View;
use Sentinel;
use Mail;
use DB;
use App\CoinPaymentsAPI;
use App\Http\Controllers\PaypalController;
use App\Models\Utransaction;
use Carbon\Carbon;
use config;
use Illuminate\Support\Facades\Validator;
use Session;
class UserController extends Controller
{
       public function getUserAlltokenDetail()
       {
          $user=Sentinel::getUser();
          $total_buy=Utransaction::where('txn_type','=','2')
            ->where('status','=','100')
            ->sum('no_of_kwatt');
          $total_bonus=Utransaction::where('txn_type','=','4')
            ->where('status','=','100')
            ->sum('no_of_kwatt');
          session(['total_buy' => $total_buy,'total_bonus'=>$total_bonus]);
       }




    /*public function dashboard()
    {
        try {
            $setting = Setting::first();

            $cp_helper = new CoinPaymentsAPI();
            $setup = $cp_helper->Setup($setting->private_key, $setting->public_key);

            $all = 1;
             $data = $cp_helper->api_call('balances', array('all' => $all));
             //echo "<pre>";print_r($data);die;
              $users = Sentinel::findRoleBySlug('user');
            if($data && Sentinel::getUser()->roles()->first()->slug == 'admin' ){
                if(isset($data['result']['BTC']))
                {
                    $btcwal = $data['result']['BTC']['balancef'];
                    $ethwal = $data['result']['ETH']['balancef'];
                    $ltcwal = $data['result']['LTC']['balancef'];
                    $bchwal = $data['result']['BCH']['balancef'];
                }
                else
                {
                    $btcwal = $users->users()->sum('btc_balance');
                    $ethwal = $users->users()->sum('eth_balance');
                    $ltcwal = $users->users()->sum('ltc_balance');
                    $bchwal = $users->users()->sum('bch_balance');
                }
               
                //$users = 
                //echo "<pre>";print_r($users);die;
                    //$kwatt=Kwattledger::find(1);
                   // echo "<pre>";print_r($kwatt);die;
                    $deposit=Kwattledger::whereIn('type',[1,3])->sum('noOfKwatt');
                    $buy=Kwattledger::whereIn('type',[4,2,5])->sum('noOfKwatt');
                    //echo "<pre>";print_r($deposit);
                   // echo "<pre>";print_r($buy);die;
                    $ratewal =$deposit-$buy;
                   // echo "<pre>";print_r($ratewal);die;
                    $usdwal =$users->users()->sum('usd_balance');
                    
            }
            else
            {
                $btcwal = Sentinel::getUser()->btc_balance;
                $ethwal = Sentinel::getUser()->eth_balance;
                $ltcwal = Sentinel::getUser()->ltc_balance;
                $bchwal = Sentinel::getUser()->bch_balance;
                $ratewal = Sentinel::getUser()->kwatt_balance;
                $usdwal = Sentinel::getUser()->usd_balance;
            }

            $setting = Setting::find(1);

            $rates = Rate::get();
            $sold = $setting->sold_coins;
            $sold = ceil($sold / 1000000); // to get row from rates table
            if ($sold > 8) {
                $sold = 8;
            }


            $user=Sentinel::getUser();
            $buy_data =  Utransaction::where('user_id',$user->id)->orderby('id','desc')->get();
            $latest_data =  Utransaction::where('user_id',$user->id)
            ->where('type','!=','USD')->orderby('id','desc')->first();
            //$total=$latest_data->toArray();
             $total_rows=0;
            if(isset($latest_data) && $latest_data->count() >0)
            {
             
              $total_rows=1;
            }
            //$buy_data =  Utransaction::where('user_id',$user->id)->orderby('id','desc')->get();
           // $this->getUserAlltokenDetail();
          
            return view('dashboard.dashboard', compact('usd_rate', 'setting', 'rates','buy_data','usdwal','latest_data','total_rows'));

        } catch (Exception $e) {
            return view('errors.error');
        }
    }*/
    public function dashboard()
    {
       $setting = Setting::first();
      return view('dashboard.dashboard',compact('setting'));

    }
    public function getOverAllKwatts()
    {
       return Kwattledger::where('type','=','6')->sum('noOfKwatt');
    }

    public function refferal()
    { 
      $users = User::where('parent_id',Sentinel::getUser()->id)->get(); 
      $totalusers=array();
      $ref_list=array();
      if(isset($users) && !empty($users))
      {
        
          $totalusers=$users->toArray();
          foreach ($totalusers as $key => $value) 
          {
            $id=$value['id'];
            $total=Referal::select('user_id',DB::raw("sum(ref_amount) as sum"))
            ->where('user_id',$id)
            ->where('ref_user_id',Sentinel::getUser()->id)
            ->groupBy('user_id')
            ->get();
            $bonus=$total->toArray();
            if(isset($bonus['0']))
            {
              $value['bonus']=$bonus['0']['sum'];
            }
            else
            {
              $value['bonus']=0;
            }
            
            $ref_list[]=$value;
            
          }
        
      }
     
      $total=Referal::select(DB::raw("sum(ref_amount) as sum"))->where('ref_user_id',Sentinel::getUser()->id)->get();
        
       $totals= $total->toArray();
       $asTotal=0;
       if(count($totals) >0 && isset($totals[0]['sum']))
       {
            $asTotal=$totals[0]['sum'];
       }
       $currenttime=Carbon::now();
       $toprated=$this->getTopRatedAffiliateBonusUsers();
       //echo "<pre>";print_r($toprated->toArray());die;
      return View('user.affiliate',compact('ref_list','toprated','asTotal','currenttime'));
    }

    public function history()
    {
      $login = Login::where('user_id',Sentinel::getuser()->id)->get();
      return View('user.login_history',compact('login'));
    }

    public function kyc_form()
    {
        $user=Sentinel::getUser();
        return view('user.kyc',compact('user'));
    }
    public function upload_kyc(Request $request)
    {

        $this->validate($request,[
            'kyc_document'=>'nullable|image',
            'kyc_document_two'=>'nullable|image',
        ]);

        $user_id=Sentinel::getUser()->id;
        if ($request->hasFile('kyc_document') || $request->hasFile('kyc_document_two'))
        {
            if ($request->hasFile('kyc_document')) {
                $file = $request->file('kyc_document');
                $destinationPath = 'upload/kyc';
                $file->move($destinationPath, $file->getClientOriginalName());
                $filename1 = $file->getClientOriginalName();
                $filename1 = urlencode($filename1);

                $set = User::find($user_id);
                $set->kyc_document = $filename1;
                $set->save();
            }
            if ($request->hasFile('kyc_document_two')) {
                $file_two = $request->file('kyc_document_two');
                $destinationPath = 'upload/kyc';
                $file_two->move($destinationPath, $file_two->getClientOriginalName());
                $filename2 = $file_two->getClientOriginalName();
                $filename2 = urlencode($filename2);
                $set = User::find($user_id);
                $set->kyc_document1 = $filename2;
                $set->save();
            }

            return redirect()->back()->with(['success'=>" KYC Document Upload Successfully. Wait For Admin Confirmation."]);
        }
        else
        {
            return redirect()->back()->with(['error'=>" Select KYC Document First."]);
        }
    }
    public function contact_support()
    {
        $user=Sentinel::getUser();
        return view('user.contact',compact('user'));
    }
     public function invite_fds()
    {
        $user=Sentinel::getUser();
        return view('user.invitefds',compact('user'));
    }
    public function promotionalMaterials()
    {
      $users = User::where('parent_id',Sentinel::getUser()->id)->get(); 
      $totalusers=array();
      $ref_list=array();
      if(isset($users) && !empty($users))
      {
        
          $totalusers=$users->toArray();
          foreach ($totalusers as $key => $value) 
          {
            $id=$value['id'];
            $total=Referal::select('user_id',DB::raw("sum(ref_amount) as sum"))
            ->where('user_id',$id)
            ->where('ref_user_id',Sentinel::getUser()->id)
            ->groupBy('user_id')
            ->get();
            $bonus=$total->toArray();
            if(isset($bonus['0']))
            {
              $value['bonus']=$bonus['0']['sum'];
            }
            else
            {
              $value['bonus']=0;
            }
            
            $ref_list[]=$value;
            
          }
        
      }
     
      $total=Referal::select(DB::raw("sum(ref_amount) as sum"))->where('ref_user_id',Sentinel::getUser()->id)->get();
        
       $totals= $total->toArray();
       $asTotal=0;
       if(count($totals) >0 && isset($totals[0]['sum']))
       {
            $asTotal=$totals[0]['sum'];
       }
       $fullname=Sentinel::getuser()->fullname;
       if($fullname ===NULL)
       {
        
          $fullname='';
       }
       $currenttime=Carbon::now();
       $toprated=$this->getTopRatedAffiliateBonusUsers();
      return view('user.promotional',compact('user','toprated','asTotal','ref_list','fullname'));
    }



    public function affiliate_fds()
    {
        $user=Sentinel::getUser();
        return view('user.affiliate',compact('user'));
    }
    public function postInviteFds(Request $request)
    {
         $this->validate($request,[
            'email'=>'required|email',
            'name'=>'required',
            'subject'=>'required',
           'message' =>'required',
           'g-recaptcha-response' => 'required|captcha',
          ]);
         $user_email=$request->email;
         $user_names=$request->name;
         $user_subject=$request->subject;
         $user_message=$request->message;
         $user=array('username'=>$user_names,'email'=>$user_email,'subject'=>$user_subject,'message'=>$user_message);
        // $sendEmailAddress=array('Admin'=>'info@4new.co.uk','Gurpal Singh'=>'gurpal@fly.biz','Danish Wadhwa'=>'danish@fly.biz');
          $sendEmailAddress=array('Support Team'=>'support@4new.io');
           //$sendEmailAddress=array('Support Team'=>'gurpal@fly.biz');

         foreach($sendEmailAddress as $key=>$value)
         {
           // echo $user_email.'----'.$user_message.'-----'.$user_subject.'--'.$user_names.'--'.$key;die;
            $admin_name=$key;
            $admin_email=$value;
            $text="Support Required";
            $this->sendContactUsEmails($admin_name,$admin_email,$user,$text);
         }
         //$user=user::where('email',$admin_email)->first();
         //echo "<pre>";print_r($userrs->email);die;
            $this->sendSupportRespondEmail($user_email,$user_names);
            /*$this->sendThanksEmail($user_email,$user_names);
            $this->sendTxnTimeoutEmail($user_email,$user_names);
            $this->sendReferingEmail($user_email,$user_names);*/
          return redirect('contact-support')->with('success','Your request has been received. We will contact back to you soon !');

    }
     private function sendContactUsEmails($admin_name,$admin_email,$user,$text){
        Mail::send('emails.contactus',[
            'admin' => $admin_name,
            'user' => $user,
        ],function($message) use ($admin_email, $admin_name,$user,$text) {
            $message->to($admin_email);
            $message->from($user['email'], $user['username']);
            //$message->from(['address' => $user->email, 'name' => $user->username],
            $message->subject("Hello $admin_name, $text");
        });
    }

    private function sendSupportRespondEmail($user_email,$user_names)
    {
        Mail::send('emails.supportrespond',[
            'user' => $user_names
            
        ],function($message) use ($user_email,$user_names) {
            $message->to($user_email);
            $message->subject("Hello $user_names, Did you get the help you needed?");
        });
    }
    public function postRefferFriends(Request $request)
    {
         $this->validate($request,[
            'username'=>'required',
            'to_email'=>'required',
            'to_message' =>'required',
            'to_subject' =>'required',
           ]);
         $username=$request->username;
         $to_emails=$request->to_email;
         $user_subject=$request->to_subject;
         //echo $user_subject;die;
         $user_message=$request->to_message;
         $array_emails=explode(',' , $to_emails);
         //echo count($array_emails);
         for($i=0;$i<count($array_emails);$i++)
         {
            $to_email=$array_emails[$i];
            $this->sendAffiliateEmails($username,$to_email,$user_subject,$user_message);
         }

         //echo "<pre>";print_r($array_emails);die;
        
        return redirect('user-promo')->with('success','Email Sent Successfully');

    }
    function mynl2br($text) { 
   return strtr($text, array("\r\n" => '<br />', "\r" => '<br />', "\n" => '<br />')); 
}
    private function sendAffiliateEmails($username,$to_email,$user_subject,$user_message)
    {
         Mail::send('emails.referralEmail',[
            'user_message' => $user_message
            
        ],function($message) use ($to_email,$user_subject) {
            $message->to($to_email);
            $message->subject($user_subject);
        });
    }

 /*  private function sendTxnTimeoutEmail($user_email,$user_names)
    {
        Mail::send('emails.txntimeout',[
            'user' => $user_names
            
        ],function($message) use ($user_email,$user_names) {
            $message->to($user_email);
            $message->subject("Hello $user_names, Oops! Did you forget something?");
        });
    }
    private function sendThanksEmail($user_email,$user_names)
    {
        Mail::send('emails.thanks',[
            'user' => $user_names
            
        ],function($message) use ($user_email,$user_names) {
            $message->to($user_email);
            $message->subject("Hello $user_names, Welcome to the 4NEW family!");
        });
    }
    private function sendReferingEmail($user_email,$user_names)
    {
        Mail::send('emails.referingfriend',[
            'user' => $user_names
            
        ],function($message) use ($user_email,$user_names) {
            $message->to($user_email);
            $message->subject("Hello $user_names, Thank you for helping the 4NEW revolution!");
        });
    }*/

    public function showAllUsersInfo()
    {
        $numberofUsers=User::count();
        $total=$numberofUsers+17000;
        $type='json';
        $headers = ['Access-Control-Allow-Origin: *'];
        return response()->json(['users' => $total])//->withHeaders($headers);
        ->header('Access-Control-Allow-Origin', 'https://4new.io')
          ->header('Access-Control-Allow-Methods', 'GET')
          ->header('Access-Control-Allow-Headers',' Origin, Content-Type, Accept, Authorization, X-Request-With')
          ->header('Access-Control-Allow-Credentials',' true');
      
    }

    public function topAffiliateUsers()
    {
       
      $toprated=$this->getTopRatedAffiliateBonusUsers();
      return response()->json(['affiliate_users' => $toprated])//->withHeaders($headers);
        ->header('Access-Control-Allow-Origin', 'https://4new.io')
        ->header('Access-Control-Allow-Methods', 'GET')
        ->header('Access-Control-Allow-Headers',' Origin, Content-Type, Accept, Authorization, X-Request-With')
        ->header('Access-Control-Allow-Credentials',' true');

    }
    private function getTopRatedAffiliateBonusUsers()
    {

       $total=Referal::select('ref_user_id',DB::raw("sum(ref_amount) as total_bonus"))
        ->with('aff_user')
        ->groupBy('ref_user_id')
        ->orderby('total_bonus','desc')
        ->limit(10)
        ->get();
        return $total;
    }
    
}
