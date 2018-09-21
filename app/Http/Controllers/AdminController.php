<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Deposit;
use App\Models\Withdraw;
use App\Models\Transfer;
use App\Models\Buy;
use App\Models\Rate;
use App\User;
use Sentinel;
use Mail;
use App\Models\Utransaction;
use App\Http\Controllers\PaymentController;
use App\Models\UserKyc;
use Carbon\Carbon;
class AdminController extends Controller
{
    public function __construct()
    {
        $this->payment = new PaymentController();
    }

    public function dashboard()
    {
      
    	//return view('dashboard.dashboard');
       return redirect('admin-dashboards');
    }
    public function adminDashboard()
    {
      $numberofUsers=User::count();
      $total_users=$numberofUsers+17000;

      $total_kwatts=User::sum('kwatt_balance');
      $total_kwatt=$total_kwatts*2;

       $todays_sale = Utransaction::where(['type'=>2,'status'=>100,'created_at'=>Carbon::today()])->sum('no_of_kwatt');
       //echo $Utransactions ;die;
       $todays_sales=$todays_sale*2;
      return view('admin.dashboard',compact('total_users','total_kwatt','todays_sales'));
    }

    public function buy_index()
    {
          $buy_data = Utransaction::with(["get_user_info","get_approved_info"])
                                  ->orderBy('id','desc')
                                  ->get();
       // echo "<pre>";print_r($buy_data->toArray());die;
         return view('admin.transaction.buy',compact('buy_data'));
    }
    public function userPaymentAccepted(Request $request)
    {
          //$wid=$request->all();
          //return $user_id=Sentinel::getUser()->id;
        //return $request->all();
        //die;
        $wid =$request->transaction_id;
          if($wid != '' && Sentinel::getUser()->roles()->first()->slug == 'admin')
          {
            $transaction = Utransaction::find($wid);
            $uid = $transaction->user_id;
            $currenttime=Carbon::now();
            $transaction->remark=$request->admin_remark;
            $transaction->approve_by=Sentinel::getUser()->id;
            $transaction->status=100;
            $transaction->updated_at=$currenttime;
            $transaction->save();
           // echo $uid;die;
            $no_of_kwatt=$transaction->no_of_kwatt;
            //$userid=$transaction->user_id;
            $user = User::find($uid);
            $kwatt='kwatt_balance'; 
                  //$user->$temp =  $user->$temp + $request->mc_gross;
            $user->$kwatt =  $user->$kwatt + $no_of_kwatt;
            $user->save();
            //Utransaction::where('id',$wid)->update(['status'=>100,'remark'=>]);
            //Update user balance
            //$user = User::find($uid);
            if($user->parent_id != 0 || $user->parent_id !=NULL)
            {
                $transaction_id=$transaction->id;
                $setting=Setting::find(1);
                $ref_bonus = $setting->referal_bonus;
                
                $setting->total_coins=$setting->total_coins - $no_of_kwatt;
                $setting->save();


                $this->payment->AddReferalBonusToParent($user,$no_of_kwatt,$ref_bonus,$transaction_id);
            }

            $result=array('status'=>1,'message'=>'Successfully Confirm Payment.');
           // return $result;
             // $coin_name='KWATT';
              //$this->sendWithdrawalApprovedEmail($user,$with_amount,$coin_name); //send mail
              //return redirect()->back()->with('success',' Successfully Confirm Payment.');
          }
          else
          {
            $result=array('status'=>1,'message'=>'Oops Something Went Wrong !! Please Try After Sometime');
             // return redirect()->back()->with('error','Oops Something went wrong. Please try again !');
          }


            return $result;

    }

     public function deposit_index()
    {
       $deposit_data = Deposit::orderBy('id','desc')->get();
       // foreach($deposit_data as $key)
       // {
       //      echo "<pre>";print_r($key->user_info->fullname);
       // }
       // die;
         return view('admin.transaction.deposit_list',compact('deposit_data'));
       
    }

        public function withdraw_index()
    {
       // $withdraw_data = Withdraw::with('user_info')->orderBy('id','desc')->get();
        //return view('admin.transaction.withdraw_list',compact('withdraw_data'));
        $withdraw_data = Utransaction::where('txn_type',3)->with('get_user_info')->orderBy('id','desc')->get();

        //echo "<pre>";print_r($withdraw_data->toArray());die;
        return view('admin.transaction.withdraw_list',compact('withdraw_data'));
    }

        public function transfer_index()
    {
       $tran_data = Transfer::orderBy('id','desc')->get();
         return view('admin.transaction.transfer_list',compact('tran_data'));
    }

    public function userlist()
    {
        $users = Sentinel::findRoleBySlug('user');
        $users = $users->users()->get();
        
        return view('admin.userlist',compact('users'));
    }
    public function userliststatus($id,$status)
    {
        $user = User::find($id);
        $user->status =$status;
        $user->save();

        if($status == 0)
            $lable = "Black";
        else if($status == 1)
            $lable = "Active";
        else if($status == 2)
            $lable = "Deleted";

        return redirect()->back()->with('success','user '.$lable.' Successfully');
    }

    //For Kyc
     public function kyc()
    {
        $users = Sentinel::findRoleBySlug('user');
        $users = $users->users()->get();
      
        return view('admin.kyc',compact('users'));
    }

    public function kyc_details($id)
    {

       $user=User::where('id',$id)->first();
       return view('admin.kyc_details',compact('user'));
    }

    public function index_kyc($id)
    {
        $user=User::where('id',$id)->first();
        return view('admin.kyc_index',compact('user'));
    }

    public function kyc_accept($id)
    {

        $kyc='Accepted';
        $text='KYC Verification';

        $user=User::where('id',$id)->first();
        Mail::send('emails.kyc',[
            'user' => $user,
            'kyc' => $kyc,
        ],function($message) use ($user, $text) {
            $message->to($user->email);
            $message->subject("Hello $user->username, $text");
        });
        $uu=User::find($id);
        $uu->kyc_status='4';
        $uu->save();

        return redirect()->back()->with(['success'=>" KYC Document Approve Successfully."]);
    }

    public function kyc_no_accept($id)
    {
        $kyc='Not Accepted';
        $text='KYC Verification';
        $user=User::where('id',$id)->first();
        Mail::send('emails.kyc',[
            'user' => $user,
            'kyc' => $kyc,
        ],function($message) use ($user, $text) {
            $message->to($user->email);
            $message->subject("Hello $user->username, $text");
        });
        $uu=User::find($id);
        $uu->kyc_status='3';
        $uu->save();

        return redirect()->back()->with(['success'=>" KYC Document Cancel Successfully."]);
    }

}

