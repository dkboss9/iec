
<?php $__env->startSection('title'); ?>
    Homepage
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>


<!-- Main Content Section Start -->
<div class="main-content--section pbottom--30">
    <div class="container">

        <?php if(session()->has('message')): ?>
            <div class="alert alert-success">
                <?php echo e(session()->get('message')); ?>

            </div>
        <?php endif; ?>

        <div class="row">
            <!-- Main Content Start -->
            <div class="main--content col-md-8 col-sm-7" data-sticky-content="true">
                <div class="sticky-content-inner">
                    <div class="row">

                        <?php if(!$trending_video->isempty()): ?>
                        <div class="col-md-12 ptop--30 pbottom--30">                                                            
                            <div class="widget--title">
                                <h2 class="h4">Trending Videos</h2>
                            </div>
                            <!-- Post Items Start -->
                            <div class="post--items post--items-1" data-ajax-content="outer">
                                <ul class="nav row gutter--15" data-ajax-content="inner">
                                    <?php $__currentLoopData = $trending_video->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($loop->first): ?>
                                        <li class="col-md-12">
                                            <!-- Post Item Start -->
                                            <div class="post--item post--layout-1 post--title-large">
                                                <div class="post--img">
                                                    <div class="product" >
                                                        <?php if($item->video != ''){ ?>
                                                            <video style="display:block; margin: 0 auto;" height="350" 
                                                                poster="<?php echo e(asset('upload/fstv/video/'.$item->image)); ?>" 
                                                                src="<?php echo e(asset('upload/fstv/video/'.$item->video)); ?>" 
                                                                playsinline controls>
                                                            </video>
                                                            
                                                        <?php }else{ ?>
                                                            <?php echo Embed::make($item->link)->parseUrl()->setAttribute([
                                                            'width' => '100%',
                                                            'height' => 350,
                                                            'frameborder' => 0,
                                                            'allowfullscreen' => true
                                                            ])->getHtml(); ?>

                                                        <?php } ?>
                                                        
                                                                
                                                        <div class="title">
                                                            <h3 class="h5"><a href="<?php echo e(route('video-detail',$item->id)); ?>" class="btn-link"><?php echo Illuminate\Support\Str::limit($item->title, 50); ?></a></h3>
                                                            <p><?php echo Illuminate\Support\Str::limit(html_entity_decode($item->detail), 80); ?></p>
                                                        </div>                                                                               
                                                    </div>                                                    
                                                </div>
                                            </div>
                                            <!-- Post Item End -->
                                            <hr class="divider">
                                        </li>
                                        <?php else: ?>
                                        <li class="col-md-4 col-xs-6 col-xxs-12">
                                            <!-- Post Item Start -->
                                            <div class="post--item post--layout-1">
                                                <div class="post--img">
                                                    <div class="product">
                                                        <?php if($item->video != ''){ ?>
                                                            <video style="display:block; margin: 0 auto;" height="150" width="100%" 
                                                                poster="<?php echo e(asset('upload/fstv/video/'.$item->image)); ?>" 
                                                                src="<?php echo e(asset('upload/fstv/video/'.$item->video)); ?>" 
                                                                playsinline controls>
                                                            </video>
                                                        <?php }else{ ?>
                                                            <?php echo Embed::make($item->link)->parseUrl()->setAttribute([
                                                            'width' => '100%',
                                                            'height' => 150,
                                                            'frameborder' => 0,
                                                            'allowfullscreen' => true
                                                            ])->getHtml(); ?>

                                                        <?php } ?>
                                                        <div class="title">
                                                            <h3 class="h5"><a href="<?php echo e(route('video-detail',$item->id)); ?>" class="btn-link"><?php echo Illuminate\Support\Str::limit($item->title, 50); ?></a></h3>
                                                            <p><?php echo Illuminate\Support\Str::limit(html_entity_decode($item->detail), 50); ?></p>
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
                        </div>
                        <?php endif; ?>   
                        
                    </div>
                    
                    <div class="row">
                        
                        <!-- Ad Start -->
                        <div class="col-md-12 ptop--30 pbottom--30">
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
                        </div>
                        <!-- Ad End -->

                        <?php if(!$featured_video->isempty() ): ?>                     
                        <div class="col-md-12 ptop--30 pbottom--30">
                            <!-- Post Items Title Start -->
                            <div class="post--items-title" data-ajax="tab">
                                <h2 class="h4">Featured Videos</h2>

                                <div class="nav">
                                    <a href="<?php echo e(route('video-featured')); ?>" class="prev btn-link">
                                        <p>More</p>
                                    </a>
                                </div>
                            </div>
                            <!-- Post Items Title End -->

                            <!-- Post Items Start -->
                            <div class="post--items" data-ajax-content="outer">
                                <ul class="nav row gutter--15" data-ajax-content="inner">
                                    <?php $__currentLoopData = $featured_video->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="col-md-4 col-xs-6 col-xxs-12">
                                            <!-- Post Item Start -->
                                            <div class="post--item post--layout-1">
                                                <div class="post--img">
                                                    <div class="product">
                                                        <?php if($item->video_info['video'] != ''){ ?>
                                                            <video style="display:block; margin: 0 auto;" height="150" 
                                                                poster="<?php echo e(asset('upload/fstv/video/'.$item->image)); ?>" 
                                                                src="<?php echo e(asset('upload/fstv/video/'.$item->video)); ?>" 
                                                                playsinline controls>
                                                            </video>
                                                        <?php }elseif($item->video_info['link'] != ''){ ?>
                                                            <?php echo Embed::make($item->video_info['link'])->parseUrl()->setAttribute([
                                                            'width' => '100%',
                                                            'height' => 150,
                                                            'frameborder' => 0,
                                                            'allowfullscreen' => true
                                                            ])->getHtml(); ?>

                                                        <?php } ?>
                                                        <div class="title">
                                                            <h3 class="h5"><a href="<?php echo e(route('video-detail',$item->video_info['id'])); ?>" class="btn-link"><?php echo Illuminate\Support\Str::limit($item->video_info['title'], 50); ?></a></h3>
                                                            <p><?php echo Illuminate\Support\Str::limit(html_entity_decode($item->video_info['detail']), 50); ?></p>
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
                                </ul>                                
                            </div>
                            <!-- Post Items End -->
                        </div>                            
                        <?php endif; ?>

                        <?php if(!$popular_video->isempty() ): ?>                     
                        <div class="col-md-12 ptop--30 pbottom--30">
                            <!-- Post Items Title Start -->
                            <div class="post--items-title" data-ajax="tab">
                                <h2 class="h4">Popular Videos</h2>

                                <div class="nav">
                                    <a href="<?php echo e(route('video-popular')); ?>" class="prev btn-link">
                                        <p>More</p>
                                    </a>
                                </div>
                            </div>
                            <!-- Post Items Title End -->

                            <!-- Post Items Start -->
                            <div class="post--items" data-ajax-content="outer">
                                <ul class="nav row gutter--15" data-ajax-content="inner">
                                    <?php $__currentLoopData = $popular_video->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="col-md-4 col-xs-6 col-xxs-12">
                                            <!-- Post Item Start -->
                                            <div class="post--item post--layout-1">
                                                <div class="post--img">
                                                    <div class="product">
                                                        <?php if($item->video_info['video'] != ''){ ?>
                                                            <video style="display:block; margin: 0 auto;" height="150" 
                                                                poster="<?php echo e(asset('upload/fstv/video/'.$item->image)); ?>" 
                                                                src="<?php echo e(asset('upload/fstv/video/'.$item->video)); ?>" 
                                                                playsinline controls>
                                                            </video>
                                                        <?php }elseif($item->video_info['link'] != ''){ ?>
                                                            <?php echo Embed::make($item->video_info['link'])->parseUrl()->setAttribute([
                                                            'width' => '100%',
                                                            'height' => 150,
                                                            'frameborder' => 0,
                                                            'allowfullscreen' => true
                                                            ])->getHtml(); ?>

                                                        <?php } ?>
                                                        <div class="title">
                                                            <h3 class="h5"><a href="<?php echo e(route('video-detail',$item->video_info['id'] )); ?>" class="btn-link"><?php echo Illuminate\Support\Str::limit($item->video_info['title'], 50); ?></a></h3>
                                                            <p><?php echo Illuminate\Support\Str::limit(html_entity_decode($item->video_info['detail']), 50); ?></p>
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
                                </ul>                                
                            </div>
                            <!-- Post Items End -->
                        </div>                            
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
                        <div class="widget--title">
                            <h2 class="h4">More Videos Category</h2>
                            <i class="icon fa fa-folder-open-o"></i>
                        </div>

                        <!-- Nav Widget Start -->
                        <div class="nav--widget">
                            <ul class="nav">
                                <?php $__currentLoopData = $menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <a href="<?php echo e(route('cat_video', $item->id)); ?>"><span><?php echo e($item->title); ?></span><span>()</span></a>
                                    <?php if(!$item->isempty): ?>
                                    <ul>
                                        <?php $__currentLoopData = $item->submenu_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li><a href="<?php echo e(route('subcat_video', $row->id)); ?>"><?php echo e($row->title); ?></a></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </ul>
                                        
                                    <?php endif; ?>
                                </li>
                                    
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            
                            </ul>
                        </div>
                        <!-- Nav Widget End -->
                    </div>
                    <!-- Widget End -->

                    <!-- Widget Start -->
                    <div class="widget">
                        <div class="widget--title">
                            <h2 class="h4">More Videos</h2>
                            <i class="icon fa fa-newspaper-o"></i>
                        </div>

                        <!-- List Widgets Start -->
                        <div class="list--widget list--widget-1">
                            <div class="list--widget-nav" data-ajax="tab">
                                <ul class="nav nav-justified">
                                    <li class="">
                                        <a href="#" id="popular_video">Popular Videos</a>
                                    </li>
                                    <li class="active">
                                        <a href="#" id="featured_video" class="featured_video" >Featured Videos</a>
                                    </li>
                                    <li class="">
                                        <a href="#" id="trending_video" class="trending_video" >Trending Videos</a>
                                    </li>
                                </ul>
                            </div>

                            <!-- Post Items Start -->
                            <div class="post--items post--items-3" id="featured">
                                <ul class="nav" data-ajax-content="inner">
                                    <?php $__currentLoopData = @$featured_video; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <!-- Post Item Start -->
                                        <div class="post--item post--layout-3">
                                            <div class="post--img">
                                                <div class="thumb">
                                                    <?php if($item->video_info['video'] != ''){ ?>
                                                        <video style="display:block; margin: 0 auto;" height="80" 
                                                                poster="<?php echo e(asset('upload/fstv/video/'.$item->image)); ?>" 
                                                                src="<?php echo e(asset('upload/fstv/video/'.$item->video)); ?>" 
                                                                playsinline controls>
                                                            </video>
                                                    <?php }elseif($item->video_info['link'] != ''){ ?>
                                                        <?php echo Embed::make($item->video_info['link'])->parseUrl()->setAttribute([
                                                        'width' => '100%',
                                                        'height' => 80,
                                                        'frameborder' => 0,
                                                        'allowfullscreen' => true
                                                        ])->getHtml(); ?>

                                                    <?php } ?>
                                                </div>

                                                <div class="post--info">
                                                    <p class="utctime"><?php echo e(($item->video_info['created_at'])); ?></p>
                                                    <div class="title">
                                                        <h3 class="h4"><a href="<?php echo e(route('video-detail',$item->video_info['id'])); ?>" class="btn-link"><?php echo e($item->video_info['title']); ?></a></h3>
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
                            <div class="post--items post--items-3 hide" id="popular">
                                <ul class="nav" data-ajax-content="inner">
                                    <?php $__currentLoopData = @$popular_video; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <!-- Post Item Start -->
                                        <div class="post--item post--layout-3">
                                            <div class="post--img">
                                                <div class="thumb">
                                                    <?php if($item->video_info['video'] != ''){ ?>
                                                        <video style="display:block; margin: 0 auto;" height="80" 
                                                        poster="<?php echo e(asset('upload/fstv/video/'.$item->image)); ?>" 
                                                        src="<?php echo e(asset('upload/fstv/video/'.$item->video)); ?>" 
                                                        playsinline controls>
                                                    </video>
                                                    <?php }elseif($item->video_info['link'] != ''){ ?>
                                                        <?php echo Embed::make($item->video_info['link'])->parseUrl()->setAttribute([
                                                        'width' => '100%',
                                                        'height' => 80,
                                                        'frameborder' => 0,
                                                        'allowfullscreen' => true
                                                        ])->getHtml(); ?>

                                                    <?php } ?>
                                                </div>

                                                <div class="post--info">
                                                    <p class="utctime"><?php echo e(($item->video_info['created_at'])); ?></p>
                                                    <div class="title">
                                                        <h3 class="h4"><a href="<?php echo e(route('video-detail',$item->video_info['id'])); ?>" class="btn-link"><?php echo e($item->video_info['title']); ?></a></h3>
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
                            <div class="post--items post--items-3 hide" id="trending">
                                <ul class="nav" data-ajax-content="inner">
                                    <?php $__currentLoopData = @$trending_video->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <!-- Post Item Start -->
                                        <div class="post--item post--layout-3">
                                            <div class="post--img">
                                                <div class="thumb">
                                                    <?php if($item->video != ''){ ?>
                                                        <video style="display:block; margin: 0 auto;" height="80" 
                                                            poster="<?php echo e(asset('upload/fstv/video/'.$item->image)); ?>" 
                                                            src="<?php echo e(asset('upload/fstv/video/'.$item->video)); ?>" 
                                                            playsinline controls>
                                                        </video>
                                                    <?php }else{ ?>
                                                        <?php echo Embed::make($item->link)->parseUrl()->setAttribute([
                                                        'width' => '100%',
                                                        'height' => 80,
                                                        'frameborder' => 0,
                                                        'allowfullscreen' => true
                                                        ])->getHtml(); ?>

                                                    <?php } ?>
                                                </div>

                                                <div class="post--info">
                                                    <p class="utctime"><?php echo e(($item->created_at)); ?></p>
                                                    <div class="title">
                                                        <h3 class="h4"><a href="<?php echo e(route('video-detail',$item->id)); ?>" class="btn-link"><?php echo e($item->title); ?></a></h3>
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
<!-- Main Content Section End -->
    
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script>
    $(document).ready(function(){
        $(document).on("click","#popular_video",function(e){           
            $('#featured').addClass('hide');
            $('#trending').addClass('hide');
            $('#popular').removeClass('hide');
            $('ul.nav li.active').removeClass('active');
            $(this).parent().addClass('active');
            e.preventDefault();
        });
        $(document).on("click","#featured_video",function(e){           
            $('#popular').addClass('hide');
            $('#trending').addClass('hide');
            $('#featured').removeClass('hide');
            $('ul.nav li.active').removeClass('active');
            $(this).parent().addClass('active');
            e.preventDefault();
        });
        $(document).on("click","#trending_video",function(e){           
            $('#popular').addClass('hide');
            $('#featured').addClass('hide');
            $('#trending').removeClass('hide');
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
    
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ausnepc/firescreen.ausnep.com/resources/views/frontend/video.blade.php ENDPATH**/ ?>