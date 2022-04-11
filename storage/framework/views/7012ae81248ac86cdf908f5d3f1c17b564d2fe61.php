
<?php $__env->startSection('title', 'FSTV | Notification'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
                        
    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">Notification Lists</h5>
            
        </div>
    </div>
    <!-- /Title -->

    <?php if(Session::has('message')): ?>
        <div class="success success-info"><?php echo e(Session::get('message')); ?></div>
    <?php endif; ?> 
    <?php if(Session::has('error')): ?>
        <div class="alert alert-info"><?php echo e(Session::get('error')); ?></div>
    <?php endif; ?> 
    
    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    
                    <div class="clearfix"></div>
                    <div class="pull-right">
                        <a href="<?php echo e(route('usernotification.create')); ?>" class="btn btn-default btn-rounded" style="border-bottom: 50%">
                            <i class="fa fa-plus-circle">Send</i>
                        </a>
                    </div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="table-wrap">
                            <div class="table-responsive">
                                <table id="datable_1" class="table table-bordered table-hover display  pb-30" >
                                    <thead>
                                      <tr>
                                            <th>S.N.</th>                                   
                                            <th>Title</th>                                  
                                            <th>Body</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        <?php if($notification): ?>
                                            <?php $__currentLoopData = $notification; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                                <tr>
                                                    <td><?php echo e($loop->iteration); ?></td>
                                                    <td><?php echo e($row->title); ?></td>
                                                    <td><?php echo Illuminate\Support\Str::limit(html_entity_decode($row->description), 200); ?></td>
                                                    
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
<?php $__env->startSection('scripts'); ?>
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ausnepc/firescreen.ausnep.com/resources/views/admin/notification.blade.php ENDPATH**/ ?>