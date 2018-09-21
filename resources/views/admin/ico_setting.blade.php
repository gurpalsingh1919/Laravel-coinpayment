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
                        <div class="col">
                           
                           
                            <div class="card mb-5">
                                <div class="card-header d-flex justify-content-between">
                                    <h4>ICO Settings</h4><!-- <div class="card-header"> -->
                            
                            <a class="btn-sm btn btn-primary" href="{{url('/ico-add')}}" >Add KWATT</a>
                      <!--   </div> -->
                                </div>
                                  <div class="card mb-5">
                        
                        <div class="card-body no-padding">
                            <br/>
                            <div class="col">
                                <table id="ico-table" class="display responsive nowrap" width="100%">
                                    <thead>
                                        <th>Sr.</th>
                                        <th>ICO Start Date</th>
                                        <th>ICO End Date</th>
                                        <th>Total Coins</th>
                                        <th>Sold Coin</th>
                                        <th>Token Rate</th>
                                        <th>Referal Bonus</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                           <td>{{$setting->id}}</td>
                                        
                                            <td>{{$setting->ico_start_date}}</td>
                                            <td>{{$setting->ico_end_date}}</td>
                                            <td>{{$setting->total_coins}}</td>
                                            <td>{{$setting->sold_coins}}</td>
                                            <td>{{$setting->usd_rate}} $</td>
                                            <td>{{ $setting->referal_bonus }} %</td>
                                            <td>
                                                <div class="btn-group congs-custom">
                                                    <!-- <a class="" href="{{url('/ico-edit')}}" id="edit">
                                                        <i class="fas fa-edit"></i> 
                                                      </a> -->
                                                </div>
                                            </td>
                                        </tr>
                                      
                                      
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