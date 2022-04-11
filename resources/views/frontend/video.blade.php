@extends('layouts.frontend')
@section('title')
    Homepage
@endsection
@section('content')


<!-- Main Content Section Start -->
<div class="main-content--section pbottom--30">
    <div class="container">

        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        <div class="row">
            <!-- Main Content Start -->
            <div class="main--content col-md-8 col-sm-7" data-sticky-content="true">
                <div class="sticky-content-inner">
                    <div class="row">

                        @if (!$trending_video->isempty())
                        <div class="col-md-12 ptop--30 pbottom--30">                                                            
                            <div class="widget--title">
                                <h2 class="h4">Trending Videos</h2>
                            </div>
                            <!-- Post Items Start -->
                            <div class="post--items post--items-1" data-ajax-content="outer">
                                <ul class="nav row gutter--15" data-ajax-content="inner">
                                    @foreach ($trending_video->take(4) as $item)
                                        @if ($loop->first)
                                        <li class="col-md-12">
                                            <!-- Post Item Start -->
                                            <div class="post--item post--layout-1 post--title-large">
                                                <div class="post--img">
                                                    <div class="product" >
                                                        <?php if($item->video != ''){ ?>
                                                            <video style="display:block; margin: 0 auto;" height="350" 
                                                                poster="{{asset('upload/fstv/video/'.$item->image)}}" 
                                                                src="{{asset('upload/fstv/video/'.$item->video)}}" 
                                                                playsinline controls>
                                                            </video>
                                                            {{-- <video src="{{asset('upload/fstv/video/'.$item->video)}}" playsinline autoplay controls></video> --}}
                                                        <?php }else{ ?>
                                                            {!! Embed::make($item->link)->parseUrl()->setAttribute([
                                                            'width' => '100%',
                                                            'height' => 350,
                                                            'frameborder' => 0,
                                                            'allowfullscreen' => true
                                                            ])->getHtml() !!}
                                                        <?php } ?>
                                                        {{-- <div class="thumb" >
                                                            <iframe src="{{asset('upload/fstv/video/'.$item->video)}}" width="100%" height="400" frameborder="0"></iframe>
                                                        </div> --}}
                                                                {{-- <p class="utctime">{{($item->created_at)}}</p> --}}
                                                        <div class="title">
                                                            <h3 class="h5"><a href="{{route('video-detail',$item->id)}}" class="btn-link">{!! Illuminate\Support\Str::limit($item->title, 50) !!}</a></h3>
                                                            <p>{!! Illuminate\Support\Str::limit(html_entity_decode($item->detail), 80) !!}</p>
                                                        </div>                                                                               
                                                    </div>                                                    
                                                </div>
                                            </div>
                                            <!-- Post Item End -->
                                            <hr class="divider">
                                        </li>
                                        @else
                                        <li class="col-md-4 col-xs-6 col-xxs-12">
                                            <!-- Post Item Start -->
                                            <div class="post--item post--layout-1">
                                                <div class="post--img">
                                                    <div class="product">
                                                        <?php if($item->video != ''){ ?>
                                                            <video style="display:block; margin: 0 auto;" height="150" width="100%" 
                                                                poster="{{asset('upload/fstv/video/'.$item->image)}}" 
                                                                src="{{asset('upload/fstv/video/'.$item->video)}}" 
                                                                playsinline controls>
                                                            </video>
                                                        <?php }else{ ?>
                                                            {!! Embed::make($item->link)->parseUrl()->setAttribute([
                                                            'width' => '100%',
                                                            'height' => 150,
                                                            'frameborder' => 0,
                                                            'allowfullscreen' => true
                                                            ])->getHtml() !!}
                                                        <?php } ?>
                                                        <div class="title">
                                                            <h3 class="h5"><a href="{{route('video-detail',$item->id)}}" class="btn-link">{!! Illuminate\Support\Str::limit($item->title, 50) !!}</a></h3>
                                                            <p>{!! Illuminate\Support\Str::limit(html_entity_decode($item->detail), 50) !!}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Post Item End -->
                                        </li>
                                            
                                        @endif
                                    @endforeach
                                </ul>                                
                            </div>
                            <!-- Post Items End -->                                
                        </div>
                        @endif   
                        
                    </div>
                    
                    <div class="row">
                        
                        <!-- Ad Start -->
                        <div class="col-md-12 ptop--30 pbottom--30">
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
                        </div>
                        <!-- Ad End -->

                        @if(!$featured_video->isempty() )                     
                        <div class="col-md-12 ptop--30 pbottom--30">
                            <!-- Post Items Title Start -->
                            <div class="post--items-title" data-ajax="tab">
                                <h2 class="h4">Featured Videos</h2>

                                <div class="nav">
                                    <a href="{{route('video-featured')}}" class="prev btn-link">
                                        <p>More</p>
                                    </a>
                                </div>
                            </div>
                            <!-- Post Items Title End -->

                            <!-- Post Items Start -->
                            <div class="post--items" data-ajax-content="outer">
                                <ul class="nav row gutter--15" data-ajax-content="inner">
                                    @foreach ($featured_video->take(3) as $item)
                                        <li class="col-md-4 col-xs-6 col-xxs-12">
                                            <!-- Post Item Start -->
                                            <div class="post--item post--layout-1">
                                                <div class="post--img">
                                                    <div class="product">
                                                        <?php if($item->video_info['video'] != ''){ ?>
                                                            <video style="display:block; margin: 0 auto;" height="150" 
                                                                poster="{{asset('upload/fstv/video/'.$item->image)}}" 
                                                                src="{{asset('upload/fstv/video/'.$item->video)}}" 
                                                                playsinline controls>
                                                            </video>
                                                        <?php }elseif($item->video_info['link'] != ''){ ?>
                                                            {!! Embed::make($item->video_info['link'])->parseUrl()->setAttribute([
                                                            'width' => '100%',
                                                            'height' => 150,
                                                            'frameborder' => 0,
                                                            'allowfullscreen' => true
                                                            ])->getHtml() !!}
                                                        <?php } ?>
                                                        <div class="title">
                                                            <h3 class="h5"><a href="{{route('video-detail',$item->video_info['id'])}}" class="btn-link">{!! Illuminate\Support\Str::limit($item->video_info['title'], 50) !!}</a></h3>
                                                            <p>{!! Illuminate\Support\Str::limit(html_entity_decode($item->video_info['detail']), 50) !!}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Post Item End -->
                                        </li>
                                       
                                        <li class="col-xs-12 hidden shown-xxs">
                                            <!-- Divider Start -->
                                            <hr class="divider">
                                            <!-- Divider End -->
                                        </li>                                        
                                    @endforeach                                   
                                </ul>                                
                            </div>
                            <!-- Post Items End -->
                        </div>                            
                        @endif

                        @if(!$popular_video->isempty() )                     
                        <div class="col-md-12 ptop--30 pbottom--30">
                            <!-- Post Items Title Start -->
                            <div class="post--items-title" data-ajax="tab">
                                <h2 class="h4">Popular Videos</h2>

                                <div class="nav">
                                    <a href="{{route('video-popular')}}" class="prev btn-link">
                                        <p>More</p>
                                    </a>
                                </div>
                            </div>
                            <!-- Post Items Title End -->

                            <!-- Post Items Start -->
                            <div class="post--items" data-ajax-content="outer">
                                <ul class="nav row gutter--15" data-ajax-content="inner">
                                    @foreach ($popular_video->take(3) as $item)
                                        <li class="col-md-4 col-xs-6 col-xxs-12">
                                            <!-- Post Item Start -->
                                            <div class="post--item post--layout-1">
                                                <div class="post--img">
                                                    <div class="product">
                                                        <?php if($item->video_info['video'] != ''){ ?>
                                                            <video style="display:block; margin: 0 auto;" height="150" 
                                                                poster="{{asset('upload/fstv/video/'.$item->image)}}" 
                                                                src="{{asset('upload/fstv/video/'.$item->video)}}" 
                                                                playsinline controls>
                                                            </video>
                                                        <?php }elseif($item->video_info['link'] != ''){ ?>
                                                            {!! Embed::make($item->video_info['link'])->parseUrl()->setAttribute([
                                                            'width' => '100%',
                                                            'height' => 150,
                                                            'frameborder' => 0,
                                                            'allowfullscreen' => true
                                                            ])->getHtml() !!}
                                                        <?php } ?>
                                                        <div class="title">
                                                            <h3 class="h5"><a href="{{route('video-detail',$item->video_info['id'] )}}" class="btn-link">{!! Illuminate\Support\Str::limit($item->video_info['title'], 50) !!}</a></h3>
                                                            <p>{!! Illuminate\Support\Str::limit(html_entity_decode($item->video_info['detail']), 50) !!}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Post Item End -->
                                        </li>
                                       
                                        <li class="col-xs-12 hidden shown-xxs">
                                            <!-- Divider Start -->
                                            <hr class="divider">
                                            <!-- Divider End -->
                                        </li>                                        
                                    @endforeach                                   
                                </ul>                                
                            </div>
                            <!-- Post Items End -->
                        </div>                            
                        @endif

                      
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
                                                        <video style="display:block; margin: 0 auto;" height="80" 
                                                                poster="{{asset('upload/fstv/video/'.$item->image)}}" 
                                                                src="{{asset('upload/fstv/video/'.$item->video)}}" 
                                                                playsinline controls>
                                                            </video>
                                                    <?php }elseif($item->video_info['link'] != ''){ ?>
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
                                                        <h3 class="h4"><a href="{{route('video-detail',$item->video_info['id'])}}" class="btn-link">{{$item->video_info['title']}}</a></h3>
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
                                                        <video style="display:block; margin: 0 auto;" height="80" 
                                                        poster="{{asset('upload/fstv/video/'.$item->image)}}" 
                                                        src="{{asset('upload/fstv/video/'.$item->video)}}" 
                                                        playsinline controls>
                                                    </video>
                                                    <?php }elseif($item->video_info['link'] != ''){ ?>
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
                                                        <h3 class="h4"><a href="{{route('video-detail',$item->video_info['id'])}}" class="btn-link">{{$item->video_info['title']}}</a></h3>
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
                                                        <video style="display:block; margin: 0 auto;" height="80" 
                                                            poster="{{asset('upload/fstv/video/'.$item->image)}}" 
                                                            src="{{asset('upload/fstv/video/'.$item->video)}}" 
                                                            playsinline controls>
                                                        </video>
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
                                                        <h3 class="h4"><a href="{{route('video-detail',$item->id)}}" class="btn-link">{{$item->title}}</a></h3>
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
    