
<?php $__env->startSection('title','FSTV| Operator'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
					
    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
          <h5 class="txt-dark">Operator Elements </h5>
        </div>
    </div>
    <!-- /Title -->
    
    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view col-md-8">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Operator <?php echo e(isset($user_detail)? 'Update' : 'Add'); ?> Form</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="form-wrap">
                    <?php if(isset($user_detail)): ?>
                        <?php echo e(Form::open(['url'=>route('operator.update', $user_detail->id), 'files'=>true, 'class'=> 'form'])); ?>

                        <?php echo method_field('put'); ?>
                    <?php else: ?>
                        <?php echo e(Form::open(['url'=>route('operator.store'), 'files'=>true, 'class'=> 'form'])); ?>

                    <?php endif; ?>

                    <div class="form-group row">
                        <?php echo e(Form::label('name','Full Name*: ',['class'=>'col-sm-3'])); ?>

                        <div class="col-sm-9">
                            <?php echo e(Form::text('name', @$user_detail->name, ['class'=>'form-control form-control-sm', 'id'=>'name', 'placeholder'=>'Enter Full name...', 'require'=>true])); ?>

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
                        <?php echo e(Form::label('email','Email*: ',['class'=>'col-sm-3'])); ?>

                        <div class="col-sm-9">
                            <?php echo e(Form::email('email', @$user_detail->email, [ 'readonly','class'=>'form-control form-control-sm', 'id'=>'email', 'placeholder'=>'Enter User email...', 'require'=>(isset($user_detail) ? false : true )])); ?>

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

                    <div class="form-group row <?php echo e(isset($user_detail) ? '': 'hidden'); ?>">
                        <?php echo e(Form::label('change_password','Change Password: ',['class'=>'col-sm-3'])); ?>

                        <div class="col-sm-9">
                            <?php echo e(Form::checkbox('change_password',1, )); ?> Yes
                        </div>
                    </div>

                    <div class="password_change <?php echo e(isset($user_detail) ? 'hidden': ''); ?>">
                        <div class="form-group row">
                            <?php echo e(Form::label('password','Password*: ',['class'=>'col-sm-3'])); ?>

                            <div class="col-sm-9">
                                <?php echo e(Form::password('password',['class'=>'form-control form-control-sm', 'id'=>'password', 'placeholder'=>'Enter User password...', 'require'=>(isset($user_detail) ? false : true )])); ?>

                                <?php $__errorArgs = ['password'];
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
                            <?php echo e(Form::label('password_confirmation','Confirm-Password*: ',['class'=>'col-sm-3'])); ?>

                            <div class="col-sm-9">
                                <?php echo e(Form::password('password_confirmation',['class'=>'form-control form-control-sm', 'id'=>'password_confirmation', 'placeholder'=>'Enter User password_confirmation...', 'require'=>(isset($user_detail) ? false : true) ])); ?>

                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <?php echo e(Form::label('citizenship','Citizenship/Passport No*: ',['class'=>'col-sm-3'])); ?>

                        <div class="col-sm-9">
                            <?php echo e(Form::text('citizenship', @$user_detail->operator_info['citizenship'], ['class'=>'form-control form-control-sm', 'id'=>'citizenship', 'placeholder'=>'Enter citizenship/passport number...', 'require'=>true])); ?>

                            <?php $__errorArgs = ['citizenship'];
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
                        <?php echo e(Form::label('other_id','Other ID: ',['class'=>'col-sm-3'])); ?>

                        <div class="col-sm-9">
                            <?php echo e(Form::text('other_id', @$user_detail->operator_info['other_id'], ['class'=>'form-control form-control-sm', 'id'=>'other_id', 'placeholder'=>'Enter User other_id...', 'require'=>false])); ?>

                            <?php $__errorArgs = ['other_id'];
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
                        <?php echo e(Form::label('is_verified','ID verification: ',['class'=>'col-sm-3'])); ?>

                        <div class="col-sm-9">
                            <?php echo e(Form::checkbox('is_verified',1, @$user_detail->operator_info['is_verified'], ['id'=>'is_verified'])); ?>

                            Yes
                            <?php $__errorArgs = ['is_verified'];
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
                    <div class="form-group row hidden">
                        <?php echo e(Form::label('category','News Category* : ',['class'=>'col-sm-3'])); ?>

                        <div class="col-sm-9">
                            <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $checked = false;
                                        //as we loop through a list of all itens, we compare to the values retrieved from our pivot table
                                if (isset($ass)) {
                                    if(in_array($item->id, $ass)) $checked = true;
                                }
                            ?>
                            <?php echo e(Form::checkbox('category[]', $item->id, $checked)); ?>

                            <?php echo e($item->title); ?>

                                
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <div class="form-group row hidden">
                        <?php echo e(Form::label('menu','Video Category* : ',['class'=>'col-sm-3'])); ?>

                        <div class="col-sm-9">
                            <?php $__currentLoopData = $menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $checked = false;
                                        //as we loop through a list of all itens, we compare to the values retrieved from our pivot table
                                if (isset($men)) {
                                    if(in_array($item->id, $men)) $checked = true;
                                }
                            ?>
                            <?php echo e(Form::checkbox('menu[]', $item->id, $checked)); ?>

                            <?php echo e($item->title); ?>

                                
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>  
                    <div class="form-group row hidden">
                        <?php echo e(Form::label('blog','Blogs: ',['class'=>'col-sm-3'])); ?>

                        <div class="col-sm-9">
                            <?php echo e(Form::checkbox('blog',1, @$user_detail->operator_info['blog'], ['id'=>'blog'])); ?>

                            Yes
                            <?php $__errorArgs = ['blog'];
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
                    <div class="form-group row hidden">
                        <?php echo e(Form::label('gallery','Gallery: ',['class'=>'col-sm-3'])); ?>

                        <div class="col-sm-9">
                            <?php echo e(Form::checkbox('gallery',1, @$user_detail->operator_info['gallery'], ['id'=>'gallery'])); ?>

                            Yes
                            <?php $__errorArgs = ['gallery'];
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
                    <div class="form-group row hidden">
                        <?php echo e(Form::label('advertise','Advertise: ',['class'=>'col-sm-3'])); ?>

                        <div class="col-sm-9">
                            <?php echo e(Form::checkbox('advertise',1, @$user_detail->operator_info['advertise'], ['id'=>'advertise'])); ?>

                            Yes
                            <?php $__errorArgs = ['advertise'];
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
                        <?php echo e(Form::label('country','Country*: ',['class'=>'col-sm-3'])); ?>

                        <div class="col-sm-9">
                            <?php echo e(Form::text('country', @$user_detail->operator_info['country'], ['class'=>'form-control form-control-sm', 'id'=>'country', 'placeholder'=>'Enter country...', 'require'=>true])); ?>

                            <?php $__errorArgs = ['country'];
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
                        <?php echo e(Form::label('city','City*: ',['class'=>'col-sm-3'])); ?>

                        <div class="col-sm-9">
                            <?php echo e(Form::text('city', @$user_detail->operator_info['city'], ['class'=>'form-control form-control-sm', 'id'=>'city', 'placeholder'=>'Enter city...', 'require'=>true])); ?>

                            <?php $__errorArgs = ['city'];
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
                            <?php echo e(Form::text('address', @$user_detail->operator_info['address'], ['class'=>'form-control form-control-sm', 'id'=>'address', 'placeholder'=>'Enter User address...', 'require'=>false])); ?>

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
                        <?php echo e(Form::label('phone','Phone Number: ',['class'=>'col-sm-3'])); ?>

                        <div class="col-sm-9">
                            <?php echo e(Form::tel('phone', @$user_detail->operator_info['phone'], ['class'=>'form-control form-control-sm', 'id'=>'phone', 'placeholder'=>'Enter User phone...', 'require'=>false])); ?>

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
                        <?php echo e(Form::label('detail','Description: ',['class'=>'col-sm-3'])); ?>

                        <div class="col-sm-9">   
                            <?php echo e(Form::textarea('detail', @$user_detail->operator_info['detail'], ['class'=>'form-control form-control-sm', 'id'=>'detail', 'placeholder'=>'Enter Additional Information...', 'require'=>false,'rows'=>5,'style'=>'resize-none'])); ?>

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
                            <?php echo e(Form::file('image', ['id'=>'image', 'required'=>false, 'accept'=>'file'])); ?>

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
                            <div class="thumbnail <?php echo e((isset($user_detail)? '': 'hidden')); ?>" id="view" >
                                <span class="close">&times;</span>
                                <?php if(isset($user_detail)): ?>
                                <?php if(file_exists(public_path().'/upload/users/'.$user_detail->operator_info['image'])): ?>
                                <img id="old" src="<?php echo e(asset('/upload/users/'.$user_detail->operator_info['image'])); ?>">
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
<?php echo $__env->make('layouts.operator', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ausnepc/firescreen.ausnep.com/resources/views/operator/profile-edit.blade.php ENDPATH**/ ?>