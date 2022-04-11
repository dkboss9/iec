<header class="header--section header--style-1">
    <!-- Header Topbar Start -->
    <div class="header--topbar bg--color-2">
        <div class="container">
            <div class="float--left float--xs-none text-xs-center">
                <!-- Header Topbar Info Start -->
                <ul class="header--topbar-info nav">
                    <li><i class="fa fm fa-phone"></i><?php echo e(@$contact->phone); ?></li>
                    <li><i class="fa fm fa-envelope"></i><?php echo e(@$contact->email); ?></li>
                </ul>
                <!-- Header Topbar Info End -->                    
            </div>

            <div class="float--right float--xs-none text-xs-center">
                <!-- Header Topbar Action Start -->
                <ul class="header--topbar-action nav">
                    <li><a style="color: black" href="<?php echo e(route('login')); ?>"><i class="fa fm fa-user-o"></i>Login</a></li>
                </ul>
                <!-- Header Topbar Action End -->               
            </div>
        </div>
    </div>
    <!-- Header Topbar End -->

    <!-- Header Mainbar Start -->
    <div class="header--mainbar">
        <div class="container">
            <!-- Header Logo Start -->
            <div class="header--logo float--left float--sm-none text-sm-center">
                <h1 class="h1">
                    <a href="<?php echo e(route('homepage')); ?>" class="btn-link">
                        <img src="<?php echo e(asset('upload/about/'.@$about->image)); ?>" height="55" alt="FSTV LOGO"><span>  </span>
                        <span><a href="<?php echo e(route('homepage')); ?>" class="btn-link" style="text-decoration-color: white;">Fire Screen TV</a> </span>
                        <span class="hidden"> </span>
                    </a> 
                </h1>
            </div>
            <!-- Header Logo End -->

            <!-- Header Ad Start -->
            
            <!-- Header Ad End -->
        </div>
    </div>
    <!-- Header Mainbar End -->

    <!-- Header Navbar Start -->
    <div class="header--navbar style--1 navbar bd--color-1 bg--color-1" data-trigger="sticky">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#headerNav" aria-expanded="false" aria-controls="headerNav">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <div id="headerNav" class="navbar-collapse collapse float--left">
                <!-- Header Menu Links Start -->
                <ul class="header--menu-links nav navbar-nav" data-trigger="hoverIntent">
                    <li class="<?php echo e(Request::path() == '/' ? 'active' : ''); ?>"><a href="<?php echo e(route('homepage')); ?>">Home</a></li>
                    
                    
                                 
                    <li class="dropdown megamenu">
                        <?php $__currentLoopData = $cats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="dropdown">
                                <a href="<?php echo e(route('cat-post', $cat->id)); ?>" data-toggle="dropdown"><?php echo e($cat->title); ?><i class="fa flm fa-angle-down"></i></a>
                                <ul class="dropdown-menu">                                
                                    <?php $__currentLoopData = $cat->child_cats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><a href="<?php echo e(route('childcat-post', $item->id)); ?>"><?php echo e($item->title); ?></a></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                        
                                </ul>
                            </li>                                
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </li>
                    
                    

                    <li class="<?php echo e(Request::path() == '/fstv' ? 'active' : ''); ?>"><a href="<?php echo e(route('media')); ?>">FSTV TV</a></li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pages<i class="fa flm fa-angle-down"></i></a>

                        <ul class="dropdown-menu">                            
                            <li><a href="<?php echo e(route('blog')); ?>">Blog</a></li>
                            <li><a href="<?php echo e(route('about-us')); ?>">About</a></li>
                            <li><a href="<?php echo e(route('contact-us')); ?>">Contact</a></li>
                            <li><a href="<?php echo e(route('contributors')); ?>">Contributors</a></li>
                        </ul>
                    </li>
                </ul>
                <!-- Header Menu Links End -->
            </div>

            <!-- Header Search Form Start -->
            <form action="#" class="header--search-form float--right" data-form="validate">
                <input type="search" name="search" placeholder="Search..." class="header--search-control form-control" required>

                <button type="submit" class="header--search-btn btn"><i class="header--search-icon fa fa-search"></i></button>
            </form>
            <!-- Header Search Form End -->
        </div>
    </div>
    <!-- Header Navbar End -->
</header><?php /**PATH C:\xampp\htdocs\fstv\resources\views/frontend/section/navbar.blade.php ENDPATH**/ ?>