
<?php $__env->startSection('title','FSTV| Support'); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
                        
        <!-- Title -->
        <div class="row heading-bg">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-dark">Support Elements</h5>
                
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
                            <h6 class="panel-title txt-dark">Support Table</h6>
                        </div>
                        <div class="clearfix"></div>
                        <div class="pull-right">
                            <!-- Button trigger modal -->
                            <a type="button" class="btn btn-default btn-rounded" style="border-bottom: 50%" data-toggle="modal" data-target="#feedbackModal">
                                <i class="fa fa-plus-circle"><span></span> Create</i>
                            </a>
                            
                            <!-- Modal -->
                            <div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <form method="post" role="form" action="<?php echo e(route('feedback.store')); ?>" enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?>
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>                                
                                            <h4 class="modal-title">Your message to Admin</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group row">
                                                <?php echo e(Form::label('title','Title* : ',['class'=>'col-sm-3'])); ?>

                                                <div class="col-sm-9">
                                                    <?php echo e(Form::text('title', '', ['class'=>'form-control form-control-sm', 'id'=>'title', 'placeholder'=>'Enter title...', 'require'=>true])); ?>

                                                    <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <span class="alert-danger"><?php echo e($message); ?></span>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            </div>                                                       
                                            <div class="form-group row">
                                                <?php echo e(Form::label('message','Message* : ',['class'=>'col-sm-3'])); ?>

                                                <div class="col-sm-9">
                                                    <?php echo e(Form::textarea('message', '', ['class'=>'form-control', 'id'=>'message', 'placeholder'=>'Enter your message...', 'require'=>false, 'style'=>'resize: none;', 'rows' =>'8'])); ?>

                                                    <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <span class="alert-danger"><?php echo e($message); ?></span>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            </div>                                
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success" >Submit</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </form>
                                </div>
                                </div>
                            </div>
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
                                                <th>Message</th>                                               
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
                                                        <td>
                                                            <?php echo Illuminate\Support\Str::limit(html_entity_decode($row->message), 200); ?>

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

<?php echo $__env->make('layouts.editor', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ausnepc/firescreen.ausnep.com/resources/views/editor/feedback.blade.php ENDPATH**/ ?>