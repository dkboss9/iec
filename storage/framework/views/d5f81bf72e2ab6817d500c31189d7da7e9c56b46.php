
<?php $__env->startSection('title','Newsletter'); ?>
<?php $__env->startSection('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('plugins/datetimepicker/jquery.datetimepicker.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<div class="container-fluid">
					
    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
          <h5 class="txt-dark">Newsletter Elements</h5>
        </div>
    </div>
    <!-- /Title -->
    
    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view col-md-8">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Newsletter <?php echo e(isset($newsletter)? 'Update' : 'Add'); ?> form</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="form-wrap">
                            <?php if(isset($newsletter)): ?>
                                <?php echo e(Form::open(['url'=>route('newsletter.update', @$newsletter->id),'id'=>"uploadform", 'files'=>true, 'class'=> 'form'])); ?>

                                <?php echo method_field('put'); ?>
                            <?php else: ?>
                                <?php echo e(Form::open(['url'=>route('newsletter.store'), 'files'=>true, 'class'=> 'form', 'id'=>"uploadform"])); ?>

                            <?php endif; ?>
        
        
                            <div class="form-group row">
                                <?php echo e(Form::label('title','Title : ',['class'=>'col-sm-3'])); ?>

                                <div class="col-sm-9">
                                    <?php echo e(Form::text('title', @$newsletter->title, ['class'=>'form-control form-control-sm', 'id'=>'title', 'placeholder'=>'Enter title...', 'require'=>true])); ?>

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
                                <?php echo e(Form::label('message','Message : ',['class'=>'col-sm-3'])); ?>

                                <div class="col-sm-9">
                                    <?php echo e(Form::textarea('message', html_entity_decode(@$newsletter->message), ['class'=>'form-control', 'id'=>'message', 'placeholder'=>'Enter Category message...', 'require'=>true, 'style'=>'resize: none;', 'rows' =>'5'])); ?>

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

                            

                            <?php if(isset($newsletter)): ?>
                                <div class="form-group row">
                                    <?php echo e(Form::label('status','Status : ',['class'=>'col-sm-3'])); ?>

                                    <div class="col-sm-9">
                                        <?php echo e(Form::select('status',['sent'=>'Sent', 'pending'=>'Pending'],@$newsletter->status, ['id'=>'status', 'require'=>true, 'class'=>'form-control form-control-sm'])); ?>

                                        <?php $__errorArgs = ['status'];
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
                            <?php endif; ?>
                        
                            <div class="form-group row">
                                <?php echo e(Form::label('Attachment :', '',['class'=>'col-sm-3'])); ?>

                                <div class="col-sm-4">
                                    <?php echo e(Form::file('attachment', ['id'=>'attachment', 'required'=>false, 'accept'=>'file'])); ?> 
                                  <?php $__errorArgs = ['attachment'];
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
                                <div class="col-sm-4">
                                    <div class="thumbnail <?php echo e((isset($newsletter)? '': 'hidden')); ?>" id="view" >
                                        <span class="close">&times;</span>
                                        <?php if(isset($newsletter)): ?>
                                        <?php if(file_exists('upload/newsletter/'.$newsletter->attachment)): ?>
                                         <a href="<?php echo e(asset('upload/newsletter/'.$newsletter->attachment)); ?>" target="_blank"><i class="fa fa-paperclip fa-4x"></i>  </a>
                                        <?php endif; ?> 
                                        <?php endif; ?>
                                        <img src="" id="preview">  
                                       
                                    </div>
                                </div>                               
                            </div>
        
                            <div class="form-group row">
                                <?php echo e(Form::label('','',['class'=>'col-sm-3'])); ?>

                                <div class="col-sm-9">
                                    <?php echo e(Form::button("<i class='fa fa-trash'></i> Reset", ['class'=>'btn btn-danger','type'=>'reset'])); ?>

                                    <?php echo e(Form::button("<i class='fa fa-paper-plane'></i> Submit", ['class'=>'btn btn-success','type'=>'submit'])); ?>

                                </div>
                            </div>
                            <?php echo e(Form::close()); ?>

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

<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#preview').attr('src', e.target.result);
                $('#view').removeClass('hidden');
                $('#old').remove();
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#attachment").change(function(){
        readURL(this);
    });

    $(document).on('click', '.close', function() {
        $(this).parent().remove();
    });
</script>
<script src="<?php echo e(asset('plugins/datetimepicker/build/jquery.datetimepicker.full.js')); ?>"></script>
<script>
        $('#schedule_date').datetimepicker({
        format: 'Y-m-d H:i:s',
    });
   
</script>
<script>
    tinymce.init({
        selector: '#message'
    });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ausnepc/firescreen.ausnep.com/resources/views/admin/newsletter-form.blade.php ENDPATH**/ ?>