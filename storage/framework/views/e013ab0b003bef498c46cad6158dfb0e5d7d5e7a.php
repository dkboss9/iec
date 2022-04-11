
<?php $__env->startSection('title','Participants'); ?>
<?php $__env->startSection('content'); ?>

<div class="container-fluid">
                    
    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">Participants Elements</h5>            
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
                        <h6 class="panel-title txt-dark">Participants Table</h6>
                    </div>
                    <div class="clearfix"></div>
                    <div class="pull-right">
                        <a href="<?php echo e(route('participant.create')); ?>" class="btn btn-default btn-rounded" style="border-bottom: 50%">
                            <i class="fa fa-plus-circle">participant</i>
                        </a>
                    </div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="table-wrap mt-40">
                            <div class="table-responsive">
                                <table id="datable_1" class="table table-bordered table-hover display  pb-30" >
                                    <thead>
                                        <tr>
                                            <th>S.N</th>
                                            <th>Program</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Birth-Date</th>
                                            <th>Phone</th>
                                            <th>State</th>
                                            <th>City</th>
                                            <th>Address</th>
                                            <th>Image</th>
                                            <th>Nationality</th>
                                            <th>Video</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if($data): ?>
                                            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($loop->iteration); ?></td>
                                                    <td><?php echo e($value->program_info->title); ?></td>
                                                    <td><?php echo e($value->name); ?></td>
                                                    <td><?php echo e($value->email); ?></td>
                                                    <td><?php echo e($value->dob); ?></td>
                                                    <td><?php echo e($value->phone); ?></td>
                                                    <td><?php echo e($value->state); ?></td>
                                                    <td><?php echo e($value->city); ?></td>
                                                    <td><?php echo e($value->address); ?></td>
                                                    <td>
                                                        <a target="blank_" href="<?php echo e(asset('upload/participant/'.$value->image)); ?>">
                                                           
                                                            <img src="<?php echo e(asset('upload/participant/'.$value->image)); ?>" style="max-width: 120px; max-height:90px;" alt="">
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <?php
                                                             $array = explode("|", $value->identification);
                                                        ?>
                                                        <?php $__currentLoopData = $array; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <a target="blank_" href="<?php echo e(asset('upload/participant/'.$item)); ?>">
                                                                <img src="<?php echo e(asset('upload/participant/'.$item)); ?>" style="max-width: 120px; max-height:90px;" alt="">
                                                            </a>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </td>
                                                    <td>
                                                        <a target="blank_" href="<?php echo e(route('download-video',$value->video)); ?>">Download <i class="fa fa-download"></i></a>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-<?php echo e($value->status == 'active' ? 'success' : 'danger'); ?>">
                                                            <?php echo e(ucfirst(($value->status == 'active') ? 'Active' : 'Inactive')); ?>

                                                        </span>
                                                    </td>
                                                    
                                                    <td>
                                                        <ul class="nav nav-pills">
                                                            <li>
                                                                <a href="<?php echo e(route('participant.edit', $value->id)); ?>">
                                                                    <i class="fa fa-edit fa-2x" style="color:#878787;"></i>
                                                                </a> 
                                                            </li>
                                                            <li>
                                                                <a href="">
                                                                    <?php echo e(Form::open(['url'=>route('participant.destroy', $value->id), 'class'=>'form float-right', 'onsubmit'=>'return confirm("Are you sure to delete??")'])); ?>

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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ausnepc/firescreen.ausnep.com/resources/views/admin/program/program-participant-list.blade.php ENDPATH**/ ?>