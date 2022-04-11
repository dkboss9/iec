@include('frontend.section.header')
    <!-- Wrapper Start -->
    <div class="wrapper">
        <!-- Header Section Start -->
        @include('frontend.section.navbar')
        <!-- Header Section End -->

        <!-- Posts Filter Bar Start -->
        @include('frontend.section.filterbar')
        <!-- Posts Filter Bar End -->

        <!-- News Ticker Start -->
        @include('frontend.section.breakingnews')
        <!-- News Ticker End -->

        <!-- Main Content Section Start -->
        @yield('content')
        <!-- Main Content Section End -->

        <!-- Footer Section Start -->
        @include('frontend.section.footer')
        <!-- Footer Section End -->
    </div>
    <!-- Wrapper End -->

    <!-- Back To Top Button Start -->
    <div id="backToTop">
        <a href="#"><i class="fa fa-angle-double-up"></i></a>
    </div>
    <!-- Back To Top Button End -->

    <!-- ==== jQuery Library ==== -->
    @include('frontend.section.scripts')
    @yield('scripts')