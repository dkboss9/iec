<!-- jQuery -->
<script src="{{asset('plugins/vendors/bower_components/jquery/dist/jquery.min.js') }}"></script>

<!-- Bootstrap Core JavaScript -->
<script src="{{asset('plugins/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

<!-- Data table JavaScript -->
<script src="{{asset('plugins/vendors/bower_components/datatables/media/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{asset('plugins/dist/js/dataTables-data.js')}}"></script>
<!-- Slimscroll JavaScript -->
<script src="{{asset('plugins/dist/js/jquery.slimscroll.js') }}"></script>

<!-- simpleWeather JavaScript -->
<script src="{{asset('plugins/vendors/bower_components/moment/min/moment.min.js') }}"></script>
<script src="{{asset('plugins/vendors/bower_components/simpleWeather/jquery.simpleWeather.min.js') }}"></script>
<script src="{{asset('plugins/dist/js/simpleweather-data.js') }}"></script>

<!-- Progressbar Animation JavaScript -->
<script src="{{asset('plugins/vendors/bower_components/waypoints/lib/jquery.waypoints.min.js') }}"></script>
<script src="{{asset('plugins/vendors/bower_components/jquery.counterup/jquery.counterup.min.js') }}"></script>

<!-- Fancy Dropdown JS -->
<script src="{{asset('plugins/dist/js/dropdown-bootstrap-extended.js') }}"></script>

<!-- Sparkline JavaScript -->
<script src="{{asset('plugins/vendors/jquery.sparkline/dist/jquery.sparkline.min.js') }}"></script>

<!-- Owl JavaScript -->
<script src="{{asset('plugins/vendors/bower_components/owl.carousel/dist/owl.carousel.min.js') }}"></script>

<!-- ChartJS JavaScript -->
<script src="{{asset('plugins/vendors/chart.js/Chart.min.js') }}"></script>
<script src="{{asset('plugins/vendors/bower_components/tinymce/tinymce.min.js')}}"></script>

<!-- Morris Charts JavaScript -->
<script src="{{asset('plugins/vendors/bower_components/raphael/raphael.min.js') }}"></script>
<script src="{{asset('plugins/vendors/bower_components/morris.js/morris.min.js') }}"></script>
<script src="{{asset('plugins/vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.js') }}"></script>

<!-- Switchery JavaScript -->
<script src="{{asset('plugins/vendors/bower_components/switchery/dist/switchery.min.js') }}"></script>

<!-- Init JavaScript -->
<script src="{{asset('plugins/dist/js/init.js') }}"></script>
{{-- <script src="{{asset('plugins/dist/js/dashboard-data.js') }}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-tagsinput/1.3.6/jquery.tagsinput.min.js"></script>
    
    <script>
        $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
    <script>
        $("document").ready(function(){
            setTimeout(function(){
               $("div.success-info").remove();
            }, 5000 ); // 5 secs    
        });
    </script>
    <script>
        $("document").ready(function(){
            setTimeout(function(){
               $("div.alert-info").remove();
            }, 5000 ); // 5 secs    
        });
    </script>
    
</body>

</html>