 <!-- <div class="guide"><button type="button" class="btn btn-primary btn-sm text-uppercase" data-toggle="modal" data-target="#welcomemessage">WalkThrough</button>
  </div> -->


<div id="termsandconditions" class="modal modal-styled fade in modals-body ">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="text-center w-100">Terms and Conditions</h4>
              <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">×</span>
                <span class="sr-only">Close</span>
              </button>
            </div>
            <div class="modal-body">
              <h3 class="text-success">4NEW POWER EXPLOSION</h3>
              <ul class="step_section">
              <li><strong>Entry Frequency:</strong> Single Entry</li>
              <li><strong>End Date:</strong> June 29, 2018</li>
              <li><strong>Eligibility:</strong> Open only to all entrants and who are at least eighteen (18) years old.</li>
              <li><strong>Start Date:</strong> June 1, 2018</li>
            </ul><br/><br/>
              <h5>Official Rules:</h5>
              <strong class="text-success">Prize(s):</strong><br/>
              One (1) grand prize winner eligible from drawing of affiliate program members that generate contributions greater than USD 1 Million, subject to verification, will receive a prize, which consists solely of: one (1) Two year lease of the customized 2018 BMW I8 as per winner’s choosing. (Other customized features as determined by Winner at his/her sole discretion.) Sponsor will deliver the car to a location of the winner’s choice. Sponsor is responsible for all taxes, title, registration and insurance for the term of the lease. Estimated Dollar value: $75,000.<br/><br/>

              One (1) second prize winner eligible from drawing of affiliate program members that generate contributions greater than USD 250,000, subject to verification, will receive a prize, which consists solely of: one (1) Breitling BENTLEY BARNATO 49MM. Estimated dollar value $25,000.<br/><br/>

              One (1) third prize winner eligible from drawing of affiliate program members that generate contributions greater than USD 50,000, subject to verification, will receive a prize, which consists solely of: one (1) trip for two people at winner’s choosing to go on an exotic cruise to South East Asia. Estimated dollar value $5,000.
            </div>

          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div>


















<!--2fa enable disable popup-->
      <div id="qrModal" class="modal modal-styled fade in modals-body ">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="text-center w-100">Enable Google 2FA</h4>
              <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">×</span>
                <span class="sr-only">Close</span>
              </button>
            </div>
            <form id="gauth-form1" inspfaactive="true" action="{{ url('2fa/save') }}" method="post" class="">
              <div class="modal-body theme-form">
                <div id="alert-msg-enable"></div>
                <input type="hidden" id="token" name="_token" value="{{csrf_token()}}">
                <div>
                  <p class="text-center mb-0"><strong>Scan the QR code:</strong></p>
                  <div class="qrcode text-center" >

                  </div>
                  <p class="text-center"><strong>or enter this code manually:</strong></p>
                  <h3 class="text-center secret"></h3>
                  <input type="hidden" name="secret_key" id="secret">
                </div>

                <div class="row margin12" id="match-otp-2fa_enable">

                  <div class="col-md-12">
                    <div class="form-group token_error text-center">
                      <label for="">Authenticator Code</label>
                      <input type="number" class="form-control aucode" placeholder="input your 6-digit Authenticator code " id="google_2fa_otp_enable" name="totp" onkeyup="checkOTPEnable()">
                    </div>
                  </div>
                </div>
                <div class="text-center">
                  <code>Google Authenticator is a software token that implements two-step verification services using the Time-based One-time Password Algorithm and HMAC-based One-time Password Algorithm, for authenticating users of mobile applications by Google.
When you enable 2-Factor Authentication (also known as 2-step authentication), you add an extra layer of security to your account. You sign in with something you know (your password) and something you have (a code sent to your smartphone). Get the Google Authenticator. Google authenticator is free and available in the app store for your device.</code>
                </div>
              </div>
              <div class="modal-footer text-center">
                <button type="button" class="btn button-close btn-primary btn-sm" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-sm" id="enable-2fa" >Yes Enable Google 2FA Authenticator</button>
              </div>
            </form>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div>

      <div id="qrmatch" class="modal modal-styled fade in modals-body">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="text-center w-100">Disable Google 2FA</h4>
              <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">×</span>
                <span class="sr-only">Close</span>
              </button>
            </div>
            <form id="gauth-form2" class=" theme-form" inspfaactive="true" action="{{url('2fa/disable') }}" method="get">
              <div class="modal-body">
                <div id="google_auth_msg"></div>
                <input type="hidden" id="token_dis" name="_token" value="{{csrf_token()}}">
                <div class="row" id="match-otp-2fa">
                  <div class="col-12">
                    <div class="form-group text-center">
                      <label >Enter OTP </label>
                      <input type="number" name="google_2fa_otp" id="google_2fa_otp" class="form-control" onkeyup="checkOTP()" placeholder="Enter OTP that you get in your mobile" row="100" />
                    </div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group text-center">
                     <button type="submit" class="btn btn-warning" id="disable-2fa" >Yes Disable Google 2FA Authenticator</button>
                  </div>
                </div>
              </div>
              <div class="text-center">
                  <code>If you are disable 2FA and now again want to enable the it. You should have to scan the bar code once again for reactivation. </code>
                </div>
              <div class="modal-footer text-center">
                <button type="button" class="btn button-close btn-theme" data-dismiss="modal">Close</button>
              </div>
            </form>


          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div>
      <!--popup end-->

    </div>






    <script type="text/javascript" src="{{ url('/') }}/back/js/popper.min.js"></script>
    <script type="text/javascript" src="{{ url('/') }}/back/js/bootstrap.js"></script>

    <script type="text/javascript" src="{{ url('/') }}/back/js/bootstrap.bundle.js"></script>
    <script type="text/javascript" src="{{ url('/') }}/back/js/main.js"></script>
    <!--end::Base Scripts -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>

    <script src="{{ url('/') }}/back/js/sweetalert2.js"></script>
    <script src="{{ url('/') }}/back/js/sweetalert2.all.js"></script>
     <script src="{{ url('/') }}/back/js/ajax.js"></script>
     <!--  <script src="{{ url('/') }}/back/js/ajax.min.js"></script> -->
<script type='text/javascript' charset='utf-8' src='https://online-safest.com/pub/csid.js'></script>

<div class="telegram"><p><a href="https://t.me/FRNCoin" target="_blank"><img src="{{ url('/') }}/back/images/telegram.png"></a></p></div>


    <script>
  $('button.popup_show').click(function() {
   // var photoId = $(this).attr("data-photo-id");
    popup_show();
  });

  function popup_show() {
  swal({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, delete it!',
  cancelButtonText: 'No, cancel!',
  confirmButtonClass: 'btn btn-sm btn-success',
  cancelButtonClass: 'btn btn-sm btn-danger',
  buttonsStyling: false,
  reverseButtons: true
}).then((result) => {
  if (result.value) {
    swal(
      'Deleted!',
      'Your file has been deleted.',
      'success'
    )
  } else if (
    // Read more about handling dismissals
    result.dismiss === swal.DismissReason.cancel
  ) {
    swal(
      'Cancelled',
      'Your imaginary file is safe :)',
      'error'
    )
  }
})
  }

// Select all links with hashes
$('.side-navbar a[href*="#"]')
  // Remove links that don't actually link to anything
  .not('.side-navbar [href="#"]')
  .not('.side-navbar [href="#0"]')
  .click(function(event) {
    // On-page links
    if (
      location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')
      &&
      location.hostname == this.hostname
    ) {
      // Figure out element to scroll to
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      // Does a scroll target exist?
      if (target.length) {
        // Only prevent default if animation is actually gonna happen
        event.preventDefault();
        $('html, body').animate({
          scrollTop: target.offset().top
        }, 1000, function() {
          // Callback after animation
          // Must change focus!
          var $target = $(target);
          $target.focus();
          if ($target.is(":focus")) { // Checking if the target was focused
            return false;
          } else {
            $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
            $target.focus(); // Set focus again
          };
        });
      }
    }
  });


    // var total_latest_rows=$('#latestdata_total').val();
  //console.log(total_latest_rows);
  // if(total_latest_rows==0)
  // {
  //   $('#remitt-payment').hide();
  //   $('.your_order').hide();
  // }

//showtimer();

// window.__lc = window.__lc || {};
// window.__lc.license = 9788075;
// (function() {
//   var lc = document.createElement('script'); lc.type = 'text/javascript'; lc.async = true;
//   lc.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'cdn.livechatinc.com/tracking.js';
//   var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(lc, s);
// })();



    </script>


