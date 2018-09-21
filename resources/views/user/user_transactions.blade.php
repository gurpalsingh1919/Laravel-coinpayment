@extends('layouts.master')
@section('title') Transactions @endsection
@section('style')
@endsection
@section('content')

<div class="container-fluid">
    <div class="col"><br/><br/>
      <!-- <div class="row"> -->

<div id="buy-coin-list" class="card mb-5">
  <div class="card-header">
      <h5 class="text-uppercase">Transaction History</h5>
  </div>
  <div class="card-body no-padding">
      <br/>


      <div class="col">
        <div class="alert alert-success">

      <!-- <marquee behavior="alternate" direction="right" scrollamount="4"> --><h4 class="text-uppercase m-0" align="center"><strong>Total KWATTS : {{Sentinel::getUser()->kwatt_balance}}</strong></h4><!-- </marquee> -->

    </div>
    <br/>
          <table id="ico-table" class="display responsive nowrap" width="100%">
             <thead>
              <td>Sr.</td>
              <th>KWATT</th>
              <th>Coin Type</th>
              <th>Txn type</th>
              <th>Coin Amount</th>
              <th>Status</th>
              <th>Address</th>
              <th>Payment address</th>
               <th>Time</th>
             <!--  <th>Transaction Id</th> -->

              </thead>

              <tbody>
              <?php $i = 1;?>
              @foreach($buy_data as $key)
                  <tr>
                      <td>{{ $i++ }}</td>
                      <td>{{  $key->no_of_kwatt }}</td>
                      <td>{{  $key->type }}</td>
                      <td>
                        @if($key->txn_type==1)
                        {{  'Added' }}
                        @elseif($key->txn_type==2)
                        {{  'Buy' }}
                        @elseif($key->txn_type==3)
                        {{  'Withdraw' }}
                        @elseif($key->txn_type==4)
                        {{  'Bonus' }}
                        @elseif($key->txn_type==5)
                        {{  'Removed' }}
                        @endif


                      </td>
                      @if($key->coin_amount=='0')
                      <td><span class="badge badge-success">Commission</span></td>
                      @else
                      <td>{{  $key->coin_amount }}</td>
                      @endif
                      <td>
                       @if($key->status ==100)
                        <span class="badge badge-success">Paid</span>
                        @elseif($key->status == -1)


                        <span class="badge badge-danger">expired </span>

                        @else
                         <span class="badge badge-warning">Pending </span>
                        @endif
                      </td>
                      <td>{{  $key->address }}</td>
                      <td>{{  $key->payment_id }}</td>
                      <td>{{  $key->created_at }}</td>
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
<!-- </div> -->



@endsection





