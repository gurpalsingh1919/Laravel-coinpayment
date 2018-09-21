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
                <h2>Buy KWATTs</h2>
                <br/>
                <?php $user = Sentinel::getUser(); ?>

              <?php  $bonus = 5; ?>
                  
                <div class="row">
                    <div class="col-md-4">
                            <div class="card mb-5 col-md-12">
                              <div class="card-header">
                                 <h5 class="text-uppercase"> 
                                  Kwatt Balance : <?php echo number_format($user->kwatt_balance,6); ?>

                                 </h5>
                            </div>
                            <p id="currency_rate"> 
                            </p>
                      @if(session('error')) 
                        <div class="alert alert-danger alert-dismissable">
                       <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                       <strong>Error : </strong>   {{ session('error') }}
                     </div>@endif

                       @if(session('success')) 
                            <div class="alert alert-success alert-dismissable">
                       <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                       <strong>Success : </strong>   {{ session('success') }}
                     </div>@endif

                            <div class="card-body no-padding" >
                            <br/>

                            <div id="message"></div>

                            <form method="post" action="{{ url('store-ico') }}">
                              {{ csrf_field() }}

                             <div class="form-group col-lg-12">
                                    <div class="form-group">
                                        <label  class="col-form-label"> Select Coin </label>
                                       <select class="form-control" onchange="check_balance()" name="coin_name" id="coin_name">
                                          <option value="BTC">BTC</option>
                                          <option value="LTC">LTC</option>
                                          <option value="ETH">ETH</option>
                                          <option value="BCH">BCH</option>
                                          <option value="USD">USD</option>
                                       </select>
                                    </div>
                             </div>
                          
                             <div class="form-group col-lg-12">
                                    <div class="form-group">
                                        <label  class="col-form-label"> KWATT Amount </label>
                                        <input type="text" class="form-control" onkeyup="check_balance(this.value)" name="kwatt_amount"  id="kwatt_amount"  placeholder="KWATT Amount">
                                        <span class=" text-danger">{{ $errors->first('kwatt_amount') }}</span>
                     <br/> 
                                    </div>
                             </div>
                                <div class="form-group col-lg-12">
                                    <div class="form-group">
                                        <label  class="col-form-label"> Coin Amount </label>
                                        <input type="text" class="form-control" readonly=""  id="coin_amount" name="coin_amount"  placeholder="Coin Amount">
                                    </div>
                             </div>

                              <div class="form-group col-lg-12">
                                    <div class="form-group">
                                        <label  class="col-form-label"> Bonus (%) </label>
                                        <input type="text" class="form-control" name="bonus_now"  readonly="" id="bonus_now"  placeholder="Bonus Now">
                                    </div>
                             </div>


                               <div class="form-group col-lg-12">
                                    <div class="form-group">
                                        <label  class="col-form-label"> Bonus Amount </label>
                                        <input type="text" class="form-control"  readonly="" id="bonus_amount" name="bonus_amount"  placeholder="Bonus Amount">
                                    </div>
                             </div>
                                <div class="form-group col-lg-12">
                                    <div class="form-group">
                                        <label  class="col-form-label">Total Amount : </label>
                                        <input type="text" class="form-control"  id="total_amount"  name="total_amount"  placeholder="Total Amount">
                                    </div>
                             </div>
                              <div class="form-group col-lg-12">
                                   <button type="submit" class="btn btn-primary btn-sm" id="buy-btn">Buy Kwatt </button>
                              </div>   

                              </form>
                            </div>
                        </div>
                        
                    </div>

                    <div class="col-md-8">

                                <div class="card mb-5 col-md-12">
                                    <div class="card-header">
                                        <h5 class="text-uppercase">Buy Coin History</h5>
                                    </div>
                                    <div class="card-body no-padding">
                                   <br/>
                                            <table id="ico-table" class="display responsive nowrap" width="100%">
                                                <thead>
                                                     <td>Sr.</td>
                                                     <th>Token</th>      
                                                     <th>Coin</th>
                                                     <th>Coin Amount</th>   
                                                    </thead>

                                                    <tbody>
                                                        <?php $i=1; ?>
                                                        @foreach($buy_data as $key)
                                                        <tr>
                                                          <td>{{ $i++ }}</td>
                                                          <td>{{  $key->token }}</td>
                                                          <td>{{  $key->type }}</td>
                                                          @if($key->ico_amount=='0')
                                                          <td><span class="badge badge-success">Commission</span></td>
                                                          @else
                                                          <td>{{  $key->ico_amount }}</td>
                                                          @endif
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

        <input type="hidden" id="dummy_bonus" name="">

        <script type="text/javascript">

          function  check_balance() 
          {
            var coin = $('#coin_name').val();
            if(coin=='USD')
            {
              var rate_currency='<?php echo 'USD Balance :'. number_format($user->usd_balance,6); ?>';
              $('#currency_rate').html(rate_currency);
            }
            else if(coin=='BTC')
            {
               var rate_currency='<?php echo 'BTC Balance :'. number_format($user->btc_balance,6); ?>';
              $('#currency_rate').html(rate_currency);
            }
            else if(coin=='LTC')
            {
               var rate_currency='<?php echo 'LTC Balance :'. number_format($user->ltc_balance,6); ?>';
              $('#currency_rate').html(rate_currency);
            }
            else if(coin=='BCH')
            {
               var rate_currency='<?php echo 'BCH Balance :'. number_format($user->bch_balance,6); ?>';
              $('#currency_rate').html(rate_currency);
            }
            else if(coin=='ETH')
            {
               var rate_currency='<?php echo 'ETH Balance :'. number_format($user->eth_balance,6); ?>';
              $('#currency_rate').html(rate_currency);
            }
            else
            {
              $('#currency_rate').html();
            }           
                var kwatt_val = $('#kwatt_amount').val();
                var temp_balance='';
                var coin_bal_check = coin.toLowerCase()+'_balance';
              
                    $.ajax({
                      type: 'POST',
                      url: "{{url('get_bonus')}}",
                      data: { now_kwatt:kwatt_val,_token:"{{csrf_token()}}" },
                      success:  function(response)
                      {
                            console.log(response);
                           $('#bonus_now').val(response);
                         
                               var usd_rate = "{{ $setting->usd_rate }}";
                               var bonus = $('#bonus_now').val();
                               var coin_amount = 0;

                               if(coin == 'BTC')
                               {   coin_amount="{{ $setting->btc_price }}"; 
                                   temp_balance= "{{ $user->btc_balance }}";
                               }
                               else if(coin == 'LTC')
                               {   
                                 coin_amount="{{ $setting->ltc_price }}";  
                                  temp_balance= "{{ $user->ltc_balance }}"; 
                               }
                               else if(coin == 'ETH')
                               {   
                                  coin_amount="{{ $setting->eth_price }}";   
                                  temp_balance= "{{ $user->eth_balance }}";
                               }
                              else if(coin == 'BCH')
                               {   
                                 coin_amount="{{ $setting->bch_price }}";   
                                   temp_balance= "{{ $user->bch_balance }}";
                               }
                               else if(coin == 'USD')
                               {   
                                 coin_amount="{{ $setting->usd_price }}";   
                                   temp_balance= "{{ $user->usd_balance }}";
                               }
                               else
                               {   }

                             var temp = parseFloat(kwatt_val) * parseFloat(usd_rate);
                             var temp1 = parseFloat(temp) / parseFloat(coin_amount);

                            $('#coin_amount').val(temp1);
                            
                            var temp_bonus = parseFloat(kwatt_val) * parseFloat(bonus) / 100;
                            var with_bonus = parseFloat(kwatt_val) + parseFloat(temp_bonus);

                              $('#bonus_amount').val(temp_bonus);
                              $('#total_amount').val(with_bonus);

                      
                              if(parseFloat(temp1) > parseFloat(temp_balance))
                              {
                                 $('#message').html("<div class='alert alert-danger'><strong>No Enough! </strong> You have No Suffifient Balance To Buy KWATT.</div>");
                                  $("#buy-btn").prop('disabled', true);
                              }
                              else
                              {
                                    $('#message').empty();
                                    $("#buy-btn").prop('disabled', false);
                              }

                      }
                    });

          
       


          }
        
        </script>

@endsection  