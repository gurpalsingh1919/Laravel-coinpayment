@extends('layouts.master')
<!-- head -->
@section('title')
Kwatt Coin
@endsection


@section('content')


<div class="container">
 <div class="row">        
        <div class="col-md-4 col-lg-4 " align="center"> 
          <div><strong>Profile Photo</strong></div><br/>
          <img alt="User Pic" src="{{ url('/upload/4new_kyc') }}/{{$user->kyc_document}}" class="img-circle img-responsive" style="width: 200px; height: 150px; margin-bottom: 5%;">
         <div><strong>ID Proof</strong></div><br/>
         <img alt="User Pic" src="{{ url('/upload/4new_kyc') }}/{{$user->kyc_document1}}" class="img-circle img-responsive" style="width: 200px; height: 150px;">
           </div>
                
                <div class=" col-md-8 col-lg-8 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>First Name:</td>
                        <td>{{$user->first_name}}</td>
                      </tr>

                      <tr>
                        <td>Last Name:</td>
                        <td>{{$user->last_name}}</td>
                      </tr>

                      <tr>
                        <td>Email</td>
                        <td>{{$user->email}}</td>
                      </tr>
                   
                      <tr>
                        <td>phone</td>
                        <td>{{$user->email}}</td>
                      </tr>

                     <tr>
                        <td>company</td>
                        <td>{{$user->company}}</td>
                      </tr>

                      <tr>
                        <td>zipcode</td>
                        <td>{{$user->zipcode}}</td>
                      </tr>

                       <tr>
                        <td>address</td>
                        <td>{{$user->address}}</td>
                      </tr>

                      <tr>
                        <td>country</td>
                        <td>{{$user->country}}</td>
                      </tr>

                      <tr>
                        <td>city</td>
                        <td>{{$user->city}}</td>
                      </tr>  
                    </tbody>
                  </table>
                  
                  <a href="{{ url('/kyc-accept')}}/{{$user->id}}" class="btn btn-primary">Approve</a>
                  <a href="{{ url('/kyc-no-accept')}}/{{$user->id}}" class="btn btn-warning">Decline</a>
                </div>
              </div>
            </div>
                

    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/bootstrap.bundle.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
    <!--end::Base Scripts -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>

    </body>
    <!-- end::Body -->
@endsection  