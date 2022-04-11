
<?php $__env->startSection('title','About Us'); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
                        
        <!-- Title -->
        <div class="row heading-bg">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-dark">About Us Elements</h5>
                
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
                            <h6 class="panel-title txt-dark">About Us Table</h6>
                        </div>
                        <div class="clearfix"></div>
                        
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="table-wrap mt-40">
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered table-dark mb-0">
                                        <thead>
                                          <tr>
                                                <th>S.N</th>                                    
                                                <th>Title</th>
                                                <th>Sub-title</th>
                                                <th>Description</th>
                                                <th>Image</th>
                                                <th>Created By</th>
                                              <th class="text-nowrap">Action</th>
                                          </tr>
                                        </thead>
                                        <tbody>  
                                            <?php if($about_data): ?>
                                            <?php $i=0; ?>
                                                <?php $__currentLoopData = $about_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                                    <?php $i++?>
                                                    <tr>
                                                        <td><?php echo $i;?></td>
                                                        <td><?php echo e($row->title); ?></td>
                                                        <td><?php echo e($row->subtitle); ?></td>
                                                        <td><?php echo Illuminate\Support\Str::limit(html_entity_decode($row->detail), 200); ?></td>
                                                        <td>
                                                            <a href="<?php echo e(asset('upload/about/'.$row->image)); ?>">
                                                                <?php echo e($row->image); ?>

                                                                
                                                            </a>
                                                        </td>
                                                        <td><?php echo e($row->created_by['name']); ?></td>
                                                        <td>
                                                            <ul class="nav nav-pills">
                                                                <li>
                                                                    <a href="<?php echo e(route('about.edit', $row->id)); ?>">
                                                                        <i class="fa fa-edit fa-2x" style="color:#878787;"></i>
                                                                    </a> 
                                                                </li>
                                                               
                                                            </ul>                                                            
                                                        </td>
                                                    </tr>                                                   
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                            
                                            <?php endif; ?> 
                                        </tbody>
                                    </table>
                                    <?php echo e($about_data->links()); ?>

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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ausnepc/firescreen.ausnep.com/resources/views/admin/about.blade.php ENDPATH**/ ?>