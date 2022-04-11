
<?php $__env->startSection('title','Participant Detail'); ?>
<?php $__env->startSection('content'); ?>

<div class="container-fluid">
                    
    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">Participant Detail Elements</h5>            
        </div>
    </div>
    <!-- /Title -->
    <?php if(Session::has('message')): ?>
        <div class="success success-info"><?php echo e(Session::get('message')); ?></div>
    <?php endif; ?> 
    <?php if(Session::has('error')): ?>
        <div class="success success-info"><?php echo e(Session::get('error')); ?></div>
    <?php endif; ?> 
    
    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Participant Detail Table</h6>
                    </div>
                    <div class="clearfix"></div>
                    
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="table-wrap mt-40">
                            <div class="table-responsive">
                                <table id="datable_1" class="table table-bordered table-hover display  pb-30" >
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Program</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Image</th>
                                            
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if($data): ?>
                                        <tr>
                                            <td><?php echo e($data->name); ?></td>
                                            <td><?php echo e($data->program_info['program']); ?></td>
                                            <td><?php echo $data->detail; ?></td>
                                            <td>
                                                <span class="badge badge-<?php echo e($data->status == 'active' ? 'success' : 'danger'); ?>">
                                                    <?php echo e(ucfirst(($data->status == 'active') ? 'Active' : 'In-active')); ?>

                                                </span>
                                            </td>
                                            <td>
                                                <a href="<?php echo e(asset('upload/participant/'.$data->photo)); ?>">
                                                    <img src="<?php echo e(asset('upload/participant/'.$data->photo)); ?>" style="max-width: 150px; max-height:90px;" alt="">
                                                </a>
                                            </td>
                                        </tr>
                                        <?php endif; ?>
                                        </tbody>
                                    </table>
                                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>	
        </div>
    </div>
    <!-- /Row -->
    
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ausnepc/firescreen.ausnep.com/resources/views/admin/voting/participant-detail.blade.php ENDPATH**/ ?>