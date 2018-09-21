<?php

namespace App\Http\Controllers;

use App\Models\Activation;
use App\User;
use Hash;
use Illuminate\Http\Request;
use Mail;
use Sentinel;
use Validator;
use Carbon\Carbon;
use App\Models\UserKyc;
use App\Models\SumsubKyc;
use CURLFile;
class ProfileController extends Controller {

public function completedYourKyc()
{
  //$time = Carbon::parse('2018-04-28T22:17:41+05:30')->format('d M Y , H:m:s'); //28 Apr 2018
//echo $time;die;
      // CHANGE THIS to the API Key that we've sent you
    //$apiKey = 'DSXCAVXXBJPRHR';
    $apiKey = 'EJUTSLXPKMQFHB';
    // -------------------------------------------

    //$baseUrl = 'https://test-api.sumsub.com';
    $baseUrl = 'https://api.sumsub.com';
    
    $user=Sentinel::getUser();
    // your userId
    $userId = $user->id;

    // Token TTL in secs
    $tokenLiveTime = 1800;
    // if you have a profile image, that you want ot upload
    $profileImagePath = '../../iframe/static/i_doc.png';

    $accessToken = '';
    $applicantId = '';
    $accessTokenError = '';
    $applicantIdError = '';
    $uploadProfileImageError = '';
    $firstName='';
    $lastName='';
    /*********************** Previous Data *******************/
    $SumSubData=SumsubKyc::where('user_id','=',$userId)->first();
   // echo "<pre>";print_r($SumSubData);die;
    if($SumSubData)
    {
      //echo "if";
       $applicantId= $SumSubData->applicantId;
    }
    

      // 1. Creating an applicant (see http://developers.sumsub.com/#setting-a-required-document-set)
      $url = $baseUrl . '/resources/applicants?key=' . $apiKey;
      

      //$configParamsString['email']=$user->email;
      $fullname=explode(' ', $user->fullname);
      if(isset($fullname[0]) && $fullname[0] !='')
      {
        $firstName=$fullname[0];
      }
      if(isset($fullname[1]) && $fullname[1] !='')
      {
        $lastName=$fullname[1];
      }

      $configParamsString=$this->getRequiredFields($firstName,$lastName,$user->email);
    //echo "<pre>";print_r($configParamsString);die;
        $response = $this->request_kyc($url, array('Content-Type:application/json', 'Accept: application/json'), $configParamsString);
        $responsePayload = json_decode($response, true);
        if (isset($responsePayload['code']) && isset($responsePayload['description'])) {
            $applicantIdError = $responsePayload['description'];
        } elseif (isset($responsePayload['id'])) {
          if($applicantId =='')
          {
              $SumsubKyc=new SumsubKyc;
              $SumsubKyc->user_id=$userId;
              $applicantId = $responsePayload['id'];
              $SumsubKyc->applicantId=$applicantId;
              $SumsubKyc->save();
          }
            
        }

        // 2. Creating an iframe access token
        $url = $baseUrl . '/resources/accessTokens?userId=' . $userId . '&key=' . $apiKey;
      
        $response = $this->request_kyc($url, array('Accept: application/json'));
        $responsePayload = json_decode($response, true);
       // echo "<pre>";print_r($url);die;
        if (isset($responsePayload['code']) && isset($responsePayload['description'])) {
            $accessTokenError = $responsePayload['description'];
        } elseif (isset($responsePayload['token'])) {
            $accessToken = $responsePayload['token'];
        }
//echo $accessToken;die;
    // 3. Adding an id document (this step is optional, if you want to attach some additional documents)
    //$applicantId='5b24ea1f0a975a2ea9a6cc9c';
    /*if ($applicantId) {
        $url = $baseUrl . '/resources/applicants/' . $applicantId . '/info/idDoc?key=' . $apiKey;
        $post = array(
            'metadata' => '{"idDocType":"PROFILE_IMAGE", "country": "ALB"}',
            'content' => new CURLFile($profileImagePath) // PHP >= 5.5.0
            //'content' => '@'.$profileImagePath // PHP < 5.5.0
        );
        $response = $this->request_kyc($url, array('Content-Type: multipart/form-data', 'Accept: application/json'), $post);
        $responsePayload = json_decode($response, true);
        if (isset($responsePayload['code']) && isset($responsePayload['description'])) {
            $uploadProfileImageError = $responsePayload['description'];
        }
    }*/
//echo $applicantId;die;

     return view('profile.kyc',compact('accessToken','applicantId','baseUrl','accessTokenError','applicantIdError','uploadProfileImageError'));
}
public function request_kyc($url, $headers, $postParams = '')
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    // this headers required for all requests
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, 1);
    if ($postParams) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postParams);
    }
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_output = curl_exec($ch);
    curl_close($ch);
    return $server_output;
}
public function getRequiredFields($firstName,$lastName,$email)
{
    return $configParamsString = '{
        "email":"'.$email.'",
        "info":{
          "firstName":"'.$firstName.'",
          "lastName":"'.$lastName.'"
         
        },
        "requiredIdDocs": {
    
    "docSets": [
      {
        "idDocSetType": "APPLICANT_DATA",
        "fields": [
          {
            "name": "firstName",
            "required": true
          },
          {
            "name": "lastName",
            "required": true
          },
          {
            "name": "email",
            "required": true
          },
          {
            "name": "phone",
            "required": true
          },
          {
            "name": "dob",
            "required": true
          },
          {
            "name": "addresses",
            "required": true
          }
        ]
      },
      {
        "idDocSetType": "IDENTITY",
        "types": [
          "PASSPORT",
          "DRIVERS",
          "ID_CARD"
        ],
        "subTypes": [
          "FRONT_SIDE",
          "BACK_SIDE"
        ]
      },
      {
        "idDocSetType": "SELFIE",
        "types": [
          "SELFIE"
        ],
        "subTypes": null
      },
      {
        "idDocSetType": "PROOF_OF_RESIDENCE",
        "types": [
          "UTILITY_BILL"
        ],
        "subTypes": null
      }
    ]
  }
      }';

      //return $configParamsString;
}

  public function index() 
  {
    $countries = array(
//'Select a Country' => 'Select a Country',
'Ascension Island' => 'Ascension Island',
'Andorra' => 'Andorra',
'United Arab Emirates' => 'United Arab Emirates',
'Afghanistan' => 'Afghanistan',
'Antigua And Barbuda' => 'Antigua And Barbuda',
'Anguilla' => 'Anguilla',
'Albania' => 'Albania',
'Armenia' => 'Armenia',
'Netherlands Antilles' => 'Netherlands Antilles',
'Angola' => 'Angola',
'Antarctica' => 'Antarctica',
'Argentina' => 'Argentina',
'American Samoa' => 'American Samoa',
'Austria' => 'Austria',
'Australia' => 'Australia',
'Aruba' => 'Aruba',
'Ãƒâ€¦land' => 'Ãƒâ€¦land',
'Azerbaijan' => 'Azerbaijan',
'Bosnia And Herzegovina' => 'Bosnia And Herzegovina',
'Barbados' => 'Barbados',
'Belgium' => 'Belgium',
'Bangladesh' => 'Bangladesh',
'Burkina Faso' => 'Burkina Faso',
'Bulgaria' => 'Bulgaria',
'Bahrain' => 'Bahrain',
'Burundi' => 'Burundi',
'Benin' => 'Benin',
'Bermuda' => 'Bermuda',
'Brunei Darussalam' => 'Brunei Darussalam',
'Bolivia' => 'Bolivia',
'Brazil' => 'Brazil',
'Bahamas' => 'Bahamas',
'Bhutan' => 'Bhutan',
'Bouvet Island' => 'Bouvet Island',
'Botswana' => 'Botswana',
'Belarus' => 'Belarus',
'Belize' => 'Belize',
'Canada' => 'Canada',
'Cocos (Keeling) Islands' => 'Cocos (Keeling) Islands',
'Congo (Democratic Republic)' => 'Congo (Democratic Republic)',
'Central African Republic' => 'Central African Republic',
'Congo (Republic)' => 'Congo (Republic)',
'Switzerland' => 'Switzerland',
'Cote DÃ¢â‚¬â„¢Ivoire' => 'Cote DÃ¢â‚¬â„¢Ivoire',
'Cook Islands' => 'Cook Islands',
'Chile' => 'Chile',
'Cameroon' => 'Cameroon',
'PeopleÃ¢â‚¬â„¢s Republic of China' => 'PeopleÃ¢â‚¬â„¢s Republic of China',
'Colombia' => 'Colombia',
'Costa Rica' => 'Costa Rica',
'Cuba' => 'Cuba',
'Cape Verde' => 'Cape Verde',
'Christmas Island' => 'Christmas Island',
'Cyprus' => 'Cyprus',
'Czech Republic' => 'Czech Republic',
'Germany' => 'Germany',
'Djibouti' => 'Djibouti',
'Denmark' => 'Denmark',
'Dominica' => 'Dominica',
'Dominican Republic' => 'Dominican Republic',
'Algeria' => 'Algeria',
'Ecuador' => 'Ecuador',
'Estonia' => 'Estonia',
'Egypt' => 'Egypt',
'Eritrea' => 'Eritrea',
'Spain' => 'Spain',
'Ethiopia' => 'Ethiopia',
'European Union' => 'European Union',
'Finland' => 'Finland',
'Fiji' => 'Fiji',
'Falkland Islands (Malvinas)' => 'Falkland Islands (Malvinas)',
'Micronesia, Federated States Of' => 'Micronesia, Federated States Of',
'Faroe Islands' => 'Faroe Islands',
'France' => 'France',
'Gabon' => 'Gabon',
'United Kingdom' => 'United Kingdom',
'Grenada' => 'Grenada',
'Georgia' => 'Georgia',
'French Guiana' => 'French Guiana',
'Guernsey' => 'Guernsey',
'Ghana' => 'Ghana',
'Gibraltar' => 'Gibraltar',
'Greenland' => 'Greenland',
'Gambia' => 'Gambia',
'Guinea' => 'Guinea',
'Guadeloupe' => 'Guadeloupe',
'Equatorial Guinea' => 'Equatorial Guinea',
'Greece' => 'Greece',
'South Georgia And The South Sandwich Islands' => 'South Georgia And The South Sandwich Islands',
'Guatemala' => 'Guatemala',
'Guam' => 'Guam',
'Guinea-Bissau' => 'Guinea-Bissau',
'Guyana' => 'Guyana',
'Hong Kong' => 'Hong Kong',
'Heard And Mc Donald Islands' => 'Heard And Mc Donald Islands',
'Honduras' => 'Honduras',
'Croatia (local name: Hrvatska)' => 'Croatia (local name: Hrvatska)',
'Haiti' => 'Haiti',
'Hungary' => 'Hungary',
'Indonesia' => 'Indonesia',
'Ireland' => 'Ireland',
'Israel' => 'Israel',
'Isle of Man' => 'Isle of Man',
'India' => 'India',
'British Indian Ocean Territory' => 'British Indian Ocean Territory',
'Iraq' => 'Iraq',
'Iran (Islamic Republic Of)' => 'Iran (Islamic Republic Of)',
'Iceland' => 'Iceland',
'Italy' => 'Italy',
'Jersey' => 'Jersey',
'Jamaica' => 'Jamaica',
'Jordan' => 'Jordan',
'Japan' => 'Japan',
'Kenya' => 'Kenya',
'Kyrgyzstan' => 'Kyrgyzstan',
'Cambodia' => 'Cambodia',
'Kiribati' => 'Kiribati',
'Comoros' => 'Comoros',
'Saint Kitts And Nevis' => 'Saint Kitts And Nevis',
'Korea, Republic Of' => 'Korea, Republic Of',
'Kuwait' => 'Kuwait',
'Cayman Islands' => 'Cayman Islands',
'Kazakhstan' => 'Kazakhstan',
'Lao PeopleÃ¢â‚¬â„¢s Democratic Republic' => 'Lao PeopleÃ¢â‚¬â„¢s Democratic Republic',
'Lebanon' => 'Lebanon',
'Saint Lucia' => 'Saint Lucia',
'Liechtenstein' => 'Liechtenstein',
'Sri Lanka' => 'Sri Lanka',
'Liberia' => 'Liberia',
'Lesotho' => 'Lesotho',
'Lithuania' => 'Lithuania',
'Luxembourg' => 'Luxembourg',
'Latvia' => 'Latvia',
'Libyan Arab Jamahiriya' => 'Libyan Arab Jamahiriya',
'Morocco' => 'Morocco',
'Monaco' => 'Monaco',
'Moldova, Republic Of' => 'Moldova, Republic Of',
'Montenegro' => 'Montenegro',
'Madagascar' => 'Madagascar',
'Marshall Islands' => 'Marshall Islands',
'Macedonia, The Former Yugoslav Republic Of' => 'Macedonia, The Former Yugoslav Republic Of',
'Mali' => 'Mali',
'Myanmar' => 'Myanmar',
'Mongolia' => 'Mongolia',
'Macau' => 'Macau',
'Northern Mariana Islands' => 'Northern Mariana Islands',
'Martinique' => 'Martinique',
'Mauritania' => 'Mauritania',
'Montserrat' => 'Montserrat',
'Malta' => 'Malta',
'Mauritius' => 'Mauritius',
'Maldives' => 'Maldives',
'Malawi' => 'Malawi',
'Mexico' => 'Mexico',
'Malaysia' => 'Malaysia',
'Mozambique' => 'Mozambique',
'Namibia' => 'Namibia',
'New Caledonia' => 'New Caledonia',
'Niger' => 'Niger',
'Norfolk Island' => 'Norfolk Island',
'Nigeria' => 'Nigeria',
'Nicaragua' => 'Nicaragua',
'Netherlands' => 'Netherlands',
'Norway' => 'Norway',
'Nepal' => 'Nepal',
'Nauru' => 'Nauru',
'Niue' => 'Niue',
'New Zealand' => 'New Zealand',
'Oman' => 'Oman',
'Panama' => 'Panama',
'Peru' => 'Peru',
'French Polynesia' => 'French Polynesia',
'Papua New Guinea' => 'Papua New Guinea',
'Philippines, Republic of the' => 'Philippines, Republic of the',
'Pakistan' => 'Pakistan',
'Poland' => 'Poland',
'St. Pierre And Miquelon' => 'St. Pierre And Miquelon',
'Pitcairn' => 'Pitcairn',
'Puerto Rico' => 'Puerto Rico',
'Palestine' => 'Palestine',
'Portugal' => 'Portugal',
'Palau' => 'Palau',
'Paraguay' => 'Paraguay',
'Qatar' => 'Qatar',
'Reunion' => 'Reunion',
'Romania' => 'Romania',
'Serbia' => 'Serbia',
'Russian Federation' => 'Russian Federation',
'Rwanda' => 'Rwanda',
'Saudi Arabia' => 'Saudi Arabia',
'United Kingdom' => 'United Kingdom',
'Solomon Islands' => 'Solomon Islands',
'Seychelles' => 'Seychelles',
'Sudan' => 'Sudan',
'Sweden' => 'Sweden',
'Singapore' => 'Singapore',
'St. Helena' => 'St. Helena',
'Slovenia' => 'Slovenia',
'Svalbard And Jan Mayen Islands' => 'Svalbard And Jan Mayen Islands',
'Slovakia (Slovak Republic)' => 'Slovakia (Slovak Republic)',
'Sierra Leone' => 'Sierra Leone',
'San Marino' => 'San Marino',
'Senegal' => 'Senegal',
'Somalia' => 'Somalia',
'Suriname' => 'Suriname',
'Sao Tome And Principe' => 'Sao Tome And Principe',
'Soviet Union' => 'Soviet Union',
'El Salvador' => 'El Salvador',
'Syrian Arab Republic' => 'Syrian Arab Republic',
'Swaziland' => 'Swaziland',
'Turks And Caicos Islands' => 'Turks And Caicos Islands',
'Chad' => 'Chad',
'French Southern Territories' => 'French Southern Territories',
'Togo' => 'Togo',
'Thailand' => 'Thailand',
'Tajikistan' => 'Tajikistan',
'Tokelau' => 'Tokelau',
'East Timor (new code)' => 'East Timor (new code)',
'Turkmenistan' => 'Turkmenistan',
'Tunisia' => 'Tunisia',
'Tonga' => 'Tonga',
'East Timor (old code)' => 'East Timor (old code)',
'Turkey' => 'Turkey',
'Trinidad And Tobago' => 'Trinidad And Tobago',
'Tuvalu' => 'Tuvalu',
'Taiwan' => 'Taiwan',
'Tanzania, United Republic Of' => 'Tanzania, United Republic Of',
'Ukraine' => 'Ukraine',
'Uganda' => 'Uganda',
'United States Minor Outlying Islands' => 'United States Minor Outlying Islands',
'United States' => 'United States',
'Uruguay' => 'Uruguay',
'Uzbekistan' => 'Uzbekistan',
'Vatican City State (Holy See)' => 'Vatican City State (Holy See)',
'Saint Vincent And The Grenadines' => 'Saint Vincent And The Grenadines',
'Venezuela' => 'Venezuela',
'Virgin Islands (British)' => 'Virgin Islands (British)',
'Virgin Islands (U.S.)' => 'Virgin Islands (U.S.)',
'Viet Nam' => 'Viet Nam',
'Vanuatu' => 'Vanuatu',
'Wallis And Futuna Islands' => 'Wallis And Futuna Islands',
'Samoa' => 'Samoa',
'Yemen' => 'Yemen',
'Mayotte' => 'Mayotte',
'South Africa' => 'South Africa',
'Zambia' => 'Zambia',
'Zimbabwe' => 'Zimbabwe'
);
//echo "<pre>";print_r($country); die;//Remove this line
 $user=Sentinel::getUser();
    $kyc_info=UserKyc::where('users_id',$user->id)->get();
    //echo "<pre>";print_r($kyc_info->toArray()[0]);die;
    $kyc_infos = array('remote_ip'=>'','Name'=>'','Sec_name'=>'','Last_Name'=>'','Citizenship'=>'','Birthday'=>'','Gender'=>'','Occupation'=>'','Client_Email'=>'','Address'=>'','StreetNumber'=>'','City'=>'',
      'Zip_code'=>'','State'=>'','Country'=>'','Client_Username'=>'','Client_Password'=>'','Income'=>'','res_exp_date'=>'','Face_data'=>'','Face_data2'=>'','Face_data3'=>'','Id_Data'=>'');
    if(isset($kyc_info) && isset($kyc_info->toArray()[0]))
    {
      $kyc_infos=  $kyc_info->toArray()[0];
        
    }
    //echo "<pre>";print_r($kyc_infos['Face_data']);die;
    return view('profile.index',compact('countries','kyc_infos'));
  }

  public function profile_update(Request $request)
  {
    
    $this->validate($request,[
            'fullname'=>'required|max:255|string',
            //'company' => 'required|max:255|string',
            'phone' => 'required|min:11|numeric',
            'zipcode' => 'required|min:6|numeric',
            'address'=>'required|string',
            'country'=>'required|string',
            'city' => 'required|max:255|string',
    ]); 
     $user = Sentinel::findById(Sentinel::getUser()->id);
      
    $user->fullname = $request->fullname;
    $user->company = $request->company;
    $user->phone = $request->phone;
    $user->zipcode = $request->zipcode;
    $user->address = $request->address;
    $user->country = $request->country;
    $user->city = $request->city;
    $user->save();

      return redirect()->back()->with('success',' Profile updated successfully');

  }

  public function kyc_verify(Request $request)
  {
   
   //echo "<pre>";print_r($request->all());die;

   /*$this->validate($request,[
            'first_name'=>'required|max:255|string',
            'last_name'=>'required|max:255|string',
            'gender'=>'required|max:255|string',
            'phone' => 'required|min:11|numeric',
            'email'=>'required|max:255|email',
            'address'=>'required|string',
            'country'=>'required|string',
            'city' => 'required|max:255|string',
            'zipcode' => 'required|min:1|numeric',
    ]); */
    $user = Sentinel::findById(Sentinel::getUser()->id);
    //echo "<pre>";print_r($request->all());die;
      
    $user->first_name = $request->first_name;
    //$user->middle_name = $request->middle_name;
    $user->last_name = $request->last_name;
    $user->phone = $request->phone;
    $user->gender = $request->gender;
    $user->zipcode = $request->zipcode;
    $user->address = $request->address;
    $user->country = $request->country;
    $user->city = $request->city;
   
    if ($request->hasFile('kyc_document') || $request->hasFile('kyc_document1'))
        {
         
            if ($request->hasFile('kyc_document')) {
                $file = $request->file('kyc_document');
                
                 $currenttime=Carbon::now()->timestamp;
                //echo $currenttime;die;
                 $extension= $file->getClientOriginalExtension();
                $file_name='KYC--'.$user->id.'--'.$currenttime.'1.'.$extension;
                //echo $file_name;die;
                $destinationPath = 'upload/4new_kyc';
                $file->move($destinationPath, $file_name);
                //$filename1 = $file->getClientOriginalName();
                $filename1 = urlencode($file_name);

                //$set = User::find($user_id);
                $user->kyc_document = $filename1;
              
            }
            if ($request->hasFile('kyc_document1')) {
                $file_two = $request->file('kyc_document1');
                 $currenttime=Carbon::now()->timestamp;
                 $extension= $file->getClientOriginalExtension();
                $filename2='KYC--'.$user->id.'--'.$currenttime.'2.'.$extension;
                $destinationPath = 'upload/4new_kyc';
                $file_two->move($destinationPath, $filename2);
               //$filename2 = $file_two->getClientOriginalName();
                $filename2 = urlencode($filename2);
               // $set = User::find($user_id);
                $user->kyc_document1 = $filename2;
                
            }

           
        }
      
    $user->kyc_status = '2';
    $user->save();

      return redirect()->back()->with('success',' Profile Verify successfully');

  }



  public function showChangePasswordForm()
  {
    return view('profile.change_password');
  }
 

  public function password_update(Request $request)
  {
     
    $this->validate($request, [
            'current_password' => 'required',
            'new_password' => 'required|string|min:6',
            'confirm_new_password' => 'required|string|min:6|same:new_password',
        ]);  
 

        if (!(Hash::check($request->get('current_password'), Sentinel::getUser()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }
 
        if(strcmp($request->get('current_password'), $request->get('new_password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }

    $user = Sentinel::findById(Sentinel::getUser()->id);      
    $user->password =bcrypt($request->get('new_password'));
    $user->save(); 


    return redirect()->back()->with('success','New Password updated successfully'); 
  }
  public function getCountries()
  {
    return $countries = array
            (
              'AF' => 'Afghanistan',
              'AX' => 'Aland Islands',
              'AL' => 'Albania',
              'DZ' => 'Algeria',
              'AS' => 'American Samoa',
              'AD' => 'Andorra',
              'AO' => 'Angola',
              'AI' => 'Anguilla',
              'AQ' => 'Antarctica',
              'AG' => 'Antigua And Barbuda',
              'AR' => 'Argentina',
              'AM' => 'Armenia',
              'AW' => 'Aruba',
              'AU' => 'Australia',
              'AT' => 'Austria',
              'AZ' => 'Azerbaijan',
              'BS' => 'Bahamas',
              'BH' => 'Bahrain',
              'BD' => 'Bangladesh',
              'BB' => 'Barbados',
              'BY' => 'Belarus',
              'BE' => 'Belgium',
              'BZ' => 'Belize',
              'BJ' => 'Benin',
              'BM' => 'Bermuda',
              'BT' => 'Bhutan',
              'BO' => 'Bolivia',
              'BA' => 'Bosnia And Herzegovina',
              'BW' => 'Botswana',
              'BV' => 'Bouvet Island',
              'BR' => 'Brazil',
              'IO' => 'British Indian Ocean Territory',
              'BN' => 'Brunei Darussalam',
              'BG' => 'Bulgaria',
              'BF' => 'Burkina Faso',
              'BI' => 'Burundi',
              'KH' => 'Cambodia',
              'CM' => 'Cameroon',
              'CA' => 'Canada',
              'CV' => 'Cape Verde',
              'KY' => 'Cayman Islands',
              'CF' => 'Central African Republic',
              'TD' => 'Chad',
              'CL' => 'Chile',
              'CN' => 'China',
              'CX' => 'Christmas Island',
              'CC' => 'Cocos (Keeling) Islands',
              'CO' => 'Colombia',
              'KM' => 'Comoros',
              'CG' => 'Congo',
              'CD' => 'Congo, Democratic Republic',
              'CK' => 'Cook Islands',
              'CR' => 'Costa Rica',
              'CI' => 'Cote D\'Ivoire',
              'HR' => 'Croatia',
              'CU' => 'Cuba',
              'CY' => 'Cyprus',
              'CZ' => 'Czech Republic',
              'DK' => 'Denmark',
              'DJ' => 'Djibouti',
              'DM' => 'Dominica',
              'DO' => 'Dominican Republic',
              'EC' => 'Ecuador',
              'EG' => 'Egypt',
              'SV' => 'El Salvador',
              'GQ' => 'Equatorial Guinea',
              'ER' => 'Eritrea',
              'EE' => 'Estonia',
              'ET' => 'Ethiopia',
              'FK' => 'Falkland Islands (Malvinas)',
              'FO' => 'Faroe Islands',
              'FJ' => 'Fiji',
              'FI' => 'Finland',
              'FR' => 'France',
              'GF' => 'French Guiana',
              'PF' => 'French Polynesia',
              'TF' => 'French Southern Territories',
              'GA' => 'Gabon',
              'GM' => 'Gambia',
              'GE' => 'Georgia',
              'DE' => 'Germany',
              'GH' => 'Ghana',
              'GI' => 'Gibraltar',
              'GR' => 'Greece',
              'GL' => 'Greenland',
              'GD' => 'Grenada',
              'GP' => 'Guadeloupe',
              'GU' => 'Guam',
              'GT' => 'Guatemala',
              'GG' => 'Guernsey',
              'GN' => 'Guinea',
              'GW' => 'Guinea-Bissau',
              'GY' => 'Guyana',
              'HT' => 'Haiti',
              'HM' => 'Heard Island & Mcdonald Islands',
              'VA' => 'Holy See (Vatican City State)',
              'HN' => 'Honduras',
              'HK' => 'Hong Kong',
              'HU' => 'Hungary',
              'IS' => 'Iceland',
              'IN' => 'India',
              'ID' => 'Indonesia',
              'IR' => 'Iran, Islamic Republic Of',
              'IQ' => 'Iraq',
              'IE' => 'Ireland',
              'IM' => 'Isle Of Man',
              'IL' => 'Israel',
              'IT' => 'Italy',
              'JM' => 'Jamaica',
              'JP' => 'Japan',
              'JE' => 'Jersey',
              'JO' => 'Jordan',
              'KZ' => 'Kazakhstan',
              'KE' => 'Kenya',
              'KI' => 'Kiribati',
              'KR' => 'Korea',
              'KW' => 'Kuwait',
              'KG' => 'Kyrgyzstan',
              'LA' => 'Lao People\'s Democratic Republic',
              'LV' => 'Latvia',
              'LB' => 'Lebanon',
              'LS' => 'Lesotho',
              'LR' => 'Liberia',
              'LY' => 'Libyan Arab Jamahiriya',
              'LI' => 'Liechtenstein',
              'LT' => 'Lithuania',
              'LU' => 'Luxembourg',
              'MO' => 'Macao',
              'MK' => 'Macedonia',
              'MG' => 'Madagascar',
              'MW' => 'Malawi',
              'MY' => 'Malaysia',
              'MV' => 'Maldives',
              'ML' => 'Mali',
              'MT' => 'Malta',
              'MH' => 'Marshall Islands',
              'MQ' => 'Martinique',
              'MR' => 'Mauritania',
              'MU' => 'Mauritius',
              'YT' => 'Mayotte',
              'MX' => 'Mexico',
              'FM' => 'Micronesia, Federated States Of',
              'MD' => 'Moldova',
              'MC' => 'Monaco',
              'MN' => 'Mongolia',
              'ME' => 'Montenegro',
              'MS' => 'Montserrat',
              'MA' => 'Morocco',
              'MZ' => 'Mozambique',
              'MM' => 'Myanmar',
              'NA' => 'Namibia',
              'NR' => 'Nauru',
              'NP' => 'Nepal',
              'NL' => 'Netherlands',
              'AN' => 'Netherlands Antilles',
              'NC' => 'New Caledonia',
              'NZ' => 'New Zealand',
              'NI' => 'Nicaragua',
              'NE' => 'Niger',
              'NG' => 'Nigeria',
              'NU' => 'Niue',
              'NF' => 'Norfolk Island',
              'MP' => 'Northern Mariana Islands',
              'NO' => 'Norway',
              'OM' => 'Oman',
              'PK' => 'Pakistan',
              'PW' => 'Palau',
              'PS' => 'Palestinian Territory, Occupied',
              'PA' => 'Panama',
              'PG' => 'Papua New Guinea',
              'PY' => 'Paraguay',
              'PE' => 'Peru',
              'PH' => 'Philippines',
              'PN' => 'Pitcairn',
              'PL' => 'Poland',
              'PT' => 'Portugal',
              'PR' => 'Puerto Rico',
              'QA' => 'Qatar',
              'RE' => 'Reunion',
              'RO' => 'Romania',
              'RU' => 'Russian Federation',
              'RW' => 'Rwanda',
              'BL' => 'Saint Barthelemy',
              'SH' => 'Saint Helena',
              'KN' => 'Saint Kitts And Nevis',
              'LC' => 'Saint Lucia',
              'MF' => 'Saint Martin',
              'PM' => 'Saint Pierre And Miquelon',
              'VC' => 'Saint Vincent And Grenadines',
              'WS' => 'Samoa',
              'SM' => 'San Marino',
              'ST' => 'Sao Tome And Principe',
              'SA' => 'Saudi Arabia',
              'SN' => 'Senegal',
              'RS' => 'Serbia',
              'SC' => 'Seychelles',
              'SL' => 'Sierra Leone',
              'SG' => 'Singapore',
              'SK' => 'Slovakia',
              'SI' => 'Slovenia',
              'SB' => 'Solomon Islands',
              'SO' => 'Somalia',
              'ZA' => 'South Africa',
              'GS' => 'South Georgia And Sandwich Isl.',
              'ES' => 'Spain',
              'LK' => 'Sri Lanka',
              'SD' => 'Sudan',
              'SR' => 'Suriname',
              'SJ' => 'Svalbard And Jan Mayen',
              'SZ' => 'Swaziland',
              'SE' => 'Sweden',
              'CH' => 'Switzerland',
              'SY' => 'Syrian Arab Republic',
              'TW' => 'Taiwan',
              'TJ' => 'Tajikistan',
              'TZ' => 'Tanzania',
              'TH' => 'Thailand',
              'TL' => 'Timor-Leste',
              'TG' => 'Togo',
              'TK' => 'Tokelau',
              'TO' => 'Tonga',
              'TT' => 'Trinidad And Tobago',
              'TN' => 'Tunisia',
              'TR' => 'Turkey',
              'TM' => 'Turkmenistan',
              'TC' => 'Turks And Caicos Islands',
              'TV' => 'Tuvalu',
              'UG' => 'Uganda',
              'UA' => 'Ukraine',
              'AE' => 'United Arab Emirates',
              'GB' => 'United Kingdom',
              'US' => 'United States',
              'UM' => 'United States Outlying Islands',
              'UY' => 'Uruguay',
              'UZ' => 'Uzbekistan',
              'VU' => 'Vanuatu',
              'VE' => 'Venezuela',
              'VN' => 'Viet Nam',
              'VG' => 'Virgin Islands, British',
              'VI' => 'Virgin Islands, U.S.',
              'WF' => 'Wallis And Futuna',
              'EH' => 'Western Sahara',
              'YE' => 'Yemen',
              'ZM' => 'Zambia',
              'ZW' => 'Zimbabwe',
            );
  }

  public function GetMonth(){
   return $months = array(
      '01' => 'Jan', 
      '02' => 'Feb', 
      '03' => 'Mar', 
      '04' => 'Apr', 
      '05' => 'May', 
      '06' => 'Jun', 
      '07' => 'Jul', 
      '08' => 'Aug', 
      '09' => 'Sep', 
      '10' => 'Oct', 
      '11' => 'Nov', 
      '12' => 'Dec'
    );
  }

  public function GetYear(){
   return $Year = array(
      '1' => '2018', 
      '2' => '2019', 
      '3' => '2020', 
      '4' => '2021', 
      '5' => '2022', 
      '6' => '2023', 
      '7' => '2024', 
      '8' => '2025', 
      '9' => '2026', 
      '10' => '2027', 
      '11' => '2028', 
      '12' => '2029',
      '13' => '2030',
      '14' => '2031',
      '15' => '2032',
      '16' => '2033',
      '17' => '2034',
      '18' => '2035',
      '19' => '2036',
      '20' => '2037',
      '21' => '2038',
      '22' => '2039',
      '23' => '2040',
      '24' => '2041',
      '25' => '2042',
      '26' => '2043',
      '27' => '2044',
      '28' => '2045',
      '29' => '2046',
      '30' => '2047',
      '31' => '2048',
      '32' => '2049',
      '33' => '2050'

    );
  }

}
