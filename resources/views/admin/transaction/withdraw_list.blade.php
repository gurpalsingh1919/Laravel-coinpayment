@extends('layouts.master')
<!-- head -->
@section('title')
Kwatt | Buy
@endsection


@section('content')

    <div class="container-fluid">
            <div class="col">
                <br/>
                <br/>
                <!-- <h2>Withdraw Kwatt History</h2>
                <br/> -->

                <div class="row">
                   
                    <div class="col-md-12">

                                <div class="card mb-5 col-md-12">
                                    <div class="card-header">
                                        <h5 class="text-uppercase">Withdraw History</h5>
                                    </div>
                                    <div class="card-body no-padding">
                                   <br/>

                                      @if(session('error'))<br><div class="alert alert-danger">{{ session('error') }}</div><br>@endif
                                       @if(session('success'))<br><div class="alert alert-success">{{ session('success') }}</div><br>@endif

                                            <table id="ico-table" class="display responsive nowrap" width="100%">
                                                <thead>
                                                     <th>Sr.</th> 
                                                     <th>Name</th>
                                                     <th>Email</th>
                                                    <!--  <th>Withdraw Amount</th> -->
                                                     <th>Address</th>
                                                     <th>Date</th>
                                                     <th>Status</th>
                                                     <th>Action</th>
                                                    </thead>

                                                    <tbody>
                                                        <?php $i=1; ?>
                                                          @foreach($withdraw_data as $key)
                                                          <tr>
                                                            <td>{{ $i++ }}</td>
                                                             <td>{{ $key->get_user_info->fullname }}</td>
                                                             <td>{{ $key->get_user_info->email }}</td>
                                                            <!-- <td>{{ $key->amount }}</td> -->
                                                            <td>{{ $key->address }} </td>
                                                              <td>{{  date_format($key->updated_at,"Y-m-d H:i") }}</td>

                                                               <td>
                                             @if($key->status ==-1)
                                             <span class="badge badge-danger">Cancelled / Timed Out</span>
                                             
                                              @elseif($key->status ==100)
                                              <span class="badge badge-success">Success</span>
                                              @else
                                               <span class="badge badge-warning">Pending </span>
                                              
                                              @endif
                                            </td>

                                              <td>
                                              @if($key->status == 0)
                                              <a href="{{ url('withdraw-accept',$key->id) }}"><button class="btn btn-success">Approve</button></a>
                                               <a href="{{ url('withdraw-reject',$key->id) }}"><button class="btn btn-danger">Reject</button></a>
                                              @elseif($key->status == -1)
                                                Cancel
                                              @elseif($key->status == 100)
                                                Success
                                              @else
                                              @endif
                                            </td>


                                                          </tr>
                                                          @endforeach
                                                      
                                                    </tbody>
                                            </table>
                                    </div>
                                </div>
                    </div>
                </div>
            </div>
        </div>


@endsection  