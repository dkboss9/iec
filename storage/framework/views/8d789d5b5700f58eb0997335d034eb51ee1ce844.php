
<?php $__env->startSection('title','FSTV| Videos'); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
                        
        <!-- Title -->
        <div class="row heading-bg">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-dark">FSTV Videos</h5>
                
            </div>
        </div>
        <!-- /Title -->

        <?php if(Session::has('message')): ?>
            <div class="success success-info"><?php echo e(Session::get('message')); ?></div>
        <?php endif; ?>
        <?php if(Session::has('error')): ?>
            <div class="alert alert-info"><?php echo e(Session::get('error')); ?></div>
        <?php endif; ?> 
        
   
        <!-- Row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default card-view">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h6 class="panel-title txt-dark">FSTV Videos Table</h6>
                        </div>
                        <div class="clearfix"></div>
                        <div class="pull-right">
                            <a href="<?php echo e(route('video.create')); ?>" class="btn btn-default btn-rounded" style="border-bottom: 50%">
                                <i class="fa fa-plus-circle">Add</i>
                            </a>
                        </div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="table-wrap mt-40">
                                <div class="table-responsive">
                                    <table id="datable_1" class="table table-bordered table-hover display  pb-30" >
                                        <thead>
                                          <tr>
                                                <th>S.N</th>                                    
                                                <th>Title</th>                                                
                                                <th>Category</th>                                                
                                                <th>Tags</th>                                                
                                                <th>Status</th>
                                                <th>Trending</th>
                                                
                                                <th class="text-nowrap">Action</th>
                                          </tr>
                                        </thead>
                                        <tbody>  
                                            <?php if($data): ?>
                                            <?php $i=0; ?>
                                                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                                    <?php $i++?>
                                                    <tr>
                                                        <td><?php echo $i;?></td>
                                                        <td><?php echo e($row->title); ?></td>                                                       
                                                        <td><?php echo e($row->menu_info['title']); ?> >> <?php echo e($row->submenu_info['title']); ?>

                                                            <?php if(isset($row->childmenu_info['title'])): ?> >><?php echo e($row->childmenu_info['title']); ?> <?php endif; ?>
                                                        </td>                                                       
                                                        <td>
                                                            <?php $__currentLoopData = $row->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <label class="label label-info"><?php echo e($tag['name']); ?></label>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </td>                                                       
                                                        <td><?php echo e($row->status); ?></td>
                                                        <td>
                                                            <span><?php echo e(($row->is_trending == 1) ? 'Trending' : 'No'); ?></span>
                                                        </td>                                                       
                                                        
                                                        
                                                        <td>
                                                            <ul class="nav nav-pills">
                                                                
                                                                <li>
                                                                    <a data-toggle="tooltip" data-placement="bottom" title="edit" href="<?php echo e(route('video.edit', $row->id)); ?>">
                                                                        <i class="fa fa-edit fa-2x" style="color:#878787;"></i>
                                                                    </a> 
                                                                </li>
                                                                <li>
                                                                    <a data-toggle="tooltip" data-placement="bottom" title="featured" href="javascript:void(0);" id="featured<?php echo e($row->id); ?>" class="<?php echo e(in_array($row->id, $featured_video_id)? 'unfeatured' : 'featured'); ?> " featured_id="<?php echo e($row->id); ?>">
                                                                        <?php if(in_array($row->id, $featured_video_id)): ?>
                                                                            <i class="fa fa-2x fa-star" style="color:#e60a0a;" id="icon"></i>
                                                                        <?php else: ?>
                                                                            <i class="fa fa-2x fa-star-o" style="color:#e60a0a;" id="icon"></i>                                                                                                                                                        
                                                                        <?php endif; ?>
                                                                    </a> 
                                                                </li>
                                                                <li>
                                                                    <a data-toggle="tooltip" data-placement="bottom" title="popular" href="javascript:void(0);" id="popular<?php echo e($row->id); ?>" class="<?php echo e(in_array($row->id, $popular_video_id)? 'unpopular' : 'popular'); ?> " popular_id="<?php echo e($row->id); ?>">
                                                                        <?php if(in_array($row->id, $popular_video_id)): ?>
                                                                            <i class="fa fa-2x fa-heart" style="color:#e60a0a;" id="icon"></i>
                                                                        <?php else: ?>
                                                                            <i class="fa fa-2x fa-heart-o" style="color:#e60a0a;" id="icon"></i>                                                                                                                                                        
                                                                        <?php endif; ?>
                                                                    </a> 
                                                                </li>
                                                                <li>
                                                                    <a data-toggle="tooltip" data-placement="bottom" title="delete" href="">
                                                                        <?php echo e(Form::open(['url'=>route('video.destroy', $row->id), 'class'=>'form float-right', 'onsubmit'=>'return confirm("Are you sure to delete??")'])); ?>

                                                                        <?php echo method_field('delete'); ?>
                                                                        <?php echo e(Form::button('<i class="fa fa-trash fa-1x" style="color:#fa1b1b;"></i>',['type'=>'submit'])); ?>

                                                                        <?php echo e(Form::close()); ?>

                                                                    </a>
                                                                </li>
                                                            </ul>                                                            
                                                        </td>
                                                    </tr>                                                   
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                            
                                            <?php endif; ?> 
                                        </tbody>
                                    </table>
                                    
                                </div>
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
    $("document").ready(function(){
        setTimeout(function(){
           $(".success-info").remove();
        }, 5000 ); // 5 secs   
    });
</script>
<script>
    $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip();   
    });
</script>
<script>
$(document).ready(function(e){
    $(document).on("click",".featured",function() {

        if(!confirm("Are you sure to make featured?"))
        return false;

        $(this).find('i').toggleClass('fa-star-o fa-star').css('color', '#e60a0a')
        var featured_id = $(this).attr("featured_id");
        // alert(featured_id);
        if(!featured_id){
            return false;
        }else{
        
            // alert(featured_id);
            $.ajax({
                method: "POST",
                url: "<?php echo e(route('featured-video')); ?>",
                data: { 
                    featured_id: featured_id ,
                    "_token": "<?php echo e(csrf_token()); ?>",
                    }
            })
                .done(function() {
                    alert("added to featured.");
                    $("#featured"+ featured_id).addClass("unfeatured");
                    $("#featured"+ featured_id).removeClass("featured");
                    location.reload();
                });
        }
        
    });

    $(document).on("click",".unfeatured",function(e) {

        if(!confirm("Are you sure to remove featured?"))
        return false;
        
        $(this).find('i').toggleClass('fa-star fa-star-o')
        var featured_id = $(this).attr("featured_id");
        // alert(featured_id);
        if(!featured_id){
            return false;
        }else{
        
            // alert(featured_id);
            $.ajax({
                method: "POST",
                url: "<?php echo e(route('unfeatured-video')); ?>",
                data: { 
                    featured_id: featured_id ,
                    "_token": "<?php echo e(csrf_token()); ?>",
                    }
            })
                .done(function() {
                    alert("Removed featured.");
                    $("#featured"+ featured_id).addClass("featured");
                    $("#featured"+ featured_id).removeClass("unfeatured");
                    location.reload();
                });
        }
        
    });

    
});
</script>
<script>
    $(document).ready(function(e){
        $(document).on("click",".popular",function() {
    
            if(!confirm("Are you sure to make popular?"))
            return false;
    
            $(this).find('i').toggleClass('fa-heart-o fa-heart').css('color', '#e60a0a')
            var popular_id = $(this).attr("popular_id");
            // alert(popular_id);
            if(!popular_id){
                return false;
            }else{
            
                // alert(popular_id);
                $.ajax({
                    method: "POST",
                    url: "<?php echo e(route('popular-video')); ?>",
                    data: { 
                        popular_id: popular_id ,
                        "_token": "<?php echo e(csrf_token()); ?>",
                        }
                })
                    .done(function() {
                        alert("added to popular.");
                        $("#popular"+ popular_id).addClass("unpopular");
                        $("#popular"+ popular_id).removeClass("popular");
                        location.reload();
                    });
            }
            
        });
    
        $(document).on("click",".unpopular",function(e) {
    
            if(!confirm("Are you sure to remove popular?"))
            return false;

            $(this).find('i').toggleClass('fa-heart fa-heart-o')
            var popular_id = $(this).attr("popular_id");
            // alert(popular_id);
            if(!popular_id){
                return false;
            }else{
            
                // alert(popular_id);
                $.ajax({
                    method: "POST",
                    url: "<?php echo e(route('unpopular-video')); ?>",
                    data: { 
                        popular_id: popular_id ,
                        "_token": "<?php echo e(csrf_token()); ?>",
                        }
                })
                    .done(function() {
                        alert("Removed popular.");
                        $("#popular"+ popular_id).addClass("popular");
                        $("#popular"+ popular_id).removeClass("unpopular");
                        location.reload();
                    });
            }
            
        });
    
        
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.operator', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ausnepc/firescreen.ausnep.com/resources/views/operator/video.blade.php ENDPATH**/ ?>