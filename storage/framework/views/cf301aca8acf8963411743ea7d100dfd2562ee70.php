

<?php $__env->startSection('title'); ?>
    Homepage
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>


<!-- Main Content Section Start -->
<div class="main-content--section pbottom--30">
    <div class="container">
        <!-- Main Content Start -->
        <div class="main--content">
            <!-- Post Items Start -->
            <div class="post--items post--items-1 pd--30-0">
                <div class="row gutter--15">
                    <?php if(!$posts->isempty()): ?>

                    <div class="col-md-6">
                        <!-- Post Item Start -->
                        <div class="post--item post--layout-1 post--title-larger">
                            <div class="post--img">
                                <a href="<?php echo e(route('post-detail', $posts[0]->id)); ?>" class="thumb" style="height:419px;"><img src="<?php echo e(asset('upload/post/'.$posts[0]->image)); ?>"  alt=""></a>
                                <a href="<?php echo e(route('cat-post', $posts[0]->cat_id)); ?>" class="cat"><?php echo e($posts[0]->cat_info['title']); ?></a>

                                <div class="post--info">
                                    <ul class="nav meta">
                                        <li><a href="#"><?php echo e($posts[0]->author_info['name']); ?></a></li>
                                        <li><a class="time" href="#"><?php echo e(Timezone::convertToLocal($posts[0]->created_at)); ?></a></li>
                                    </ul>

                                    <div class="title">
                                        <h2 class="h4"><a href="<?php echo e(route('post-detail', $posts[0]->id)); ?>" class="btn-link"><?php echo e($posts[0]->title); ?></a></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Post Item End -->                            
                    </div>

                    <?php if(isset($posts) && count($posts) > 3): ?>
                    <div class="col-md-6">
                        <div class="row gutter--15">
                          <?php $__currentLoopData = $posts->slice(1,4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-xs-6 col-xss-12">
                                <!-- Post Item Start -->
                                <div class="post--item post--layout-1 post--title-large">
                                    <div class="post--img">
                                        <a href="<?php echo e(route('post-detail', $item->id)); ?>" class="thumb" style="height:200px;"><img src="<?php echo e(asset('upload/post/'.$item->image)); ?>" alt=""></a>
                                        <a href="<?php echo e(route('cat-post', $item->cat_id)); ?>" class="cat"><?php echo e($item->cat_info['title']); ?></a>

                                        <div class="post--info">
                                            <ul class="nav meta">
                                                <li><a href="#"><?php echo e($item->author_info['name']); ?></a></li>
                                                <li><a class="time" href="#"><?php echo e(Timezone::convertToLocal($item->created_at)); ?></a></li>
                                            </ul>

                                            <div class="title">
                                                <h2 class="h4"><a href="<?php echo e(route('post-detail', $item->id)); ?>" class="btn-link"><?php echo e($item->title); ?></a></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Post Item End -->
                            </div>
                            
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                        </div>
                    </div>
                    <?php endif; ?>
                  <?php endif; ?>
                </div>
            </div>
            <!-- Post Items End -->
        </div>
        <!-- Main Content End -->

        <div class="row">
            <!-- Main Content Start -->
            <div class="main--content col-md-8 col-sm-7" data-sticky-content="true">
                <div class="sticky-content-inner">
                    <div class="row">
                        <?php if(!$cats1_post->isEmpty()): ?> 
                        <!-- First category Start -->
                        <div class="col-md-6 ptop--30 pbottom--30">
                            <!-- Post Items Title Start -->
                            <div class="post--items-title" data-ajax="tab">
                                <h2 class="h4"><?php echo e($cats1_post[0]->cat_info['title']); ?></h2>
                                
                                <div class="nav">
                                    <a href="<?php echo e(route('cat-post', $cats1_post[0]->cat_id)); ?>" class="prev btn-link">
                                        <p>More</p>
                                    </a>
                                </div>
                            </div>
                            <!-- Post Items Title End -->
                            
                            
                            <!-- Post Items Start -->
                            <div class="post--items post--items-2" data-ajax-content="outer">
                                <ul class="nav row gutter--15" data-ajax-content="inner">
                                    <?php if(isset($cats1_post) && count($cats1_post) > 3): ?>
                                        <?php $__currentLoopData = $cats1_post; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($loop->first): ?>
                                                <li class="col-xs-12">
                                                    <!-- Post Item Start -->
                                                    <div class="post--item post--layout-1">
                                                        <div class="post--img">
                                                            <a href="<?php echo e(route('post-detail', $item->id)); ?>" class="thumb" style:"219px;"><img src="<?php echo e(asset('upload/post/Thumb-lg-'.$item->image)); ?>" height="219" alt=""></a>
                                                            <a href="<?php echo e(route('childcat-post', $item->sub_cat_id)); ?>" class="cat"><?php echo e($item->sub_cat_info['title']); ?></a>
            
                                                            <div class="post--info">
                                                                <ul class="nav meta">
                                                                    <li><a href="#"><?php echo e($item->author_info['name']); ?></a></li>
                                                                    <li><a class="time" href="#"><?php echo e(Timezone::convertToLocal($item->created_at)); ?></a></li>
                                                                </ul>
            
                                                                <div class="title">
                                                                    <h3 class="h4"><a href="<?php echo e(route('post-detail', $item->id)); ?>"><?php echo e($item->title); ?></a></h3>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Post Item End -->
                                                </li>
                                                <li class="col-xs-12"><hr class="divider"></li>
                                            <?php endif; ?>
                                                <li class="col-xs-6 mb-30">
                                                    <!-- Post Item Start -->
                                                    <div class="post--item post--layout-2">
                                                        <div class="post--img">
                                                            <a href="<?php echo e(route('post-detail', $item->id)); ?>" class="thumb" style="height: 100px;"><img src="<?php echo e(asset('upload/post/Thumb-sm-'.$item->image)); ?>" height="100" width="180" alt=""></a>
            
                                                            <div class="post--info">
                                                                <ul class="nav meta">
                                                                    <li><a href="#"><?php echo e($item->author_info['name']); ?></a></li>
                                                                    <li><a class="time" href="#"><?php echo e(Timezone::convertToLocal($item->created_at)); ?></a></li>
                                                                </ul>
            
                                                                <div class="title">
                                                                    <h3 class="h4"><a href="<?php echo e(route('post-detail', $item->id)); ?>" class="btn-link"><?php echo Illuminate\Support\Str::limit($item->title, 50); ?></a></h3>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Post Item End -->
                                                    <hr class="divider">
                                                </li> 
                                            
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>                                                   
                                </ul>                              
                            </div>
                            <!-- Post Items End -->
                        </div>
                        <!-- First category End -->
                        <?php endif; ?>

                        <?php if(!$cats2_post->isEmpty()): ?>
                        <!-- second category Start -->
                        <div class="col-md-6 ptop--30 pbottom--30">
                            <!-- Post Items Title Start -->
                            <div class="post--items-title" data-ajax="tab">
                                <h2 class="h4"><?php echo e($cats2_post[0]->cat_info['title']); ?></h2>

                                <div class="nav">
                                    <a href="<?php echo e(route('cat-post', $cats2_post[0]->cat_id)); ?>" class="prev btn-link">
                                        <p>More</p>
                                    </a>
                                </div>
                            </div>
                            <!-- Post Items Title End -->

                            <!-- Post Items Start -->
                            <div class="post--items post--items-3" data-ajax-content="outer">
                                <ul class="nav" data-ajax-content="inner">
                                    <?php if(isset($cats2_post) && count($cats2_post) > 2): ?>
                                    <?php $__currentLoopData = $cats2_post; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($loop->first): ?>
                                            <li>
                                                <!-- Post Item Start -->
                                                <div class="post--item post--layout-1">
                                                    <div class="post--img">
                                                        <a href="<?php echo e(route('post-detail', $item->id)); ?>" class="thumb" style="height: 219px;"><img src="<?php echo e(asset('upload/post/Thumb-sm-'.$item->image)); ?>" alt=""></a>
                                                        <a href="<?php echo e(route('childcat-post', $item->sub_cat_id)); ?>" class="cat"><?php echo e($item->sub_cat_info['title']); ?></a>
        
                                                        <div class="post--info">
                                                            <ul class="nav meta">
                                                                <li><a href="#"><?php echo e($item->author_info['name']); ?></a></li>
                                                                <li><a class="time" href="#"><?php echo e(Timezone::convertToLocal($item->created_at)); ?></a></li>
                                                            </ul>
        
                                                            <div class="title">
                                                                <h3 class="h4"><a href="<?php echo e(route('post-detail', $item->id)); ?>" class="btn-link"><?php echo e($item->title); ?></a></h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Post Item End -->
                                                <hr class="divider">
                                            </li>
                                        <?php endif; ?>
                                            <li>
                                                <!-- Post Item Start -->
                                                <div class="post--item post--layout-3">
                                                    <div class="post--img">
                                                        <a href="<?php echo e(route('post-detail', $item->id)); ?>" class="thumb" style="height: 70px;"><img src="<?php echo e(asset('upload/post/Thumb-sm-'.$item->image)); ?>" alt=""></a>
        
                                                        <div class="post--info">
                                                            <ul class="nav meta">
                                                                <li><a href="#"><?php echo e($item->author_info['name']); ?></a></li>
                                                                <li><a class="time" href="#"><?php echo e(Timezone::convertToLocal($item->created_at)); ?></a></li>
                                                            </ul>
        
                                                            <div class="title">
                                                                <h3 class="h4"><a href="<?php echo e(route('post-detail', $item->id)); ?>" class="btn-link"><?php echo Illuminate\Support\Str::limit($item->title, 50); ?></a></h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Post Item End -->
                                            </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                            
                                  	<?php endif; ?>

                                </ul>
                            </div>
                            <!-- Post Items End -->                                
                        </div>
                        <!-- second category End -->                            
                            
                        <?php endif; ?>

                        <!-- Ad Start -->
                        <div class="col-md-12 ptop--30 pbottom--30">
                            <?php if(@$content_lg_ads[1]->type == 'image'): ?>
                                <!-- Advertisement Start -->
                                <div class="ad--widget" style="width: 100%;" >
                                    <a href="<?php echo e(@$sontent_lg_ads[1]->link); ?>" >
                                        <img src="<?php echo e(asset('upload/advertise/Thumb-lg-'.@$content_lg_ads[1]->image)); ?>" height="70px" alt="Ads 728x90">
                                    </a>
                                </div>
                                <!-- Advertisement End -->                                                    
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
                        <!-- Ad End -->
                        
                        <?php if(!$cats3_post->isEmpty()): ?>
                        <!-- Third Category Start -->
                        <div class="col-md-12 ptop--30 pbottom--30">
                            <!-- Post Items Title Start -->
                            <div class="post--items-title" data-ajax="tab">
                                <h2 class="h4"><?php echo e($cats3_post[0]->cat_info['title']); ?></h2>

                                <div class="nav">
                                    <a href="<?php echo e(route('cat-post',$cats3_post[0]->cat_id)); ?>" class="prev btn-link">
                                        <p>More</p>
                                    </a>
                                </div>
                            </div>
                            <!-- Post Items Title End -->

                            <!-- Post Items Start -->
                            <div class="post--items post--items-2" data-ajax-content="outer">
                                <ul class="nav row" data-ajax-content="inner">
                                    <?php if(isset($cats3_post) && count($cats3_post) > 2): ?>
                                    <?php $__currentLoopData = $cats3_post; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($loop->first): ?>
                                            <li class="col-md-6">
                                                <!-- Post Item Start -->
                                                <div class="post--item post--layout-2">
                                                    <div class="post--img">
                                                        <a href="<?php echo e(route('post-detail', $item->id)); ?>" class="thumb"><img src="<?php echo e(asset('upload/post/Thumb-lg-'.$item->image)); ?>" alt=""></a>
                                                        <a href="<?php echo e(route('childcat-post', $item->sub_cat_id)); ?>" class="cat"><?php echo e($item->sub_cat_info['title']); ?></a>
        
                                                        <div class="post--info">
                                                            <ul class="nav meta">
                                                                <li><a href="#"><?php echo e($item->author_info['name']); ?></a></li>
                                                                <li><a class="time" href="#"><?php echo e(Timezone::convertToLocal($item->created_at)); ?></a></li>
                                                            </ul>
        
                                                            <div class="title">
                                                                <h3 class="h4"><a href="<?php echo e(route('post-detail', $item->id)); ?>" class="btn-link"><?php echo e($item->title); ?></a></h3>
                                                            </div>
                                                          	<div class="subtitle">
                                                                <p>
                                                                  <?php echo Illuminate\Support\Str::limit(html_entity_decode($item->detail), 180); ?>

                                                              </p>
                                                            </div>
                                                          	
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Post Item End -->
                                            </li>
                                            <li class="col-md-6">
                                                <ul class="nav row">
                                                    <li class="col-xs-12 hidden-md hidden-lg">
                                                        <!-- Divider Start -->
                                                        <hr class="divider">
                                                        <!-- Divider End -->
                                                    </li>
                                        <?php endif; ?>
                                        <li class="col-xs-6">
                                            <!-- Post Item Start -->
                                            <div class="post--item post--layout-2" >
                                                <div class="post--img img--responsive">
                                                    <a href="<?php echo e(route('post-detail', $item->id)); ?>" class="thumb" style="height:100px;"><img src="<?php echo e(asset('upload/post/Thumb-sm-'.$item->image)); ?>" alt=""></a>

                                                    <div class="post--info">
                                                        <ul class="nav meta">
                                                            <li><a href="#"><?php echo e($item->author_info['name']); ?></a></li>
                                                            <li><a class="time" href="#"><?php echo e(Timezone::convertToLocal($item->created_at)); ?></a></li>
                                                        </ul>

                                                        <div class="title">
                                                            <h3 class="h4"><a href="<?php echo e(route('post-detail', $item->id)); ?>" class="btn-link"><?php echo Illuminate\Support\Str::limit($item->title, 20); ?></a></h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Post Item End -->
                                            <hr class="divider">
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                            
                                  	<?php endif; ?>
                                        </ul>
                                    </li>
                                                                              
                                </ul>
                               
                            </div>
                            <!-- Post Items End -->
                        </div>
                        <!-- Third Category End -->                                                 
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <!-- Main Content End -->

            <!-- Main Sidebar Start -->
            <div class="main--sidebar col-md-4 col-sm-5 ptop--30 pbottom--30" data-sticky-content="true">
                <div class="sticky-content-inner">
                    <!-- Widget Start -->
                    <div class="widget">
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
                                                <a href="" class="thumb" style="height:70px;"><img src="<?php echo e(asset('upload/post/'.$item->post_info['image'])); ?>" alt=""></a>

                                                <div class="post--info">
                                                    <ul class="nav meta">
                                                        <li><a href="#"><?php echo e($item->post_info->author_info['name']); ?></a></li>
                                                        <li><a class="time" href="#"><?php echo e(Timezone::convertToLocal($item->created_at)); ?></a></li>
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
                                                <a href="" class="thumb" style="height:70px;"><img src="<?php echo e(asset('upload/post/'.$item->post_info['image'])); ?>" alt=""></a>

                                                <div class="post--info">
                                                    <ul class="nav meta">
                                                        
                                                        <li><a class="time" href="#"><?php echo e(Timezone::convertToLocal($item->created_at)); ?></a></li>
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
                            <div class="ad--widget" style="height:90px;">
                                <a href="<?php echo e(@$sidebar_lg_ads[0]->link); ?>">
                                    <img src="<?php echo e(asset('upload/advertise/Thumb-lg-'.@$sidebar_lg_ads[0]->image)); ?>" alt="Ads 728x90">
                                </a>
                            </div>
                            <!-- Ad Widget End -->                                                
                            <?php else: ?>
                            <video height="100px" width="100%" controls autoplay loop muted>
                                <source src="<?php echo e(asset('upload/advertise/'.@$sidebar_lg_ads[0]->image)); ?>" height="100px" type="file">
                                <source src="<?php echo e(asset('upload/advertise/'.@$sidebar_lg_ads[0]->image)); ?>" type="video/ogg">
                                Your browser does not support the video tag.
                            </video>  
                        <?php endif; ?>                        
                        
                    </div>
                    <!-- Widget End -->
                </div>
            </div>
            <!-- Main Sidebar End -->
        </div>

        <!-- Main Content Start -->
        
        <!-- Main Content End -->
            
        
        <div class="row">
           
            <!-- Main Content Start -->
            <div class="main--content col-md-8 col-sm-7" data-sticky-content="true">
                <div class="sticky-content-inner">
                            
                    <div class="row">
                        <!-- Ad Start -->
                        <div class="col-md-12 ptop--30 pbottom--30">
                            <?php if(@$content_lg_ads[0]->type == 'image'): ?>
                            <!-- Advertisement Start -->
                            <div class="ad--widget" style="height: 70px;" >
                                <a href="<?php echo e(@$content_lg_ads[0]->link); ?>" >
                                    <img src="<?php echo e(asset('upload/advertise/Thumb-lg-'.@$content_lg_ads[0]->image)); ?>" width="100%" alt="Ads 728x90">
                                </a>
                            </div>
                            <!-- Advertisement End -->                             
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
                        </div>
                        <!-- Ad End -->
                                              
                        <?php if(!$cats4_post->isempty()): ?>
                        <div class="col-md-12 ptop--30 pbottom--30">
                            <!-- Post Items Title Start -->
                            <div class="post--items-title" data-ajax="tab">
                                <h2 class="h4"><?php echo e($cats4_post[0]->cat_info['title']); ?></h2>

                                <div class="nav">
                                    <a href="<?php echo e(route('cat-post',$cats4_post[0]->cat_id)); ?>" class="prev btn-link">
                                        <p>More</p>
                                    </a>
                                </div>
                            </div>
                            <!-- Post Items Title End -->

                            <!-- Post Items Start -->
                            <div class="post--items" data-ajax-content="outer">
                                <ul class="nav row gutter--15" data-ajax-content="inner">
                                    <?php if(isset($cats4_post) && count($cats4_post) > 2): ?>
                                    <?php $__currentLoopData = $cats4_post; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="col-md-4 col-xs-6 col-xxs-12">
                                            <!-- Post Item Start -->
                                            <div class="post--item post--layout-1">
                                                <div class="post--img">
                                                    <a href="<?php echo e(route('post-detail', $item->id)); ?>" class="thumb" style="height: 219px;"><img src="<?php echo e(asset('upload/post/Thumb-sm-'.$item->image)); ?>" alt=""></a>

                                                    <div class="post--info">
                                                        <ul class="nav meta">
                                                            <li><a href="#"><?php echo e($item->author_info['name']); ?></a></li>
                                                            <li><a class="time" href="#"><?php echo e(Timezone::convertToLocal($item->created_at)); ?></a></li>
                                                        </ul>

                                                        <div class="title">
                                                            <h3 class="h4"><a href="<?php echo e(route('post-detail', $item->id)); ?>" class="btn-link"><?php echo e($item->title); ?></a></h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Post Item End -->
                                        </li>
                                        <li class="col-xs-12 hidden shown-xxs">
                                            <!-- Divider Start -->
                                            <hr class="divider">
                                            <!-- Divider End -->
                                        </li>                                        
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                   
                                </ul>                                
                            </div>
                            <!-- Post Items End -->
                        </div>                            
                        <?php endif; ?>
                      

                        <!-- Photo Gallery Start -->
                        <div class="col-md-12 ptop--30 pbottom--30">
                            <!-- Post Items Title Start -->
                            <div class="post--items-title" data-ajax="tab">
                                <h2 class="h4">Photo Gallery</h2>

                                <div class="nav">
                                    <a href="<?php echo e(route('gallery')); ?>" class="prev btn-link">
                                        View More 
                                    </a>
                                </div>
                            </div>
                            <!-- Post Items Title End -->

                            <?php if(!$gallery->isempty()): ?>
                            <!-- Post Items Start -->
                            <div class="post--items post--items-1" data-ajax-content="outer">
                                <ul class="nav row gutter--15" data-ajax-content="inner">
                                    <?php $__currentLoopData = $gallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($loop->first): ?>
                                        <li class="col-md-12">
                                            <!-- Post Item Start -->
                                            <div class="post--item post--layout-1 post--title-large">
                                                <div class="post--img">
                                                    <a href="<?php echo e(asset('upload/gallery/'.$item->image)); ?>" class="thumb" style="height:400px;"><img src="<?php echo e(asset('upload/gallery/'.$item->image)); ?>" alt=""></a>
                                                    <a href="<?php echo e(asset('upload/gallery/'.$item->image)); ?>" class="icon"><i class="fa fa-eye"></i></a>
    
                                                    <div class="post--info">
                                                        <ul class="nav meta">
                                                            <li><a href="#"><?php echo e($item->created_by['name']); ?></a></li>
                                                            <li><a class="time" href="#"><?php echo e(Timezone::convertToLocal($item->created_at)); ?></a></li>
                                                        </ul>
    
                                                        <div class="title text-xxs-ellipsis">
                                                            <h2 class="h4"><a href="" class="btn-link"><?php echo e($item->title); ?></a></h2>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Post Item End -->
                                        </li>
                                        <?php else: ?>
                                        <li class="col-md-4 col-xs-6 col-xxs-12">
                                            <!-- Post Item Start -->
                                            <div class="post--item post--layout-1">
                                                <div class="post--img">
                                                    <a href="<?php echo e(asset('upload/gallery/'.$item->image)); ?>" class="thumb" style="height:200px;"><img src="<?php echo e(asset('upload/gallery/'.$item->image)); ?>" alt=""></a>
    
                                                    <div class="post--info">
                                                        <ul class="nav meta">
                                                            <li><a href="#"><?php echo e($item->created_by['name']); ?></a></li>
                                                            <li><a class="time" href="#"><?php echo e(Timezone::convertToLocal($item->created_at)); ?></a></li>
                                                        </ul>
    
                                                        <div class="title text-xxs-ellipsis">
                                                            <h2 class="h4"><a href="" class="btn-link"><?php echo e($item->title); ?></a></h2>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Post Item End -->
                                        </li>
                                            
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>                                
                            </div>
                            <!-- Post Items End -->                                
                            <?php endif; ?>
                        </div>
                        <!-- Photo Gallery End -->
                    </div>
                </div>
            </div>
            <!-- Main Content End -->
          
         
            <!-- Main Sidebar Start -->
            <div class="main--sidebar col-md-4 col-sm-5 ptop--30 pbottom--30" data-sticky-content="true">
                <div class="sticky-content-inner">
                 
                    <!-- Widget Start -->
                    <div class="widget">
                        <div class="widget--title">
                            <h2 class="h4">Catagory</h2>
                            <i class="icon fa fa-folder-open-o"></i>
                        </div>

                        <?php if(!$cats->isempty()): ?>
                        <!-- Nav Widget Start -->
                        <div class="nav--widget">
                            <ul class="nav">
                                <?php $__currentLoopData = $cats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><a href="<?php echo e(route('cat-post', $item->id)); ?>"><span><?php echo e($item->title); ?></span><span>()</span></a></li>
                                    
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                
                            </ul>
                        </div>
                        <!-- Nav Widget End -->                            
                        <?php endif; ?>
                    </div>
                    <!-- Widget End -->
                  	
                  	<!-- Widget Start -->
                    <div class="widget">
                        <div class="widget--title">
                            <h2 class="h4">Advertisement</h2>
                            <i class="icon fa fa-bullhorn"></i>
                        </div>

                        <?php if(@$sidebar_lg_ads[1]->type == 'image'): ?>
                            <!-- Advertisement Start -->
                            <div class="ad--widget" style="height: 70px;" >
                                <a href="<?php echo e(@$sidebar_lg_ads[1]->link); ?>" >
                                    <img src="<?php echo e(asset('upload/advertise/Thumb-lg-'.@$sidebar_lg_ads[1]->image)); ?>" alt="Ads 728x90">
                                </a>
                            </div>
                            <!-- Advertisement End -->                             
                            <?php else: ?>
                            <video width="100%" controls autoplay loop>
                                <source src="<?php echo e(asset('upload/advertise/'.@$sidebar_lg_ads[1]->image)); ?>" height="100px" type="file">
                                <source src="<?php echo e(asset('upload/advertise/'.@$sidebar_lg_ads[1]->image)); ?>" type="video/ogg">
                                Your browser does not support the video tag.
                            </video>  
                        <?php endif; ?>
                    </div>            
                </div>
            </div>
            <!-- Main Sidebar End -->
        </div>
        <input type="text" name="timezone" id="timezone">
        echo '<script type="text/javascript">
            var x = new Date()
            document.write(x)
            </script>';
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
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\fstv\resources\views/frontend/index.blade.php ENDPATH**/ ?>