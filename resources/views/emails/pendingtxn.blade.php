@include('emails.layout.header')
    <tr>
      <td colspan="2"><img src="{{ url('/') }}/images/email/Transaction.jpg"  alt="" style="width:100%;"/></td>
    </tr>
    
    <tr>
      <td colspan="2"></td>
    </tr>
    <tr>
      <td colspan="2" style="background:url({{ url('/images/email/bgback_new.png') }})0 0 no-repeat"><h4 style="font-size:20px; margin:0; padding:15px 0; color:#7dc242; font-weight:600;">Complete your Transaction with 4New</h4>
        <p style=" color:#5f5f5f; font-size:16px; font-weight:400; padding:0 10px; box-sizing:border-box;" align="left">

       Dear {{$username}},<br/><br/>

        At 4NEW we believe it takes a village to raise a child. We appreciate the support and confidence you have demonstrated towards our project. <br/><br/>

        We noticed you recently began a transaction of {{$coin_amount}} {{$coin_type}} and did not completed it, do you need help? <br/><br/>

        The steps for completing a transaction on the 4NEW portal are easy:<br/><br/>

        1. Register on https://4new.io <br/>
        2. Enter the desired amount in the Buy KWATT currency converter <br/>
        3. From the BUY KWATT NOW drop down menu, select your desired currency <br/>
        4. Remit funds to the timed wallet address that is only active for 24 hours <br/>
        5. MARK AS PAID! <br/>
        6. Once funds clear into the designated timed wallet address, the KWATT balance in your account will be updated with any respective applicable bonuses <br/>        



        If you still need help, please contact one of our helpful support staff via email or on the telegram chat, accessible from the 4NEW web page.<br/><br/>

        Also please note that the current bonus round ends May 15th, 2018.<br/><br/>

        Furthermore, please do not forget to complete your <a href="https://4new.oculartech.io/12/fa6008bbad0330ef36ff5b868869edbac17f622e" style=" color:#7dc242; font-size:16px; font-weight:700; text-decoration:none">KYC</a> as the system is now Live to complete your KYC. <br/><br/>

        We look forward to having you in the 4NEW family!
        </p>
        
          
          
    </tr>
    
    <tr>
    <tr></tr>
     @extends('emails.layout.footer')

