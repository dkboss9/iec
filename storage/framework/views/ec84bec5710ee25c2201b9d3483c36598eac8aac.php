
<?php $__env->startSection('title'); ?>
    FSTV NEWS | Blogs
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- Main Breadcrumb Start -->
    <div class="main--breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="<?php echo e(route('homepage')); ?>" class="btn-link"><i class="fa fm fa-home"></i>Home</a></li>
                <li class="active"><span>Blogs</span></li>
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

                        <!-- Post Items Start -->
                        <div class="post--items post--items-5 pd--30-0">
                            <ul class="nav">
                        <?php $count=1;?>
                        <?php $__currentLoopData = $blog; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($count%2 == 1): ?>
                            <?php endif; ?>
                                <li>
                                    <!-- Post Item Start -->
                                    <div class="post--item post--title-larger">
                                        <div class="row">
                                            <div class="col-md-4 col-sm-12 col-xs-4 col-xxs-12">
                                                <div class="post--img">
                                                    <a href="<?php echo e(asset('upload/blog/'.$item->image)); ?>" class="thumb" style="height: 120px;"><img src="<?php echo e(asset('upload/blog/'.$item->image)); ?>" alt=""></a>
                                                    
                                                </div>
                                            </div>

                                            <div class="col-md-8 col-sm-12 col-xs-8 col-xxs-12">
                                                <div class="post--info">
                                                    <ul class="nav meta">
                                                        <li><a href="#"><?php echo e($item->author_info['name']); ?></a></li>
                                                        <li><a href="#"><?php echo e(Timezone::convertToLocal($item->created_at, 'Y-m-d g:i')); ?></a></li>
                                                    </ul>

                                                    <div class="title">
                                                        <h3 class="h4"><a href="<?php echo e(route('blog-detail', $item->id)); ?>" class="btn-link"><?php echo Illuminate\Support\Str::limit($item->title, 50); ?></a></h3>
                                                    </div>
                                                </div>

                                                <div class="post--content">
                                                    <p><?php echo e($item->subtitle); ?></p>
                                                </div>

                                                <div class="post--action">
                                                    <a href="<?php echo e(route('post-detail', $item->id)); ?>">Continue Reading...</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Post Item End -->
                                </li> 
                                                     	<hr class="divider divider--25">                     

                            <?php if($count%2 == 0): ?>
                            
                            <?php if(@$content_lg_ads[1]->type == 'image'): ?>
                                <!-- Ad Widget Start -->
                                <div class="ad--widget" style="height:70px;">
                                    <a href="<?php echo e(@$content_lg_ads[1]->link); ?>">
                                        <img src="<?php echo e(asset('upload/advertise/Thumb-lg-'.@$content_lg_ads[1]->image)); ?>" alt="Ads 728x90">
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

                            <hr class="divider divider--25">                     
                       	<hr class="divider divider--25">                     

                            
                            <?php endif; ?>                                
                            <?php $count++; ?>
                            
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                            <!-- Pagination Start -->
                            <div class="pagination--wrapper clearfix bdtop--1 bd--color-2 ptop--60 pbottom--30">
                               <?php echo e($blog->render()); ?>

                            </div>
                            <!-- Pagination End -->
                            </ul>
                        </div>
                       
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
                                            <a href="#" onClick="window.location.reload(true);" class="feature_post" >Top featured News</a>
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
                                                        <ul class="nav meta">
                                                            <li><a href="#"><?php echo e($item->post_info->author_info['name']); ?></a></li>
                                                            <li><a href="#"><?php echo e(Timezone::convertToLocal($item->created_at, 'Y-m-d g:i')); ?></a></li>
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
                                                        <ul class="nav meta">
                                                            <li><a href="#"><?php echo e($item->post_info->author_info['name']); ?></a></li>
                                                            <li><a href="#"><?php echo e(Timezone::convertToLocal($item->created_at, 'Y-m-d g:i')); ?></a></li>
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

                            <?php if(@$sidebar_lg_ads[1]->type == 'image'): ?>
                                <!-- Ad Widget Start -->
                                <div class="ad--widget" style="height:70px;">
                                    <a href="<?php echo e(@$sidebar_lg_ads[1]->link); ?>">
                                        <img src="<?php echo e(asset('upload/advertise/Thumb-lg-'.@$sidebar_lg_ads[1]->image)); ?>" alt="Ads 728x90">
                                    </a>
                                </div>
                                <!-- Ad Widget End -->                                                    
                                <?php else: ?>
                                <video width="100%" controls autoplay loop muted>
                                    <source src="<?php echo e(asset('upload/advertise/'.@$sidebar_lg_ads[1]->image)); ?>" height="100px" type="file">
                                    <source src="<?php echo e(asset('upload/advertise/'.@$sidebar_lg_ads[1]->image)); ?>" type="video/ogg">
                                    Your browser does not support the video tag.
                                </video>  
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
       
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\fstv\resources\views/frontend/blog.blade.php ENDPATH**/ ?>