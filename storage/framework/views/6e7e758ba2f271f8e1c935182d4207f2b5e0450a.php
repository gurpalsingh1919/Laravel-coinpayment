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
                        <div class="col-md-12">                            
                            <?php if(session('success')): ?>
                                <div class="alert alert-success">
                                    <strong>Success : </strong><?php echo e(session('success')); ?>

                                </div>
                            <?php endif; ?>
                            <?php if(session('error')): ?>
                                <div class="alert alert-danger">
                                    <strong>Error : </strong> <?php echo e(session('error')); ?>

                                </div>
                            <?php endif; ?>  

                        </div>
                        <div class="col">
                            <div class="card mb-5">
                               <!--  <div class="card-header">
                                    <h4>Rate</h4>
                                </div> -->
                                  <div class="card mb-5">
                                      <div class="card-header">
                                          <h5 class="text-uppercase d-flex justify-content-between"><span>Bonus Settings</span> <a href="<?php echo e(url('rate-add')); ?>"><span><button type="button" class="btn btn-primary btn-xs "> Add New </button></span></a></h5>
                                      </div>

                        <div class="card-body no-padding">
                            <br/>
                            <div class="col">
                                <table id="ico-table" class="display responsive nowrap" width="100%">
                                    <thead>
                                        <th>Sr.</th>
                                        <th>Bonus</th>
                                        <th>Kwatt Limit</th>
                                        <th>Action</th>
                                        
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $rate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($loop->iteration); ?> </td>
                                            <td><?php echo e($key->bonus); ?> </td>
                                            <td><?php echo e($key->kwatt_limit); ?></td>
                                            <td>

                                                <?php if(in_array($key->status,[0,1])): ?>
                                                    <div class="btn-group congs-custom">
                                                        <a class="" href="<?php echo e(url('/rate-edit/'.$key->id)); ?>" id="edit">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    </div>

                                                    <div class="btn-group congs-custom">
                                                        <a class="" href="<?php echo e(url('/rate-delete/'.$key->id)); ?>" id="delete">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
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
                    </div>
                </div>
            </div>
        </div>
<?php $__env->stopSection(); ?>  
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>