 

 @extends('auth.layout.master')
<!-- head -->
@section('title')
    Kwatt | Reset password
@endsection
<!-- title -->


@section('content') 
<!-- BEGIN: Header -->
    <div class="outer-login">
        <div class="center-h">
            <div class="card">
                <div class="m-portlet login-screen">
                    <div class=" text-center left-login">
                        <img src="{{ url('assets/images/logo.png') }}" />
                         <p><strong>Welcome to Planet KWATT! <br/> Home for the 4New token that embodies power to the people. </strong></p>
                        <p>Please register here to complete KYC (required), deposit funds for the pre-listing sale, access your referral code and activate two-factor authentication.</p>
                        <br/>
                        <a href="{{ url('register') }}" class="btn btn-default">Register Now</a>
                        <div class="hidden-md hidden-xs">
                            <br/>
                            <br/>
                        </div>
                    </div>
                    <!--begin::Portlet-->
                    <div class="right-login">
                        <h3 class="form-title text-center">Reset Password </h3>
                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissable">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Error : </strong>   {{ session('error') }}
                            </div>
                        @endif

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissable">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Success : </strong>   {{ session('success') }}
                            </div>
                        @endif
                    <!--begin::Form-->
                        <form action="{{ url('reset/reset-password') }}" method="post" id="register-form" class="tab-content active">

                            {{ csrf_field() }}
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Password" name="password" />
                                 <span class=" text-danger">{{ $errors->first('password') }}</span>
                                     <br/>
                            </div>

                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Re-Password" name="password_confirmation" />
                               
                                 <span class=" text-danger">{{ $errors->first('Re-Password') }}</span>
                                    
                            <span id="err_lbl" class=" text-danger">{{ $errors->first('password_confirmation') }}</span>
                            </div>

                            

                            <input type="hidden" name="email" value="{{ $user->email  }}">
                             <input type="hidden" name="forgot_token" value="{{ $forgot_token  }}">


                            <div class="text-center">
                                <button type="submit" class="btn btn-login text-center">Set New Password</button>
                            </div>

                        </form>

                    </div>
                    <!--end::Portlet-->
                </div>
            </div>
        </div>
    </div>
    <!-- end:: Page -->

    <script type="text/javascript">
        function login_click()
        {
            $('#login_div').hide();
            $('#loader_div_login').show();
        }
    </script>


@endsection