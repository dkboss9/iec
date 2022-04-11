<div class="fixed-sidebar-left">
    <ul class="nav navbar-nav side-nav nicescroll-bar">
        <li class="navigation-header">
            <span>Main</span> 
            <i class="zmdi zmdi-more"></i>
        </li>
        <li>
            <a class="<?php echo e(Request::path() == 'admin' ? 'active' : ''); ?>" href="javascript:void(0);" data-toggle="collapse" data-target="#dashboard_dr"><div class="pull-left"><i class="zmdi zmdi-landscape mr-20"></i><span class="right-nav-text">Dashboard</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
            <ul id="dashboard_dr" class="collapse collapse-level-1">
                <li>
                    <a class="<?php echo e(Request::path() == 'admin' ? 'active-page' : ''); ?>" href="<?php echo e(route('home')); ?>">Home</a>
                </li>                
            </ul>
        </li>

        <li><hr class="light-grey-hr mb-10"/></li>
        <li class="navigation-header">
            <span>Features</span> 
            <i class="zmdi zmdi-more"></i>
        </li>
       
        <li>
            <a class="<?php echo e(Request::path() == 'admin/post' ? 'active' : ''); ?>" href="javascript:void(0);" data-toggle="collapse" data-target="#post_dr"><div class="pull-left"><i class="fa fa-clipboard mr-20"></i><span class="right-nav-text">Posts</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
            <ul id="post_dr" class="collapse collapse-level-1 two-col-list">
                <li>
                    <a href="<?php echo e(route('editor-publish-post')); ?>">Published News</a>
                </li>
                <li>
                    <a href="<?php echo e(route('post.index')); ?>">Unpublish News</a>
                </li>
            </ul>
        </li>

        <li>
            <a class="<?php echo e(Request::path() == 'admin/video' ? 'active' : ''); ?>" href="javascript:void(0);" data-toggle="collapse" data-target="#video_dr"><div class="pull-left"><i class="fa fa-video-camera mr-20"></i><span class="right-nav-text">FSTV TV</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
            <ul id="video_dr" class="collapse collapse-level-1 two-col-list">
                <li>
                    <a href="<?php echo e(route('editor-publish-video')); ?>">Publish Videos</a>
                </li>
                <li>
                    <a href="<?php echo e(route('video.index')); ?>">Unpublish Videos</a>
                </li>
            </ul>
        </li>

        <li>
            <a class="<?php echo e(Request::path() == 'admin/blog' ? 'active' : ''); ?>" href="javascript:void(0);" data-toggle="collapse" data-target="#blog_dr"><div class="pull-left"><i class="fa fa-th mr-20"></i><span class="right-nav-text">Blogs</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
            <ul id="blog_dr" class="collapse collapse-level-1 two-col-list">
                <li>
                    <a href="<?php echo e(route('editor-publish-blog')); ?>">Publish Blogs</a>
                </li>
                <li>
                    <a href="<?php echo e(route('blog.index')); ?>">Unpublish Blogs</a>
                </li>
            </ul>
        </li>
        
        <li>
            <a class="<?php echo e(Request::path() == 'admin/gallery' ? 'active' : ''); ?>" href="javascript:void(0);" data-toggle="collapse" data-target="#gallery_dr"><div class="pull-left"><i class="fa fa-picture-o mr-20"></i><span class="right-nav-text">Gallery</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
            <ul id="gallery_dr" class="collapse collapse-level-1 two-col-list">
                <li>
                    <a href="<?php echo e(route('editor-publish-gallery')); ?>">Publish Galleries</a>
                </li>
                <li>
                    <a href="<?php echo e(route('gallery.index')); ?>">Unpublish Galleries</a>
                </li>
            </ul>
        </li>
        
        <li><hr class="light-grey-hr mb-10"/></li>
        
        <li>
            <a class="<?php echo e(Request::path() == 'admin/featured' ? 'active' : ''); ?>" href="<?php echo e(route('featured.index')); ?>" data-toggle="collapse" data-target="#featured_dr"><div class="pull-left"><i class="fa fa-star mr-20"></i><span class="right-nav-text">Top Featured</span></div><div class="clearfix"></div></a>
        </li>
        <li>
            <a class="<?php echo e(Request::path() == 'admin/popular' ? 'active' : ''); ?>" href="<?php echo e(route('popular.index')); ?>" data-toggle="collapse" data-target="#popular_dr"><div class="pull-left"><i class="fa fa-heart mr-20"></i><span class="right-nav-text">Popular</span></div><div class="clearfix"></div></a>
        </li>
       
        <li><hr class="light-grey-hr mb-10"/></li>               
        <li>
            <a class="<?php echo e(Request::path() == 'admin/feedback' ? 'active' : ''); ?>" href="<?php echo e(route('feedback.index')); ?>" data-toggle="collapse" data-target="#feedback_dr"><div class="pull-left"><i class="fa fa-question-circle mr-20"></i><span class="right-nav-text">Support</span></div><div class="clearfix"></div></a>
        </li>
        <li><hr class="light-grey-hr mb-10"/></li>

    </ul>
</div><?php /**PATH /home/ausnepc/firescreen.ausnep.com/resources/views/editor/section/left-sidebar.blade.php ENDPATH**/ ?>