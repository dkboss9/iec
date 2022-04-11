@extends('layouts.frontend')
@section('title')
  Blog Detail
@endsection
@section('content')

    <!-- Main Breadcrumb Start -->
    <div class="main--breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{route('homepage')}}" class="btn-link"><i class="fa fm fa-home"></i>Home</a></li>
                <li><a class="btn-link">Blog</a></li>
                <li class="active"><span>{{$blog->title}}</span></li>
            </ul>
        </div>
    </div>
    <!-- Main Breadcrumb End -->

    @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
    
    <!-- Main Content Section Start -->
    <div class="main-content--section pbottom--30">
        <div class="container">
            <div class="row">
                <!-- Main Content Start -->
                <div class="main--content col-md-8" data-sticky-content="true">
                    <div class="sticky-content-inner">
                        <!-- Post Item Start -->
                        <div class="post--item post--single post--title-largest pd--30-0">
                            <div class="post--img">
                                <a href="{{asset('upload/blog/'.$blog->image)}}" class="thumb"><img src="{{asset('upload/blog/Thumb-lg-'.$blog->image)}}" alt=""></a>
                                <a href="#" class="icon"><i class="fa fa-star-o"></i></a>                               
                            </div>

                            <div class="post--info">
                                <div class="title">
                                    <h2 class="h4">{{$blog->title}}</h2>
                                </div>
                            </div>

                            <div class="post--content">
                                <p>{!! html_entity_decode($blog->detail) !!}</p>
                            </div>
                        </div>
                        <!-- Post Item End -->
                
                        @foreach (@$content_lg_ads->random(1) as $item)
                            <!-- Advertisement Start -->
                            <div class="ad--widget" id="adver"  ads_id="{{$item->id}}" style="width: 100%; height:70px" >
                                <a href="{{$item->link}}" target="_blank" >
                                    <img src="{{asset('upload/advertise/Thumb-lg-'.@$item->image)}}" alt="Ads 728x90">
                                </a>
                            </div>
                            <hr class="divider">
                            <!-- Advertisement End -->                                 
                        @endforeach
                        
                        <hr class="divider divider--25">

                    </div>
                </div>
                <!-- Main Content End -->

            <!-- Main Sidebar Start -->
            <div class="main--sidebar col-md-4 col-sm-5 ptop--30 pbottom--30" data-sticky-content="true">
                <div class="sticky-content-inner">
                    <!-- Widget Start -->
                    <div class="widget">
                        @foreach ($sidebar_lg_ads->random(1) as $item)
                            <!-- Ad Widget Start -->
                            <a href="{{$item->link}}" id="adver"  ads_id="{{$item->id}}" target="_blank">
                                <video 
                                    style="display:block; margin: 0 auto;" 
                                    height="200px" width="100%" 
                                    src="{{ asset('upload/advertise/'.$item->image) }}" 
                                    playsinline controls autoplay muted loop>
                                </video>
                            </a>
                            <!-- Ad Widget End --> 
                        @endforeach   
                    </div>
                    <!-- Widget End -->


                    <!-- Widget Start -->
                    <div class="widget">
                        <div class="widget--title">
                            <h2 class="h4">Featured News</h2>
                            <i class="icon fa fa-newspaper-o"></i>
                        </div>

                        <!-- List Widgets Start -->
                        <div class="list--widget list--widget-1">
                            <div class="list--widget-nav" data-ajax="tab">
                                <ul class="nav nav-justified">
                                    <li class="">
                                        <a href="#" id="hotnews_post">Hot News</a>
                                    </li>
                                    <li class="active">
                                        <a href="#" id="featured_post" class="feature_post" >Top featured News</a>
                                    </li>
                                </ul>
                            </div>

                            <!-- Post Items Start -->
                            <div class="post--items post--items-3" id="featured">
                                <ul class="nav" data-ajax-content="inner">
                                    @foreach ($featured as $item)
                                    <li>
                                        <!-- Post Item Start -->
                                        <div class="post--item post--layout-3">
                                            <div class="post--img">
                                                <a href="" class="thumb"><img src="{{asset('upload/post/'.$item->post_info['image'])}}" alt=""></a>

                                                <p class="utctime">{{($item->created_at)}}</p>
                                                <div class="post--info">
                                                   
                                                    <div class="title">
                                                        <h3 class="h4"><a href="{{route('post-detail', $item->post_id)}}" class="btn-link">{{$item->post_info['title']}}</a></h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Post Item End -->
                                    </li>
                                        
                                    @endforeach
                                    
                                </ul>                               
                            </div>
                            <!-- Post Items End -->

                            <!-- Post Items Start -->
                            <div class="post--items post--items-3 hide" id="hotnews">
                                <ul class="nav" data-ajax-content="inner">
                                    @foreach ($hotnews as $item)
                                    <li>
                                        <!-- Post Item Start -->
                                        <div class="post--item post--layout-3">
                                            <div class="post--img">
                                                <a href="" class="thumb"><img src="{{asset('upload/post/'.$item->post_info['image'])}}" alt=""></a>
                                                <p class="utctime">{{($item->created_at)}}</p>

                                                <div class="post--info">
                                                    {{-- <ul class="nav meta">
                                                        <li><a href="#">{{$item->post_info->author_info['name']}}</a></li>
                                                        <li><a href="#">{{Timezone::convertToLocal($item->created_at)}}</a></li>
                                                    </ul> --}}

                                                    <div class="title">
                                                        <h3 class="h4"><a href="{{route('post-detail', $item->post_id)}}" class="btn-link">{{$item->post_info['title']}}</a></h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Post Item End -->
                                    </li>
                                        
                                    @endforeach
                                    
                                </ul>                               
                            </div>
                            <!-- Post Items End -->
                        </div>
                        <!-- List Widgets End -->
                    </div>
                    <!-- Widget End -->

                    <!-- Widget Start -->
                    <div class="widget">
                        <div class="widget--title">
                            <h2 class="h4">Advertisement</h2>
                            <i class="icon fa fa-bullhorn"></i>
                        </div>

                        @foreach ($sidebar_lg_ads->random(1) as $item)
                            <!-- Ad Widget Start -->
                            <a href="{{$item->link}}" id="adver"  ads_id="{{$item->id}}" target="_blank">
                                <video 
                                    style="display:block; margin: 0 auto;" 
                                    height="200px" width="100%" 
                                    src="{{ asset('upload/advertise/'.$item->image) }}" 
                                    playsinline controls autoplay muted loop>
                                </video>
                            </a>
                            <!-- Ad Widget End --> 
                        @endforeach
                    </div> 
                    <!-- Widget End -->
                </div>
            </div>
            <!-- Main Sidebar End -->
            </div>
        </div>
    </div>
    <!-- Main Content Section End -->
  
@endsection
@section('scripts')
<script>
    $("document").ready(function(){
        setTimeout(function(){
           $(".alert-info").remove();
        }, 5000 ); // 5 secs   
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
    $(document).ready(function(){
        $(document).on("click","#hotnews_post",function(e){           
            $('#featured').hide();
            $('#hotnews').removeClass('hide');
            $('ul.nav li.active').removeClass('active');
            $(this).parent().addClass('active');
            e.preventDefault();
        });
        $(document).on("click","#featured_post",function(e){           
            $('#hotnews').hide();
            $('#featured').show();
            $('ul.nav li.active').removeClass('active');
            $(this).parent().addClass('active');
            e.preventDefault();
        });
       
    });
</script>
@endsection
@section('scripts')
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
@endsection