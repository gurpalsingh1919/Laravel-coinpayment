<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cookie;
class WebinarController extends Controller
{
    public function liveWebinar()
    {
    	return View('webinar.live_kwatt1');
    }
    public function newliveWebinar(Request $request)
    {
    	$token='';
    	if(isset($request->ref) && $request->ref !='')
        {
	    	$token=$request->ref;
	        $expire = 6*30*24*3600;
	        Cookie::queue('affiliate_token',  $token, $expire);
    	}
    	return View('webinar.4newliveWebinar',compact('token'));
    }
}
