@extends('layouts.frontend')
@section('title')
   Videos
@endsection
@section('content')
    <!-- Main Breadcrumb Start -->
    <div class="main--breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{route('homepage')}}" class="btn-link"><i class="fa fm fa-home"></i>Home</a></li>
                <li class="active"><span><a href="{{route('cat_video', @$childcat_video[0]->menu_info['id'])}}"></a>{{@$childcat_video[0]->menu_info['title']}}</span></li>
                <li class="active"><span><a href="{{route('subcat_video', @$childcat_video[0]->submenu_info['id'])}}"></a>{{@$childcat_video[0]->submenu_info['title']}}</span></li>
                <li class="active"><span>{{@$childcat_video[0]->childmenu_info['title']}}</span></li>
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
                        @foreach ($childcat_video as $item)
                            @if ($count%3 == 1)
                            @endif
                                <li>
                                    <!-- Post Item Start -->
                                    <div class="post--item post--title-larger">
                                        <div class="row">
                                            <div class="col-md-4 col-sm-12 col-xs-4 col-xxs-12">
                                                <div class="post--img">
                                                    <div class="product" >
                                                        <?php if($item->video != ''){ ?>
                                                            {!! Embed::make(URL('upload/fstv/video/'.$item->video))->parseUrl()->setAttribute([
                                                            'width' => '100%',
                                                            'height' => 200,
                                                            'frameborder' => 0,
                                                            'allowfullscreen' => true
                                                            ])->getHtml() !!}
                                                        <?php }else{ ?>
                                                            {!! Embed::make($item->link)->parseUrl()->setAttribute([
                                                            'width' => '100%',
                                                            'height' => 200,
                                                            'frameborder' => 0,
                                                            'allowfullscreen' => true
                                                            ])->getHtml() !!}
                                                        <?php } ?>
                                                                                                                                    
                                                    </div>   
                                                </div>
                                            </div>

                                            <div class="col-md-8 col-sm-12 col-xs-8 col-xxs-12">
                                                <div class="post--info">
                                                    <p class="utctime">{{($item->created_at)}}</p>
                                                    <div class="title">
                                                        <h3 class="h4"><a href="{{route('video-detail', $item->id)}}" class="btn-link">{!! Illuminate\Support\Str::limit($item->title, 50) !!}</a></h3>
                                                        @foreach($item->tags as $tag)
                                                            <label class="label label-info">{{ $tag['name'] }}</label>
                                                        @endforeach
                                                    </div>
                                                </div>

                                                <div class="post--action">
                                                    <a href="{{route('video-detail', $item->id)}}">{{$item->subtitle}} ...</a>
                                                </div>
                                            </div>
                                        </div>
                                        <span><a href="{{route('childcat_video', $item->childmenu_info['id'])}}">{{$item->childmenu_info['title']}}</a> </span>

                                    </div>
                                    <!-- Post Item End -->
                                </li> 
                                <hr class="divider divider--25">                     

                            @if ($count%3 == 0)
                            
                                @if (@$content_lg_ads[0]->type == 'image')
                                    <!-- Advertisement Start -->
                                    <div class="ad--widget" id="adver"  ads_id="{{@$content_lg_ads[0]->id}}" style="height: 70px;" >
                                        <a href="{{@$content_lg_ads[0]->link}}" >
                                            <img src="{{asset('upload/advertise/Thumb-lg-'.@$content_lg_ads[0]->image)}}" width="100%" alt="Ads 728x90">
                                        </a>
                                    </div>
                                    <!-- Advertisement End -->                             
                                    @elseif(@$content_lg_ads[0]->type == 'video')
                                    <div class="ad--widget row">
                                        <div class="col-md-6" id="adver"  ads_id="{{@$content_lg_ads[0]->id}}" height="120px">
                                        <a href="{{@$content_lg_ads[0]->link}}" >
                                            <video width="100%" controls autoplay playsinline muted>
                                                <source height="120px" src="{{ asset('upload/advertise/'.@$item->image) }}" type="file">
                                                <source height="120px" src="{{ asset('upload/advertise/'.@$item->image) }}" type="video/ogg">
                                                Your browser does not support the video tag.
                                            </video>  
                                        </a>
                                        </div>
                                        <div class="col-md-6" id="adver"  ads_id="{{@$content_lg_ads[0]->id}}" height="120px">
                                            <a href="{{@$content_lg_ads[0]->link}}" >
                                            <video width="100%" controls autoplay playsinline muted>
                                                <source height="120px" src="{{ asset('upload/advertise/'.@$item->image) }}" type="file">
                                                <source height="120px" src="{{ asset('upload/advertise/'.@$item->image) }}" type="video/ogg">
                                                Your browser does not support the video tag.
                                            </video>  
                                        </a> 
                                        </div>
                                    </div> 
                                @endif
                                 
                                <hr class="divider divider--25">                     
                            @endif                                
                            <?php $count++; ?>
                            
                        @endforeach 
                            <!-- Pagination Start -->
                            <div class="pagination--wrapper clearfix bdtop--1 bd--color-2 ptop--60 pbottom--30">
                               {{$childcat_video->render()}}
                            </div>
                            <!-- Pagination End -->
                            </ul>
                        </div>
                       
                    </div>
                </div>
                <!-- Main Content End -->

                <!-- Main Sidebar Start -->
                <div class="main--sidebar col-md-4 col-sm-5 ptop--30 pbottom--30" data-sticky-content="true">
                    <div class="sticky-content-inner">
                        {{-- <!-- Widget Start -->
                        <div class="widget">
                            <!-- Search Widget Start -->
                            <div class="search--widget">
                                <form action="{{route('search')}}" method="get">
                                    @csrf
                                    <div class="input-group">
                                        <input type="search" name="search" placeholder="Search..." class="form-control" required>

                                        <div class="input-group-btn">
                                            <button type="submit" class="btn-link"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- Search Widget End -->
                        </div>
                        <!-- Widget End --> --}}

                        <!-- Widget Start -->
                        <div class="widget">
                            <div class="widget--title">
                                <h2 class="h4">More Videos Category</h2>
                                <i class="icon fa fa-folder-open-o"></i>
                            </div>

                            <!-- Nav Widget Start -->
                            <div class="nav--widget">
                                <ul class="nav">
                                    @foreach ($menu as $item)
                                    <li>
                                        <a href="{{route('cat_video', $item->id)}}"><span>{{$item->title}}</span><span>()</span></a>
                                        @if (!$item->isempty)
                                        <ul>
                                            @foreach ($item->submenu_info as $row)
                                                <li><a href="{{route('subcat_video', $row->id)}}">{{$row->title}}</a></li>
                                            @endforeach

                                        </ul>
                                            
                                        @endif
                                    </li>
                                        
                                    @endforeach
                                
                                </ul>
                            </div>
                            <!-- Nav Widget End -->
                        </div>
                        <!-- Widget End -->

                        <!-- Widget Start -->
                        <div class="widget">
                            <div class="widget--title">
                                <h2 class="h4">More Videos</h2>
                                <i class="icon fa fa-newspaper-o"></i>
                            </div>

                            <!-- List Widgets Start -->
                            <div class="list--widget list--widget-1">
                                <div class="list--widget-nav" data-ajax="tab">
                                    <ul class="nav nav-justified">
                                        <li class="">
                                            <a href="#" id="popular_video">Popular Videos</a>
                                        </li>
                                        <li class="active">
                                            <a href="#" id="featured_video" class="featured_video" >Featured Videos</a>
                                        </li>
                                        <li class="">
                                            <a href="#" id="trending_video" class="trending_video" >Trending Videos</a>
                                        </li>
                                    </ul>
                                </div>

                                <!-- Post Items Start -->
                                <div class="post--items post--items-3" id="featured">
                                    <ul class="nav" data-ajax-content="inner">
                                        @foreach (@$featured_video as $item)
                                        <li>
                                            <!-- Post Item Start -->
                                            <div class="post--item post--layout-3">
                                                <div class="post--img">
                                                    <div class="thumb">
                                                        <?php if($item->video_info['video'] != ''){ ?>
                                                            {!! Embed::make(URL('upload/fstv/video/'.$item->video_info['video']))->parseUrl()->setAttribute([
                                                            'width' => '100%',
                                                            'height' => 80,
                                                            'frameborder' => 0,
                                                            'allowfullscreen' => true
                                                            ])->getHtml() !!}
                                                        <?php }else{ ?>
                                                            {!! Embed::make($item->video_info['link'])->parseUrl()->setAttribute([
                                                            'width' => '100%',
                                                            'height' => 80,
                                                            'frameborder' => 0,
                                                            'allowfullscreen' => true
                                                            ])->getHtml() !!}
                                                        <?php } ?>
                                                    </div>

                                                    <div class="post--info">
                                                        <p class="utctime">{{($item->video_info['created_at'])}}</p>
                                                        <div class="title">
                                                            <h3 class="h4"><a href="{{route('video-detail', $item->video_info['id'])}}" class="btn-link">{{$item->video_info['title']}}</a></h3>
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
                                <div class="post--items post--items-3 hide" id="popular">
                                    <ul class="nav" data-ajax-content="inner">
                                        @foreach (@$popular_video as $item)
                                        <li>
                                            <!-- Post Item Start -->
                                            <div class="post--item post--layout-3">
                                                <div class="post--img">
                                                    <div class="thumb">
                                                        <?php if($item->video_info['video'] != ''){ ?>
                                                            {!! Embed::make(URL('upload/fstv/video/'.$item->video_info['video']))->parseUrl()->setAttribute([
                                                            'width' => '100%',
                                                            'height' => 80,
                                                            'frameborder' => 0,
                                                            'allowfullscreen' => true
                                                            ])->getHtml() !!}
                                                        <?php }else{ ?>
                                                            {!! Embed::make($item->video_info['link'])->parseUrl()->setAttribute([
                                                            'width' => '100%',
                                                            'height' => 80,
                                                            'frameborder' => 0,
                                                            'allowfullscreen' => true
                                                            ])->getHtml() !!}
                                                        <?php } ?>
                                                    </div>

                                                    <div class="post--info">
                                                        <p class="utctime">{{($item->video_info['created_at'])}}</p>
                                                        <div class="title">
                                                            <h3 class="h4"><a href="{{route('video-detail', $item->video_info['id'])}}" class="btn-link">{{$item->video_info['title']}}</a></h3>
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
                                <div class="post--items post--items-3 hide" id="trending">
                                    <ul class="nav" data-ajax-content="inner">
                                        @foreach (@$trending_video->take(4) as $item)
                                        <li>
                                            <!-- Post Item Start -->
                                            <div class="post--item post--layout-3">
                                                <div class="post--img">
                                                    <div class="thumb">
                                                        <?php if($item->video != ''){ ?>
                                                            {!! Embed::make(URL('upload/fstv/video/'.$item->video))->parseUrl()->setAttribute([
                                                            'width' => '100%',
                                                            'height' => 80,
                                                            'frameborder' => 0,
                                                            'allowfullscreen' => true
                                                            ])->getHtml() !!}
                                                        <?php }else{ ?>
                                                            {!! Embed::make($item->link)->parseUrl()->setAttribute([
                                                            'width' => '100%',
                                                            'height' => 80,
                                                            'frameborder' => 0,
                                                            'allowfullscreen' => true
                                                            ])->getHtml() !!}
                                                        <?php } ?>
                                                    </div>

                                                    <div class="post--info">
                                                        <p class="utctime">{{($item->created_at)}}</p>
                                                        <div class="title">
                                                            <h3 class="h4"><a href="{{route('video-detail', $item->id)}}" class="btn-link">{{$item->title}}</a></h3>
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

                            @if (@$sidebar_lg_ads[0]->type == 'image')
                                <!-- Advertisement Start -->
                                <div class="ad--widget" id="adver" ads_id="{{$sidebar_lg_ads[0]->id}}" style="height: 70px;" >
                                    <a href="{{$sidebar_lg_ads[0]->link}}">
                                        <img src="{{asset('upload/advertise/Thumb-lg-'.@$sidebar_lg_ads[0]->image)}}" alt="Ads 728x90">
                                    </a>
                                </div>
                                <!-- Advertisement End -->                             
                                @elseif(@$sidebar_lg_ads[0]->type == 'video')
                                <a href="{{$sidebar_lg_ads[0]->link}}" id="adver" ads_id="{{$sidebar_lg_ads[0]->id}}" >
                                    <video width="100%" height="120px" controls autoplay playsinline muted loop>
                                        <source src="{{ asset('upload/advertise/'.@$sidebar_lg_ads[0]->image) }}" height="100px" type="file">
                                        <source src="{{ asset('upload/advertise/'.@$sidebar_lg_ads[0]->image) }}" type="video/ogg">
                                        Your browser does not support the video tag.
                                    </video>  
                                </a>
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
        $(document).on("click","#popular_video",function(e){           
            $('#featured').addClass('hide');
            $('#trending').addClass('hide');
            $('#popular').removeClass('hide');
            $('ul.nav li.active').removeClass('active');
            $(this).parent().addClass('active');
            e.preventDefault();
        });
        $(document).on("click","#featured_video",function(e){           
            $('#popular').addClass('hide');
            $('#trending').addClass('hide');
            $('#featured').removeClass('hide');
            $('ul.nav li.active').removeClass('active');
            $(this).parent().addClass('active');
            e.preventDefault();
        });
        $(document).on("click","#trending_video",function(e){           
            $('#popular').addClass('hide');
            $('#featured').addClass('hide');
            $('#trending').removeClass('hide');
            $('ul.nav li.active').removeClass('active');
            $(this).parent().addClass('active');
            e.preventDefault();
        });
       
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
@endsection