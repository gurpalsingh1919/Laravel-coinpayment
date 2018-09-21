<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use App\Models\Utransaction;
use Mail;
use Carbon\Carbon;
use App\Models\UserKyc;
use App\User;
use App\Models\SumsubKyc;
use Illuminate\Support\Facades\Log;
class UpdateKycInformation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:UpdateKycInformation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Kyc Information';

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
        $apiKey = 'EJUTSLXPKMQFHB';
        $baseUrl = 'https://api.sumsub.com';
        $all=SumsubKyc::where('info_status','!=','2')->get();
        
        $allArray=$all->toArray();
        foreach ($allArray as $sumsubkey => $sumsubvalue) 
        {
            $user_id=$sumsubvalue['user_id'];
            $applicantId=$sumsubvalue['applicantId'];
            $sumsub_Id=$sumsubvalue['id'];
            $URL= $baseUrl.'/resources/applicants/'.$applicantId.'?key='.$apiKey;
            $curlHandle = json_decode(file_get_contents($URL));
            
            foreach ($curlHandle as $key => $value) 
            {
                foreach ($value as $keys => $values) 
                {
                    if(isset($values[0]->info))
                    {
                        $firstname='';
                        $lastName='';
                        $dob='';
                        $country='';
                        $phone='';
                        $street='';
                        $state='';
                        $town='';
                        $postCode='';
                        $country='';
                        if(isset($values[0]->info->firstName))
                        {
                            $firstname=$values[0]->info->firstName;
                        }
                        if(isset($values[0]->info->lastName))
                        {
                            $lastName=$values[0]->info->lastName;
                        }
                        if(isset($values[0]->info->dob))
                        {
                            $dob=$values[0]->info->dob;
                        }
                        if(isset($values[0]->info->country))
                        {
                            $country=$values[0]->info->country;
                        }
                        if(isset($values[0]->info->phone))
                        {
                            $phone=$values[0]->info->phone;
                        }
                        if(isset($values[0]->info->addresses[0]->street))
                        {
                            $street=$values[0]->info->addresses[0]->street;
                        }
                        if(isset($values[0]->info->addresses[0]->state))
                        {
                            $state=$values[0]->info->addresses[0]->state;
                        }
                        if(isset($values[0]->info->addresses[0]->town))
                        {
                            $town=$values[0]->info->addresses[0]->town;
                        }
                        if(isset($values[0]->info->addresses[0]->postCode))
                        {
                            $postCode=$values[0]->info->addresses[0]->postCode;
                        }
                        if(isset($values[0]->info->addresses[0]->country))
                        {
                            $country=$values[0]->info->addresses[0]->country;
                        }

                        $detaileduser=User::find($user_id);
                        if($detaileduser)
                        {
                            $detaileduser->first_name=$firstname;
                            $detaileduser->last_name=$lastName;
                            $detaileduser->user_dob=$dob;
                            $detaileduser->phone=$phone;
                            $detaileduser->zipcode=$postCode;
                            $detaileduser->country=$country;
                            $detaileduser->town=$town;
                            $detaileduser->state=$state;
                            
                            $SumsubKyc=SumsubKyc::find($sumsub_Id);
                            if(isset($SumsubKyc->info_status) && $SumsubKyc->info_status ==1)
                            {
                                $detaileduser->kyc_status='2';
                                $SumsubKyc->info_status='2';
                                $SumsubKyc->save();
                            }
                            $detaileduser->save();
                        }

                        
                        
                    }
                    break;
                }
                 
             }
        }
        Log::alert('KYC update successfully');
    }
}
