@extends('layouts.master')
<!-- head -->
@section('title')
Kwatt | ICO Information
@endsection


@section('content')

    <div class="container-fluid">
            <div class="col">
                <br/>
                <br/>
                <h2>ICO Information</h2>
                <br/>
                <?php $user = Sentinel::getUser(); ?>

                      <div class="row balance-main">
                        <div class="mb-5 col-lg-2 col-md-6">
                            <div class="inner-bg d-flex justify-content-end">
                                <div class="icon mr-auto "><img src="{{ url('/') }}/back/images/dashboard-icon1.png" /></div>
                                <div class="text-right">
                                    <h4><?php echo number_format($user->kwatt_balance,6); ?></h4>
                                    <h4 class="blue">Kwatt</h4>
                                </div>
                            </div>
                        </div>
                       
                        <div class="mb-5 col-lg-2 col-md-6">
                            <div class="inner-bg d-flex justify-content-end ">
                                <div class="icon mr-auto "><i class="fab fa-ethereum"></i></div>
                                <div class="text-right">
                                    <h4><?php echo number_format($user->eth_balance,6); ?></h4>
                                    <h4 class="blue">ETH</h4>
                                </div>
                            </div>
                        </div>
                        <div class="mb-5 col-lg-2 col-md-6">
                            <div class="inner-bg d-flex justify-content-end ">
                                <div class="icon mr-auto "><i class="fab fa-btc"></i></div>
                                <div class="text-right">
                                    <h4><?php echo number_format($user->btc_balance,6); ?></h4>
                                    <h4 class="blue">BTC</h4>
                                </div>
                            </div>
                        </div>
                        <div class="mb-5 col-lg-2 col-md-6">
                            <div class="inner-bg d-flex justify-content-end ">
                                <div class="icon mr-auto "><i class="fab fa-btc"></i></div>
                                <div class="text-right">
                                    <h4><?php echo number_format($user->ltc_balance,6); ?></h4>
                                    <h4 class="blue">LTC</h4>
                                </div>
                            </div>
                        </div>
                        <div class="mb-5 col-lg-2 col-md-6">
                            <div class="inner-bg d-flex justify-content-end ">
                                <div class="icon mr-auto "><i class="fab fa-btc"></i></div>
                                <div class="text-right">
                                    <h4><?php echo number_format($user->bch_balance,6); ?></h4>
                                    <h4 class="blue">BCH</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                <div class="row">
                    <div class="col-md-12">
                                <div class="card mb-5 col-md-12">
                                    <div class="card-header">
                                        <h5 class="text-uppercase">ICO Information</h5>
                                    </div>
                                    <div class="card-body no-padding">
                                   <br/>
                                            <table id="ico-table" class="display responsive nowrap" width="100%">
                                                <thead>
                                                     <td>Sr.</td>
                                                     <td>Bonus</td>
                                                     <td>Buy Limit</td>
                                                    </thead>

                                                    <tbody>
                                                        <?php $i=1; ?>
                                                        @foreach($rate_data as $key)
                                                        <tr>
                                                          <td>{{ $i++ }}</td>
                                                          <td>{{  $key->bonus }}</td>
                                                          <td>{{  $key->kwatt_limit }} KWATT</td>
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