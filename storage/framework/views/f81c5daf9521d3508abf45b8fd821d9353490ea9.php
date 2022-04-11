
<?php $__env->startSection('title'); ?>
    TV
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- Main Breadcrumb Start -->
    <div class="main--breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="<?php echo e(route('homepage')); ?>" class="btn-link"><i class="fa fm fa-home"></i>Home</a></li>
                <li class="active"><span>FSTV TV</span></li>
            </ul>
        </div>
    </div>
    <!-- Main Breadcrumb End -->

    <!-- Main Content Section Start -->
    <div class="main-content--section pbottom--30">
        <div class="container">
            <div class="row">
                <!-- Main Content Start -->
                <div class="main--content col-md-8 col-sm-7" data-sticky-content="true">
                    <div class="sticky-content-inner">
                        <!-- Page Title Start -->
                        <div class="page--title pd--30-0">
                            <h2 class="h2">Our <span>Videos</span></h2>
                        </div>
                        <!-- Page Title End -->

                        <!-- Product Items Start -->
                        <div class="product--items ptop--30">
                            <div class="row AdjustRow">
                                <?php $__currentLoopData = $media; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-md-4 col-xs-6 col-xxs-12 pbottom--30">
                                    <?php if(isset($item->link)): ?>                                   
                                    
                                    <!-- Product Item Start -->
                                    <div class="product--item" >
                                        <div class="thumb">
                                            <?php echo Embed::make($item->link)->parseUrl()->setAttribute([
                                                'width' => '100%',
                                                'height' => 220,
                                                'frameborder' => 0,
                                                'allowfullscreen' => true
                                                ])->getHtml(); ?> 
                                            
                                        </div> 
                                        <div class="title">
                                            <h3 class="h5"><a class="btn-link"><?php echo e($item->title); ?></a></h3>
                                        </div>                                                                              
                                    </div>
                                    <!-- Product Item End -->                                        
                                    <?php elseif(isset($item->video) && !isset($item->link)): ?>
                                    <div class="product--item">
                                        <div class="thumb" >
                                            <video width="240" height="220" controls autoplay>
                                                <source height="120px" src="<?php echo e(asset('upload/media/'.@$item->video)); ?>" height="220" type="file">
                                                <source height="120px" src="<?php echo e(asset('upload/media/'.@$item->video)); ?>" type="video/ogg">
                                                Your browser does not support the video tag.
                                            </video> 
                                        </div>
                                        <div class="title">
                                            <h3 class="h5"><a class="btn-link"><?php echo e($item->title); ?></a></h3>
                                        </div> 
                                    </div>
                                    <?php endif; ?>
                                    
                                </div>
                                  
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <!-- Product Items End -->

                        <!-- Pagination Start -->
                        <div class="pagination--wrapper clearfix bdtop--1 bd--color-2 ptop--60 pbottom--30">
                            <?php echo e($media->render()); ?>

                         </div>
                         <!-- Pagination End -->
                    </div>
                </div>
                <!-- Main Content End -->

                <!-- Main Sidebar Start -->
                <div class="main--sidebar col-md-4 col-sm-5 ptop--30 pbottom--30" data-sticky-content="true">
                    <div class="sticky-content-inner">
                        <!-- Widget Start -->
                        <div class="widget">
                            <!-- Search Widget Start -->
                            <div class="search--widget">
                                <form action="<?php echo e(route('search')); ?>" method="get">
                                    <?php echo csrf_field(); ?>
                                    <div class="input-group">
                                        <input type="search" name="search" placeholder="Search..." class="form-control" required>

                                        <div class="input-group-btn">
                                            <button type="submit" class="btn-link"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- Search Widget End -->
                        </div>
                        <!-- Widget End -->

                        <!-- Widget Start -->
                        <div class="widget">
                            <div class="widget--title">
                                <h2 class="h4">Catagory</h2>
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
                                                        <p><?php echo e(Timezone::convertToLocal($item->created_at)); ?></p>
                                                        <ul class="nav meta">
                                                            <li><a href="#"><?php echo e($item->post_info->author_info['name']); ?></a></li>
                                                            
                                                        </ul>

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

                                                    <div class="post--info">
                                                        <p><?php echo e(Timezone::convertToLocal($item->created_at)); ?></p>
                                                        <ul class="nav meta">
                                                            <li><a href="#"><?php echo e($item->post_info->author_info['name']); ?></a></li>
                                                            
                                                        </ul>

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

                            <?php if(@$sidebar_lg_ads[0]->type == 'image'): ?>
                                <!-- Ad Widget Start -->
                                <div class="ad--widget" style="height:70px;">
                                    <a href="<?php echo e(@$sidebar_lg_ads[0]->link); ?>">
                                        <img src="<?php echo e(asset('upload/advertise/Thumb-lg-'.@$sidebar_lg_ads[0]->image)); ?>" alt="Ads 728x90">
                                    </a>
                                </div>
                                <!-- Ad Widget End -->                                                    
                                <?php else: ?>
                                <div class="row">
                                    <div class="col-md-6" height="120px">
                                        <video width="100%" controls autoplay loop muted>
                                            <source height="120px" src="<?php echo e(asset('upload/advertise/'.@$content_lg_ads[1]->image)); ?>" type="file">
                                            <source height="120px" src="<?php echo e(asset('upload/advertise/'.@$content_lg_ads[1]->image)); ?>" type="video/ogg">
                                            Your browser does not support the video tag.
                                        </video>  
                                    </div>
                                    <div class="col-md-6" height="120px">
                                        <video width="100%" controls autoplay loop muted>
                                            <source height="120px" src="<?php echo e(asset('upload/advertise/'.@$content_lg_ads[1]->image)); ?>" type="file">
                                            <source height="120px" src="<?php echo e(asset('upload/advertise/'.@$content_lg_ads[1]->image)); ?>" type="video/ogg">
                                            Your browser does not support the video tag.
                                        </video>  
                                    </div>
                                </div>
                            <?php endif; ?>
                            
                        </div>
                        <!-- Widget End -->

                    </div>
                </div>
                <!-- Main Sidebar End -->
            </div>
        </div>
    </div>
    <!-- Main Content Section End -->  

    
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ausnepc/firescreen.ausnep.com/resources/views/frontend/media.blade.php ENDPATH**/ ?>