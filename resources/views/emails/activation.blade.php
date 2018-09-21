@include('emails.layout.header')
<tr>
      <td colspan="2"><img src="{{ url('/') }}/images/email/congratulation.png"  alt="" style="width:100%;"/></td>
    </tr>
    <tr>
      <td colspan="2"></td>
    </tr>
    <tr>
      <td colspan="2" style="background:url({{ url('/images/email/bgback_new.png') }})0 0 no-repeat"><!-- <h4 style="font-size:36px; margin:0; padding:15px 0; color:#7dc242; font-weight:600;">{{$user->fullname}}</h4> -->
        <p style=" color:#5f5f5f; font-size:16px; font-weight:400; padding:0 10px; box-sizing:border-box;"><h2>Please Confirm Your Account</h2></p>
          <p style=" color:#5f5f5f; font-size:16px; font-weight:400; padding:25px 10px; box-sizing:border-box;text-align: left;">
            Congratulations {{$user->fullname}}, your account has been successfully created. <br/>
            You can now login by pressing the green Confirm Account button below.<br/><br/><br/>

            CONFIRM ACCOUNT  <<< <a href="{{ $link }}" style=" background:#7dc242; color:#fff; font-size:14px; margin-bottom:35px; padding:10px 10px; display:inline-block; text-decoration:none; text-transform:uppercase;">Confirm Account </a><br/>

           In the event you need further assistance, please contact us at 
         <a href="mailto:support@4new.io" style=" color:#7dc242; font-size:16px; font-weight:700; text-decoration:none">support@4new.io</a><br/>
       Your next steps<br/><br/>

        Please be sure to follow our social media channels to remain updated on the latest events and developments.<br/><br/>

        www.t.me/FRNCoin<br/>
        www.t.me/FOURNEWKWATT <br/>
        www.facebook.com/groups/4NEWICO/<br/>
        www.facebook.com/4newcoin <br/><br/>

        And... after you click the CONFIRM ACCOUNT button, when you login to your 4NEW account inside the dashboard, take advantage of the our bonus and get yourself the 4NEW tokens! <br/><br/>

        Plus use your new affiliate link that you'll find in the dashboard to share with your friends to earn additional bonus tokens.<br/>

        <p/>


      </td>
          
          
    </tr>
    
    
    <tr></tr>
   @extends('emails.layout.footer')

