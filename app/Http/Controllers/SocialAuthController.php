<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bountie;
use Socialite;
use Redirect;
use Sentinel;

class SocialAuthController extends Controller 
{
	public function redirect($service) 
	{
		return Socialite::driver ( $service )->redirect ();
	}

	public function goto_ser($service)
	{
		$user= Sentinel::getUser();
        $user_id=$user->id;
	    $other_data=Bountie::where(array('user_id'=>$user_id,'service'=>$service))->get();
		return view ( 'user.bounty.otherhome',compact('other_data','service') );
	}

	public function callback($service) 
	{
	   	$user= Sentinel::getUser();
        $user_id=$user->id;
	    $fb_data=Bountie::where(array('user_id'=>$user_id,'service'=>'facebook'))->get();
	    $tw_data=Bountie::where(array('user_id'=>$user_id,'service'=>'twitter'))->get();
	    
		$user = Socialite::with ( $service )->user();
		return view ( 'user.bounty.home',compact('fb_data','tw_data') )->withDetails ( $user )->withService ( $service );
	}
}
