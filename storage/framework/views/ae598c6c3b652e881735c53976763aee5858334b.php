
<?php $__env->startSection('title','FSTV | News Review'); ?>
<?php $__env->startSection('content'); ?>

<div class="container-fluid">
                    
    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">News Review Elements</h5>
            
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
                        <h6 class="panel-title txt-dark">News Review Table</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="table-wrap">
                            <div class="table-responsive">
                                <table id="datable_1" class="table table-bordered table-hover display  pb-30" >
                                    <thead>
                                        <tr>
                                            <th>S.N.</th>
                                            <th>News title</th>
                                            <th>Category</th>
                                            <th>Comments</th>                                            
                                            <th>Comments By</th>
                                            <th class="text-nowrap">Action</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>  
                                        <?php if($data): ?>
                                            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                                <tr>
                                                    <td><?php echo e($loop->iteration); ?></td>
                                                    <td><?php echo e($row->post_info['title']); ?></td>
                                                    <td>
                                                        <?php echo e(@$row->post_info->cat_info['title']); ?>

                                                        <?php if($row->post_info->sub_cat_info): ?>
                                                            >> <?php echo e($row->post_info->sub_cat_info['title']); ?> 
                                                        <?php endif; ?>
                                                    </td>
                                                    <td><?php echo Illuminate\Support\Str::limit(html_entity_decode($row->comments), 500); ?></td>
                                                    <td><?php echo e($row->name); ?></td>                                        
                                                    <td>
                                                        <ul class="nav nav-pills">
                                                            <li>
                                                                <a data-toggle="tooltip" data-placement="bottom" title="delete" href="">
                                                                    <?php echo e(Form::open(['url'=>route('review.destroy', $row->id), 'class'=>'form float-right', 'onsubmit'=>'return confirm("Are you sure to delete??")'])); ?>

                                                                    <?php echo method_field('delete'); ?>
                                                                    <?php echo e(Form::button('<i class="fa fa-trash fa-1x" style="color:#fa1b1b;"></i>',['type'=>'submit'])); ?>

                                                                    <?php echo e(Form::close()); ?>

                                                                </a>
                                                            </li>
                                                        </ul>                                                            
                                                    </td>
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
<script>
    $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip();   
    });
</script>
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ausnepc/firescreen.ausnep.com/resources/views/admin/review.blade.php ENDPATH**/ ?>