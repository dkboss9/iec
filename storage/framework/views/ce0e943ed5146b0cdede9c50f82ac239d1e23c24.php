
<?php $__env->startSection('title'); ?>
    Payment
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- Main Breadcrumb Start -->
    <div class="main--breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="home-1.html" class="btn-link"><i class="fa fm fa-home"></i>Home</a></li>
                <li class="active"><span>Payment</span></li>
            </ul>
        </div>
    </div>
    <!-- Main Breadcrumb End -->

    

    <!-- Contact Section Start -->
    <div class="contact--section">
        <div class="container">
            <div class="row">
                <div class="col-9 ptop--30 pbottom--30">
                    <?php if(Session::has('message')): ?>
                        <div class="alert alert-info"><?php echo e(Session::get('message')); ?></div>
                    <?php endif; ?>
                    <!-- Comment Form Start -->
                    <div class="comment--form">
                        <div class="comment-respond">
                            <form role="form" action="<?php echo e(route('stripe-payment')); ?>" method="post" class="validation"
                                                     data-cc-on-file="false"
                                                    data-stripe-publishable-key="<?php echo e(env('STRIPE_KEY')); ?>"
                                                    id="payment-form">
                                <?php echo csrf_field(); ?>
                                <div class="row">
                                    <h3>Payment Through Stripe</h3>
                                    <div class="col-xs-6 col-xxs-12">
                                        <label>
                                            <span>Name *</span>
                                            <input type="text" name="name" id="name" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                            <?php $__errorArgs = ['name'];
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
                                        </label>

                                        <label>
                                            <span>Email Address *</span>
                                            <input type="email" name="email" id="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
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
                                        </label>
                                        <label class="col-sm-6 col-md-6">
                                            <span>Phone No. *</span>
                                            <input type="number" name="phone" id="phone" class="form-control <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" >                                           
                                            <?php $__errorArgs = ['phone'];
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
                                        </label>
                                        <label class="col-sm-6 col-md-6">
                                            <span>Amount *</span>
                                            <input class='form-control' size='4' type='number' name="amount" id="amount" step="0.01" required='true' min="0">
                                        </label>
                                    </div>
                                    <div class="col-xs-6 col-xxs-12">
                                        <label>
                                            <span>Name on Card *</span>
                                            <input class='form-control' size='4' type='text' required>
                                        </label>  
                                        <label>
                                            <span>Card Number *</span>
                                            <input autocomplete='off' class='form-control card-num' maxlength="16" size='20' type='text' required>
                                        </label>

                                        <label class="col-sm-3 col-md-3">
                                            <span>Expiration Year *</span>
                                            <input class='form-control card-expiry-year' maxlength="4" placeholder='YYYY' size='4'
                                                        type='text' required>
                                        </label>
                                        <label class="col-sm-3 col-md-3">
                                            <span>Month *</span>
                                            <input class='form-control card-expiry-month' maxlength="2" placeholder='MM' size='2'
                                                        type='text' required>
                                        </label>
                                        <label class="col-sm-6 col-md-6">
                                            <span>CVC *</span>
                                            <input autocomplete='off' class='form-control card-cvc' placeholder='e.g 415' size='4'
                                                        type='text' required>
                                        </label>
                                       
                                        
                                    </div>
                                    <div class='form-row row'>
                                        <div class='col-md-12 hide error form-group'>
                                            <div class='alert-danger alert'>Fix the errors before you begin.</div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-success btn-lg">Pay</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Comment Form End -->
                </div>

                
            </div>
        </div>
    </div>
    <!-- Contact Section End -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script>
    $("document").ready(function(){
        setTimeout(function(){
           $(".alert-info").remove();
        }, 2000 ); // 5 secs   
    });
</script>
<script>
$(document).on("click", "#adver", function(e){
    var ad_id = $(this).attr("ads_id");
    // alert(ad_id);
    $.ajax({
        method: "POST",
        url: "<?php echo e(route('ads_count')); ?>",
        data: { 
            ads_id: ad_id ,
            "_token": "<?php echo e(csrf_token()); ?>",
            }
    })
});
</script>
<script>
    $( "#amount" ).blur(function() {
        this.value = parseFloat(this.value).toFixed(2);
    });
</script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
  
<script type="text/javascript">
$(function() {
    var $form         = $(".validation");
  $('form.validation').bind('submit', function(e) {
    var $form         = $(".validation"),
        inputVal = ['input[type=email]', 'input[type=password]',
                         'input[type=text]', 'input[type=file]',
                         'textarea'].join(', '),
        $inputs       = $form.find('.required').find(inputVal),
        $errorStatus = $form.find('div.error'),
        valid         = true;
        $errorStatus.addClass('hide');
 
        $('.has-error').removeClass('has-error');
    $inputs.each(function(i, el) {
      var $input = $(el);
      if ($input.val() === '') {
        $input.parent().addClass('has-error');
        $errorStatus.removeClass('hide');
        e.preventDefault();
      }
    });
  
    if (!$form.data('cc-on-file')) {
      e.preventDefault();
      Stripe.setPublishableKey($form.data('stripe-publishable-key'));
      Stripe.createToken({
        number: $('.card-num').val(),
        cvc: $('.card-cvc').val(),
        exp_month: $('.card-expiry-month').val(),
        exp_year: $('.card-expiry-year').val()
      }, stripeHandleResponse);
    }
  
  });
  
  function stripeHandleResponse(status, response) {
        if (response.error) {
            $('.error')
                .removeClass('hide')
                .find('.alert')
                .text(response.error.message);
        } else {
            var token = response['id'];
            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
        }
    }
  
});
</script>
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ausnepc/firescreen.ausnep.com/resources/views/frontend/stripe-form.blade.php ENDPATH**/ ?>