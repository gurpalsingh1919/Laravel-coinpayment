    @extends('layouts.master')
    <!-- head -->
    @section('title')
    Profile
    @endsection


    @section('content')
    <div class="container-fluid">
    <div class="col">
    <div class="col">
    <br/>
    <br/>
    <div class="row">
    <div class="col-md-12"> 
    @if(session('success')) 
    <div class="alert alert-success alert-dismissable ">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
     <strong>Success : </strong>   {{ session('success') }}
    </div>
    @endif

    @if(session('error')) 
    <div class="alert alert-danger alert-dismissable ">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
     <strong>Error : </strong>   {{ session('error') }}
    </div>
    @endif
    </div> 
    <div class="col">
    <div class="card mb-5 pb-4">


    <div class="card-body pt-4">
   <!--  <ul class="nav nav-tabs">
    <li class="nav-item">
    <a class="nav-link  active"  href="{{ url('/user-profile') }}">My Profile</a>
    </li>
    <li class="nav-item">
    <a class="nav-link"  href="{{ url('/login-history') }}">Login History</a>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="{{ url('/invite-friend') }}">Invite Friend</a>
    </li>
  <!--   <li class="nav-item">
    <a class="nav-link" href="{{ url('/contact-support') }}">Contact Support</a>
    </li> 

    </ul> -->

    <!-- Tab panes -->
    <div class="tab-content">
    <div class="tab-pane active pr-4" id="home">
      <h5 class="mt-4 text-uppercase">My Profile</h5>
    <div class="mt-4 d-flex justify-content-between text-uppercase">
                           
    </div>
    <div class="row">                           
    <div class="col-lg-12 col-md-4">
        <br/>
        @if($user = Sentinel::getUser())
            @if($user->inRole('user'))
                <form id="freeze-input"  action="{{ url('user-profile') }}" method="POST">
            @else
                <form id="freeze-input"  action="{{ url('/profile') }}" method="POST">
            @endif
        @endif
            {{ csrf_field() }}
            <div class="row clearfix"> 
            <!-- <div class="row col-lg-12">  -->
                 @if($user->kyc_status == 1)
                <div class="alert alert-success alert-dismissable small col-lg-12">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Verified : </strong> Your KYC Document is Verified From Ocular.
                </div>
                @else
                <div class="alert alert-info alert-dismissable small col-lg-12">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Pending : </strong> Your KYC Document is Pending For Verification From Ocular.
                </div>
                @endif
           <!--  </div> -->
                @if($user->kyc_status == 1)
                <div class="col-lg-4">
                 <table class="table table-user-information">
                    <tbody>
                    
                      <tr>
                        <td><strong>FirstName:</strong></td>
                        <td>{{$kyc_infos['Name']}}</td>
                      </tr>
                      
                      <tr>
                        <td><strong>Middle Name:</strong></td>
                        <td>{{$kyc_infos['Sec_name']}}</td>
                      </tr>
                      <tr>
                        <td><strong>Last Name:</strong></td>
                        <td>{{$kyc_infos['Last_Name']}}</td>
                      </tr>
                       <tr>
                        <td><strong>Citizenship:</strong></td>
                        <td>{{$kyc_infos['Citizenship']}}</td>
                      </tr>
                        <tr>
                        <td><strong>Birthday:<strong></td>
                        <td>{{$kyc_infos['Birthday']}}</td>
                      </tr>

                         <tr>
                        <td><strong>Reg Exp Date:</strong></td>
                        <td>{{$kyc_infos['res_exp_date']}}</td>
                      </tr>
                     
                      </tr>
                     
                    </tbody>
                  </table>
                
                </div>

                <!-- second section -->
                 <div class="col-lg-4">

                      <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td><strong>Gender:</strong></td>
                        <td>{{$kyc_infos['Gender']}}</td>
                      </tr>
                      <tr>
                        <td><strong>Occupation:</strong></td>
                        <td>{{$kyc_infos['Occupation']}}</td>
                      </tr>
                      <tr>
                        <td><strong>Email:</strong></td>
                        <td>{{$kyc_infos['Client_Email']}}</td>
                      </tr>
                  
                    <tr>
                        <td><strong>Address:</strong></td>
                        <td>{{$kyc_infos['Address']}}</td>
                      </tr>
                     <tr>
                        <td><strong>Street No:</strong></td>
                        <td>{{$kyc_infos['StreetNumber']}}</td>
                      </tr>
                       <tr>
                        <td><strong>Income:</strong></td>
                        <td>{{$kyc_infos['Income']}}</td>
                      </tr>
                 
                     
                    </tbody>
                  </table>
                </div>

                <div class="col-lg-4">
                      <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td><strong>City:</strong></td>
                        <td>{{$kyc_infos['City']}}</td>
                      </tr>
                      <tr>
                        <td><strong>Postal code:</strong></td>
                        <td>{{$kyc_infos['Zip_code']}}</td>
                      </tr>
                      <tr>
                        <td><strong>State/Providence:</strong></td>
                        <td>{{$kyc_infos['State']}}</td>
                      </tr>
                   
                    <tr>
                    <tr>
                        <td><strong>Country:</strong></td>
                        <td>{{$kyc_infos['Country']}}</td>
                      </tr>
                        <tr>
                        <td><strong>Username:</strong></td>
                        <td>{{$kyc_infos['Client_Username']}}</td>
                   <!--    </tr>
                   
                        <td><strong>Password:</strong></td>
                        <td>{{$kyc_infos['Client_Password']}}</td>
                           
                      </tr> -->
                     
                    </tbody>
                  </table>
                </div>
                 <!-- Face Data 1-->
                            @if($kyc_infos['Face_data'] !='')
                          <div class="col-lg-3">
                            <div class="form-group">
                                <img src="{{ url('storage/app/images/KYC/'.$kyc_infos['Face_data'] ) }}"  alt="image not found" style="max-width: 100%; max-height: 150px" class="img-thumbnail" />  
                            </div>
                        </div>  
                        @endif

                           <!-- Face Data 2-->
                        @if($kyc_infos['Face_data2'] !='')
                      <div class="col-lg-3">
                        <div class="form-group">
                            
                            <img src="{{ url('storage/app/images/KYC/'.$kyc_infos['Face_data2'] ) }}" alt="image not found" style="max-width: 100%; max-height: 150px" class="img-thumbnail" />  
                        </div>
                    </div>  
                    @endif
                           <!-- Face Data 3-->
                    @if($kyc_infos['Face_data3'] !='')                        
                      <div class="col-lg-3">
                        <div class="form-group">
                            
                            <img src="{{ url('storage/app/images/KYC/'.$kyc_infos['Face_data3'] ) }}" alt="image not found" style="max-width: 100%; max-height: 150px" class="img-thumbnail"/>  
                        </div>
                    </div>  
                    @endif

                              <!-- photo id 3-->
                    @if($kyc_infos['Id_Data'] !='')                        
                      <div class="col-lg-3">
                        <div class="form-group">
                            
                            <img src="{{ url('storage/app/images/KYC/'.$kyc_infos['Id_Data'] ) }}" alt="image not found" style="max-width: 100%; max-height: 150px" class="img-rounded"/>  
                        </div>
                    </div>  
                    @endif
                @else

                 <div class="col-lg-12">
                 <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td><strong>Name:</strong></td>
                        <td>{{$user->fullname}}</td>
                      </tr>
                      <tr>
                        <td><strong>Email:</strong></td>
                        <td>{{$user->email}}</td>
                      </tr>
                    </tbody>
                  </table>
                
                </div>
                @endif
               

                           
                     @if($user->kyc_status != 1)
                    <div class="col-sm-12">
                       <a class="btn btn-grad btn-primary btn-sm top-btn" 
                       href="https://4new.oculartech.io/12/fa6008bbad0330ef36ff5b868869edbac17f622e" target="_blank">update KYC</a>
                      
                    </div> 
                    @endif
            </div>
        </form>
    </div>


    </div>


    </div>

    @section('script')
    <script src="{{asset('assets/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
    <!-- popper js-->
    <script src="{{asset('assets/js/popper.min.js')}}" type="text/javascript"></script>
    <!-- DataTables jquery-->
    <!-- Bootstrap js-->
    <script src="{{asset('assets/js/bootstrap.js')}}" type="text/javascript"></script>
    <!-- Theme js-->
    <script src="{{asset('assets/js/script.js')}}" type="text/javascript"></script>
    <script>
    $(document).ready(function() {
    $('#data-table').DataTable();
    });


    function readURL(input) {
    if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
    $('.logoContainer ').attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
    }
    }
    //file input preview
    function readURL2(input) {
    if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
    $('.logoContainer2 ').attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
    }
    }
    $("#inputGroupFile01").change(function(){
    readURL(this);
    });
    $("#inputGroupFile02").change(function(){
    readURL2(this);
    });

    $("#inputGroupFile02").change(function (){

    var fileName = $(this).val();
    if(fileName.length >0){
    $(this).parent().children('span').html(fileName.replace(/.*[\/\\]/, ''));
    }
    else{
    $(this).parent().children('span').html("Choose file");

    }
    });

    $("#inputGroupFile01").change(function (){
    var fileName = $(this).val();
    if(fileName.length >0){
    $(this).parent().children('span').html(fileName.replace(/.*[\/\\]/, ''));
    }
    else{
    $(this).parent().children('span').html("Choose file");

    }
    });

    </script>




    @endsection
    <style type="text/css">
    .logoContainer{
    height: 70px;
    width: 70px;
    }
    .logoContainer2{
    height: 70px;
    width: 70px;
    }
    </style>





































    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    @endsection  