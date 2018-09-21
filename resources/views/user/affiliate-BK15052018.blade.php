@extends('layouts.master')
@section('title') Kwatt-KYC @endsection
@section('style')
@endsection
@section('content')

 


       
<div class="container-fluid">
  <div class="col">
    <br/>
    <!-- <h1>Social Rewards</h1> -->
    <br/>
    <div class="card mb-5">
      <div class="card-header">
        <h5 class="text-uppercase mb-0">Refer a Friend</h5>
      </div>
      <div class="card-body no-padding mt-4">
        <div class="col">
          <div class="d-flex justify-content-center row">
            <div class="col-md-5">
              <div class="custom-refer-form">
                <label class="reff-text">
                  <i class="fas fa-user-alt"></i> No. of Referrals : 
                  <span>{{count($users)}}</span>
                </label>
                <label class="reff-text">
                  <img src="{{ url('/') }}/back/images/kwatt.png"> Coins Earned: 
                    <span>{{$asTotal}}</span>
                  </label>
                </div>
                <br/>
              </div>
              <div class="col-md-5">
                <div class="mb-5">
                  <table class="table table-bordered text-center table-striped  mb-0">
                    <tr>
                      <th>Date</th>
                      <th>Bonus Rate</th>
                    </tr>
                    <tr>
                      <td>May 10th to 17th</td>
                      <td>100%</td>
                    </tr>
                    <tr>
                      <td>May 18th to  25th</td>
                      <td>75%</td>
                    </tr>
                    <tr>
                      <td>May 26th to 31st</td>
                      <td>50%</td>
                    </tr>
                  </table>
                  <div class="mt-2 pb-0 d-none">
                    <small>
                      <p>All times UTC
                        <br/>
                        <strong>Please note</strong>, the above mentioned bonus structure is in addition to the bonuses offered on the main website at 4new.io
                        <br/>
                        <strong>Purchaser Bonus</strong> will be earned by purchaser using the affiliate link
                        <br/>
                        <strong>Referral Bonus</strong> will be earned by the referrer sharing the referral link with purchasers.
                      </p>
                    </small>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <!-- card end -->
      <div class="row">
        <div class="col-lg-4">
          <div class="card mb-5">
            <div class="card-body pr-4 pb-5 mt-4 pt-5">
              <h5 class="text-center text-uppercase">JOIN COMMUNITY!</h5>
              <div class="social-ics">
                <a href="https://www.facebook.com/4newcoin/" class="fab fa-facebook-f" target="_blank"></a>
                <a href="https://twitter.com/4newcoin?lang=en" class="fab fa-twitter" target="_blank"></a>
                <a href="https://www.linkedin.com/company/4newcoin/" class="fab fa-linkedin-in" target="_blank"></a>
                <a href="https://t.me/FRNCoin" class="fab fa-telegram-plane" target="_blank"></a>
                <a href="https://medium.com/@4newcoin" class="fab fa-medium-m" target="_blank"></a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="card mb-5">
            <div class="card-body pr-4 pb-4 mt-4 text-center">
              <h5 class="text-center text-uppercase">YOUR REFERRAL CODE IS:</h5>
              <h2 style="color:#7dc242">{{ Sentinel::getuser()->ref_token }}</h2>
              <label>Your referral link is:</label>
              <form class="form-copy theme-form">
                <div class="input-group">
                  <input type="text" class="form-control" id="post-sharelink" value="{{url('aff')}}?ref={{ Sentinel::getuser()->ref_token }}">
                    <span class="input-group-btn">
                      <button class="btn btn-secondary" id="copy-button" data-clipboard-target="#post-sharelink" type="button" onclick="copyreferrallink()" >copy</button>
                    </span>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="card mb-5">
              <div class="card-body pr-4 pb-5 mt-4 pt-5">
                <h5 class="text-center text-uppercase">Share Your Referral Code!</h5>
                <div class="social-ics shar-icons">
                  <a href="https://www.facebook.com/sharer/sharer.php?u={{url('aff')}}?ref={{ Sentinel::getuser()->ref_token }}" class="fab fa-facebook-f" target="_blank"></a>
                  <a href="http://twitter.com/share?text=Register+for+The+4NEW+Coin+Sale+-+4NEW+is+Bitcoin+on+Steroids%21&amp;url={{url('aff')}}?ref={{ Sentinel::getuser()->ref_token }}" class="fab fa-twitter" target="_blank"></a>
                  <a href="https://www.linkedin.com/shareArticle?mini=true&amp;url={{url('aff')}}?ref={{ Sentinel::getuser()->ref_token }}&amp;title=Register+for+The+4NEW+Coin+Sale+-+4NEW+is+Bitcoin+on+Steroids%21" class="fab fa-linkedin-in" target="_blank"></a>
                  <a href="https://t.me/FRNCoin" class="fab fa-telegram-plane" target="_blank"></a>
                  <a href="https://medium.com/@4newcoin" class="fab fa-medium-m" target="_blank"></a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card mb-5">
          <div class="card-header">
            <h5 class="text-uppercase mb-0">Transactions</h5>
          </div>
          <div class="card-body no-padding mt-4">
            <div class="col">
              <div class="d-flex justify-content-center row">
                <div class="col-md-8">
                  <div class="mb-12">
                    <table class="table table-bordered text-center table-striped">
                      <tr>
                        <th>Sr.</th>
                        <th>Name</th>
                        <!-- <th>Email</th> -->
                        <th>Bonus</th>
                        <th>Date</th>
                      </tr>
                      <?php $i = 1;?>
                      @foreach($ref_list as $list)
      
                      <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{$list->user->fullname}}</td>
                        <!-- <td>{{$list->user->email}}</td> -->
                        <td>{{$list->ref_amount}}</td>
                        <td>{{$list->created_at}}</td>
                      </tr>
                       @endforeach

                    </table>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="mb-12">
                    <table class="table table-bordered text-center table-striped">
                      <tr>
                        <th>Sr.</th>
                        <th>Name</th>
                        
                      </tr>
                      <?php $i = 1;?>
                      @foreach($users as $userdetail)
      
                      <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{$userdetail->fullname}}</td>
                        </tr>
                       @endforeach

                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-lg-4">
            <div class="card mb-5">
              <div class="card-header">
                <h5 class="text-uppercase mb-0">EMAIL SOME PEOPLE</h5>
              </div>
              <form id="contact-form" name="contact-form" 
                                        action="{{ url('refferfriend') }}" method="POST">
                                        {{ csrf_field() }}
                      
                <div class="card-body pr-4 pb-5 mt-4">
                         @if(session('error'))
          
                  <div class="alert alert-danger alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Error : </strong>   {{ session('error') }}
       
                  </div>@endif

         @if(session('success'))
              
                  <div class="alert alert-success alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success : </strong>   {{ session('success') }}
       
                  </div>@endif
                        
                  <div class="from-group mb-4">
                    <label>Name</label>
                    <input type="text" class="form-control" name="username" value="{{Sentinel::getuser()->fullname }}" readonly="">
                      <span>
                        <span class=" text-danger">{{ $errors->first('username') }}</span>
                        <br>
                        </span>
                      </div>
                      <div class="from-group mb-4">
                        <label>Email</label>
                        <input type="text" class="form-control" name="to_email">
                          <span>
                            <span class=" text-danger">{{ $errors->first('to_email') }}</span>
                            <br>
                            </span>
                          </div>
                          <div class="from-group mb-4">
                            <label>Message</label>
                            <textarea class="form-control" rows="6" name="to_message">I would like to share with you an amazing opportunity to get in ground floor on the hottest new crytpo asset called KWATT. It is the world’s most secure coin and has been called Bitcoin on Steroids. Register today and receive a 100% bonus on the official token sale on June 1st.  
                          </textarea>
                            <span>
                              <span class=" text-danger">{{ $errors->first('to_message') }}</span>
                              <br>
                              </span>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">Send Email</button>
                          </div>
                        </form>
                      </div>
                    </div>
                    <div class="col-lg-8">
                      <div class="card mb-5">
                        <div class="card-body pr-4 pb-5">
                          <div class="ref-code-container">
                            <img src="{{ url('/') }}/back/images/advertisement.jpg">
                            </div>
                            <br/>
                            <br/>
                            <div class="row">
                              <div class="col-lg-6">
                                <div class="from-group">
                                  <label>Image embed HTML:</label>
                                  <div class="input-group short-input">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" data-clipboard-target="#html-embed-code"  onclick="copyhtmlembedd()">
                                        <i class="fas fa-copy"></i>
                                      </span>
                                    </div>
                                    <textarea class="form-control" rows="4" id="html-embed-code">
                                      <a href="{{url('aff')}}?ref={{ Sentinel::getuser()->ref_token }}">
                                        <img src="{{ url('/') }}/back/images/advertisement.jpg" alt="4NEW Signup Offer"/>
                                      </a>
                                    </textarea>
                                  </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div class="from-group">
                                  <label>Image embed HTML:</label>
                                  <div class="input-group short-input">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" data-clipboard-target="#embed-code" onclick="copyhtmlembeddcode()">
                                        <i class="fas fa-copy"></i>
                                      </span>
                                    </div>
                                    <textarea class="form-control" rows="4" id="embed-code">[url={{url('aff')}}?ref={{ Sentinel::getuser()->ref_token }}][img]{{ url('/') }}/back/images/advertisement.jpg][/url]</textarea>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>



@endsection
  <script type="text/javascript">
    function copyreferrallink() {
      var copyredText = document.getElementById("post-sharelink");
      //console.log(copyText);
      copyredText.select();
      document.execCommand("Copy");
    }

    function copyhtmlembedd(){
       var htmlembedcode = document.getElementById("html-embed-code");
      //console.log(copyText);
      htmlembedcode.select();
      document.execCommand("Copy");
    }
    function copyhtmlembeddcode(){
       var embedcode = document.getElementById("embed-code");
      //console.log(copyText);
      embedcode.select();
      document.execCommand("Copy");
    }
  </script>