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
                                <a href="#" class="icon"><i class="fa fa-star-o"></i></a>                               
                            </div>

                            <div class="post--info">
                                <ul class="nav meta">
                                    <li><a href="#">{{$post->author_info['name']}}</a></li>
                                    <li><a href="#">{{$post->created_at}}</a></li>
                                    
                                    <li><a href="#"><i class="fa fm fa-comments-o"></i>{{count(@$review)}}</a></li>
                                </ul>

                                <div class="title">
                                    <h2 class="h4">{{$post->title}}</h2>
                                </div>
                            </div>

                            <div class="post--content">
                                <p>{!! html_entity_decode($post->detail) !!}</p>    
                            </div>
                            @if (isset($post->video))
                            <div class="post--content">
                                <video width="100%" height="300" controls>
                                    <source src="{{ asset('upload/post/video/'.@$post->video) }}" type="file">
                                    <source src="{{ asset('upload/post/video/'.@$post->video) }}" type="video/ogg">
                                    Your browser does not support the video tag.
                                </video>                                
                            </div>
                            @endif
                        </div>
                        <!-- Post Item End -->
                        @if (@$content_lg_ads[0]->type == 'image')
                            <!-- Ad Widget Start -->
                            <div class="ad--widget" style="height:70px;">
                                <a href="{{@$content_lg_ads[0]->link}}">
                                    <img src="{{asset('upload/advertise/Thumb-lg-'.@$content_lg_ads[0]->image)}}" alt="Ads 728x90">
                                </a>
                            </div>
                            <!-- Ad Widget End -->                                                    
                            @else
                            <video width="100%" controls autoplay loop muted>
                                <source src="{{ asset('upload/advertise/'.@$content_lg_ads[0]->image) }}" height="100px" type="file">
                                <source src="{{ asset('upload/advertise/'.@$content_lg_ads[0]->image) }}" type="video/ogg">
                                Your browser does not support the video tag.
                            </video>  
                        @endif
                       
                        <hr class="divider divider--25">
                       	<hr class="divider divider--25">                     
                      
                        <!-- Post Author Info Start -->
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
                                                    <li><a href="#">{{$item->created_at}}</a></li>
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
                        <!-- Post Nav End -->

                        <!-- Comment List Start -->
                        <div class="comment--list pd--30-0">
                            <!-- Post Items Title Start -->
                            <div class="post--items-title">

                                <h2 class="h4"><?php echo $review->count(); ?> Comments</h2>

                                <i class="icon fa fa-comments-o"></i>
                            </div>
                            <!-- Post Items Title End -->

                            <ul class="comment--items nav">
                                @foreach ($review as $item)
                                <li>
                                    <!-- Comment Item Start -->
                                    <div class="comment--item clearfix">
                                        <div class="comment--img float--left">
                                            <img src="img/news-single-img/comment-avatar-01.jpg" alt="">
                                        </div>

                                        <div class="comment--info">
                                            <div class="comment--header clearfix">
                                                <p class="name">{{$item->name}}</p>
                                                <p class="date">{{$item->created_at}}</p>
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
                        </div>
                        <!-- Comment List End -->

                        <!-- Comment Form Start -->
                        <div class="comment--form pd--30-0">
                            <!-- Post Items Title Start -->
                            <div class="post--items-title">
                                <h2 class="h4">Leave A Comment</h2>

                                <i class="icon fa fa-pencil-square-o"></i>
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