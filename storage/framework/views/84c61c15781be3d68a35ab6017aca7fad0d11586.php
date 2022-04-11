<?php $__env->startSection('title'); ?>
    FSTV News
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="form-body">
    <div class="website-logo" >
        <a href="">
          
        </a>
    </div>
    <div class="row">
        <div class="img-holder">
            <div class="bg"></div>
            <div class="info-holder">
                 <img class="logo-size" src="<?php echo e(asset('plugins/logo.jpg')); ?>" style="border-block-color: white; border:solid white 2mm " alt="logo">
            </div>
        </div>
        <div class="form-holder">
            <div class="form-content">
                <div class="form-items">
                    <h3>Get more things done with </h3>
                    <p>Web-based Docs Service.</p>
                    <div class="page-links">
                        <a href="<?php echo e(route('login')); ?>" class="active">Login</a>
                        
                    </div>
                    <form method="POST" action="<?php echo e(route('login')); ?>">
                        <?php echo csrf_field(); ?>

                        <input class="form-control" type="text" name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email" autofocus placeholder="E-mail Address" required>
                        <input class="form-control" type="password" name="password" required autocomplete="current-password" placeholder="Password">
                        <input type="checkbox" id="chk1"><label for="chk1"><?php echo e(__('Remember Me')); ?></label>
                        <div class="form-button">
                            <button id="submit" type="submit" class="ibtn"><?php echo e(__('Login')); ?></button> 
                            
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\fstv\resources\views/auth/login.blade.php ENDPATH**/ ?>