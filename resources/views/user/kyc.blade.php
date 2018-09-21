@extends('layouts.master')
@section('title') Kwatt-KYC @endsection
@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
    <style>
        .logoContainer{
            margin: 15px auto 0 auto;
            /*background: url(http://img1.wikia.nocookie.net/__cb20130901213905/battlebears/images/9/98/Team-icon-placeholder.png) no-repeat 0 0;*/
            padding: 11px 10px 21px 10px;
            text-align: center;
            line-height: 120px;
        }
        .logoContainer img{
            max-width:100%;
        }
        .logoContainer2{
            margin: 15px auto 0 auto;
            /*background: url(http://img1.wikia.nocookie.net/__cb20130901213905/battlebears/images/9/98/Team-icon-placeholder.png) no-repeat 0 0;*/
            padding: 11px 10px 21px 10px;
            text-align: center;
            line-height: 120px;
        }
        .logoContainer2 img{
            max-width:100%;
        }
        .fileContainer{
            background: #5bcc23;/* you can give it background img as well*/
            width: 202px;
            height: 50px;
            overflow:hidden;
            position:relative;
            font-size:16px;
            line-height: 31px;
            color:#434343;
            padding: 0px 41px 0 53px;
            margin: 0 auto 0px auto;
            cursor: pointer !important;
            border: 2px solid #7dc242;
            padding: 0.9rem 0.9375rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #7dc242;
            border-radius: 0rem;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            background: transparent;
            text-transform: uppercase;
        }
        .fileContainer span{
            overflow:hidden;
            display:block;
            white-space:nowrap;
            text-overflow:ellipsis;
            cursor: pointer;
        }
        .fileContainer input[type="file"]{
            opacity:0;
            margin: 0;
            padding: 0;
            width:100%;
            height:100%;
            left: 0;
            top: 0;
            position: absolute;
            cursor: pointer;
        }
        
    </style>
@endsection
@section('content')
    <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">


    <div class="dashboard-body">

        <div class="row">
            <div class="col-sm-12">
                <h4 class="page-title">KYC Document</h4>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ URL('user/dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i></a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ URL('user-kyc')}}">KYC</a>
                        <!--       <li class="breadcrumb-item"><a href="#!">Deposits & Withdrawals</a> -->
                    </li>
                </ol>
            </div>
            <div class="col-sm-12">

                <div class="card-header">
                    <h4>KYC Document</h4>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="profile text-center">
                            <br>
                            @if($user->kyc_status == 1)
                                <div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Verified : </strong> Your KYC Document is Verified From Admin.
                                </div>
                            @elseif($user->kyc_status == 2)
                                <div class="alert alert-danger alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Not-Verified : </strong> Your KYC Document is Not Verified From Admin.
                                </div>
                            @elseif($user->kyc_status == 0)
                                <div class="alert alert-info alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Pending : </strong> Your KYC Document is Pending For Verification From Admin Now.
                                </div>

                            @else
                            @endif

                            <form method="post" action="{{ url('user-kyc-upload') }}" enctype="multipart/form-data">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="">
                                            <img class="logoContainer" @if($user->kyc_document=='') src="{{asset('assets/images/kyc_demo.png') }}" @else src="{{ url('/') }}/upload/kyc/{{ $user->kyc_document }}" @endif >
                                        </div>
                                        <div class="fileContainer sprite">
                                            <span>choose file</span>
                                            <input type="file" id="file1" name="kyc_document"  value="Choose File">
                                        </div>
                                        @if ($errors->has('kyc_document'))
                                            <span class="help-block text-danger">
                                                <strong>{{ $errors->first('kyc_document') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="col-md-6">
                                        <div class="">
                                            <img  class="logoContainer2"   @if($user->kyc_document1=='') src="{{asset('assets/images/kyc_demo.png') }}"  @else src="{{ url('/') }}/upload/kyc/{{ $user->kyc_document1 }}" @endif >
                                        </div>
                                        <div class="fileContainer sprite">
                                            <span>choose file</span>
                                            <input type="file"  id="file2" name="kyc_document_two"  value="Choose File">
                                        </div>
                                        @if ($errors->has('kyc_document_two'))
                                            <span class="help-block text-danger">
                                                <strong>{{ $errors->first('kyc_document_two') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="p-relative" class="center-block">
                                    {{ csrf_field() }}
                                    <br>
                                    <div class="profile-spc">
                                        <button type="submit" class="btn btn-grad top-btn">Update KYC Document</button>
                                    </div>

                            </form>
                            <br>
                            <p><b>Note :</b>  Required to upload the KYC documents For Verification From Admin.</p>
                            <p> For Example :  Passport, Voting Card, etc </p>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection

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
        $("#file1").change(function(){
            readURL(this);
        });
        $("#file2").change(function(){
            readURL2(this);
        });

        $("#file2").change(function (){

            var fileName = $(this).val();
            if(fileName.length >0){
                $(this).parent().children('span').html(fileName.replace(/.*[\/\\]/, ''));
            }
            else{
                $(this).parent().children('span').html("Choose file");

            }
        });

        $("#file1").change(function (){
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