<?php $__env->startSection('title'); ?> Affiliates <?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<style type="text/css">
    .bs-example{
      margin: 20px;
    }
    .modal-content iframe{
        margin: 0 auto;
        display: block;
    }
</style>

<script type="text/javascript" src="<?php echo e(url('/')); ?>/back/js/jquery.countdownTimer.js"></script>
<script type="text/javascript" src="<?php echo e(url('/')); ?>/back/js/jquery.fireworks.js"></script>
<script type="text/javascript" src="<?php echo e(url('/')); ?>/back/js/video_aff.js"></script>
<!-- <script type="text/javascript" src="<?php echo e(url('/')); ?>/back/js/watch_video.js"></script> -->

    <meta charset="utf-8">
<!-- <link rel="stylesheet" type="text/css" href="<?php echo e(url('/')); ?>/back/css/jquery.countdownTimer.css" /> -->
<!-- <script src="<?php echo e(url('/')); ?>/back/js/ServerDate.js"></script> -->


<div class="container-fluid affiliate_wrap">
   <div class="col">
     <br/>
    <div class="row">

   <!--    <div class="col-lg-12 mb-5">
          <div class="card">
            <div class="card-body p-5 text-center welcome-affiliate">
              <h4 class="mb-4"><strong class="text-uppercase">Welcome to the Affiliate section of the 4NEW website.</strong></h4>
              Below you will find a number of promotional tools to help you leverage the <strong class="">MATCHING BONUSES</strong> for the next few weeks to start earning
              <strong class="">BONUS KWATT TOKENS!</strong><br/>
              For Affiliate Contest Details <a href="<?php echo e(url('/user-referral')); ?>"><strong>CLICK HERE</strong></a>.
              <br/>
              <br/>
              <h5 class="text-success">Prizes include a 2018 BMW i8, a Gold Breitling Bentley Watch, or a tropical cruise.</h5>

            </div>
          </div>
      </div> -->

         <div class="col-lg-12">
         <div class="card mb-4">
      <div class="card-header">
        <h5 class="text-uppercase text-center mb-0">REFER A FRIEND & EARN 50% MATCHING BONUS ON KWATTS PURCHASED</h5>
      </div>
      <div class="card-body no-padding mt-4 mb-3" >
        <div class="col">
          <div class="d-flex justify-content-center row">
            <div class="col-lg-5">
                  <div class="cardcustombordr mb-2">
                    <div class="card-body mt-4 pr-3 pl-3 pt-1 pb-4">
                      <h5 class="text-center text-uppercase">Social Media Sharing</h5>
                      <p>Simply click the social media icon below and instantly share the 4NEW story</p>
                      <div class="social-ics shar-icons">
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(url('aff')); ?>?ref=<?php echo e(Sentinel::getuser()->ref_token); ?>" class="fab fa-facebook-f" data-href="<?php echo e(url('aff')); ?>?ref=<?php echo e(Sentinel::getuser()->ref_token); ?>" target="_blank"></a>



                        <a href="http://twitter.com/share?text=Help Save The Planet With KWATT Tokenized Electricity.  4NEW is the World's first company to use waste to create energy to power Crypto-Mining.  Patent Pending process!
Graphic should be the Help Save The Planet banner&amp;url=<?php echo e(url('aff')); ?>?ref=<?php echo e(Sentinel::getuser()->ref_token); ?>" class="fab fa-twitter" target="_blank"></a>
                        
                        <a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo e(url('aff')); ?>?ref=<?php echo e(Sentinel::getuser()->ref_token); ?>&amp;title=Help Save The Planet With KWATT Tokenized Electricity.  4NEW is the World's first company to use waste to create energy to power Crypto-Mining.  Patent Pending process! Graphic should be the Help Save The Planet banner" class="fab fa-linkedin-in" target="_blank"></a>
                        
                        <a href="https://t.me/FRNCoin" class="fab fa-telegram-plane" target="_blank"></a>
                        <!-- <a href="https://medium.com/@4newcoin" class="fab fa-medium-m" target="_blank"></a> -->
                      </div>
                    </div>
                  </div>
            </div>
 <div class="col-lg-7">
               <div class="">
                <div class="card-body pt-3 pr-3 pl-3 pb-0 cardcustombordr text-left mb-2">
                  <h5 class="text-uppercase pb-3">HERE ARE YOUR AFFILIATE CODES TO START PROMOTING!</h5>
                  <div class="row">
                    <br/>
                  <div class="col-lg-12">
                    <!-- <h2 style="color:#7dc242"><?php echo e(Sentinel::getuser()->ref_token); ?></h2> -->
                    <label>4NEW Main Website :</label>

                    <form class="form-copy theme-form">
                      <div class="input-group">
                        <input type="text" class="form-control" id="post-sharelink" value="<?php echo e(url('aff')); ?>?ref=<?php echo e(Sentinel::getuser()->ref_token); ?>&page=home">
                          <span class="input-group-btn">
                            <button class="btn btn-secondary" id="copy-button" data-clipboard-target="#post-sharelink" type="button" onclick="copyreferrallink()" >copy</button>
                          </span>
                        </div>
                      </form>
                    </div>
                     <div class="col-lg-12">
                    <!-- <h5 class="text-center text-uppercase">YOUR REFERRAL CODE IS:</h5> -->
                    <!-- <h2 style="color:#7dc242"><?php echo e(Sentinel::getuser()->ref_token); ?></h2> -->
                    <label>4NEW Power Explosion Affiliate Contest:</label>
                    <form class="form-copy theme-form">
                      <div class="input-group">
                        <input type="text" class="form-control" id="post-sharelink-affiliate" value="<?php echo e(url('aff')); ?>?ref=<?php echo e(Sentinel::getuser()->ref_token); ?>&page=affiliate">
                          <span class="input-group-btn">
                            <button class="btn btn-secondary" id="copy-button" data-clipboard-target="#post-sharelink-affiliate" type="button" onclick="copyreferrallink2()" >copy</button>
                          </span>
                        </div>
                      </form>
                    </div>
                    </div>
                  </div>
                </div>
            </div>
              </div>
            </div>
          </div>
        </div>
        </div>
<!--REFER A FRIEND end -->
  </div>
</div>
<!-- promotional banner -->
<div class="col-lg-12">
<div class="row">
  <div class="col-lg-6">
<!-- Maximize Section -->
      <div class="card">
        <div class="card-header">
        <h5 class="text-uppercase text-center mb-0">HOW TO MAXIMIZE THE MATCHING BONUSES!</h5>
        </div>
        <div class="card-body pr-4 pb-2 mt-1">
            <ul class="mt-2">
              <li><strong>Step 1:</strong> Use the Social Media Share buttons to share the 4NEW story.  Simply click the icons and post to your page <br/></li>
              <li><strong>Step 2:</strong>  Email the preloaded message to all of your most influential contacts.  The message can be customized as you like and includes your affiliate link.<br/></li>
              <li><strong>Step 3:</strong>  Download the 4NEW banner to your computer.  Then upload it to your social media sites. You can also attach it in an email, or post it on your blog or website. HTML code is provided.<br/></li>
              <li><strong>Step 4:</strong>  Watch this marketing video to  hear from a few 7 figure earners on how they made  $124,325.04 their VERY FIRST WEEK as 4NEW Affiliate Promoters. <!-- <a href="#myModal" data-toggle="modal"><strong>Watch Video</strong></a> -->
              </li>
            </ul>
            <br/>
            <iframe id="cartoonVideo" width="100%" height="300" src="https://www.youtube.com/embed/DmCYgcqf1O8"frameborder="0" allowfullscreen></iframe>
            <br/>
        </div>
      </div>
      <div>

              <!-- old one https://www.youtube.com/embed/DmCYgcqf1O8 -->
              
                                
      </div>
<!-- End Maximize Section -->
<!-- email section start -->
<div class="card mb-5 mt-5">
                      <div class="card-header">
                          <h5 class="text-uppercase mb-0">EMAIL SOME PEOPLE</h5>
                      </div>
                      <div class="card-body pr-4 pb-2 mt-2">
                               <div class="mt-4 p-3 small-text-info md-text-info">
                                <strong>AUTOMATED EMAIL SENDER:</strong>
                            <br/>
                            <br/>
                            <ul class="step_section">
                              <li>Who do you know that may be interested in 4NEW?  Email them NOW to leverage the 50% MATCH BONUS.</li>
                              <!-- <li><strong>From:</strong> <?php echo e(Sentinel::getuser()->fullname); ?><br/></li>
                              <li><strong>To:</strong>_____<br/></li>
                              <li><strong>Subject:</strong>  RE: [Time Sensitive] Email from Affiliate Name<br/></li>
                              <li>Enter up to 10 emails at a time in the box above, separated by a comma (example: yourname@domain.com,yourname@domain.com)</li>
 -->


                          </ul>

                        </div>
                        <br/>


                       <form id="contact-form" name="contact-form"
                                        action="<?php echo e(url('refferfriend')); ?>" method="POST">
                                        <?php echo e(csrf_field()); ?>


                         <?php if(session('error')): ?>
          <div class="alert alert-danger alert-dismissable">
         <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
         <strong>Error : </strong>   <?php echo e(session('error')); ?>

       </div><?php endif; ?>

         <?php if(session('success')): ?>
              <div class="alert alert-success alert-dismissable">
         <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
         <strong>Success : </strong>   <?php echo e(session('success')); ?>

       </div><?php endif; ?>
                        <div class="from-group mb-2">
                          <label>From</label>
                          <input type="text" class="form-control" name="username" value="<?php echo e(Sentinel::getuser()->fullname); ?>" readonly="">
                          <span><span class=" text-danger"><?php echo e($errors->first('username')); ?></span> <br></span>
                        </div>
                        <div class="from-group mb-2">
                          <label>To</label>
                          <input type="text" class="form-control" name="to_email">
                          <span class="mt-2 d-block">Enter up to 10 emails at a time in the box above, separated by a comma and space (example: test1@domain.com, test2@domain.com)</span>

                        <span><span class=" text-danger"><?php echo e($errors->first('to_email')); ?></span> <br></span>
                        </div>

                        <div class="from-group mb-2">
                          <label>Subject</label>
                          <input type="text" class="form-control" rows="2" name="to_subject" readonly="readonly" value="RE: [Time Sensitive] Email from <?php echo e(Sentinel::getuser()->fullname); ?>" />
                          <span><span class=" text-danger"><?php echo e($errors->first('to_message')); ?></span> <br></span>
                        </div>

                        <div class="from-group mb-2">
                          <label>Message</label>
                          <textarea class="form-control" rows="12" name="to_message">Hey there, &#10;&#10;Something super interesting just landed on my lap and I thought of you immediately. &#10;&#10;As you probably know, Bitcoin and Cryptocurrency are hot topics in the news right now. What most people don't even realize is that one single Bitcoin transaction uses the same amount of energy to power 35 households for a single day. &#10;&#10;4NEW is taking garbage and turning it into free energy with a Patent Pending process to power the Bitcoin Mines. &#10;&#10;Take a few minutes to review the website and pay close attention to the video of the President speaking at the North American Bitcoin conference.  &#10;&#10;4NEW is truly helping save the planet with Tokenized Electricity.&#10;&#10;All I know is....this one is a home run. &#10;&#10;Chat soon,&#10;&#10;<?php echo e(ucfirst(trans(Sentinel::getuser()->fullname))); ?>&#10;&#10;CHECK OUT THE WEBSITE <==</textarea>
                          <span><span class=" text-danger"><?php echo e($errors->first('to_message')); ?></span> <br></span>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">Send Email</button>


                      </form>

                      </div>
                    </div>
<!-- email section end -->
  </div>
  <!-- end col-6 -->

<div class="col-lg-6">
              <div class="card mb-5">
                <div class="card-header">
                  <h5 class="text-uppercase mb-0">4NEW Campaign Banner</h5>
                  </div>
                <div class="card-body pr-4 pb-2 mt-1">
                    <div class="cards rol_top">
                      <!-- <div class="mt-4 p-3 small-text-info md-text-info">
                      <strong >HOW TO MAXIMIZE THE MATCHING BONUSES!</strong>
                      <br/>
                      <br/>
                      <ul class="step_section">
                      <li><strong>Step 1:</strong>  Email the preloaded message to all of your most influential contacts.  The message can be customized as you like and includes your affiliate link.<br/></li>
                      <li><strong>Step 2:</strong>  Download the 4NEW banner to your computer.  Then upload it to your social media sites. You can also attach it in an email, or post it on your blog or website. HTML code is provided.<br/></li>
                      <li><strong>Step 3:</strong>  Watch this marketing video to  hear from a few 7 figure earners on how they made  $124,325.04 their VERY FIRST WEEK as 4NEW Affiliate Promoters.  <a target="_blank" href="https://youtu.be/DmCYgcqf1O8"><strong>https://youtu.be/DmCYgcqf1O8</strong></a>  <== graphic to pop-up video
                    </li>
                  </ul>

                  </div> -->
                  <br/>
                      <div class="pr-4 pb-2">
                        <div class="ref-code-container">
                          <img src="<?php echo e(url('/')); ?>/back/images/advertisement-1.jpg">
                          </div>

                          <br/>
                          <div class="row">
                            <div class="col-lg-6">
                              <div class="from-group">
                                <label class="text-uppercase mb-2">Image embed HTML:</label>
                                <div class="input-group short-input">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text" data-clipboard-target="#html-embed-code"  onclick="copyhtmlembedd()">
                                      <i class="fas fa-copy"></i>
                                    </span>
                                  </div>
                                  <textarea class="form-control" rows="4" id="html-embed-code"><a href="<?php echo e(url('aff')); ?>?ref=<?php echo e(Sentinel::getuser()->ref_token); ?>"><img src="<?php echo e(url('/')); ?>/back/images/advertisement-1.jpg" alt="4NEW Signup Offer"/></a>
                                  </textarea>
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-6">
                              <div class="from-group">
                                <label class="text-uppercase mb-2">Image embed HTML:</label>
                                <div class="input-group short-input">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text" data-clipboard-target="#embed-code" onclick="copyhtmlembeddcode()">
                                      <i class="fas fa-copy"></i>
                                    </span>
                                  </div>
                                  <textarea class="form-control" rows="4" id="embed-code">[url=<?php echo e(url('aff')); ?>?ref=<?php echo e(Sentinel::getuser()->ref_token); ?>][img]<?php echo e(url('/')); ?>/back/images/advertisement-1.jpg][/ur]</textarea>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="text-center mt-4">
                          <a data-toggle="modal" class="btn btn-primary btn-sm" href="#promotionalbanner">Additional Promotional Banner</a>
                        </div>

                      </div>
                    </div>

                </div>
              </div>
                <div class="mt-3">
                  <div class="ref-code-container">
                    <a href="<?php echo e(url('/user-referral')); ?>"><img src="<?php echo e(url('/')); ?>/back/images/affiliate-banner.jpg"></a>
                    </div>
                </div>
            </div>

            </div>
            </div>
        <!-- card end -->
<!-- promotional banner end-->



  <div class="col">
    <br/>
    <!-- <h1>Social Rewards</h1> -->
<div class="row">
            <div class="col-lg-6">

                  </div>


        </div>
              </div>
            </div>


<?php $__env->stopSection(); ?>

    <script type="text/javascript">

    /*popup video*/


    function copyreferrallink() {
      var copyredText = document.getElementById("post-sharelink");
      //console.log(copyText);
      copyredText.select();
      document.execCommand("Copy");
    }
    function copyreferrallink2() {
      var copyredText = document.getElementById("post-sharelink-affiliate");
      //console.log(copyText);
      copyredText.select();
      document.execCommand("Copy");
    }

    function copyhtmlembedd(){
       var htmlembedcode = document.getElementById("html-embed-code");
      //console.log(copyText);
      htmlembedcode.select();
      document.execCommand("Copy");
    }
    function copyhtmlembeddcode(){
       var embedcode = document.getElementById("embed-code");
      //console.log(copyText);
      embedcode.select();
      document.execCommand("Copy");
    }


</script>


<!-- Modal HTML -->
<div id="promotionalbanner" class="modal fade">
    <div class="modal-dialog video-pop">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="mb-0 text-uppercase">Additional Promotional Banner</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
          <div class="modal-body">
            <div class="promotionalbanner-images">
            <img src="<?php echo e(url('/')); ?>/back/images/mother1.jpg">
            <img src="<?php echo e(url('/')); ?>/back/images/poweredby.jpg">
            <img src="<?php echo e(url('/')); ?>/back/images/trashtotreasure.jpg">
          </div>
          </div>
        </div>
    </div>
</div>
<!-- End Model -->
 <!-- Modal HTML -->
                        <div id="myModal" class="modal fade">
                            <div class="modal-dialog video-pop">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    </div>
            <div class="modal-body">
              <!-- old one https://www.youtube.com/embed/DmCYgcqf1O8 -->
              <iframe id="cartoonVideo" width="100%" height="300" src="https://www.youtube.com/embed/DmCYgcqf1O8"frameborder="0" allowfullscreen></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- End Model -->

 <!-- I want to share an awesome opportunity with you to get in on the ground floor of the hottest new crypto-asset called KWATT. It is the world’s first ecosystem that aims to develop and build a tangible grid infrastructure entirely integrated onto the blockchain.&#10;&#10;They aim to build a global grid integrated on the blockchain with tangible power plants fueling the production of electricity. With its own onsite mining farm, KWATT will be the first true measure of the value of electricity consumption by the most popular cryptocurrencies.That means KWATTs will be a necessity in producing cryptocurrencies.&#10;&#10;4NEW is truly helping save the planet with Tokenized Electricity. Also, if you refer a friend that completes a purchase in their affiliate program, you can earn 75% of the KWATTS purchased. -->
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>