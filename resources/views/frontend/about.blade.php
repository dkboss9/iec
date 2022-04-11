@extends('layouts.frontend')
@section('title')
    About us
@endsection
@section('content')
    <!-- Main Breadcrumb Start -->
    <div class="main--breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{route('homepage')}}" class="btn-link"><i class="fa fm fa-home"></i>Home</a></li>
                <li class="active"><span>About</span></li>
            </ul>
        </div>
    </div>
    <!-- Main Breadcrumb End -->

    <!-- Main Content Section Start -->
    <div class="main-content--section pbottom--30">
        <div class="container">
            <!-- Main Content Start -->
            <div class="main--content">
                <!-- Post Item Start -->
                <div class="post--item post--single pd--30-0">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Single Image Section Start -->
                            <img src="{{asset('upload/about/'.@$about->image)}}" alt="" class="center-block">
                            <!-- Single Image Section End -->
                        </div>

                        <div class="col-md-6">
                            <div class="post--info">
                                <div class="title">
                                    <h2 class="h4">{{@$about->title}}</h2>
                                </div>
                            </div>

                            <div class="post--content">
                                <p>{!! html_entity_decode(@$about->detail) !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Post Item End -->

                {{-- <!-- Info Blocks Start -->
                <div class="info--blocks ptop--30">
                    <ul class="nav row">
                        <li class="col-md-3 col-xs-6 col-xxs-12 pbottom--30">
                            <!-- Info Block Start -->
                            <div class="info--block">
                                <div class="icon text--color-1">
                                    <i class="fa fa-dashboard"></i>
                                </div>

                                <div class="title">
                                    <h3 class="h5">Our Goal</h3>
                                </div>

                                <div class="content">
                                    <p>Aliquam quam laudantium suscipit ullam aut perferendis vel dicta blanditiis eligendi ratione consequatur, magni facilis dolor cupiditate et.</p>
                                </div>
                            </div>
                            <!-- Info Block End -->
                        </li>

                        <li class="col-md-3 col-xs-6 col-xxs-12 pbottom--30">
                            <!-- Info Block Start -->
                            <div class="info--block">
                                <div class="icon text--color-1">
                                    <i class="fa fa-cog"></i>
                                </div>

                                <div class="title">
                                    <h3 class="h5">Our Vission</h3>
                                </div>

                                <div class="content">
                                    <p>Aliquam quam laudantium suscipit ullam aut perferendis vel dicta blanditiis eligendi ratione consequatur, magni facilis dolor cupiditate et.</p>
                                </div>
                            </div>
                            <!-- Info Block End -->
                        </li>

                        <li class="col-md-3 col-xs-6 col-xxs-12 pbottom--30">
                            <!-- Info Block Start -->
                            <div class="info--block">
                                <div class="icon text--color-1">
                                    <i class="fa fa-diamond"></i>
                                </div>

                                <div class="title">
                                    <h3 class="h5">Our Mission</h3>
                                </div>

                                <div class="content">
                                    <p>Aliquam quam laudantium suscipit ullam aut perferendis vel dicta blanditiis eligendi ratione consequatur, magni facilis dolor cupiditate et.</p>
                                </div>
                            </div>
                            <!-- Info Block End -->
                        </li>

                        <li class="col-md-3 col-xs-6 col-xxs-12 pbottom--30">
                            <!-- Info Block Start -->
                            <div class="info--block">
                                <div class="icon text--color-1">
                                    <i class="fa fa-object-group"></i>
                                </div>

                                <div class="title">
                                    <h3 class="h5">Our Objectives</h3>
                                </div>

                                <div class="content">
                                    <p>Aliquam quam laudantium suscipit ullam aut perferendis vel dicta blanditiis eligendi ratione consequatur, magni facilis dolor cupiditate et.</p>
                                </div>
                            </div>
                            <!-- Info Block End -->
                        </li>
                    </ul>
                </div>
                <!-- Info Blocks End --> --}}
            </div>
            <!-- Main Content End -->
        </div>
    </div>
    <!-- Main Content Section End -->

    
@endsection