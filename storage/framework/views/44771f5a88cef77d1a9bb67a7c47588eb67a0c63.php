<footer class="footer--section">
    <div class="modal fade" id="yourModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4  style="text-decoration-color: black;" id="myModalLabel">Payment Methods</h4>
            </div>
            <div class="modal-body">
                <ul class="header--topbar-social nav">
                    <li>
                        <a class="" href="<?php echo e(route('stripe')); ?>">
                            <i class="fa fa-credit-card"> </i> Stripe
                        </a>
                    </li>
                    <li>
                         <a class="" href="<?php echo e(route('poli')); ?>">
                             <i class="fa fa-money"> </i> Polipay
                         </a>
    
                    </li>

                </ul>
           
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
    </div>

    <!-- Footer Widgets Start -->
    <div class="footer--widgets bg--color-2">
        <div class="container">
            <div class="row AdjustRow">
                <div class="mainbar">
                    <div class="container">
                        <!-- Header Logo Start -->
                        <div class="header--topbar-action float--left float--sm-none text-sm-center">
                            <h1 class="h1">
                                <a href="<?php echo e(route('homepage')); ?>" class="btn-link">
                                    <img src="<?php echo e(asset('plugins/logo1.png')); ?>" height="100" alt="FSTV LOGO"><span></span>
                                    
                                    <span class="hidden"> </span>
                                </a> 
                            </h1>
                        </div>
                        <!-- Header Logo End -->
                        <div class="header--topbar float--right float--xs-none text-xs-center" style="background-color:#071d39">
                            <ul class="header--topbar-social nav" style="color: #fff;">
                                <li><a href="https://www.facebook.com/firescreentvchannel/"><i class="fa fa-facebook"></i></a></li>
                                
                                <li><a href="https://www.youtube.com/channel/UCJcnGgy2HdUaDP-TdvvafsA"><i class="fa fa-youtube-play"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-2 col-xs-6 col-xxs-12 ptop--30 pbottom--30">
                    <!-- Widget Start -->
                    <div class="widget">
                        <div class="widget--title">
                            <h2 class="h4">About Us</h2>

                            <i class="icon fa fa-exclamation"></i>
                        </div>

                        <!-- About Widget Start -->
                        <div class="about--widget">
                            <p><?php echo e(@$about->subtitle); ?>.</p>
                            <div class="content">
                            </div>

                            <div class="action">
                                <a href="<?php echo e(route('about-us')); ?>" class="btn-link">Read More<i class="fa flm fa-angle-double-right"></i></a>
                            </div>

                        
                        </div>
                        <!-- About Widget End -->
                    </div>
                    <!-- Widget End -->
                </div>

                <div class="col-md-2 col-xs-6 col-xxs-12 ptop--30 pbottom--30">
                    <!-- Widget Start -->
                    <div class="widget">
                        <div class="widget--title">
                            <h2 class="h4">Category</h2>

                            <i class="icon fa fa-expand"></i>
                        </div>

                        <!-- Links Widget Start -->
                        <div class="links--widget">
                            <?php if(!$cats->isempty()): ?>
                            <ul class="nav">
                                <?php $__currentLoopData = $cats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><a href="<?php echo e(route('cat-post',$item->id)); ?>" class="fa-angle-right"><?php echo e($item->title); ?></a></li>
                                    
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                               
                            </ul>                                        
                            <?php endif; ?>
                        </div>
                        <!-- Links Widget End -->
                    </div>
                    <!-- Widget End -->
                </div>

                <div class="col-md-2 col-xs-6 col-xxs-12 ptop--30 pbottom--30">
                    <!-- Widget Start -->
                    <div class="widget">
                        <div class="widget--title">
                            <h2 class="h4">Useful Links</h2>

                            <i class="icon fa fa-bullhorn"></i>
                        </div>

                        <!-- Links Widget Start -->
                        <div class="links--widget">
                            <ul class="nav">
                                <li><a href="<?php echo e(route('homepage')); ?>" class="fa-angle-right">Home</a></li>
                                <li><a href="<?php echo e(route('contact-us')); ?>" class="fa-angle-right">Contact Us</a></li>
                                <li><a href="<?php echo e(route('blog')); ?>" class="fa-angle-right">Blogs</a></li>
                                <li><a href="<?php echo e(route('gallery')); ?>" class="fa-angle-right">Gallery</a></li>
                                <li><a href="<?php echo e(route('popular')); ?>" class="fa-angle-right">Popular News</a></li>
                                <li><a href="" data-toggle="modal" data-target="#yourModal" class="fa-angle-right">Payments</a></li>
                                <li><a href="<?php echo e(route('terms')); ?>" class="fa-angle-right">Terms of Use</a></li>
                                <li><a href="<?php echo e(route('privacy')); ?>" class="fa-angle-right">Pivacy Policy</a></li>
                            </ul>
                        </div>
                        <!-- Links Widget End -->
                    </div>
                    <!-- Widget End -->
                </div>
               
               
                <div class="col-md-6 col-xs-6 col-xxs-12 ptop--30 pbottom--30">
                     <div class="row">
                         <div class="col-md-6">
                             <!-- Widget Start -->
                             <div class="widget">
                                 <div class="widget--title">
                                     <h2 class="h4">Subscribe Now</h2>
         
                                     <i class="icon fa fa-bell"></i>
                                 </div>
                                 <div class="content">
                                     <p>Subscribe to our newsletter to get  latest news, popular news and exclusive updates.</p><br>
                                 </div>
         
                                 <form action="<?php echo e(route('subscribe')); ?>" method="post" enctype="multipart/form-data">
                                     <?php echo csrf_field(); ?>
                                     <div class="input-group">
                                         
                                         <input type="hidden" id="subscribe_time" name="subscribe_time" readonly value=""/>
         
                                         <input type="email" name="email" id="email" placeholder="E-mail address" class="form-control" autocomplete="off" required>
                                             
         
                                         <div class="input-group-btn">					
                                             <button type="submit" class="btn btn-lg btn-default active"><i class="fa fa-paper-plane-o"></i> Subscribe</button>
                                         </div>
                                                                             
                                     </div> 
                                     <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                             <span class="invalid-feedback" role="alert">
                                                 <strong><?php echo e($message); ?></strong>
                                             </span>
                                         <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                     
                                 </form>
                             </div>
                             
                             <!-- Widget End -->
                         </div>
         
                         <div class="col-md-6">
                             
         
                             <!-- Widget Start -->
                             <div class="widget">
                                 <div class="widget--title">
                                     <h2 class="h4">Newsletter</h2>
                                     <i class="icon fa fa-envelope"></i>
                                 </div>
                                 <div class="content">
                                     <p>Sign up for free newsletters and get more FSTV delivered to your inbox</p><br>
                                 </div>
         
                                 <!-- Links Widget Start -->
                                 <div class="input-group-btn">
                                     <button type="button" class="btn btn-lg btn-default active " data-toggle="modal" data-target="#signupModel" data-whatever="@mdo">SignUp now<i class="fa fa-paper-plane-o"></i></button>
                                     
                                 </div>
                                 <!-- Links Widget End -->
         
                                 <div class="modal fade" id="signupModel" tabindex="-1" role="dialog" aria-labelledby="signupModelLabel">
                                     <div class="modal-dialog" role="document">
                                         <div class="modal-content">
                                             <div class="modal-header">
                                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                 <h5 class="modal-title" id="signupModelLabel" style="color: black">Sign up For Newsletter</h5>
                                             </div>
                                             <div class="modal-body">
                                                 <form action="<?php echo e(route('newssignup.store')); ?>" role="form" method="post" enctype="multipart/form-data">
                                                     <?php echo csrf_field(); ?>
                                                     <div class="form-group">
                                                         <label for="full_name" class="control-label mb-10" style="color: black">Full Name:</label>
                                                         <input type="text" class="form-control" style="border-color:#071d39;" required name="full_name" id="full_name">
                                                     </div>
                                                     <div class="form-group">
                                                         <label for="email" class="control-label mb-10" style="color: black">Email Address:</label>
                                                         <input type="email" class="form-control" style="border-color:#071d39" required name="email" id="email">
                                                     </div>                                                                                               
                                                 </div>
                                                 <div class="modal-footer">
                                                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                     <button type="submit" class="btn btn-primary">Sign Up</button>
                                                 </form>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                                 
                             </div>
                             <!-- Widget End -->
                         </div>
                     </div>
                  <br><br>
                        <div class="row" style="margin-inline: 6%;">
                            <p class="content" style="text-decoration-color: white; margin-top=25px; margin-left=10px;"> Download the FirescreenTv app</p>
                        
                        <div class="widget">
                            <div class="content">
                                <a href="https://apps.apple.com/us/app/firescreen-tv/id1559422281"><img src="<?php echo e(asset('plugins/IOS.png')); ?>" style="height:60px; width:150px; margin-left: -8px;"></a>
                              <a href="https://play.google.com/store/apps/details?id=com.fstv"><img src="<?php echo e(asset('plugins/Android.png')); ?>" style="height:60px; width:150px;"></a>                          
                          </div>
                        </div>
                            
                    </div>
                  
                </div> 

            </div>
        </div>
    </div>
    <!-- Footer Widgets End -->

    <!-- Footer Copyright Start -->
    <div class="footer--copyright bg--color-3">

        <div class="container">
            <p class="text float--left" style="color: white">&copy; 2020 <a href="#" style="color: black"><strong>FSTV NEWS</strong></a>. All Rights Reserved.</p>

            
        </div>
    </div>
    <!-- Footer Copyright End -->
</footer>
<script src="<?php echo e(asset('frontend/js/jquery-3.2.1.min.js')); ?>"></script>

<script>
    $(document).ready(function(){
        if($('#subscribe_time').val() ==""){
            var today = new Date();
            var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+(today.getDate() < 10 ? "0" : "") + today.getDate();
            var today = new Date();
            var time = (today.getHours() < 10 ? "0" : "") + today.getHours() + ":" + (today.getMinutes() < 10 ? "0" : "") + today.getMinutes() + ":" + (today.getSeconds() < 10 ? "0" : "") + today.getSeconds();;
            $('#subscribe_time').val(date + ' ' + time);
        }
    });
</script><?php /**PATH /home/ausnepc/firescreen.ausnep.com/resources/views/frontend/section/footer.blade.php ENDPATH**/ ?>