
<?php $__env->startSection('title','Monthly Quiz Winner'); ?>
<?php $__env->startSection('content'); ?>

<div class="container-fluid">
                    
    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">Monthly Quiz Winner Elements</h5>            
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
                        <h6 class="panel-title txt-dark">Monthly Quiz Winner Table</h6>
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
                                            <th>S.N</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            
                                            
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if($data): ?>
                                            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($loop->iteration); ?></td>
                                                    <td><?php echo e($value->created_by['name']); ?></td>
                                                    <td><?php echo e(@ $value->created_by['email']); ?></td>
                                                    
                                                    
                                                    
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ausnepc/firescreen.ausnep.com/resources/views/admin/quiz/monthly-winner.blade.php ENDPATH**/ ?>