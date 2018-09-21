<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use App\Models\Utransaction;
use Mail;
use Carbon\Carbon;
class PendingTransactionEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:PendingTransactionEmail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email to pending Transaction';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try{
        $Sending_data =  Utransaction::where('status','=',0)
                                        ->where('type','!=','KWATT')
                                        ->where('txn_type','=','2')
                                        ->select(['status', 'type','coin_amount','user_id','created_at'])
                                        ->with('get_user_info')
                                        ->get();
        for($i=0;$i<count($Sending_data); $i++)
        {
          $time=$Sending_data[$i]->created_at;
          $diff_in_hours = Carbon::now()->diffInHours($time);
          if($diff_in_hours ==1 || ($diff_in_hours==12) )
          {
              $coin_amount= $Sending_data[$i]->coin_amount;
              $coin_type= $Sending_data[$i]->type;
              $fullname= $Sending_data[$i]->get_user_info['fullname'];
              $email= $Sending_data[$i]->get_user_info['email'];
              Mail::send('emails.pendingtxn',[
            'username' => $fullname,
            'coin_type' => $coin_type,
            'coin_amount' => $coin_amount
                ],function($message) use ($email,$fullname) {
                    $message->to($email);
                    $message->subject("Complete your Transaction with 4New");
                });
          }
         
        }
    }
    catch (Exception $e) {
        Log::alert($e);
    }
        //die('All Mail Sent Thank You');
    }
}
