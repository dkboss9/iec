@include('admin.section.header')
    <div class="wrapper theme-1-active pimary-color-red">
		<!-- Top Menu Items -->
		@include('admin.section.top-navbar')
		<!-- /Top Menu Items -->
		
		<!-- Left Sidebar Menu -->
		@include('admin.section.left-sidebar')
		<!-- /Left Sidebar Menu -->
		
        <!-- Main Content -->
		<div class="page-wrapper">
			@yield('content')
			
			<!-- Footer -->
			@include('admin.section.copyright')
			<!-- /Footer -->
			
		</div>
        <!-- /Main Content -->

    </div>
    <!-- /#wrapper -->
	
	<!-- JavaScript -->
	
	@include('admin.section.footer')
	@yield('scripts')
	