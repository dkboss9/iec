
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
    
    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view col-md-8">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Programs <?php echo e(isset($participant_detail)? 'Update' : 'Add'); ?> form</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="form-wrap">
                            <?php if(isset($participant_detail)): ?>
                                <?php echo e(Form::open(['url'=>route('participant.update', @$participant_detail->id),'id'=>"uploadform", 'files'=>true, 'class'=> 'form'])); ?>

                                <?php echo method_field('put'); ?>
                            <?php else: ?>
                                <?php echo e(Form::open(['url'=>route('participant.store'), 'files'=>true, 'class'=> 'form', 'id'=>"uploadform"])); ?>

                            <?php endif; ?>
        
        
                            <div class="form-group row">
                                <?php echo e(Form::label('program_id','Program* : ',['class'=>'col-sm-3'])); ?>

                                <div class="col-sm-9">
                                    <?php echo e(Form::select('program_id',$program, @$participant_detail->program_id, ['id'=>'program_id', 'required'=>true, 'class'=>'form-control form-control-sm','placeholder'=>'--Select any one--'])); ?>

                                    <?php $__errorArgs = ['program_id'];
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
                                <?php echo e(Form::label('name','Full Name* : ',['class'=>'col-sm-3'])); ?>

                                <div class="col-sm-9">
                                    <?php echo e(Form::text('name', @$participant_detail->name, ['class'=>'form-control form-control-sm', 'id'=>'name', 'placeholder'=>'Enter name...', 'required'=>true])); ?>

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
                                <?php echo e(Form::label('email','Email Address* : ',['class'=>'col-sm-3'])); ?>

                                <div class="col-sm-9">
                                    <?php echo e(Form::email('email', @$participant_detail->email, ['class'=>'form-control form-control-sm', 'id'=>'email', 'placeholder'=>'Enter email address...', 'required'=>true])); ?>

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
                                <?php echo e(Form::label('state','State* : ',['class'=>'col-sm-3'])); ?>

                                <div class="col-sm-9">
                                    <?php echo e(Form::text('state', @$participant_detail->state, ['class'=>'form-control form-control-sm', 'id'=>'state', 'placeholder'=>'Enter state...', 'required'=>true])); ?>

                                    <?php $__errorArgs = ['state'];
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
                                <?php echo e(Form::label('city','City* : ',['class'=>'col-sm-3'])); ?>

                                <div class="col-sm-9">
                                    <?php echo e(Form::text('city', @$participant_detail->city, ['class'=>'form-control form-control-sm', 'id'=>'city', 'placeholder'=>'Enter city...', 'required'=>true])); ?>

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
                                <?php echo e(Form::label('address','Address* : ',['class'=>'col-sm-3'])); ?>

                                <div class="col-sm-9">
                                    <?php echo e(Form::text('address', @$participant_detail->address, ['class'=>'form-control form-control-sm', 'id'=>'address', 'placeholder'=>'Enter address...', 'required'=>true])); ?>

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
                                <?php echo e(Form::label('phone','Contact No.* : ',['class'=>'col-sm-3'])); ?>

                                <div class="col-sm-9">
                                    <?php echo e(Form::text('phone', @$participant_detail->phone, ['class'=>'form-control form-control-sm', 'id'=>'phone', 'placeholder'=>'Enter phone...', 'required'=>true])); ?>

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
                                <?php echo e(Form::label('talent','Talent Detail*: ',['class'=>'col-sm-3'])); ?>

                                <div class="col-sm-9">
                                    <?php echo e(Form::textarea('talent', html_entity_decode(@$participant_detail->talent), ['class'=>'form-control', 'id'=>'talent', 'placeholder'=>'Enter Programs talent...', 'require'=>true, 'style'=>'resize: none;', 'rows' =>'5'])); ?>

                                  <?php $__errorArgs = ['talent'];
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
                                <?php echo e(Form::label('dob','Birth Date*: ',['class'=>'col-sm-3'])); ?>

                                <div class="col-md-9">
                                    <?php echo e(Form::input('date',  'dob', date('Y-m-d', strtotime(@$participant->dob)),['id'=>'dob', 'max'=>\Carbon\Carbon::now(), 'required'=>true, 'class'=>'form-control form-control-sm'] )); ?>

                                    <?php $__errorArgs = ['dob'];
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
                                <?php echo e(Form::label('status','Status: ',['class'=>'col-sm-3'])); ?>

                                <div class="col-sm-9">
                                    <?php echo e(Form::select('status',['active'=>'Publish', 'inactive'=>'Unpublish'],@$participant_detail->status, ['id'=>'status', 'required'=>true, 'class'=>'form-control form-control-sm'])); ?>

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
                                <?php echo e(Form::label('image', 'Photo*:',['class'=>'col-sm-3'])); ?>

                                <div class="col-sm-4">
                                    <?php echo e(Form::file('image', ['id'=>'image', 'required'=>(isset($participant_detail->image)? false: true), 'class'=>'form-control', 'accept'=>'image/*'])); ?> 
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
                                    <div class="thumbnail <?php echo e((isset($participant_detail)? '': 'hidden')); ?>" id="view" >
                                        <span class="close">&times;</span>
                                        <?php if(isset($participant_detail->image)): ?>
                                        <?php if(file_exists(public_path().'/upload/participant/'.$participant_detail->image)): ?>
                                        <img id="old" src="<?php echo e(asset('/upload/participant/'.$participant_detail->image)); ?>">
                                        <?php endif; ?>
                                        <?php endif; ?>
                                        <img src="" id="preview">  
                                    </div>
                                </div>                               
                            </div> 
                            
                            <div class="form-group row">
                                <?php echo e(Form::label('identification_type','Identification Type* : ',['class'=>'col-sm-3'])); ?>

                                <div class="col-sm-9">
                                    <?php echo e(Form::select('identification_type',[
                                        'citizenship'=>'Citizenship', 
                                        'passport'=>'Passport',
                                        'license'=>'License',
                                        'birth_certificate'=>'Birth Certificate',
                                    ],@$participant_detail->identification_type, ['id'=>'identification_type', 'required'=>true, 'placeholder'=>'Select any one','class'=>'form-control form-control-sm'])); ?>

                                    <?php $__errorArgs = ['identification_type'];
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
                                <?php echo e(Form::label('identification', 'Identity*:',['class'=>'col-sm-3'])); ?>

                                <div class="col-sm-4">
                                    <?php echo e(Form::file('identification[]', ['id'=>'identification', 'required'=>(isset($participant_detail->identification)? false: true), 'multiple'=> 2, 'class'=>'form-control', 'accept'=>'image/*'])); ?> 
                                    <?php $__errorArgs = ['identification'];
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
                                <div class="form-group clear btn btn-primary hide" id="clea">Clear &times;</div>
                            </div>                             
                            
                            <div class="form-group row" id="preview_img"></div>
                            <?php if(@$participant_detail): ?>
                                <div class="form-group row thumb" id="pvalue">
                                    <?php
                                        $array = explode("|", $participant_detail->identification);
                                    ?>
                                    <?php $__currentLoopData = $array; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a target="blank_" href="<?php echo e(asset('upload/participant/'.$item)); ?>">
                                            <img src="<?php echo e(asset('upload/participant/'.$item)); ?>" style="max-height:200px;" alt="">
                                        </a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            <?php endif; ?>
                            
                            
                            <div class="form-group row">
                                <?php echo e(Form::label('video', 'Video*:',['class'=>'col-sm-3'])); ?>

                                <div class="col-sm-4">
                                    <?php echo e(Form::file('video', ['id'=>'video', 'require'=>(isset($participant_detail->video)? false: true), 'class'=>'form-control', 'accept'=>'video/mp4,video/x-m4v,video/*'])); ?> 
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
                                <?php if(@$participant_detail->video != null): ?>
                                <div class="col-sm-4">
                                    <div class=" <?php echo e((isset($participant_detail->video)? '': 'hidden')); ?>" id="view" >
                                       <a href="<?php echo e(route('download-video',@$participant_detail->video)); ?>" class="btn btn-primary">Preview</a>
                                    </div>
                                </div>  
                                <?php endif; ?>
                            </div>
                            <?php if(@$participant_detail->video != null): ?>
                                <div class="form-group row hide">
                                    <div class="card-footer p-4 form-group" >
                                        <video id="videoPreview" src="<?php echo e(isset($participant_detail)? asset('upload/program-participate/'.$participant_detail->video) : ''); ?>" controls="controls" style="width: 100%; height: auto"></video>
                                    </div>
                                </div>
                            <?php endif; ?>
                            
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
        $('.clear').on('click', function() { 
            $('#identification').val('');  
            $('#clea').addClass('hide');  
            $("#preview_img img:last-child").remove();   
        });
    });
</script>
<script>    
    dob.max = new Date().toISOString().split("T")[0];
</script>
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
    $("#image").change(function(){
        readURL(this);
    });

    $(document).on('click', '.close', function() {
        $('#image').val('');
        $('#preview').removeAttr('src');
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#identification').on('change', function(){ //on file input change
        if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
        {

            var data = $(this)[0].files; //this file data

            $.each(data, function(index, file){ //loop though each file
                if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                    var fRead = new FileReader(); //new filereader
                    fRead.onload = (function(file){ //trigger function on successful read
                    return function(e) {
                        var img = $('<img/>').addClass('thumb').attr({
                            src: e.target.result,
                            width: '50%',
                            height: "200px;"
                        }); //create image element 
                        $('#preview_img').append(img); //append image to output element
                    };
                    })(file);
                    fRead.readAsDataURL(file); //URL representing the file's data.
                }
            });
            $('#clea').removeClass('hide');
            $("#pvalue").hide();
                
        }else{
            alert("Your browser doesn't support File API!"); //if File API is absent
        }
        });
    });
</script>

<script>
    tinymce.init({
        selector: '#talent'
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ausnepc/firescreen.ausnep.com/resources/views/admin/program/participant-form.blade.php ENDPATH**/ ?>