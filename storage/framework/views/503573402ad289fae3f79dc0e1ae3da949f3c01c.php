<!-- head -->
<?php $__env->startSection('title'); ?> Kwatt Dashboard <?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

<div class="container-fluid">
  <div class="col">
    <div class="">
      <br/>
      <br/>
      <div class="justify-content-md-center ">
        <div class="card mb-5 col-lg-12">
          <div id="dashboard" class="card-header text-center pl-0">
            <h5 class="text-uppercase  m-0" >WELCOME TO YOUR KWATT WALLET!
            </h5>
            <?php $user = Sentinel::getUser();?>
            <?php $bonus = 5;?>
          </div>
            <br/>

      <div class="card-body pl-0">
      <div class="row justify-content-md-center">
        <div class="col-lg-11 mb-3">
          <h5 class="text-uppercase">You can now purchase KWATTs.</h5>
          <div class="small-text-info md-text-info p-3">

           <ul class='pl-3 step_section'>
            <li>
              <div class="stp_bx">STEP 1 -</div>
              <div>Choose your payment method below.</div>
            </li>
           <li>
            <div class="stp_bx">STEP 2 -</div>
            <div>Enter the number of coins in your selected Cryptocurrency that you would like to convert to KWATT tokens</div>
            <!--div>If you would like to buy KWATTs using Paypal, enter the amount in USD.  If you would like to buy KWATTs using Cryptocurrency, enter the number of coins you would like to convert to KWATT tokens.</div-->
          </li>
           <li>
            <div class="stp_bx">STEP 3 -</div>
            <div>Check the conversion chart to ensure you have put in the right amount.</div>
          </li>
           <li>
            <div class="stp_bx">STEP 4 -</div>
            <div>Click the green BUY KWATT button and you will be forwarded to the buy page to complete your transaction. </div>
          </li>
        </ul>

        </div>
      </div>
      <div class="col-lg-11">

         <?php if(session('error')): ?>
          <div class="alert alert-danger alert-dismissable">
         <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
         <strong>Error : </strong>   <?php echo e(session('error')); ?>

       </div><?php endif; ?>

         <?php if(session('success')): ?>
              <div class="alert alert-success alert-dismissable">
         <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
         <strong>Success : </strong>   <?php echo e(session('success')); ?>

       </div><?php endif; ?>


      <div class="row">
        <div class="col-md-7 kewatmd">
          <div class="row">
            <div class="col-md-10">
              <!-- <h5>Please enter your desired amount.</h5> -->
              <label>Choose your payment method</label>
              <!-- <label>SELECT CURRENCY</label> -->
              <select name="select-currency" id="payment-opt" class="form-control" style="font-family:'FontAwesome', arial;">
                <option class="dropdown-item" value="ETH" selected="selected">ETH</option>
                 <option class="dropdown-item" value="BTC"><i class="fab fa-btc" aria-hidden="true"></i> BTC</option>
                <option class="dropdown-item" value="LTC">LTC</option>
                <option class="dropdown-item" value="BCH"><i class="fab fa-bitcoin"></i> BCH</option>
                <option class="dropdown-item" value="credit_card">
                  <i class="fab fa-bitcoin"></i> Credit Card/ Debit Card</option>


            </select>


            </div>
          <div class="col-md-10 etherium" style="">



          <label>How many ETH do you want to convert into Kwatts?</label>
          <div class="custom-icon eth-input-container input-group mb-3">
          <span class="">
            <i class="fab fa-ethereum"></i>
          </span>
          <input type="text" class="form-control" id="eth_amount" name="eth_amount" value="" onkeyup="kwatt_balance(this.value,3)" placeholder="Enter number of ETH" autocomplete="off"><label class="usd-ammount show_usd_amount"></label>

        </div>
        </div>
        <div class="col-md-10 bitcoin">
          <label>How many BTC do you want to convert into Kwatts?</label>
        <div class="custom-icon eth-input-container input-group mb-3">
          <span><i class="fab fa-btc"></i></span>
          <input type="text" class="form-control" id="btc_amount" name="btc_amount" value="" onkeyup="kwatt_balance(this.value,4)" placeholder="Enter number of BTC" autocomplete="off"><label class="usd-ammount show_usd_amount"></label>
        </div>
        </div>

        <div class="col-md-10 bitcoincash">
          <label>How many BCH do you want to convert into Kwatts?</label>
        <div class="custom-icon eth-input-container input-group mb-3">
          <span><i class="fab fa-bitcoin"></i></span>
          <input type="text" class="form-control" id="bhc_amount" name="bhc_amount" value="" onkeyup="kwatt_balance(this.value,5)" placeholder="Enter number of BCH" autocomplete="off"><label class="usd-ammount show_usd_amount"></label>
        </div>
        </div>
        <div class="col-md-10 litcoin">
          <label>How many LTC do you want to convert into Kwatts?</label>
        <div class="custom-icon eth-input-container input-group mb-3">
            <span><img src="<?php echo e(url('/')); ?>/back/images/ltc-small.png"></span>
          <input type="text" class="form-control" id="ltc_amount" name="coin_amount" value="" onkeyup="kwatt_balance(this.value,6)" placeholder="Enter number of LTC" autocomplete="off"><label class="usd-ammount show_usd_amount"></label>
        </div>
        </div>

        <!-- <div class="col-md-10 paypal">
            <label>How many USD do you want to convert into Kwatts?</label>
            <div class="custom-icon input-group">
            <span> <i class="fas fa-dollar-sign"></i></span>
            <input type="text" class="form-control" id="usd_amount" name="usd_amount" value="" onkeyup="kwatt_balance(this.value,2)" placeholder="Enter number of USD" autocomplete="off">
        </div>
        </div> -->
        <div class="col-md-10 credit_card">
            <label>How many USD do you want to convert into Kwatts?</label>
            <div class="custom-icon input-group">
            <span> <i class="fas fa-dollar-sign"></i></span>
            <input type="text" class="form-control" id="usd_amount" name="usd_amount" value="" onkeyup="kwatt_balance(this.value,2)" placeholder="Enter number of USD" autocomplete="off">
        </div>
        </div>

        <div class="col-md-10">
          <label>Converted Kwatts</label>
         <div class="custom-icon input-group mb-3">
          <span><img src="<?php echo e(url('/')); ?>/back/images/kwatt.png"></span>
          <input type="text" class="form-control kwatt_amount" name="kwatt_amount" id="kwatt_amount" onkeyup="kwatt_balance(this.value,1)" value="" placeholder="KWATTS Amount" autocomplete="off">
        </div>
        </div>

        <div class="col-md-10">
          <button  class="btn btn-primary btn-sm text-uppercase col-md-12" id="buy-item" >Buy KWATT</button>

          <div class="mt-3"></div>
        </div>


        </div>





          <br/>
        </div>
        <div class="col-md-5">
           <h5>Total KWATT tokens being purchased</h5>
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
                  <div class="mt-4 text-center">
                    <div class="kwatt_dev">
                       <p><span><i class="fas fa-info-circle"></i></span>KWATT is our token symbol and the token name is FRNCoin </p>
                    </div><br/>
                      <div class="weaccept">
                      <h4>We accept:</h4>
                      <ul>
                  <li><img src="<?php echo e(url('/')); ?>/assets/images/coin/eths.png"></li>
                  <li><img src="<?php echo e(url('/')); ?>/assets/images/coin/bch.png"></li>
                  <li><img src="<?php echo e(url('/')); ?>/assets/images/coin/ltc.png"></li>
                  <li><img src="<?php echo e(url('/')); ?>/assets/images/coin/usd.png"></li>
                  <li><img src="<?php echo e(url('/')); ?>/assets/images/coin/btcs.png"></li>
                      </ul>
                   </div>
                  </div>
      </div>

      <div class="col-lg-11 mb-3">
          <strong>PLEASE NOTE:</strong>
          <div class="small-text-info md-text-info p-3">
            <ul class='pl-3'>
                <li>Purchase transactions initiated but not completed will expire within 30 mins.</li>
                   <li> All returning purchasers must initiate a new transaction using the conversion chart on this page. </li>
                   <!-- <li> If you do not have cryptocurrencies and would like to purchase them, then <a data-toggle="modal" href="#buykwattdashboard" target="_blank" >Watch this video</a> and <a href="https://www.binance.com/" target="_blank">Signup here </a>with Binance. </li> -->
                   <li>If you do not have cryptocurrencies and would like to purchase them, we recommend you to <a href="https://www.coinbase.com/join/5a9ecaf880b2f0058b820ab0" target="_blank">Signup with CoinBase </a> and <a data-toggle="modal" href="#buykwattdashboard" target="_blank" >Watch This Video</a></li>
            </ul>
          </div>
        </div>
    </div>
    </div>
</div>
 <input type="hidden" name="" id="last_transaction_time"
        value="<?php echo e(isset($latest_data->created_at)?$latest_data->created_at : ''); ?>">
<form id="usd-form-user" action="<?php echo e(url('/credit-card-payment')); ?>" method="POST" 
name="paypalform">
           <?php echo e(csrf_field()); ?>

<input type="hidden" name="kwatt_amounts" id="kwatt_amounts" >
<input type="hidden" name="coin_amounts" id="coin_amounts" >
</form>
 <!-- Script logic for KWatt Amount -->
<script type="text/javascript">

$('.etherium').show();
$('.bitcoin').hide();
$('.bitcoincash').hide();
$('.litcoin').hide();
$('.paypal').hide();
$('.credit_card').hide();
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
        $('.credit_card').hide();
    }
    else if(currency=='BTC')
    {
        $('.bitcoin').show();
        $('.etherium').hide();
        $('.bitcoincash').hide();
        $('.litcoin').hide();
        $('.paypal').hide();
        $('.credit_card').hide();
    }
    else if(currency=='LTC')
    {
        $('.litcoin').show();
        $('.bitcoin').hide();
        $('.etherium').hide();
        $('.bitcoincash').hide();
        $('.paypal').hide();
        $('.credit_card').hide();
    }
    else if(currency=='BCH')
    {
        $('.bitcoincash').show();
        $('.litcoin').hide();
        $('.bitcoin').hide();
        $('.etherium').hide();
        $('.paypal').hide();
        $('.credit_card').hide();
    }
    else if(currency=='credit_card')
    {
        $('.bitcoincash').hide();
        $('.litcoin').hide();
        $('.bitcoin').hide();
        $('.etherium').hide();
         $('.paypal').hide();
        $('.credit_card').show();
    }
    // else if(currency=='USD')
    // {
    //     $('.bitcoincash').hide();
    //     $('.litcoin').hide();
    //     $('.bitcoin').hide();
    //     $('.etherium').hide();
    //     $('.paypal').show();
    // }

});
function convertor(value,fct1,fct2,fct3,fct4,fct5,fct6,n)
{
  //console.log(value);
var kwattsamount=getNum(value * fct1);
  $('#kwatt_amount').val(kwattsamount);
  if(n!=2){
    var usd_amount=getNum(value * fct2);
    $('#usd_amount').val(usd_amount);
  }
  if(n!=3)
  {
    var eth_amount=getNum(value * fct3);
    $('#eth_amount').val(eth_amount);

  }
  if(n!=4)
  {
    var btc_amount=getNum(value * fct4);
    $('#btc_amount').val(btc_amount);
  }
  if(n!=5)
  {
    var bhc_amount=getNum(value * fct5);
    $('#bhc_amount').val(bhc_amount);
  }
  if(n!=6)
  {
    var ltc_amount=getNum(value * fct6);
     $('#ltc_amount').val(ltc_amount);
  }
var usdamount='<i class="fas fa-dollar-sign"></i>'+ $('#usd_amount').val()
$('.show_usd_amount').html(usdamount);
}
function getNum(num) {
   if (isNaN(num)) {
     return 0;
   }
   else
   {
      var num = Number(num);
     if (String(num).split(".").length < 2 || String(num).split(".")[1].length<=2 ){
            return num;
        }
        else
        {
          num = num.toFixed(2);
           return num;
        }

   }
   return num;
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
      var usd_rate = "<?php echo e($setting->usd_rate); ?>";

      btc_amount="<?php echo e($setting->btc_price); ?>";
      //btc_balance= "<?php echo e($user->btc_balance); ?>";

      ltc_amount="<?php echo e($setting->ltc_price); ?>";
      //ltc_balance= "<?php echo e($user->ltc_balance); ?>";

      eth_amount="<?php echo e($setting->eth_price); ?>";
      //eth_balance= "<?php echo e($user->eth_balance); ?>";

      bhc_amount="<?php echo e($setting->bch_price); ?>";
      //bch_balance= "<?php echo e($user->bch_balance); ?>";

      usd_amount="<?php echo e($setting->usd_price); ?>";
      //usd_balance= "<?php echo e($user->usd_balance); ?>";

      if(n==1)
      {
        var kwattvalue=parseFloat(l);
        $('#kwatt_amount').val(getNum(kwattvalue));
      }
      else if(n==2)
      {
        var kwattvalue=parseFloat(USD * usd_amount/usd_rate);
        $('#kwatt_amount').val(getNum(kwattvalue));
      }
      else if(n==3)
      {
        var kwattvalue=parseFloat(ETH * eth_amount/usd_rate);
        $('#kwatt_amount').val(getNum(kwattvalue));
      }
      else if(n==4)
      {
        var kwattvalue=parseFloat(BTC * btc_amount/usd_rate);
        $('#kwatt_amount').val(getNum(kwattvalue));
      }
      else if(n==5)
      {
        var kwattvalue=parseFloat(BCH * bhc_amount/usd_rate);
        $('#kwatt_amount').val(getNum(kwattvalue));
      }
      else if(n==6)
      {
        var kwattvalue=parseFloat(LTC * ltc_amount/usd_rate);
        $('#kwatt_amount').val(getNum(kwattvalue));
      }


  convertor($('#kwatt_amount').val(),1, usd_rate/usd_amount, usd_rate/eth_amount, usd_rate/btc_amount, usd_rate/bhc_amount,usd_rate/ltc_amount,n);
  var KWT = $('#kwatt_amount').val();
  //console.log(KWT);
  var temp_balance='';
      $.ajax({
      type: 'POST',
      url: "<?php echo e(url('get_bonus')); ?>",

      data: { now_kwatt:KWT,_token:"<?php echo e(csrf_token()); ?>" },
      success:  function(response)
      {
    //  console.log(response);
        $('#bonus_now').val(response);
        var bonus=response;
        //console.log(bonus);
          //console.log(KWT);
          var temp_bonus = (parseFloat(KWT) * parseFloat(bonus)) / 100;
          var with_bonus = (parseFloat(KWT) + parseFloat(temp_bonus));
          var total=with_bonus.toFixed(2);
          var coin_value=temp_bonus.toFixed(2);
          var kwtamt=parseFloat(KWT).toFixed(2);
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




/*$( "#payment-opt" ).change(function() {
  var paymentopt=$( "#payment-opt" ).val();
  if(paymentopt=='USD')
  {
      (async function acceptTermsAndConditions () {
        const {value: accept} = await swal({
          title: 'Terms and conditions',
          input: 'checkbox',
          inputValue: 1,
          inputPlaceholder:
            'I agree with the terms and conditions',
          confirmButtonText:
            'Continue <i class="fa fa-arrow-right></i>',
          inputValidator: (result) => {
            return !result && 'You need to agree with T&C'
          }
        })

        if (accept) {
          swal('You agreed with T&C :)')
        }
        })()
  }


});*/



         </script>

 </div>
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
             <span id="succfl_chck"><img src="<?php echo e(url('/')); ?>/assets/images/check.png" width="20" height="20"></span>
              <h4 class="text-center w-100">Application WalkThrough  <!--<?php echo e(Sentinel::getUser()->fullname); ?>--></h4>

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





        <?php if(session('error_code')): ?>
    <script>
    // $(function() {
    //     $('#welcomemessage').modal('show');
    // });
    </script>
    <?php endif; ?>

<?php $__env->stopSection(); ?>


  <script type="text/javascript">
    function copysharetext() {
      var copyText = document.getElementById("share-shortlink");
      //console.log(copyText);
      copyText.select();
      document.execCommand("Copy");
    }


 </script>

 <!-- Modal HTML -->
<div id="buykwattdashboard" class="modal fade">
    <div class="modal-dialog video-pop">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
          <div class="modal-body">
            <!-- <iframe width="100%" height="300" src="https://www.youtube.com/embed/lD_bpFQTITc" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe> -->
           <iframe width="100%" height="300" src="https://www.youtube.com/embed/4gW20txWsS0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
          </div>
        </div>
    </div>
</div>
<!-- End Model -->


<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 806214533;
var google_conversion_label = "8v1aCPa75IIBEIW3t4AD";
var google_conversion_value = 1.00;
var google_conversion_currency = "CAD";
var google_remarketing_only = false;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/806214533/?value=1.00&amp;currency_code=CAD&amp;label=8v1aCPa75IIBEIW3t4AD&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>