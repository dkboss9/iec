
<?php $__env->startSection('title','Videos'); ?>

<?php $__env->startSection('content'); ?>

<div class="container-fluid">
					
    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
          <h5 class="txt-dark">Fstv Videos Elements</h5>
        </div>
    </div>
    <!-- /Title -->
    
    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view col-md-8">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">FSTV Videos <?php echo e(isset($video_detail)? 'Update' : 'Add'); ?> form</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">

                        <div class="form-wrap">
                            <?php if(isset($video_detail)): ?>
                                <?php echo e(Form::open(['url'=>route('video.update', @$video_detail->id),'id'=>"uploadform", 'files'=>true, 'class'=> 'form'])); ?>

                                <?php echo method_field('put'); ?>
                            <?php else: ?>
                                <?php echo e(Form::open(['url'=>route('video.store'), 'files'=>true, 'class'=> 'form', 'id'=>"uploadform"])); ?>

                            <?php endif; ?>
        
        
                            <div class="form-group row">
                                <?php echo e(Form::label('title','Title* : ',['class'=>'col-sm-3'])); ?>

                                <div class="col-sm-9">
                                    <?php echo e(Form::text('title', @$video_detail->title, ['class'=>'form-control form-control-sm', 'id'=>'title', 'placeholder'=>'Enter title...', 'require'=>true])); ?>

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
                                    <?php echo e(Form::text('subtitle', @$video_detail->subtitle, ['class'=>'form-control form-control-sm', 'id'=>'subtitle', 'placeholder'=>'Enter subtitle...', 'require'=>false])); ?>

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
                                <?php echo e(Form::label('menu_id','Category* : ',['class'=>'col-sm-3'])); ?>

                                <div class="col-sm-9">
                                    <?php echo e(Form::select('menu_id',$menu_info,@$video_detail->menu_id, ['id'=>'menu_id', 'require'=>true, 'class'=>'form-control form-control-sm','placeholder'=>'--Select any one--'])); ?>

                                    <?php $__errorArgs = ['menu_id'];
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
                            <div class="form-group row" id="sub_menu_div">
                                <?php echo e(Form::label('submenu_id','Sub Category* : ',['class'=>'col-sm-3'])); ?>

                                <div class="col-sm-9">
                                    
                                    <?php echo e(Form::select('submenu_id',[],@$video_detail->submenu_id, ['id'=>'submenu_id', 'require'=>false, 'class'=>'form-control form-control-sm','placeholder'=>'--Select any one--'])); ?>

                                    <?php $__errorArgs = ['submenu_id'];
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
                           
                            <div class="form-group row" id="child_menu_div">
                                <?php echo e(Form::label('childmenu_id','Child Category: ',['class'=>'col-sm-3'])); ?>

                                <div class="col-sm-9">
                                    <?php echo e(Form::select('childmenu_id',[], @$video_detail->childmenu_id, ['id'=>'childmenu_id', 'require'=>false, 'class'=>'form-control form-control-sm','placeholder'=>'--Select any one--'])); ?>

                                    <?php $__errorArgs = ['childmenu_id'];
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
                                    <?php echo e(Form::textarea('detail', html_entity_decode(@$video_detail->detail), ['class'=>'form-control', 'id'=>'detail', 'placeholder'=>'Enter Category detail...', 'require'=>true, 'style'=>'resize: none;', 'rows' =>'5'])); ?>

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
                                <?php echo e(Form::label('tags','Tags: ',['class'=>'col-sm-3'])); ?>

                                <div class="col-sm-9">
                                    <?php if(@$video_detail): ?>
                                    <input class="form-control form-control-sm" name="tags" data-role="tagsinput" id="input-tags" value=" 
                                        <?php $__currentLoopData = @$video_detail->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php echo e($tag['name'].','); ?>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> " 
                                    style="width:500px !important" />
                                    <?php else: ?>
                                    <input class="form-control form-control-sm" name="tags" data-role="tagsinput" id="input-tags" style="width:500px !important" />    
                                    <?php endif; ?>

                                    
                                    <?php $__errorArgs = ['tags'];
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
                                    <?php echo e(Form::select('status',['active'=>'Publish', 'inactive'=>'Unpublish'],@$video_detail->status, ['id'=>'status', 'require'=>true, 'class'=>'form-control form-control-sm'])); ?>

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
                                    <?php echo e(Form::checkbox('is_trending',1, @$video_detail->is_trending, ['id'=>'is_trending'])); ?>                                    
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
                                <?php echo e(Form::label('date','Schedule-date : ',['class'=>'col-sm-3'])); ?>

                                <div class="col-md-9" id="datetimepicker1">
                                    <?php echo e(Form::date('date', @$video_detail->date, ['id'=>'date','min'=> Carbon\Carbon::tomorrow(), 'require'=>false, 'class'=>'form-control form-control-sm'])); ?>                                
                                    <?php $__errorArgs = ['date'];
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
                            
                            <?php if(isset($video_detail)): ?>
                                <?php if($video_detail->link): ?>
                                <div class="form-group row">
                                    <?php echo e(Form::label('link','Link: ',['class'=>'col-sm-3'])); ?>

                                    <div class="col-sm-9">
                                        <?php echo e(Form::url('link', @$video_detail->link, ['class'=>'form-control form-control-sm', 'id'=>'link', 'placeholder'=>'Enter Media link...'])); ?>

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
                                <?php elseif($video_detail->video): ?>
                                <div class="form-group row">
                                    <?php echo e(Form::label('video', 'Video: ',['class'=>'col-sm-3'])); ?>

                                    <div class="col-sm-4">
                                        <?php echo e(Form::file('video', ['id'=>'video', 'accept'=>'video/mp4,video/x-m4v,video/*'])); ?> 
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
                                </div>
                                <?php endif; ?>                              
                            <?php else: ?>
                            <div class="form-group row" id="lin">
                                <?php echo e(Form::label('link','Link: ',['class'=>'col-sm-3'])); ?>

                                <div class="col-sm-9">
                                    <?php echo e(Form::url('link', '',['class'=>'form-control form-control-sm', 'id'=>'link', 'placeholder'=>'Enter Media link...'])); ?>

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

                            <div class="form-group row" id="vido">
                                <?php echo e(Form::label('video', '',['class'=>'col-sm-3'])); ?>

                                <div class="col-sm-4">
                                    <?php echo e(Form::file('video', @$video_detail->video,['id'=>'video', 'accept'=>'video/mp4,video/x-m4v,video/*'])); ?> 
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
                            </div>

                            <?php endif; ?>

                            <div class="form-group row">
                                <?php echo e(Form::label('', 'Video Thumbnail* :',['class'=>'col-sm-3'])); ?>

                                <div class="col-sm-4">
                                    <?php echo e(Form::file('image', ['id'=>'image', 'required'=>(isset($video_detail->image)? false : true), 'accept'=>'image/*'])); ?>

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
                                    <div class="thumbnail <?php echo e((isset($video_detail)? '': 'hidden')); ?>" id="view" >
                                        <span class="close">&times;</span>
                                        <?php if(isset($video_detail->image)): ?>
                                        <?php if(file_exists(public_path().'/upload/fstv/video/'.$video_detail->image)): ?>
                                            <img id="old" src="<?php echo e(asset('/upload/fstv/video/'.$video_detail->image)); ?>">
                                        <?php else: ?>
                                        <?php endif; ?>  
                                        <?php endif; ?>
                                            <img src="" id="preview">  
                                    </div>
                                </div>                               
                            </div>   
                                    
                            <div class="form-group row">
                                <?php echo e(Form::label('','',['class'=>'col-sm-3'])); ?>

                                <div class="col-sm-9">
                                    <?php echo e(Form::button("<i class='fa fa-recycle'></i> Reset", ['class'=>'btn btn-danger','type'=>'reset', 'onClick'=> 'window.location.reload()'])); ?>

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
        $("#link").keyup(function(e){
            e.preventDefault();
            let key = $('#link').val();
            f = key != '' ? $("#vido").hide() : '';         
        });
       
    });
</script>
<script type="text/javascript">
$(function() {
  $("#vido").change(function(){
    let key = $("input:file", this).val();
    f = key != '' ? $("#lin").hide() : ''; 
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

<script>
    $('#menu_id').change(function () {
        let menu_id = $(this).val();
        let submenu_id = "<?php echo e(isset($video_detail) ? $video_detail->submenu_id : null); ?>";

        $.ajax({
            url: "<?php echo e(route('get-submenu')); ?>",
            type: "post",
            data: {
                "_token": "<?php echo e(csrf_token()); ?>",
                "menu_id": menu_id
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
                        if (submenu_id != null && submenu_id == value.id){
                            html_option += ' selected ';
                        }
                        html_option += ">" + value.title + "</option>"
                    });

                    $('#sub_menu_div').removeClass('hidden');
                } else {
                    //child category do not exists
                    $('#sub_menu_div').addClass('hidden');
                }

                $('#submenu_id').html(html_option)
            }
        });
    });
    $('#menu_id').change();
</script>
<script>
    $('#submenu_id').change(function () {

        let submenu_id = "<?php echo e(isset($video_detail) ? $video_detail->submenu_id : ''); ?>";
        submenu_id = submenu_id != '' ? submenu_id : $(this).val(); 
        let childmenu_id = "<?php echo e(isset($video_detail) ? $video_detail->childmenu_id : null); ?>";


        $.ajax({
            url: "<?php echo e(route('get-childmenu')); ?>",
            type: "post",
            data: {
                "_token": "<?php echo e(csrf_token()); ?>",
                "submenu_id": submenu_id
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
                        if (childmenu_id != null && childmenu_id == value.id){
                            html_option += ' selected ';
                        }
                        html_option += ">" + value.title + "</option>"
                    });

                    $('#child_menu_div').removeClass('hidden');
                } else {
                    //child category do not exists
                    $('#child_menu_div').addClass('hidden');
                }

                $('#childmenu_id').html(html_option)
            }
        });
    });
    $('#submenu_id').change();
</script>
<script>
    tinymce.init({
        selector: '#detail'
    });
</script>
<script type="text/javascript">
	$('#input-tags').tagsInput();
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ausnepc/firescreen.ausnep.com/resources/views/admin/fstv/video-form.blade.php ENDPATH**/ ?>