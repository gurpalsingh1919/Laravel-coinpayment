@extends('layouts.master')
@section('title') Contact Support @endsection
@section('style')

@endsection
@section('content')
<script src='https://www.google.com/recaptcha/api.js'></script>
<div class="container-fluid">
    <div class="col">
        <div class="col">
            <br/>
            <br/>
            <div class="card mb-5">
                <div class="card-body pt-4">
                    <!-- <ul class="nav nav-tabs">
                      <li class="nav-item">
                        <a class="nav-link "  href="{{ url('/user-profile') }}">My Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="{{ url('/login-history') }}">Login History</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/invite-friend') }}">Invite Friend</a>
                    </li>
                   <!--  <li class="nav-item">
                        <a class="nav-link active" href="{{ url('/contact-support') }}">Contact Support</a>

                    </li> 
                </ul>-->

                <!-- Tab panes -->
                <div class="tab-content">
                  <div class="tab-pane  " id="home">
                  </div>
                  <div class="tab-pane active pr-4" id="menu1">
                    <h5 class="mt-4 text-uppercase">Contact Support</h5>
                    <div class="dropdown-divider"></div>
                    <br/>
                    <div class="row clearfix"> 

                        
                        <div class="col">
                     

                            
                            <section class="section">

                         

                                <div class="row">
                                     @if(session('error'))
                                    <div class="alert alert-danger alert-dismissable">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <strong>Error : </strong>   {{ session('error') }}
                                    </div>
                                    @endif

                                    @if(session('success'))
                                    <div class="alert alert-success alert-dismissable">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <strong>Success : </strong>   {{ session('success') }}
                                    </div>
                                    @endif

                                        <!--Grid column-->
                                    <div class="col-md-12 col-xl-8">
                                        <form id="contact-form" name="contact-form" 
                                        action="{{ url('postinvites') }}" method="POST">
                                        {{ csrf_field() }}
                                            <!--Grid row-->
                                            <div class="row">

                                                <!--Grid column-->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                    <label for="name" class="">Your name</label>
                                                    <input type="text" id="name" name="name" class="form-control" value="{{ Sentinel::getuser()->fullname }}" readonly>
                                                      <span><span class=" text-danger">{{ $errors->first('name') }}</span> <br></span> 
                                                    </div>
                                                </div>
                                                <!--Grid column-->

                                                <!--Grid column-->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                         <label for="email" class="">Your email</label>
                                                        <input type="text" id="email" name="email" class="form-control" value="{{ Sentinel::getuser()->email }}" readonly>
                                                        <span><span class=" text-danger">{{ $errors->first('email') }}</span> <br></span> 
                                                       
                                                    </div>
                                                </div>
                                                <!--Grid column-->

                                            </div>
                                            <!--Grid row-->

                                            <!--Grid row-->
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="subject" class="">Subject</label>
                                                        <input type="text" id="subject" name="subject" class="form-control">
                                                        <span><span class=" text-danger">{{ $errors->first('subject') }}</span> <br></span> 
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <!--Grid row-->

                                            <!--Grid row-->
                                            <div class="row">

                                                <!--Grid column-->
                                                <div class="col-md-12">

                                                    <div class="form-group">
                                                        <label for="message">Your message</label>
                                                        <textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea"></textarea>
                                                        <span><span class=" text-danger">{{ $errors->first('message') }}</span> <br></span> 
                                                        
                                                    </div>

                                                </div>

                                            </div>

                                            <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="captcha">Captcha</label>
                                                    {!! app('captcha')->display() !!}


                                                    @if ($errors->has('g-recaptcha-response'))
                                                        <span><span class="text-danger">
                                                            {{ $errors->first('g-recaptcha-response') }}
                                                        </span><br></span>
                                                    @endif
                                               <!--  </div> -->
                                            </div>  
                                        </div>
                                            <!--Grid row-->
                                            <div class="row">
                                            <div class="col-sm-12">
                                                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                          </div> 
                                           <div class="text-center" id="loader_div1" style="display: none;">
                                            <img src="{{ url('/') }}/upload/third.gif" style="height: 70px;width: 70px;">
                                        </div>
                                          </div> 

                                        </form>

                                        
                                        <div class="status"></div>
                                    </div>
                                    <!--Grid column-->

                                   
                                </div>

                            </section>
                            <!--Section: Contact v.2-->

                            <br/>
                        </div>
                    </div>
                    <br/>
                    <br/>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection

