<script type="text/javascript" src="<?php echo e(url('/')); ?>/back/js/jquery-3.3.1.min.js"></script>

    <div id="mySidenav" class="side-navbar">
        <div class="logo text-center"><a href="https://4new.io/" target="_blank"><img src="<?php echo e(url('/')); ?>/back/images/4new-logo-white.png" /></a></div>
<br/>
<br/>
<div class="user-info media pl-3">
    <i class="fas fa-user mr-3"></i>
    <div class="media-body">
        <h4><?php echo e(ucwords(Sentinel::getUser()->fullname)); ?></h4>
        <p>KWATTS Balance = <?php echo e(Sentinel::getUser()->kwatt_balance); ?></p>
       <!--  <p>
        <?php if(Session::get('total_buy') !=0): ?>
        Kwatt Purchase = <?php echo e(number_format(Session::get('total_buy'), 2, '.', ',')); ?>

        <?php else: ?>
        Kwatt Purchase = 0.00
        <?php endif; ?>
        <br/>
        <?php if(Session::get('total_bonus') !=0): ?>
        Kwatt Bonus = <?php echo e(number_format(Session::get('total_bonus'), 2, '.', ',')); ?>

        <?php else: ?>
        Kwatt Bonus = 0.00
        <?php endif; ?>
        </p> -->
    </div>
</div>
        <ul class="nav flex-column sidebar-nav">


                <?php if ($user = Sentinel::getUser()) {
	if ($user->inRole('user')) {
		?>
    <li class="green kwatt-menu <?php echo e(Request::is('dashboard')?'active':''); ?>">
      <a  href="<?php echo e(url('/dashboard')); ?>"><i></i>Buy Kwatts</a></li>
      
       <li class="<?php echo e(Request::is('withdraw')?'active':''); ?>">
        <a href="<?php echo e(url('/withdraw')); ?>"><i class="fas fa-credit-card"></i>Withdraw Kwatts</a></li>
        <li class="<?php echo e(Request::is('user-transactions')?'active':''); ?>">
        <a href="<?php echo e(url('/user-transactions')); ?>"><i class="fa fa-exchange"></i>Transactions</a></li>
             <?php $ico_link = in_array(Request::path(), ['buy-coin', 'transfer', 'ico-info']);?>

            <?php $wallet_link = in_array(Request::path(), ['buy-coin-list', 'deposit-list', 'withdraw-list', 'transfer-list']);
		?>

             <li class="<?php echo e(Request::is('My-Order')?'active':''); ?>">
                <a href="<?php echo e(url('/My-Order')); ?>">
                  <i class="fas fa-cart-plus"></i>My Order
                </a>
              </li>
              <!--- - - - - - - - - - - - - Social Bounty - - - - - - - - - - - - - - - - -->
             <li class="<?php echo e(Request::is('user-promo')?'active':''); ?>">
              <a href="<?php echo e(url('/user-promo')); ?>"><i class="fas fa-tag"></i>Promotional Materials</a></li>
            <!--- - - - - - - - - - - - - User referal - - - - - - - - - - - - - - - - -->
            <li class="<?php echo e(Request::is('user-referral')?'active':''); ?>">
              <a href="<?php echo e(url('/user-referral')); ?>">
                <i class="fas fa-user-plus"></i>Affiliate Contest
              </a>
            </li>

             <!--- - - - - - - - - - - - - Settings - - - - - - - - - - - - - - - - -->
            <li class="<?php echo e(Request::is('contact-support')?'active':''); ?> nav-item">
                <a class="" href="https://www.4new.support/en/" target="_blank">
                    <i class="support"></i>Contact Support
                </a>
            </li>

             <?php $setting_link = in_array(Request::path(), ['user-profile', 'kyc', 'login-history', 'transfer-list']);?>


             <?php if(Sentinel::getUser()->kyc_status=='1'): ?>
             
              <li class="<?php echo e(Request::is('user-profile')?'active':''); ?> nav-item ">
                <a  href="<?php echo e(url('user-profile')); ?>"><i class="fa fa-user"></i>My Profile (KYC)</a>

              </li>
              <?php else: ?>
              <li class="<?php echo e(Request::is('user-kyc')?'active':''); ?> nav-item ">
                <a href="<?php echo e(url('user-kyc')); ?>"><i class="fa fa-user"></i>My Profile (KYC)</a>
              </li>
               <?php endif; ?>
              
                <!-- For Login histry -->
               <li class="<?php echo e(Request::is('login-history')?'active':''); ?> nav-item">
                    <a class="" href="<?php echo e(url('login-history')); ?>">
                     <i class="fas fa-history"></i>Login History
                    </a>
                </li>
                 <!-- For Login histry -->
               <li class="<?php echo e(Request::is('Watch-Kwatt-Live')?'active':''); ?> nav-item">
                    <a class="" href="<?php echo e(url('aff')); ?>?ref=<?php echo e(Sentinel::getuser()->ref_token); ?>&page=webinar" target="_blank">
                     <i class="fa fa-laptop" aria-hidden="true"></i>Live Webinar
                    </a>
                </li>

              <!-- For Sign Out  -->
            <li class="<?php echo e(Request::is('transfer-list')?'active':''); ?> nav-item">
                    <a class="" href="<?php echo e(url('/logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form-user').submit();">
                    <i class="fas fa-sign-out-alt"></i>Sign Out
            <form id="logout-form-user" action="<?php echo e(url('/logout')); ?>" method="POST">
                    <?php echo e(csrf_field()); ?>

            </form>
                    </a>

            </li>
            <!-- <li class="<?php echo e(Request::is('login-history')?'active':''); ?>"><a href="<?php echo e(url('login-history')); ?>"><i class="far fa-sign-in-alt"></i>Login History</a></li>

            <li class="<?php echo e(Request::is('kyc')?'active':''); ?>"><a href="<?php echo e(url('kyc')); ?>"><i class="fab fa-wpforms"></i>Kyc Form</a></li> -->

                           <?php } else if ($user->inRole('admin')) {?>

                              <li class="<?php echo e(Request::is('admin-dashboard')?'active':''); ?>"><a href="<?php echo e(url('/admin-dashboard')); ?>"><i class="fal fa-user-circle"></i>Dashboard</a></li>
                                <li class="<?php echo e(Request::is('admin-user-list')?'active':''); ?>"><a href="<?php echo e(url('admin-user-list')); ?>"><i class="fa fa-user"></i>Users</a></li>
                                <!-- <li class="<?php echo e(Request::is('admin-withdraw')?'active':''); ?>"><a href="<?php echo e(url('admin-withdraw')); ?>"><i class="fas fa-money-bill-alt"></i>Withdrawal Request</a></li> -->
                                <li class="<?php echo e(Request::is('admin-buy')?'active':''); ?>"><a href="<?php echo e(url('admin-buy')); ?>"><i class="fas fa-cart-plus"></i>Transactions</a></li>
                                

            <?php $transaction_link = in_array(Request::path(), ['admin-buy', 'admin-deposit', 'admin-withdraw', 'admin-transfer']);?>

                               <!--  <li class="submenu">
                                    <a href="#" class="<?php echo e($transaction_link==1?'nav-link dropdown-toggle collapsed':'nav-link dropdown-toggle'); ?>" href="#submenu1sub1" data-toggle="collapse" aria-expanded="<?php echo e($transaction_link==1?'true':'false'); ?>" data-target="#submenu1sub1"><i class="fas fa-cart-plus"></i>Transactions</a>
                                    <div class="collapse submenu-inner <?php echo e($transaction_link==1?'show':''); ?>" id="submenu1sub1" aria-expanded="<?php echo e($transaction_link==1?'true':'false'); ?>">
                                        <ul class="flex-column nav pl-5 p-2">
                                            <li class="nav-item <?php echo e(Request::is('admin-buy')?'active':''); ?>"> <a class="nav-link p-2" href="<?php echo e(url('admin-buy')); ?>"> <i class="fas fa-credit-card"></i> Buy Token  </a> </li>
                                            <li class="nav-item <?php echo e(Request::is('admin-deposit')?'active':''); ?>"><a class="nav-link p-2" href="<?php echo e(url('admin-deposit')); ?>"><i class="fas fa-shopping-basket"></i> Deposite </a> </li>
                                            <li class="nav-item <?php echo e(Request::is('admin-withdraw')?'active':''); ?>"> <a class="nav-link p-2" href="<?php echo e(url('admin-withdraw')); ?>"> <i class="fas fa-credit-card"></i> Withdrawal</a>  </li>
                                            <li class="nav-item <?php echo e(Request::is('admin-transfer')?'active':''); ?>"> <a class="nav-link p-2" href="<?php echo e(url('admin-transfer')); ?>"><i class="fa fa-fw fa-compass"></i> Transfer Token</a> </li>
                                        </ul>
                                    </div>
                                </li> -->

                                <li class="<?php echo e(Request::is('ico_setting')?'active':''); ?>"><a href="<?php echo e(url('/ico_setting')); ?>"><i class="fas fa-cogs"></i>ICO Settings</a></li>
                                <li class="<?php echo e(Request::is('rate')?'active':''); ?>"><a href="<?php echo e(url('/rate')); ?>"><i class="fas fa-wrench"></i>Rates Settings</a></li>

                                <li class="<?php echo e(Request::is('kyc')?'active':''); ?>"><a href="<?php echo e(url('/kyc')); ?>"><i class="fas fa-file"></i>Users KYC</a></li>
                                <!-- <li class="<?php echo e(Request::is('admin-bounty')?'active':''); ?>"><a href="<?php echo e(url('admin-bounty')); ?>"><i class="fas fa-user"></i>User's Bounty</a></li> -->
                                <li class="<?php echo e(Request::is('transfer-list')?'active':''); ?> nav-item">
                    <a class="" href="<?php echo e(url('/logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form-user').submit();">
                    <i class="fa fa-fw fa-compass"></i>Sign Out
            <form id="logout-form-user" action="<?php echo e(url('/logout')); ?>" method="POST">
                    <?php echo e(csrf_field()); ?>

            </form>
                    </a>

            </li>
                                

                         <?php } else {?>

                         <?php }}?>
        </ul>

        <!--<div class="guide-btn user-info"> <button id="otpToggleButton" class="btn btn-primary btn-sm">Enable Two Factor auth</button> -->


        <div class="enable-auth text-center">

        <?php if(Sentinel::getUser()->google2fa_enable): ?>
          <button id="otpDisableToggleButton"  class="btn btn-warning btn-sm">Disable 2FA</button>
        <?php else: ?>
          <button id="otpToggleButton" class="btn btn-primary btn-sm">Enable Two Factor auth</button>
        <?php endif; ?>
        </div>
        </div>

    </div>
    <!-- begin:: Page -->
    <div class="page">
        <nav class="navbar navbar-expand-lg navbar-light bg-dark justify-content-between">

                <div><a class="navbar-brand hamburger-menu" id="toggle-btn" href="javascript:void(0);"><i class="fas fa-bars"></i></a></div>

               <div><a href="<?php echo e(url('/dashboard')); ?>"><h3 class="mb-3 mt-3 header-text" >BUY KWATTS NOW TO EARN 30% MATCHING BONUS </h3></a></div>
                    <!-- <ul class="navbar-nav center-nav">
                        <li>
                            1Kwatt ≈ <?php echo e(number_format($c_rate,2)); ?> USD |
                            1BTC ≈ <?php echo e(number_format($c_btc,2)); ?> USD |
                            1ETH ≈<?php echo e(number_format($c_eth,2)); ?> USD |
                            1LTC ≈ <?php echo e(number_format($c_ltc,2)); ?> USD |
                            1BCH ≈ <?php echo e(number_format($c_bch,2)); ?> USD
                        </li>
                    </ul> -->
                <!-- For Google translator -->
                <div class="profile_right">
                  <div id="google_translate_element" align="center" class="tests"></div>
                </div>
        </nav>
        <script type="text/javascript">

      $(document).ready(function()
      {
          $('#ico-table').DataTable({
              responsive: true,
              language: {
                  search: '_INPUT_',
                  searchPlaceholder: "Search records"
              }
          });


          $('#ico-table-two').DataTable({
              responsive: true,
              language: {
                  search: '_INPUT_',
                  searchPlaceholder: "Search records"
              }
          });


      });
    </script>
    <script type="application/javascript" >
      $('#otpToggleButton').on('click', function () {
        "<?php echo e(session()->put('2fa:user:id', Sentinel::getUser()->id)); ?>"
        $("#enable-2fa").prop('disabled', true);
        $("#match-otp-2fa_enable").show();
        $.ajax({
          type: 'get',
          url:"<?php echo e(url('2fa/enable')); ?>",
          success: function (responseData) {
           // console.log(responseData);
            $('.qrcode').empty();
            $('.secret').empty();
            //$('.qrcode').append('<img src="'https://chart.googleapis.com/', 'chart', 'chs='.$size.'x'.$size.'&chld=M|0&cht=qr&chl="+responseData['imgurl']+'">');
            $(".qrcode").append('<img src="https://chart.googleapis.com/chart?chs=200x200&&chld=M|0&cht=qr&chl='+responseData['imgurl']+'">');
            $('.secret').text(responseData['secret']);
            $('#secret').val(responseData['secret']);
          },
          error: function (responseData) {
            console.log(responseData);
            return false;
          }
        });
        $('#qrModal').modal('show');
      });

      $('#otpDisableToggleButton').on('click', function () {
        <?php Session::forget('2fa:user:id');?>
                "<?php echo e(session()->put('2fa:user:id', Sentinel::getUser()->id)); ?>"
        $("#disable-2fa").prop('disabled', true);
        $("#google_auth_msg").html('');
        $("#match-otp-2fa").show();
        $('#qrmatch').modal('show');
      });

      $('#submitGauth').on('click', function () {
        var code = $('#otpCode').val();
        var token = $('#token').val();
        $.ajax({
          type: 'post',
          url:"<?php echo e(url('2fa/validate')); ?>",
          data: "code="+code+'&_token='+token,
          success: function (responseData) {
            console.log(responseData);
          },
          error: function (responseData) {
            console.log(responseData);
            return false;
          }
        });
        $('#qrModal').modal('show');
      })

      function checkOTP()
      {
        $("#google_auth_msg").html('');
        var token = $('#token_dis').val();
        var code= $("#google_2fa_otp").val();
        if(code.length == 6)
        {
          $.ajax({
            type: 'post',
            url:"<?php echo e(url('2fa/validate-disabletime')); ?>",
            data: "totp="+code+'&_token='+token,
            success: function (responseData) {
              console.log(responseData);
              if(responseData==1)
              {
                $("#match-otp-2fa").hide();
                $("#google_auth_msg").html("<div class='alert alert-success'>OTP match successfully</div>");
                $("#google_2fa_otp").val('');
                $("#disable-2fa").prop('disabled', false);
              }
            },
            error: function (responseData) {
              $("#google_auth_msg").html("<div class='alert alert-danger'>Nice try but OTP not match, Please try again.</div>");
              console.log(responseData);
              return false;
            }
          });
        }
      }

      function checkOTPEnable()
      {
        $("#alert-msg-enable").html('');

        var code= $("#google_2fa_otp_enable").val();
        var token = "<?php echo e(csrf_token()); ?>";
        console.log(token);
        console.log(code);
        //var datajson='{totp:code,_token:token}';
        if(code.length == 6)
        {

          $.ajax({
            type: 'post',
            url:"<?php echo e(url('2fa/validate-enabletime')); ?>",
            data: "totp="+code+"&_token="+token,
            success: function (responseData) {
              console.log(responseData);
              if(responseData==1)
              {
                $("#match-otp-2fa_enable").hide();
                $("#alert-msg-enable").html("<div class='alert alert-success'>OTP match successfully</div>");
                $("#google_2fa_otp_enable").val('');
                $("#enable-2fa").prop('disabled', false);
              }
            },
            error: function (responseData) {
              $("#alert-msg-enable").html("<div class='alert alert-danger'>Nice try but OTP not match, Please try again.</div>");
              console.log(responseData);
              return false;
            }
          });
        }
        else {
            $("#alert-msg-enable").html("<div class='alert alert-danger'>Enter 6 digit only, Please try again.</div>");
            //console.log(responseData);
            return false;

        }A
      }
    </script>


<style type="text/css">
    .goog-te-banner-frame.skiptranslate {
    display: none !important;
    }
    body {
    top: 0px !important;
    }
    .goog-logo-link {
    display:none !important;
    }
    .goog-te-gadget{
    color: transparent !important;
    }
    #google_translate_element
    {
      margin-bottom: -25px;
    }

</style>
<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
}
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

