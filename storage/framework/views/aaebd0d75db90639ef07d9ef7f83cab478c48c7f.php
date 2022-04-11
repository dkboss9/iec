
<?php $__env->startSection('title','FSTV| Notification'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
					
    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
          <h5 class="txt-dark">Mass Notification</h5>
        </div>
    </div>
    <!-- /Title -->
    
    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view col-md-8">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Mass Notification Form</h6>
                    </div>
                    <div class="clearfix"></div>
                    <p>(Please fill up any one)</p>
                </div>

                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="form-wrap">
                    <?php if(isset($notification_detail)): ?>
                        <?php echo e(Form::open(['url'=>route('usernotification.update', $notification_detail->id), 'files'=>true, 'class'=> 'form'])); ?>

                        <?php echo method_field('put'); ?>
                    <?php else: ?>
                        <?php echo e(Form::open(['url'=>route('usernotification.store'), 'files'=>true, 'class'=> 'form'])); ?>

                    <?php endif; ?>

                    <div class="form-group row">
                        <div class="col-sm-12">
                            <?php echo e(Form::label('title','Title: ',['class'=>'col-sm-3'])); ?>

                            <?php echo e(Form::text('title', @$notification_detail->title, ['class'=>'form-control form-control-sm', 'id'=>'title', 'placeholder'=>'Enter title...'])); ?>

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
                        <div class="col-sm-12">   
                            <?php echo e(Form::label('description','Message: ')); ?>

                            <?php echo e(Form::textarea('description', @$notification_detail->description, ['class'=>'form-control form-control-sm', 'id'=>'description', 'placeholder'=>'Enter Additional Information...', 'require'=>false,'rows'=>5,'style'=>'resize-none'])); ?>

                            <?php $__errorArgs = ['description'];
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
                        <?php echo e(Form::label('','',['class'=>'col-sm-3'])); ?>

                        <div class="col-sm-9">
                           <?php echo e(Form::button("<i class='fa fa-paper-plane'></i> SEND", ['class'=>'btn btn-success','type'=>'submit'])); ?>

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
    <script>
        $('#change_password').change(function(e){
            let is_checked = $(this).prop('checked');
            if(is_checked){ 
                $('#password').attr('required','required');
                $('#password_confirmation').attr('required','required');
                $('.password_change').removeClass('hidden');
            } else {
                $('#password').removeAttr('required','required');
                $('#password_confirmation').removeAttr('required','required');
                $('.password_change').addClass('hidden');
            }
        });
    </script>

    <script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                    $('#view').removeClass('hidden');
                reader.onload = function (e) {
                    $('#preview').attr('src', e.target.result);
                    $('#old').remove();
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#image").change(function(){
            readURL(this);
        });

        $(document).on('click', '.close', function() {
            $(this).parent().remove();
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ausnepc/firescreen.ausnep.com/resources/views/admin/send-notification.blade.php ENDPATH**/ ?>