<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Deposit;
use App\Models\Buy;
use App\Models\Withdraw;
use App\Models\Transfer;
use App\Models\Rate;
use App\Models\Referal;
use App\User;
use Sentinel;
use Mail;
use App\Models\Kwattledger;
use App\Http\Controllers\PaypalController;
use App\Models\Utransaction;
use App\CoinPaymentsAPI;
use config;

class WalletController extends Controller
{
   
    public function index()
    {
        $user=Sentinel::getUser();
        $deposit_data =  Deposit::where('user_id',$user->id)->get();


        return view('user.wallet.index',compact('total','deposit_data'));
    }
    

    public function ico_info()
    {
          $rate_data = Rate::get();
          return view('user.wallet.ico_info',compact('rate_data'));
    }

    public function bounty()
    {
         return view('user.bounty.index');
    }

    public function buy_coin()
    {
         $user=Sentinel::getUser();
         $user_id= $user->id;
         $buy_data =  Buy::where('user_id',$user->id)->get();
         return view('user.transaction.buy',compact('buy_data'));
    }

    public function transfer()
    {
          $user=Sentinel::getUser();
          $tran_data=Transfer::where('from_user',$user->id)->get();
          return view('user.wallet.transfer',compact('tran_data'));
    }

    public function check_username(Request $request)
    {
        $username = $request->username;
        $user_data = User::where("username",$username)->get();
        echo sizeof($user_data);
    }

    public function add_transfer(Request $request)
    {
        $username = $request->username;
        $user_data = User::where("username",$username)->first();
        $user=Sentinel::getUser();
        
          $tran = new Transfer;
          $tran->from_user = $user->id;
          $tran->to_user = $user_data->id;
          $tran->token = $request->kwatt_coin;
          $tran->save();
          return 1;
    }

    public function deposit_list()
    {
         $user=Sentinel::getUser();
         $user_id= $user->id;
         $deposit_data =  Deposit::where('user_id',$user->id)->get();
         return view('user.transaction.deposit_list',compact('deposit_data'));
    }

        public function withdraw_list()
    {
         $user=Sentinel::getUser();
         $user_id= $user->id;
         $withdraw_data =  Withdraw::where('user_id',$user->id)->get();
         return view('user.transaction.withdraw_list',compact('withdraw_data'));
        
    }
        public function transfer_list()
    {
        
         $user=Sentinel::getUser();
         $user_id= $user->id;
         $tran_data =  Transfer::where('from_user',$user->id)->get();
         return view('user.transaction.transfer_list',compact('tran_data'));
    }


    public function buy()
    {
         $setting = Setting::where('id',1)->first();
         $user=Sentinel::getUser();
         $buy_data = Buy::where('user_id',$user->id)->get();
         
         $bonus = 0;
         return view('user.wallet.buy',compact('setting','buy_data','bonus'));
    }

    public function deposit($coin)
    {
      $user=Sentinel::getUser();
    	$deposit_data=Deposit::where('coin',$coin)->where('user_id',$user->id)->get();
    	return view('user.wallet.deposit',compact('coin','deposit_data'));
    }

    public function withdraw()
    {
        //$withdraw_data=Withdraw::where('coin',$coin)->get();
        return view('user.withdrawl_kwatts',compact(''));
    }
    public function userAllTransactionsHistory()
    {
      $user=Sentinel::getUser();
      $buy_data =  Utransaction::where('user_id',$user->id)->orderby('id','desc')->get();
      return view('user.user_transactions',compact('buy_data'));
    }
    public function get_live_value(Request $request)
    {
        $setting_data=Setting::where('id',1)->first();
        $usd_price = $request->usd_val;

        if($request->coin == 'BTC')
        {
            $price = $setting_data->btc_price; 
        }
        elseif($request->coin == 'LTC')
        {
             $price = $setting_data->ltc_price; 
        }
        elseif($request->coin == 'ETH')
        {   
             $price = $setting_data->eth_price; 
        }
        elseif($request->coin == 'BCH')
        {
             $price = $setting_data->bch_price; 
        }
        else
        {        }

        $temp=$usd_price/$price;
        echo $temp;
    }


     public function get_live_value1(Request $request)
    {
        $setting_data=Setting::where('id',1)->first();
        $coin_price = $request->coin_val;

        if($request->coin == 'BTC')
        {
            $price = $setting_data->btc_price; 
        }
        elseif($request->coin == 'LTC')
        {
             $price = $setting_data->ltc_price; 
        }
        elseif($request->coin == 'ETH')
        {   
             $price = $setting_data->eth_price; 
        }
        elseif($request->coin == 'BCH')
        {
             $price = $setting_data->bch_price; 
        }
        else
        {        }

        $temp = $price * $coin_price;
        return $temp;
    }


    /*public function withdraw_add(Request $request)
    {
        $with_amount = $request->withdraw_amount;
        $with_address = $request->wallet_address;
        $coin = $request->coin;

         $user=Sentinel::getUser();

        $with = new Withdraw;
        $with->user_id = $user->id;
        $with->coin = $coin;
        $with->coin_address = $with_address;
        $with->amount = $with_amount;
        $with->save();

        if($coin=='BTC')
        {  $user->btc_balance = $user->btc_balance - $with_amount;  }
        elseif($coin=='LTC')
        {  $user->ltc_balance = $user->ltc_balance - $with_amount;  }
        elseif($coin=='ETH')
        {   $user->eth_balance = $user->eth_balance - $with_amount; }
        elseif($coin=='BCH')
        {   $user->bch_balance = $user->bch_balance - $with_amount;  }
        elseif($coin=='USD')
        {   $user->usd_balance = $user->usd_balance - $with_amount;  }
        elseif($coin=='KWATT')
        {   $user->kwatt_balance = $user->kwatt_balance - $with_amount;  }
        $user->save(); 


            $kwatt_ledger= new Kwattledger;
            $kwatt_ledger->user_id=$user->id;
            $kwatt_ledger->noOfKwatt=$with_amount;
            $kwatt_ledger->type=3;
            $kwatt_ledger->coin=$this->getCoinEnum($coin);
            $kwatt_ledger->save();

        return redirect()->back()->with('success',' Withdraw Request Send Successfully');

    }*/
    public function withdraw_add(Request $request)
    {
        $this->validate($request,[
            'address'=>'required'
        ]);
         $user=Sentinel::getUser();
        $with_address = $request->address;
        //$AddressExists=Utransaction::where('address',$with_address)->where('user_id',$user->id)->first();
        $AddressExists = user::find($user->id);
       // return $AddressExists;die;
      // echo "<pre>";print_r($AddressExists->kwatt_balance);die;
        if (isset($AddressExists->kwatt_balance) && $AddressExists->kwatt_balance ==0) 
        { 
          $result =array('status'=>0,'message'=>"You don't have sufficient KWATT to withdrawl"); 
          return $result;
        }
        
        //return count($AddressExists->count());
       
        $transaction= new Utransaction;
        $transaction->user_id=$user->id;
        $transaction->type='KWATT';
        $transaction->txn_type=3;
        $transaction->no_of_kwatt=$AddressExists->kwatt_balance;
       // $transaction->coin_amount=$AddressExists->coin_amount;
        $transaction->address=$with_address;
        $transaction->status=0;
        
        if($transaction->save()) 
        {
            $result = array('status' =>1 ,'message'=>"Your request has been received. KWATTs will be released to your myetherwallet address at the end of the ICO" );
        }
        else
        {
          $result =array('status'=>0,'message'=>'Oops something went wrong. Please try after sometime !');
        }

        return $result;
    }
    public function hasAmountIsValid($kwatt_amount,$coinName,$user,$setting,$coin_amount)
    {
     // $setting=Setting::find(1);
      $coin_price=strtolower($coinName).'_price';
      //return $coin_price;die;
      //Usd rate

      $usd_rate=$setting->usd_rate;
      $coinActualPrice=$setting->$coin_price;
      $usdKwattAmount=$kwatt_amount*$usd_rate;
      //$coinCalculatePrice=$usdKwattAmount/$coinActualPrice;

      $kwattCalculatedPrice=($coinActualPrice/$usd_rate)*$coin_amount;
    
      //Get User Balance
     // $coin_balance=strtolower($coinName).'_balance';
     // $userActualBalance=$user->$coin_balance;

      //if($coinCalculatePrice > $userActualBalance)
      //{
        $result= array('status' => 0,'kwattCalculatedPrice'=>round($kwattCalculatedPrice,2),'coinCalculatedPrice'=>$coin_amount );
      // }
      // else
      // {
      //     $result= array('status' => 1,'calculatedPrice'=>$coinCalculatePrice );
      // }
      return $result;

    }


    public function store_ico(Request $request)
    {

       $this->validate($request,[
            'kwatt_amount'=>'required'
            
          ]);
        if(isset($request->kwatt_amount) && $request->kwatt_amount <=0)
        {
          $message="Amount is not acceptable";
          return redirect()->back()->with('error',$message);
        }

        $user=Sentinel::getUser();

        $setting=Setting::find(1);
        $ref_bonus = $setting->referal_bonus;

        $total_amount = $request->total_amount;  //token amount
        $kwatt_amount = $request->kwatt_amount;  //main kwatt
        $coin_name = $request->coin_name;    //coin name
        $coin_amount = $request->coin_amount;    //coin amount


        $result=$this->hasAmountIsValid($kwatt_amount,$coin_name,$user,$setting);
        if(isset($result) && $result['status']==0)
        {
          $message='You have No Suffifient Balance To Buy '. $kwatt_amount .' KWATT';
          return redirect()->back()->with('error',$message);
          exit;
        }
        else
        {
          /********************** Coin Amount ******************/
          $CoinCalculatedPrice=$result['calculatedPrice'];
         // $result=number_format($result['calculatedPrice'],0,'','');
          $calculatedBonusPrice=$this->CalculateBonusAfterSubmit($user,$kwatt_amount);
          //echo "<pre>";print_r($calculatedBonusPrice);die;
          /********************** Total Kwatt ******************/
          $KwattCalculatedPrice=$calculatedBonusPrice['kwattAmountAfterBonus'];
          $bonusAmount=$calculatedBonusPrice['bonusAmount'];
          $bonusPrecentage=$calculatedBonusPrice['rateOfBonus'];
          /*********** Add kWatt in Buys history **************/
          $store= new Buy;
          $store->user_id=$user->id;
          $store->ico_amount=$CoinCalculatedPrice;
          $store->token=$KwattCalculatedPrice;
          $store->type=$coin_name;
          $store->save();
          /*************** Kwatt Leadger history ****************/
          $kwatt_ledger= new Kwattledger;
          $kwatt_ledger->user_id=$user->id;
          $kwatt_ledger->noOfKwatt=$KwattCalculatedPrice;
          $kwatt_ledger->type=2;
          $kwatt_ledger->coin=$this->getCoinEnum($coin_name);
          $kwatt_ledger->save();
          /**************** Update User Balance ******************/
          $temp=strtolower($coin_name).'_balance';
          $userdata=User::find($user->id);
          $userdata->$temp=$userdata->$temp - $CoinCalculatedPrice;
          $userdata->kwatt_balance=$userdata->kwatt_balance + $KwattCalculatedPrice;
          if(isset($bonusPrecentage) && $bonusPrecentage >0)
          {
            $userdata->cur_bonus=$bonusAmount;
          }
          $userdata->save();
          /**************** Update Sold coin *************/
          $setting = Setting::find(1);
          $setting->sold_coins=$setting->sold_coins + $total_amount;
          $setting->save();


          /******************* Update Parent Balance ****************/
          if($user->parent_id == 0 || $user->parent_id==NULL)
          {
            //$this->sendbuycoinEmail($user,$total_amount,$coin_amount,$coin_name);
            return redirect()->back()->with('success','Buy Kwatt Successfully');
          }
          else
          {
               $parent_data = User::where('id',$user->parent_id)->first();
               if($parent_data)
               {
                   $add_amount= $kwatt_amount * $ref_bonus/100;
                   $parent_user= User::find($user->parent_id);
                   $parent_user->kwatt_balance = $parent_user->kwatt_balance + $add_amount;
                   $parent_user->save();

                      $ref=new Referal;
                      $ref->user_id= $user->id;
                      $ref->buy_id= $store->id;
                      $ref->ref_user_id= $user->parent_id;
                      $ref->ref_amount= $add_amount;
                      $ref->level= 1;
                      $ref->save();

                      $store= new Buy;
                      $store->user_id=$user->parent_id;
                      $store->ico_amount=0;
                      $store->token=$add_amount;
                      $store->type='KWATT';
                      $store->save();

                      $kwatt_ledger= new Kwattledger;
                      $kwatt_ledger->user_id=$user->parent_id;
                      $kwatt_ledger->noOfKwatt=$add_amount;
                      $kwatt_ledger->type=4;
                      $kwatt_ledger->coin=6;
                      $kwatt_ledger->save();
                      //$link='askdfklasjd';
                      //$this->sendbuycoinEmail($user,$total_amount,$coin_amount,$coin_name);

                    return redirect()->back()->with('success',' Buy Kwatt Successfully');
               }
               else
               { 
                  return redirect()->back()->with('success',' Buy Kwatt Successfully');
                }
          }

        }
    }

    function CalculateBonusAfterSubmit($user,$kwattAmount)
    {
      $CalculatedBonus=array();
      if(isset($user) && $kwattAmount !='' )
      {
          /*$UserKwattBalance = $user->kwatt_balance;
          $userPreviousBonus = $user->cur_bonus;
          $rate_data = Rate::orderby('id','desc')->get();
          foreach ($rate_data as $key_rate) 
          {
            /*$bonus = 0;
            $first_limit=0;
            $bonusAmount =0;
            $newBonus=$key_rate->bonus;
            $newBonusLimit=$key_rate->kwatt_limit;
            if($userPreviousBonus==$newBonus)
            {
                $first_limit= $newBonusLimit;

            }
            if( $first_limit < $kwattAmount && $kwattAmount >= $newBonusLimit)
            {
              $bonus = $newBonus; 
              $bonusAmount = $kwattAmount * $newBonus / 100;
              break;        
            }*/
            /*$bonus = 100;
             $newBonus=$key_rate->bonus;
            $newBonusLimit=$key_rate->kwatt_limit;
            if($kwattAmount <= $newBonusLimit)
            {
              $bonus = $newBonus; 
              $bonusAmount = $kwattAmount * $newBonus / 100;
              break;        
            }

           } */
          $bonus = 25; 
          $bonusAmount = $kwattAmount * $bonus / 100;
          $kwattAmountAfterBonuss=$bonusAmount+$kwattAmount;
         // $kwattAmountAfterBonus=$this->floattostr( $kwattAmountAfterBonuss );

          $kwattAmountAfterBonus=$kwattAmountAfterBonuss;
          $CalculatedBonus=array('rateOfBonus'=>$bonus,'bonusAmount'=>$bonusAmount,
            'kwattAmountAfterBonus'=>$kwattAmountAfterBonus);

      }
      return $CalculatedBonus;
    }
    public function floattostr( $val )
    {
        preg_match( "#^([\+\-]|)([0-9]*)(\.([0-9]*?)|)(0*)$#", trim($val), $o );
        return $o[1].sprintf('%d',$o[2]).($o[3]!='.'?$o[3]:'');
    }

    function getCoinEnum($coin)
    {
        $coin_name='';
         if($coin=='BTC')
            {  $coin_name=2;  }
            elseif($coin=='LTC')
            {  $coin_name=5; }
            elseif($coin=='ETH')
            {   $coin_name =3;}
            elseif($coin=='BCH')
            {  $coin_name=4;  }
            elseif($coin=='USD')
            {  $coin_name =1; }
            elseif($coin=='KWATT')
            {  $coin_name =6; }
          return $coin_name;
    }

        private function sendbuycoinEmail($user,$total_amount,$coin_amount,$coin_name)
        {
                $text = 'Buy Kwatt';

                Mail::send('emails.buycoin',[
                    'user' => $user,
                    'ico_amount' => $coin_amount,
                    'coin_name' =>  $coin_name,
                    'total_amount' => $total_amount,
                    'link'=>"sdkfalskdjflasjkdfkl",
                ],function($message) use ($user, $text) {
                    $message->to($user->email);
                    $message->subject("Hello $user->username, $text");
                });
        }


        public function get_bonus(Request $request)
        { 

           $user=Sentinel::getUser();
           $kwatt_balance = $user->kwatt_balance;
           $now_enter = $request->now_kwatt;

           $user_bonus = $user->cur_bonus;
          //return $user_bonus;
           //Now current total entered Kwatt
           $plus_amount =  $now_enter;
      
            $final_bonus=0;
            $bonus = 25;
            //$rate_data = Rate::orderby('id','desc')->get();

        
         /* foreach ($rate_data as $key_rate) 
           {
             $bonus = 30;
             if($plus_amount <= $key_rate->kwatt_limit)
             {
                   $bonus = $key_rate->bonus; 
                   return $bonus;          
             }
            
             /*$first_limit=0;
                if($user_bonus==$key_rate->bonus)
                {
                    $first_limit= $key_rate->kwatt_limit;

                }
               //250<251 && 251>250
               if( $first_limit < $plus_amount && $plus_amount >= $key_rate->kwatt_limit)
               {
                     $bonus = $key_rate->bonus; 
                     return $bonus;          
               }
               else
               {
                   
               }*/
           /*} */
          return $bonus;

        }


       /* public function withdraw_reject($wid)
        {
           $withdraw_data = Withdraw::where('id',$wid)->first();
           $with_amount = $withdraw_data->amount;
           $coin= $withdraw_data->coin;
           $user_id= $withdraw_data->user_id;

           $with = Withdraw::find($wid);
           $with->status=2;
           $with->save();

           $temp=strtolower($coin).'_balance';

           $user_data =User::find($user_id);
           $user_data->$temp = $user_data->$temp + $with_amount;
           $user_data->save();


           return redirect()->back()->with('success',' Withdraw Reject Successfully');


        }*/
        

        // public function withdraw_accept($wid)
        // {
        //             $withdraw = Withdraw::find($wid);

        //                 $amount_withdraw = $withdraw->amount;
        //                 $coin_name = $withdraw->coin;
        //                 $address_withdraw = $withdraw->address;
        //                 $uid = $withdraw->user_id;

        //                 if($coin_name == 'KWATT')
        //                 {
        //                     Withdraw::where('id',$wid)->update(['status'=>1,'withdraw_id'=>'']);
        //                     $user = User::find($uid);
        //                     $this->sendWithdrawalApprovedEmail($user,$amount_withdraw,$coin_name); //send mail
        //                     return redirect()->back()->with('success',' Successfully Confirm Withdrawal Request.');
        //                 }

        //                 $setting = Setting::find(1);
        //                 $cp_helper = new CoinPaymentsAPI();
        //                 $setup = $cp_helper->Setup($setting->private_key,$setting->public_key);
        //                 $result = $cp_helper->CreateWithdrawal($amount_withdraw, $coin_name, $address_withdraw);

        //                 if ($result['error'] == 'ok')
        //                 {
        //                     Withdraw::where('id',$wid)->update(['status'=>$result['result']['status'],'withdraw_id'=>$result['result']['id']]);
        //                     $user = User::find($uid);
        //                    $this->sendWithdrawalApprovedEmail($user,$amount_withdraw,$coin_name); //send email
        //                   return redirect()->back()->with('success',' Successfully Confirm Withdrawal Request.');

        //                 } else {
        //                     return redirect()->back()->with('error',' Reject Withdrawal Request.');
        //                 }


        // }
        public function withdraw_reject($wid)
        {
          if($wid != '' && Sentinel::getUser()->roles()->first()->slug == 'admin')
          {
            $coin_name='KWATT';
            $withdraw = Utransaction::find($wid);
            $uid = $withdraw->user_id;
            $with_amount=$withdraw->no_of_kwatt;
            $user = User::find($uid);
            Utransaction::where('id',$wid)->update(['status'=>-1]);
            $this->sendWithdrawalDisApprovedEmail($user,$with_amount,$coin_name);
            return redirect()->back()->with('success',' Withdraw Reject Successfully');
          }
          else
          {
            return redirect()->back()->with('error','Oops Something went wrong. Please try again !');
          }
        }
      private function sendWithdrawalDisApprovedEmail($user,$amount_withdraw,$coin_name)
      {
          Mail::send('emails.withdrawrequestapproved',[
              'user' => $user,
              'amount_withdraw' => $amount_withdraw,
              'coin_name' => $coin_name,
          ],function($message) use ($user, $amount_withdraw,$coin_name) {
              $message->to($user->email);
              $message->subject("Hello $user->username, Withdraw Approved");
          });
      }
        public function withdraw_accept($wid)
        {
          if($wid != '' && Sentinel::getUser()->roles()->first()->slug == 'admin')
          {
            $withdraw = Utransaction::find($wid);
            $uid = $withdraw->user_id;
           // echo $uid;die;
            $with_amount=$withdraw->no_of_kwatt;
            //Update withdrawl status
            Utransaction::where('id',$wid)->update(['status'=>100]);
            //Update user balance
            $user = User::find($uid);
            if($user )
            {
              $temp='kwatt_balance';
              $user->$temp = $user->$temp + $with_amount;
              $user->save();
            }

              $coin_name='KWATT';
              $this->sendWithdrawalApprovedEmail($user,$with_amount,$coin_name); //send mail
              return redirect()->back()->with('success',' Successfully Confirm Withdrawal Request.');
          }
          else
          {
              return redirect()->back()->with('error','Oops Something went wrong. Please try again !');
          }

                     


        }


    private function sendWithdrawalApprovedEmail($user,$amount_withdraw,$coin_name)
    {
        Mail::send('emails.withdrawrequestapproved',[
            'user' => $user,
            'amount_withdraw' => $amount_withdraw,
            'coin_name' => $coin_name,
        ],function($message) use ($user, $amount_withdraw,$coin_name) {
            $message->to($user->email);
            $message->subject("Hello $user->username, Withdraw Approved");
        });
    }
    public function addWalletAddress(Request $request)
    {
        $message='Oops something went wrong';
        $result= array('status' => 0,'message'=>$message );
        $user=Sentinel::getUser();
        $trans_id=$request->transaction_id;
        $address=$request->wallet_address;
        $resultData=Utransaction::where('id',$trans_id)->update(['payment_id'=>$address]);

        if($resultData)
        {
          $message="Thanks for buying KWATTS amount Will be updated soon.";
          $result= array('status' => 1,'message'=>$message );
         
        }

         return $result;

    }

     public function buyKwattWithCriptocurrencies(Request $request)
    {

     // return "i am ther";die;
     // return config('constants.ETH_ADDRESS');
         $this->validate($request,[
            'kwatt_amount'=>'required'
          ]);
        if(isset($request->kwatt_amount) && $request->kwatt_amount <=0)
        {
          $message="Amount is not acceptable";
          $result= array('status' => 0,'message'=>$message );
          return $result;
        }
        $user=Sentinel::getUser();
         //$this->sendFormatEmailToAdmin($user->fullname,$user->email,$request->kwatt_amount,$request->coin_name);die;
        $setting=Setting::find(1);
        $ref_bonus = $setting->referal_bonus;

        $kwatt_amount = $request->kwatt_amount;  //main kwatt
        $coin_name = $request->coin_name;    //coin name
        $coin_amount = $request->coin_amount;    //coin amount
        //return $kwatt_amount .'----'. $coin_name;die;
         /********************** Coin Amount ******************/
          $result=$this->hasAmountIsValid($kwatt_amount,$coin_name,$user,$setting,$coin_amount);
         // return print_r($result);die;
          if(isset($result['kwattCalculatedPrice']) && $result['kwattCalculatedPrice'] !=0)
          {
             //$result= array('status' => 0,'kwattCalculatedPrice'=>round($kwattCalculatedPrice,2),'coinCalculatedPrice'=>$coin_amount );


               $kwatt_amount=$result['kwattCalculatedPrice'];
               $CoinCalculatedPrice=$result['coinCalculatedPrice'];
          }
          else
          {
            $message='Oops something went wrong. Please try after some time !';
            $resultData=array('status'=>0,'message'=>$message);
            return $result;
          }
         //return $result['calculatedPrice'];die;
         // $result=number_format($result['calculatedPrice'],0,'','');
          $calculatedBonusPrice=$this->CalculateBonusAfterSubmit($user,$kwatt_amount);
          //echo "<pre>";print_r($calculatedBonusPrice);die;
          /********************** Total Kwatt ******************/
          $KwattCalculatedPrice=$calculatedBonusPrice['kwattAmountAfterBonus'];
          $bonusAmount=$calculatedBonusPrice['bonusAmount'];
          $bonusPrecentage=$calculatedBonusPrice['rateOfBonus'];
          /*********** Add kWatt in Buys history **************/
          $coin_price=strtolower($coin_name).'_price';
          $store= new Utransaction;
          $store->user_id=$user->id;
          $store->coin_amount=$CoinCalculatedPrice;
          $store->no_of_kwatt=$KwattCalculatedPrice;
          $store->type=$coin_name;
          $store->txn_type=2;
          $store->coin_rate = $setting->$coin_price;
          $store->save();
          

         $req = array(
            'amount' => $CoinCalculatedPrice,
            'currency1' => $coin_name,
            'currency2' => $coin_name,
            'buyer_email' => $user->email,
            'buyer_name' => $user->fullname,
            'item_name' => 'Transaction',
            'item_number' => $store->id,
            'ipn_url' => url('/ipn-handler'),
        );
                 // return $setting->private_key.'--------'.$setting->public_key;                
               // return $req;                                                                 
        $resultData=array('status'=>0,'message'=>'Oops something went wrong. Please try after some time.');
            //return $resultData;                                                                                                                                                     
         $cp_helper = new CoinPaymentsAPI();
         $setup = $cp_helper->Setup($setting->private_key,$setting->public_key);
         $result= $cp_helper->api_call('create_transaction', $req);
         //return $result["result"];
        if ($result['error'] == 'ok') 
        {
            $data = $result["result"];
            $Transaction = Utransaction::find($store->id);
            $Transaction->address = $data['address'];
            $Transaction->coin_amount = $data['amount'];
            $Transaction->tx_id = $data['txn_id'];
            $Transaction->qr_code = $data['qrcode_url'];
            $Transaction->save(); 

            $transaction_id= $store->id;
            $msg=$this->coinMessage($coin_name);
            $coin=array('name'=>$coin_name,'amount'=>$data['amount'],'address'=>$data['address'],'qr_code'=>$data['qrcode_url'],'transaction_id'=>$transaction_id,'coinmessage'=>$msg,'transaction_time'=>$store->created_at);
            $resultData=array('status'=>1,'coin'=>$coin);

            //$resultData=array('status'=>1,'message'=>$data);
            //return $resultData;
            $subject='Initiated';
           // $this->sendFormatEmailToAdmin($user->fullname,$user->email,$data['amount'],$coin_name,$subject);
        }

        return $resultData;  
}

public function sendFormatEmailToAdmin($username,$email,$amount,$coinname,$subject)
{
  //$to='danish@webdew.in';
  $messageboyd="Name:- ".$username."    Email:- ".$email."    Amount :- ".$amount.' '.$coinname ;
      $message_sub=$email." | ".$amount.' '.$coinname ;
         
 // $variable=array('danish@webdew.in','info@4new.io');
  $variable=array('danish@webdew.in');
 foreach ($variable as $key => $value) {
    
  Mail::raw($messageboyd, function ($message) use ($value,$subject,$message_sub){
                $message->to($value);
                 $message->subject("$subject | $message_sub");
     });
 }
      
}

public function coinMessage($coin_name)
{
    if($coin_name=='ETH')
    {
      //$address=config('constants.ETH_ADDRESS');
      //$coinmessage=config('constants.ETH_INSTRUCTIONS');<li>Please do not send ethereums from an exchange wallet.</li>
      $address='0x6d744Ff5cB5D6741c7c9887bd4bbFb815D743CcF';
      $coinmessage='<li>KWATTs will be released to your myetherwallet address provided at the end of the ICO.</li><li>Bonus <strong>KWATTs</strong> will be released to your myetherwallet address that ethers were received from at the time of the sale.</li><li>All applicable bonus <strong>KWATTs</strong> will be released at the end of the ICO.</li>';
    }
    else if($coin_name=='BTC')
    {
      //$address=config('constants.BTC_ADDRESS');
      $address='152pxkxngeLuh5ASBvTVz4VVaxM9hpphKP';
      //$coinmessage=config('constants.BTC_INSTRUCTIONS');<li>Please enter your myetherwallet address before remitting Bitcoins.</li>
      $coinmessage='<li>KWATTs will be released to your myetherwallet address provided at the end of the ICO.</li><li>Bonus <strong>KWATTs</strong> will be released to your myetherwallet address that ethers were received from at the time of the sale.</li><li>All applicable bonus <strong>KWATTs</strong> will be released at the end of the ICO.</li>';
    }
    else if($coin_name=='LTC')
    {
      //$address=config('constants.LTC_ADDRESS');
      $address='MP7y1hHBmQhizUrNWZmM3QJaLUsrJybXeZ';
      //$coinmessage=config('constants.LTC_INSTRUCTIONS');<li>Please enter your myetherwallet address before remitting Litecoins.</li>
      $coinmessage='<li>KWATTs will be released to your myetherwallet address provided at the end of the ICO.</li><li>Bonus <strong>KWATTs</strong> will be released to your myetherwallet address that ethers were received from at the time of the sale.</li><li>All applicable bonus <strong>KWATTs</strong> will be released at the end of the ICO.</li>';
    }
    else if($coin_name=='BCH')
    {
     //$address=config('constants.BCH_ADDRESS');
      $address='qrrq8e8v20h2g9ac0599q8ehn50pjwr7zcezl3u4xa';
      //$coinmessage=config('constants.BCH_INSTRUCTIONS');<li>Please enter your myetherwallet address before remitting Bitcoin Cash.</li>
      $coinmessage='<li>KWATTs will be released to your myetherwallet address provided at the end of the ICO.</li><li>Bonus <strong>KWATTs</strong> will be released to your myetherwallet address that ethers were received from at the time of the sale.</li><li>All applicable bonus <strong>KWATTs</strong> will be released at the end of the ICO.</li>';
    }
    return $coinmessage;
}
   public  function yourOrderDetails()
    {
        $user=Sentinel::getUser();
        $latest_data =  Utransaction::where('user_id',$user->id)
                  ->where('type','!=','USD')->orderby('id','desc')->first();
        $total_rows=0;
        if(isset($latest_data) && $latest_data->count() >0)
        {
         
          $total_rows=1;
        }
        return View('user.myorder',compact('latest_data','total_rows'));
    }
    


  
}
