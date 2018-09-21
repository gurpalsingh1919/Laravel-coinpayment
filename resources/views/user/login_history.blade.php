@extends('layouts.master')
<!-- head -->
@section('title')
    Login History
@endsection


@section('content')

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
    <a class="nav-link active" href="{{ url('/login-history') }}">Login History</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ url('/invite-friend') }}">Invite Friend</a>
  </li>
 <!--  <li class="nav-item">
    <a class="nav-link" href="{{ url('/contact-support') }}">Contact Support</a>
  </li> 
   
</ul> -->

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane  " id="home">
    <h5 class="mt-4 text-uppercase">Login History</h5>
  </div>
  <div class="mt-4 d-flex justify-content-between text-uppercase">
                           
    </div>
  <div class="tab-pane active pr-4" id="menu1">
        
        <div class="dropdown-divider"></div>
         <div class="col">
            <br/>
                            <table id="ico-table" class="display responsive nowrap" width="100%">
                                <thead>
                                <th>Sr.</th>
                                <th>Login History</th>
                                <th>Ip Address</th>

                                </thead>
                                <tbody>
                                @foreach($login as $key)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{date_format($key->created_at,'F Y dS  l  (H:i:s A) ' )}} </td>
                                    <td>{{$key->ip_address}} </td>
                                </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            <br/>
                            <br/>
                        </div>
      
  </div>
   
</div>
</div>
 



                
                </div>
            </div>
        </div>
    </div>


@endsection