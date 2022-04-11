<div class="news--ticker">
    <div class="container">
        <div class="title">
            <h2>Breaking News</h2>
            
        </div>

        <div class="news-updates--list" data-marquee="true">
            <ul class="nav">
                <?php $__currentLoopData = $breakingnews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <h2><a href="<?php echo e(route('post-detail', $item->id)); ?>"><?php echo e($item->title); ?>.</a></h2>
                    </li>                    
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                
            </ul>
        </div>
    </div>
</div><?php /**PATH /home/ausnepc/firescreen.ausnep.com/resources/views/frontend/section/breakingnews.blade.php ENDPATH**/ ?>