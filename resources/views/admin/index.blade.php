@extends('layouts.admin')
@section('title')
	FSTV| Admin Dashboard
@endsection
@section('content')
        
<div class="container-fluid pt-25">
    <div class="jq-toast-wrap top-right">
        <div class="jq-toast-single jq-has-icon jq-icon-success" style="text-align: left; display: relate;">
            <span class="jq-toast-loader jq-toast-loaded" style="-webkit-transition: width 3.1s ease-in; -o-transition: width 3.1s ease-in;                       transition: width 3.1s ease-in;                       background-color: #fec107;"></span>
            <span class="close-jq-toast-single">×</span>
            <h2 class="jq-toast-heading">Welcome to Admin Dashboard</h2>
        </div>
    </div>
    
    <!-- Row -->
    <div class="row mb-30">
        <h4>Admin - Dashboard</h4>
    </div>
    <!-- /Row -->

    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
    
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <div class="panel panel-default card-view pa-0">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body pa-0">
                        <a href="{{route('post.index')}}">
                        <div class="sm-data-box bg-red">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                                        <span class="txt-light block counter"><span class="counter-anim">{{$unpublish_post->count()}}</span></span>
                                        <span class="weight-500 uppercase-font txt-light block font-13"> Total Unpublish News</span>
                                    </div>
                                    <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                        <i class="zmdi zmdi-file-text txt-light data-right-rep-icon"></i>
                                    </div>
                                </div>	
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
		<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <div class="panel panel-default card-view pa-0">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body pa-0">
                        <a href="{{route('video.index')}}">
                        <div class="sm-data-box bg-red">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                                        <span class="txt-light block counter"><span class="counter-anim">{{$unpublish_video->count()}}</span></span>
                                        <span class="weight-500 uppercase-font txt-light block font-13"> Total Unpublish Videos</span>
                                    </div>
                                    <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                        <i class="zmdi zmdi-collection-video txt-light data-right-rep-icon"></i>
                                    </div>
                                </div>	
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <div class="panel panel-default card-view pa-0">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body pa-0">
                        <a href="{{route('blog.index')}}">
                        <div class="sm-data-box bg-yellow">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                                        <span class="txt-light block counter"><span class="counter-anim">{{$total_unpublish_blog->count()}}</span></span>
                                        <span class="weight-500 uppercase-font txt-light block">Unpublish Blogs</span>
                                    </div>
                                    <div class="col-xs-6 text-center  pl-0 pr-0 pt-25  data-wrap-right">                                        
                                        <i class="fa fa-th txt-light data-right-rep-icon"></i>
                                    </div>
                                </div>	
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <div class="panel panel-default card-view pa-0">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body pa-0">
                        <a href="{{route('support.index')}}">
                        <div class="sm-data-box bg-grey">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                                        <span class="txt-light block counter"><span class="counter-anim">{{$total_support->count()}}</span></span>
                                        <span class="weight-500 uppercase-font txt-light block">Total Support</span>
                                    </div>
                                    <div class="col-xs-6 text-center  pl-0 pr-0 pt-25  data-wrap-right">                                        
                                        <i class="zmdi zmdi-comment-text txt-light data-right-rep-icon"></i>
                                    </div>
                                </div>	
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <div class="panel panel-default card-view pa-0">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body pa-0">
                        <a>
                        <div class="sm-data-box bg-green">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                                        <span class="txt-light block counter"><span class="counter-anim">{{$total_app_users->count()}}</span></span>
                                        <span class="weight-500 uppercase-font txt-light block"> Total Application Users</span>
                                    </div>
                                    <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                        <i class="zmdi zmdi-smartphone-iphone txt-light data-right-rep-icon"></i>
                                    </div>
                                </div>	
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <div class="panel panel-default card-view pa-0">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body pa-0">
                        <a>
                        <div class="sm-data-box bg-blue">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                                        <span class="txt-light block counter"><span class="counter-anim">{{$today_app_users->count()}}</span></span>
                                        <span class="weight-500 uppercase-font txt-light block">Today's New Application Users</span>
                                    </div>
                                    <div class="col-xs-6 text-center  pl-0 pr-0 pt-25  data-wrap-right">                                        
                                        <i class="zmdi zmdi-smartphone txt-light data-right-rep-icon"></i>
                                    </div>
                                </div>	
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <div class="panel panel-default card-view pa-0">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body pa-0">
                        <a href="{{route('daily-winner')}}">
                        <div class="sm-data-box bg-red">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                                        <span class="txt-light block counter"><span class="counter-anim">{{$day_winner}}</span></span>
                                        <span class="weight-500 uppercase-font txt-light block font-13"> Total Daily Winner</span>
                                    </div>
                                    <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                        <i class="zmdi zmdi-file-text txt-light data-right-rep-icon"></i>
                                    </div>
                                </div>	
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
		<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <div class="panel panel-default card-view pa-0">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body pa-0">
                        <a href="{{route('weekly-winner')}}">
                        <div class="sm-data-box bg-red">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                                        <span class="txt-light block counter"><span class="counter-anim">{{$week_winner}}</span></span>
                                        <span class="weight-500 uppercase-font txt-light block font-13"> Total Weekly Winner</span>
                                    </div>
                                    <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                        <i class="zmdi zmdi-collection-video txt-light data-right-rep-icon"></i>
                                    </div>
                                </div>	
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <div class="panel panel-default card-view pa-0">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body pa-0">
                        <a href="{{route('monthly-winner')}}">
                        <div class="sm-data-box bg-yellow">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                                        <span class="txt-light block counter"><span class="counter-anim">{{$month_winner}}</span></span>
                                        <span class="weight-500 uppercase-font txt-light block">Total Monthly Winner</span>
                                    </div>
                                    <div class="col-xs-6 text-center  pl-0 pr-0 pt-25  data-wrap-right">                                        
                                        <i class="fa fa-th txt-light data-right-rep-icon"></i>
                                    </div>
                                </div>	
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>   
@endsection
@section('scripts')
<script>
    $("document").ready(function(){
        setTimeout(function(){
           $("div.jq-icon-success").remove();
        }, 3000 ); // 5 secs   
    });
</script>
<script>
    $("document").ready(function(){
        setTimeout(function(){
           $(".alert-info").remove();
        }, 2000 ); // 5 secs   
    });
</script>    
@endsection

