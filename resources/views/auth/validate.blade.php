 

 @extends('auth.layout.master')
<!-- head -->
@section('title')
    Kwatt | Validate Google 2FA
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
                        <p>
                Google Authenticator is a multifactor app for mobile devices.
                It generates timed codes used during the 2-step verification process. 
                To use Google Authenticator, install the Google Authenticator application on your mobile device.</p>
                        <br/>
                        <a href="{{ url('register') }}" class="btn btn-default">Register Now</a>
                        <div class="hidden-md hidden-xs">
                            <br/>
                            <br/>
                        </div>
                    </div>
                    <!--begin::Portlet-->
                    <div class="right-login">
                        <div class="col-sm-12">
                            @if(session('error'))
                                <div class="alert alert-danger alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Error : </strong>   {{ session('error') }}
                                </div>@endif

                            @if(session('success'))
                                <div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Success : </strong>   {{ session('success') }}
                                </div>@endif

                        </div>
                        <h3 class="form-title text-center">Validate Google 2FA</h3>
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
                        <form action="{{ url('2fa/validate') }}" method="post" id="register-form" class="tab-content active">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <input type="text" class="form-control"  placeholder="Enter One-Time Password" name="totp" />
                                <span></span>
                            </div>

                            <span id="err_lbl">{{ $errors->first('totp') }}</span>

                            <div class="text-center">
                                <button type="submit" class="btn btn-login text-center">Validate</button>
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