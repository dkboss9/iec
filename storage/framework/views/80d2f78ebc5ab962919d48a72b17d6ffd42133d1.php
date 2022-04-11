
<?php $__env->startSection('title'); ?>
  Video Detail
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <!-- Main Breadcrumb Start -->
    <div class="main--breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="<?php echo e(route('homepage')); ?>" class="btn-link"><i class="fa fm fa-home"></i>Home</a></li>
                <li class=""><span><a href="<?php echo e(route('cat_video', @$video->menu_info['id'])); ?>"></a><?php echo e(@$video->menu_info['title']); ?></span></li>
                <?php if(@$video->submenu !== null): ?>
                <li class=""><span><a href="<?php echo e(route('subcat_video', @$video->submenu_info['id'])); ?>"></a><?php echo e(@$video->submenu_info['title']); ?></span></li>
                <?php endif; ?>
                <?php if(@$video->childmenu != null): ?>
                <li class=""><span><a href="<?php echo e(route('childcat_video', @$video->childmenu_info['id'])); ?>"></a><?php echo e(@$video->childmenu_info['title']); ?></span></li>
                <?php endif; ?>
                <li class="active"><span><?php echo e($video->title); ?></span></li>
            </ul>
        </div>
    </div>
    <!-- Main Breadcrumb End -->

    <?php if(Session::has('message')): ?>
            <div class="alert alert-info"><?php echo e(Session::get('message')); ?></div>
        <?php endif; ?>
    
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
                                <div class="product" >
                                    <?php if($video->video != ''){ ?>
                                        <video style="display:block; margin: 0 auto;" height="400" 
                                            poster="<?php echo e(asset('upload/fstv/video/'.$video->image)); ?>" 
                                            src="<?php echo e(asset('upload/fstv/video/'.$video->video)); ?>" 
                                            playsinline controls>
                                        </video>
                                    <?php }else{ ?>
                                        <?php echo Embed::make($video->link)->parseUrl()->setAttribute([
                                        'width' => '100%',
                                        'height' => 420,
                                        'frameborder' => 0,
                                        'allowfullscreen' => true
                                        ])->getHtml(); ?>

                                    <?php } ?>
                                                                                                                
                                </div> 
                            </div>

                            <div class="post--info">
                                <p class="utctime"><?php echo e(($video->created_at)); ?> </p>
                                <?php echo Share::currentpage()
                                    ->facebook()
                                    ->twitter(); 
                                ?>
                                
                                <div class="title">
                                    <h2 class="h4"><?php echo e($video->title); ?></h2>
                                </div>
                                <?php $__currentLoopData = $video->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <label class="label label-info"><?php echo e($tag['name']); ?></label>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>

                            <div class="post--content">
                                <p><?php echo html_entity_decode($video->detail); ?></p>    
                            </div>
                           
                        </div>
                        <!-- Post Item End -->
                      
                      	<?php if(!$epsod->isempty()): ?>
                        <ul class="nav row gutter--15" data-ajax-content="inner">

                            <?php $__currentLoopData = $epsod; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="col-md-4 col-xs-6 col-xxs-12">
                                    <!-- Post Item Start -->
                                    <div class="post--item post--layout-1">
                                        <div class="post--img">
                                            <div class="product">
                                                <?php if($item->video != ''){ ?>
                                                    <?php echo Embed::make(URL('upload/fstv/video/'.$item->video))->parseUrl()->setAttribute([
                                                    'width' => '150',
                                                    'height' => 150,
                                                    'frameborder' => 0,
                                                    'allowfullscreen' => true
                                                    ])->getHtml(); ?>

                                                <?php }else{ ?>
                                                    <?php echo Embed::make($item->link)->parseUrl()->setAttribute([
                                                    'width' => '150',
                                                    'height' => 150,
                                                    'frameborder' => 0,
                                                    'allowfullscreen' => true
                                                    ])->getHtml(); ?>

                                                <?php } ?>
                                                <div class="title">
                                                    <h3 class="h5"><a href="<?php echo e(route('video-detail', $item->id)); ?>" class="btn-link"><?php echo Illuminate\Support\Str::limit($item->title, 50); ?></a></h3>
                                                    <p><?php echo Illuminate\Support\Str::limit(html_entity_decode($item->detail), 50); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Post Item End -->
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                        <?php endif; ?>

                        

                        <?php if(@$content_lg_ads[0]->type == 'image'): ?>
                            <!-- Advertisement Start -->
                            <div class="ad--widget" id="adver"  ads_id="<?php echo e(@$content_lg_ads[0]->id); ?>" style="height: 70px;" >
                                <a href="<?php echo e(@$content_lg_ads[0]->link); ?>" >
                                    <img src="<?php echo e(asset('upload/advertise/Thumb-lg-'.@$content_lg_ads[0]->image)); ?>" width="100%" alt="Ads 728x90">
                                </a>
                            </div>
                            <!-- Advertisement End -->                             
                            <?php elseif(@$content_lg_ads[0]->type == 'video'): ?>
                            <div class="ad--widget row">
                                <div class="col-md-6" id="adver"  ads_id="<?php echo e(@$content_lg_ads[0]->id); ?>" height="120px">
                                <a href="<?php echo e(@$content_lg_ads[0]->link); ?>" >
                                    <video width="100%" height="120px" controls autoplay playsinline>
                                        <source height="120px" src="<?php echo e(asset('upload/advertise/'.@$item->image)); ?>" type="file">
                                        <source height="120px" src="<?php echo e(asset('upload/advertise/'.@$item->image)); ?>" type="video/ogg">
                                        Your browser does not support the video tag.
                                    </video>  
                                </a>
                                </div>
                                <div class="col-md-6" id="adver"  ads_id="<?php echo e(@$content_lg_ads[0]->id); ?>" height="120px">
                                    <a href="<?php echo e(@$content_lg_ads[0]->link); ?>" >
                                    <video width="100%" height="120px" controls autoplay playsinline>
                                        <source height="120px" src="<?php echo e(asset('upload/advertise/'.@$item->image)); ?>" type="file">
                                        <source height="120px" src="<?php echo e(asset('upload/advertise/'.@$item->image)); ?>" type="video/ogg">
                                        Your browser does not support the video tag.
                                    </video>  
                                </a> 
                                </div>
                            </div> 
                        <?php endif; ?>
                       
                        <hr class="divider divider--25">  
                        
                                             
                       
                    </div>
                </div>
                <!-- Main Content End -->

                <!-- Main Sidebar Start -->
                <div class="main--sidebar col-md-4 col-sm-5 ptop--30 pbottom--30" data-sticky-content="true">
                    <div class="sticky-content-inner">
                        

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
                                                            <?php echo Embed::make(URL('upload/fstv/video/'.$item->video_info['video']))->parseUrl()->setAttribute([
                                                            'width' => '100%',
                                                            'height' => 80,
                                                            'frameborder' => 0,
                                                            'allowfullscreen' => true
                                                            ])->getHtml(); ?>

                                                        <?php }else{ ?>
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
                                                            <h3 class="h4"><a href="<?php echo e(route('video-detail', $item->video_info['id'])); ?>" class="btn-link"><?php echo e($item->video_info['title']); ?></a></h3>
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
                                                            <?php echo Embed::make(URL('upload/fstv/video/'.$item->video_info['video']))->parseUrl()->setAttribute([
                                                            'width' => '100%',
                                                            'height' => 80,
                                                            'frameborder' => 0,
                                                            'allowfullscreen' => true
                                                            ])->getHtml(); ?>

                                                        <?php }else{ ?>
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
                                                            <h3 class="h4"><a href="<?php echo e(route('video-detail', $item->video_info['id'])); ?>" class="btn-link"><?php echo e($item->video_info['title']); ?></a></h3>
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
                                                            <?php echo Embed::make(URL('upload/fstv/video/'.$item->video))->parseUrl()->setAttribute([
                                                            'width' => '100%',
                                                            'height' => 80,
                                                            'frameborder' => 0,
                                                            'allowfullscreen' => true
                                                            ])->getHtml(); ?>

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
                                                            <h3 class="h4"><a href="<?php echo e(route('video-detail', $item->id)); ?>" class="btn-link"><?php echo e($item->title); ?></a></h3>
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
                                <h2 class="h4">Advertisement</h2>
                                <i class="icon fa fa-bullhorn"></i>
                            </div>

                            <?php if(@$sidebar_lg_ads[0]->type == 'image'): ?>
                                <!-- Advertisement Start -->
                                <div class="ad--widget" id="adver" ads_id="<?php echo e($sidebar_lg_ads[0]->id); ?>" style="height: 70px;" >
                                    <a href="<?php echo e($sidebar_lg_ads[0]->link); ?>">
                                        <img src="<?php echo e(asset('upload/advertise/Thumb-lg-'.@$sidebar_lg_ads[0]->image)); ?>" alt="Ads 728x90">
                                    </a>
                                </div>
                                <!-- Advertisement End -->                             
                                <?php elseif(@$sidebar_lg_ads[0]->type == 'video'): ?>
                                <a href="<?php echo e($sidebar_lg_ads[0]->link); ?>" id="adver" ads_id="<?php echo e($sidebar_lg_ads[0]->id); ?>" >
                                    <video width="100%" height="120px" controls autoplay playsinline loop>
                                        <source src="<?php echo e(asset('upload/advertise/'.@$sidebar_lg_ads[0]->image)); ?>" height="100px" type="file">
                                        <source src="<?php echo e(asset('upload/advertise/'.@$sidebar_lg_ads[0]->image)); ?>" type="video/ogg">
                                        Your browser does not support the video tag.
                                    </video>  
                                </a>
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
    $("document").ready(function(){
        setTimeout(function(){
           $(".alert-info").remove();
        }, 5000 ); // 5 secs   
    });
</script>
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
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ausnepc/firescreen.ausnep.com/resources/views/frontend/fstv/video-detail.blade.php ENDPATH**/ ?>