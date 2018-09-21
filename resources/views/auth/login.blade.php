@extends('auth.layout.master')
<!-- head -->
@section('title')
    Kwatt | Login
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
            <p>Login to manage your 4New account and wallet. You can deposit funds for the pre-listing sale, access your referral code, complete KYC, and more.</p>
            <br/>
            <a href="{{ url('register') }}" class="btn btn-default">Register Now</a> 
            <div class="hidden-md hidden-xs">
            <br/>
            <br/>
            </div>
          </div>
          <!--begin::Portlet-->
          <div class="right-login">
            <h3 class="form-title text-center">Login to your account</h3>
            @if(session('error')) 
            <div class="error alert alert-danger alert-dismissable">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Error : </strong>   {{ session('error') }}
            </div>
           
            @endif
            @if(session('success')) 
            <div class="error alert alert-success alert-dismissable">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              {!! session('success') !!}
            </div>
           
            @endif
             @if(session('status')==2)
             <div id="showsendbutton" class="form-group" onclick="resend_activation()">
              <button type="submit" class="btn-resend-act btn-primary">Resend Activation</button>   
            </div>
            @endif
            
             <div id="success" class="alert alert-success alert-dismissable">
             
            </div>
            <div id="error" class="alert alert-danger alert-dismissable">
              
              
              
            </div>
        

            @if (session('csrf_error')) 
             <div class="alert alert-danger alert-dismissable">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Error : </strong>   {{ session('csrf_error') }}
            </div>
             
            @endif
            <!--begin::Form-->
            <form id="register-form" action="{{ url('login') }}" method="post" class="tab-content active">
              <input type="hidden" id="resend_email" name="resend_email" value="{{ session('resend_email') }}">
              {{ csrf_field() }}
                <div class="form-group mb-4">
                  <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="{{ old('email')}}">  
                   <span class=" text-danger">{{ $errors->first('email') }}</span>
                     <br/> 
                </div>
                <div class="form-group mb-4">
                  <input type="password" name="password" class="form-control" id="password" placeholder="Password"> 
                   <span class=" text-danger">{{ $errors->first('password') }}</span>
                                     <br/>
                </div> 
                <div class="form-group mb-5  row justify-content-between"> 
                  <div class="col-md-6">
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck1">
                    <label class="form-check-label" for="gridCheck1">
                        Remember me
                    </label>
                  </div>
                  </div>
                  <div class="col-md-6 text-right">
                    <a href="{{ url('forgot-password') }}">Forgot your password ?</a>
                  </div>
                </div> 
                <div class="text-center" id="loader_div_login" style="display: none;">
                    <img src="{{ url('/') }}/upload/third.gif" style="height: 70px;width: 70px;">
                </div>
                <div class="form-group" onclick="login_click()" id="login_div">
                  <button type="submit" class="btn btn-primary btn-block">Sign in</button>   
                </div>
            </form>
 
          </div>
          <!--end::Portlet-->
        </div>
      </div>
    </div>
  </div>
  <!-- end:: Page -->
<style type="text/css">
  .btn-resend-act{
        float: right;
    margin: 10px;
  }
</style>
  <script type="text/javascript">
    function login_click()
    {
      $('#login_div').hide();
      $('#loader_div_login').show();
    }
    
    $('#error').hide();
    $('#success').hide();
    function resend_activation()
    {
        var emailid=$('#email').val();
        
        var emailid=$('#resend_email').val();
        if(emailid =='')
        {
            alert('Please enter email address');
        }
        else
        {
            $('#showsendbutton').hide();
            $('.error').hide();
        }
         $.ajax({
          type: 'POST',
          url: "{{url('activationresend')}}",
          data: { email:emailid,_token:"{{csrf_token()}}" },
          success:  function(response)
          {
            //$('#showsendbutton').hide();
               console.log(response);
                // Session::put([response => true]);
               var msg=response.message;
                var status=response.status;
                console.log(status);
                if(status==1)
                {
                   $('#success').show();
                  $('#success').html(msg);
                }
                else
                {
                  $('#error').show();
                  $('#error').html(msg);
                }

          }
        });
    }
  </script>

@endsection