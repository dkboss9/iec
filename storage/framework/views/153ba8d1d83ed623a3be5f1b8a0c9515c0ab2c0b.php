
<?php $__env->startSection('title', 'FSTV | Admin list'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
                        
    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">Admin Elements</h5>
            
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
                        <h6 class="panel-title txt-dark">Admin List</h6>
                    </div>
                    <div class="clearfix"></div>
                    <div class="pull-right">
                        <?php if(auth()->user()->id == '1'): ?>
                        <a href="<?php echo e(route('users.create')); ?>" class="btn btn-default btn-rounded" style="border-bottom: 50%">
                            <i class="fa fa-plus-circle">Add</i>
                        </a>                            
                        <?php endif; ?>
                    </div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="table-wrap mt-40">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered table-dark mb-0">
                                    <thead>
                                      <tr>
                                            <th>S.N.</th>                                   
                                            <th>Name</th>                                  
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Status</th>
                                            <?php if(auth()->user()->id == '1'): ?>
                                            <th>Action</th>                                                
                                            <?php endif; ?>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        <?php if($data): ?>
                                            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                                <tr>
                                                    <td><?php echo e($loop->iteration); ?></td>
                                                    <td><?php echo e($row->name); ?></td>
                                                    <td><?php echo e($row->email); ?></td>
                                                    <td><?php echo e($row->status); ?></td>
                                                    <td><?php echo e(ucfirst($row->role)); ?></td>
                                                    <?php if(auth()->user()->id == '1'): ?>
                                                    <td>
                                                    <ul class="nav nav-pills">
                                                        <li>
                                                            <a data-toggle="tooltip" data-placement="bottom" title="edit" href="<?php echo e(route('users.edit', $row->id)); ?>">
                                                                <i class="fa fa-edit fa-2x" style="color:#878787;"></i>
                                                            </a> 
                                                        </li>
                                                            <li>
                                                                <a data-toggle="tooltip" data-placement="bottom" title="delete" href="">
                                                                    <?php echo e(Form::open(['url'=>route('users.destroy', $row->id), 'class'=>'form float-right', 'onsubmit'=>'return confirm("Are you sure to delete??")'])); ?>

                                                                    <?php echo method_field('delete'); ?>
                                                                    <?php echo e(Form::button('<i class="fa fa-trash fa-1x" style="color:#fa1b1b;"></i>',['type'=>'submit'])); ?>

                                                                    <?php echo e(Form::close()); ?>

                                                                </a>
                                                            </li>                                                                
                                                        </ul>                                                            
                                                    </td>
                                                    <?php endif; ?>
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
<?php $__env->startSection('scripts'); ?>
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ausnepc/firescreen.ausnep.com/resources/views/admin/userlist/admin-list.blade.php ENDPATH**/ ?>