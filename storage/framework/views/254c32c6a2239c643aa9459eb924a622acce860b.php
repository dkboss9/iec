<?php echo $__env->make('admin.section.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="wrapper theme-1-active pimary-color-red">
		<!-- Top Menu Items -->
		<?php echo $__env->make('admin.section.top-navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<!-- /Top Menu Items -->
		
		<!-- Left Sidebar Menu -->
		<?php echo $__env->make('admin.section.left-sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<!-- /Left Sidebar Menu -->
		
        <!-- Main Content -->
		<div class="page-wrapper">
			<?php echo $__env->yieldContent('content'); ?>
			
			<!-- Footer -->
			<?php echo $__env->make('admin.section.copyright', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			<!-- /Footer -->
			
		</div>
        <!-- /Main Content -->

    </div>
    <!-- /#wrapper -->
	
	<!-- JavaScript -->
	
	<?php echo $__env->make('admin.section.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<?php echo $__env->yieldContent('scripts'); ?>
	<?php /**PATH C:\xampp\htdocs\fstv\resources\views/layouts/admin.blade.php ENDPATH**/ ?>