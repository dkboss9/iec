
<?php $__env->startSection('title','Media'); ?>

<?php $__env->startSection('content'); ?>

<div class="container-fluid">
					
    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
          <h5 class="txt-dark">Media Elements</h5>
        </div>
    </div>
    <!-- /Title -->
    
    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view col-md-8">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Media <?php echo e(isset($media_detail)? 'Update' : 'Add'); ?> form</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="form-wrap">
                            <?php if(isset($media_detail)): ?>
                                <?php echo e(Form::open(['url'=>route('media.update', @$media_detail->id),'id'=>"uploadform", 'files'=>true, 'class'=> 'form'])); ?>

                                <?php echo method_field('put'); ?>
                            <?php else: ?>
                                <?php echo e(Form::open(['url'=>route('media.store'), 'files'=>true, 'class'=> 'form', 'id'=>"uploadform"])); ?>

                            <?php endif; ?>
        
        
                            <div class="form-group row">
                                <?php echo e(Form::label('title','Title: ',['class'=>'col-sm-3'])); ?>

                                <div class="col-sm-9">
                                    <?php echo e(Form::text('title', @$media_detail->title, ['class'=>'form-control form-control-sm', 'id'=>'title', 'placeholder'=>'Enter title...', 'require'=>true])); ?>

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
                                <?php echo e(Form::label('subtitle','Sub-title: ',['class'=>'col-sm-3'])); ?>

                                <div class="col-sm-9">
                                    <?php echo e(Form::text('subtitle', @$media_detail->subtitle, ['class'=>'form-control form-control-sm', 'id'=>'subtitle', 'placeholder'=>'Enter subtitle...', 'require'=>false])); ?>

                                    <?php $__errorArgs = ['subtitle'];
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
                                <?php echo e(Form::label('detail','Descriptions: ',['class'=>'col-sm-3'])); ?>

                                <div class="col-sm-9">
                                    <?php echo e(Form::textarea('detail', @$media_detail->detail, ['class'=>'form-control', 'id'=>'detail', 'placeholder'=>'Enter Category detail...', 'require'=>false, 'style'=>'resize: none;', 'rows' =>'5'])); ?>

                                </div>
                            </div>
                           

                            <div class="form-group row">
                                <?php echo e(Form::label('link','Link: ',['class'=>'col-sm-3'])); ?>

                                <div class="col-sm-9">
                                    <?php echo e(Form::url('link', @$media_detail->link, ['class'=>'form-control form-control-sm', 'id'=>'link', 'placeholder'=>'Enter Media link...', 'require'=>false])); ?>

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
                                </div>
                            </div>

                            <div class="form-group row">
                                <?php echo e(Form::label('video', '',['class'=>'col-sm-3'])); ?>

                                <div class="col-sm-4">
                                    <?php echo e(Form::file('video', ['id'=>'video', 'required'=>false, 'accept'=>'file'])); ?> 
                                  <?php $__errorArgs = ['video'];
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
                                    <div class="thumbnail" >
                                        <span class="close">&times;</span>
                                        <?php if(isset($media_detail)): ?>
                                        <?php if(file_exists(public_path().'/upload/media/'.$media_detail->video)): ?>
                                        <video src="<?php echo e(asset('/upload/media/'.$media_detail->video)); ?>" height="200" width="300">
                                        </video>
                                        
                                        <?php endif; ?>
                                        <?php endif; ?>
                                        <img src="" id="preview" alt="Preview">  
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
                $('#old').remove();
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#thumbnail").change(function(){
        readURL(this);
    });

    $(document).on('click', '.close', function() {
        $(this).parent().remove();
    });
</script>
<script>
    tinymce.init({
        selector: '#detail'
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ausnepc/firescreen.ausnep.com/resources/views/admin/media-form.blade.php ENDPATH**/ ?>