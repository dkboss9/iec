<?php echo $__env->make('layouts.section.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldContent('content'); ?>
<?php echo $__env->make('layouts.section.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->yieldContent('scripts'); ?><?php /**PATH /home/ausnepc/firescreen.ausnep.com/resources/views/layouts/master.blade.php ENDPATH**/ ?>