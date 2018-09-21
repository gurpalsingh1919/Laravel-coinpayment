@include('emails.layout.header')
    <tr>
      <td colspan="2"><img src="{{ url('/') }}/images/email/BuyKwatt.jpg"  alt="" style="width:100%;"/></td>
    </tr>
    
    <tr>
      <td colspan="2"></td>
    </tr>
    <tr>
      <td colspan="2" style="background:url({{ url('/images/email/bgback_new.png') }})0 0 no-repeat"><h4 style="font-size:36px; margin:0; padding:15px 0; color:#7dc242; font-weight:600;">Congratulations</h4>
        <p style=" color:#5f5f5f; font-size:16px; font-weight:400; padding:0 10px; box-sizing:border-box;">
           
          
     
     Congratulations {{ $user->fullname }}, <br/>
    Thank you for your support and confidence in the project. We are thrilled to have you join the 4NEW family as we combat three global and social crisis our planet is facing in relation to Waste Surplus, Energy Shortfall and Crypto energy consumption & adoption..
    


        </p>
        <p style=" color:#5f5f5f; font-size:16px; font-weight:400; padding:25px 10px; box-sizing:border-box;text-align: left;"> In the event you ever need any further assistance, please do not hesistate to send an email to 
          <a href="mailto:support@4new.io" style=" color:#7dc242; font-size:16px; font-weight:700; text-decoration:none">support@4new.io</a>  Also, please be sure to follow us on our social media networks to remain updated with the latest events and developments.</p></td>
          
          
    </tr>
    
    <tr><tr>
      <td colspan="2" align="center"><a href="{{ $link }}" style=" background:#7dc242; color:#fff; font-size:14px; margin-bottom:35px; padding:10px 20px; display:inline-block; text-decoration:none; text-transform:uppercase;">confirm account </a></td>
    </tr>
    <tr></tr>
    @extends('emails.layout.footer')