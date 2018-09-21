

 @extends('auth.layout.master')
<!-- head -->
@section('title')
    Diamoreum | Login
@endsection
<!-- title -->


@section('content')
    <div class="outer-login">
        <div class="center-h">
            <div class="card">
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


                <div class="m-portlet login-screen">
                    <div class=" text-center left-login">
                        <img src="{{asset('assets/images/logo.png')}}" /><br/>
                        <p><strong>Welcome to Planet KWATT! <br/> Home for the 4New token that embodies power to the people. </strong></p>
                        <p>Please register here to complete KYC (required), deposit funds for the pre-listing sale, access your referral code and activate two-factor authentication.</p>
                        <br/>
                        <a href="{{url('register')}}" class="btn btn-default">Register Now</a>
                        <div class="hidden-md hidden-xs">
                            <br/>
                            <br/>
                        </div>
                    </div>
                    <!--begin::Portlet-->
                    <div class="right-login">
                        <h3 class="text-center">Forget Password ?
                            <span>Enter your e-mail address below to reset your password.</span>
                        </h3>
                        <!--begin::Form-->
                        <form action="{{ url('forgot-password') }}" method="post" id="register-form" class="tab-content active">

                            {{ csrf_field() }}
                            <div class="form-group">
                                <input type="text" class="form-control"  placeholder="Enter the emaiil address your account is registered to." name="email" />
                                <span></span>
                                <span id="err_lbl" class="invalid-feedback">{{ $errors->first('email') }}</span>
                            </div>



                            <div class="text-center">
                                <button type="submit" class="btn btn-login text-center">Reset Password</button>
                            </div>

                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Portlet-->
                </div>
            </div>
        </div>
    </div>

    @endsection