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
            <a class="<?php echo e(Request::path() == 'admin/category' ? 'active' : ''); ?> href="javascript:void(0);" data-toggle="collapse" data-target="#category_dr"><div class="pull-left"><i class="fa fa-folder-open-o mr-20"></i><span class="right-nav-text">Category</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
            <ul id="category_dr" class="collapse collapse-level-1 two-col-list">
                <li>
                    <a class="<?php echo e(Request::path() == 'admin/category/create' ? 'active-page' : ''); ?>" href="<?php echo e(route('category.create')); ?>">Add</a>
                </li>
                <li>
                    <a href="<?php echo e(route('category.index')); ?>">View</a>
                </li>
                <li>
                    <a href="<?php echo e(route('sub_category')); ?>">Sub-Category</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="<?php echo e(Request::path() == 'admin/post' ? 'active' : ''); ?> href="javascript:void(0);" data-toggle="collapse" data-target="#post_dr"><div class="pull-left"><i class="fa fa-clipboard mr-20"></i><span class="right-nav-text">Posts</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
            <ul id="post_dr" class="collapse collapse-level-1 two-col-list">
                <li>
                    <a class="<?php echo e(Request::path() == 'admin/post/create' ? 'active-page' : ''); ?>" href="<?php echo e(route('post.create')); ?>">Add</a>
                </li>
                <li>
                    <a href="<?php echo e(route('post.index')); ?>">View</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="<?php echo e(Request::path() == 'admin/blog' ? 'active' : ''); ?> href="javascript:void(0);" data-toggle="collapse" data-target="#blog_dr"><div class="pull-left"><i class="fa fa-th mr-20"></i><span class="right-nav-text">Blogs</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
            <ul id="blog_dr" class="collapse collapse-level-1 two-col-list">
                <li>
                    <a class="<?php echo e(Request::path() == 'admin/blog/create' ? 'active-page' : ''); ?>" href="<?php echo e(route('blog.create')); ?>">Add</a>
                </li>
                <li>
                    <a href="<?php echo e(route('blog.index')); ?>">View</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="<?php echo e(Request::path() == 'admin/media' ? 'active' : ''); ?> href="javascript:void(0);" data-toggle="collapse" data-target="#media_dr"><div class="pull-left"><i class="fa fa-video-camera mr-20"></i><span class="right-nav-text">FSTV TV</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
            <ul id="media_dr" class="collapse collapse-level-1 two-col-list">
                <li>
                    <a class="<?php echo e(Request::path() == 'admin/media/create' ? 'active-page' : ''); ?>" href="<?php echo e(route('media.create')); ?>">Add</a>
                </li>
                <li>
                    <a href="<?php echo e(route('media.index')); ?>">View</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="<?php echo e(Request::path() == 'admin/gallery' ? 'active' : ''); ?> href="javascript:void(0);" data-toggle="collapse" data-target="#gallery_dr"><div class="pull-left"><i class="fa fa-picture-o mr-20"></i><span class="right-nav-text">Gallery</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
            <ul id="gallery_dr" class="collapse collapse-level-1 two-col-list">
                <li>
                    <a class="<?php echo e(Request::path() == 'admin/gallery/create' ? 'active-page' : ''); ?>" href="<?php echo e(route('gallery.create')); ?>">Add</a>
                </li>
                <li>
                    <a href="<?php echo e(route('gallery.index')); ?>">View</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="<?php echo e(Request::path() == 'admin/advertise' ? 'active' : ''); ?> href="javascript:void(0);" data-toggle="collapse" data-target="#advertise_dr"><div class="pull-left"><i class="fa fa-external-link mr-20"></i><span class="right-nav-text">Advertise</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
            <ul id="advertise_dr" class="collapse collapse-level-1 two-col-list">
                <li>
                    <a class="<?php echo e(Request::path() == 'admin/advertise/create' ? 'active-page' : ''); ?>" href="<?php echo e(route('advertise.create')); ?>">Add</a>
                </li>
                <li>
                    <a href="<?php echo e(route('advertise.index')); ?>">View</a>
                </li>
            </ul>
        </li>

        <li><hr class="light-grey-hr mb-10"/></li>
        <li>
            <a class="<?php echo e(Request::path() == 'admin/subscriber' ? 'active' : ''); ?> href="javascript:void(0);" data-toggle="collapse" data-target="#subscriber_dr"><div class="pull-left"><i class="fa fa-bell-o mr-20"></i><span class="right-nav-text">Subscribers</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
            <ul id="subscriber_dr" class="collapse collapse-level-1 two-col-list">
                <li>
                    <a href="<?php echo e(route('subscrib')); ?>">View</a>
                </li> 
            </ul>
        </li>
        <li>
            <a class="<?php echo e(Request::path() == 'admin/newsletter' ? 'active' : ''); ?> href="javascript:void(0);" data-toggle="collapse" data-target="#newsletter_dr"><div class="pull-left"><i class="fa fa-newspaper-o mr-20"></i><span class="right-nav-text">Newsletter</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
            <ul id="newsletter_dr" class="collapse collapse-level-1 two-col-list">
                <li>
                    <a class="<?php echo e(Request::path() == 'admin/newsletter/create' ? 'active-page' : ''); ?>" href="<?php echo e(route('newsletter.create')); ?>">Add</a>
                </li>
                <li>
                    <a href="<?php echo e(route('newsletter.index')); ?>">View</a>
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
        <li>
            <a class="<?php echo e(Request::path() == 'admin/hotNews' ? 'active' : ''); ?>" href="<?php echo e(route('hotNews.index')); ?>" data-toggle="collapse" data-target="#hotNews_dr"><div class="pull-left"><i class="fa fa-check-square mr-20"></i><span class="right-nav-text">Hot News</span></div><div class="clearfix"></div></a>
        </li>
        
        <li><hr class="light-grey-hr mb-10"/></li>        
        <li>
            <a class="<?php echo e(Request::path() == 'admin/author' ? 'active' : ''); ?>" href="<?php echo e(route('author.index')); ?>" data-toggle="collapse" data-target="#author_dr"><div class="pull-left"><i class="fa fa-users mr-20"></i><span class="right-nav-text">Authors</span></div><div class="clearfix"></div></a>
        </li>

        <li>
            <a class="<?php echo e(Request::path() == 'admin/contributor' ? 'active' : ''); ?> href="javascript:void(0);" data-toggle="collapse" data-target="#contributor_dr"><div class="pull-left"><i class="fa fa-user mr-20"></i><span class="right-nav-text">Contributors</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
            <ul id="contributor_dr" class="collapse collapse-level-1 two-col-list">
                <li>
                    <a class="<?php echo e(Request::path() == 'admin/contributor/create' ? 'active-page' : ''); ?>" href="<?php echo e(route('contributor.create')); ?>">Add</a>
                </li>
                <li>
                    <a href="<?php echo e(route('contributor.index')); ?>">View</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="<?php echo e(Request::path() == 'admin/about' ? 'active' : ''); ?>" href="<?php echo e(route('about.index')); ?>" data-toggle="collapse" data-target="#about_dr"><div class="pull-left"><i class="fa fa-info-circle mr-20"></i><span class="right-nav-text">About</span></div><div class="clearfix"></div></a>
        </li>
        
        <li>
            <a class="<?php echo e(Request::path() == 'admin/contact' ? 'active' : ''); ?>" href="<?php echo e(route('contact.index')); ?>" data-toggle="collapse" data-target="#contact_dr"><div class="pull-left"><i class="fa fa-phone mr-20"></i><span class="right-nav-text">Contact</span></div><div class="clearfix"></div></a>
        </li>
        <li><hr class="light-grey-hr mb-10"/></li>
        <li>
            <a class="<?php echo e(Request::path() == 'admin/support' ? 'active' : ''); ?>" href="<?php echo e(route('support.index')); ?>" data-toggle="collapse" data-target="#support_dr"><div class="pull-left"><i class="fa fa-question-circle mr-20"></i><span class="right-nav-text">Support</span></div><div class="clearfix"></div></a>
        </li>
        <li><hr class="light-grey-hr mb-10"/></li>

    </ul>
</div><?php /**PATH C:\xampp\htdocs\fstv\resources\views/admin/section/left-sidebar.blade.php ENDPATH**/ ?>