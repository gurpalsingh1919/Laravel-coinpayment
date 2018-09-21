@extends('layouts.master')
@section('title') Kwatt Profile Page  @endsection
@section('style')
<style type="text/css">
    .secret{
        color:#000;
    }
</style>
@endsection
@section('content')
<?php
// check admin or user
$slug = Sentinel::getUser()->roles()->first()->slug;

?>
<br>
<div class="dashboard-body">
  <div class="row">
    <div class="col-sm-12">
      <h4 class="page-title">Profile</h4>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a @if($slug == "user") href="{{ url('user-dashboard')}}" @else href="{{ url('admin-dashboard')}}" @endif><i class="fa fa-home" aria-hidden="true"></i></a>
        </li>
        <li class="breadcrumb-item"><a @if($slug == "user") href="{{ url('user-profile')}}" @else href="{{ url('admin-profile')}}" @endif>Profile</a>
        </li>
      </ol>
    </div>
    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          @if ($errors->has('first_name'))
          <span class="help-block text-danger">
            <strong>{{ $errors->first('photo') }}</strong>
          </span>
          @endif
          @if($slug == 'admin')
          <form  enctype="multipart/form-data" action="{{ url('admin/profilePicture')}}/{{Sentinel::getUser()->id}}" method="post">
            @else
            <form  enctype="multipart/form-data" action="{{ url('user/profilePicture')}}/{{Sentinel::getUser()->id}}" method="post">
              @endif
              <input type="hidden" name="_token" value="{{csrf_token()}}">
              <div class="profile text-center">
                <div class="p-relative">

                  @if(Sentinel::getUser()->photo == '')
                     <img src="{{ url('/')}}/upload/user/user.png" />
                  @else
                   <img src="{{ url('/')}}/upload/user/{{Sentinel::getUser()->photo}}" />
                  @endif
                 

                  <div class="image-upload">
                    <label for="file-input">
                      <div class="profile-edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></div>
                    </label>
                    <input id="file-input" type="file" name="photo" accept="image/x-png,image/gif,image/jpeg" />
                  </div>
                </div>
                <div>
                  <button type="submit" class="mt-4 btn btn-success">Update Profile</button>
                </div>

              
                <h4>{{ Sentinel::getUser()->fullname }}</h4>
                  
                </div>
              </form>

           </form>
      </div>
    </div>
  </div>
  <div class="col-md-8">
    <div class="card">
      <div class="card-body">
        <ul class="nav nav-pills nav-fill theme-tab">
          <li class="nav-item">
            <a class="nav-link @if(!session('validator')) active @endif" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Profile setting</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="two-fact-tab" data-toggle="tab" href="#two-fact" role="tab" aria-controls="two-fact" aria-selected="false">Two factor Auth</a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if(session('validator')) active @endif" id="chg-pwd-tab" data-toggle="tab" href="#chg-pwd" role="tab" aria-controls="chg-pwd" aria-selected="false">Change password</a>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade @if(!session('validator'))  show active @endif" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="col-md-12">
              @if(session('error'))<br><br><div class="alert alert-danger">{{ session('error') }}</div>@endif
              @if(session('success'))<br><br><div class="alert alert-success">{{ session('success') }}</div>@endif
              @if($slug == 'admin')
              <form class="form-horizontal theme-form mt-5 row"  action="{{ url('admin/profile')}}/{{Sentinel::getUser()->id}}" method="post">
                @else
                <form class="form-horizontal theme-form mt-5 row"  action="{{ url('user/profile')}}/{{Sentinel::getUser()->id}}" method="post">
                  @endif
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" name="user_id" value="{{Sentinel::getUser()->id}}">
                  <div class="form-group col-md-12">
                    <label for="fullname">full Name</label>
                    <input type="text" class="form-control" name="fullname" value="{{ Sentinel::getUser()->fullname }}" id="fullname" autocomplete="off">
                    @if ($errors->has('fullname'))
                    <span class="help-block text-danger">
                      <strong>{{ $errors->first('fullname') }}</strong>
                    </span>
                    @endif
                  </div>

                    <div class="form-group col-md-6">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" disabled value="{{ Sentinel::getUser()->username }}" id="username" autocomplete="off">
                        @if ($errors->has('username'))
                            <span class="help-block text-danger">
                      <strong>{{ $errors->first('username') }}</strong>
                    </span>
                        @endif
                    </div>
                  <div class="form-group col-md-6">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control disabled" disabled name="email" disabled  value="{{ Sentinel::getUser()->email }}" id="email" autocomplete="off">
                    @if ($errors->has('email'))
                    <span class="help-block text-danger">
                      <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                  </div>
                  <div class="form-group col-md-12">
                    <label for="erc_20_address">ERC_20 Address</label>
                    <input type="text" class="form-control"  name="erc_20_address"   value="{{ Sentinel::getUser()->erc_20_address }}" id="erc_20_address" autocomplete="off">
                    @if ($errors->has('erc_20_address'))
                      <span class="help-block text-danger">
                      <strong>{{ $errors->first('erc_20_address') }}</strong>
                    </span>
                    @endif
                  </div>
                  <div class="form-group col-md-12 text-right">
                    <button type="submit" class="mt-4 btn btn-success">Update</button>
                  </div>
                </form>
              </div>
            </div>
            <div class="tab-pane fade mt-5" id="two-fact" role="tabpanel" aria-labelledby="two-fact-tab">
              <div class="row two-fact">
                <div class="col-md-12 text-center">
                  <h3>Enlable Google Authenticator</h3>
                  @if(Sentinel::getUser()->google2fa_enable==1)
                         <button id="otpDisableToggleButton"  class="btn btn-warning mb-4" style="width: 200px;">Disable 2FA</button>
                    @else
                        <button id="otpToggleButton" class="btn btn-theme mb-4" style="width: 200px;">Enable 2FA</button>
                    @endif
                </div>
                <div class="col-md-6 offset-md-3">
                  <ul class="install-step">
                    <li>1.Install Google Authenticator on your phone.</li>
                    <li>2.Open the Google Authenticator app.</li>
                    <li>3.Tab menu, then tab "Set up Account", then "Scan a barcode" or "Enter key provided" is <strong class="colors">3KQD7ED2B5A3CX3M</strong></li>
                    <li>4.Your phone will now be in "scanning" mode. When you are in this mode, scan the barcode below:</li>
                  </ul>
                </div>

             
              </div>
            </div>
            <div class="tab-pane fade @if(session('validator'))  show active @endif " id="chg-pwd" role="tabpanel" aria-labelledby="chg-pwd-tab">
              <div class="col-md-12">
                @if(session('error'))<br><br><div class="alert alert-danger">{{ session('error') }}</div>@endif
                @if(session('success'))<br><br><div class="alert alert-success">{{ session('success') }}</div>@endif
                @if($slug == 'admin')
                <form class="form-vertical theme-form mt-5 row col-md-12" action="{{url('admin/changePassword')}}/{{Sentinel::getUser()->id}}" method="post">
                  @else
                  <form class="form-vertical theme-form mt-5 row col-md-12" action="{{url('user/changePassword')}}/{{Sentinel::getUser()->id}}" method="post">
                    @endif

                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" name="user_id" value="{{Sentinel::getUser()->id}}">
                    <div class="form-group col-md-12">
                      <label>Old password</label>
                      <input type="password" name="old_password" class="form-control" autocomplete="off">
                      @if ($errors->has('old_password'))
                      <span class="help-block text-danger">
                        <strong>{{ $errors->first('old_password') }}</strong>
                      </span>
                      @endif
                    </div>
                    <div class="form-group col-md-12">
                      <label>New password</label>
                      <input type="password" name="new_password" class="form-control" autocomplete="off">
                      @if ($errors->has('new_password'))
                      <span class="help-block text-danger">
                        <strong>{{ $errors->first('new_password') }}</strong>
                      </span>
                      @endif
                    </div>
                    <div class="form-group col-md-12">
                      <label>Retype password</label>
                      <input type="password" name="confirm_password" class="form-control" autocomplete="off">
                      @if ($errors->has('confirm_password'))
                      <span class="help-block text-danger">
                        <strong>{{ $errors->first('confirm_password') }}</strong>
                      </span>
                      @endif
                    </div>
                    <div class="form-group col-md-12 text-right">
                      <button type="submit" class="mt-4 btn btn-success">Change</button>
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
<!--2fa enable disable popup-->
<div id="qrModal" class="modal modal-styled fade in modals-body ">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
         <h4 class="text-center w-100">Disable Google 2FA</h4>
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">×</span>
          <span class="sr-only">Close</span>
        </button>
      </div>
      <form id="gauth-form" inspfaactive="true" action="{{ url('2fa/save') }}" method="post" class="">
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
                              <code>If enabled then each time you login or make a withdrawal at Bino you will be prompted to complete the 2-Step Verification which can only be finished by having access to your smartphone.</code>
                            </div>


                          </div>
                          <div class="modal-footer text-center">
                            <button type="button" class="default-btn mt-4 btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" class="default-btn mt-4 btn btn-success" id="enable-2fa" >Yes Enable Google 2FA Authenticator</button>
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
                        <form id="gauth-form" class=" theme-form" inspfaactive="true" action="{{url('2fa/disable') }}" method="get">
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
                          <div class="modal-footer text-center">
                            <button type="button" class="btn button-close btn-theme" data-dismiss="modal">Close</button>
                          </div>
                        </form>
                      </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                  </div>
                  <!--popup end-->


                  @endsection

                  @section('script')

                    <script type="text/javascript" >

                    $('#otpToggleButton').on('click', function () 
                    {
                        "{{ session()->put('2fa:user:id', Sentinel::getUser()->id) }}"

                        $("#enable-2fa").prop('disabled', true);
                        $("#match-otp-2fa_enable").show();
                        $.ajax({
                          type: 'get',
                          url:"{{url('2fa/enable')}}",
                          success: function (responseData) {
                            console.log(responseData);
                            $('.qrcode').empty();
                            $('.secret').empty();
                            $(".qrcode").append('<img src="'+responseData['imgurl']+'">');
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
                                "{{ session()->put('2fa:user:id', Sentinel::getUser()->id) }}"
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
                          url:"{{url('2fa/validate')}}",
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
                            url:"{{url('2fa/validate-disabletime')}}",
                            data: "totp="+code+'&_token='+token,
                            success: function (responseData) {
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
                        var token = "{{csrf_token()}}";

                        if(code.length == 6)
                        {

                          $.ajax({
                            type: 'post',
                            url:"{{url('2fa/validate-enabletime')}}",
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
                      }
                    </script>
      @endsection