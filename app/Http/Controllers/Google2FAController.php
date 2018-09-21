<?php 

namespace App\Http\Controllers;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Crypt;
use Google2FA;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use \ParagonIE\ConstantTime\Base32;

class Google2FAController extends Controller
{
    //use ValidatesRequests;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('web');
    }

    public function securityPage()
    {
        return view('user.security');
    }
    public function enableTwoFactor(Request $request)
    {
        //generate new secret
        $secret = $this->generateSecret(); 

        //get user
        $user = Sentinel::getUser();
        $user->google2fa_secret = Crypt::encrypt($secret); 
        $user->save();

        //generate image for QR barcode
        // $imageDataUri = Google2FA::getQRCodeInline(
        //     'Kwatt',
        //     $user->email,
        //     $secret,
        //     200
        // );

        $url = $this->getQRCodeUrl('4New', $user->email, $secret);

        $url = $this->generateGoogleQRCodeUrl('https://chart.googleapis.com/', 'chart', 'chs=200x200&chld=M|0&cht=qr&chl=', $url);

        return $data = array('secret' => $secret, 'imgurl' => $url); 
    }

    public function getQRCodeUrl($company, $holder, $secret)
    {
        return 'otpauth://totp/'.rawurlencode($company).':'.rawurlencode($holder).'?secret='.$secret.'&issuer='.rawurlencode($company).'';
    }

    public function generateGoogleQRCodeUrl($domain, $page, $queryParameters, $qrCodeUrl)
    {
        $url = $domain.
                rawurlencode($page).
                '?'.$queryParameters.
                urlencode($qrCodeUrl);

        return $url;
    }

    public function saveSecretKey(Request $request)
    {
        $user = Sentinel::getUser();
        $user->google2fa_enable = 1;
        $user->save();
        return redirect()->back();
    }
    /**
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function disableTwoFactor(Request $request)
    {

     
           $user = $request->user();
            //make secret column blank
            $user->google2fa_secret = null;
             $user->google2fa_enable = 0;
            $user->save();

            return redirect()->back();  
       
        //return view('2fa/disableTwoFactor');
    }

    /**
     * Generate a secret key in Base32 format
     *
     * @return string
     */
    private function generateSecret()
    {
       $randomBytes = random_bytes(10);
        return Base32::encodeUpper($randomBytes);

    }
}