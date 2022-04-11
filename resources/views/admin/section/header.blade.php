<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<meta name="description" content="Hound is a Dashboard & Admin Site Responsive Template by hencework." />
	<meta name="keywords" content="admin, admin dashboard, admin template, cms, crm, Hound Admin, Houndadmin, premium admin templates, responsive admin, sass, panel, software, ui, visualization, web app, application" />
	<meta name="author" content="hencework"/>
    
    
	<title>@yield('title')</title>

	<!-- Favicon -->
	<link rel="shortcut icon" href="">
	<link rel="icon" href="{{asset('plugins/logo.png')}}" type="image/x-icon">
	
	<!-- Morris Charts CSS -->
    <link href="{{asset('plugins/vendors/bower_components/morris.js/morris.css') }}" rel="stylesheet" type="text/css"/>
	
	<!-- Data table CSS -->
	<link href="{{asset('plugins/vendors/bower_components/datatables/media/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>
	
	<link href="{{asset('plugins/vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.css') }}" rel="stylesheet" type="text/css">
		
	<!-- Custom CSS -->
	<link href="{{ asset('plugins/dist/css/style.css') }}" rel="stylesheet" type="text/css">
  	<link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-tagsinput/1.3.6/jquery.tagsinput.min.css" rel="stylesheet">

	@yield('styles')
</head>

<body>
	<!-- Preloader -->
	<div class="preloader-it">
		<div class="la-anim-1"></div>
	</div>
	<!-- /Preloader -->