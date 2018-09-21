<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Input;
use Validator;
use URL;
use Session;
use Redirect;
use Input;
use Carbon\Carbon;
/** All Paypal Details class **/
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Setting;
use App\CoinPaymentsAPI;
use App\Models\Rate;
use App\Models\Deposit;
use App\User;
use Sentinel;
use App\Models\Utransaction;
use App\Models\PaypalTransaction;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WalletController;
use App\Models\Kwattledger;
use Log;
use Psr\Log\AbstractLogger;
use Psr\Log\LogLevel;
use App\PaypalIPN;
class PaypalController extends Controller
{
    private $_api_context;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->walletcontroller= new WalletController;
      $this->ProfileController= new ProfileController;
      $this->PaymentController= new PaymentController;
      /** setup PayPal api context **/
     // $paypal_conf = Config::get('paypal');
      //echo "<pre>";print_r($paypal_conf);die;
      $paypal_conf =$this->paywithpal();
      //echo "<pre>";print_r($paypal_conf);die;
      $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
      $this->_api_context->setConfig($paypal_conf['settings']);
    }
    public function paywithpal()
    {

      $paypal_conf = array();
        $paypal_conf['client_id']='AQ6PPFVaK-wduGVVDPIQJCvL8ckUqb8foY0xLHxXGDIJK_pfGWn35WEQyzYHvwE1LRhF6AgJc4iNe6Fb';
        $paypal_conf['secret']='EDFpieHAxWzGkD7kuQGAYZVfm8h6khlWKYDi1da9GY7Z9izWvk_SQfinN3StZRnevmMLqI3T-odN9vS7';

      // $paypal_conf['client_id']='AWqL6p-MRhuzOEkDk6crJYW4KXmVR_Eu1yi1ZDcOle8OWHS6ZJ1xDtLnimLqaQMUS6-wrHf2yEhWZK4H';
      // $paypal_conf['secret']='EIN0g5gUogc5VQIQk7JsYBMpJiFX55QPD-Oplqz-BljFjAXzSVz90TSiYJc36ERarxnrK6Tp81hCOrSr';



        $paypal_conf['settings']=array(
                                        'mode' => 'live',
                                        'http.ConnectionTimeOut' => 1000,
                                        'log.LogEnabled' => true,
                                        'log.FileName' => storage_path() . '/logs/paypal.log',
                                        'log.LogLevel' => 'FINE'
                                        );
      return $paypal_conf;
      // $paypal_conf = array();
      //   $paypal_conf['client_id']='AWqL6p-MRhuzOEkDk6crJYW4KXmVR_Eu1yi1ZDcOle8OWHS6ZJ1xDtLnimLqaQMUS6-wrHf2yEhWZK4H';
      //   $paypal_conf['secret']='EIN0g5gUogc5VQIQk7JsYBMpJiFX55QPD-Oplqz-BljFjAXzSVz90TSiYJc36ERarxnrK6Tp81hCOrSr';
      //   $paypal_conf['settings']=array(
      //                                   'mode' => 'sandbox',
      //                                   'http.ConnectionTimeOut' => 1000,
      //                                   'log.LogEnabled' => true,
      //                                   'log.FileName' => storage_path() . '/logs/paypal.log',
      //                                   'log.LogLevel' => 'FINE'
      //                                   );
      // return $paypal_conf;
    }


    /**
     * Show the application paywith paypalpage.
     *
     * @return \Illuminate\Http\Response
     */
    public function add_money()
    {
        $coin='USD';
        $user=Sentinel::getUser();
        $deposit_data=Deposit::where('coin',$coin)->where('user_id',$user->id)->get();
        return view('user.wallet.depositusd',compact('deposit_data'));
    }
    public function paypalIpnResonseListner(Request $request)
    {
     // echo $logFile = 'KYC-'.Carbon::now()->format('Ymd_His').'.txt';die;
     // echo "<pre>";print_r();die;
      $json=json_encode($request->all());
      Storage::disk('local')->put('paypal/'.$request->item_name1.'-'.$request->invoice.'.txt', 
        $json);
     // Log::write('DEBUG',  $request->all() );
      /************* Verify IPN ******************/
      $ipn = new PaypalIPN();
      // Use the sandbox endpoint during testing.
      //$ipn->useSandbox();
      $verified = $ipn->verifyIPN();
      Log::write('DEBUG',  $verified);
      if ($verified) 
      {
         //Log::write('DEBUG',  $verified );
          /************ End Verify IPN **************/
          if(isset($request->payment_status) && $request->payment_status =='Completed')
          {
              $deposit_id=$request->invoice;
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
                  $user->$temp =  $user->$temp + $request->mc_gross;
                  $user->$kwatt =  $user->$kwatt + $no_of_kwatt;
                  $user->save();

                  /*************** Kwatt Leadger history ****************/
                  $walletcontroller= new WalletController;
                  $kwatt_ledger= new Kwattledger;
                  $kwatt_ledger->user_id=$userid;
                  $kwatt_ledger->noOfKwatt=$no_of_kwatt;
                  $kwatt_ledger->type=2;
                  $kwatt_ledger->coin=$walletcontroller->getCoinEnum($coin_name);
                  $kwatt_ledger->save();
                  $setting = Setting::find(1);
                    $setting->total_coins=$setting->total_coins - $no_of_kwatt;
                    $setting->save();
                  if($user->parent_id != 0 || $user->parent_id !=NULL)
                  {
                    $transaction_id=$deposit->id;
                   // $setting = Setting::first();
                    $ref_bonus = $setting->referal_bonus;
                    $PaymentController= new PaymentController;
                    $PaymentController->AddReferalBonusToParent($user,$no_of_kwatt,$ref_bonus,$transaction_id);
                  }

              }
              $deposit->status = 100;
              $deposit->coin_amount = $request->mc_gross;
              $deposit->address=$request->payer_id;
              $deposit->tx_id=$request->txn_id;
              $deposit->save();
              
          }
        }
        
    }
    function verifyIPN($ipn_data)
    {
      define('SSL_P_URL', 'https://www.paypal.com/cgi-bin/webscr');
      define('SSL_SAND_URL', 'https://www.sandbox.paypal.com/cgi-bin/webscr');
      $hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
      if (!preg_match('/paypal.com$/', $hostname)) 
      {
        $ipn_status = 'Validation post is not from PayPal';
        if ($ipn_data == true) 
        {
        //You can send email as well
        }
        else

        {
           return $ipn_status;
        }
       
      }
      // parse the paypal URL
      $paypal_url = ($ipn_data['test_ipn'] == 1) ? SSL_SAND_URL : SSL_P_URL;
      $url_parsed = parse_url($paypal_url);

      $post_string = '';
      foreach ($ipn_data as $field => $value) {
      $post_string .= $field . '=' . urlencode(stripslashes($value)) . '&';
      }
      $post_string.="cmd=_notify-validate"; // append ipn command
      // get the correct paypal url to post request to
      $paypal_mode_status = $ipn_data; //get_option('im_sabdbox_mode');
      if ($paypal_mode_status == true)
      $fp = fsockopen('ssl://www.sandbox.paypal.com', "443", $err_num, $err_str, 60);
      else
      $fp = fsockopen('ssl://www.paypal.com', "443", $err_num, $err_str, 60);

      $ipn_response = '';

      if (!$fp) 
      {
        // could not open the connection. If loggin is on, the error message
        // will be in the log.
        $ipn_status = "fsockopen error no. $err_num: $err_str";
        if ($ipn_data == true) 
        {
          echo 'fsockopen fail';
        }
        return false;
      } 
      else 
      {
        // Post the data back to paypal
        fputs($fp, "POST $url_parsed[path] HTTP/1.1rn");
        fputs($fp, "Host: $url_parsed[host]rn");
        fputs($fp, "Content-type: application/x-www-form-urlencodedrn");
        fputs($fp, "Content-length: " . strlen($post_string) . "rn");
        fputs($fp, "Connection: closernrn");
        fputs($fp, $post_string . "rnrn");

        // loop through the response from the server and append to variable
        while (!feof($fp)) 
        {
          $ipn_response .= fgets($fp, 1024);
        }
        fclose($fp); // close connection
      }
      // Invalid IPN transaction. Check the $ipn_status and log for details.
      if (!preg_match("/VERIFIED/s", $ipn_response)) 
      {
        $ipn_status = 'IPN Validation Failed';

        if ($ipn_data == true) {
        echo 'Validation fail';
        print_r($_REQUEST);
        }
        return false;
      } else 
      {
        $ipn_status = "IPN VERIFIED";
        if ($ipn_data == true) 
        {
          echo 'SUCCESS';
        }

        return true;
      }
    }
    /**
     * Store a details of payment with paypal.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postPaymentWithpaypal(Request $request)
    {
      //echo "<pre>";print_r($request->all());die;
      $this->validate($request, [
     //'usd_amount' => 'required',
     'kwatt_amounts'=>'required'
        ]);
     // echo $request->usd_amount;
      
      $user=Sentinel::getUser();
      $settings=Setting::find(1);
      $username= $user->username;
      $kwatt_amount=$request->kwatt_amounts;
      $coin_amount=$request->coin_amounts;
      $user_id= $user->id;
      $usd_rate=$settings->usd_rate;
      $coin_name='USD';
      $result=$this->walletcontroller->hasAmountIsValid($kwatt_amount,$coin_name,$user,$settings,$coin_amount);
         // return print_r($result);die;
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
      /******* Deposit end ****************/

      // set payment method 
      $payer = new Payer();
      $payer->setPaymentMethod('paypal');
      // create  Item name
      $item_name='Transaction';
      $item_number=$store->id;
      $item_1 = new Item();
      $item_1->setName($item_name) /** item name **/
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($usd_amount); 
            //->setItemNumber($item_number);/** unit price **/
      // Set Item list
      $item_list = new ItemList();
      $item_list->setItems(array($item_1));
      // Set Amount
      $amount = new Amount();
      $amount->setCurrency('USD')
            ->setTotal($usd_amount);

      // Transaction with description
      $invoicenumber=$store->id;
      $transaction = new Transaction();
      $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Add Money to wallet')
             ->setInvoiceNumber($invoicenumber);
      // Set Call Back Url
      $redirect_urls = new RedirectUrls();
      $redirect_urls->setReturnUrl(URL::route('getpaypalstatus')) /** Specify return URL **/
            ->setCancelUrl(URL::route('getpaypalstatus'));
      // Create  Payment array
      $payment = new Payment();
      $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
        try 
        {
            $payment->create($this->_api_context);
        } 
        catch (\PayPal\Exception\PPConnectionException $ex) 
        {
            if (\Config::get('app.debug')) 
            {
                //\Session::put('error','Connection timeout');
                //return Redirect::route('dashboard');
                 return redirect('dashboard')->with('error','Connection timeout');
            } 
            else 
            {
              //\Session::put('error','Some error occur, sorry for inconvenient');
             // return Redirect::route('dashboard');
              return redirect('dashboard')->with('error','Some error occur, sorry for inconvenient');
              
            }
        }
        catch (Exception $ex) 
        {
         // \Session::put('error',$ex->getMessage());
          //return Redirect::route('dashboard');
           return redirect('dashboard')->with('error',$ex->getMessage());
        }

        foreach($payment->getLinks() as $link) 
        {
            if($link->getRel() == 'approval_url') 
            {
                $redirect_url = $link->getHref();
                break;
            }
        }

        /** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());
        if(isset($redirect_url))
        {
            /******** redirect to paypal *********/
            $payment_id=$payment->getId();
            $deposit = Utransaction::find($item_number);
            $deposit->payment_id = $payment_id;
            $deposit->save(); 

           return Redirect::away($redirect_url);
           //return $redirect_url;
        }

        //\Session::put('error','Unknown error occurred');
       // return Redirect::route('paywithpaypal');
        return redirect('dashboard')->with('error','Oops Something went wrong !! Please try after some times.');
      
    }

    public function getPaymentStatus(Request $request)
    {
      $payment_id = $request->input('paymentId');
      $deposit_data = Utransaction::where('payment_id',$payment_id)->first();
      if(isset($deposit_data) && isset($deposit_data->status) && $deposit_data->status ==100)
      {
          return redirect('dashboard')->with('success','Payment success');
      }
      
       // $payment_id = Session::get('paypal_payment_id');
        if (empty($request->input('paymentId')) || empty($request->input('token'))) 
        {
            
            if(isset($payment_id) && $payment_id !='')
             {
                $deposit_data = Utransaction::where('payment_id',$payment_id)->first();
                if(isset($deposit_data))
                {
                    $user_id= $deposit_data->user_id;
                    $did=$deposit_data->id;
                    $usd_amount=$deposit_data->coin_amount;

                   $Deposit = Utransaction::find($did);
                   $Deposit->status=-1;
                   $Deposit->address='';
                   $Deposit->save();
                }
             }
            //\Session::put('error','Payment failed');
            //return Redirect::route('dashboard');
            return redirect('dashboard')->with('error','Payment failed');
        }
        
        $token = $request->input('token');
        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
       /* if(isset($payment_id) && $payment_id !='')
        {
            $paymentid =$payment_id;
        }
        else
        {
            $paymentid = $paymentId;
        }*/
        /** PaymentExecution object includes information necessary **/
        /** to execute a PayPal account payment. **/
        /** The payer_id is added to the request query parameters **/
        /** when the user is redirected from paypal back to your site **/

        try{
            $payment = Payment::get($payment_id, $this->_api_context);
            $execution = new PaymentExecution();
            $PayerID=$request->input('PayerID');
            $execution->setPayerId($request->input('PayerID'));
            /**Execute the payment **/
            $result = $payment->execute($execution, $this->_api_context);
            /* dd($result);exit; /** DEBUG RESULT, remove it later **/
            if ($result->getState() == 'approved') 
            { 
                $temp= 'usd_balance';  // Edit Balance
                $deposit_data = Utransaction::where('payment_id',$payment_id)->first();
                $user_id= $deposit_data->user_id;
                $did=$deposit_data->id;
                $no_of_kwatt=$deposit_data->no_of_kwatt;
                $coin_amount=$deposit_data->coin_amount;

                $Deposit = Utransaction::find($did);
                // Update total number of coins
                $setting = Setting::find(1);
                $setting->total_coins=$setting->total_coins - $no_of_kwatt;
                $setting->save();

                if($Deposit->status !=100)
                {
                  $kwatt='kwatt_balance'; 
                  $user = User::find($user_id);
                  $user->$temp =  $user->$temp + $coin_amount;
                  $user->$kwatt =  $user->$kwatt + $no_of_kwatt;
                  $user->save();
                  if($user->parent_id != 0 || $user->parent_id !=NULL)
                  {
                    $transaction_id=$Deposit->id;
                    $setting = Setting::first();
                    $ref_bonus = $setting->referal_bonus;
                    $PaymentController= new PaymentController;
                    $PaymentController->AddReferalBonusToParent($user,$no_of_kwatt,$ref_bonus,$transaction_id);
                  }

                }


                $Deposit->status=100;
                $Deposit->address=$PayerID;
                $Deposit->save();
               // \Session::put('success','Payment success');
               return redirect('dashboard')->with('success','Payment success');
               // return Redirect::route('dashboard');
            }
            //\Session::put('error','Payment failed');
            //return Redirect::route('paywithpaypal');
            //return Redirect::route('dashboard');
             return redirect('dashboard')->with('error','Payment failed');
          }
          catch(PayPalConnectionException $e)
          {
            // echo $e->getCode(); // Prints the Error Code
            // echo $e->getData();
             //die($e);
              return redirect('dashboard')->with('error',$e->getData());
          }
          catch (Exception $ex) 
          {
             //die($ex);
             return redirect('dashboard')->with('error',$ex);
          }
    
    }
    public function postPayWithCreditCard(Request $request)
    {
      $this->validate($request, [
     'coin_amounts'=>'required'
        ]);
      //echo "<pre>";print_r($request->all());die;
     // echo $request->usd_amount;
      
      $user=Sentinel::getUser();
      $settings=Setting::find(1);
      $username= $user->username;
      $kwatt_amount=$request->kwatt_amounts;
      $coin_amount=$request->coin_amounts;
      $user_id= $user->id;
      $usd_rate=$settings->usd_rate;
      $coin_name='USD';
      $result=$this->walletcontroller->hasAmountIsValid($kwatt_amount,$coin_name,$user,$settings,$coin_amount);
         // return print_r($result);die;
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
        //$payment_url='http://evoucher.mashup.li/billing';
        $payment_url='https://evoucher.an-other.co.uk/billing';
        $merchant_id='AP1006';
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
        return View('user.credit_card_payment',compact('payment_url','usd_amount','order_id','countries','merchant_id','first_name','last_name','email','user'));
    }

    public function payment_redirect_url(Request $request)
    {
        //echo $request->input('code');die;
        if($request->input('id') !=null && $request->input('code') !=null)
        {
          $txn_id = $request->input('id');
          $order_id= $request->input('code');
          $availed= $request->input('availed');
          $mainamount=$request->input('mainamount');

         

          if($availed=='true')
          {
              $ordercode=explode('-', $order_id);
              if(isset($ordercode[1]) && $ordercode[1] !='')
              {
                $utransactions_id=$ordercode[1];
              }

              $deposit_data = Utransaction::find($utransactions_id);
              $user_id=$deposit_data->user_id;
              $no_of_kwatt=$deposit_data->no_of_kwatt;
              

              $setting = Setting::find(1);
              $setting->total_coins=$setting->total_coins - $no_of_kwatt;
              $setting->save();

              if($deposit_data->status !=100)
              {
                $kwatt='kwatt_balance'; 
                $user = User::find($user_id);
                //$user->$temp =  $user->$temp + $coin_amount;
                $user->$kwatt =  $user->$kwatt + $no_of_kwatt;
                $user->save();

                $deposit_data->status=100;
                $deposit_data->tx_id=$txn_id;
                $deposit_data->save();
                $this->PaymentController->sendPaymentSuccessEmail($user,$deposit_data);

              $coin_name="USD";
              $subject='Success';
              $coin_amount=$deposit_data->coin_amount;
              //$this->walletcontroller->sendFormatEmailToAdmin($user->fullname,$user->email,$coin_amount,$coin_name,$subject);


                if($user->parent_id != 0 || $user->parent_id !=NULL)
                {
                  $transaction_id=$deposit_data->id;
                  $setting = Setting::first();
                  $ref_bonus = $setting->referal_bonus;
                  $PaymentController= $this->PaymentController;
                  $PaymentController->AddReferalBonusToParent($user,$no_of_kwatt,$ref_bonus,$transaction_id);
                }
                  $this->PaymentController->trackingListner($coin_amount,$txn_id,'USD');
                  $this->PaymentController->sale_tracking_listner();

              }
             
              
              return redirect('dashboard')->with('success','Payment Success');
          }
          else
          {
            $order_id= $request->input('code');
            if(isset($order_id) && $order_id !='')
            {
              $ordercode=explode('-', $order_id);
              if(isset($ordercode[1]) && $ordercode[1] !='')
              {
                $utransactions_id=$ordercode[1];
                $Deposit = Utransaction::find($utransactions_id);
                if(!empty($Deposit))
                {
                  $Deposit->status=-1;
                  $Deposit->save();

                  $user_id=$Deposit->user_id;
                  $user = User::find($user_id);

                  $coin_amount=$Deposit->coin_amount;
                  


                  $coin_name="USD";
                  $subject='Failed';
                  //$this->walletcontroller->sendFormatEmailToAdmin($user->fullname,$user->email,$coin_amount,$coin_name,$subject);



                }
              }
            }
             

            return redirect('dashboard')->with('error','Payment Fail');
          }
          
        }
        else
        {
          $order_id= $request->input('code');
          if(isset($order_id) && $order_id !='')
          {
            $ordercode=explode('-', $order_id);
            if(isset($ordercode[1]) && $ordercode[1] !='')
            {
              $utransactions_id=$ordercode[1];
              $Deposit = Utransaction::find($utransactions_id);
              if(!empty($Deposit))
              {
                $Deposit->status=-1;
                $Deposit->save();

                 $user_id=$Deposit->user_id;
                  $user = User::find($user_id);

                  $coin_amount=$Deposit->coin_amount;
                  


                  $coin_name="USD";
                  $subject='Failed';
                  //$this->walletcontroller->sendFormatEmailToAdmin($user->fullname,$user->email,$coin_amount,$coin_name,$subject);
              }
            }
          }
          return redirect('dashboard')->with('error','An error occur, Please try again!');
        }
    }

    public function payment_notification_url(Request $request)
    {
      $json=json_encode($request->all());
      Storage::disk('local')->put('another/'.Carbon::now()->format('Ymd_His').'-'.$request->code.'.txt', 
        $json);
      $txn_id=$request->id;
      $verified = $this->verifyAnotherPayment($txn_id);
      Log::write('DEBUG',  $verified);
      if ($verified==200) 
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
                    $setting = Setting::find(1);
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
        }
    }

    public function verifyAnotherPayment($transaction_id)
    {
      $URL='https://evoucher.an-other.co.uk/api/v1/validate_transaction?transaction_id='.$transaction_id;
        $curlHandle = curl_init();
        curl_setopt($curlHandle, CURLOPT_URL, $URL);
        curl_setopt($curlHandle, CURLOPT_HEADER, true);
        curl_setopt($curlHandle, CURLOPT_NOBODY  , true);  // we don't need body
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
        curl_exec($curlHandle);
        $response = curl_getinfo($curlHandle, CURLINFO_HTTP_CODE);
        curl_close($curlHandle); // Don't forget to close the connection

        return $response;
    }
    public function trackYourUser(Request $request)
    {
      $conversion_val=$request->amount;
      $curr=$request->currency;
     // echo $conversion_val;die;
       Log::write('DEBUG',  $request);
       return View('user.transaction.add_roll',compact('conversion_val','curr'));
      //print_r($curr);die;
    //   echo '<script type="text/javascript"> 
    //   adroll_conversion_value = '.$conversion_val.';
    // adroll_currency = "'.$curr.'";
    // </script>';

      //    echo  '<html>
      //           <head><title>Thank you for your purchase</title></head>
      //           <body>
      //           <script type="text/javascript">
      //           adroll_adv_id = "JEZ4A6GE4ZHHBE6MY7T3LJ";
      //           adroll_pix_id = "DNH3NBVHQFC2XC6BGZWUTK";
      //           (function () {
      //               var _onload = function(){
      //                   if (document.readyState && !/loaded|complete/.test(document.readyState)){setTimeout(_onload, 10);return}
      //                   if (!window._adroll_loaded){_adroll_loaded=true;setTimeout(_onload, 50);return}
      //                   var scr = document.createElement("script");
      //                   var host = (("https:" == document.location.protocol) ? "https://s.adroll.com" : "http://a.adroll.com");
      //                   scr.setAttribute("async", "true");
      //                   scr.type = "text/javascript";
      //                   scr.src = host + "/j/roundtrip.js";
      //                   ((document.getElementsByTagName("head") || [null])[0] ||
      //                       document.getElementsByTagName("script")[0].parentNode).appendChild(scr);
      //               };
      //               if (window.addEventListener) {window.addEventListener("load", _onload, false);}
      //               else {window.attachEvent("onload", _onload)}
      //           }());
      //         </script>
       
      //         <script type="text/javascript">
      //           adroll_conversion_value = '.$conversion_val.';
      //           adroll_currency = "'.$curr.'";
      //         </script>
       
       
      // </body>
      // </html>';
     
    }
    public function sale_confirm(Request $request)
    {

      Log::write('DEBUG',  $request);
    }
    
    
}
