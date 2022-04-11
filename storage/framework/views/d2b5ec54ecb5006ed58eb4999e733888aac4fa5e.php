
<?php $__env->startSection('title','FSTV| Featured Posts'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
                    
    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">Featured Posts Elements</h5>
            
        </div>
    </div>
    <!-- /Title -->
    <?php if(Session::has('message')): ?>
        <div class="success success-info"><?php echo e(Session::get('message')); ?></div>
    <?php endif; ?> 
    
    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Featured News Table</h6>
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
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Type(News/Video)</th>
                                            <th>Status</th>
                                      </tr>
                                    </thead>
                                    <tbody>  
                                        <?php if($featured): ?>
                                        <?php $i=0; ?>
                                            <?php $__currentLoopData = $featured; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                                <?php $i++?>
                                                <tr>
                                                    <td><?php echo $i;?></td>
                                                    <?php if($row->post_info != null): ?>
                                                        <td><?php echo e($row->post_info['title']); ?></td>
                                                        <td><?php echo Illuminate\Support\Str::limit(html_entity_decode($row->post_info['detail']), 200); ?></td>
                                                        <td>News</td>
                                                        <td><?php echo e(($row->post_info['status'] == 'active')? 'Published' : 'Unpublish'); ?></td>
                                                    <?php else: ?>
                                                        <td><?php echo e($row->video_info['title']); ?></td>
                                                        <td><?php echo Illuminate\Support\Str::limit(html_entity_decode($row->video_info['detail']), 200); ?></td>
                                                        <td>Video</td>
                                                        <td><?php echo e(($row->video_info['status'] == 'active')? 'Published' : 'Unpublish'); ?></td>
                                                    <?php endif; ?> 
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
<?php echo $__env->make('layouts.operator', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ausnepc/firescreen.ausnep.com/resources/views/operator/featured.blade.php ENDPATH**/ ?>