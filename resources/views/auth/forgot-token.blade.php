 

 @extends('auth.layout.master')
<!-- head -->
@section('title')
    Kwatt | Token
@endsection
<!-- title -->


@section('content') 

    <div class="outer-login">
        <div class="center-h">
            <div class="card">
                <div class="m-portlet login-screen">
                    <div class=" text-center left-login">
                        <img src="{{asset('assets/images/logo.png')}}" />
                         <p><strong>Welcome to Planet KWATT! <br/> Home for the 4New token that embodies power to the people. </strong></p>
                        <p>Please register here to complete KYC (required), deposit funds for the pre-listing sale, access your referral code and activate two-factor authentication.</p>
                        <br/>
                        
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

                        <h3 class="text-center">Token verification ?
                            <span>Enter your Token  below to reset your password.</span>
                        </h3>
                        <!--begin::Form-->
                        <form action="{{ url('reset') }}/{{ $email }}/{{ $resetCode }}" method="post" id="register-form" class="tab-content active">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <input class="form-control" type="text" autocomplete="off" placeholder="Enter Token" name="token" />
                                <span>{{ $errors->first('token') }}</span>
                            </div>

                            <div class="text-center" id="token_div" style="display: none;">
                                <img src="{{ url('/') }}/upload/third.gif" style="height: 70px;width: 70px;">
                            </div>


                            <div class="text-center" id="main_token">
                                <button type="submit" onclick="token_click()"  class="btn btn-login text-center">Verify</button>
                            </div>

                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Portlet-->
                </div>
            </div>
        </div>
    </div>

 <script type="text/javascript">
      function token_click()
   {
      $('#main_token').hide();
      $('#token_div').show();
   }
    </script>
    @endsection