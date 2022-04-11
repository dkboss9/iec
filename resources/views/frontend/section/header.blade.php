<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- ==== Document Title ==== -->
    <title>Fire Screen TV | Nepalese Community TV and News Portal Australia | Nepal </title>
    
    <!-- ==== Document Meta ==== -->
  
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
  
 	 @if (@$post)
	<meta property="og:image" content="{{asset('upload/post/'.@$post->image)}}" />
  	<meta property="og:title" content="{{ @$post->title }}"/>
	<meta property="og:description" content=" {{ strip_tags(html_entity_decode(@$post->detail)) }}"/>
    @elseif(@$video)
       
    <meta property="og:image" content="{{asset('upload/fstv/video/'.@$video->image)}}" />
    <meta property="og:title" content="{{ @$video->title }}"/>
	<meta property="og:description" content=" {{ strip_tags(html_entity_decode(@$video->detail)) }}"/>
    @endif
    <meta property="og:image:width" content="600" /> 
    <meta property="og:image:height" content="550" />

    <!-- ==== Favicons ==== -->
    <link rel="icon" href="{{asset('/plugins/logo.jpg')}}" type="image/png">

    <!-- ==== Google Font ==== -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700">

    <!-- ==== Font Awesome ==== -->
    <link rel="stylesheet" href="{{asset('frontend/css/font-awesome.min.css') }}">
    
    <!-- ==== Bootstrap Framework ==== -->
    <link rel="stylesheet" href="{{asset('frontend/css/bootstrap.min.css') }}">
    
    <!-- ==== Bar Rating Plugin ==== -->
    <link rel="stylesheet" href="{{asset('frontend/css/fontawesome-stars-o.min.css') }}">
    
    <!-- ==== Main Stylesheet ==== -->
    <link rel="stylesheet" href="{{asset('frontend/style.css') }}">
    
    <!-- ==== Responsive Stylesheet ==== -->
    <link rel="stylesheet" href="{{asset('frontend/css/responsive-style.css') }}">

    <!-- ==== Theme Color Stylesheet ==== -->
    <link rel="stylesheet" href="{{asset('frontend/css/colors/theme-color-1.css') }}" id="changeColorScheme">
    
    <!-- ==== Custom Stylesheet ==== -->
    <link rel="stylesheet" href="{{asset('frontend/css/custom.css') }}">
    <style type="text/css">
		/* Only Demo Purpose */
		.colorPanel {
			margin: 0px;
			padding: 5px;
			position: fixed;
			z-index: 100;
			min-width: 20px; 
			border-radius: 0 3px 3px 0; 
			background-color: #005594;
			top: 35%; 
			text-align: center
		} 
		.colorPanel ul {margin:0px;padding:0px;list-style: none;display:none} .colorPanel ul li {display: block;margin-top: 10px;} 
		.colorPanel ul a {display: block;margin: 0 auto;width: 20px;height: 20px;border: #fff 1px solid;} 
		.colorPanel a.cart, .colorPanel a.home-solid {border-bottom: 1px solid rgba(255,255,255,.3); margin-bottom: 6px; padding-bottom: 8px;display: block;} 
		.colorPanel a.home-solid i {display: block; margin: 12px auto 4px;} 
		.colorPanel a.home-solid {color: #fff; font-weight: bold; font-size: 9px; text-transform: uppercase} 
		#cpToggle{display:block;height:30px; margin:0 auto; width:28px; line-height:30px; background-size:cover;}
		.cp-custom{padding: 12px;}
		.cp-custom #cpToggle{background: none;}.cp-custom i{font-size: 15px;color:#fff;}
	</style>
    @yield('styles')

</head>
<body>

    {{-- <!-- Preloader Start -->
    <div id="preloader">
        <div class="preloader bg--color-1--b" data-preloader="1">
            <div class="preloader--inner"></div>
        </div>
    </div>
    <!-- Preloader End --> --}}
    {{-- <div id="color-switch" class="colorPanel cp-custom">
		<a class="home-solid" href="{{route('stripe')}}">
			<i class="fa fa-credit-card"></i>Stripe
		</a>
		<a class="home-solid" href="{{route('poli')}}">
			<i class="fa fa-money"></i>Polipay
		</a>
		
	</div>
     --}}
