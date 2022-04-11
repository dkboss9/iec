

<?php $__env->startSection('title','FSTV | Editor Profile'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
					
    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
          <h5 class="txt-dark">Editor Information</h5>
        </div>
    </div>
    <!-- /Title -->
    <?php if(Session::has('message')): ?>
        <div class="success success-info"><?php echo e(Session::get('message')); ?></div>
    <?php endif; ?> 
    
    <!-- Row -->
        <div class="row">
            <div class="col-lg-8 col-xs-12">
                <div class="panel panel-default card-view  pa-0">
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body  pa-0">
                            <div class="profile-box">
                               
                                <div class="profile-info text-center mt-30">
                                    
                                    <img src="<?php echo e(asset('/upload/users/'.auth()->user()->editor_info['image'])); ?>" style="max-width: 200px; max-height:300px;" alt="">                                        
                                   
                                
                                    	
                                <h5 class="block mt-10 mb-5 weight-500 capitalize-font"><?php echo e(request()->user()->name); ?></h5>
                                    <p class="block pb-20"><?php echo e(auth()->user()->email); ?></p>
                                </div>	
                                <div class="social-info">
                                    <div class="row">
                                        <div class="col-md-6">
                                        <label><strong>Name:</strong> </label> <?php echo e(auth()->user()->name); ?>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                        <label><strong>Country:</strong> </label> <?php echo e(auth()->user()->editor_info['country']); ?>

                                        </div>                                        
                                        
                                        <div class="col-md-6">
                                        <label><strong>City:</strong> </label> <?php echo e(auth()->user()->editor_info['city']); ?>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                        <label><strong>Address:</strong> </label> <?php echo e(auth()->user()->editor_info['address']); ?>

                                        </div>                                        
                                        
                                        <div class="col-md-6">
                                        <label><strong>Phone:</strong> </label> <?php echo e(auth()->user()->editor_info['phone']); ?>

                                        </div>
                                    </div>                                   
                                    <div class="row">
                                        <div class="col-md-6">
                                        <label><strong>Citizenship/Passport No:</strong> </label> <?php echo e(auth()->user()->editor_info['citizenship']); ?>

                                        </div>                                        
                                        
                                        <div class="col-md-6">
                                        <label><strong>Other ID:</strong> </label> <?php echo e(auth()->user()->editor_info['other_id']); ?>

                                        </div>
                                    </div>  
                        
                                    <div class="row">
                                        <div class="col-md-6">
                                        <label><strong>News Category Permitted:</strong> </label> <?php $__currentLoopData = $cat_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li><?php echo e($item->c); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>                                        
                                        
                                        <div class="col-md-6">
                                            <label><strong>Video Category Permitted:</strong> </label> <?php $__currentLoopData = $menu_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li><?php echo e($item->m); ?></li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div> 
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                        <label><strong>Description:</strong> </label> <?php echo e(auth()->user()->editor_info['detail']); ?>

                                        </div>            
                                    </div>
                                  
                                    <div class="row" style="margin-top: 20px;">
                                        <div class="col-md-12" style="text-align: center;">
                                    <button class="btn btn-success"><i class="fa fa-pencil"></i> <span class="btn-text"><a href="<?php echo e(route('profile-edit', auth()->user()->id)); ?>" style="color:#fff;">Edit profile</a> </span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- /Row -->
    
</div>
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.editor', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ausnepc/firescreen.ausnep.com/resources/views/editor/profile.blade.php ENDPATH**/ ?>