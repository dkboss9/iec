

<?php $__env->startSection('title','Admin Profile'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
					
    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
          <h5 class="txt-dark">Admin Information</h5>
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
                                    
                                    <img src="<?php echo e(asset('/upload/users/'.auth()->user()->user_info['image'])); ?>" style="max-width: 200px; max-height:300px;" alt="">                                        
                                   
                                
                                    	
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
                                        <label><strong>Address:</strong> </label> <?php echo e(auth()->user()->user_info['address']); ?>

                                        </div>                                        
                                        
                                        <div class="col-md-6">
                                        <label><strong>Phone:</strong> </label> <?php echo e(auth()->user()->user_info['phone']); ?>

                                        </div>
                                    </div>                                   
                        
                                    <div class="row">
                                        <div class="col-md-6">
                                        <label><strong>Description:</strong> </label> <?php echo e(auth()->user()->user_info['detail']); ?>

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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ausnepc/firescreen.ausnep.com/resources/views/admin/profile.blade.php ENDPATH**/ ?>