@extends('layouts.master')
<!-- head -->
@section('title')
Kwatt | Withdraw
@endsection


@section('content')

    <div class="container-fluid">
            <div class="col">
                <br/>
                <br/>
                <h2>Withdraw {{ $coin }}</h2>
                <br/>
                <?php $user = Sentinel::getUser(); ?>


                <div class="row">
                    <div class="col-md-4">

                            <div class="card mb-5 col-md-12">
                            <div class="card-header">
                                <?php $temp_bal = strtolower($coin).'_balance'; ?>
                                 <h5 class="text-uppercase">{{ $coin }} Balance : <?php echo number_format($user->$temp_bal,8); ?></h5>
                            </div>

                            <div id="error_msg"></div>
                            <div class="card-body no-padding">
                           <br/>

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

                            <form method="post" action="{{ url('withdraw-post') }}">

                              {{ csrf_field() }}
                             <div class="form-group col-lg-12">
                                    <div class="form-group">
                                        <label class="col-form-label">Enter {{ $coin }} Of Withdraw </label>
                                        <input type="text" id="withdraw_amount" name="withdraw_amount" placeholder="Withdraw Amount" onkeyup="check_balance(this.value)" class="form-control" >
                                    </div>
                             </div>

                             <div class="form-group col-lg-12">
                                    <div class="form-group">
                                        <label  class="col-form-label">  {{ $coin }} Wallet Address </label>
                                        <input type="text" class="form-control" value="@if($coin=='KWATT') {{ $user->erc20_address }} @else @endif"  name="wallet_address" placeholder="{{ $coin }} Wallet Address">
                                    </div>
                             </div>

                             <input type="hidden"  name="coin" value="{{ $coin }}">

                              <div class="form-group col-lg-12">
                                   <button  type="submit" id="Withdraw-btn"  disabled="" class="btn btn-primary btn-sm">Withdraw {{ $coin }}</button>
                              </div>   

                              </form>

                            </div>
                        </div>
                        
                    </div>

                    <div class="col-md-8">

                                <div class="card mb-5 col-md-12">
                                    <div class="card-header">
                                        <h5 class="text-uppercase">Deposits {{ $coin }} History</h5>
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

<script type="text/javascript">
          function check_balance(amount)
          {
             $('#error_msg').html('');
              var amount = $('#withdraw_amount').val();
              var coin="{{ $coin }}";

              if(coin == 'BTC')
              {   var coin_bal = "{{ $user->btc_balance }}";  }
              else if(coin == 'LTC')
              {   var coin_bal = "{{ $user->btc_balance }}";  }
              else if(coin == 'ETH')
              {   var coin_bal = "{{ $user->eth_balance }}";  }
              else if(coin == 'BCH')
              {   var coin_bal = "{{ $user->bch_balance }}";  }
             else if(coin == 'KWATT')
              {   var coin_bal = "{{ $user->kwatt_balance }}";  }
              else
              { }


            if(parseFloat(amount) > parseFloat(coin_bal))
            {
                 $('#error_msg').html("<div class='alert alert-danger'><strong>Not Enough! </strong> Enter USD Amount First.</div>");
                  $("#Withdraw-btn").prop('disabled', true);
            }
            else
            {
                     $("#Withdraw-btn").prop('disabled', false);
            }

          }
</script>
@endsection  