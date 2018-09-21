<!-- Tracking Code -->

<!-- Start of HubSpot Embed Code -->
<script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/4431012.js"></script>
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-107699563-1"></script>
<!-- End of HubSpot Embed Code -->

<!-- End Tracking Code -->

<!-- Facebook Pixel Code -->

<!-- Google Code for 4NEW Conversion Conversion Page -->
<!-- Start of LiveChat (www.livechatinc.com) code -->

<!-- End of LiveChat code -->

<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '583331768696542');
  fbq('track', 'PageView');



  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-107699563-1');

</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=583331768696542&ev=PageView&noscript=1"
/></noscript>



<!-- End Facebook Pixel Code -->


<!-- Google Code for Remarketing Tag -->

<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 801331553;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/801331553/?guid=ON&amp;script=0"/>
</div>
</noscript>


<script type="text/javascript">
  (function(e,t){var n=e.amplitude||{_q:[],_iq:{}};var r=t.createElement("script")
  ;r.type="text/javascript";r.async=true
  ;r.src="https://cdn.amplitude.com/libs/amplitude-4.2.1-min.gz.js"
  ;r.onload=function(){if(e.amplitude.runQueuedFunctions){
  e.amplitude.runQueuedFunctions()}else{
  console.log("[Amplitude] Error: could not load SDK")}}
  ;var i=t.getElementsByTagName("script")[0];i.parentNode.insertBefore(r,i)
  ;function s(e,t){e.prototype[t]=function(){
  this._q.push([t].concat(Array.prototype.slice.call(arguments,0)));return this}}
  var o=function(){this._q=[];return this}
  ;var a=["add","append","clearAll","prepend","set","setOnce","unset"]
  ;for(var u=0;u<a.length;u++){s(o,a[u])}n.Identify=o;var c=function(){this._q=[]
  ;return this}
  ;var l=["setProductId","setQuantity","setPrice","setRevenueType","setEventProperties"]
  ;for(var p=0;p<l.length;p++){s(c,l[p])}n.Revenue=c
  ;var d=["init","logEvent","logRevenue","setUserId","setUserProperties","setOptOut","setVersionName","setDomain","setDeviceId","setGlobalUserProperties","identify","clearUserProperties","setGroup","logRevenueV2","regenerateDeviceId","logEventWithTimestamp","logEventWithGroups","setSessionId","resetSessionId"]
  ;function v(e){function t(t){e[t]=function(){
  e._q.push([t].concat(Array.prototype.slice.call(arguments,0)))}}
  for(var n=0;n<d.length;n++){t(d[n])}}v(n);n.getInstance=function(e){
  e=(!e||e.length===0?"$default_instance":e).toLowerCase()
  ;if(!n._iq.hasOwnProperty(e)){n._iq[e]={_q:[]};v(n._iq[e])}return n._iq[e]}
  ;e.amplitude=n})(window,document);

  amplitude.getInstance().init("041c9929021a51a2b89c68a428a39393");
</script>


    <link href="{{ url('/') }}/back/css/fontawesome-all.css" rel="stylesheet">
    <link href="{{ url('/') }}/back/css/bootstrap.css" rel="stylesheet" type="text/css" />


   <link href="{{ url('/') }}/back/css/custom.css" rel="stylesheet" type="text/css" /> 

   <!-- <link href="{{ url('/') }}/back/css/custom.min.css" rel="stylesheet" type="text/css" />  -->

   <link rel="stylesheet" type="text/css" href="{{ url('/') }}/back/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.dataTables.min.css">

    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>

    @yield('style')