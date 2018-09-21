 
<!-- head -->
<?php $__env->startSection('title'); ?>
    Kwatt | Login
<?php $__env->stopSection(); ?>
<!-- title -->

<?php $__env->startSection('content'); ?>

    <!-- BEGIN: Header -->
    <div class="outer-login newregister_container">
        <div class="center-h">
            <div class="card">
                <div class="login-screen newregister_wrap">
                    <?php if(session('error')): ?>
                        <div class="alert alert-danger alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Error : </strong>   <?php echo e(session('error')); ?>

                        </div>
                    <?php endif; ?>

                    <?php if(session('success')): ?>
                        <div class="alert alert-success alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Success : </strong>   <?php echo e(session('success')); ?>

                        </div>
                    <?php endif; ?>
                  <!--   <div class="text-center left-login">
                        <img class="img-fluid mt-4 main-logo-login" src="<?php echo e(asset('assets/images/logo.png')); ?>" />
                        <p>Register to manage your 4New account and wallet. You can deposit funds for the pre-listing sale, access your referral code, complete KYC, and more.</p>
                        <br/>
                        <a href="<?php echo e(url('login')); ?>" class="btn btn-default">Signin Now</a>
                        <div class="hidden-md hidden-xs">
                            <br/>
                            <br/>
                        </div>
                    </div> -->



                <!--begin::Portlet-->
                    <div class="right-login register_update">
                        <span class="rgister_logo"><img class="img-fluid mt-4 main-logo-login" src="<?php echo e(asset('assets/images/logo.png')); ?>" /></span>
                        <h3 class="form-title text-center">
                            Complete Your Registration To Join The Crowdsale
                        </h3>

                        <!--begin::Form-->
                        <form id="register-form" action="<?php echo e(url('register')); ?>" method="post" class="tab-content active">
                            <?php echo e(csrf_field()); ?>


                             <div class="form-group form-row">
                                <div class="col-sm-12">
                                <input type="email" id="user_email" class="form-control" placeholder="Email" name="email" value="<?php echo e($email); ?>">
                                <span class=" text-danger invalid-feedback"><?php echo e($errors->first('email')); ?></span>
                                <br/>
                            </div>
                            </div>
                            <div class="form-group form-row">
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" placeholder="First Name" id="first_name" name="first_name" value="<?php echo e(old('first_name')); ?>">
                                    <span class=" text-danger invalid-feedback"><?php echo e($errors->first('first_name')); ?></span>
                                    <br/>
                                </div>

                                <div class="col-sm-6">
                                    <input type="text" class="form-control" placeholder="Last Name" name="last_name"  value="<?php echo e(old('last_name')); ?>">
                                    <span class=" text-danger invalid-feedback"><?php echo e($errors->first('last_name')); ?></span>
                                    <br/>
                                </div>
                            </div>

                           

                            <div class="form-group form-row">
                                <div class="col-sm-6">
                                    <input type="password" class="form-control" placeholder="Password" name="password">
                                     <span class=" text-danger invalid-feedback"><?php echo e($errors->first('password')); ?></span>
                                     <br/>
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control" placeholder="Retype Password" name="password1">
                                     <span class=" text-danger invalid-feedback"><?php echo e($errors->first('password1')); ?></span>
                                     <br/>
                                </div>
                            </div>
                             <div class="form-group mb-5  row justify-content-between"> 
                              <div class="col-md-12">
                                <div class="form-check">
                                <input class="form-check-input" name="terms_and_Condition" value="1" type="checkbox" id="gridCheck1" checked="checked">
                                <label class="form-check-label" for="gridCheck1">
                                   Agree with the <a href="https://4new.io/terms-and-conditions" target="_blank">terms and conditions</a>
                                </label><br/>
                                 <span class=" text-danger invalid-feedback"><?php echo e($errors->first('terms_and_Condition')); ?></span>
                              </div>
                              </div>
                             <!--  <div class="col-md-6 text-right">
                                <a href="<?php echo e(url('forgot-password')); ?>">Forgot your password ?</a>
                              </div> -->
                            </div> 
                            <!--  <div class="form-group form-row">
                              
                                <div class="col-sm-12" >
                                  
                                   <input type="checkbox" class="form-control" name="terms_and_Condition" value="1" />Agree with the <a href="https://4new.io/terms-and-conditions" target="_blank">terms and conditions</a>
                                 
                                  <span class=" text-danger invalid-feedback"><?php echo e($errors->first('terms_and_Condition')); ?></span>
                                </div>
                            </div>
 -->
                            <div class="text-center" id="register_div1">
                                <button type="submit" onclick="register_click()" class="btn btn-login text-center">Register Now</button>
                            </div>

                            <div class="text-center" id="loader_div1" style="display: none;">
                                <img src="<?php echo e(url('/')); ?>/upload/third.gif" style="height: 70px;width: 70px;">
                            </div>

                            <div class="row mt-5 text-center">
                                <div class="col-sm-12">
                                    Already have an account?  <a href="<?php echo e(url('login')); ?>" class="p-0 m-0">Log In</a>
                                </div>

                            </div>
                        </form>
                    </div>
                    <!--end::Portlet-->
                </div>
            </div>
        </div>
    </div>
    <!-- end:: Page -->
    <?php $__env->stopSection(); ?>
<script type="text/javascript" src="<?php echo e(url('/')); ?>/back/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
//var user_email=document.getElementById('user_email').value;

//console.log(user_email);
if( $( "#user_email" ).val() !='')
{
     $( "#first_name" ).focus();
}
else
{
    $( "#user_email" ).focus();
}

});
</script>
<script type="text/javascript">
    adroll_adv_id = "QOHR7OQF4ZCBRJ7DLOTYSM";
    adroll_pix_id = "E5JRH5GLFZD4BG24GTWHV5";
    /* OPTIONAL: provide email to improve user identification */
    /* adroll_email = "username@example.com"; */
    (function () {
        var _onload = function(){
            if (document.readyState && !/loaded|complete/.test(document.readyState)){setTimeout(_onload, 10);return}
            if (!window.__adroll_loaded){__adroll_loaded=true;setTimeout(_onload, 50);return}
            var scr = document.createElement("script");
            var host = (("https:" == document.location.protocol) ? "https://s.adroll.com" : "http://a.adroll.com");
            scr.setAttribute('async', 'true');
            scr.type = "text/javascript";
            scr.src = host + "/j/roundtrip.js";
            ((document.getElementsByTagName('head') || [null])[0] ||
                document.getElementsByTagName('script')[0].parentNode).appendChild(scr);
        };
        if (window.addEventListener) {window.addEventListener('load', _onload, false);}
        else {window.attachEvent('onload', _onload)}
    }());

function register_click()
{
    
    var ipaddress = "<?php echo $_SERVER['REMOTE_ADDR']; ?>";
    console.log(ipaddress);
    adroll_custom_data = {'order_id': 'website_variable_here'}
}



//console.log(adroll_custom_data);

</script>
<?php echo $__env->make('auth.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>