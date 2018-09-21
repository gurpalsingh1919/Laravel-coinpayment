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
                        <h5 class="text-uppercase">Users KYC</h5>
                    </div>
                    <div class="card-body no-padding">
                        <br/>
                        <div class="col">
                            <table id="ico-table" class="display responsive nowrap" width="100%">
                                <thead>
                                <th>Sr.</th><!-- <th>kycdetails</th> -->
                                <th>Name</th>
                                <th>Email</th>
                                <th>KYC Status</th>
                                <th>information</th>
                                </thead>
                                <tbody>

                                @foreach($users as $key)
                                @if($key->kyc_status == 2)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$key->first_name}}</td>
                                    <td>{{$key->email}}</td>
                                    <td>
                                        @if($key->kyc_status == 2)
                                            <i class="fa fa-circle-o-notch"></i>&nbsp;register
                                        @endif
                                    </td>
                                    <td><a href="{{ url('/kyc_details') }}/{{$key->id}}"><input type="button" value="Details" class="btn btn-primary btn-xs"></a></td>
                                </tr>
                                @endif
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