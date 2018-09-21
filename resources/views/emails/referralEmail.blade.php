@include('emails.layout.header')
    <tr>
      <td colspan="2"><img src="{{ url('/') }}/images/email/4new.jpg"  alt="" style="width:100%;"/></td>
    </tr>

    <tr>
      <td colspan="2"></td>
    </tr>
    <tr>
      <td colspan="2"  style="background:url({{ url('/images/email/bgback_new.png') }})0 0 no-repeat"><h4 style="font-size:20px; margin:0; padding:15px 0; color:#7dc242; font-weight:600;"></h4>
        <p style=" color:#5f5f5f; font-size:16px; font-weight:400; padding:0 10px; box-sizing:border-box;" align="left">


{!! nl2br(e($user_message)) !!}

<a href="https://4new.io/">Click here</a> to start <br/>
        </p>
        </td>


    </tr>


     <tr>
      <td colspan="2"  algin="center" style="padding: 0 10px"><a href="https://kwatt.4new.io/register" style=" background:#7dc242; color:#fff; font-size:14px; margin-bottom:35px; padding:10px 20px; display:inline-block; text-decoration:none; text-transform:uppercase;">Buy KWATT </a>
        <a href=" https://www.facebook.com/groups/823611674491436" style=" background:#7dc242; color:#fff; font-size:14px; margin-bottom:35px; padding:10px 20px; display:inline-block; text-decoration:none; text-transform:uppercase;">JOIN OUR FACEBOOK GROUP</a></td>
    </tr>
    <tr></tr>
     @extends('emails.layout.footer')

