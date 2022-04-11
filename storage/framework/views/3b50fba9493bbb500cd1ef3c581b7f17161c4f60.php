
<?php $__env->startSection('title','Question'); ?>

<?php $__env->startSection('content'); ?>

<div class="container-fluid">
					
    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
          <h5 class="txt-dark">Question Elements</h5>
        </div>
    </div>
    <!-- /Title -->
    
    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view col-md-8">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Question <?php echo e(isset($question_detail)? 'Update' : 'Add'); ?> form</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="form-wrap">
                            <?php if(isset($question_detail)): ?>
                                <?php echo e(Form::open(['url'=>route('quiz_question/update', @$question_detail->id),'id'=>"uploadform", 'files'=>true, 'class'=> 'form'])); ?>

                                <?php echo method_field('put'); ?>
                            <?php else: ?>
                                <?php echo e(Form::open(['url'=>route('quiz_question/store'), 'files'=>true, 'class'=> 'form', 'id'=>"uploadform"])); ?>

                            <?php endif; ?>
        
                            
                             <div class="form-group row">
                                <?php echo e(Form::label('program','Program* : ',['class'=>'col-sm-3'])); ?>

                                <div class="col-sm-9">
                                <?php echo Form::select('program',  $quiz_programs, @$question_detail->program, ['class' => 'form-control']); ?>

                                    <?php $__errorArgs = ['program'];
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
                                <?php echo e(Form::label('q_title','Question* : ',['class'=>'col-sm-3'])); ?>

                                <div class="col-sm-9">
                                    <?php echo e(Form::textarea('title', @$question_detail->title, ['class'=>'form-control form-control-sm', 'id'=>'title', 'placeholder'=>'Enter question...', ''])); ?>

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
                                <?php echo e(Form::label('q_detail','Question descriptions : ',['class'=>'col-sm-3'])); ?>

                                <div class="col-sm-9">
                                    <?php echo e(Form::textarea('detail', @$question_detail->detail, ['class'=>'form-control form-control-sm', 'id'=>'q_detail', 'placeholder'=>'Enter question...', ''])); ?>

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
                                <?php echo e(Form::label('image', 'Image:',['class'=>'col-sm-3'])); ?>

                                <div class="col-sm-5">
                                    <?php echo e(Form::file('image', ['id'=>'image', 'accept'=>'image/*','class'=>'form-control'])); ?> 
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
                                    <div class="thumbnail <?php echo e((@$question_detail->image !="" ? '': 'hidden')); ?>" id="view" >
                                        <span class="close delete_qimage" id="<?php echo e($question_detail->id); ?>">&times;</span>
                                        <?php if(isset($question_detail->image)): ?>
                                        <?php if(file_exists(public_path().'/upload/question/'.$question_detail->image)): ?>
                                        <img id="old" src="<?php echo e(asset('/upload/question/'.$question_detail->image)); ?>"  style="width: 100px;">
                                        <?php endif; ?>
                                        <?php endif; ?>
                                        <img src="" id="preview"  style="max-width: 100px;">  
                                    </div>
                                </div>                               
                            </div>          
                            <div class="form-group row">
                                <?php echo e(Form::label('point','Point* : ',['class'=>'col-sm-3'])); ?>

                                <div class="col-sm-9">
                                    <?php echo e(Form::number('point', @$question_detail->point, ['class'=>'form-control form-control-sm', 'id'=>'point', 'min'=>1, 'placeholder'=>'Enter point...', 'required'])); ?>

                                    <?php $__errorArgs = ['point'];
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
                                <?php echo e(Form::label('time_period','Time Period (Secound)* : ',['class'=>'col-sm-3'])); ?>

                                <div class="col-sm-9">
                                    <?php echo e(Form::number('time_period', @$question_detail->time_period, ['class'=>'form-control form-control-sm', 'id'=>'time_period', 'min'=>1, 'placeholder'=>'Enter time period', 'required'])); ?>

                                    <?php $__errorArgs = ['time_period'];
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
                                <?php echo e(Form::label('status','Status* : ',['class'=>'col-sm-3'])); ?>

                                <div class="col-sm-9">
                                    <?php echo e(Form::select('status',['active'=>'Publish', 'inactive'=>'Unpublish'],@$question_detail->status, ['id'=>'status', 'required', 'class'=>'form-control form-control-sm'])); ?>

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
                            </div><hr>
                           
                            <div class="option">
                                <?php  $counter = 1;?>
                                <?php if(@$question_detail): ?>
                                    <?php $__currentLoopData = $question_detail->option_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                     <?php $counter = $key++;?>
                                     <input type="hidden" name="old_options[]" value="<?php echo e($item->id); ?>">
                                    <div class="add">
                                        <div class="form-group row">
                                            <?php echo e(Form::label('option_text','Option* : ',['class'=>'col-sm-3'])); ?>

                                            <div class="col-sm-9">
                                                <?php echo e(Form::text('option_text[]', @$item->option_text, ['class'=>'form-control form-control-sm', 'id'=>'option_text', 'placeholder'=>'Enter option_text...', 'required'])); ?>

                                                <?php $__errorArgs = ['option_text.*'];
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
                                        <?php echo e(Form::label('option_text','Image : ',['class'=>'col-sm-3'])); ?>

                                        <div class="col-sm-5">
                                        <?php echo e(Form::file('answer_image[]', ['id'=>$counter,'accept'=>'image/*','class'=>'form-control answer_image'])); ?> 
                                            <?php $__errorArgs = ['option_text'];
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
                                        <div class="thumbnail <?php echo e(($item->answer_image != ""? '': 'hidden')); ?>" id="view" >
                                            <span class="close delete_oimage" id="<?php echo e($item->id); ?>">&times;</span>
                                            <?php if(isset($item->answer_image)): ?>
                                            <?php if(file_exists(public_path().'/upload/answer/'.$item->answer_image)): ?>
                                            <img id="old" src="<?php echo e(asset('/upload/answer/'.$item->answer_image)); ?>"  style="width: 100px;">
                                            <?php endif; ?>
                                            <?php endif; ?>
                                            <img src="" id="preview"  style="max-width: 100px;">  
                                        </div>
                                            <img src="" class="preview" style="width: 100px;">  
                                            <input type="hidden" name="txt_option_image[]" value="<?php echo $item->answer_image;?>" id="txt_option_image<?php echo e($counter); ?>">
                                        </div>
                                    </div>
                                    </div>
                                   
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    
                                <?php else: ?> 
                                <div class="add">
                                <input type="hidden" name="old_options[]" value="0">
                                    <div class="form-group row">
                                        <?php echo e(Form::label('option_text','Option* : ',['class'=>'col-sm-3'])); ?>

                                        <div class="col-sm-9">
                                            <?php echo e(Form::text('option_text[]', @$question_detail->option_text, ['class'=>'form-control form-control-sm', 'id'=>'option_text', 'placeholder'=>'Enter option_text...', 'required'])); ?>

                                            <?php $__errorArgs = ['option_text.*'];
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
                                        <?php echo e(Form::label('option_text','Image : ',['class'=>'col-sm-3'])); ?>

                                        <div class="col-sm-5">
                                        <?php echo e(Form::file('answer_image[]', ['id'=>'1','accept'=>'image/*','class'=>'form-control answer_image'])); ?> 
                                            <?php $__errorArgs = ['option_text'];
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
                                     

                                            <img src="" class="preview" style="width: 100px;">  
                                            <input type="hidden" name="txt_option_image[]" id="txt_option_image1">
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                            <a href="javascript:void(0);" id="add_more" class="btn btn-primary"><i class="fa fa-plus-circle"> Add Option</i></a>
                            <a href="javascript:void(0);" id="remove" class="btn btn-primary"><i class="fa fa-minus-circle"> Remove</i></a>
                            
                            <hr>
                            <div class="form-group row">
                                <?php echo e(Form::label('','',['class'=>'col-sm-3'])); ?>

                                <div class="col-sm-9">
                                    <?php echo e(Form::button("<i class='fa fa-trash'></i> Reset", ['class'=>'btn btn-danger','type'=>'reset'])); ?>

                                    <?php echo e(Form::button("<i class='fa fa-paper-pane'></i> Next", ['class'=>'btn btn-success','type'=>'submit'])); ?>

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
    $(document).ready(function() {
        $("#image").change(function(){
            readURL(this);
        });

    function readanswerURL(input,id) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
               $('#'+id).parent().next().find("img").attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

        $(document).on("change",".answer_image",function(){ 
          //  readanswerURL(this,$(this).attr("id"));
            var id = $(this).attr("id");
			var file_data = $(this).prop('files')[0];
			var form_data = new FormData();
			form_data.append('file', file_data);
            form_data.append('_token','<?php echo e(csrf_token()); ?>');

			$.ajax({
				url: '<?php echo e(route("quiz_question/upload")); ?>', 
				dataType: 'text', 
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,
				type: 'post',
				success: function (response) {
					img = JSON.parse(response);
                    $('#'+id).parent().next().find("img").attr('src', img.src);
                    $("#txt_option_image"+id).val(img.file_name);
				},
				error: function (response) {
					$('#post_img_profile').html(response); 
				}
			});
        });
        var answers = '<?php echo e($counter); ?>';
        var wrapper = $(".option"); //Fields wrapper
        $('#add_more').click(function(e){ //on add input button click
            e.preventDefault();
            answers = answers + 1;
           // alert(answers);
            //add input box
            var template = `<div class="add">
            <input type="hidden" name="old_options[]" value="0">
                                    <div class="form-group row">
                                        <?php echo e(Form::label('option_text','Option* : ',['class'=>'col-sm-3'])); ?>

                                        <div class="col-sm-9">
                                            <?php echo e(Form::text('option_text[]', @$question_detail->option_text, ['class'=>'form-control form-control-sm', 'id'=>'option_text', 'placeholder'=>'Enter option_text...', 'required'])); ?>

                                            <?php $__errorArgs = ['option_text'];
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
                                        <?php echo e(Form::label('option_text','Image : ',['class'=>'col-sm-3'])); ?>

                                        <div class="col-sm-5">
                                        <?php echo e(Form::file('answer_image[]', ['id'=>'`+answers+`','accept'=>'image/*','class'=>'form-control answer_image'])); ?> 
                                            <?php $__errorArgs = ['option_text'];
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
                                        <img src="" class="preview" style="width: 100px;">  
                                        <input type="hidden" name="txt_option_image[]" id="txt_option_image`+answers+`">
                                        </div>
                                    </div>
                                    </div>`;
            
            $(wrapper).append(template);
        });
        $('#remove').on('click', function() {
            if(!confirm("Are you sure to delete this option?"))
                return false;
           var d =  $('.add').last().remove();           
        });

        $(document).on("click",".delete_qimage",function(){
            if(!confirm("Are you sure to delete this image?"))
                return false;
            var id = $(this).attr("id");

            form_data = {id:id,_token:'<?php echo e(csrf_token()); ?>'}

            $.ajax({
            method: "POST",
            url: '<?php echo e(route("quiz_question/delete_image")); ?>',
            data: form_data
            })
            .done(function( msg ) {
              
            });
            $(this).parent().remove();
        });

        $(document).on("click",".delete_oimage",function(){
            if(!confirm("Are you sure to delete this image?"))
                return false;
            var id = $(this).attr("id");

            form_data = {id:id,_token:'<?php echo e(csrf_token()); ?>'}

            $.ajax({
            method: "POST",
            url: '<?php echo e(route("quiz_question/delete_option_image")); ?>',
            data: form_data
            })
            .done(function( msg ) {
                
            });

            $(this).parent().remove();
            
        });

         tinymce.init({
        selector: '#title'
    });
        
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\iec\resources\views/admin/quiz_questions/question-form.blade.php ENDPATH**/ ?>