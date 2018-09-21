<!-- head -->
<?php $__env->startSection('title'); ?>
Kwatt Coin
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

    <div class="container-fluid">
        <div class="col">
            <div class="col">
                <!-- <br/>
                <br/>
                <h2>Manage User</h2>-->
                <br/>
                <br/> 
                <div class="card mb-5">
                    <div class="card-header">
                        <h5 class="text-uppercase">Manage Users</h5>
                    </div>
                    <div class="card-body no-padding">
                        <br/>
                        <div class="col">
                            <table id="ico-table" class="display responsive nowrap" width="100%">
                                <thead>
                                <th>Sr.</th><!-- <th>kycdetails</th> -->
                                <th>Name</th>
                                <th>Email</th>
                               
                                <th>KWATT</th>
                               
                                <th>KYC Status</th>
                                <th>Status</th>
                                <th>Action</th>

                                </thead>
                                <tbody>

                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <!-- <td><?php echo e($key->kycdetail); ?></td> -->
                                    <td><?php echo e($key->fullname); ?></td>
                                    <td><?php echo e($key->email); ?></td>
                                   
                                   <!--  <td><?php echo e($key->btc_balance); ?></td>
                                    <td><?php echo e($key->eth_balance); ?></td>
                                    <td><?php echo e($key->ltc_balance); ?></td>
                                    <td><?php echo e($key->bch_balance); ?></td>  -->
                                    <td><?php echo e($key->kwatt_balance); ?></td>
                                    <!-- <td><?php echo e($key->usd_balance); ?></td> -->
                                    <!--  <td><?php echo e(isset($key->company) ? $key->company : '-'); ?></td>
                                    <td><?php echo e(isset($key->city) ? $key->city : '-'); ?></td> -->
                                    <td>
                                        <?php if($key->kyc_status == 0): ?>
                                            <i class="fa fa-circle-o-notch"></i>&nbsp;Pending
                                        <?php elseif($key->kyc_status == 1 || $key->kyc_status == 2): ?>
                                            <i class="fa fa-check"></i>&nbsp;Verified
                                       
                                        <?php endif; ?>
                                        <!-- <a href="<?php echo e(url('admin-kyc',$key->id)); ?>"><button class="btn btn-info" ><i class="fa fa-eye"></i>&nbsp;KYC</button></a> -->
                                    </td>
                                    <td>
                                        <?php if($key->status == 1): ?>
                                        <span class="badge badge-success">Active</span>
                                        <?php elseif($key->status == 0): ?>
                                        <span class="badge badge-danger">Block</span>
                                            <?php endif; ?>

                                    </td>
                                    <td>
                                        <div class="btn-group congs-custom">
                                            <a class="" href="https://example.com" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-cog"></i>
                                            </a>
                                            <div class="dropdown-menu">
                                                <?php if($key->status == 1): ?>
                                                <a class="dropdown-item" href="<?php echo e(url('admin-user-list-status').'/'.$key->id.'/0'); ?>"><i class="fas fa-ban"></i> Block</a>
                                                <?php elseif($key->status == 0): ?>
                                                <a class="dropdown-item" href="<?php echo e(url('admin-user-list-status').'/'.$key->id.'/1'); ?>"><i class="fas fa-ban"></i> Active</a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
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
    <!-- end:: Page -->
    <!-- begin::Quick Nav -->
    <!--begin::Base Scripts -->
    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/bootstrap.bundle.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
    <!--end::Base Scripts -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>

    </body>
    <!-- end::Body -->
<?php $__env->stopSection(); ?>  
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>