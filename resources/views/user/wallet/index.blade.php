@extends('layouts.master')
<!-- head -->
@section('title')
Kwatt | Wallet
@endsection


@section('content')

    <div class="container-fluid">
            <div class="col">
                <br/>
                <br/>
                <h2>Deposits & Withdrawals</h2>
                <br/>
                <?php $user = Sentinel::getUser(); ?>
               
                <div class="card mb-5 col-md-12">
                    <div class="card-header">
                        <h5 class="text-uppercase">Deposits & Withdrawals</h5>
                    </div>



                    <div class="card-body no-padding">
                        <br/>

                    <div class="col">
                            <table id="ico-table" class="display responsive nowrap" width="100%">
                                <thead>
                                        <th>Coin</th>
                                        <th>Name</th>
                                        <th>Total Balance</th>  
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><img src="{{ url('/') }}/icon/btc.png"  style="height: 30px;width: 30px;"></td>
                                            <td>BTC</td>
                                            <td><?php echo number_format($user->btc_balance,8); ?> BTC</td>
                                            <td><a href="{{ url('/deposit','BTC') }}"><button class="btn-primary btn btn-xs">Deposit</button></a>
                                               <!--  <a href="{{ url('/withdraw','BTC') }}"><button class="btn-default btn btn-xs">Withdraw</button></a> -->
                                            </td>
                                        </tr>
                                       
                                           <tr>
                                            <td><img src="{{ url('/') }}/icon/ltc.png"  style="height: 30px;width: 30px;"></td>
                                            <td>LTC</td>
                                            <td><?php echo number_format($user->ltc_balance,8); ?> LTC</td>
                                            <td>
                                                <a href="{{ url('/deposit','LTC') }}"><button class="btn-primary btn btn-xs">Deposit</button></a>
                                                 <!-- <a href="{{ url('/withdraw','LTC') }}"><button class="btn-default btn btn-xs">Withdraw</button></a> -->
                                             </td>
                                            </tr>

                                           <tr>
                                            <td><img src="{{ url('/') }}/icon/eth.png"  style="height: 30px;width: 30px;"></td>
                                            <td>ETH</td>
                                            <td><?php echo number_format($user->eth_balance,8); ?> ETH</td>
                                            <td>
                                                <a href="{{ url('/deposit','ETH') }}"><button class="btn-primary btn btn-xs">Deposit</button></a>
                                               <!--  <a href="{{ url('/withdraw','ETH') }}"> <button class="btn-default btn btn-xs">Withdraw</button></a> --></td>
                                           </tr>


                                           <tr>
                                            <td><img src="{{ url('/') }}/icon/bch.png"  style="height: 30px;width: 30px;"></td>
                                            <td>BCH</td>
                                            <td><?php echo number_format($user->bch_balance,8); ?> BCH</td>
                                            <td>
                                                <a href="{{ url('/deposit','BCH') }}"><button class="btn-primary btn btn-xs">Deposit</button></a>
                                                <!-- <a href="{{ url('/withdraw','BCH') }}"> <button class="btn-default btn btn-xs">Withdraw</button></a> --></td>
                                          </tr>

                                          <tr>
                                            <td><img src="{{ url('/') }}/back/images/nav-icon1.png"></td>
                                            <td>KWATT</td>
                                            <td><?php echo number_format($user->kwatt_balance,8); ?> KWATT</td>
                                            <td> <a href="{{ url('/withdraw','KWATT') }}"><button class="btn-default btn btn-xs">Withdraw</button></a>
                                                 <!-- <a href="{{ url('/transfer') }}"> <button class="btn-primary btn btn-xs">Transfer</button></a> --></td>
                                          </tr>

                                           <tr>
                                            <td><i class="fas fa-dollar-sign"></i></td>
                                            <td>USD</td>
                                            <td> <?php echo number_format($user->usd_balance,8); ?> USD</td>
                                            <td> <!-- <a href="{{ url('/withdraw','KWATT') }}"><button class="btn-default btn btn-xs">Withdraw</button></a> -->
                                                 <a href="{{ route('paywithpaypal') }}"> <button class="btn-primary btn btn-xs">Deposit</button></a></td>
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




        <div class="container-fluid">
    <div class="col">
        <br/>
        
        <br/>
        <div class="row">                   
            <div class="col-md-12">
                <div class="card mb-5 pt-3 pb-5 col-md-12">
                   

        <div class="tab-content">
                  <div class="tab-pane">
                  </div>
                  <div class="tab-pane active pr-4" >
                    <h5 class="mt-4 text-uppercase">Deposit History</h5>
                    <div class="dropdown-divider"></div>
                    <br/>
                     
                  <table id="ico-table-two" class="display responsive nowrap" width="100%">
                    <thead>
                        <th>Sr.</th>

                        <th>Coin</th> 
                        <th>Amount</th> 
                        <th>Status</th> 
                        <th>Transaction ID</th> 
                        <th>Address</th>
                                       
                    </thead>

                    <tbody>
                        <?php $i=1; ?>
                        @foreach($deposit_data as $key)
                        <tr>
                           <td>{{ $i++ }}</td>
                           <td>{{ $key->coin }}</td>
                           <td><?php echo number_format($key->amount,8); ?> </td>
                            <td>
                              @if($key->status ==0)
                              <span class="badge badge-primary">Pending </span>
                              @elseif($key->status ==100)
                              <span class="badge badge-success">Success</span>
                              @else
                              <span class="badge badge-warning">Cancelled / Timed Out</span>
                              @endif
                            </td>
                           <td>{{ $key->tx_id }}</td>
                           <td>{{ $key->address }}</td>
                           
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
</div>


@endsection  