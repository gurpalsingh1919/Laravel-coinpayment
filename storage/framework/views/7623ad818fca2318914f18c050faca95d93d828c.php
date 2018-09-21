<?php $__env->startSection('title'); ?> Transactions <?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

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

      <!-- <marquee behavior="alternate" direction="right" scrollamount="4"> --><h4 class="text-uppercase m-0" align="center"><strong>Total KWATTS : <?php echo e(Sentinel::getUser()->kwatt_balance); ?></strong></h4><!-- </marquee> -->

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
              <?php $__currentLoopData = $buy_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                      <td><?php echo e($i++); ?></td>
                      <td><?php echo e($key->no_of_kwatt); ?></td>
                      <td><?php echo e($key->type); ?></td>
                      <td>
                        <?php if($key->txn_type==1): ?>
                        <?php echo e('Added'); ?>

                        <?php elseif($key->txn_type==2): ?>
                        <?php echo e('Buy'); ?>

                        <?php elseif($key->txn_type==3): ?>
                        <?php echo e('Withdraw'); ?>

                        <?php elseif($key->txn_type==4): ?>
                        <?php echo e('Bonus'); ?>

                        <?php elseif($key->txn_type==5): ?>
                        <?php echo e('Removed'); ?>

                        <?php endif; ?>


                      </td>
                      <?php if($key->coin_amount=='0'): ?>
                      <td><span class="badge badge-success">Commission</span></td>
                      <?php else: ?>
                      <td><?php echo e($key->coin_amount); ?></td>
                      <?php endif; ?>
                      <td>
                       <?php if($key->status ==100): ?>
                        <span class="badge badge-success">Paid</span>
                        <?php elseif($key->status == -1): ?>


                        <span class="badge badge-danger">expired </span>

                        <?php else: ?>
                         <span class="badge badge-warning">Pending </span>
                        <?php endif; ?>
                      </td>
                      <td><?php echo e($key->address); ?></td>
                      <td><?php echo e($key->payment_id); ?></td>
                      <td><?php echo e($key->created_at); ?></td>
                  </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

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



<?php $__env->stopSection(); ?>






<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>