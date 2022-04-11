
<?php $__env->startSection('title','Popular Posts'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
                    
    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">Popular Posts Elements</h5>
            
        </div>
    </div>
    <!-- /Title -->
    
    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view">
                
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="">
                            <div class="col-lg-9 col-md-8 file-sec pt-20">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row">
                                        
                                            <?php if($popular): ?>
                                                <?php $__currentLoopData = $popular; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                              
                                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                                        <div class="file">
                                                            <div class="icon">
                                                                <?php if(isset($row->post_info['image'])): ?>
                                                                    <a href="<?php echo e(asset('/upload/post/'.$row->post_info['image'])); ?>">
                                                                        <img class="icon" src="<?php echo e(asset('/upload/post/'.$row->post_info['image'])); ?>" alt="">
                                                                    </a>
                                                                <?php else: ?>
                                                                    <i class="zmdi zmdi-file-text"></i>                                                                    
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="file-name">
                                                                <span></span>
                                                                <a href=""><?php echo e($row->post_info['title']); ?></a>
                                                                <br>
                                                                <span>Added-at: </span>
                                                                <span><?php echo e($row->created_at->format('Y-m-d')); ?></span>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                                              
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                            
                                            <?php endif; ?> 
                                        
                                            <?php echo e($popular->links()); ?>

                                            
                                        </div>
                                    </div>
                                </div>
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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\fstv\resources\views/admin/popular.blade.php ENDPATH**/ ?>