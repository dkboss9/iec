<script src="<?php echo e(asset('frontend/js/jquery-3.2.1.min.js')); ?>"></script>

<!-- ==== Bootstrap Framework ==== -->
<script src="<?php echo e(asset('frontend/js/bootstrap.min.js')); ?>"></script>

<!-- ==== StickyJS Plugin ==== -->
<script src="<?php echo e(asset('frontend/js/jquery.sticky.min.js')); ?>"></script>

<!-- ==== HoverIntent Plugin ==== -->
<script src="<?php echo e(asset('frontend/js/jquery.hoverIntent.min.js')); ?>"></script>

<!-- ==== Marquee Plugin ==== -->
<script src="<?php echo e(asset('frontend/js/jquery.marquee.min.js')); ?>"></script>

<!-- ==== Validation Plugin ==== -->
<script src="<?php echo e(asset('frontend/js/jquery.validate.min.js')); ?>"></script>

<!-- ==== Isotope Plugin ==== -->
<script src="<?php echo e(asset('frontend/js/isotope.min.js')); ?>"></script>

<!-- ==== Resize Sensor Plugin ==== -->
<script src="<?php echo e(asset('frontend/js/resizesensor.min.js')); ?>"></script>

<!-- ==== Sticky Sidebar Plugin ==== -->
<script src="<?php echo e(asset('frontend/js/theia-sticky-sidebar.min.js')); ?>"></script>

<!-- ==== Zoom Plugin ==== -->
<script src="<?php echo e(asset('frontend/js/jquery.zoom.min.js')); ?>"></script>

<!-- ==== Bar Rating Plugin ==== -->
<script src="<?php echo e(asset('frontend/js/jquery.barrating.min.js')); ?>"></script>

<!-- ==== Countdown Plugin ==== -->
<script src="<?php echo e(asset('frontend/js/jquery.countdown.min.js')); ?>"></script>

<!-- ==== RetinaJS Plugin ==== -->
<script src="<?php echo e(asset('frontend/js/retina.min.js')); ?>"></script>

<!-- ==== Google Map API ==== -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBK9f7sXWmqQ1E-ufRXV3VpXOn_ifKsDuc"></script>

<!-- ==== Main JavaScript ==== -->
<script src="<?php echo e(asset('frontend/js/main.js')); ?>"></script>

<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="<?php echo e(asset('js/share.js')); ?>"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
<script type="text/javascript">
    var utcdate = document.getElementsByClassName("utctime");
    var items = Array.from(utcdate, el => el.innerText);
    items.forEach(function (element, index) {
        var b = moment.utc(element).toDate();
        var c = moment(b).format('YYYY-MM-DD h:mm a');
        // alert(c);
        document.getElementsByClassName("utctime")[index].innerText = c ;
               
    });

    // var content = document.getElementsById('utctime').innerHTML;
    // var b = moment.utc(content).toDate();
    // var c = moment(b).format('YYYY-MM-DD h:m:s a');

    // document.getElementById("utctime").innerHTML = c;       
</script>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5e9ac7fc12fb89fd"></script>

<script>
    $("document").ready(function(){
        setTimeout(function(){
           $("div.alert-info").remove();
        }, 5000 ); // 5 secs    
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
$(window).resize(function(){
 If($(window).width()<600){
  $('div.playstore').removeClass('hidden');
 }
});
</script>
<script>
$(window).ready(function(){
    $("#plays_colse").click(function(){
        $(this).parent().addClass('hidden');
    });
})
</script>

</body>
</html>
<?php /**PATH /home/ausnepc/firescreen.ausnep.com/resources/views/frontend/section/scripts.blade.php ENDPATH**/ ?>