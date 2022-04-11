
<?php $__env->startSection('title'); ?>
  News Detail
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <!-- Main Breadcrumb Start -->
    <div class="main--breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="<?php echo e(route('homepage')); ?>" class="btn-link"><i class="fa fm fa-home"></i>Home</a></li>
                <li><a href="<?php echo e(route('cat-post', $post->cat_id)); ?>" class="btn-link">Post</a></li>
                <li class="active"><span><?php echo e($post->title); ?></span></li>
            </ul>
        </div>
    </div>
    <!-- Main Breadcrumb End -->
    
    <!-- Main Content Section Start -->
    <div class="main-content--section pbottom--30">
        <div class="container">
            <div class="row">
                <!-- Main Content Start -->
                <div class="main--content col-md-8" data-sticky-content="true">
                    <div class="sticky-content-inner">
                        <!-- Post Item Start -->
                        <div class="post--item post--single post--title-largest pd--30-0">
                            <div class="post--img">
                                <a href="<?php echo e(asset('upload/post/'.$post->image)); ?>" class="thumb"><img src="<?php echo e(asset('upload/post/'.$post->image)); ?>" alt=""></a>
                                <a href="#" class="icon"><i class="fa fa-star-o"></i></a>                               
                            </div>

                            <div class="post--info">
                                <ul class="nav meta">
                                    
                                    <li><a href="#"><?php echo e($post->created_at); ?></a></li>
                                    
                                    <li><a href="#"><i class="fa fm fa-comments-o"></i><?php echo e(count(@$review)); ?></a></li>
                                    <ul class="nav meta">
                                        <li><a href="https://www.facebook.com/firescreentvchannel/"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                        <li><a href="https://www.youtube.com/channel/UCJcnGgy2HdUaDP-TdvvafsA"><i class="fa fa-youtube-play"></i></a></li>
                                    </ul>
                                </ul>

                                <div class="title">
                                    <h2 class="h4"><?php echo e($post->title); ?></h2>
                                </div>
                            </div>

                            <div class="post--content">
                                <p><?php echo html_entity_decode($post->detail); ?></p>    
                            </div>
                            <?php if(isset($post->video)): ?>
                            <div class="post--content">
                                <video width="100%" height="300" controls>
                                    <source src="<?php echo e(asset('upload/post/video/'.@$post->video)); ?>" type="file">
                                    <source src="<?php echo e(asset('upload/post/video/'.@$post->video)); ?>" type="video/ogg">
                                    Your browser does not support the video tag.
                                </video>                                
                            </div>
                            <?php endif; ?>
                        </div>
                        <!-- Post Item End -->
                        <?php if(@$content_lg_ads[0]->type == 'image'): ?>
                            <!-- Ad Widget Start -->
                            <div class="ad--widget" style="height:70px;">
                                <a href="<?php echo e(@$content_lg_ads[0]->link); ?>">
                                    <img src="<?php echo e(asset('upload/advertise/Thumb-lg-'.@$content_lg_ads[0]->image)); ?>" alt="Ads 728x90">
                                </a>
                            </div>
                            <!-- Ad Widget End -->                                                    
                            <?php else: ?>
                            <div class="row">
                                <div class="col-md-6" height="120px">
                                    <video width="100%" controls autoplay loop muted>
                                        <source height="120px" src="<?php echo e(asset('upload/advertise/'.@$content_lg_ads[0]->image)); ?>" type="file">
                                        <source height="120px" src="<?php echo e(asset('upload/advertise/'.@$content_lg_ads[0]->image)); ?>" type="video/ogg">
                                        Your browser does not support the video tag.
                                    </video>  
                                </div>
                                <div class="col-md-6" height="120px">
                                    <video width="100%" controls autoplay loop muted>
                                        <source height="120px" src="<?php echo e(asset('upload/advertise/'.@$content_lg_ads[0]->image)); ?>" type="file">
                                        <source height="120px" src="<?php echo e(asset('upload/advertise/'.@$content_lg_ads[0]->image)); ?>" type="video/ogg">
                                        Your browser does not support the video tag.
                                    </video>  
                                </div>
                            </div> 
                        <?php endif; ?>
                       
                        <hr class="divider divider--25">
                       	<hr class="divider divider--25">                     
                      
                        

                        <!-- Comment List Start -->
                        <div class="comment--list pd--30-0">
                            <!-- Post Items Title Start -->
                            <div class="post--items-title">

                                <h2 class="h4"><?php echo $review->count(); ?> Comments</h2>

                                <i class="icon fa fa-comments-o"></i>
                            </div>
                            <!-- Post Items Title End -->

                            <ul class="comment--items nav">
                                <?php $__currentLoopData = $review; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <!-- Comment Item Start -->
                                    <div class="comment--item clearfix">
                                        <div class="comment--img float--left">
                                            <img src="img/news-single-img/comment-avatar-01.jpg" alt="">
                                        </div>

                                        <div class="comment--info">
                                            <div class="comment--header clearfix">
                                                <p class="name"><?php echo e($item->name); ?></p>
                                                <p class="date"><?php echo e($item->created_at); ?></p>
                                            </div>

                                            <div class="comment--content">
                                                <p><?php echo e($item->comments); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Comment Item End -->
                                </li>
                                    
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                        <!-- Comment List End -->

                        <!-- Comment Form Start -->
                        <div class="comment--form pd--30-0">
                            <!-- Post Items Title Start -->
                            <div class="post--items-title">
                                <h2 class="h4">Leave A Comment</h2>

                                <i class="icon fa fa-pencil-square-o"></i>
                            </div>
                            <!-- Post Items Title End -->

                            <div class="comment-respond">
                                <form action="<?php echo e(route('submit-review', $post->id)); ?>" method="POST" enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>
                                    <p>Don’t worry ! Your email address will not be published. Required fields are marked (*).</p>

                                    <div class="form-group row">
                                            <label>
                                                <span>Name *</span>
                                                <input type="text" name="name" id="name" class="form-control" required>
                                            </label>

                                            <label>
                                                <span>Email Address *</span>
                                                <input type="email" name="email" id="email" class="form-control" required>
                                            </label>

                                            <label>
                                                <span>Comment *</span>
                                                <textarea name="comments" id="comments" class="form-control" required></textarea>
                                            </label>
                                            <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary">Post a Comment</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Comment Form End -->
                    </div>
                </div>
                <!-- Main Content End -->

                <!-- Main Sidebar Start -->
            <div class="main--sidebar col-md-4 col-sm-5 ptop--30 pbottom--30" data-sticky-content="true">
                <div class="sticky-content-inner">
                    <!-- Widget Start -->
                    <div class="widget">
                        <?php if(@$sidebar_lg_ads[0]->type == 'image'): ?>
                            <!-- Ad Widget Start -->
                            <div class="ad--widget" style="height:70px;">
                                <a href="<?php echo e(@$sidebar_lg_ads[0]->link); ?>">
                                    <img src="<?php echo e(asset('upload/advertise/Thumb-lg-'.@$sidebar_lg_ads[0]->image)); ?>" alt="Ads 728x90">
                                </a>
                            </div>
                            <!-- Ad Widget End -->                                                    
                            <?php else: ?>
                            <video width="100%" controls autoplay loop muted>
                                <source src="<?php echo e(asset('upload/advertise/'.@$sidebar_lg_ads[0]->image)); ?>" height="100px" type="file">
                                <source src="<?php echo e(asset('upload/advertise/'.@$sidebar_lg_ads[0]->image)); ?>" type="video/ogg">
                                Your browser does not support the video tag.
                            </video>  
                        <?php endif; ?>
                       
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
                                                        <li><a href="#"><?php echo e($item->created_at); ?></a></li>
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
                                                        <li><a href="#"><?php echo e($item->created_at); ?></a></li>
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
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\fstv\resources\views/frontend/post-detail.blade.php ENDPATH**/ ?>