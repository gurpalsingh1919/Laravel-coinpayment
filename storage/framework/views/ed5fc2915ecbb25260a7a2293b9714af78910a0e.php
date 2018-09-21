<!-- head -->
<?php $__env->startSection('title'); ?>
Kwatt Coin
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

    <div class="container-fluid">
            <div class="col">
                <div class="col">
                    <br/>
                    <br/>
                    <div class="row">
                        <div class="col">
                           
                           
                            <div class="card mb-5">
                                <div class="card-header d-flex justify-content-between">
                                    <h4>ICO Settings</h4><!-- <div class="card-header"> -->
                            
                            <a class="btn-sm btn btn-primary" href="<?php echo e(url('/ico-add')); ?>" >Add KWATT</a>
                      <!--   </div> -->
                                </div>
                                  <div class="card mb-5">
                        
                        <div class="card-body no-padding">
                            <br/>
                            <div class="col">
                                <table id="ico-table" class="display responsive nowrap" width="100%">
                                    <thead>
                                        <th>Sr.</th>
                                        <th>ICO Start Date</th>
                                        <th>ICO End Date</th>
                                        <th>Total Coins</th>
                                        <th>Sold Coin</th>
                                        <th>Token Rate</th>
                                        <th>Referal Bonus</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                           <td><?php echo e($setting->id); ?></td>
                                        
                                            <td><?php echo e($setting->ico_start_date); ?></td>
                                            <td><?php echo e($setting->ico_end_date); ?></td>
                                            <td><?php echo e($setting->total_coins); ?></td>
                                            <td><?php echo e($setting->sold_coins); ?></td>
                                            <td><?php echo e($setting->usd_rate); ?> $</td>
                                            <td><?php echo e($setting->referal_bonus); ?> %</td>
                                            <td>
                                                <div class="btn-group congs-custom">
                                                    <!-- <a class="" href="<?php echo e(url('/ico-edit')); ?>" id="edit">
                                                        <i class="fas fa-edit"></i> 
                                                      </a> -->
                                                </div>
                                            </td>
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
                    </div>
                </div>
            </div>
        </div>
<?php $__env->stopSection(); ?>  
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>