
<?php $__env->startSection('title','Child-menu'); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
                        
        <!-- Title -->
        <div class="row heading-bg">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-dark">Child-Menu Elements</h5>
                
            </div>
        </div>
        <!-- /Title -->
        
        <!-- Row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default card-view">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h6 class="panel-title txt-dark">Child-Menu Table</h6>
                        </div>
                        <div class="clearfix"></div>
                        <div class="pull-right">
                            <a href="<?php echo e(route('childmenu.create')); ?>" class="btn btn-default btn-rounded" style="border-bottom: 50%">
                                <i class="fa fa-plus-circle">Add</i>
                            </a>
                        </div>
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
                                                <th>Menu</th>
                                                <th>Sub-Menu</th>
                                                <th>Image</th>
                                                <th>Detail</th>
                                                <th>Status</th>
                                              <th class="text-nowrap">Action</th>
                                          </tr>
                                        </thead>
                                        <tbody>  
                                            <?php if($data): ?>
                                            <?php $i=0; ?>
                                                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                                    <?php $i++?>
                                                    <tr>
                                                        <td><?php echo $i;?></td>
                                                        <td><?php echo e($row->title); ?></td>
                                                        <td><?php echo e($row->menu_info->title); ?></td>
                                                        <td><?php echo e($row->submenu_info->title); ?></td>
                                                        <td>
                                                            <a href="<?php echo e(asset('upload/fstv/childmenu/'.$row->image)); ?>">
                                                                <?php echo e($row->image); ?>

                                                            </a> 
                                                        </td>
                                                        <td><?php echo Illuminate\Support\Str::limit(html_entity_decode($row->detail), 200); ?></td>
                                                        <td><?php echo e($row->status); ?></td>
                                                        <td>
                                                            <ul class="nav nav-pills">
                                                                <li>
                                                                    <a href="<?php echo e(route('childmenu.edit', $row->id)); ?>">
                                                                        <i class="fa fa-edit fa-2x" style="color:#878787;"></i>
                                                                    </a> 
                                                                </li>
                                                                <li>
                                                                    <a href="">
                                                                        <?php echo e(Form::open(['url'=>route('childmenu.destroy', $row->id), 'class'=>'form float-right', 'onsubmit'=>'return confirm("Are you sure to delete??")'])); ?>

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
                                    <?php echo e($data->links()); ?>

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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ausnepc/firescreen.ausnep.com/resources/views/admin/fstv/childmenu.blade.php ENDPATH**/ ?>