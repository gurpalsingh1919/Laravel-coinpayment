@extends('layouts.master')
<!-- head -->
@section('title') Kwatt Dashboard @endsection


@section('content')
<link rel="stylesheet" href="{{ url('/') }}/back/css/webinar_style.css" crossorigin="anonymous">
<div class="container-fluid">
  <div class="col">
   
      <div class="main_wrap">
    <!-- header-section -->
   <!--  <div class="header">
        <div class="container">
           <div class="row">
             <div class="head_tp"><a href="#"><img src="{{ url('/') }}/images/logo/4new-logo-1.png"></a></div>
             
          </div>
       </div>
   </div>  --><!-- header-section -->
    <div class="mid_section"><!-- Contant-section -->
        <div class="video_wraper">
            <div class="container">
                <div class="video_chatarea">
                    <div class="row">
                        <div class="col-sm-12 col-md-8 col-lg-8 offset-md-2 ">
                            <div class="iframe_right">
                                <div class="iframechat">
                                    <iframe width="560" height=430" src="https://www.youtube.com/embed/UDuaf46pQPU" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen>
                                    </iframe>
                                    </div>
                              </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-sm-12 col-md-6 col-lg-6 offset-md-3 ">
                            <div class="video_iframelft">
                                <div class="video_add">                            
                                     <iframe width="650" height="430" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" allowtransparency="true" src="https://chatroll.com/embed/chat/slst?id=6M826L-oZem&platform=html"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
         </div>
       
    </div><!-- Contant-section -->
       
    </div><!-- footer-section -->
  </div>
</div>




@endsection


