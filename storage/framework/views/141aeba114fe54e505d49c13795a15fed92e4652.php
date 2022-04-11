
<?php $__env->startSection('title'); ?>
   Popular news
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <!-- Main Breadcrumb Start -->
    <div class="main--breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="<?php echo e(route('homepage')); ?>" class="btn-link"><i class="fa fm fa-home"></i>Home</a></li>
                <li><a class="btn-link active">Popular News</a></li>
            </ul>
        </div>
    </div>
    <!-- Main Breadcrumb End -->

    <div class="main-content--section pbottom--30">
        <div class="container">
            <div class="row">
                <!-- Main Content Start -->
                <div class="main--content col-md-8" data-sticky-content="true">
                    <div class="sticky-content-inner">
                        <!-- Post Item Start -->
                        <div class="col-md-12 ptop--30 pbottom--30">
                            <div class="post--items-title" data-ajax="tab">
                                <h2 class="h4">Popular News</h2>
                            </div>
                            <div class="post--items post--items-2" data-ajax-content="outer">
                                <ul class="nav row" data-ajax-content="inner">
                                <?php $__currentLoopData = $popular; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($loop->first): ?>
                                        <li class="col-md-12">
                                            <!-- Post Item Start -->
                                            <div class="post--item">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="post--img">
                                                            <a href="<?php echo e(route('post-detail', $item->post_id)); ?>" class="thumb" style="height: 250px;"><img src="<?php echo e(asset('upload/post/'.$item->post_info['image'])); ?>" alt=""></a>
                                                            <a href="#" class="cat"><?php echo e($item->post_info->cat_info['title']); ?></a>
                                                            
                                                        </div>
                                                    </div>
                        
                                                    <div class="col-md-6">
                                                        <div class="post--info">
                                                            <p class="utctime"><?php echo e(($item->created_at)); ?></p>
                                                            <ul class="nav meta">
                                                                <li><a href="#"><?php echo e($item->post_info->author_info['name']); ?></a></li>
                                                                
                                                            </ul>
                        
                                                            <div class="title">
                                                                <h3 class="h4"><a href="<?php echo e(route('post-detail', $item->post_id)); ?>" class="btn-link"><?php echo e($item->post_info['title']); ?></a></h3>
                                                            </div>
                                                        </div>
                        
                                                        <div class="post--content">
                                                            <p><?php echo Illuminate\Support\Str::limit(html_entity_decode($item->post_info['detail']), 200); ?></p>
                                                        </div>
                        
                                                        <div class="post--action">
                                                            <a href="<?php echo e(route('post-detail', $item->post_id)); ?>">Continue Reading...</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Post Item End -->
                                        </li>
                                        <li class="col-md-12">
                                            <!-- Divider Start -->
                                            <hr class="divider">
                                            <!-- Divider End -->
                                        </li>
                                    <?php else: ?>
                                        <li class="col-md-6">
                                            <!-- Post Item Start -->
                                            <div class="post--item post--layout-4">
                                                <div class="post--img">
                                                    <a href="<?php echo e(route('post-detail', $item->post_id)); ?>" class="thumb" style="height:100px;"><img src="<?php echo e(asset('upload/post/'.$item->post_info['image'])); ?>" alt=""></a>
                                                    <p class="utctime"><?php echo e(($item->created_at)); ?></p>
                        
                                                    <div class="post--info">
                                                        
                        
                                                        <div class="title">
                                                            <h3 class="h4"><a href="<?php echo e(route('post-detail', $item->post_id)); ?>" class="btn-link"><?php echo Illuminate\Support\Str::limit($item->post_info['title'], 50); ?></a></h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Post Item End -->
                                            <hr class="divider">
                                        </li>

                                        <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>  
                            <?php $__currentLoopData = @$content_lg_ads->random(1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <!-- Advertisement Start -->
                            <div class="ad--widget" id="adver"  ads_id="<?php echo e($item->id); ?>" style="width: 100%; height:70px" >
                                <a href="<?php echo e($item->link); ?>" target="_blank" >
                                    <img src="<?php echo e(asset('upload/advertise/Thumb-lg-'.@$item->image)); ?>" alt="Ads 728x90">
                                </a>
                            </div>
                            <hr class="divider">
                            <!-- Advertisement End --> 
                                
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                           	  <hr class="divider divider--25">
                            
                        </div>
                        <!-- Post Item End -->
                    </div>
                </div>
                <!-- Main Content End -->
    
                <!-- Main Sidebar Start -->
                <div class="main--sidebar col-md-4 ptop--30 pbottom--30" data-sticky-content="true">
                    <div class="sticky-content-inner">
                        <!-- Widget Start -->
                        <div class="widget">
                            <div class="widget--title">
                                <h2 class="h4">Category</h2>
                                <i class="icon fa fa-folder-open-o"></i>
                            </div>

                            <!-- Nav Widget Start -->
                            <div class="nav--widget">
                                <ul class="nav">
                                    <?php $__currentLoopData = $cats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><a href="<?php echo e(route('cat-post', $item->id)); ?>"><span><?php echo e($item->title); ?></span><span>()</span></a></li>
                                        
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                   
                                </ul>
                            </div>
                            <!-- Nav Widget End -->
                        </div>
                        <!-- Widget End -->

                        <!-- Widget Start -->
                        <div class="widget">
                            <div class="widget--title">
                                <h2 class="h4">Featured News</h2>
                                <i class="icon fa fa-newspaper-o"></i>
                            </div>

                            <!-- List Widgets Start -->
                            <div class="list--widget list--widget-1">
                                <div class="list--widget-nav" data-ajax="tab">
                                    <ul class="nav nav-justified">
                                        <li class="">
                                            <a href="#" id="hotnews_post">Hot News</a>
                                        </li>
                                        <li class="active">
                                            <a href="#" id="featured_post" class="feature_post" >Top featured News</a>
                                        </li>
                                    </ul>
                                </div>

                                <!-- Post Items Start -->
                                <div class="post--items post--items-3" id="featured">
                                    <ul class="nav" data-ajax-content="inner">
                                        <?php $__currentLoopData = $featured; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>
                                            <!-- Post Item Start -->
                                            <div class="post--item post--layout-3">
                                                <div class="post--img">
                                                    <a href="" class="thumb"><img src="<?php echo e(asset('upload/post/'.$item->post_info['image'])); ?>" alt=""></a>

                                                    <div class="post--info">
                                                       <p class="utctime"><?php echo e(($item->created_at)); ?></p>
                                                        <div class="title">
                                                            <h3 class="h4"><a href="<?php echo e(route('post-detail', $item->post_id)); ?>" class="btn-link"><?php echo e($item->post_info['title']); ?></a></h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Post Item End -->
                                        </li>
                                            
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        
                                    </ul>                               
                                </div>
                                <!-- Post Items End -->

                                <!-- Post Items Start -->
                                <div class="post--items post--items-3 hide" id="hotnews">
                                    <ul class="nav" data-ajax-content="inner">
                                        <?php $__currentLoopData = $hotnews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>
                                            <!-- Post Item Start -->
                                            <div class="post--item post--layout-3">
                                                <div class="post--img">
                                                    <a href="" class="thumb"><img src="<?php echo e(asset('upload/post/'.$item->post_info['image'])); ?>" alt=""></a>
                                                    <p class="utctime"><?php echo e(($item->created_at)); ?></p>

                                                    <div class="post--info">
                                                        

                                                        <div class="title">
                                                            <h3 class="h4"><a href="<?php echo e(route('post-detail', $item->post_id)); ?>" class="btn-link"><?php echo e($item->post_info['title']); ?></a></h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Post Item End -->
                                        </li>
                                            
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        
                                    </ul>                               
                                </div>
                                <!-- Post Items End -->
                            </div>
                            <!-- List Widgets End -->
                        </div>
                        <!-- Widget End -->

                        <!-- Widget Start -->
                        <div class="widget">
                            <div class="widget--title">
                                <h2 class="h4">Advertisement</h2>
                                <i class="icon fa fa-bullhorn"></i>
                            </div>

                            <?php $__currentLoopData = $sidebar_lg_ads->random(1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <!-- Ad Widget Start -->
                            <a href="<?php echo e($item->link); ?>" id="adver"  ads_id="<?php echo e($item->id); ?>" target="_blank">
                                <video 
                                    style="display:block; margin: 0 auto;" 
                                    height="200px" width="100%" 
                                    src="<?php echo e(asset('upload/advertise/'.$item->image)); ?>" 
                                    playsinline controls autoplay muted loop>
                                </video>
                            </a>
                            <!-- Ad Widget End --> 
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div> 
                        <!-- Widget End -->
                    </div>
                </div>
                <!-- Main Sidebar End -->
            </div>
        </div>
    </div>
    <!-- Foreign News Start -->
    
    <!-- Foreign News End -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script>
    $(document).ready(function(){
        $(document).on("click","#hotnews_post",function(e){           
            $('#featured').hide();
            $('#hotnews').removeClass('hide');
            $('ul.nav li.active').removeClass('active');
            $(this).parent().addClass('active');
            e.preventDefault();
        });
        $(document).on("click","#featured_post",function(e){           
            $('#hotnews').hide();
            $('#featured').show();
            $('ul.nav li.active').removeClass('active');
            $(this).parent().addClass('active');
            e.preventDefault();
        });
       
       
    });
</script>
<script>
$(document).on("click", "#adver", function(e){
    var ad_id = $(this).attr("ads_id");
    // alert(ad_id);
    $.ajax({
        method: "POST",
        url: "<?php echo e(route('ads_count')); ?>",
        data: { 
            ads_id: ad_id ,
            "_token": "<?php echo e(csrf_token()); ?>",
            }
    })
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ausnepc/firescreen.ausnep.com/resources/views/frontend/popular.blade.php ENDPATH**/ ?>