
<?php $__env->startSection('title','Contributor'); ?>

<?php $__env->startSection('content'); ?>

<div class="container-fluid">
					
    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
          <h5 class="txt-dark">Contributor Elements</h5>
        </div>
    </div>
    <!-- /Title -->
    
    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view col-md-8">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Contributor <?php echo e(isset($contributor_detail)? 'Update' : 'Add'); ?> form</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="form-wrap">
                            <?php if(isset($contributor_detail)): ?>
                                <?php echo e(Form::open(['url'=>route('contributor.update', @$contributor_detail->id),'id'=>"uploadform", 'files'=>true, 'class'=> 'form'])); ?>

                                <?php echo method_field('put'); ?>
                            <?php else: ?>
                                <?php echo e(Form::open(['url'=>route('contributor.store'), 'files'=>true, 'class'=> 'form', 'id'=>"uploadform"])); ?>

                            <?php endif; ?>
        
        
                            <div class="form-group row">
                                <?php echo e(Form::label('name','Full Name: ',['class'=>'col-sm-3'])); ?>

                                <div class="col-sm-9">
                                    <?php echo e(Form::text('name', @$contributor_detail->name, ['class'=>'form-control form-control-sm', 'id'=>'name', 'placeholder'=>'Enter name...', 'require'=>true])); ?>

                                    <?php $__errorArgs = ['name'];
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
                                <?php echo e(Form::label('email','Email-address: ',['class'=>'col-sm-3'])); ?>

                                <div class="col-sm-9">
                                    <?php echo e(Form::email('email', @$contributor_detail->email, ['class'=>'form-control form-control-sm', 'id'=>'email', 'placeholder'=>'Enter email...', 'require'=>true])); ?>

                                    <?php $__errorArgs = ['email'];
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
                                <?php echo e(Form::label('address','Address: ',['class'=>'col-sm-3'])); ?>

                                <div class="col-sm-9">
                                    <?php echo e(Form::text('address', @$contributor_detail->address, ['class'=>'form-control form-control-sm', 'id'=>'address', 'placeholder'=>'Enter address...', 'require'=>false])); ?>

                                    <?php $__errorArgs = ['address'];
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
                                <?php echo e(Form::label('phone','Contact no.: ',['class'=>'col-sm-3'])); ?>

                                <div class="col-sm-9">
                                    <?php echo e(Form::number('phone', @$contributor_detail->phone, ['class'=>'form-control form-control-sm', 'id'=>'phone', 'placeholder'=>'Enter phone...', 'require'=>false])); ?>

                                    <?php $__errorArgs = ['phone'];
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
                                    <?php echo e(Form::textarea('detail', html_entity_decode(@$contributor_detail->detail), ['class'=>'form-control', 'id'=>'detail', 'placeholder'=>'Enter Category detail...', 'require'=>false, 'style'=>'resize: none;', 'rows' =>'5'])); ?>

                                  <?php $__errorArgs = ['detail'];
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
                                <?php echo e(Form::label('image', '',['class'=>'col-sm-3'])); ?>

                                <div class="col-sm-4">
                                    <?php echo e(Form::file('image', ['id'=>'image', 'required'=>(isset($contributor_detail)? false: true), 'accept'=>'file'])); ?> 
                                  <?php $__errorArgs = ['image'];
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
                                        <?php if(isset($contributor_detail)): ?>
                                        <?php if(file_exists(public_path().'/upload/contributor/'.$contributor_detail->image)): ?>
                                        <img id="old" src="<?php echo e(asset('/upload/contributor/'.$contributor_detail->image)); ?>">
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
    $("#image").change(function(){
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ausnepc/firescreen.ausnep.com/resources/views/admin/contributor-form.blade.php ENDPATH**/ ?>