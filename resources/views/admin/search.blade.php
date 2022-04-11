@extends('layouts.frontend')
@section('title')
    FSTV NEWS| Search Result
@endsection
@section('content')
     <!-- Main Breadcrumb Start -->
     <div class="main--breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{route('homepage')}}" class="btn-link"><i class="fa fm fa-home"></i>Home</a></li>
                <li class="active"><span>Search</span></li>
            </ul>
        </div>
    </div>
    <!-- Main Breadcrumb End -->

    <!-- Main Content Section Start -->
    <div class="main-content--section pbottom--30">
        <div class="container">
            <div class="row">
                <!-- Main Content Start -->
                <div class="main--content col-md-8 col-sm-7" data-sticky-content="true">
                    <div class="sticky-content-inner">

                        <!-- Post Items Start -->
                        <div class="post--items post--items-5 pd--30-0">
                            <ul class="nav">
                        <?php $count=1;?>
                        @foreach ($result as $item)
                            @if ($count%2 == 1)
                            @endif
                                <li>
                                    <!-- Post Item Start -->
                                    <div class="post--item post--title-larger">
                                        <div class="row">
                                            <div class="col-md-4 col-sm-12 col-xs-4 col-xxs-12">
                                                <div class="post--img">
                                                    <a href="{{asset('upload/post/'.$item->image)}}" class="thumb"><img src="{{asset('upload/post/'.$item->image)}}" alt=""></a>
                                                    {{-- <a href="" class="cat">{{$item->post_info->cat_info['title']}}</a> --}}
                                                </div>
                                            </div>

                                            <div class="col-md-8 col-sm-12 col-xs-8 col-xxs-12">
                                                <div class="post--info">
                                                    <ul class="nav meta">
                                                        <li><a href="#">{{$item->author_info['name']}}</a></li>
                                                        <li><a href="#">{{$item->created_at}}</a></li>
                                                    </ul>

                                                    <div class="title">
                                                        <h3 class="h4"><a href="{{route('post-detail', $item->id)}}" class="btn-link">{{$item->title}}</a></h3>
                                                    </div>
                                                </div>

                                                <div class="post--content">
                                                    <p>{{$item->subtitle}}</p>
                                                </div>

                                                <div class="post--action">
                                                    <a href="{{route('post-detail', $item->id)}}">Continue Reading...</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Post Item End -->
                                </li> 
                            @if ($count%2 == 0)
                            
                            @if (@$sidebar_lg_ads[1]->type == 'image')
                                <!-- Ad Widget Start -->
                                <div class="ad--widget" style="height:70px;">
                                    <a href="{{@$sidebar_lg_ads[1]->link}}">
                                        <img src="{{asset('upload/advertise/Thumb-lg-'.@$sidebar_lg_ads[1]->image)}}" alt="Ads 728x90">
                                    </a>
                                </div>
                                <!-- Ad Widget End -->                                                    
                                @else
                                <video width="100%" controls autoplay loop muted>
                                    <source src="{{ asset('upload/advertise/'.@$sidebar_lg_ads[1]->image) }}" height="100px" type="file">
                                    <source src="{{ asset('upload/advertise/'.@$sidebar_lg_ads[1]->image) }}" type="video/ogg">
                                    Your browser does not support the video tag.
                                </video>  
                            @endif                            
                            
                            @endif                                
                            <?php $count++; ?>
                            
                            @endforeach 
                           
                            </ul>
                        </div>
                       
                    </div>
                </div>
                <!-- Main Content End -->

                <!-- Main Sidebar Start -->
                <div class="main--sidebar col-md-4 col-sm-5 ptop--30 pbottom--30" data-sticky-content="true">
                    <div class="sticky-content-inner">
                        <!-- Widget Start -->
                        <div class="widget">
                            @if (@$sidebar_lg_ads[0]->type == 'image')
                                <!-- Ad Widget Start -->
                                <div class="ad--widget" style="height:70px;">
                                    <a href="{{@$sidebar_lg_ads[0]->link}}">
                                        <img src="{{asset('upload/advertise/Thumb-lg-'.@$sidebar_lg_ads[0]->image)}}" alt="Ads 728x90">
                                    </a>
                                </div>
                                <!-- Ad Widget End -->                                                    
                                @else
                                <video width="100%" controls autoplay loop muted>
                                    <source src="{{ asset('upload/advertise/'.@$sidebar_lg_ads[0]->image) }}" height="100px" type="file">
                                    <source src="{{ asset('upload/advertise/'.@$sidebar_lg_ads[0]->image) }}" type="video/ogg">
                                    Your browser does not support the video tag.
                                </video>  
                            @endif
                            
                        </div>
                        <!-- Widget End -->

                        <!-- Widget Start -->
                        <div class="widget">
                            <div class="widget--title">
                                <h2 class="h4">Catagory</h2>
                                <i class="icon fa fa-folder-open-o"></i>
                            </div>

                            <!-- Nav Widget Start -->
                            <div class="nav--widget">
                                <ul class="nav">
                                    @foreach ($cats as $item)
                                    <li><a href="{{route('cat-post', $item->id)}}"><span>{{$item->title}}</span><span>()</span></a></li>
                                        
                                    @endforeach
                                   
                                </ul>
                            </div>
                            <!-- Nav Widget End -->
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
                                            <a href="#" onClick="window.location.reload(true);" class="feature_post" >Top featured News</a>
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

                                                    <div class="post--info">
                                                        <ul class="nav meta">
                                                            <li><a href="#">{{$item->post_info->author_info['name']}}</a></li>
                                                            <li><a href="#">{{$item->created_at}}</a></li>
                                                        </ul>

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

                                                    <div class="post--info">
                                                        <ul class="nav meta">
                                                            <li><a href="#">{{$item->post_info->author_info['name']}}</a></li>
                                                            <li><a href="#">{{$item->created_at}}</a></li>
                                                        </ul>

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

                            @if (@$sidebar_lg_ads[1]->type == 'image')
                                <!-- Ad Widget Start -->
                                <div class="ad--widget" style="height:70px;">
                                    <a href="{{@$sidebar_lg_ads[1]->link}}">
                                        <img src="{{asset('upload/advertise/Thumb-lg-'.@$sidebar_lg_ads[1]->image)}}" alt="Ads 728x90">
                                    </a>
                                </div>
                                <!-- Ad Widget End -->                                                    
                                @else
                                <video width="100%" controls autoplay loop muted>
                                    <source src="{{ asset('upload/advertise/'.@$sidebar_lg_ads[1]->image) }}" height="100px" type="file">
                                    <source src="{{ asset('upload/advertise/'.@$sidebar_lg_ads[1]->image) }}" type="video/ogg">
                                    Your browser does not support the video tag.
                                </video>  
                            @endif
                            
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
    $(document).ready(function(){
        $(document).on("click","#hotnews_post",function(e){           
            $('#featured').hide();
            $('#hotnews').removeClass('hide');
            $('ul.nav li.active').removeClass('active');
            $(this).parent().addClass('active');
            e.preventDefault();
        });
       
    });
</script>
@endsection