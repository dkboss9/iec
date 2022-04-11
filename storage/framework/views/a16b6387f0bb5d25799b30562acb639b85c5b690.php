<?php echo $__env->make('frontend.section.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- Wrapper Start -->
    <div class="wrapper">
        <!-- Header Section Start -->
        <?php echo $__env->make('frontend.section.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- Header Section End -->

        <!-- Posts Filter Bar Start -->
        <?php echo $__env->make('frontend.section.filterbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- Posts Filter Bar End -->

        <!-- News Ticker Start -->
        <?php echo $__env->make('frontend.section.breakingnews', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- News Ticker End -->

        <!-- Main Content Section Start -->
        <?php echo $__env->yieldContent('content'); ?>
        <!-- Main Content Section End -->

        <!-- Footer Section Start -->
        <?php echo $__env->make('frontend.section.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- Footer Section End -->
    </div>
    <!-- Wrapper End -->

    <!-- Back To Top Button Start -->
    <div id="backToTop">
        <a href="#"><i class="fa fa-angle-double-up"></i></a>
    </div>
    <!-- Back To Top Button End -->

    <!-- ==== jQuery Library ==== -->
    <?php echo $__env->make('frontend.section.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldContent('scripts'); ?><?php /**PATH C:\xampp\htdocs\iec\resources\views/layouts/frontend.blade.php ENDPATH**/ ?>