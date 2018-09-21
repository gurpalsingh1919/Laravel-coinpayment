@include('emails.layout.header')
    <tr>
      <td colspan="2"><img src="{{ url('/') }}/images/email/Timeout.jpg"  alt="" style="width:100%;"/></td>
    </tr>
    
    <tr>
      <td colspan="2"></td>
    </tr>
    <tr>
      <td colspan="2" style="background:url({{ url('/images/email/bgback_new.png') }})0 0 no-repeat"><h4 style="font-size:20px; margin:0; padding:15px 0; color:#7dc242; font-weight:600;">Oops! Did you forget something?</h4>
        <p style=" color:#5f5f5f; font-size:16px; font-weight:400; padding:0 10px; box-sizing:border-box;" align="left">

        We noticed you began a transaction, but did not complete it... did you need help? The steps for completing a transaction on the 4NEW portal are easy:<br/>
        1. Register on https://4new.io <br/>
        2. Enter the desired amount in the Buy KWATT currency converter<br/>
        3. From the BUY KWATT NOW drop down menu, select your desired currency<br/>
        4. Remit funds to the account<br/>
        5. MARK AS PAID!<br/>
        </p>
        <p style=" color:#5f5f5f; font-size:16px; font-weight:400; padding:25px 10px; box-sizing:border-box;text-align: left;">If you still need help, please contact one of our helpful support staff via email to 
          <a href="mailto:support@4new.io" style=" color:#7dc242; font-size:16px; font-weight:700; text-decoration:none">support@4new.io</a> or on the telegram chat, accessible from the 4NEW web page.<br/>We look forward to having you in the 4NEW family!.</p></td>
          
          
    </tr>
    
    <tr>
    <tr></tr>
     @extends('emails.layout.footer')

