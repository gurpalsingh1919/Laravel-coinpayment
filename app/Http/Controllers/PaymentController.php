<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Setting;
use App\CoinPaymentsAPI;
use App\Models\Rate;
use App\Models\Deposit;
use App\Models\BillingInfo;
use App\User;
use Sentinel;
use App\Http\Controllers\WalletController;
use App\Models\Utransaction;
use App\Models\Kwattledger;
use App\Models\Referal;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LoginController;
use Mail;
use Log;

class PaymentController extends Controller
{

    public function __construct()
    {
        $this->walletcontroller = new WalletController;
        $this->ProfileController= new ProfileController;
    }
    public function IpnHandler(Request $request)
    {

        Storage::disk('local')->put($request->item_name.'-'.$request->item_number.'.txt', json_encode($request->all()));
        $cps = new CoinPaymentsAPI();
        $setting = Setting::first();
        $ref_bonus = $setting->referal_bonus;
        $cps->Setup($setting->private_key,$setting->public_key);
        $cps->verify_ipn($request);
        //echo $request->status;die;
        $user='';
        $deposit = Utransaction::where('id',$request->item_number)->first();
        if(isset($deposit) && isset($deposit->user_id) && $deposit->user_id !='')
        {
          $user_id=$deposit->user_id;
          $user=user::find($user_id);
          if($request->status ==-1)
          {
             $this->sendTxnTimeoutEmail($user);

              $deposit = Utransaction::where('id',$request->item_number)->first();
              $coin_name = $deposit->type; //For Update balance
              $userid = $deposit->user_id; //for perticular user
              $preCoinAmount=$deposit->coin_amount;

             // $coin_name="USD";
              $subject='Timeout';
            // $this->walletcontroller->sendFormatEmailToAdmin($user->fullname,$user->email,$preCoinAmount,$coin_name,$subject);
          }
        }
        if($request->status >= 100)
        {
          if($request->item_number)
          {
                if($request->status ==100)
               {
                      $deposit = Utransaction::where('id',$request->item_number)->first();
                      $coin_name = $deposit->type; //For Update balance
                      $userid = $deposit->user_id; //for perticular user
                      $preCoinAmount=$deposit->coin_amount;
                      $coin_rate= $deposit->coin_rate;
                      $coin_amount=$request->received_amount;
                      $tx_id=$deposit->tx_id;
                      if($coin_amount < $preCoinAmount)
                      {
                           $no_of_kwatt = $this->getKwattAmountFromCoinAmount($coin_rate,$coin_amount,$setting,$user); //for perticular user
                      }
                      else
                      {
                        $no_of_kwatt = $deposit->no_of_kwatt;
                      }
                     
                      
                        if($deposit->status !=100)
                        {
                            $dp = Utransaction::find($request->item_number);
                            $dp->status = 100;
                            $dp->coin_amount = $request->received_amount;
                            $dp->no_of_kwatt = $no_of_kwatt;
                            $dp->save();
                            /*************** Kwatt Leadger history ****************/
                           // $walletcontroller= new WalletController;
                            // $kwatt_ledger= new Kwattledger;
                            // $kwatt_ledger->user_id=$userid;
                            // $kwatt_ledger->noOfKwatt=$no_of_kwatt;
                            // $kwatt_ledger->type=2;
                            // $kwatt_ledger->coin=$this->walletcontroller->getCoinEnum($coin_name);
                            // $kwatt_ledger->save();

                            $temp= strtolower($coin_name).'_balance';
                            $kwatt='kwatt_balance';  // Edit Balance
                            $user = User::find($userid);
                            $user->$temp =  $user->$temp + $request->received_amount;
                            $user->$kwatt =  $user->$kwatt + $no_of_kwatt;
                            $user->save();

                            if($user->parent_id != 0 || $user->parent_id !=NULL)
                            {
                              $transaction_id=$deposit->id;
                              $this->AddReferalBonusToParent($user,$no_of_kwatt,$ref_bonus,$transaction_id);
                            }

                            $this->sendPaymentSuccessEmail($user,$dp);
                            //$coin_name="USD";
                        $subject='Success';
                        $coin_amount=$dp->coin_amount;
                        $coin_type=$dp->type;
                        //$this->walletcontroller->sendFormatEmailToAdmin($user->fullname,$user->email,$coin_amount,$coin_name,$subject);
                        
                        $this->trackingListner($coin_amount,$tx_id,$coin_type);
                        $this->sale_tracking_listner();
                            die('IPN OK');
                        }
                        else
                        {
                           Utransaction::where('id',$request->item_number)->update(['status' => $request->status]);
                          
                        }
                    }
                    else
                    {
                       Utransaction::where('id',$request->item_number)->update(['status' => $request->status]);
                       
                    }
            }
            else
            {
              Utransaction::where('id',$request->item_number)->update(['status' => $request->status]);
              
            }
        }
        else if($request->status == -1)
        {
             Utransaction::where('id',$request->item_number)->update(['status' => -1]);
             
        }
        else
        {
            Utransaction::where('id',$request->item_number)->update(['status' => $request->status]);
           
        }
    }
    public function trackingListner($amount,$order_id,$coin_type)
    { 

      $base_url=url('/');
      if(isset($amount) && $amount !='' && isset($order_id) && $order_id !='')
      {
          $url=$base_url.'/tracking-listner?currency='.$coin_type.'&amount='.$amount;
          //echo $url;die;
          $curl_handle=curl_init();
          curl_setopt($curl_handle, CURLOPT_URL,$url);
          curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
          curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($curl_handle, CURLOPT_USERAGENT, '4NEW');
          //curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "POST");
          //curl_setopt($curl_handle, CURLOPT_POSTREDIR, 3);
          curl_setopt($curl_handle, CURLOPT_FOLLOWLOCATION, true);
          $query = curl_exec($curl_handle);
          //echo $query;
          curl_close($curl_handle);
      }
        
    }
    public function sale_tracking_listner()
    {
      $base_url=url('/');
     // if(isset($amount) && $amount !='' && isset($order_id) && $order_id !='')
      //{
          $url=$base_url.'/sale-confirm';
          $curl_handle=curl_init();
          curl_setopt($curl_handle, CURLOPT_URL,$url);
          curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
          curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($curl_handle, CURLOPT_USERAGENT, '4NEW');
          //curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "POST");
          //curl_setopt($curl_handle, CURLOPT_POSTREDIR, 3);
          curl_setopt($curl_handle, CURLOPT_FOLLOWLOCATION, true);
          $query = curl_exec($curl_handle);
          //echo $query;
          curl_close($curl_handle);
      //}
        
    }
    public function getKwattAmountFromCoinAmount($coin_rate,$coin_amount,$settings,$user)
    {
      $usd_rate=$settings->usd_rate;
      $kwatAmount=($coin_rate/$usd_rate)*$coin_amount;
      $calculatedBonusPrice=$this->walletcontroller->CalculateBonusAfterSubmit($user,$kwatAmount);
      $KwattCalculatedPrice=$calculatedBonusPrice['kwattAmountAfterBonus'];
      return $KwattCalculatedPrice;

    }
    private function sendPaymentSuccessEmail($user,$deposit)
    {
        Mail::send('emails.paymentSuccess',[
            'user' => $user,
            'deposit'=>$deposit,
            
        ],function($message) use ($user) {
            $message->to($user->email);
            $message->subject("Hello $user->username, Payment Success");
        });
    } 
    private function sendTxnTimeoutEmail($user)
    {
        Mail::send('emails.txntimeout',[
            'user' => $user
            
        ],function($message) use ($user) {
            $message->to($user->email);
            $message->subject("Hello $user->username, Oops! Did you forget something?");
        });
    }
    public function AddReferalBonusToParent($user,$no_of_kwatt,$ref_bonus,$transaction_id)
    {
        $parent_data = User::where('id',$user->parent_id)->first();
        if($parent_data)
        {
           $add_amount= $no_of_kwatt * $ref_bonus/100;
           $parent_user= User::find($user->parent_id);
           $parent_user->kwatt_balance = $parent_user->kwatt_balance + $add_amount;
           $parent_user->save();

          $ref=new Referal;
          $ref->user_id= $user->id;
          $ref->buy_id= $transaction_id;
          $ref->ref_user_id= $user->parent_id;
          $ref->ref_amount= $add_amount;
          $ref->level= 1;
          $ref->save();

          $store= new Utransaction;
          $store->user_id=$user->parent_id;
          $store->coin_amount=0;
          $store->no_of_kwatt=$add_amount;
          $store->type='KWATT';
          $store->txn_type=4;
          $store->status=100;
          $store->save();

          $kwatt_ledger= new Kwattledger;
          $kwatt_ledger->user_id=$user->parent_id;
          $kwatt_ledger->noOfKwatt=$add_amount;
          $kwatt_ledger->type=4;
          $kwatt_ledger->coin=6;
          $kwatt_ledger->save();
          }
    }
    

    public function get_deposit(Request $request)
    {
       $user=Sentinel::getUser();

       $coin=$request->coin;
       $amount=$request->btc_val;
       $usd_amount=$request->usd_amount;
       $data = array();
          if($amount == "")
          {  $data[0] = 0;
          }
 
       // Add Deposite data to deposit table 
        $store = new Deposit;
        $store->user_id = $user->id;
        $store->coin  = $coin;
        $store->usd_amount = $usd_amount;
        $store->save();

        $setting = Setting::where('id',1)->first();

           $req = array(
            'amount' => $amount,
            'currency1' => $coin,
            'currency2' => $coin,
            'buyer_email' => $user->email,
            'buyer_name' => $user->username,
            'item_name' => 'Deposit',
            'item_number' => $store->id,
            'ipn_url' => url('/ipn-handler'),
        );
                 // return $setting->private_key.'--------'.$setting->public_key;                
               // return $req;                                                                                                                                                                                                                     
         $cp_helper = new CoinPaymentsAPI();
         $setup = $cp_helper->Setup($setting->private_key,$setting->public_key);
         $result= $cp_helper->api_call('create_transaction', $req);
         //return $result["result"];
        if ($result['error'] == 'ok') 
        {
            $data = $result["result"];
            $store = Deposit::find($store->id);
            $store->address = $data['address'];
            $store->amount = $data['amount'];
            $store->tx_id = $data['txn_id'];
            $store->save(); 

             return $data;


        }

        return $data;    
    }
    public function postPayWithMasterCard(Request $request)
    {
        //echo LoginController::getClientIP();
      //echo "<pre>";print_r($request->all()); die;
      //echo session('error');
      //$ip= \Request::ip();
     // echo $ip;die;
      //return print_r($request->all());die;
      $this->validate($request, [
     'coin_amounts'=>'required'
        ]);
      //return print_r($result);die;
      //echo "<pre>";print_r($request->all());die;
     // echo $request->kwatt_amounts;
      //die;
       //echo $request->card;die;
      if($request->card =='' || $request->card !='master' )
      {
        // if(($request->card !='visa' || $request->card !='master'))
        // {
        //   return redirect('dashboard')->with('error','Please Select Payment Option !!');
        // }

        
          return redirect('dashboard')->with('error','Please Select Valid Payment Option !!');
        
      }
      $card_type=$request->card;
      $user=Sentinel::getUser();
      $settings=Setting::find(1);
      $username= $user->username;
     // $kwatt_amount=$request->kwatt_amounts;
      $coin_amount=$request->coin_amounts;
      $user_id= $user->id;
      $usd_rate=$settings->usd_rate;
      $coin_name='USD';
      $kwatt_amount=0;
      $result=$this->walletcontroller->hasAmountIsValid($kwatt_amount,$coin_name,$user,$settings,$coin_amount);
        
      if(isset($result['kwattCalculatedPrice']) && $result['kwattCalculatedPrice'] !=0)
      {
        $kwatt_amountss=$result['kwattCalculatedPrice'];
        $calculatedBonusPrice=$this->walletcontroller->CalculateBonusAfterSubmit($user,$kwatt_amountss);
        /********************** Total Kwatt ******************/
        $KwattCalculatedPrice=$calculatedBonusPrice['kwattAmountAfterBonus'];
        $CoinCalculatedPrice=$result['coinCalculatedPrice'];
      }
      else
      {
        $message='Oops something went wrong. Please try after some time !';
        return redirect()->back()->with('error',$message);
       
      }

      $usd_amount=$CoinCalculatedPrice;
      $kwatt_amount=$KwattCalculatedPrice;
      /******* Create Deposits************/
        $store = new Utransaction;
        $store->user_id = $user_id;
        $store->no_of_kwatt = $kwatt_amount;
        $store->type  = 'USD';
        $store->txn_type=2;
        $store->coin_amount = $usd_amount;
        $store->save();
        $order_id=$store->id;
        $countries=$this->ProfileController->getCountries();
        $months=$this->ProfileController->GetMonth();
        $Year=$this->ProfileController->GetYear();
        
        $fullname=$user->fullname;
        $name=explode(' ', $fullname);
        $first_name='';
        $last_name='';
        if(isset($name[0]) && $name[0] !='')
        {
          //echo $user->first_name;die;
          $first_name=$name[0];
          if(isset($user->first_name) && $user->first_name !='')
          {
            $first_name=$user->first_name;
          }

        }
        if(isset($name[1]) && $name[1] !='')
        {
          $last_name=$name[1];
          if(isset($user->last_name) && $user->last_name !='')
          {
            $last_name=$user->last_name;
          }
        }
         $email= $user->email;
        //echo "<pre>";print_r($countries);die;
         //$coin_name="USD";
         $subject='Initiated';
          //$this->walletcontroller->sendFormatEmailToAdmin($user->fullname,$user->email,$coin_amount,$coin_name,$subject);
        return View('user.master_card_payment',compact('usd_amount','order_id','countries','merchant_id','first_name','last_name','email','user','months','Year','card_type'));
    }

    public function payWithMyMastercard(Request $request)
    {
      //echo "<pre>";print_r($request->all());die;
       $this->validate($request, [
         'firstName'=>'required',
         'lastName'=>'required',
         'email'=>'required|email',
         'phone'=>'required',
         'country'=>'required',
         'state'=>'required',
         'city'=>'required',
         'address'=>'required',
         'zip'=>'required',
         'cardNo'=>'required',
         'cardExpireMonth'=>'required',
         'cardExpireYear'=>'required',
         'cardSecurityCode'=>'required|min:3|max:4',
         'issuingBank'=>'required',

         ]);


       /**************************************************/
      // $billinginfo=new BillingInfo;
      // $billinginfo->user_id=
       $merNo            = "21530"; //MerchantNo.
          
       if($request->card=='master')
       {
          $gatewayNo        = "21530002"; //GatewayNo.21530002
          $signkey          = "nd6DrTh2"; //SignKey
       }
       /*elseif($request->card=='visa')
       {
          $gatewayNo        = "21530001"; //GatewayNo.21530002
          $signkey          = "l26z0RdP"; //SignKey
       }*/
       else
       {
          return redirect('dashboard')->with('error','Please Select Payment Option !!');
       }
       

        $orderNo          = trim($request->orderNo);
        $orderCurrency    = trim($request->orderCurrency);
        $orderAmount      = trim($request->orderAmount);
        $firstName        = trim($request->firstName);
        $lastName         = trim($request->lastName);
        $cardNo           = trim($request->cardNo);
        $cardExpireYear   = trim($request->cardExpireYear);
        $cardExpireMonth  = trim($request->cardExpireMonth);
        $cardSecurityCode = trim($request->cardSecurityCode);
        $email            = trim($request->email);

      $issuingBank      = trim($request->issuingBank);

      $phone            = trim($request->phone);
      $ips= isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? 
     $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
     
      $ip               = trim($ips);

      $signInfo         = hash("sha256" , $merNo . $gatewayNo . $orderNo . $orderCurrency . $orderAmount . $firstName . $lastName.$cardNo.$cardExpireYear.$cardExpireMonth.$cardSecurityCode.$email.$signkey );
      $user=Sentinel::getUser();


    // echo $signInfo;//die;
       
      $country          = trim($request->country);

      $state            = trim($request->state);

      $city             = trim($request->city);

      $address          = trim($request->address);

      $zip              = trim($request->zip);

      $returnUrl        = trim($request->returnUrl); //real trading websites

      $csid             = trim($request->csid);

      $card_info = substr($cardNo, -4);

      $billinginfo = new BillingInfo;
      $billinginfo->user_id=$user->id;
      $billinginfo->first_name=$firstName;
      $billinginfo->last_name=$lastName;
      $billinginfo->address=$address;
      $billinginfo->city=$city;
      $billinginfo->state=$state;
      $billinginfo->country=$country;
      $billinginfo->phone=$phone;
      $billinginfo->email=$email;
      $billinginfo->zipcode=$zip;
      $billinginfo->order_id=$orderNo;
      $billinginfo->card_type=$request->card;
      $billinginfo->card_info='************'.$card_info;
      $billinginfo->save();
     
       //*********************Payment Detail ****************************/
      $arr = array(
             'merNo'            => $merNo,            //MerchantNo.
             'gatewayNo'        => $gatewayNo,        //GatewayNo.
             'orderNo'          => $orderNo,          //OrderNo.
             'orderCurrency'    => $orderCurrency,    //OrderCurrency
             'orderAmount'      => $orderAmount,      //OrderAmount
             'firstName'        => $firstName,        //FirstName
             'lastName'         => $lastName,         //lastName
             'cardNo'           => $cardNo,           //CardNo
             'cardExpireMonth'  => $cardExpireMonth,  //CardExpireMonth
             'cardExpireYear'   => $cardExpireYear,   //CardExpireYear
             'cardSecurityCode' => $cardSecurityCode, //CVV
             'issuingBank'      => $issuingBank,      //IssuingBank
             'email'            => $email,            //EmailAddress
             'ip'               => $ip,               //ip
             'returnUrl'        => $returnUrl,          //real trading websites
             'phone'            => $phone,            //Phone Number 
             'country'          => $country,          //Country
             'state'            => $state,            //State
             'city'             => $city,             //City
             'address'          => $address,          //Address
             'zip'              => $zip,              //Zip Code
             'signInfo'         => $signInfo ,         //SignInfo 
             'csid'             => $csid
            );
      
       $data =  http_build_query($arr);
       //echo "<pre>";print_r($data);die;
       $url  = "https://online-safest.com/TPInterface"; 
      // $url  = "https://online-safest.com/TestTPInterface"; 
       // Test Interface ---> https://online-safest.com/TestTPInterface  
      
       
            
            //===============================
                $curl = curl_init($url);
            curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($curl,CURLOPT_HEADER, 0 ); // Colate HTTP header
            curl_setopt($curl,CURLOPT_RETURNTRANSFER, 1);// Show the output
            curl_setopt($curl,CURLOPT_POST,true); // Transmit datas by using POST
            curl_setopt($curl,CURLOPT_POSTFIELDS,$data);//Transmit datas by using POST
            curl_setopt($curl,CURLOPT_REFERER,$returnUrl);
            $xmlrs = curl_exec($curl);
            curl_close ($curl); 

            $xmlob = simplexml_load_string(trim($xmlrs));

            
            $merNo        = (string)$xmlob->merNo; //return merNo    
            //echo $merNo;die;
            $gatewayNo    = (string)$xmlob->gatewayNo;//return gatewayNo
            $tradeNo      = (string)$xmlob->tradeNo;//return tradeNo
            $orderNo      = (string)$xmlob->orderNo;//return orderno
            $orderAmount  = (string)$xmlob->orderAmount;//return orderAmount
            $orderCurrency= (string)$xmlob->orderCurrency;//return orderCurrency
            $orderStatus  = (string)$xmlob->orderStatus;//return orderStatus
            $orderInfo    = (string)$xmlob->orderInfo;//return orderInfo
            $signInfo     = (string)$xmlob->signInfo;//return signInfo
            $riskInfo     = (string)$xmlob->riskInfo;//return riskInfo
 
            //=================================================================================//

            $xmlob = simplexml_load_string(trim($xmlrs));
            $json=json_encode($xmlob);
            $Transaction = BillingInfo::find($billinginfo->id);
            $Transaction->response = $json;
            $Transaction->save();


            $merNo        = (string)$xmlob->merNo; //return merNo    
            $gatewayNo    = (string)$xmlob->gatewayNo;//return gatewayNo
            $tradeNo      = (string)$xmlob->tradeNo;//return tradeNo
            $orderNo      = (string)$xmlob->orderNo;//return orderno
            $orderAmount  = (string)$xmlob->orderAmount;//return orderAmount
            $orderCurrency= (string)$xmlob->orderCurrency;//return orderCurrency
            $orderStatus  = (string)$xmlob->orderStatus;//return orderStatus
            $orderInfo    = (string)$xmlob->orderInfo;//return orderInfo
            $signInfo     = (string)$xmlob->signInfo;//return signInfo
            $riskInfo     = (string)$xmlob->riskInfo;//return riskInfo
            $responseCode=(string)$xmlob->responseCode;
            //signInfocheck
            $signInfocheck=hash("sha256",$merNo.$gatewayNo.$tradeNo.$orderNo.$orderCurrency.$orderAmount.$orderStatus.$orderInfo.$signkey);
            $error=$this->getErrorMessage();
            //echo $responseCode;
           // echo "<pre>";print_r($error[$responseCode]);die;
            if(isset($error[$responseCode]))
            {
              $erromessage=$responseCode.'-'.$error[$responseCode];
            }
            else
            {
              if ($orderInfo=='Please input 13 or 16 digit') {
                  $orderInfo='Please enter your 13 or 16 digits card number';
                }
                elseif ($orderInfo=='Card No. is incorrect') {
                  $orderInfo='There seems to be something wrong with your card number, please recheck your input.';
                }
                elseif ($orderInfo=='Do not honor') {
                  $orderInfo='Your transaction has been declined. This might happen because your bank has blocked your transaction. Please call your bank to authorize it and then try again to complete the transaction.';
                }
                elseif ($orderInfo=='Failed') {
                  $orderInfo='Due to multiple transaction attempts, you email or IP has been blocked by our security check. Please try placing a new order after 24 hours using a different email address.';
                }
                elseif ($orderInfo=='Declined') {
                  $orderInfo='Your transaction has been declined. Unfortunately, our payment processor is not accepting your card. Please try another card.';
                }
                elseif ($orderInfo=='Merchant  unbinds the channel') {
                  $orderInfo='Your transaction has been declined. We support Master Card and JCB Cards only.';
                }
                elseif ($orderInfo=='Not sufficient funds') {
                  $orderInfo='Your transaction has been declined. The card doesn\'t hold enough funds to make this payment.';
                }
                elseif ($orderInfo=='Duplicate Order') {
                  $orderInfo='Your transaction has been declined. A similar transaction was submitted in our system.';
                }
                elseif ($orderInfo=='Invalid issuer') {
                  $orderInfo='Invalid Bank Details';
                }
                elseif ($orderInfo=='Transaction not permitted to card holder') {
                  $orderInfo='Your transaction has been declined. Please try using a different card.';
                }
                elseif ($orderInfo=='Invalid transaction') {
                  $orderInfo='Your transaction has been declined. Please try using a different card.';
                }
              $erromessage=$orderInfo;
             //echo "<pre>"; print_r($xmlob);
            }
///echo $signInfocheck;
          // die;
            
            Storage::disk('local')->put('mastercard/'.'transaction-'.$orderNo.'.txt',$json);
            //Returned signinfo of the encrypted string is capitalized, converted to lowercase, having returned encrypted signinfo string compare with the generated encrypted signainfo.
            if (strtolower($signInfo) == strtolower($signInfocheck))
            {

                  //if return success
                  if($orderStatus == 1)
                  {
                        /* payment success,update orderInfo */
                        //echo 'success:- '.$orderInfo;
                        $deposit_data = Utransaction::find($orderNo);
                         if(isset($deposit_data))
                         {
                            $user_id=$deposit_data->user_id;
                            $no_of_kwatt=$deposit_data->no_of_kwatt;
                            if($deposit_data->status !='100')
                            {
                              $kwatt='kwatt_balance'; 
                              $user = User::find($user_id);
                                //$user->$temp =  $user->$temp + $coin_amount;
                              $user->$kwatt =  $user->$kwatt + $no_of_kwatt;
                              $user->save();

                              $setting = Setting::find(1);
                              $setting->total_coins=$setting->total_coins - $no_of_kwatt;
                              $setting->save();

                              $deposit_data->status=100;
                              $deposit_data->tx_id=$tradeNo;
                              $deposit_data->save();
                              $this->sendPaymentSuccessEmail($user,$deposit_data);

                              $coin_name="USD";
                              $subject='Success';
                              $coin_amount=$deposit_data->coin_amount;
                              //$this->walletcontroller->sendFormatEmailToAdmin($user->fullname,$user->email,$coin_amount,$coin_name,$subject);

                              if($user->parent_id != 0 || $user->parent_id !=NULL)
                              {
                                $transaction_id=$deposit_data->id;
                                $setting = Setting::first();
                                $ref_bonus = $setting->referal_bonus;
                                //$PaymentController= $this->PaymentController;
                                $this->AddReferalBonusToParent($user,$no_of_kwatt,$ref_bonus,$transaction_id);
                              }
                                $this->trackingListner($coin_amount,$tradeNo,'USD');
                                $this->sale_tracking_listner();

                            } 
                         }

                         return redirect('dashboard')->with('paymentsuccess','1');
                  }
                  else
                  {
                    return redirect()->back()->with('error',$erromessage);
                  }
            }
            else
            {
              return redirect()->back()->with('error',$erromessage);
            }




    }
    public function getErrorMessage()
    {
      return $mv_errors = array(         
            'I0001' => 'Merchant No. can not be empty',
            'I0002' => 'Gateway No.can not empty',
            'I0003' => 'Encrypted value can not be empty',
            'I0004' => 'Gateway of Merchant No.is incorrect',
            'I0005' => 'Merchant No.is not actived',
            'I0006' => 'Merchant No. is disabled',
            'I0007' => 'Merchant No.is canceled',
            'I0008' => 'The state of merchant No. is anomalous',
            'I0009' => 'Gateway No. is not actived',
            'I0010' => 'Gateway No. is disabled',
            'I0011' => 'Gateway No.is canceled',
            'I0012' => 'The state of gateway No.is anomalous',
            'I0013' => 'Encryption value is incorrect',
            'I0014' => 'Informal gateway No. accesses to formal interface',
            'I0015' => 'Untested gateway No. accesses to test interface',
            'I0016' => 'The gateway No. does not blind the interface',
            'I0017' => 'Merchant order No. is empty',
            'I0018' => 'Order No. can not exceed 50 characters',
            'I0019' => 'Order value can not be empty',
            'I0020' => 'Order value is incorrect',
            'I0021' => 'Invalid format of amount Two decimal places support and the amount must be greater than zero',
            'I0022' => 'Order currency is empty',
            'I0023' => 'Order currency is incorrect',
            'I0024' => 'Return URL can not be empty',
            'I0025' => 'The length of returnning URL can not exceed 1000 characters',
            'I0026' => 'Card No can not be empty',
            //'I0027' => 'Please input 13 to 16 digit',
            'I0027' => 'Please enter your 13 or 16 digits card number',
            'I0028' => 'Card number should be digit',
            'I0029' => 'The card type entered is not currently supported.',
            //'I0030' => 'Card No. is incorrect',
            'I0030' => 'There seems to be something wrong with your card number, please recheck your input.',
            'I0031' => 'Month can not be empty',
            'I0032' => 'The month should be two digits only',
            'I0033' => 'The month should be digit',
            'I0034' => 'The month should be between 1-12',
            'I0035' => 'Year can not be empty',
            'I0036' => 'The year should be four digits only',
            'I0037' => 'The year should be digit',
            'I0038' => 'Year and month can not be smaller than current date and
            greater than 10 year',
            'I0039' => 'Verification code can not be empty',
            'I0040' => 'Please input 3-digit or 4-digit Verification code',
            'I0041' => 'Security code should bu digit',
            'I0042' => 'Issuing bank can not be empty',
            'I0043' => 'Issuing bank should be 2-50 characters only',
            'I0044' => 'First name can not be empty',
            'I0045' => 'First name should be within 2-50 characters',
            'I0046' => 'Last name can not empty',
            'I0047' => 'Last name should be within 2-50 characters',
            'I0048' => 'E-mail address can not be empty',
            'I0049' => 'E-mail address should be within 2-100 characters',
            'I0050' => 'E-mail address format is incorrect',
            'I0051' => 'The phone number of card holder can not be empty',
            'I0052' => 'phone number should be within 2-50 characters',
            'I0053' => 'The country of cardholder can not be empty',
            'I0054' => 'country should be within 2-50 characters',
            'I0055' => 'The address of cardholder can not be empty',
            'I0056' => 'address should be within 2-500 characters',
            'I0057' => 'Zip code of cardholder can not be empty',
            'I0058' => 'Zip code should be within 2-50 characters',
            'I0059' => 'Required parameter can not be empty',
            'I0060' => 'Incorrect length parameter',
            'I0061' => 'There has been a successful transaction of this order No.
            within 24 hours',
            'I0062' => 'Host index exists',
            'I0063' => 'State/Province of cardholder can not be empty',
            'I0064' => 'State should be within 2-50 characters',
            'I0065' => 'City of cardholder can not be empty',
            'I0066' => 'City should be within 2-50 characters',
            'I0067' => 'Remark should be within 2-500 characters',
            'I0068' => 'It did not pass 2-Party limitation',
            'I0069' => 'Please select payment method',
            'I0070' => 'Please select payment type',
            'I0071' => 'IP address can not be empty',
            'I0072' => 'IP address format is incorrect',
            'I0092' => 'Payment method error',
            'I0115' => 'Not find the record',
            'I0116' => 'The merchant do not sopport the shortcut',
            'R0000' => 'Our payment service provider declined this transaction considering it as high risk, Please make sure you have entered the correct billing details or try a different card.',
            'R0001' => 'The website was not submitted/registered',
            'R0002' => 'Cross-border transaction',
            'R0003' => 'Our payment service provider declined this transaction considering it as high risk, Please make sure you have entered the correct billing details or try a different card.',
            'R0004' => 'Our payment service provider declined this transaction considering it as high risk, Please make sure you have entered the correct billing details or try a different card.',
            'R0015' => 'Our payment service provider declined this transaction considering it as high risk, Please make sure you have entered the correct billing details or try a different card.',

            'R0014' => 'Do not set up the limitation of amount',
            'C0001' => 'Your transaction has been declined. We support Master Card and JCB Cards only.',
           // 'C0002' => 'Merchant gateway No. do not set up deduction rate',
            'C0002' => 'Your transaction has been declined. We support Master Card and JCB Cards only.',

            'C0003' => 'Channel deduction rate of merchant gateway No. is incorrect',
            'C0004' => 'Channel currency does not set up',
            'C0005' => 'The exchange rate of currency does not set up',
            'C0006' => 'Obtaining currency failed',
            'C0007' => 'Merchant does not bind payment domain name',
            'C0008' => 'Merchant gateway No. do not bind channel {0}',
            'C0009' => 'Merchant gateway No.do not set up deduction rate',
            'C0010' => 'The settlement currency does not exist',
            'C0011' => 'The settlement exchange rate does not set up',
            'C0012' => 'Merchant does not bind payment submit url',
            'C0014' => 'Rate ratio does not set up',
            'C0013' => 'The card type entered is not currently supported.',
            'S0013' => 'System Exception',
            'S0014' => 'Channel does not bind e-mail domain name',
            'E0001' => 'The operation has timed out',
            'E0002' => 'The operation has timed out',
            //'E0006' => 'Receiving ',
            'E0006' => 'The channel code that the bank returned does not exist',
            
            'E0007' => 'System Error',
            'E0008' => 'Please do not submit payments repeatedly',
            'E0009' => 'Wrong operation',
            'P0000' => 'Repay parameter error',
            'P0001' => 'Transaction does not exist',
            'P0002' => 'Query the transaction exception',
            'P0003' => 'Transaction are not allowed to pay again',
            'P0004' => 'Transaction has exceeded the validity period',
            'P0005' => 'Data decryption failure',
            'P0006' => 'Transaction is not credit card payment',
            'P0007' => 'GatewayNo is not allowed to pay again',
            'T0001' => 'Transaction succeeded we do not charge any fees for testingtransation',
            'T0002' => 'Pending',
            'T0003' => 'Successed two party does not connect to the bank',
            //'T0004' => 'Transaction failed',
            'T0004' => 'Due to multiple transaction attempts, your email or IP has been blocked by our security check. Please try placing a new order after 24 hours using a different email address.',
            'T0005' => 'To be confirmed',
            'U0001' => 'Customer cancel',
            //'U0002' => 'Transaction failed',
            'U0002' => 'Due to multiple transaction attempts, your email or IP has been blocked by our security check. Please try placing a new order after 24 hours using a different email address.',

            );
    }
    public function mastercardreturn_url(Request $request)
    {
      $json=json_encode($request->all());
      Log::write('DEBUG',  $json);

      
      //Storage::disk('local')->put('master/'.Carbon::now()->format('Ymd_His').'-'.$request->code.'.txt', 
        //$json);
      //$txn_id=$request->id;
      //$verified = $this->verifyAnotherPayment($txn_id);
      //Log::write('DEBUG',  $verified);
      /*if ($verified==200) 
      {

        if(isset($request->availed) && $request->availed =='true')
          {
              $order_id=$request->code;
              $ordercode=explode('-', $order_id);
              if(isset($ordercode[1]) && $ordercode[1] !='')
              {
                $deposit_id=$ordercode[1];
              }
              $deposit = Utransaction::find($deposit_id);
              $coin_name = $deposit->type;
              $userid=$deposit->user_id;
              $dp_status=$deposit->status;
              $no_of_kwatt=$deposit->no_of_kwatt;
              $user = User::find($userid);
              if($dp_status !=100)
              {
                  $temp= strtolower($coin_name).'_balance';  // Edit Balance
                  $kwatt='kwatt_balance'; 
                 // $user->$temp =  $user->$temp + $request->mc_gross;
                  $user->$kwatt =  $user->$kwatt + $no_of_kwatt;
                  $user->save();

                  /*************** Kwatt Leadger history ****************/
                   /* $setting = Setting::find(1);
                    $setting->total_coins=$setting->total_coins - $no_of_kwatt;
                    $setting->save();
                  if($user->parent_id != 0 || $user->parent_id !=NULL)
                  {
                    $transaction_id=$deposit->id;
                   // $setting = Setting::first();
                    $ref_bonus = $setting->referal_bonus;
                    $PaymentController= $this->PaymentController;
                    $PaymentController->AddReferalBonusToParent($user,$no_of_kwatt,$ref_bonus,$transaction_id);
                  }

              }
              $deposit->status = 100;
              $deposit->coin_amount = $request->mainamount;
              //$deposit->address=$request->payer_id;
              $deposit->tx_id=$request->id;
              $deposit->save();
              die('IPN OK');
              
          }
        }*/


    }
    
    
    


}