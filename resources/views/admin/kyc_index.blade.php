@extends('layouts.master')
@section('title') Kwatt KYC   @endsection
@section('style')

@endsection
@section('content')

<br>
<div class="dashboard-body">
  <div class="row">
    <div class="col-sm-12">
      <h4 class="page-title">Users</h4>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('admin-dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i></a>
        </li>
        <li class="breadcrumb-item"><a href="{{ url('admin-user')}}">Users</a>
        </li>
      </ol>
    </div>

  <div class="col-md-12">
    <div class="card">
      <div class="card-body">





         <a href="{{ url('admin-user-list') }}"> <button class="btn btn-grad top-btn top-btn"> << Back</button></a>

                    <div class="p-relative">
                        @if($user->kyc_document=='')
                          <h1>Not done yet!</h1>
                        @else

                            <img class="m-2 border  "  style="height:auto ; width: 300px" src="{{ url('/') }}/upload/kyc/{{ $user->kyc_document }}"  data-toggle="modal" data-target="#exampleModal" />
                            <img  class="m-2 border " style="height:auto ; width: 300px" src="{{ url('/') }}/upload/kyc/{{ $user->kyc_document1 }}"  data-toggle="modal" data-target="#exampleModal1" />

                            <!-- Modal -->
                            <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"> User Name : {{$user->fullname}}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body center-block">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <img  src="{{ url('/') }}/upload/kyc/{{ $user->kyc_document }}" style="width: 100%" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal -->
                            <!-- Modal -->
                            <div class="modal fade bd-example-modal-lg" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"> User Name : {{$user->fullname}}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body center-block">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <img  src="{{ url('/') }}/upload/kyc/{{ $user->kyc_document1 }}"  style="width: 100%" />
                                                 </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal -->
                            @endif
                   </div>

                    <br>

                   @if($user->kyc_status == 1)
                      <div class="alert alert-success alert-dismissable">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                           <strong><i class="fa fa-check"></i>&nbsp;Verifield : </strong> Your KYC Document is Verified From Admin.
                         </div>
                    @elseif($user->kyc_status == 2)
                     <div class="alert alert-danger alert-dismissable">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                           <strong><i class="fa fa-times"></i>&nbsp;Not-Verifield : </strong> Your KYC Document is Not Verified From Admin.
                         </div>
                    @elseif($user->kyc_status == 0)
                     <a href="{{ url('kyc-accept',$user->id) }}"> <button  class="btn btn-grad top-btn top-btn"><i class="fa fa-check"></i>&nbsp;Verify</button> </a>
                            <a href="{{ url('kyc-no-accept',$user->id) }}"><button class="btn btn-grad top-btn top-btn"><i class="fa fa-times"></i>&nbsp;No-Verify</button></a>
                     @else
                    @endif


          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection



