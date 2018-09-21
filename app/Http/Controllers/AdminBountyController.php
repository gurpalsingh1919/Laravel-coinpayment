<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
use Hash;
use App\User;
use App\Models\Bountie;
use Activation;
use Excel;
use Mail;

class AdminBountyController extends Controller
{
    public function index()
    {
        $bounty_data=Bountie::get();
        return view('admin.bounty.index',compact('bounty_data'));
    }

    public function bounty_show($id)
    {
         $bounty_full=Bountie::where('id',$id)->first();
         return view('admin.bounty.show',compact('bounty_full'));
    }
      
    public function give_to_user(Request $request)
    {
        $main_id=$request->main_id;
        $give_coin=$request->give_coin;

        $bounty_data=Bountie::where('id',$main_id)->first();
        $user_id=$bounty_data->user_id;
        
        //user total balance token update.
        $userdata=User::where('id',$user_id)->first();
        $tot_token=$userdata->kwatt_balance;
        $final_token=$tot_token+$give_coin;
        
        $uu=User::find($user_id);
        $uu->kwatt_balance=$final_token;
        $uu->save();
          
         $kk=Bountie::find($main_id);
         $kk->status=1;
         $kk->save();
         return 1;
    }

     public function bounty_reject($id)
    {
       $kk=Bountie::find($id);
       $kk->status=2;
       $kk->save();
       return  redirect()->back()->with(['success' => "Successfully Reject Bounty Screenshot"]);
    }
    

}
