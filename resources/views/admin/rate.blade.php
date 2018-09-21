@extends('layouts.master')
<!-- head -->
@section('title')
Kwatt Coin
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
                                <div class="alert alert-success">
                                    <strong>Success : </strong>{{ session('success') }}
                                </div>
                            @endif
                            @if(session('error'))
                                <div class="alert alert-danger">
                                    <strong>Error : </strong> {{ session('error') }}
                                </div>
                            @endif  

                        </div>
                        <div class="col">
                            <div class="card mb-5">
                               <!--  <div class="card-header">
                                    <h4>Rate</h4>
                                </div> -->
                                  <div class="card mb-5">
                                      <div class="card-header">
                                          <h5 class="text-uppercase d-flex justify-content-between"><span>Bonus Settings</span> <a href="{{url('rate-add')}}"><span><button type="button" class="btn btn-primary btn-xs "> Add New </button></span></a></h5>
                                      </div>

                        <div class="card-body no-padding">
                            <br/>
                            <div class="col">
                                <table id="ico-table" class="display responsive nowrap" width="100%">
                                    <thead>
                                        <th>Sr.</th>
                                        <th>Bonus</th>
                                        <th>Kwatt Limit</th>
                                        <th>Action</th>
                                        
                                    </thead>
                                    <tbody>
                                    @foreach($rate as $key)
                                        <tr>
                                            <td>{{$loop->iteration}} </td>
                                            <td>{{$key->bonus}} </td>
                                            <td>{{$key->kwatt_limit}}</td>
                                            <td>

                                                @if(in_array($key->status,[0,1]))
                                                    <div class="btn-group congs-custom">
                                                        <a class="" href="{{url('/rate-edit/'.$key->id)}}" id="edit">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    </div>

                                                    <div class="btn-group congs-custom">
                                                        <a class="" href="{{url('/rate-delete/'.$key->id)}}" id="delete">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </a>
                                                    </div>
                                                @endif
                                            </td>
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
        </div>
@endsection  