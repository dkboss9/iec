@extends('layouts.frontend')
@section('title')
    Payment
@endsection
@section('content')
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

    {{-- <!-- Map Start -->
    <div class="map--fluid mtop--30" data-trigger="map" data-map-latitude="23.790546" data-map-longitude="90.375583" data-map-zoom="16" data-map-marker="[[23.790546, 90.375583]]"></div>
    <!-- Map End --> --}}

    <!-- Contact Section Start -->
    <div class="contact--section">
        <div class="container">
            <div class="row">
                <div class="col-9 ptop--30 pbottom--30">
                    @if (Session::has('message'))
                        <div class="alert alert-info">{{ Session::get('message') }}</div>
                    @endif
                    <!-- Comment Form Start -->
                    <div class="comment--form">
                        <div class="comment-respond">
                            <form role="form" action="{{route('stripe-payment')}}" method="post" class="validation"
                                                     data-cc-on-file="false"
                                                    data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                                                    id="payment-form">
                                @csrf
                                <div class="row">
                                    <h3>Payment Through Stripe</h3>
                                    <div class="col-xs-6 col-xxs-12">
                                        <label>
                                            <span>Name *</span>
                                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" required>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror 
                                        </label>

                                        <label>
                                            <span>Email Address *</span>
                                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" required>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror 
                                        </label>
                                        <label class="col-sm-6 col-md-6">
                                            <span>Phone No. *</span>
                                            <input type="number" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" >                                           
                                            @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror 
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
@endsection
@section('scripts')
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
        url: "{{ route('ads_count') }}",
        data: { 
            ads_id: ad_id ,
            "_token": "{{ csrf_token() }}",
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
    
@endsection