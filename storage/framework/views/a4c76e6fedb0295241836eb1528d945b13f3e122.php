
<?php $__env->startSection('title','FSTV NEWS | Advertise'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
					
    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
          <h5 class="txt-dark">Advertise Elements</h5>
        </div>
    </div>
    <!-- /Title -->
    
    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view col-md-8">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Advertise <?php echo e(isset($advertise_detail)? 'Update' : 'Add'); ?> form</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="form-wrap">
                            <?php if(isset($advertise_detail)): ?>
                                <?php echo e(Form::open(['url'=>route('advertise.update', $advertise_detail->id), 'files'=>true, 'class'=> 'form'])); ?>

                                <?php echo method_field('put'); ?>
                            <?php else: ?>
                                <?php echo e(Form::open(['url'=>route('advertise.store'), 'files'=>true, 'class'=> 'form'])); ?>

                            <?php endif; ?>


                            <div class="form-group row">
                                <?php echo e(Form::label('title','Title* : ',['class'=>'col-sm-3'])); ?>

                                <div class="col-sm-9">
                                    <?php echo e(Form::text('title', @$advertise_detail->title, ['class'=>'form-control form-control-sm', 'id'=>'title', 'placeholder'=>'Enter Advertise title...', 'require'=>true])); ?>

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
                                <?php echo e(Form::label('link_type','Advertise Link Type* : ',['class'=>'col-sm-3'])); ?>

                                <div class="col-sm-9">
                                    <?php echo e(Form::select('link_type',['internal'=>'Internal', 'external'=>'External'],@$advertise_detail->link_type, ['id'=>'link_type', 'placeholder'=>'Choose', 'require'=>true, 'class'=>'form-control form-control-sm'])); ?>

                                    <?php $__errorArgs = ['link_type'];
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
                                <?php $__errorArgs = ['ilink'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="alert-danger"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <?php $__errorArgs = ['link'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="alert-danger"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                            <div class="url">
                                
                                    <div class="form-group row <?php echo e(isset($advertise_detail->link)?'': 'hidden'); ?>" id="linkdiv">
                                        <?php echo e(Form::label('link','Link* : ',['class'=>'col-sm-3'])); ?>

                                        <div class="col-sm-9">
                                            <?php echo e(Form::url('link',@$advertise_detail->link, ['class'=>'form-control form-control-sm', 'id'=>'link', 'placeholder'=>'Enter Advertise link...', 'require'=>false])); ?>

                                        </div>
                                    </div>
                                    <div class="form-group row <?php echo e(isset($advertise_detail->ilink)?'': 'hidden'); ?>" id="ilinkdiv">
                                        <?php echo e(Form::label('ilink','Link* : ',['class'=>'col-sm-3'])); ?>

                                        <div class="col-sm-9">
                                            <?php echo e(Form::text('ilink',@$advertise_detail->ilink, ['class'=>'form-control form-control-sm', 'id'=>'ilink', 'placeholder'=>'Enter internal link...', 'require'=>false])); ?>

                                        </div>
                                    </div>
                                
                            </div>

                            

                            <div class="form-group row">
                                <?php echo e(Form::label('status','Status* : ',['class'=>'col-sm-3'])); ?>

                                <div class="col-sm-9">
                                    <?php echo e(Form::select('status',['active'=>'Publish', 'inactive'=>'Unpublish'],@$advertise_detail->status, ['id'=>'status', 'require'=>true, 'class'=>'form-control form-control-sm'])); ?>

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
                            
                            <div class="form-group row">
                                <?php echo e(Form::label('type','Advertise Type* : ',['class'=>'col-sm-3'])); ?>

                                <div class="col-sm-9">
                                    <?php echo e(Form::select('type',['image'=>'Image', 'video'=>'Video'],@$advertise_detail->type, ['id'=>'type', 'require'=>true, 'class'=>'form-control form-control-sm'])); ?>

                                    <?php $__errorArgs = ['type'];
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

                            <div class="form-group row" id="photo">
                                <?php echo e(Form::label('Image', 'Image/Video*:',['class'=>'col-sm-3'])); ?>

                                <div class="col-sm-4">
                                    <?php echo e(Form::file('image', ['id'=>'image', 'required'=>(isset($advertise_detail)? false: true), 'accept'=>'image/*'])); ?>  
                                </div>
                                <div class="col-sm-4">
                                    <div class="thumbnail <?php echo e((isset($advertise_detail)? '': 'hidden')); ?>" id="view" >
                                        <span class="close">&times;</span>
                                        <?php if(isset($advertise_detail)): ?>
                                        <?php if(file_exists(public_path().'/upload/advertise/'.$advertise_detail->image)): ?>
                                        <img id="old" src="<?php echo e(asset('/upload/advertise/'.$advertise_detail->image)); ?>">
                                        <?php endif; ?>
                                        <?php else: ?>
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
<script>
$(document).ready(function(){
    $('#type').change(function (){
        let stype = $(this).val();
        img = stype != 'image' ? $('#image').attr("accept", "video/mp4,video/x-m4v,video/*") : '';
    });    
});
</script>

<script>
    $('select').on('change', function() {
    // alert( this.value );
    if (this.value == 'internal') {
        $('#ilinkdiv').removeClass('hidden');
        $('#linkdiv').addClass('hidden').val("");

    }else if(this.value == 'external'){
        $('#linkdiv').removeClass('hidden');
        $('#ilinkdiv').addClass('hidden').val("");

    }

    });
</script>

<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#view').removeClass('hidden');
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ausnepc/firescreen.ausnep.com/resources/views/admin/advertise-form.blade.php ENDPATH**/ ?>