@extends('layouts.master')
<!-- head -->
@section('title')
Kwatt Coin
@endsection


@section('content')

    <div class="container-fluid">
        <div class="col">
            <div class="col">
                <!-- <br/>
                <br/>
                <h2>Manage User</h2>-->
                <br/>
                <br/> 
                <div class="card mb-5">
                    <div class="card-header">
                        <h5 class="text-uppercase">Manage Users</h5>
                    </div>
                    <div class="card-body no-padding">
                        <br/>
                        <div class="col">
                            <table id="ico-table" class="display responsive nowrap" width="100%">
                                <thead>
                                <th>Sr.</th><!-- <th>kycdetails</th> -->
                                <th>Name</th>
                                <th>Email</th>
                               
                                <th>KWATT</th>
                               
                                <th>KYC Status</th>
                                <th>Status</th>
                                <th>Action</th>

                                </thead>
                                <tbody>

                                @foreach($users as $key)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <!-- <td>{{$key->kycdetail}}</td> -->
                                    <td>{{$key->fullname}}</td>
                                    <td>{{$key->email}}</td>
                                   
                                   <!--  <td>{{$key->btc_balance}}</td>
                                    <td>{{$key->eth_balance}}</td>
                                    <td>{{$key->ltc_balance}}</td>
                                    <td>{{$key->bch_balance}}</td>  -->
                                    <td>{{$key->kwatt_balance}}</td>
                                    <!-- <td>{{$key->usd_balance}}</td> -->
                                    <!--  <td>{{$key->company or '-'}}</td>
                                    <td>{{$key->city or '-'}}</td> -->
                                    <td>
                                        @if($key->kyc_status == 0)
                                            <i class="fa fa-circle-o-notch"></i>&nbsp;Pending
                                        @elseif($key->kyc_status == 1 || $key->kyc_status == 2)
                                            <i class="fa fa-check"></i>&nbsp;Verified
                                       
                                        @endif
                                        <!-- <a href="{{ url('admin-kyc',$key->id) }}"><button class="btn btn-info" ><i class="fa fa-eye"></i>&nbsp;KYC</button></a> -->
                                    </td>
                                    <td>
                                        @if($key->status == 1)
                                        <span class="badge badge-success">Active</span>
                                        @elseif($key->status == 0)
                                        <span class="badge badge-danger">Block</span>
                                            @endif

                                    </td>
                                    <td>
                                        <div class="btn-group congs-custom">
                                            <a class="" href="https://example.com" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-cog"></i>
                                            </a>
                                            <div class="dropdown-menu">
                                                @if($key->status == 1)
                                                <a class="dropdown-item" href="{{url('admin-user-list-status').'/'.$key->id.'/0'}}"><i class="fas fa-ban"></i> Block</a>
                                                @elseif($key->status == 0)
                                                <a class="dropdown-item" href="{{url('admin-user-list-status').'/'.$key->id.'/1'}}"><i class="fas fa-ban"></i> Active</a>
                                                @endif
                                            </div>
                                        </div>
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
    <!-- end:: Page -->
    <!-- begin::Quick Nav -->
    <!--begin::Base Scripts -->
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