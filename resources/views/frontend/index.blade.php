@extends('layouts.frontend')
@section('title')
    Homepage
@endsection
@section('content')


<!-- Main Content Section Start -->
<div class="main-content--section pbottom--30">
    <div class="container">

        @if(session()->has('message'))
            <div class="alert alert-info">
                {{ session()->get('message') }}
            </div>
        @endif
        <!-- Main Content Start -->
        <div class="main--content">
            <!-- Post Items Start -->
            <div class="post--items post--items-1 pd--30-0">
                <div class="row gutter--15">
                    @if (!$posts->isempty())

                    <div class="col-md-6">
                        <!-- Post Item Start -->
                        <div class="post--item post--layout-1 post--title-larger">
                            <div class="post--img" style="height: 419px;">
                                <a href="{{route('post-detail', $posts[0]->id)}}" class="thumb" style="height:100%;"><img src="{{ asset('upload/post/Thumb-lg-'.$posts[0]->image)}}" alt=""></a>
                                <a href="{{route('cat-post', $posts[0]->cat_id)}}" class="cat">{{$posts[0]->cat_info['title']}}</a>

                                <div class="post--info">
                                    <p class="utctime">{{ ($posts[0]->created_at) }}</p>

                                    <div class="title">
                                        <h2 class="h4"><a href="{{route('post-detail', $posts[0]->id)}}" class="btn-link">{{$posts[0]->title}}</a></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Post Item End -->                            
                    </div>

                    @if(isset($posts) && count($posts) > 3)
                    <div class="col-md-6">
                        <div class="row gutter--15">
                          @foreach($posts->slice(1,4) as $item)
                            <div class="col-xs-6 col-xss-12">
                                <!-- Post Item Start -->
                                <div class="post--item post--layout-1 post--title-large">
                                    <div class="post--img">
                                        <a href="{{route('post-detail', $item->id)}}" class="thumb" style="height:200px;"><img src="{{asset('upload/post/Thumb-sm-'.$item->image)}}" height="200px" alt=""></a>

                                        <div class="post--info">

                                            <p class="utctime">{{($item->created_at)}}</p>
                                            

                                            <div class="title">
                                                <h4 class="h4"><a href="{{route('post-detail', $item->id)}}" class="btn-link">{!! Illuminate\Support\Str::limit($item->title, 50) !!}</a></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Post Item End -->
                            </div>
                            
                            @endforeach
                        
                        </div>
                    </div>
                    @endif
                  @endif
                </div>
            </div>
            <!-- Post Items End -->
        </div>
        <!-- Main Content End -->

        <div class="row">
            <!-- Main Content Start -->
            <div class="main--content col-md-8 col-sm-7" data-sticky-content="true">
                <div class="sticky-content-inner">
                    <div class="row">
                        @if (!$cats1_post->isEmpty()) 
                        <!-- First category Start -->
                        <div class="col-md-6 ptop--30 pbottom--30">
                            <!-- Post Items Title Start -->
                            <div class="post--items-title" data-ajax="tab">
                                <h2 class="h4">{{$cats1_post[0]->cat_info['title']}}</h2>
                                
                                <div class="nav">
                                    <a href="{{route('cat-post', $cats1_post[0]->cat_id)}}" class="prev btn-link">
                                        <p>More</p>
                                    </a>
                                </div>
                            </div>
                            <!-- Post Items Title End -->
                            
                            
                            <!-- Post Items Start -->
                            <div class="post--items post--items-2" data-ajax-content="outer">
                                <ul class="nav row gutter--15" data-ajax-content="inner">
                                    @if (isset($cats1_post) && count($cats1_post) > 1)
                                        @foreach($cats1_post->take(5) as $item)
                                            @if($loop->first)
                                                <li class="col-xs-12">
                                                    <!-- Post Item Start -->
                                                    <div class="post--item post--layout-1">
                                                        <div class="post--img">
                                                            <a href="{{route('post-detail', $item->id)}}" class="thumb" style="width:100%; height:100%;"><img src="{{asset('upload/post/Thumb-lg-'.$item->image)}}" alt=""></a>
                                                            {{-- <a href="{{route('childcat-post', $item->sub_cat_id)}}" class="cat">{{$item->sub_cat_info['title']}}</a> --}}
            
                                                            <div class="post--info">
                    
                                                                <p class="utctime">{{($item->created_at)}}</p>
                                                               
            
                                                                <div class="title">
                                                                    <h3 class="h4"><a href="{{route('post-detail', $item->id)}}">{!! Illuminate\Support\Str::limit($item->title, 50) !!}</a></h3>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Post Item End -->
                                                </li>
                                                <li class="col-xs-12"><hr class="divider"></li>
                                            @else
                                                <li class="col-xs-6 mb-30">
                                                    <!-- Post Item Start -->
                                                    <div class="post--item post--layout-2">
                                                        <div class="post--img">
                                                            <a href="{{route('post-detail', $item->id)}}" class="thumb" style="height: 150px; width:100%;"><img src="{{asset('upload/post/Thumb-sm-'.$item->image)}}" height="150px" alt=""></a>
            
                                                            <div class="post--info">
                    
                                                                <p class="utctime">{{($item->created_at)}}</p>
                                                                
                                                                <div class="title">
                                                                    <h3 class="h4"><a href="{{route('post-detail', $item->id)}}" class="btn-link">{!! Illuminate\Support\Str::limit($item->title, 45) !!}</a></h3>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Post Item End -->
                                                                                                      <hr class="divider">

                                                </li> 
                                           @endif
                                        @endforeach
                                    @endif                                                   
                                </ul>                              
                            </div>
                            <!-- Post Items End -->
                        </div>
                        <!-- First category End -->
                        @endif

                        @if (!$cats2_post->isEmpty())
                        <!-- second category Start -->
                        <div class="col-md-6 ptop--30 pbottom--30">
                            <!-- Post Items Title Start -->
                            <div class="post--items-title" data-ajax="tab">
                                <h2 class="h4">{{$cats2_post[0]->cat_info['title']}}</h2>

                                <div class="nav">
                                    <a href="{{route('cat-post', $cats2_post[0]->cat_id)}}" class="prev btn-link">
                                        <p>More</p>
                                    </a>
                                </div>
                            </div>
                            <!-- Post Items Title End -->

                            <!-- Post Items Start -->
                            <div class="post--items post--items-3" data-ajax-content="outer">
                                <ul class="nav" data-ajax-content="inner">
                                    @if (isset($cats2_post) && count($cats2_post) > 2)
                                    @foreach($cats2_post->take(5) as $item)
                                        @if($loop->first)
                                            <li>
                                                <!-- Post Item Start -->
                                                <div class="post--item post--layout-1">
                                                    <div class="post--img">
                                                         <a href="{{route('post-detail', $item->id)}}" class="thumb" style="height: 100%; width:100%;"><img src="{{asset('upload/post/Thumb-lg-'.$item->image)}}" alt=""></a>
                                                        {{-- <a href="{{route('childcat-post', $item->sub_cat_id)}}" class="cat">{{$item->sub_cat_info['title']}}</a> --}}
        
                                                        <div class="post--info">
                
                                                            <p class="utctime">{{($item->created_at)}}</p>
                                                          
        
                                                            <div class="title">
                                                                <h3 class="h4"><a href="{{route('post-detail', $item->id)}}" class="btn-link">{!! Illuminate\Support\Str::limit($item->title, 50) !!}</a></h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Post Item End -->
                                            </li>
                                                
                                        @else
                                            <li>
                                                <!-- Post Item Start -->
                                                <div class="post--item post--layout-3">
                                                    <div class="post--img">
                                                        <a href="{{route('post-detail', $item->id)}}" class="thumb" style="height: 70px;"><img src="{{asset('upload/post/Thumb-sm-'.$item->image)}}" alt=""></a>
        
                                                        <div class="post--info">
                
                                                            <p class="utctime">{{($item->created_at)}}</p>
                                                           
        
                                                            <div class="title">
                                                                <h3 class="h4"><a href="{{route('post-detail', $item->id)}}" class="btn-link">{!! Illuminate\Support\Str::limit($item->title, 50) !!}</a></h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Post Item End -->
                                            </li>
                                  @endif
                                    @endforeach                            
                                  	@endif

                                </ul>
                            </div>
                            <!-- Post Items End -->                                
                        </div>
                        <!-- second category End -->                            
                            
                        @endif

                        <!-- Ad Start -->
                        <div class="col-md-12 ptop--30 pbottom--30">
                            @foreach (@$content_lg_ads->take(2) as $item)
                            <!-- Advertisement Start -->
                            <div class="ad--widget" id="adver"  ads_id="{{$item->id}}" style="width: 100%; height:90px" >
                                <a href="{{$item->link}}" target="_blank" >
                                    <img src="{{asset('upload/advertise/Thumb-lg-'.@$item->image)}}" alt="Ads 728x90">
                                </a>
                            </div>
                            <hr class="divider">
                            <!-- Advertisement End --> 
                                
                            @endforeach
                        </div>
                        <!-- Ad End -->
                        
                        @if (!$cats3_post->isEmpty())
                        <!-- Third Category Start -->
                        <div class="col-md-12 ptop--30 pbottom--30">
                            <!-- Post Items Title Start -->
                            <div class="post--items-title" data-ajax="tab">
                                <h2 class="h4">{{$cats3_post[0]->cat_info['title']}}</h2>

                                <div class="nav">
                                    <a href="{{route('cat-post',$cats3_post[0]->cat_id)}}" class="prev btn-link">
                                        <p>More</p>
                                    </a>
                                </div>
                            </div>
                            <!-- Post Items Title End -->

                            <!-- Post Items Start -->
                            <div class="post--items post--items-2" data-ajax-content="outer">
                                <ul class="nav row" data-ajax-content="inner">
                                    @if (isset($cats3_post) && count($cats3_post) > 2)
                                    @foreach($cats3_post->take(5) as $item)
                                        @if($loop->first)
                                            <li class="col-md-6">
                                                <!-- Post Item Start -->
                                                <div class="post--item post--layout-2">
                                                    <div class="post--img">
        
                                                        <a href="{{route('post-detail', $item->id)}}" class="thumb" height="300"><img src="{{asset('upload/post/Thumb-lg-'.$item->image)}}" alt=""></a>
                                                        {{-- <a href="{{route('childcat-post', $item->sub_cat_id)}}" class="cat">{{$item->sub_cat_info['title']}}</a> --}}
        
                                                        <div class="post--info">
                
                                                            <p class="utctime">{{($item->created_at)}}</p>
                                                           
        
                                                            <div class="title">
                                                                <h3 class="h4"><a href="{{route('post-detail', $item->id)}}" class="btn-link">{{$item->title}}</a></h3>
                                                            </div>
                                                          	<div class="subtitle">
                                                                <p>
                                                                  {!! Illuminate\Support\Str::limit(html_entity_decode($item->detail), 180) !!}
                                                              </p>
                                                            </div>
                                                          	
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Post Item End -->
                                            </li>
                                            <li class="col-md-6">
                                                <ul class="nav row">
                                                    <li class="col-xs-12 hidden-md hidden-lg">
                                                        <!-- Divider Start -->
                                                        <hr class="divider">
                                                        <!-- Divider End -->
                                                    </li>
                                        @else
                                        <li class="col-xs-6">
                                            <!-- Post Item Start -->
                                            <div class="post--item post--layout-2" >
                                                <div class="post--img img--responsive">
                                                    <a href="{{route('post-detail', $item->id)}}" class="thumb" style="height:100px;"><img src="{{asset('upload/post/Thumb-sm-'.$item->image)}}" alt=""></a>

                                                    <div class="post--info">
            
                                                        <p class="utctime">{{($item->created_at)}}</p>
                                                       

                                                        <div class="title">
                                                            <h3 class="h4"><a href="{{route('post-detail', $item->id)}}" class="btn-link">{!! Illuminate\Support\Str::limit($item->title, 20) !!}</a></h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Post Item End -->
                                            <hr class="divider">
                                        </li>
                                        @endif
                                    @endforeach                            
                                  	@endif
                                        </ul>
                                    </li>
                                                                              
                                </ul>
                               
                            </div>
                            <!-- Post Items End -->
                        </div>
                        <!-- Third Category End -->                                                 
                        @endif
                    </div>
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
                                                <a href="" class="thumb" style="height:70px;"><img src="{{asset('upload/post/'.$item->post_info['image'])}}" alt=""></a>

                                                <div class="post--info">
        
                                                    <p class="utctime">{{($item->created_at)}}</p>
                                                  

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
                                                <a href="" class="thumb" style="height:70px;"><img src="{{asset('upload/post/'.$item->post_info['image'])}}" alt=""></a>

                                                <div class="post--info">
        
                                                    <p class="utctime">{{($item->created_at)}}</p>
                                                  

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

        
        <div class="row">
           
            <!-- Main Content Start -->
            <div class="main--content col-md-8 col-sm-7" data-sticky-content="true">
                <div class="sticky-content-inner">
                            
                    <div class="row">
                        <!-- Ad Start -->
                        <div class="col-md-12 ptop--30 pbottom--30">
                            @foreach (@$content_lg_ads->random(1) as $item)
                                <!-- Advertisement Start -->
                                <div class="ad--widget" id="adver"  ads_id="{{$item->id}}" style="width: 100%; height:90px" >
                                    <a href="{{$item->link}}" target="_blank" >
                                        <img src="{{asset('upload/advertise/Thumb-lg-'.@$item->image)}}" alt="Ads 728x90">
                                    </a>
                                </div>
                                <hr class="divider">
                                <!-- Advertisement End -->                                 
                            @endforeach
                            
                        </div>
                        <!-- Ad End -->
                                              
                        @if (!$cats4_post->isempty())
                        <div class="col-md-12 ptop--30 pbottom--30">
                            <!-- Post Items Title Start -->
                            <div class="post--items-title" data-ajax="tab">
                                <h2 class="h4">{{$cats4_post[0]->cat_info['title']}}</h2>

                                <div class="nav">
                                    <a href="{{route('cat-post',$cats4_post[0]->cat_id)}}" class="prev btn-link">
                                        <p>More</p>
                                    </a>
                                </div>
                            </div>
                            <!-- Post Items Title End -->

                            <!-- Post Items Start -->
                            <div class="post--items" data-ajax-content="outer">
                                <ul class="nav row gutter--15" data-ajax-content="inner">
                                    @if (isset($cats4_post) && count($cats4_post) > 2)
                                    @foreach ($cats4_post->take(6) as $item)
                                        <li class="col-md-4 col-xs-6 col-xxs-12">
                                            <!-- Post Item Start -->
                                            <div class="post--item post--layout-1">
                                                <div class="post--img">
                                                   <a href="{{route('post-detail', $item->id)}}" class="thumb" style="height: 219px;"><img src="{{asset('upload/post/Thumb-sm-'.$item->image)}}" alt=""></a>


                                                    <div class="post--info">
            
                                                        <p class="utctime">{{($item->created_at)}}</p>
                                                       

                                                        <div class="title">
                                                            <h3 class="h4"><a href="{{route('post-detail', $item->id)}}" class="btn-link">{{$item->title}}</a></h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr class="divider">
                                            <!-- Post Item End -->
                                        </li>
                                        <li class="col-xs-12 hidden shown-xxs">
                                            <!-- Divider Start -->
                                            <hr class="divider">
                                            <!-- Divider End -->
                                        </li>                                        
                                    @endforeach

                                    @endif
                                   
                                </ul>                                
                            </div>
                            <!-- Post Items End -->
                        </div>                            
                        @endif
                      

                        <!-- Photo Gallery Start -->
                        <div class="col-md-12 ptop--30 pbottom--30">
                            <!-- Post Items Title Start -->
                            <div class="post--items-title" data-ajax="tab">
                                <h2 class="h4">Photo Gallery</h2>

                                <div class="nav">
                                    <a href="{{route('gallery')}}" class="prev btn-link">
                                        View More 
                                    </a>
                                </div>
                            </div>
                            <!-- Post Items Title End -->

                            @if (!$gallery->isempty())
                            <!-- Post Items Start -->
                            <div class="post--items post--items-1" data-ajax-content="outer">
                                <ul class="nav row gutter--15" data-ajax-content="inner">
                                    @foreach ($gallery->take(4) as $item)
                                        @if ($loop->first)
                                        <li class="col-md-12">
                                            <!-- Post Item Start -->
                                            <div class="post--item post--layout-1 post--title-large">
                                                <div class="post--img">
                                                    <a href="{{asset('upload/gallery/'.$item->image)}}" class="thumb" target="_blank"><img src="{{asset('upload/gallery/Thumb-lg-'.$item->image)}}" alt=""></a>
                                                    <a href="{{asset('upload/gallery/'.$item->image)}}" class="icon"><i class="fa fa-eye"></i></a>
    
                                                    <div class="post--info">
            
                                                        <p class="utctime">{{($item->created_at)}}</p>
                                                       
                                                        <div class="title text-xxs-ellipsis">
                                                            <h2 class="h4"><a href="" class="btn-link">{{$item->title}}</a></h2>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Post Item End -->
                                        </li>
                                        @else
                                        <li class="col-md-4 col-xs-6 col-xxs-12">
                                            <!-- Post Item Start -->
                                            <div class="post--item post--layout-1">
                                                <div class="post--img">
                                                    <a href="{{asset('upload/gallery/'.$item->image)}}" class="thumb" target="_blank" style="display:block; margin: 0 auto; height:200px;"><img src="{{asset('upload/gallery/Thumb-sm-'.$item->image)}}" alt=""></a>
    
                                                    <div class="post--info">
            
                                                        <p class="utctime">{{($item->created_at)}}</p>
                                                       
                                                        <div class="title text-xxs-ellipsis">
                                                            <h2 class="h4"><a href="" class="btn-link">{{$item->title}}</a></h2>
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
                            @endif
                        </div>
                        <!-- Photo Gallery End -->
                    </div>
                </div>
            </div>
            <!-- Main Content End -->
          
         
            <!-- Main Sidebar Start -->
            <div class="main--sidebar col-md-4 col-sm-5 ptop--30 pbottom--30" data-sticky-content="true">
                <div class="sticky-content-inner">
                 
                    <!-- Widget Start -->
                    <div class="widget">
                        <div class="widget--title">
                            <h2 class="h4">Category</h2>
                            <i class="icon fa fa-folder-open-o"></i>
                        </div>

                        @if (!$cats->isempty())
                        <!-- Nav Widget Start -->
                        <div class="nav--widget">
                            <ul class="nav">
                                @foreach ($cats as $item)
                                <li><a href="{{route('cat-post', $item->id)}}"><span>{{$item->title}}</span><span>()</span></a></li>
                                    
                                @endforeach
                                
                            </ul>
                        </div>
                        <!-- Nav Widget End -->                            
                        @endif
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
                                     controls autoplay="autoplay" muted loop playsinline>
                                </video>
                            </a>
                            <!-- Ad Widget End --> 
                        @endforeach
                    </div>            
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
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script>
    $("document").ready(function(){
        setTimeout(function(){
           $("div.alert").remove();
        }, 3000 ); // 5 secs    
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