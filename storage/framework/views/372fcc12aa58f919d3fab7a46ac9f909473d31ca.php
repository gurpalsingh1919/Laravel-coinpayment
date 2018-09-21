<!-- head -->
<?php $__env->startSection('title'); ?>
Kwatt | Admin Buy
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

    <div class="container-fluid">
            <div class="col">
                 <br/>
                <br/>
               <!-- <h2>Buy Kwatt History</h2>
                <br/> -->

                <div class="row">
                   
                    <div class="col-md-12">

                                <div class="card mb-5 col-md-12">
                                    <div class="card-header">
                                        <h5 class="text-uppercase">Transactions History</h5>
                                    </div>
                                    <div class="card-body no-padding">
                                   <br/>
                                            <table id="ico-table" class="display responsive nowrap" width="100%">
                                                <thead>
                                                     <td>Sr.</td>
                                                     <td>Name</td>
                                                     <td>Email</td>
                                                     <th>KWATTs</th>
                                                     <th>Status</th>
                                                     <th>Coin Type</th>
                                                     <th>Coin Amount</th>
                                                     <th>Txn Type</th>   
                                                     <th>Date</th>
                                                    <!--  <th>Option</th> -->
                                                     <th>Transaction id</th>
                                                     <!-- <th>Remark</th>
                                                     <th>Approved By</th> -->

                                                    </thead>

                          <tbody>
                              <?php $i=1; ?>
                              <?php $__currentLoopData = $buy_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <tr>
                                <td><?php echo e($i++); ?></td>
                                <td><?php echo e($key->get_user_info->fullname); ?></td>
                                <td><?php echo e($key->get_user_info->email); ?></td>
                                <td><?php echo e($key->no_of_kwatt); ?></td>
                                
                                <td>
                       <?php if($key->status ==100): ?>
                        <span class="badge badge-success">Paid</span>
                        <?php elseif($key->status == -1): ?>


                        <span class="badge badge-danger">expired </span>

                        <?php else: ?>
                         <span class="badge badge-warning">Pending </span>
                        <?php endif; ?>
                      </td>


                                <td><?php echo e($key->type); ?></td>
                                <td><?php echo e($key->coin_amount); ?></td>
                                <td> <?php if($key->txn_type==1): ?>
                                      <?php echo e('Added'); ?>

                                      <?php elseif($key->txn_type==2): ?>
                                      <?php echo e('Buy'); ?>

                                      <?php elseif($key->txn_type==3): ?>
                                      <?php echo e('Withdraw'); ?>

                                      <?php elseif($key->txn_type==4): ?>
                                      <?php echo e('Bonus'); ?>

                                      <?php elseif($key->txn_type==5): ?>
                                      <?php echo e('Removed'); ?>

                                      <?php endif; ?></td>

                                <td><?php echo e(date_format($key->updated_at,"Y-m-d")); ?></td>
                                
                            <!-- <td>
                              <?php if($key->status == 0): ?>
                             
                              <?php if($key->txn_type == 2 || $key->txn_type == 3): ?>
                              <button class="btn-sm btn btn-primary" onclick="acceptpayment(<?php echo e($key->id); ?>)">Paid</button>
                              <?php endif; ?>
                              
                              <?php elseif($key->status == -1): ?>
                                Cancel
                              <?php elseif($key->status == 100): ?>
                                Success
                              <?php else: ?>
                              <?php endif; ?>
                            </td> -->
                         <td><?php echo e($key->tx_id); ?></td>
                        <!--  <td><?php echo e($key->remark); ?></td>
                         <td>
                          <?php if(isset($key->get_approved_info->fullname)): ?>
                          <?php echo e($key->get_approved_info->fullname); ?>

                        <?php endif; ?></td> -->
                              </tr>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                         
                          </tbody>
                                            </table>
                                    </div>
                                </div>
                    </div>
                </div>
            </div>
        </div>


<?php $__env->stopSection(); ?>  
<script type="text/javascript">
  function acceptpayment(id)
  {
    //alert(id);
    var trans_id=id;
    if(trans_id !='')
    {
      swal({
              title: 'Important! you are making the transaction as paid. Are you Sure?',
              input: 'text',   
                  inputPlaceholder:"Remarks",
                  inputClass:"form-control",
                  //html: message,
                   
                  showCancelButton: true,
                 // onfirmButtonText: 'Mark as Paid',
                  confirmButtonText: 'Mark as Paid',
                  confirmButtonClass: 'btn btn-primary',
                  confirmButtonColor: '#7dc242',
                  }). then(function(result){
                    //console.log(result);
                    if(result.value)
                    {
                      var remarks=result.value;
                        approveuserrpayment(trans_id,remarks)
                    }
                    
                     });
      }

  }

function approveuserrpayment(trans_id,remarks)
{
  var url='accept-payment';
  var csrftoken= $('input[name=_token]').val();
  $.ajax({
              type: 'POST',
              url: url,
              data: { transaction_id:trans_id,admin_remark:remarks,_token:csrftoken },
              success:  function(data)
              {
                //console.log(data);
                if(data.status==1)
                {
                   var msg=data.message;
                  //swal(msg);
                    swal({
                            title: data.message,
                            showConfirmButton: 'OK'
                        }). then(function(result){
                 window.location.href = "admin-buy";

                   });
        
                  
                }
                else
                {
                  var msg=data.message;
                  swal(msg);
                  return false;
                }
              }
          });
}
</script>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>