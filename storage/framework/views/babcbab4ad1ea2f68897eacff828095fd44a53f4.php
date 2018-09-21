<?php $__env->startSection('title'); ?> My Order <?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<script type="text/javascript" src="<?php echo e(url('/')); ?>/back/js/jquery.countdownTimer.js"></script>
<div class="container-fluid">
   	<div class="col"><br/><br/>
    	<div class="row">
    		 <div class='remitt-payment card mb-5' id="remitt-payment">
     <h2 class="text-success mb-0" align="center" > You are almost done! </h2>
     <h5 align="center" class="">You are about to make a purchase of KWATTs.</h5>

    <div class="row justify-content-md-center">

            <div class="col-md-11">
          
              <div class='small-text-info md-text-info p-3'>
              <label class="mb-3">Your Checklist For Smooth Crypto-Transaction</label>
               <ul class="pl-3">
                <li> You'll have 30 minutes to complete your transaction.</li>
                <li>Please remit payment to the wallet address below to earn your bonus.</li>
                <li>It helps to have your wallet open & ready before you continue. </li>
                <li> Once funds are received within the respective wallet highlighted below, you will receive a confirmation email from us.</li>
                <li>Please allow up to 4 hours for transaction to clear when sending from exchange wallets due to network traffic. </li>


               </ul>

            </div>
            </div>

        <div class="col-md-11">
        <div class="row">
        <div class="col-md-6">
          <div class='text-left'>
            <h5 class="mt-3">≈ <span class="coin_name"><?php echo e(isset($latest_data->type)?$latest_data->type : ''); ?></span> Amount</h5>  <div class='form-group'><div class='input-group'><input type='text' class='form-control' value="<?php echo e(isset($latest_data->coin_amount)?$latest_data->coin_amount :''); ?>" id='post-shortlink22' readonly ><span class='input-group-btn'><button class='btn btn-primary btn-copy btn-sm' id='copy-button1' data-clipboard-target='#post-shortlink' type='button' onclick='copytext22()'>copy</button></span> </div></div><h5 class="mt-3">Send <span class="coin_name"><?php echo e(isset($latest_data->type)? $latest_data->type : ''); ?></span> To This Address</h5> <div class='form-group'><div class='input-group'><input type='text' class='form-control' value="<?php echo e(isset($latest_data->address)?$latest_data->address : ''); ?>" id='post-shortlink11' readonly ><span class='input-group-btn'><button class='btn btn-primary btn-copy btn-sm' id='copy-button2' data-clipboard-target='#post-shortlink' type='button' onclick='copytext11()' >copy</button></span> </div></div>
          </div>
          <div class="form-group">
            <div class="input-group">


             <button class="btn btn-sm btn-primary col-md-12" id="show_trans_info">Complete Transaction</button>

            </div>
          </div>


         </div>
        <div class="col-md-6">


               <center>
                <img width='180px' class="mt-3" id="qr_code" src='<?php echo e(isset($latest_data->qr_code)?$latest_data->qr_code : ''); ?>'>


               <div class="text-center pending-border col-lg-12">

                <div class="timmer mt-2" id="transactionExp">
                  <h4 class="mb-4">Transaction expire in</h4>
                  <div id="expired_time"></div>
                </div>
              <div class="mt-2" id="pendingstatusbtn">
                  <?php if(isset($latest_data->status) && $latest_data->status==100): ?>
                  <button class="btn btn-primary btn-sm">Success</button>
                  <?php else: ?>
                  <button class="btn btn-warning btn-sm">Pending</button>
                  <?php endif; ?>
              </div>


              </div>
               </center>
        </div>
        </div>
        </div>

        <div class="col-md-11">
           <div class="home-social">
             <a href="https://www.facebook.com/groups/258693321369597/?ref=bookmarks" target="_blank" class="btn btn-primary join-fb-group">
            Join Our Facebook Group
           </a>
           </div>
        </div>
      </div>


    </div>
<input type="hidden" name="" id="latestdata_total" value="<?php echo e($total_rows); ?>">
<input type="hidden" name="" id="last_transaction_time" 
        value="<?php echo e(isset($latest_data->created_at)?$latest_data->created_at : ''); ?>">
  		</div>


	</div>
</div>
       


<?php $__env->stopSection(); ?>
<script type="text/javascript" src="<?php echo e(url('/')); ?>/back/js/jquery-3.3.1.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){


   $(document).on("click", "#copy-button1", function() {
             var copyText = document.getElementById("post-shortlink22");
             copyText.select();
              document.execCommand("Copy");
});
  $(document).on("click", "#copy-button2", function() {
             var copyText = document.getElementById("post-shortlink11");
             copyText.select();
              document.execCommand("Copy");
});

  
function addZerosBeforenumber(number)
{

  if (number < 10) 
  {
      number= '0' + number;
  }
  return number;
}



	var last_transaction_time=$('#last_transaction_time').val();
  //console.log(last_transaction_time);
  /************* Start Time *******************/
  var startTimestamp = new Date(last_transaction_time).getTime();
  /************** End Time stamp ************/
   var countDownDate = new Date(last_transaction_time);
  countDownDate.setMinutes ( countDownDate.getMinutes() + 30);
 
  var currentdate="<?php echo date('Y-m-d G:i:s'); ?>";
  var curr_month =countDownDate.getMonth() + 1;

  var end_time_string=countDownDate.getFullYear()+'-'+addZerosBeforenumber(curr_month)+'-'+addZerosBeforenumber(countDownDate.getDate())+' '+addZerosBeforenumber(countDownDate.getHours())+':'+addZerosBeforenumber(countDownDate.getMinutes())+':'+addZerosBeforenumber(countDownDate.getSeconds());

  $(function(){
        $('#expired_time').countdowntimer({
            dateAndTime : end_time_string,
           startDate : '<?php echo date('Y-m-d G:i:s'); ?>',
            regexpMatchFormat: "([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})",
regexpReplaceWith: "<div class='timer-inner'> $3 <span>minutes</span></div>" + "<div class='timer-inner'> $4 <span>seconds</span></div><input type='hidden' name='minutes' id='minutes' value='$3'><input type='hidden' id='seconds' name='seconds' value='$4'>",

        });
    });
  $('#transactionExp').hide();
     $('#pendingstatusbtn').show();

  /*var minutes=$('#minutes').val();
  var seconds=$('#seconds').val();
  //var asdf=document.getElementById('minutes');
  console.log(minutes);
  console.log(seconds);
  if(minutes =='00' && seconds =='00')
  {
     console.log('if');
     $('#transactionExp').show();
      $('#pendingstatusbtn').hide();
  }
  else if(minutes==undefined)
  {
     console.log('else');
     $('#transactionExp').hide();
     $('#pendingstatusbtn').show();
  }*/



  

 }); 
</script>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>