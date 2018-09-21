@extends('layouts.master')
@section('title') Invite Friends @endsection
@section('style')
@endsection
@section('content')
       <div class="container-fluid">
        <div class="col">
            <div class="col">
                <br/>
                <br/>
               
               
                <div class="card mb-5">


<div class="card-body pt-4">
<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link "  href="{{ url('/user-profile') }}">My Profile</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ url('/login-history') }}">Login History</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="{{ url('/invite-friend') }}">Invite Friend</a>
  </li>
  <!--  <li class="nav-item">
    <a class="nav-link" href="{{ url('/contact-support') }}">Contact Support</a>
  </li> -->
   
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane">
  </div>
  <div class="tab-pane active pr-4">
        <h5 class="mt-4 text-uppercase">Invite Friend</h5>
        <div class="dropdown-divider"></div>
         <div class="col">
            
<div class="card mb-5">
                    <!--   <div class="card-header">
                          <h5 class="text-uppercase">User referral link</h5>
                      </div> -->
                      <div class="card-body no-padding mt-4">
                        <div class="col-lg-6">
                          <form class="form-copy theme-form">
                            <div class="form-group">
                              <div class="input-group">
                                <input type="text" class="form-control" id="share-link" value="{{url('aff')}}?ref={{ Sentinel::getuser()->ref_token }}">
                                <span class="input-group-btn">
                                  <button class="btn btn-secondary" id="copy-button" data-clipboard-target="#share-link" type="button" onclick="copysharestext()" >copy</button>
                                </span>
                              </div>
                            </div>
                          </form>
                          <p class="bouns-note">Get 75% Matching bonus by referring friends.</p>
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
    </div>


@endsection
 <script type="text/javascript">
    function copysharestext() {
      var copyText = document.getElementById("share-link");
      //console.log(copyText);
      copyText.select();
      document.execCommand("Copy");
    }
  </script>