@include('emails.layout.header')
    <tr>
      <td colspan="2"><img src="{{ url('/') }}/images/email/Thanks.jpg"  alt="" style="width:100%;"/></td>
    </tr>
    
    <tr>
      <td colspan="2"></td>
    </tr>
    <tr>
      <td colspan="2" style="background:url({{ url('/images/email/bgback_new.png') }})0 0 no-repeat"><h4 style="font-size:20px; margin:0; padding:6px 10px; color:#7dc242; font-weight:600;">Payment Success</h4>
        <p style=" color:#5f5f5f; font-size:16px; font-weight:400; padding:0 10px; box-sizing:border-box;" align="left">

       
         Hello {{ $user->fullname }},<br/><br/>
      
      A deposit of <strong>{{ $deposit->coin_amount }} {{ $deposit->type }}</strong> has been received and confirmed into 4New Wallet. The deposit was received on {{ $deposit->address }} with transaction ID {{ $deposit->tx_id }}.<br/><br/>

      Thank you for using 4NEW!

        </p>
        <p style=" color:#5f5f5f; font-size:16px; font-weight:400; padding:6px 10px; box-sizing:border-box;text-align: left;">If you still need help, please contact one of our helpful support staff via email to 
          <a href="mailto:support@4new.io" style=" color:#7dc242; font-size:16px; font-weight:700; text-decoration:none">support@4new.io</a> or on the telegram chat, accessible from the 4NEW web page.<br/>We look forward to seeing you back in the portal soon. Power to the people!</p></td>
          
          
    </tr>
    
    <tr>
    <tr></tr>
     @extends('emails.layout.footer')

