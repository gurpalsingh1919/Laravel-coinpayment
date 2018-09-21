@include('emails.layout.header')
    <tr>
      <td colspan="2"><img src="{{ url('/') }}/images/email/welcomew.jpg"  alt="" style="width:100%;"/></td>
    </tr>
    
    <tr>
      <td colspan="2"></td>
    </tr>
    <tr>
      <td colspan="2"  style="background:url({{ url('/images/email/bgback_new.png') }})0 0 no-repeat"><h4 style="font-size:36px; margin:0; padding:15px 0; color:#7dc242; font-weight:600;">Welcome</h4>
        <p style=" color:#5f5f5f; font-size:16px; font-weight:400; padding:0 10px; box-sizing:border-box;">

          Congratulations {{ $user->username }}, <br>
    Your Username {{$user->email}} has been successfully created. Your email activation has now successfully been completed. 
    
       </p>
        <p style=" color:#5f5f5f; font-size:16px; font-weight:400; padding:25px 10px; box-sizing:border-box;text-align: left;">If you need further assistance please do not hesitate to send an email to
          <a href="mailto:support@4new.io" style=" color:#7dc242; font-size:16px; font-weight:700; text-decoration:none">support@4new.io</a> Also, please be sure to follow us on our social media networks to remain updated with the latest events and developments.</p></td>
          
          
    </tr>
    
    <tr>
    <tr></tr>
     @extends('emails.layout.footer')

