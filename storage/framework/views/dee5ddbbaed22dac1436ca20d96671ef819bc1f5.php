
<?php $__env->startSection('title','FSTV| Posts'); ?>

<?php $__env->startSection('content'); ?>

<div class="container-fluid">
					
    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
          <h5 class="txt-dark">Posts Elements</h5>
        </div>
    </div>
    <!-- /Title -->
    
    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view col-md-8">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Posts <?php echo e(isset($post_detail)? 'Update' : 'Add'); ?> form</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="form-wrap">
                            <?php if(isset($post_detail)): ?>
                                <?php echo e(Form::open(['url'=>route('post.update', @$post_detail->id),'id'=>"uploadform", 'files'=>true, 'class'=> 'form'])); ?>

                                <?php echo method_field('put'); ?>
                            <?php else: ?>
                                <?php echo e(Form::open(['url'=>route('post.store'), 'files'=>true, 'class'=> 'form', 'id'=>"uploadform"])); ?>

                            <?php endif; ?>
        
        
                            <div class="form-group row">
                                <?php echo e(Form::label('title','Title* : ',['class'=>'col-sm-3'])); ?>

                                <div class="col-sm-9">
                                    <?php echo e(Form::text('title', @$post_detail->title, ['class'=>'form-control form-control-sm', 'id'=>'title', 'placeholder'=>'Enter title...', 'require'=>true])); ?>

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
                                    <?php echo e(Form::text('subtitle', @$post_detail->subtitle, ['class'=>'form-control form-control-sm', 'id'=>'subtitle', 'placeholder'=>'Enter subtitle...', 'require'=>false])); ?>

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
                                <?php echo e(Form::label('cat_id','Category* : ',['class'=>'col-sm-3'])); ?>

                                <div class="col-sm-9">
                                    <?php echo e(Form::select('cat_id',$parent_cats,@$post_detail->cat_id, ['id'=>'cat_id', 'require'=>true, 'class'=>'form-control form-control-sm','placeholder'=>'--Select any one--'])); ?>

                                    <?php $__errorArgs = ['cat_id'];
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
                            <div class="form-group row " id="sub_cat_div">
                                <?php echo e(Form::label('sub_cat_id','Child Category: ',['class'=>'col-sm-3'])); ?>

                                <div class="col-sm-9">
                                    <?php echo e(Form::select('sub_cat_id',[],@$post_detail->sub_cat_id, ['id'=>'sub_cat_id', 'require'=>false, 'class'=>'form-control form-control-sm','placeholder'=>'--Select any one--'])); ?>

                                    <?php $__errorArgs = ['sub_cat_id'];
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
                                    <?php echo e(Form::textarea('detail', html_entity_decode(@$post_detail->detail), ['class'=>'form-control', 'id'=>'detail', 'placeholder'=>'Enter Category detail...', 'require'=>true, 'style'=>'resize: none;', 'rows' =>'5'])); ?>

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
                                <?php echo e(Form::label('status','Status* : ',['class'=>'col-sm-3'])); ?>

                                <div class="col-sm-9">
                                    <?php echo e(Form::select('status',['inactive'=>'Unpublish'],@$post_detail->status, ['disabled', 'id'=>'status', 'require'=>false, 'class'=>'form-control form-control-sm'])); ?>

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
                                <?php echo e(Form::label('is_trending','Make Trending: ',['class'=>'col-sm-3'])); ?>

                                <div class="col-sm-9">
                                    <?php echo e(Form::checkbox('is_trending',1, @$post_detail->is_trending, ['id'=>'is_trending'])); ?>

                                    Yes
                                    <?php $__errorArgs = ['is_trending'];
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
                                    <?php echo e(Form::file('image', ['id'=>'image', 'required'=>(isset($post_detail)? false: true), 'accept'=>'image/*'])); ?> 
                                  <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="alert-danger"><?php echo e($message); ?> Upload validate format</span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="col-sm-4">
                                    <div class="thumbnail <?php echo e((isset($post_detail)? '': 'hidden')); ?>" id="view" >
                                        <span class="close">&times;</span>
                                        <?php if(isset($post_detail)): ?>
                                        <?php if(file_exists(public_path().'/upload/post/'.$post_detail->image)): ?>
                                        <img id="old" src="<?php echo e(asset('/upload/post/'.$post_detail->image)); ?>">
                                        <?php endif; ?>
                                        <?php else: ?>
                                        <?php endif; ?>
                                        <img src="" id="preview">  
                                    </div>
                                </div>                               
                            </div>
                            <div class="form-group row">
                                <?php echo e(Form::label('link','Link: ',['class'=>'col-sm-3'])); ?>

                                <div class="col-sm-9">
                                    <?php echo e(Form::url('link',@$post_detail->link, ['class'=>'form-control form-control-sm', 'id'=>'link', 'placeholder'=>'Enter Video url...', 'require'=>false])); ?>

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
                                    <?php echo e(Form::file('video', ['id'=>'video', 'required'=>false, 'accept'=>'video/mp4,video/x-m4v,video/*'])); ?> 
                                  <?php $__errorArgs = ['video'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="alert-danger"><?php echo e($message); ?>upload video format</span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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

<script>
    $('#cat_id').change(function () {
            let cat_id = $(this).val();
            let sub_cat_id = "<?php echo e(isset($post_detail) ? $post_detail->sub_cat_id : null); ?>";

            $.ajax({
                url: "<?php echo e(route('get-Child-Cats')); ?>",
                type: "post",
                data: {
                    "_token": "<?php echo e(csrf_token()); ?>",
                    "cat_id": cat_id
                },
                success: function (response) {
                    if (typeof (response) != 'object') {
                        response = $.parseJSON(response);
                    }

                    var html_option = "<option value='' selected>--Select Any One--</option>"
                    if (response.status) {
                        //child category exists
                        $.each(response.data, function (key, value) {

                            html_option += "<option value='"+value.id+"' ";
                            if (sub_cat_id != null && sub_cat_id == value.id){
                                html_option += ' selected ';
                            }
                            html_option += ">" + value.title + "</option>"
                        });

                        $('#sub_cat_div').removeClass('hidden');
                    } else {
                        //child category do not exists
                        $('#sub_cat_div').addClass('hidden');
                    }

                    $('#sub_cat_id').html(html_option)
                }
            });
        });
        $('#cat_id').change();
</script>

<script>
    tinymce.init({
        selector: '#detail'
    });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.operator', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ausnepc/firescreen.ausnep.com/resources/views/operator/post-form.blade.php ENDPATH**/ ?>