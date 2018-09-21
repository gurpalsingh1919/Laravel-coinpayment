<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Sentinel;
use App\User;
use App\Models\Bountie;
use Exception;

class BountyController extends Controller
{

    public function index()
    {
        $user= Sentinel::getUser();
        $user_id = $user->id;
         return view('user.bounty.index',compact('bounty_data'));
    }

    public function screen_upload($serv)
    {
    	return view('user.bounty.upload_screen',compact('serv'));
    }
    
    public function upload_screen1(Request $request)
    {
         	$user= Sentinel::getUser();
            $user_id=$user->id;
                $set=new Bountie;
                $file = $request->file('imgInp');
                $destinationPath = 'upload/bounty';
                $file->move($destinationPath,$file->getClientOriginalName());
                $filename1 =  $file->getClientOriginalName();
                $filename1= urlencode($filename1);
                $set->document=$filename1;
                $set->user_id=$user_id;
                $set->service=$request->service;
                $set->save();
                return redirect('bounty')->with(['success'=>'Document Upload Successfully']);
		
    }
    
    public function del_bounty($id)
    {
        $kk=Bountie::find($id);
        $kk->delete();
        return redirect()->back()->with(['success'=>'Image Delete Successfully']);
    }
    
    
    

}
