@extends('layouts.master')
<!-- head -->
@section('title')
Kwatt coin
@endsection


@section('content')

<div class="container-fluid">
  <div class="col">
    <div class="">
      <br/>
      <br/>
      <div class="justify-content-md-center ">
        <div class="card mb-5 col-lg-12">
          <div id="dashboard" class="card-header pl-0">
            <h5 class="text-uppercase m-0" align="center" >Welcome to your KWATT Wallet! You can now purchase KWATTS below. 
            </h5>
            <?php $user = Sentinel::getUser();?>
            <?php $bonus = 5;?>
          </div>
            <br/>
          <div class="d-none"><button class="popup_show btn btn-sm btn-primary">show popup</button>
          </div>
      <div class="card-body pl-0">
      <div class="row justify-content-md-center">
      <div class="col-lg-11">
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


      <div class="row">
        <div class="col-md-7 kewatmd">
          <div class="row">
            <div class="col-md-10">
              <label>SELECT CURRENCY</label>
              <select name="select-currency" class="form-control" style="font-family:'FontAwesome', arial;">
                <!--  <option class="dropdown-item-paypal" value="">Select Currency</option> -->
                <option id="paypal-item" class="dropdown-item-paypal" value="USD"><i class="fas fa-dollar-sign"></i> PayPal (USD)</option>
                <option class="dropdown-item" value="BTC"><i class="fab fa-btc" aria-hidden="true"></i> BTC</option>
                <option class="dropdown-item" value="ETH"><i class="fab fa-ethereum"></i> ETH</option>
                <option class="dropdown-item" value="LTC">LTC</option>
                <option class="dropdown-item" value="BCH"><i class="fab fa-bitcoin"></i> BCH</option>
                            
            </select>


            </div>
          <div class="col-md-10 etherium" style="">
          <label>ETH</label>
          <div class="custom-icon input-group mb-3">
          <span class="">
            <i class="fab fa-ethereum"></i>
          </span>
          <input type="number" class="form-control" id="eth_amount" name="eth_amount" value="" onkeyup="kwatt_balance(this.value,3)" placeholder="ETH Amount" autocomplete="off">
        </div>
        </div>
        <div class="col-md-10 bitcoin">
          <label>BTC</label>
        <div class="input-group custom-icon mb-3">
          <span><i class="fab fa-btc"></i></span>
          <input type="number" class="form-control" id="btc_amount" name="btc_amount" value="" onkeyup="kwatt_balance(this.value,4)" placeholder="BTC Amount" autocomplete="off">
        </div>
        </div>
        
        <div class="col-md-10 bitcoincash">
          <label>BCH</label>
        <div class="custom-icon input-group mb-3">
          <span><i class="fab fa-bitcoin"></i></span>
          <input type="number" class="form-control" id="bhc_amount" name="bhc_amount" value="" onkeyup="kwatt_balance(this.value,5)" placeholder="BCH Amount" autocomplete="off">
        </div>
        </div>
        <div class="col-md-10 litcoin">
          <label>LTC</label>
        <div class="input-group custom-icon mb-3">
            <span><img src="{{ url('/') }}/back/images/ltc-small.png"></span>
          <input type="number" class="form-control" id="ltc_amount" name="ltc_amount" value="" onkeyup="kwatt_balance(this.value,6)" placeholder="LTC Amount" autocomplete="off">
        </div>
        </div>

        <div class="col-md-10 paypal">
            <label>USD</label>
            <div class="custom-icon input-group">
            <span> <i class="fas fa-dollar-sign"></i></span>
            <input type="number" class="form-control" id="usd_amount" name="usd_amount" value="" onkeyup="kwatt_balance(this.value,2)" placeholder="USD Amount" autocomplete="off">
        </div>
        </div>
        <div class="col-md-10">
          <label>KWATTS</label>
         <div class="custom-icon input-group mb-3">
          <span><img src="{{ url('/') }}/back/images/kwatt.png"></span>
          <input type="text" class="form-control kwatt_amount" name="kwatt_amount" id="kwatt_amount" onkeyup="kwatt_balance(this.value,1)" placeholder="KWATTS Amount" autocomplete="off">
        </div>
        </div>
        
        <div class="col-md-10">
          
           <button  class="btn btn-primary btn-sm text-uppercase col-md-12" id="buy-item" >Buy KWATT</button>
        </div>
        </div>

        

       
          
          <br/>
        </div>
        <div class="col-md-5">
          <div class="custom-inline-form">
            <ul >
            <li class="d-flex justify-content-between mb-3">
              <label class="col-form-label">Coin Price</label>
              <span id="price">0</span>
            </li>
            <li class="d-flex justify-content-between mb-3">
              <label class="col-form-label"> Number of Coins</label>

              <span class="nu_coin">0</span>

            </li>
            <li class="d-flex justify-content-between mb-3">
              <label class="col-form-label"> Bonus % <!-- <i class="fas fa-info-circle tip" data-tip="tip-first"></i> --></label>
              <span id="bonus_now" class="percentage">0</span>
            </li>
            <li class="d-flex justify-content-between mb-3">
              <label class="col-form-label">Bonus Coins</label>
              <span id="bonus_amount">0</span>
            </li>
            <hr>
            <li class="d-flex justify-content-between mb-3">
              <label class="col-form-label">Total Coins</label>
              <span id="total_amount">0</span>
            </li>
            </ul>
          </div>
      </div>
    </div>
  </div>
</div>
<form id="usd-form-user" action="{{ url('/postpaypal') }}" method="POST" name="paypalform">
           {{ csrf_field() }}
<input type="hidden" name="kwatt_amounts" id="kwatt_amounts" >
</form>
 <!-- Script logic for KWatt Amount -->
<script type="text/javascript">
$('.etherium').hide();
$('.bitcoin').hide();
$('.bitcoincash').hide();
$('.litcoin').hide();
$('.paypal').show();
//$('.bitcoin').hide();
  $('select[name=select-currency]').change(function() {
    //alert($(this).val());
    var currency=$(this).val();
    if(currency=='ETH')
    {
        $('.etherium').show();
        $('.bitcoin').hide();
        $('.bitcoincash').hide();
        $('.litcoin').hide();
        $('.paypal').hide();
    }
    else if(currency=='BTC')
    {
        $('.bitcoin').show();
        $('.etherium').hide();
        $('.bitcoincash').hide();
        $('.litcoin').hide();
        $('.paypal').hide();
    }
    else if(currency=='LTC')
    {
        $('.litcoin').show();
        $('.bitcoin').hide();
        $('.etherium').hide();
        $('.bitcoincash').hide();
        $('.paypal').hide();
    }
    else if(currency=='BCH')
    {
        $('.bitcoincash').show();
        $('.litcoin').hide();
        $('.bitcoin').hide();
        $('.etherium').hide();
        $('.paypal').hide();
    }
    else if(currency=='USD')
    {
        $('.bitcoincash').hide();
        $('.litcoin').hide();
        $('.bitcoin').hide();
        $('.etherium').hide();
        $('.paypal').show();
    }

});
function convertor(value,fct1,fct2,fct3,fct4,fct5,fct6,n)
{
  //console.log(value);

  $('#kwatt_amount').val(value * fct1);
  if(n!=2){
    $('#usd_amount').val(value * fct2);
  }
  if(n!=3)
  {
    $('#eth_amount').val(value * fct3);
  }
  if(n!=4)
  {
    $('#btc_amount').val(value * fct4);
  }
  if(n!=5)
  {
    $('#bhc_amount').val(value * fct5);
  }
  if(n!=6)
  {
     $('#ltc_amount').val(value * fct6);
  }


}
  function kwatt_balance(l,n)
  {

      var kwatt_val = l;
      var BTC = $('#btc_amount').val();
      var LTC = $('#ltc_amount').val();
      var ETH = $('#eth_amount').val();
      var BCH = $('#bhc_amount').val();
      var USD = $('#usd_amount').val();

      /******************* Get USD Rate *******************/
      var usd_rate = "{{ $setting->usd_rate }}";

      btc_amount="{{ $setting->btc_price }}";
      //btc_balance= "{{ $user->btc_balance }}";

      ltc_amount="{{ $setting->ltc_price }}";
      //ltc_balance= "{{ $user->ltc_balance }}";

      eth_amount="{{ $setting->eth_price }}";
      //eth_balance= "{{ $user->eth_balance }}";

      bhc_amount="{{ $setting->bch_price }}";
      //bch_balance= "{{ $user->bch_balance }}";

      usd_amount="{{ $setting->usd_price }}";
      //usd_balance= "{{ $user->usd_balance }}";

      if(n==1)
      {
        $('#kwatt_amount').val(parseFloat(l));
      }
      else if(n==2)
      {
        $('#kwatt_amount').val(parseFloat(USD * usd_amount/usd_rate));
      }
      else if(n==3)
      {
        $('#kwatt_amount').val(parseFloat(ETH * eth_amount/usd_rate));
      }
      else if(n==4)
      {
        $('#kwatt_amount').val(parseFloat(BTC * btc_amount/usd_rate));
      }
      else if(n==5)
      {
        $('#kwatt_amount').val(parseFloat(BCH * bhc_amount/usd_rate));
      }
      else if(n==6)
      {
        $('#kwatt_amount').val(parseFloat(LTC * ltc_amount/usd_rate));
      }

  convertor($('#kwatt_amount').val(),1, usd_rate/usd_amount, usd_rate/eth_amount, usd_rate/btc_amount, usd_rate/bhc_amount,usd_rate/ltc_amount,n);
  var KWT = $('#kwatt_amount').val();
  var temp_balance='';
      $.ajax({
      type: 'POST',
      url: "{{url('get_bonus')}}",

      data: { now_kwatt:KWT,_token:"{{csrf_token()}}" },
      success:  function(response)
      {
    //  console.log(response);
        $('#bonus_now').val(response);
        var bonus=response;
        //console.log(bonus);
          //console.log(KWT);
          var temp_bonus = (parseFloat(KWT) * parseFloat(bonus)) / 100;
          var with_bonus = (parseFloat(KWT) + parseFloat(temp_bonus));
          var total=with_bonus.toFixed(6);
          var coin_value=temp_bonus.toFixed(6);
          var kwtamt=parseFloat(KWT).toFixed(6);
              $('.nu_coin').html(kwtamt);
              $('.percentage').html(bonus); //for bonus percentage
              $('#price').html(usd_rate);  //for price in usd
              $('#bonus_amount').html(coin_value); //for bonus amount
              $('#total_amount').html(total); //total bounus with percentage

              if(parseFloat($('#btc_amount').val()) > parseFloat(temp_balance))
              {
                $('#message').html("<div class='alert alert-danger'><strong>No Enough! </strong> You have No Suffifient Balance To Buy KWATT.</div>");
              //$("#buy-btn").prop('disabled', true);
              }

               }
              });

              }

         </script>

 </div>
    </div>
        </div>

<div id="withdrawl" class="tip-content  mb-5 ">
 <div class="card">
      <div class="card-header"><h5>WITHDRAW KWATT</h5> </div>

      <div class="card-body pl-0">
       
        <div class="col">
          <div class="alert alert-success alert-dismissable">
        
         Please enter your Myetherwallet, Parity or Metamask wallet address in order to successfully withdraw KWATTs. Also, please allow up to 24 hours for request to be processed.
       </div>
          <div class="row">
             
          <div class="col-md-6">
          <div class="form-group">
            <label>Enter Valid Address</label>
            <input type="text" class="form-control" id="withaddress" name="withaddress" value="">
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label>&nbsp;</label><br/>
            <button class="btn btn-sm btn-primary" id="withdrawlkwatt" type="submit">Submit</button>
          </div>
        </div>

        </div>
        </div>
      </div>
 
</div>
</div>
  <div id="buy-coin-list" class="card mb-5">
                        <div class="card-header">
                            <h5 class="text-uppercase">Transaction History</h5>
                        </div>
                        <div class="card-body no-padding">
                            <br/>
                            <div class="col">
                                <table id="ico-table" class="display responsive nowrap" width="100%">
                                   <thead>
                                    <td>Sr.</td>
                                    <th>KWATT</th>
                                    <th>Coin Type</th>
                                    <th>Txn type</th>
                                    <th>Coin Amount</th>
                                    <th>Status</th>
                                    <th>Address</th>
                                    <th>Transaction Id</th>

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
                                             @if($key->status ==-1)
                                             <span class="badge badge-danger">Cancelled / Timed Out</span>
                                             
                                              @elseif($key->status ==100)
                                              <span class="badge badge-success">Success</span>
                                              @else
                                               <span class="badge badge-warning">Pending </span>
                                              @endif
                                            </td>
                                            <td>{{  $key->address }}</td>
                                            <td>{{  $key->tx_id }}</td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                                <br/>
                                <br/>
                            </div>
                        </div>
                    </div>


                @if(Sentinel::getUser()->roles()->first()->slug != 'admin')
                    <div id="user-referral" class="card mb-5">
                      <div class="card-header">
                          <h5 class="text-uppercase">User referral link</h5>
                      </div>
                      <div class="card-body no-padding mt-4">
                        <div class="col-lg-6">
                          <form class="form-copy theme-form">
                            <div class="form-group">
                              <div class="input-group">
                                <input type="text" class="form-control" id="share-shortlink" value="{{url('aff')}}?ref={{ Sentinel::getuser()->ref_token }}">
                                <span class="input-group-btn">
                                  <button class="btn btn-secondary" id="copy-button" data-clipboard-target="#share-shortlink" type="button" onclick="copysharetext()" >copy</button>
                                </span>
                              </div>
                            </div>
                          </form>
                          <p class="bouns-note">Get bonus by referring new members.</p>
                        </div>
                      </div>
                    </div>

                    @endif
                </div>
                <div id="buy-coin-list" class="card mb-5">
                  <div class="card-header">
                    <div class="kwatt_dev">
                <p><span><i class="fas fa-info-circle"></i></span>KWATT is our token symbol and the token name is FRNCoin </p>
                    </div>
                      

                      <div class="weaccept">
                      <h4>We accept:</h4>
                      <ul>
                  <li><img src="{{ url('/') }}/assets/images/coin/eths.png"></li>
                  <li><img src="{{ url('/') }}/assets/images/coin/bch.png"></li>
                  <li><img src="{{ url('/') }}/assets/images/coin/ltc.png"></li>
                  <li><img src="{{ url('/') }}/assets/images/coin/usd.png"></li>
                  <li><img src="{{ url('/') }}/assets/images/coin/btcs.png"></li>

                      </ul>
                   </div>

                  </div>
                   
                </div>
            </div>
        </div>

<div id="welcomemessage" class="modal modal-styled fade in modals-body">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
            <div class="logged_succcefuly">
             <span id="succfl_chck"><img src="{{ url('/') }}/assets/images/check.png" width="20" height="20"></span>
              <h4 class="text-center w-100">Application WalkThrough  <!--{{Sentinel::getUser()->fullname}}--></h4>

              <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">×</span>
                <span class="sr-only">Close</span>
              </button>




              </div>
            </div>

            <form id="gauth-form112" inspfaactive="true"  class="">
              <div class="modal-body theme-form">
                
                <div class="text-center">
                 <div class="support_dev">
                  <p>Welcome to your 4NEW portal. This system has been optimized to perform as your command central when interacting with the 4NEW Blockchain or the KWATT Wallet.

In order to participate in 4NEW’s KWATT Initial Coin Offering please observe the following steps:<br/></p>
<div class="over_view">
<strong>Buy KWATTs:</strong> You can enter the desired amount you wish to purchase with. To the right a calculator will demonstrate the number of KWATTs the desired investment equates to, including the bonuses.Then select Buy KWATT Now. This will generate a unique wallet address for you where you will need to remit the funds in the desired currency type to.

Once funds are received at the wallet address, your KWATT balance will update in the top left panel including your respective bonuses.
</div>
<div class="over_view">
<strong>Withdraw:</strong> You can withdraw your KWATTs to your myetherwallet, parity wallet or metamask wallet address after the ICO is completed. This feature will be activated on June 1st, 2018.

Please note that 4NEW will not be responsible for any security breaches that occur in external wallets that are not hosted, managed or supervised by 4NEW Limited.
</div>
<div class="over_view">
<strong>Transactions:</strong> Here you will be able to view, monitor and track all past transactions that you conducted.
Please note for historical transactions performed prior to the launch of this system, upon KYC completion historical transactional records will be automatically updated.
</div>
<div class="over_view">
<strong>Referrals:</strong> You can generate a unique referral link that can be shared with your friends, family and members within your network. Any KWATT purchased using this link by members within your network will automatically credit your wallet with the appropriate number of bonus KWATTs.
</div>
<div class="over_view">
<strong>Contact Support:</strong> You can submit any support ticket items or contact info forms to the development team for technical support.
</div>
<div class="over_view">
<strong>Settings:</strong> Here you can maintain your personal profile on file.
</div>


</div>
                </div>
              </div>

            </form>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div>





        @if(session('error_code'))
    <script>
    // $(function() {
    //     $('#welcomemessage').modal('show');
    // });
    </script>
    @endif

@endsection


  <script type="text/javascript">
    function copysharetext() {
      var copyText = document.getElementById("share-shortlink");
      //console.log(copyText);
      copyText.select();
      document.execCommand("Copy");
    }
  </script>





