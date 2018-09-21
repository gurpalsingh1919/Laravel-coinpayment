<?php

Sentinel::disableCheckpoints();
Route::get('/',['as' =>'home','uses' => 'LoginController@login'] );

/* ==============================================  Authentication Section =========================================== */
Route::get('login', 'LoginController@login');
Route::get('register', 'RegisterController@register');

Route::get('signup', 'RegisterController@airdrop_sign_up');
Route::get('signup1', 'RegisterController@second_airdrop_sign_up');

Route::post('/register',['as' =>'register','uses' =>  'RegisterController@registerPost'] );
Route::post('/login',['as' =>'login','uses' =>  'LoginController@loginPost'] );

//Activation Check From Mail
Route::get("activate/{email}/{activationCode}", 'ActivationController@activate');

//Resend Activation code
Route::post("activationresend", 'RegisterController@resendactivation');

//Forgot password Full Procedure
Route::get('forgot-password', 'ForgotController@forgotPassword');
Route::post('forgot-password', 'ForgotController@postForgotPassword');
Route::get("reset/{email}/{resetCode}",'ForgotController@resetPassword');
Route::post("reset/{email}/{resetCode}",'ForgotController@postResetPassword');
Route::post("reset/reset-password",'ForgotController@postNewResetPassword');
Route::post("logout", 'LoginController@logout');
Route::get('aff', 'RegisterController@refferalcode');
Route::get('most-affiliate', 'UserController@topAffiliateUsers');
Route::get('live-webinar', 'WebinarController@newliveWebinar');
//Call referal
//Route::get('ref/{refid}', 'RegisterController@referral');


/*    ================================================ User Section ===============================================*/

Route::group(['middleware'=>'user'], function()
{
    Route::get('Watch-Kwatt-Live', 'WebinarController@liveWebinar');
    Route::get('dashboard',['as' =>'dashboard','uses' =>  'UserController@dashboard']);

    //Wallet
    Route::get('wallet', 'WalletController@index'); 
     
     //refferal
     Route::get('user-referral', 'UserController@refferal');
     

    Route::get('kyc', 'UserController@kyc_form');
    Route::post('user-kyc-upload', 'UserController@upload_kyc');

      Route::post('user_kyc_reg',['uses' =>  'ProfileController@kyc_verify'] );

     Route::get('user-profile',['uses' =>  'ProfileController@index'] );
     Route::post('user-profile',['uses' =>  'ProfileController@profile_update'] );
     Route::get('user-change-password', ['uses' =>'ProfileController@showChangePasswordForm']);
     Route::post('user-password-updated', ['uses' => 'ProfileController@password_update']);

     //Deposit Full
     Route::get('deposit/{coin}', 'WalletController@deposit');
     Route::post('get_live_value', 'WalletController@get_live_value');
     Route::post('get_live_value1', 'WalletController@get_live_value1');
     Route::post('get_deposit', 'PaymentController@get_deposit');

     //Withraw Full
     Route::get('withdraw', 'WalletController@withdraw');
     Route::post('withdraw-post', 'WalletController@withdraw_add');

     Route::get('login-history', 'UserController@history');

     //transfer
     Route::get('transfer', 'WalletController@transfer');
     Route::post('check_username', 'WalletController@check_username');
     Route::post('add_transfer', 'WalletController@add_transfer');

     //Buy Coin
      Route::get('buy-coin', 'WalletController@buy');
      Route::post('store-ico', 'WalletController@store_ico');

     //Bounty
      Route::get('bounty', 'WalletController@bounty');
      Route::get('screen-upload/{serv}', 'BountyController@screen_upload');
      Route::post('screen_upload', 'BountyController@upload_screen1');
      Route::get('del_bounty/{id}', 'BountyController@del_bounty');

      //Transaction history
      Route::get('buy-coin-list', 'WalletController@buy_coin');
      Route::get('deposit-list', 'WalletController@deposit_list');
      Route::get('withdraw-list', 'WalletController@withdraw_list');
      Route::get('transfer-list', 'WalletController@transfer_list');

      Route::post('get_bonus', 'WalletController@get_bonus');
      Route::get('ico-info', 'WalletController@ico_info');

      //Paypal
      Route::get('add-money', 'PaypalController@add_money')->name('paywithpaypal');
      Route::post('postpaypal', 'PaypalController@postPaymentWithpaypal');
      //Route::post('postpaypal', 'PaypalController@postPaymentWithpaypal')->name('postpaypal');
      Route::get('getpaypalstatus', 'PaypalController@getPaymentStatus')->name('getpaypalstatus');

      Route::get('contact-support', 'UserController@contact_support')->name('contact_support');
      Route::get('invite-friend', 'UserController@invite_fds')->name('invite_fd');
      Route::post('postinvites', 'UserController@postInviteFds')->name('postinvites');

      Route::post('kwattbuywithcrypto', 'WalletController@buyKwattWithCriptocurrencies');
      Route::get('affiliate-user', 'UserController@affiliate_fds');

      Route::get('Pending-transaction', 'MailController@transactionPending');
      Route::post('refferfriend', 'UserController@postRefferFriends');
      Route::post('updateWalletAddresses', 'WalletController@addWalletAddress');
      Route::get('My-Order', 'WalletController@yourOrderDetails');
      Route::get('user-transactions', 'WalletController@userAllTransactionsHistory');
      Route::get('user-promo', 'UserController@promotionalMaterials');
      Route::get('user-kyc', 'ProfileController@completedYourKyc');

      Route::post('credit-card-payment', 'PaypalController@postPayWithCreditCard');
      Route::get('credit-card-payment', 'PaypalController@postPayWithCreditCard');

      Route::post('master-card-payment', 'PaymentController@postPayWithMasterCard');
      Route::get('master-card-payment', 'PaymentController@postPayWithMasterCard');

      Route::post('pay-with-master-card', 'PaymentController@payWithMyMastercard');
      Route::get('pay-with-master-card', 'PaymentController@payWithMyMastercard');

      Route::get('master-card-return-url', 'PaymentController@mastercardreturn_url');
      Route::post('master-card-return-url', 'PaymentController@mastercardreturn_url');


});

  Route::get('payment-callback-url', 'PaypalController@payment_redirect_url'); 

  Route::get('test-approved-kyc-info', 'kycController@getApprovedKycInfo'); 
       

/*    ================================================ Admin Section ===============================================*/

Route::group(['middleware'=>'admin'], function()
{

    //Route::get('dashboard',['as' =>'dashboard','uses' =>  'UserController@dashboard']);

    //Route::get('admin-dashboard',['as' =>'dashboard','uses' =>  'UserController@dashboard']);

    Route::get('admin-dashboard',['uses' =>  'AdminController@adminDashboard']);


    Route::get('profile',['uses' =>  'ProfileController@index'] );
     Route::post('profile',['uses' =>  'ProfileController@profile_update'] );
     Route::get('change-password', ['uses' =>'ProfileController@showChangePasswordForm']);
     Route::post('/password-updated', ['uses' => 'ProfileController@password_update']);
     

   // Route::get('ico_setting',['uses' =>  'SettingController@index'] );
    Route::get('ico_setting',['uses' =>  'SettingController@index'] );
    Route::get('ico-edit', 'SettingController@ico_edit');
    Route::get('ico-add', 'SettingController@addNewIco');
    // Route::post('ico-add', 'SettingController@addNewIco');
    Route::post('posticoadd', 'SettingController@postAddIcoAmount');
    Route::post('posttokenamount', 'SettingController@postupdatetokenAmount');
    Route::get('kwatt-ledger', 'SettingController@allkwattLedger');


    Route::post('ico-update', 'SettingController@ico_update');

    Route::get('rate',['uses' =>  'SettingController@rate_index'] );
    Route::get('rate-add', 'SettingController@rate_add');
    Route::POST('rate-add', 'SettingController@rate_create');
    Route::get('rate-edit/{id}', 'SettingController@rate_edit');
    Route::get('rate-delete/{id}', 'SettingController@rate_delete');
    Route::get('rate-active/{id}', 'SettingController@rate_active');
    Route::get('rate-cron', 'SettingController@rate_active_cron');
    Route::post('rate-update', 'SettingController@rate_update');

    Route::get('admin-user-list',['uses' =>  'AdminController@userlist'] );

    Route::get('kyc',['uses' =>  'AdminController@kyc'] );
    Route::get('kyc_details/{id}',['uses' =>  'AdminController@kyc_details'] );

    Route::get('admin-user-list-status/{id}/{code}',['uses' =>  'AdminController@userliststatus'] );

    //Setting Tab
     Route::get('admin-setting',['uses' =>  'AdminController@setting_index'] );
     Route::post('admin-storeSetting',['uses' =>  'AdminController@setting_edit'] );

     //Phase Setting 
     Route::get('admin-phase',['uses' =>  'AdminController@phase_index'] );
     Route::get('phase-edit/{id}',['uses' =>  'AdminController@phase_edit_index'] );
     Route::get('phase-add',['uses' =>  'AdminController@phase_add_index'] );
     Route::post('admin-add-phase',['uses' =>  'AdminController@phase_add'] );
     Route::get('phase-delete/{id}',['uses' =>  'AdminController@phase_delete'] );
     Route::post('admin-edit-phase',['uses' =>  'AdminController@phase_edit'] );

    //admin User's     
     Route::get('user-block/{id}',['uses' =>  'AdminController@user_block'] );
     Route::get('user-active/{id}',['uses' =>  'AdminController@user_active'] );
     Route::get('user-delete/{id}',['uses' =>  'AdminController@user_delete'] );

   
     //transaction
      Route::get('admin-buy', ['uses' =>  'AdminController@buy_index']);
      Route::get('admin-deposit', ['uses' =>  'AdminController@deposit_index']);
      Route::get('admin-withdraw', ['uses' =>  'AdminController@withdraw_index']);
      Route::get('admin-transfer', ['uses' =>  'AdminController@transfer_index']);
     

     Route::get('admin-kyc/{id}', ['uses' =>  'AdminController@index_kyc']);
     Route::get('kyc-accept/{id}',['uses' =>  'AdminController@kyc_accept'] );
     Route::get('kyc-no-accept/{id}',['uses' =>  'AdminController@kyc_no_accept'] );

    //Admin Bounty
    Route::get('admin-bounty', 'AdminBountyController@index');
    Route::get('bounty_show/{id}', 'AdminBountyController@bounty_show');
    Route::post('ref-data', 'AdminBountyController@ref_data');
    Route::post('give_to_user', 'AdminBountyController@give_to_user');
    Route::get('bounty_reject/{id}', 'AdminBountyController@bounty_reject');

    Route::get('withdraw-accept/{id}', 'WalletController@withdraw_accept');
    Route::get('withdraw-reject/{id}', 'WalletController@withdraw_reject');
    Route::post('accept-payment', 'AdminController@userPaymentAccepted');

});


/*--------------------------------Google 2FA Section---------------------------------*/

Route::get('/2fa/enable', 'Google2FAController@enableTwoFactor');
Route::post('/2fa/save', 'Google2FAController@saveSecretKey');
Route::get('/2fa/disable', 'Google2FAController@disableTwoFactor');
Route::get('/2fa/validate', 'Auth\AuthController@getValidateToken');
Route::post('/2fa/validate', ['middleware' => 'throttle:5', 'uses' => 'Auth\AuthController@postValidateToken']);
Route::post('/2fa/validate-disabletime', ['middleware' => 'throttle:5', 'uses' => 'Auth\AuthController@postValidateTokenDesable']);
Route::post('2fa/validate-enabletime', ['middleware' => 'throttle:5', 'uses' => 'Auth\AuthController@postValidateTokenenable']);


/*--------------------------------Payment Coinpayment End ---------------------------*/

  Route::get('ipn-handler', 'PaymentController@IpnHandler');
  Route::post('ipn-handler', 'PaymentController@IpnHandler');

 /*************** Ocular Kyc IPN Handler ****************************/
  Route::get('kyc-ipn-hander', 'kycController@kycHandler'); 
  Route::post('kyc-ipn-hander', 'kycController@kycHandler'); 
   /***************Sum&Sub Kyc IPN Handler ****************************/
  Route::get('user-kyc-hander', 'kycController@sumSubKycHandler'); 
  Route::post('user-kyc-hander', 'kycController@sumSubKycHandler'); 
/**************** Paypal IPN Handler **************************/

  Route::get('paypalIpnHandler', 'PaypalController@paypalIpnResonseListner');
  Route::post('paypalIpnHandler', 'PaypalController@paypalIpnResonseListner');

  /****************  payment tracking listner **************************/

  Route::get('tracking-listner', 'PaypalController@trackYourUser');
  Route::post('tracking-listner', 'PaypalController@trackYourUser');

  /****************  Sale confirm listner **************************/

  Route::get('sale-confirm', 'PaypalController@sale_confirm');
  Route::post('sale-confirm', 'PaypalController@sale_confirm');

  /**************** An-other payment gateway **************************/

  Route::get('AnOtherIpnHandler', 'PaypalController@payment_notification_url');
  Route::post('AnOtherIpnHandler', 'PaypalController@payment_notification_url');
  //Route::post('paypalIpnHandler', 'PaypalController@paypalIpnResonseListner');


//Bounty
Route::get('/redirect/{service}', 'SocialAuthController@redirect');
Route::get('/callback/{service}', 'SocialAuthController@callback');
Route::get('/go_to/{service}', 'SocialAuthController@goto_ser');


Route::get('/getAllUsers', 'UserController@showAllUsersInfo');

