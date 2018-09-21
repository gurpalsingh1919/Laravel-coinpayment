<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Utransaction;
use Mail;
use App\User; 
use Carbon\Carbon;
use App\Models\Referal;
use Log;
use App\Http\Controllers\PaymentController;
class MailController extends Controller
{
    public function __construct()
    {
        $this->PaymentController= new PaymentController;
    }
   public function transactionPending()
   {


    $amount=10;
    $order_id='20';
    $coin_type='USD';
   
    $this->PaymentController->trackingListner($amount,$order_id,$coin_type);


    die;
        $allUsers=User::all();

        //echo "<pre>";print_r($allUsers);
        $no_ofSuccess=0;
       /* for($i=0;$i<count($allUsers);$i++)
        {
            $user_email= $allUsers[$i]->email;
            $ref_token= $allUsers[$i]->ref_token;
            $user_id= $allUsers[$i]->id;
            //echo $user_email.'-----'.$ref_token."<br/>";
            $subject = 'IMPORTANT 4NEW LAUNCH ALERT!';
           // if($user_id==32 || $user_id==34 || $user_id==50 || $user_id==17165 || $user_id==18474)
            //{
               Mail::send('emails.4new_webinar_alert',[
                    'ref_token' => $ref_token,
                                    
                ],function($message) use ($user_email, $subject) {
                    $message->to($user_email);
                    $message->subject($subject);
                });
           // }
            $no_ofSuccess=$i;
            $msg= 'Sent to:- '.$user_email;
            //Log::write('DEBUG',$msg  );
        }
        die($no_ofSuccess." Message Sent Successfully");*/
        //die;
        // $amount='200';
        // $order_id='40-34-43453';
        // $this->PaymentController->sale_tracking_listner();
        //$emails=array('gurpal@webdew.in','saurabh.upadhyay@webdew.in');

       /* $emails=$this->emails();
       // $amount=array('2000','3000');
        //$amount=$this->amounts();
        //$kwatt=array('1500','1300');
        //$kwatt=$this->kwattss();
        //$date=array('2018-06-03','2018-06-04');
        $date=$this->date();
        $no_ofSuccess=0;
        // echo count($emails);
        // echo count($amount);
        // echo count($kwatt);
        // echo count($date);die;
        for($i=0;$i<count($emails);$i++)
        {
            $subject = '4new: PayPal Payment Dispute';
            $user_email=$emails[$i];
            $user_amount=$amount[$i];
            $user_kwatt=$kwatt[$i];
            $txn_date=$date[$i];
            $user=User::where('email',$user_email)->first();
            Mail::send('emails.paypal_users_to_pay_again',[
                'user' => $user,
                'ico_amount' => $user_amount,
                'kwat_amount' => $user_kwatt,
                'txn_date'=>$txn_date
                
            ],function($message) use ($user, $subject) {
                $message->to($user->email);
                $message->subject($subject);
            });
            $no_ofSuccess=$i;
            $msg= 'Sent to:- '.$user_email;
            Log::write('DEBUG',$msg  );
        }
        die($no_ofSuccess." Message Sent Successfully");*/
   }
   public function date()
   {
    return $Date = array(
                "2018-06-05",  
                "2018-06-01",   
                "2018-05-30", 
                "2018-05-31",  
                "2018-05-31",  
                "2018-06-01", 
                "2018-06-01", 
                "2018-06-03",  
                "2018-06-08",  
                "2018-05-30", 
                "2018-06-01",  
                "2018-06-08",
                "2018-05-03", 
                "2018-06-06", 
                "2018-06-06", 
                "2018-06-07",
                "2018-05-14", 
                "2018-05-30", 
                "2018-06-07", 
                "2018-06-09",  
                "2018-06-09", 
                "2018-06-09",  
                "2018-06-08",  
                "2018-05-09", 
                "2018-06-01", 
                "2018-06-06", 
                "2018-06-08",  
                "2018-06-08",  
                "2018-06-08",  
                "2018-06-09", 
                "2018-06-10", 
                "2018-06-08", 
                "2018-05-15",  
                "2018-05-03", 
                "2018-05-29",  
                "2018-05-31",
                "2018-06-06", 
                "2018-06-06",  
                "2018-06-06",  
                "2018-04-26", 
                "2018-06-08", 
                "2018-06-03", 
                "2018-05-07", 
                "2018-05-09",  
                "2018-05-13",  
                "2018-05-15",  
                "2018-05-15",  
                "2018-05-15",  
                "2018-05-15",  
                "2018-05-18", 
                "2018-05-21",  
                "2018-05-21",  
                "2018-05-23",  
                "2018-05-24", 
                "2018-05-26",  
                "2018-05-27",
                "2018-05-30",
                "2018-05-31",
                "2018-05-31",
                "2018-05-31",
                "2018-05-31",
                "2018-05-31",
                "2018-06-01",
                "2018-06-01",
                "2018-06-01",
                "2018-06-01",
                "2018-06-01",
                "2018-06-01",
                "2018-06-01",
                "2018-06-03",
                "2018-06-04",
                "2018-06-04",
                "2018-06-04",
                "2018-06-05",
                "2018-06-05",
                "2018-06-05",
                "2018-06-07",
                "2018-06-07",
                "2018-06-07",
                "2018-06-07",
                "2018-06-07",
                "2018-06-08",
                "2018-06-08",
                "2018-06-08",
                "2018-06-08",
                "2018-06-08",
                "2018-06-08",
                "2018-06-08",
                "2018-06-08",
                "2018-06-09",
                "2018-06-09",
                "2018-06-09",
                "2018-06-09",
                "2018-06-09",
                "2018-06-11",
                "2018-06-11"
                );
   }
   public function amounts()
   {
        return $Amount = array(
        "15000",
        "10000",
        "5000",
        "5000",
        "5000",
        "5000",
        "5000",
        "5000",
        "5000",
        "4250",
        "4000",
        "3200",
        "3000",
        "3000",
        "3000",
        "3000",
        "2500",
        "2500",
        "2500",
        "2500",
        "2500",
        "2357",
        "2004",
        "2000",
        "2000",
        "2000",
        "2000",
        "2000",
        "2000",
        "2000",
        "2000",
        "1800",
        "1600",
        "1500",
        "1500",
        "1500",
        "1500",
        "1500",
        "1410",
        "1336",
        "1100",
        "1028",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000"
        );
   }
   public function kwattss()
   {
       return  $KWATT = array(
        "15000",
        "10000",
        "2500",
        "2500",
        "5000",
        "2500",
        "5000",
        "5000",
        "5000",
        "2125",
        "2100",
        "3200",
        "1500",
        "3000",
        "3000",
        "3000",
        "1250",
        "1250",
        "2500",
        "2500",
        "2500",
        "2062.38",
        "2004",
        "1000",
        "1000",
        "2000",
        "2000",
        "2000",
        "2000",
        "1750",
        "1750",
        "1800",
        "800",
        "750",
        "750",
        "750",
        "1500",
        "1500",
        "1410",
        "700.5",
        "1100",
        "1028",
        "500",
        "500",
        "500",
        "500",
        "500",
        "500",
        "500",
        "1000",
        "500",
        "500",
        "525",
        "525",
        "525",
        "525",
        "500",
        "500",
        "500",
        "500",
        "500",
        "525",
        "1000",
        "500",
        "1000",
        "500",
        "500",
        "500",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "1000",
        "874",
        "875",
        "875",
        );
   }
   public function emails()
   {
        return $email=array(
        "wdoughty@comcast.net",
        "rwkidsdr@gmail.com",
        "kesahlin@gmail.com",
        "ajmustchin@hotmail.com",
        "notestoderek@gmail.com",
        "georgekata1@gmail.com",
        "mclemence29@yahoo.com",
        "eldridgem2909@gmail.com",
        "aemaher@gmail.com",
        "alex@threatenedpro.com",
        "ericjwalsh@me.com",
        "daroldyank@hotmail.com",
        "alberacena@gmail.com",
        "twithspoon66@aol.com",
        "parmarya@hotmail.com",
        "parmarya@hotmail.com",
        "nickmccuen@yahoo.com",
        "sparkylux@yahoo.co.uk",
        "milomat2000@yahoo.com",
        "kjwill@northrock.bm",
        "estherarmata@gmail.com",
        "kuniva5@gmail.com",
        "stepinskajustyna@yahoo.co.uk",
        "MARTYPAUL1943@GMAIL.COM",
        "dayyat@ymail.com",
        "chrispottier76@gmail.com",
        "j1strike@yahoo.com",
        "j1strike@yahoo.com",
        "jeanverdi.ups@gmail.com",
        "ccmechanical@gmail.com",
        "sabine.pfeiffer@live.de",
        "daroldyank@hotmail.com",
        "ong4son@icloud.com",
        "alberacena@gmail.com",
        "victor100007@hotmail.com",
        "selsrog@me.com",
        "s.varinder-singh@gmx.de",
        "raisrich@startmail.com",
        "livysimmonds@gmail.com",
        "stepinskajustyna@yahoo.co.uk",
        "andy5224@twc.com",
        "StrengthInDigits@i2i.email",
        "gdlrjsot1@aol.com",
        "aradhyausa@gmail.com",
        "nicolewozny@gmail.com",
        "donn@donnzver.com",
        "ong4son@icloud.com",
        "abderrahman@expertsmed.com",
        "A_M_sharaa@hotmail.co.uk",
        "ponmoulding@gmail.com",
        "eaglesorhi@gmail.com",
        "MARTYPAUL1943@GMAIL.COM",
        "mike@root.id.au",
        "mike@root.id.au",
        "mike@root.id.au",
        "shai.topaz81@gmail.com",
        "hooplace@gmail.com",
        "selsrog@me.com",
        "vinod.edward@gmx.at",
        "vinod.edward@gmx.at",
        "fredrik@aronsson.net",
        "rwkidsdr@gmail.com",
        "mike@root.id.au",
        "math_legault@hotmail.ca",
        "g.christie@shaw.ca",
        "lanabarrow123@gmail.com",
        "matran2822@yahoo.com",
        "matran2822@yahoo.com",
        "dalecjralston@gmail.com",
        "jesuslovesjodi@gmail.com",
        "amarhmbi@hotmail.com",
        "rich6free6man6@hotmail.com",
        "wipfster@gmail.com",
        "dragarba@gmail.com",
        "dragarba@gmail.com",
        "dragarba@gmail.com",
        "gm.brinck@gmail.com",
        "barbyjfraser@gmail.com",
        "therrguy@yahoo.com",
        "jbmelraji@yahoo.com",
        "stepinskajustyna@yahoo.co.uk",
        "freedomwithderryl@gmail.com",
        "vinod.edward@gmx.at",
        "shane@shaneflint.co.uk",
        "dashuntayb@gmail.com",
        "sparkylux@yahoo.co.uk",
        "Ravinder.ch216@gmail.com",
        "fredrik@aronsson.net",
        "rajasekr1@gmail.com",
        "jeanverdi.ups@gmail.com",
        "jeanverdi.ups@gmail.com",
        "brendan.weight@gmail.com",
        "SHADSCAT@HUSHMAIL.COM",
        "jday2578@gmail.com",
        "sixnomad@aol.com",
        "kathleenpage1@hotmail.com");
   }
}

