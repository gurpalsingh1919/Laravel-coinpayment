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
                <h2>Buy Kwatt History</h2>
                <br/>

                <div class="row">
                   
                    <div class="col-md-12">

                                <div class="card mb-5 col-md-12">
                                    <div class="card-header">
                                        <h5 class="text-uppercase">Buy Coin History</h5>
                                    </div>
                                    <div class="card-body no-padding">
                                   <br/>
                                            <table id="ico-table" class="display responsive nowrap" width="100%">
                                                <thead>
                                                     <th>Sr.</th> 
                                                     <th>Withdraw Amount</th> 
                                                     <th>Wallet Address</th>
                                                     <th>Status</th> 
                                                  
                                                    </thead>

                                                    <tbody>
                                                        <?php $i=1; ?>
                                                          @foreach($withdraw_data as $key)
                                                          <tr>
                                                            <td>{{ $i++ }}</td>
                                                            <td>{{ $key->amount }} &nbsp; {{ $key->coin }}</td>
                                                            <td>{{ $key->coin_address }} </td>
                                                            <td>
                                                              @if($key->status == 0)
                                                               Pending
                                                              @elseif($key->status == 1)
                                                                Success
                                                              @elseif($key->status == 2)
                                                         Cancel
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