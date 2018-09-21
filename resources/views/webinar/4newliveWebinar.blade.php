<?php 
date_default_timezone_set('Asia/Kolkata');
?>
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Live Webinar</title>
        <link rel="stylesheet" href="{{ url('/') }}/back/css/bootstrap.css" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ url('/') }}/css/style.css" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ url('/') }}/css/batch-icons.css" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ url('/') }}/font-awesome/css/font-awesome.css" crossorigin="anonymous">
        <script src="{{ url('/') }}/back/js/bootstrap.min.js"crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" crossorigin="anonymous"></script>
    </head>
<body>
 <div class="main_wrap">
    <!-- header-section -->
    <div class="top-header" align="center">
       <div class="head_tp mt-3 mb-3 text-center"><a href="{{ url('/') }}">
        <img src="{{ url('/') }}/images/webinar/4newlogo.svg"></a></div>             
    </div>
    <div class="header">
        <div class="container">
           <div class="row justify-content-center">
               <div class="hear_heading">
                  <h4>Thursday, July 12th at 10 am Eastern Standard Time</h4>
               </div>
<div id="future_date"></div>
                    <br/>
             <div class="col-sm-10 mt-4">
                <div class="iframechat">                                      
                                    <iframe width="780" height="480" src="https://www.youtube.com/embed/5jUEMAXlqwo" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                </div>
                                <div class="kawat_bt"><a href="{{ url('aff') }}?ref={{ $token}}&page=reg" target="_blank">Buy Kwatt now!</a></div>
             </div>
          </div>
       </div>
   </div> <!-- header-section -->
   <div class="mid_section"><!-- Contant-section -->
        <div class="video_wraper">
            <div class="container">
                <div class="video_chatarea">
                    <div class="row justify-content-center">
                         
                        <div class="col-sm-8 ">
                            <div class="iframe_right">
                                <div class="iframechat">                                      
                                    <iframe width="650" height="430" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" allowtransparency="true" src="https://chatroll.com/embed/chat/slst?id=6M826L-oZem&platform=html"></iframe>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div> 
         </div>    
    </div><!-- Contant-section -->
    
    <div class="footer_section"><!-- footer-section -->
        <div class="container">
            <div class="row">
                <div class="trm_cnd">
                    <p>
                     <a href="#">info@4new.io </a>
                     <a href="https://4new.io/terms-and-conditions">Terms & Conditions</a><br>
                     <a href="https://4new.io/">4NEW</a> ©2018 All Rights Reserved</p>
                </div>
            </div>
       </div>
    </div><!-- footer-section -->
</div>
</body>
</html>

 <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" " ></script>
        <script src="{{ url('/') }}/back/js/jquery.countdownTimer.js " ></script>
        <script>jQuery(function(){
          //console.log('<?php //echo date('Y/m/d H:i:s'); ?>');
        jQuery('#future_date').countdowntimer({
            dateAndTime : "2018/07/12 19:29:56",
           startDate : "<?php echo date('Y/m/d H:i:s'); ?>",
            regexpMatchFormat: "([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})",
regexpReplaceWith: "<div class='timer-inner'> $1<span>days</span></div>" + "<div class='timer-inner'>$2 <span>hours</span></div>" +  "<div class='timer-inner'> $3 <span>minutes</span></div>" + "<div class='timer-inner'> $4 <span>seconds</span>",
//timeZone:'Asia/Kolkata'
        });
    });</script>