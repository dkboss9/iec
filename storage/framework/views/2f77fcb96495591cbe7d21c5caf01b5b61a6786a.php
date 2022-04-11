
<?php $__env->startSection('title','Programs'); ?>
<?php $__env->startSection('content'); ?>

<div class="container-fluid">
                    
    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">Programs Elements</h5>            
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
                        <h6 class="panel-title txt-dark">Programs Table</h6>
                    </div>
                    <div class="clearfix"></div>
                    <?php if(!$data->isempty()): ?>
                        <div class="pull-right">
                            <a href="<?php echo e(route('participant.create')); ?>" class="btn btn-default btn-rounded" style="border-bottom: 50%">
                                <i class="fa fa-plus-circle">Participants</i>
                            </a>
                        </div>
                    <?php endif; ?>
 
                    <div class="pull-right">
                        <a href="<?php echo e(route('program.create')); ?>" class="btn btn-default btn-rounded" style="border-bottom: 50%">
                            <i class="fa fa-plus-circle">Program</i>
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
                                            <th>Title</th>
                                            <th>Participants</th>
                                            <th>Image</th>
                                            <th>Status</th>
                                            <th>Created_by</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if($data): ?>
                                            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($loop->iteration); ?></td>
                                                    <td><?php echo e($value->title); ?></td>
                                                    <td><a href="<?php echo e(route('program-participant-list',$value->id)); ?>">Click Here<i class="fa fa-eye"></i></a></td>
                                                    <td>
                                                        <a href="<?php echo e(asset('upload/program/'.$value->image)); ?>">
                                                           
                                                            <img src="<?php echo e(asset('upload/program/'.$value->image)); ?>" style="max-width: 120px; max-height:90px;" alt="">
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-<?php echo e($value->status == 'active' ? 'success' : 'danger'); ?>">
                                                            <?php echo e(ucfirst(($value->status == 'active') ? 'Active' : 'Inactive')); ?>

                                                        </span>
                                                    </td>
                                                    <td>
                                                        <?php echo e($value->created_by['name']); ?>

                                                    </td>
                                                    <td>
                                                        <ul class="nav nav-pills">
                                                            <li>
                                                                <a href="<?php echo e(route('program.edit', $value->id)); ?>">
                                                                    <i class="fa fa-edit fa-2x" style="color:#878787;"></i>
                                                                </a> 
                                                            </li>
                                                            <li>
                                                                <a href="">
                                                                    <?php echo e(Form::open(['url'=>route('program.destroy', $value->id), 'class'=>'form float-right', 'onsubmit'=>'return confirm("Are you sure to delete??")'])); ?>

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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ausnepc/firescreen.ausnep.com/resources/views/admin/program/program.blade.php ENDPATH**/ ?>