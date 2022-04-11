
<?php $__env->startSection('title','Poll'); ?>

<?php $__env->startSection('content'); ?>

<div class="container-fluid">
					
    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
          <h5 class="txt-dark">Poll Elements</h5>
        </div>
    </div>
    <!-- /Title -->
    
    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view col-md-8">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Poll <?php echo e(isset($poll_detail)? 'Update' : 'Add'); ?> form</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="form-wrap">
                            <?php if(isset($poll_detail)): ?>
                                <?php echo e(Form::open(['url'=>route('poll.update', @$poll_detail->id),'id'=>"uploadform", 'files'=>true, 'class'=> 'form'])); ?>

                                <?php echo method_field('put'); ?>
                            <?php else: ?>
                                <?php echo e(Form::open(['url'=>route('poll.store'), 'files'=>true, 'class'=> 'form', 'id'=>"uploadform"])); ?>

                            <?php endif; ?>
        
                        
                            <div class="form-group row">
                                <?php echo e(Form::label('title','Poll* : ',['class'=>'col-sm-3'])); ?>

                                <div class="col-sm-9">
                                    <?php echo e(Form::text('title', @$poll_detail->title, ['class'=>'form-control form-control-sm', 'id'=>'title', 'placeholder'=>'Enter poll...', 'required'])); ?>

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
                                <?php echo e(Form::label('status','Status* : ',['class'=>'col-sm-3'])); ?>

                                <div class="col-sm-9">
                                    <?php echo e(Form::select('status',['active'=>'Publish', 'inactive'=>'Unpublish'],@$poll_detail->status, ['id'=>'status', 'required', 'class'=>'form-control form-control-sm'])); ?>

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
                                <div class="col-md-6">
                                    <div class="row">
                                        <?php echo e(Form::label('start','Start Date* : ',['class'=>'col-sm-3'])); ?>

                                        <div class="col-md-9">
                                            <?php echo e(Form::date('start', @$poll_detail->start,['id'=>'start', 'min'=>\Carbon\Carbon::now(), 'require'=>true, 'class'=>'form-control form-control-sm'] )); ?>

                                            <?php $__errorArgs = ['start'];
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
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <?php echo e(Form::label('end','End Date* : ',['class'=>'col-sm-3'])); ?>

                                        <div class="col-md-9">
                                            <?php echo e(Form::date('end', @$poll_detail->end,['id'=>'end', 'require'=>true, 'class'=>'form-control form-control-sm'] )); ?>

                                            <?php $__errorArgs = ['end'];
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
                                </div>
                               
                            </div>
                            <hr>
                           
                            <div class="option">
                                <?php if(@$poll_detail): ?>
                                    <?php $__currentLoopData = $poll_detail->vote_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="form-group row">
                                            <?php echo e(Form::label('vote','Option* : ',['class'=>'col-sm-3'])); ?>

                                            <div class="col-sm-9">
                                                <?php echo e(Form::text('vote[]', @$item->vote, ['class'=>'form-control form-control-sm', 'id'=>'vote', 'placeholder'=>'Enter vote...', 'required'])); ?>

                                                <?php $__errorArgs = ['vote.*'];
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
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    
                                <?php else: ?> 
                                    <div class="form-group row">
                                        <?php echo e(Form::label('vote','Option* : ',['class'=>'col-sm-3'])); ?>

                                        <div class="col-sm-9">
                                            <?php echo e(Form::text('vote[]', @$poll_detail->vote_info['vote'], ['class'=>'form-control form-control-sm', 'id'=>'vote', 'placeholder'=>'Enter vote...', 'required'])); ?>

                                            <?php $__errorArgs = ['vote.*'];
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
                            </div>
                            <a href="javascript:void(0);" id="add_more" class="btn btn-primary"><i class="fa fa-plus-circle"> Add Option</i></a>
                            <a href="javascript:void(0);" id="remove" class="btn btn-primary"><i class="fa fa-minus-circle"> Remove</i></a>
                            <br>
                            <br>
                            <div class="form-group row">
                                <?php echo e(Form::label('image', 'Image* :',['class'=>'col-sm-3'])); ?>

                                <div class="col-sm-4">
                                    <?php echo e(Form::file('image', ['id'=>'image', 'required'=>false, 'accept'=>'image/*'])); ?> 
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
                                    <div class="thumbnail <?php echo e((isset($poll_detail)? '': 'hidden')); ?>" id="view" >
                                        <span class="close">&times;</span>
                                        <?php if(isset($poll_detail)): ?>
                                        <?php if(file_exists(public_path().'/upload/author/'.$poll_detail->image)): ?>
                                        <img id="old" src="<?php echo e(asset('/upload/author/'.$poll_detail->image)); ?>">
                                        <?php endif; ?>
                                        <?php endif; ?>
                                        <img src="" id="preview">  
                                    </div>
                                </div>                               
                            </div>
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
    tinymce.init({
        selector: '#detail'
    });
</script>
<script>
    $(document).ready(function() {
        var wrapper = $(".option"); //Fields wrapper
        $('#add_more').click(function(e){ //on add input button click
            e.preventDefault();
            //add input box
            var template = `<div class="form-group row add">
                                        <?php echo e(Form::label('vote','Option* : ',['class'=>'col-sm-3'])); ?>

                                        <div class="col-sm-9">
                                            <?php echo e(Form::text('vote[]', @$poll_detail->vote_info['vote'], ['class'=>'form-control form-control-sm', 'id'=>'vote', 'placeholder'=>'Enter vote...', 'required'])); ?>

                                            <?php $__errorArgs = ['vote'];
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
                                    </div>`;
            
            $(wrapper).append(template);
        });
        $('#remove').on('click', function() {
           var d =  $('.add').last().remove();           
        });
    });
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
        $(this).parent().remove();
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ausnepc/firescreen.ausnep.com/resources/views/admin/poll/poll-form.blade.php ENDPATH**/ ?>