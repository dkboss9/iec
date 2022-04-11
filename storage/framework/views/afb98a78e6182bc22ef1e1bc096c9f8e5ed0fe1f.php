
<?php $__env->startSection('title','Questions'); ?>
<?php $__env->startSection('content'); ?>

<div class="container-fluid">
                    
    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">Questions Elements</h5>            
        </div>
    </div>
    <!-- /Title -->
 
    
    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Questions Table</h6>
                    </div>
                    <div class="clearfix"></div>
                    <div class="pull-right">
                        <a href="<?php echo e(route('quiz_question/create')); ?>" class="btn btn-default btn-rounded" style="border-bottom: 50%">
                            <i class="fa fa-plus-circle">Add</i>
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
                                            <th>Question</th>
                                            <th>Option</th>
                                            <th>Point</th>
                                            <th>Answer</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if($data): ?>
                                            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($loop->iteration); ?></td>
                                                    <td><?php echo e($value->title); ?></td>
                                                    <td>
                                                        <ul>
                                                            <?php $__currentLoopData = $value->option_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <li><?php echo e($item->option_text); ?></li>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                                        
                                                        </ul>
                                                    </td>
                                                    <td><?php echo e($value->point); ?></td>
                                                    <td>
                                                       <?php echo e(@ $value->answer_info['answer']); ?>

                                                    </td>
                                                    <td>
                                                        <span class="badge badge-<?php echo e($value->status == 'active' ? 'success' : 'danger'); ?>">
                                                            <?php echo e(ucfirst(($value->status == 'active') ? 'Active' : 'In-active')); ?>

                                                        </span>
                                                    </td>
                                                    <td>
                                                        <ul class="nav nav-pills">
                                                            <li>
                                                                <a data-toggle="tooltip" data-placement="bottom" title="edit" href="<?php echo e(route('quiz_question/edit', $value->id)); ?>">
                                                                    <i class="fa fa-edit fa-2x" style="color:#878787;"></i>
                                                                </a> 
                                                            </li>
                                                            <li>
                                                                <a data-toggle="tooltip" data-placement="bottom" title="delete" href="">
                                                                    <?php echo e(Form::open(['url'=>route('question.destroy', $value->id), 'class'=>'form float-right', 'onsubmit'=>'return confirm("Are you sure to delete??")'])); ?>

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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\iec\resources\views/admin/quiz_questions/list.blade.php ENDPATH**/ ?>