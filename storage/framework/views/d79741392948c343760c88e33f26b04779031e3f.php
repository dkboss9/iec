<!-- Header Topbar Start -->
<div class="playstore shown-xss hidden" id="playstore">
    <div class="container">
        <div class="float--left float--xs-none  text-xs-center">
            <button type="button" class="close modal-header" id="plays_colse" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <!-- Header Topbar Info Start -->
            <div class="playsapp">
                <div class="logowrap">
                    <a href=""><img src="<?php echo e(asset('plugins/slogo.png')); ?>" style="height:65px;"></a>
                   
                </div>
                <div class="link_sec text-xs-center">
                    <div class="col-xxs-6 pull-left">
                        <h4><strong>Firescreentv app</strong></h4>
                      <p>Try for free</p>
                        

                    </div>
                    <div class="col-xxs-6 pull-right">
                      <h4>
                                                <a href="https://u4h4r.app.link/firescreentv" class="btn btn-success">Install</a>

                      </h4>

                    </div>
                    
                    
                </div>
            </div>
            <!-- Header Topbar Info End -->
        </div>

    </div>
</div>
<!-- Header Topbar End -->

<header class="header--section header--style-1">   

    <!-- Header Mainbar Start -->
    <div class="header--mainbar">
        <div class="container">
            <!-- Header Logo Start -->
            <div class="header--logo float--left float--sm-none text-sm-center">
                <h1 class="h1">
                    <a href="<?php echo e(route('homepage')); ?>" class="btn-link">
                        <img src="<?php echo e(asset('plugins/logo1.png')); ?>" height="55" alt="FSTV LOGO"><span>  </span>
                        <span><a href="<?php echo e(route('homepage')); ?>" class="btn-link" style="text-decoration-color: white;"></a> </span>
                        <span class="hidden"> </span>
                    </a> 
                </h1>
            </div>
            
            <!-- Header Logo End -->

            <!-- Header Ad Start -->
            <div class="float--right float--xs-none">
                <!-- Header Topbar Action Start -->
                <ul class="header--topbar-action pull-right">
                    <a style="color: white;" href="<?php echo e(route('login')); ?>"><i class="fa fm fa-user-o"></i>Login</a>
                </ul>
                <!-- Header Topbar Action End -->               
            </div>
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
                    
                    
                                 
                   <?php $__empty_1 = true; $__currentLoopData = $cats->take(9); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php if(!$cat->child_cats->isEmpty()): ?>
                    <li class="dropdown megamenu">
                        <li class="dropdown">
                            <a href="<?php echo e(route('cat-post', $cat->id)); ?>" data-toggle="dropdown"><?php echo e($cat->title); ?><i class="fa flm fa-angle-down"></i></a>
                            <ul class="dropdown-menu">                                
                                <?php $__currentLoopData = $cat->child_cats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><a href="<?php echo e(route('childcat-post', $item->id)); ?>"><?php echo e($item->title); ?></a></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                        
                            </ul>
                        </li>                                
                    </li>
                    <?php else: ?>
                    <li><a href="<?php echo e(route('cat-post', $cat->id)); ?>"><?php echo e($cat->title); ?></a></li>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                    <?php endif; ?>
                    
                    

                    <li class="<?php echo e(Request::path() == '/fstv' ? 'active' : ''); ?>"><a href="<?php echo e(route('media')); ?>">FSTV TV</a></li>

                   
                </ul>
                <!-- Header Menu Links End -->
            </div>

           
        </div>
    </div>
    <!-- Header Navbar End -->
</header><?php /**PATH C:\xampp\htdocs\iec\resources\views/frontend/section/navbar.blade.php ENDPATH**/ ?>