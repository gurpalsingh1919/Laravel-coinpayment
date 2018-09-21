@include('emails.layout.header')
    <tr>
      <td colspan="2"><img src="{{ url('/') }}/images/email/passwordreset.png"  alt="" style="width:100%;"/></td>
    </tr>
    
    <tr>
      <td colspan="2"></td>
    </tr>
 <tr>
      <td colspan="2" style="background:url({{ url('/images/email/bgback_new.png')}})0 0 no-repeat"><h4 style="font-size:36px; margin:0; padding:15px 0; color:#7dc242; font-weight:600;">{{$user->fullname}}</h4>
        <p style=" color:#5f5f5f; font-size:16px; font-weight:400; padding:0 10px; box-sizing:border-box;">
           "Hello {{$user->fullname}}, 4NEW has received a request to reset the password for your account.<strong> If you did not request to reset your passwod, please ignore this email.</strong><br/><br/>
      
    To reset your password please click the link below in order to reset your password and utilize the following code <strong>{{ $reset_code }}</strong><br/><br/>

		  <a href="{{ url('/') }}/reset/{{ $user->email }}/{{ $code }}" style=" background:#7dc242; color:#fff; font-size:14px; padding:10px 20px; display:inline-block; text-decoration:none; text-transform:uppercase;">Verify account </a>
        <p style=" color:#5f5f5f; font-size:16px; font-weight:400; padding:25px 10px; box-sizing:border-box;text-align: left;">If you need further assistance please do not hesitate to send an email to
          <a href="mailto:support@4new.io" style=" color:#7dc242; font-size:16px; font-weight:700; text-decoration:none">support@4new.io</a> Also, please be sure to follow us on our social media networks to remain updated with the latest events and developments.</p></td>
          
          
    </tr>
     
	<tr></tr>
    @extends('emails.layout.footer')
