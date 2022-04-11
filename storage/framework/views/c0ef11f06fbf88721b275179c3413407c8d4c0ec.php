
<?php $__env->startSection('title'); ?>
 Our Contributors
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- Main Breadcrumb Start -->
    <div class="main--breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="<?php echo e(route('homepage')); ?>" class="btn-link"><i class="fa fm fa-home"></i>Home</a></li>
                <li class="active"><span>Contributors</span></li>
            </ul>
        </div>
    </div>
    <!-- Main Breadcrumb End -->

    <!-- Main Content Section Start -->
    <div class="main-content--section pbottom--30">
        <div class="container">
            <!-- Main Content Start -->
            <div class="main--content">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <!-- Page Title Start -->
                        <div class="page--title pd--30-0 text-center">
                            <h2 class="h2">Our Contributors</h2>

                            <div class="content">
                                
                            </div>

                        </div>
                        <!-- Page Title End -->
                    </div>
                </div>

                <!-- Contributor Items Start -->
                <div class="contributor--items ptop--30">
                    <ul class="nav row AdjustRow">
                        <?php $__currentLoopData = $contributor; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="col-md-3 col-xs-6 col-xxs-12 pbottom--30">
                            <!-- Contributor Item Start -->
                            <div class="contributor--item style--3">
                                <div class="img" height="250">
                                    <img src="<?php echo e(asset('upload/contributor/'.'Thumb-lg-'.$item->image)); ?>" height="250" alt="">
                                </div>

                                <div class="info bg--color-1 bd--color-1">
                                    <div class="name">
                                        <h3 class="h4"><?php echo e($item->name); ?></h3>
                                    </div>

                                    <div class="desc">
                                        <p><?php echo e($item->address); ?></p>
                                        <p><?php echo e($item->email); ?></p>
                                    </div>
                                    <div class="action">
                                        <a href="<?php echo e(route('contributor-detail', $item->id)); ?>" class="btn btn-default">Contributor Posts</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Contributor Item End -->
                        </li>
                            
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php echo e($contributor->links()); ?>

                    </ul>
                </div>
                <!-- Contributor Items End -->
            </div>
            <!-- Main Content End -->
        </div>
    </div>
    <!-- Main Content Section End -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ausnepc/firescreen.ausnep.com/resources/views/frontend/contributor.blade.php ENDPATH**/ ?>