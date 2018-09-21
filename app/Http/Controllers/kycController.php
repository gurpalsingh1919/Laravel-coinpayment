<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Mail;
use App\Models\UserKyc;
use App\User;
use Carbon\Carbon;
use App\Models\SumsubKyc;
use Log;
class kycController extends Controller
{
	public function sumSubKycHandler(Request $request)
	{
		$imagename = 'KYC_'.Carbon::now()->format('Ymd_His').'.txt';
		Storage::disk('local')->put('4NEW_KYC/'.$imagename, json_encode($request->all()));
		//echo "<pre>";print_r($request->all());die;
		if(isset($request) && !empty($request->all()))
		{
			$this->verifiedDataFromSumSub($request,$imagename);
		}
	}
	public function verifiedDataFromSumSub($request,$imagename)
	{
		
		if(isset($request->applicantId) && $request->applicantId !='')
		{
			if(isset($request->review))
			{

				$reviewData=array();
				if(isset($request->review))
				{
					$reviewData1=$request->review;
					//$reviewData = json_decode($reviewData1, true);
					$reviewData = json_decode(json_encode($reviewData1),true);
				}
				
				 //print_r($json['reviewAnswer']);die;
				//Log::write('DEBUG',  $reviewData);
			$reviewAnswer='';
			$rejectLabels='';
			$reviewRejectType='';
			$inspectionId='';
			$correlationId='';
			$clientComment='';
			if(isset($reviewData['reviewAnswer']))
			{
				$reviewAnswer=$reviewData['reviewAnswer'];
			}
			if(isset($reviewData['rejectLabels']))
			{
				$rejectLabels=json_encode($reviewData['rejectLabels']);
			}
			if(isset($reviewData['reviewRejectType']))
			{
				$reviewRejectType=$reviewData['reviewRejectType'];
			}
			if(isset($request->inspectionId))
			{
				$inspectionId=$request->inspectionId;
			}
			if(isset($request->correlationId))
			{
				$correlationId=$request->correlationId;
			}
			if(isset($reviewData['clientComment']))
			{
				$clientComment=$reviewData['clientComment'];
			}
			$applicantId=$request->applicantId;
			$SumsubKyc=SumsubKyc::where('applicantId',$applicantId)->first();
			if(isset($SumsubKyc))
			{
				$SumsubKyc->inspectionId=$inspectionId;
				$SumsubKyc->correlationId=$correlationId;
				$SumsubKyc->clientComment=$clientComment;
				$SumsubKyc->reviewAnswer=$reviewAnswer;
				$SumsubKyc->rejectLabels=$rejectLabels;
				$SumsubKyc->reviewRejectType=$reviewRejectType;
				$SumsubKyc->file_name=$imagename;
				//echo $reviewAnswer;die;
				if($reviewAnswer=='GREEN')
				{
					$SumsubKyc->info_status='1';
					$SumsubKyc->save();
					$user_id=$SumsubKyc->user_id;
					$user=User::find($user_id);
		        	$user->kyc_status=2;
		    		$user->save();
		    		die('IPN OK');
				}
				else
				{
					$SumsubKyc->info_status='0';
					$SumsubKyc->save();
				}
			}
			}
			
			
		}
		
	}
    public function kycHandler(Request $request)
    {
    	$imagename = 'KYC_'.Carbon::now()->format('Ymd_His').'.txt';
		Storage::disk('local')->put('KYC/'.$imagename, json_encode($request->all()));
		if(isset($request) && !empty($request->all()))
		{
			$this->veryfiedDataFromOcular($request,$imagename);
		}
    	
    }
    public function veryfiedDataFromOcular($allrequest,$imagename)
    {
    	//echo $allrequest;die;

    	if(!empty($allrequest))
    	{
    		$email = $allrequest->res_cli_email;
    		//echo $email;
    		$user=User::where('email',$email)->first();
    		////echo $user->toSql();
    		$user_id=0;
    		//echo "<pre>";print_r($user->toArray());
    		//die;
			if(isset($user))
    		{
    			$user_id=$user->id;
    		}

    		$userkyc= new UserKyc;
	    	$userkyc->users_id = $user_id;
	    	//echo $user_id;
	        $userkyc->remote_ip = $allrequest->remote_ip;
	        $userkyc->Name = $allrequest->Name;
	        $userkyc->Sec_name = $allrequest->Sec_name;
	        $userkyc->Last_Name = $allrequest->Last_Name;
	        $userkyc->Citizenship = $allrequest->Citizenship;
	        $userkyc->Gender = $allrequest->Gender;
	        $userkyc->Birthday = $allrequest->Birthday;
	        $userkyc->res_signature = $this->convertImageFromBaseSixFour($allrequest->res_signature,$imagename,'5');
	        $userkyc->res_fullname = $allrequest->res_fullname;
	        $userkyc->BirthdayField = $allrequest->BirthdayField;
	        $userkyc->Occupation = $allrequest->Occupation;
	        $userkyc->Income = $allrequest->Income;
	        $userkyc->Client_Email = $allrequest->Client_Email;
	        $userkyc->Client_Email_Verified = $allrequest->Client_Email_Verified;
	        $userkyc->re3id = $allrequest->re3id;
	        $userkyc->Client_EmailCode = $allrequest->Client_EmailCode;
	        $userkyc->Client_EmailCode_Verified = $allrequest->Client_EmailCode_Verified;
	        $userkyc->StreetNumber = $allrequest->StreetNumber;
	        $userkyc->Address = $allrequest->Address;
	        $userkyc->City = $allrequest->City;
	        $userkyc->State = $allrequest->State;
	        $userkyc->Zip_code = $allrequest->Zip_code;
	        $userkyc->Country = $allrequest->Country;
	        $userkyc->Client_Phone_CC = $allrequest->Client_Phone_CC;
	        $userkyc->Client_Phone_CC_Number = $allrequest->Client_Phone_CC_Number;
	        $userkyc->Client_Phone_CC_Verified = $allrequest->Client_Phone_CC_Verified;
	        $userkyc->Client_Phone_Verified = $allrequest->Client_Phone_Verified;
	        $userkyc->Client_PhoneCode = $allrequest->Client_PhoneCode;
	        $userkyc->Client_PhoneCode_Verified = $allrequest->Client_PhoneCode_Verified;
	        $userkyc->GetID_data = $allrequest->GetID_data;
	        $userkyc->res_issue_date = $allrequest->res_issue_date;
	        $userkyc->Id_Data = $this->convertImageFromBaseSixFour($allrequest->Id_Data,$imagename,'1');
	        $userkyc->Costumer_Id = $allrequest->Costumer_Id;
	        $userkyc->Client_Ether_wallet = $allrequest->Client_Ether_wallet;
	        $userkyc->Client_Telegram = $allrequest->Client_Telegram;
	        $userkyc->Client_Twitter = $allrequest->Client_Twitter;
	        $userkyc->Client_Username = $allrequest->Client_Username;
	        $userkyc->Client_Password = $allrequest->Client_Password;
	        $userkyc->Client_Repassword = $allrequest->Client_Repassword;
	        $userkyc->tnc = $allrequest->tnc;
	        $userkyc->res_id = $allrequest->res_id;
	        $userkyc->res_req_id = $allrequest->res_req_id;
	        $userkyc->res_status = $allrequest->res_status;
	        $userkyc->res_success = $allrequest->res_success;
	        $userkyc->res_timestamp = $allrequest->res_timestamp;

	        $userkyc->res_ofac_check = $allrequest->res_ofac_check;
	        $userkyc->res_list_status = $allrequest->res_list_status;
	        $userkyc->res_face_match = $allrequest->res_face_match;
	        $userkyc->res_cli_risk_vinc = $allrequest->res_cli_risk_vinc;
	        $userkyc->res_cli_add_status = $allrequest->res_cli_add_status;
	        $userkyc->res_cli_id = $allrequest->res_cli_id;
	        $userkyc->res_cli_full_name = $allrequest->res_cli_full_name;
	        $userkyc->res_cli_name = $allrequest->res_cli_name;
	        $userkyc->res_cli_last_name = $allrequest->res_cli_last_name;
	        $userkyc->res_cli_seclastname = $allrequest->res_cli_seclastname;
	        $userkyc->res_cli_birthday = $allrequest->res_cli_birthday;
	        $userkyc->res_cli_address = $allrequest->res_cli_address;
	        $userkyc->res_cli_city = $allrequest->res_cli_city;
	        $userkyc->res_cli_state = $allrequest->res_cli_state;
	        $userkyc->res_cli_country = $allrequest->res_cli_country;
	        $userkyc->res_cli_zip_code = $allrequest->res_cli_zip_code;
	        $userkyc->res_cli_ocupation = $allrequest->res_cli_ocupation;
	        $userkyc->res_cli_email = $allrequest->res_cli_email;
	        $userkyc->res_cli_colonia = $allrequest->res_cli_colonia;
	        $userkyc->res_cli_gender = $allrequest->res_cli_gender;
	        $userkyc->res_cli_pass = $allrequest->res_cli_pass;
	        $userkyc->res_cli_user = $allrequest->res_cli_user;
	        $userkyc->res_cli_risk_text = $allrequest->res_cli_risk_text;
	        $userkyc->res_cli_sec_name = $allrequest->res_cli_sec_name;
	        $userkyc->res_cli_street_name = $allrequest->res_cli_street_name;
	        $userkyc->res_cli_street_num = $allrequest->res_cli_street_num;
	        $userkyc->res_docname = $allrequest->res_docname;
	        $userkyc->res_issuercode = $allrequest->res_issuercode;
	        $userkyc->res_issuername = $allrequest->res_issuername;
	        $userkyc->res_docclasscode = $allrequest->res_docclasscode;
	        $userkyc->res_age = $allrequest->res_age;
	        $userkyc->res_portrait = $this->convertImageFromBaseSixFour($allrequest->res_portrait,$imagename,'6');
	        $userkyc->res_surname = $allrequest->res_surname;
	        $userkyc->res_givenname = $allrequest->res_givenname;
	        $userkyc->res_firstname = $allrequest->res_firstname;
	        $userkyc->res_midname = $allrequest->res_midname;
	        $userkyc->res_dob = $allrequest->res_dob;
	        $userkyc->res_doc_class_node = $allrequest->res_doc_class_node;
	        $userkyc->res_doc_class_name = $allrequest->res_doc_class_name;
	        $userkyc->res_doc_number = $allrequest->res_doc_number;
	        $userkyc->res_exp_date = $allrequest->res_exp_date;
	        $userkyc->res_issue_state_code = $allrequest->res_issue_state_code;
	        $userkyc->res_issue_state_name = $allrequest->res_issue_state_name;
	        $userkyc->res_country_code = $allrequest->res_country_code;
	        $userkyc->res_country_name = $allrequest->res_country_name;
	        $userkyc->res_address = $allrequest->res_address;
	        $userkyc->res_address_line_1 = $allrequest->res_address_line_1;
	        $userkyc->res_address_line_2 = $allrequest->res_address_line_2;
	        $userkyc->res_city = $allrequest->res_city;
	        $userkyc->res_state = $allrequest->res_state;
	        $userkyc->res_pc = $allrequest->res_pc;
	        $userkyc->res_sex = $allrequest->res_sex;
	        $userkyc->res_height = $allrequest->res_height;
	        $userkyc->res_license_class = $allrequest->res_license_class;
	        $userkyc->res_license_restrictions = $allrequest->res_license_restrictions;
	        $userkyc->res_simi_sf1xsf2 = $allrequest->res_simi_sf1xsf2;
	        $userkyc->res_simi_sf1xsf3 = $allrequest->res_simi_sf1xsf3;
	        $userkyc->res_simi_sf2xsf3 = $allrequest->res_simi_sf2xsf3;
	        $userkyc->res_cli_add_status_description = $allrequest->res_cli_add_status_description;
	       	$userkyc->Face_data = $this->convertImageFromBaseSixFour($allrequest->Face_data,$imagename,'2');
	        $userkyc->Face_data2 = $this->convertImageFromBaseSixFour($allrequest->Face_data2,$imagename,'3');
	        $userkyc->Face_data3 = $this->convertImageFromBaseSixFour($allrequest->Face_data3,$imagename,'4');
	        $userkyc->DocumentType = $allrequest->DocumentType;
	        $userkyc->Face_id = $allrequest->Face_id;

	        $userkyc->save();
	        if(isset($allrequest->res_status) && $allrequest->res_status==1 && $user_id !='' && $user_id !=0)
	        {
	        	$user=User::find($user_id);
	        	//$user=User::find($user_id);
	        	
	        	$user->kyc_status=1;
	    		$user->fullname =$allrequest->Name.' '. $allrequest->Last_Name;
	        	$user->save();
	        }
	      
    	}
    	
    }
    public function convertImageFromBaseSixFour($imagebase,$img_name,$number)
    {
    	$fileName='';
    	if (base64_decode($imagebase, true)) 
    	{
		    $img =  base64_decode($imagebase); 
		    $fileName =  $img_name .'-'.$number. '.png';
			//$success = file_put_contents($file, $data);
			//print $success ? $file : 'Unable to save the file.';
			
			if(Storage::disk('local')->put('images/KYC'.'/'.$fileName, $img, 'public'))
			{
				return $fileName;
			}
			
		} 
		return $fileName;
		    

    }
    public function getKycInfo($user_id)
    {
    	$userData=UserKyc::where('user_id',$user_id)->get();
    	return $userData;
    }
    public function getApprovedKycInfo()
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
        
       //echo "<pre>";print_r($curlHandle);die;
    }
}
