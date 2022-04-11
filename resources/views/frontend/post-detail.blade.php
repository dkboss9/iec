@extends('layouts.frontend')
@section('title')
  News Detail
@endsection
@section('content')

    <!-- Main Breadcrumb Start -->
    <div class="main--breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{route('homepage')}}" class="btn-link"><i class="fa fm fa-home"></i>Home</a></li>
                <li><a href="{{route('cat-post', $post->cat_id)}}" class="btn-link">Post</a></li>
                <li class="active"><span>{{$post->title}}</span></li>
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
                                <a href="{{asset('upload/post/'.$post->image)}}" class="thumb"><img src="{{asset('upload/post/'.$post->image)}}" alt=""></a>
                            </div>

                            <div class="post--info">
                                <p class="utctime">{{($post->created_at)}} </p>
                                <?php echo Share::currentpage()
                                    ->facebook()
                                    ->twitter(); 
                                ?>
                                
                                <div class="title">
                                    <h2 class="h4">{{$post->title}}</h2>
                                </div>
                            </div>

                            <div class="post--content">
                                <p>{!! html_entity_decode($post->detail) !!}</p>    
                            </div>
                            @if (isset($post->video))
                            <div class="post--content">
                                <video style="display:block; margin: 0 auto;" max-height="auto" width="100%" 
                                    poster="{{asset('upload/post/'.$post->image)}}" 
                                    src="{{asset('upload/post/video/'.$post->video)}}" 
                                    playsinline controls>
                                </video>                                                              
                            </div>
                            @endif
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
                       	<hr class="divider divider--25">                     
                      
                        {{-- <!-- Post Author Info Start -->
                        <div class="post--author-info clearfix">
                            <div class="img">
                                <div class="vc--parent">
                                    <div class="vc--child">
                                        <a href="author.html" class="btn-link">
                                            <img src="{{asset('upload/contributor/'.$post->contributor_info['image'])}}" alt="">
                                            <p class="name">{{$post->contributor_info['name']}}</p>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="info">
                                <h2 class="h4">About The Contributor</h2>

                                <div class="content">
                                    <p>{!! Illuminate\Support\Str::limit(html_entity_decode($post->contributor_info['detail']), 100) !!}</p>
                                </div>

                                <ul class="social nav">
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href="#"><i class="fa fa-rss"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- Post Author Info End -->

                        <!-- Post Nav Start -->
                        <div class="post--nav">
                            <ul class="nav row">
                                @foreach ($contributor_post as $item)
                                <li class="col-xs-6 ptop--30 pbottom--30">
                                    <!-- Post Item Start -->
                                    <div class="post--item">
                                        <div class="post--img">
                                            <a href="#{{asset('upload/post/'.$item->image)}}" class="thumb" style="height:90px;"><img src="{{asset('upload/post/'.$item->image)}}" alt=""></a>

                                            <div class="post--info">
                                                <ul class="nav meta">
                                                    <li><a href="#">{{$item->contributor_info['name']}}</a></li>
                                                    <li><a href="#">{{Timezone::convertToLocal($item->created_at)}}</a></li>
                                                </ul>

                                                <div class="title">
                                                    <h3 class="h4"><a href="{{route('post-detail', $item->id)}}" class="btn-link">{!! Illuminate\Support\Str::limit($item->title, 50) !!}</a></h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Post Item End -->
                                </li>
                                    
                                @endforeach

                            </ul>
                        </div>
                        <!-- Post Nav End --> --}}

                        <!-- Comment List Start -->
                        <div class="comment--list pd--30-0">
                            <!-- Post Items Title Start -->
                            <div class="post--items-title">

                                <h2 class="h4"><?php echo $review->count(); ?> Comments</h2>

                                <i class="icon fa fa-comments-o"></i>
                            </div>
                            <!-- Post Items Title End -->

                            @if (@$review->count() < 2)
                            <ul class="comment--items nav" id="rev1">
                                @foreach ($review as $item)
                                <li>
                                    <!-- Comment Item Start -->
                                    <div class="comment--item clearfix">
                                        <div class="comment--info">
                                            <div class="comment--header clearfix">
                                                <p class="name">{{$item->name}}</p>
                                               <p class="utctime">{{($item->created_at)}}</p>
                                            </div>

                                            <div class="comment--content">
                                                <p>{{$item->comments}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Comment Item End -->
                                </li>                                    
                                @endforeach
                                <div class="comment-items"><a href="" class="see-more"></a></div>
                            </ul>
                            @endif
                            @if ($review->count() >2)
                            <ul class="comment--items nav" id="rev2">
                                @foreach ($review->slice(0,2) as $item)
                                <li>
                                    <!-- Comment Item Start -->
                                    <div class="comment--item clearfix">
                                        <div class="comment--info">
                                            <div class="comment--header clearfix">
                                                <p class="name">{{$item->name}}</p>
                                               <p class="utctime">{{($item->created_at)}}</p>
                                            </div>

                                            <div class="comment--content">
                                                <p>{{$item->comments}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Comment Item End -->
                                </li>                                    
                                @endforeach
                            </ul>
                            <ul class="comment--items nav hidden" id="rev3">
                                @foreach ($review as $item)
                                <li>
                                    <!-- Comment Item Start -->
                                    <div class="comment--item clearfix">
                                        <div class="comment--info">
                                            <div class="comment--header clearfix">
                                                <p class="name">{{$item->name}}</p>
                                               <p class="utctime">{{($item->created_at)}}</p>
                                            </div>

                                            <div class="comment--content">
                                                <p>{{$item->comments}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Comment Item End -->
                                </li>                                    
                                @endforeach
                            </ul>
                            <br><div class="comment-item nav" id="seemore"><a class="btn btn-primary" id="seemore" href="#">See all comments</a></div>
                            <br><div class="comment-item nav hidden" id="seeless"><a class="btn btn-primary" id="seeless" href="#">Show less</a></div>
                                
                            @endif
                        </div>
                        <!-- Comment List End -->

                        <!-- Comment Form Start -->
                        <div class="comment--form pd--30-0">
                            <!-- Post Items Title Start -->
                            <div class="post--items-title">
                                <h2 class="h4">Leave A Comment</h2>

                                {{-- <i class="icon fa fa-pencil-square-o"></i> --}}
                            </div>
                            <!-- Post Items Title End -->

                            <div class="comment-respond">
                                <form action="{{route('submit-review', $post->id)}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <p>Don’t worry ! Your email address will not be published. Required fields are marked (*).</p>

                                    <div class="form-group row">
                                            <label>
                                                <span>Name *</span>
                                                <input type="text" name="name" id="name" class="form-control" required>
                                            </label>

                                            <label>
                                                <span>Email Address *</span>
                                                <input type="email" name="email" id="email" class="form-control" required>
                                            </label>

                                            <label>
                                                <span>Comment *</span>
                                                <textarea name="comments" id="comments" class="form-control" required></textarea>
                                            </label>
                                            <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary">Post a Comment</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Comment Form End -->
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
     $(document).ready(function(){
        $(document).on("click","#seemore",function(e){           
            $('#rev2').addClass('hidden');
            $('#rev3').removeClass('hidden');
            $('#seemore').addClass('hidden');
            $('#seeless').removeClass('hidden');
            e.preventDefault();
        });
        $(document).on("click","#seeless",function(e){           
            $('#rev3').addClass('hidden');
            $('#rev2').removeClass('hidden');
            $('#seeless').addClass('hidden');
            $('#seemore').removeClass('hidden');
            e.preventDefault();
        });

       
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