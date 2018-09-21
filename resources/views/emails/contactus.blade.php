@include('emails.layout.header')
    <tr>
      <td colspan="2"><img src="{{ url('/') }}/images/email/supportbanner.png"  alt="" style="width:100%;"/></td>
    </tr>
    
    <tr>
      <td colspan="2"></td>
    </tr>
    <tr>
      <td colspan="2"  style="background:url({{ url('/images/email/bgback_new.png') }})0 0 no-repeat"><p style="font-size:20px; margin:0; padding:15px 0; color:#7dc242; font-weight:600;">Hello {{$admin}}, User need support</p>
	  <table border="0" cellspacing="0" cellpadding="10" width="500">
	  <tr>
	  <td>
        <p style="border-bottom: 1px solid #dedede;padding: 10px 0px;margin:0; color:#5f5f5f"><strong style="width:100px; display:inline-block">Name</strong>:<span style="margin:0px 0px 0px 10px">{{ $user['username'] }}</span></p>
		<p style="border-bottom: 1px solid #dedede;padding: 10px 0px;margin:0; color:#5f5f5f"><strong style="width:100px; display:inline-block">Email</strong>:<span style="margin:0px 10px 0px 10px">{{ $user['email'] }} </span></p>
		<p style="border-bottom: 1px solid #dedede;padding: 10px 0px;margin:0; color:#5f5f5f"><strong style="width:100px; display:inline-block">Subject</strong>:<span style="margin:0px 10px 0px 10px">{{ $user['subject'] }}</span></p>
		<p style="text-align:justify; color:#5f5f5f"><span style="margin:0px 10px 0px 0px;">{{ $user['message'] }}</span></p>
		</td>
		</tr>
		</table>
	  </td>
          
          
    </tr>
     <tr><td><p></p></td></tr>
     @extends('emails.layout.footer')