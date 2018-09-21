<?php

namespace App\Http\Controllers;
use App\Models\Activation;
use App\User;
use App\Models\Setting;
use App\Models\Rate;
use Hash;
use Illuminate\Http\Request;
use Mail;
use Sentinel;
use Validator;
use Illuminate\Support\Facades\Log;
use App\Models\Kwattledger;
use App\Models\Utransaction;
class SettingController extends Controller 
{
  public function index() 
  {
    $setting=Setting::get()->find(1);                    
    return view('admin.ico_setting',compact('setting'));
  }
  
  public function ico_edit()
  { 
    $setting=Setting::first();                    
    return view('admin.edit_ico',compact('setting')); 
  }
  public function addNewIco()
  { 
    $setting=Setting::first();                    
    return view('admin.add_ico',compact('setting')); 
  }
  public function postAddIcoAmount(Request $request)
  {
    $this->validate($request,[
          'kwatt_amount'   => 'required|numeric'
          
      ]);
    $kwatt_amount=$request->kwatt_amount;
    //return $kwatt_amount;
    $user = Sentinel::getUser();
    if ($user != null){$user_id=$user->id;}else{$user_id=1;}
    if(isset($request->icotype) && $request->icotype !='')
    {
      if($request->icotype =='add')
      {
          $setting = Setting::find(1);
          $setting->total_coins=$setting->total_coins + $kwatt_amount;
          $setting->save();

          $kwatt_ledger= new Kwattledger;
          $kwatt_ledger->user_id=$user_id;
          $kwatt_ledger->noOfKwatt=$kwatt_amount;
          $kwatt_ledger->type=1;
          $kwatt_ledger->coin=6;
          $kwatt_ledger->save();

          $Utransaction= new Utransaction;
          $Utransaction->user_id=$user_id;
          $Utransaction->no_of_kwatt=$kwatt_amount;
          $Utransaction->type='KWATT';
          $Utransaction->txn_type=1;
          $Utransaction->status=100;
          $Utransaction->save();
           return redirect('ico-add')->with('success','KWATT Added Successfully');
      }
      else if($request->icotype =='remove')
      {
          $setting = Setting::find(1);
          $setting->total_coins=$setting->total_coins - $kwatt_amount;
          $setting->save();

          $kwatt_ledger= new Kwattledger;
          $kwatt_ledger->user_id=$user_id;
          $kwatt_ledger->noOfKwatt=$kwatt_amount;
          $kwatt_ledger->type=5;
          $kwatt_ledger->coin=6;
          $kwatt_ledger->save();

          $Utransaction= new Utransaction;
          $Utransaction->user_id=$user_id;
          $Utransaction->no_of_kwatt=$kwatt_amount;
          $Utransaction->type='KWATT';
          $Utransaction->txn_type=5;
          $Utransaction->status=100;
          $Utransaction->save();
           return redirect('ico-add')->with('success','KWATT Removed Successfully');
      }
      return redirect('ico-add')->with('error','An error occur Please try again !');
    }
    else
    {
       return redirect('ico-add')->with('error','An error occur Please try again !');
    }
    
  }
  public function postupdatetokenAmount(Request $request)
  {
     $this->validate($request,[
          'token_amount'   => 'required|numeric',
          'referal_bonus'=>'required|numeric'
       ]);
     $token_amount=$request->token_amount;
     $setting = Setting::find(1);
    $setting->usd_rate=$token_amount;
    $setting->referal_bonus=$request->referal_bonus;
    $setting->save();
    return redirect('ico-add')->with('successtoken','Token Amount Updated Successfully');
  }
  

  public function ico_update(Request $request)

  {

      $this->validate($request,[
          'ico_start_date'   => 'required|date',
          'ico_end_date'     => 'required|date',
          'total_coins'      => 'required|numeric|',
          'sold_coins'       => 'required|numeric',
          'referal_bonus'    =>'required|numeric|min:1|max:100',
      ]);
      


    $setting = Setting::find(1);
    $setting->ico_start_date = date('Y-m-d H:i', strtotime($request->ico_start_date));
    $setting->ico_end_date =  date('Y-m-d H:i', strtotime($request->ico_end_date));
    $setting->total_coins = $request->total_coins;
    $setting->sold_coins = $request->sold_coins; 
    $setting->referal_bonus = $request->referal_bonus;    
     $setting->usd_rate = $request->usd_rate;   
    $setting->save(); 


    $user = Sentinel::getUser();
    if ($user != null) 
    {
        $user_id=$user->id;
    }
    else
    {
         $user_id=1;
    }

   /* $Kwattledger = Kwattledger::find(1);
    //echo $Kwattledger->user_id;die;
    if(isset($Kwattledger->user_id))
    {
        $id=$Kwattledger->id;
        $Kwatt=Kwattledger::find($id);
        $Kwatt->noOfKwatt=$request->total_coins;
        $Kwatt->save();
    }
    else
    {*/
      $kwatt_ledger= new Kwattledger;
      $kwatt_ledger->user_id=$user_id;
      $kwatt_ledger->noOfKwatt=$request->total_coins;
      $kwatt_ledger->type=1;
      $kwatt_ledger->coin=6;
      $kwatt_ledger->save();
   // }
    //$post->delete();
   
    



    return redirect('ico_setting')->with('success','Setting Data updated successfully'); 
  }

  public function rate_index()
  {
    $rate=Rate::orderBy('id','desc')->get();
    return view('admin.rate',compact('rate'));
  }

  public function rate_add()
  {
      return view('admin.rate_add');
  }
    public function rate_create(Request $request)
    {        
        $this->validate($request,[
            'bonus'           => 'required|numeric|min:1|max:100',            
            'kwatt_limit'       => 'required|numeric',
        ]);

        $rate = new Rate();    
        $rate->bonus = $request->bonus;
        $rate->kwatt_limit = $request->kwatt_limit;
        $rate->save();

        return redirect('rate')->with('success','New Rate Data add successfully');

    }

  public function rate_edit($id)
  { 
     $rate = Rate::where('id',$id)->first();
    return view('admin.rate_edit',compact('rate'));
  }

   public function rate_update(Request $request)
  {

      $this->validate($request,[
          'bonus'           => 'required|numeric|min:1|max:100',            
          'kwatt_limit'       => 'required|numeric',
      ]);

        $rate =  Rate::find($request->id);
        $rate->bonus = $request->bonus;
        $rate->kwatt_limit = $request->kwatt_limit;
        $rate->save();

    return redirect('rate')->with('success','Rate Data update Successfully');
  }

    public function rate_delete($id)
    {
         $rate = Rate::where('id',$id)->delete();
        return redirect('rate')->with('success','Rate delete Successfully');
    }
    public function rate_active($id)
    {
//         $rate =  Rate::find($id);
//
//        $setting = Setting::find(1);
//        $setting->ico_start_date = $rate->start_date;
//        $setting->ico_end_date = $rate->end_date;
//        $setting->bonus = $rate->bonus;
//        $setting->usd_rate =$rate->usd_price;
//        $setting->rate_id =$rate->id;
//        $setting->save();
//
//        $rate->status = 1;
//        $rate->save();
//        return redirect('rate')->with('success','Rate Active Successfully');

    }
    public function rate_active_cron()
    {
//           $setting   =  Setting::find(1);
//        if(strtotime($setting->ico_end_date)  < time())
//        {
//             $rate = Rate::whereDate('start_date','>=',date("Y-m-d"))->where('status',0)->first();
//            if($rate){
//                $setting = Setting::find(1);
//                $setting->ico_start_date = $rate->start_date;
//                $setting->ico_end_date = $rate->end_date;
//                $setting->bonus = $rate->bonus;
//                $setting->usd_rate =$rate->usd_price;
//                $setting->rate_id =$rate->id;
//                $setting->save();
//                Log::alert('Date changes');
//                $rate->status = 1;
//                $rate->save();
//            }
//        }
    }

  

}
