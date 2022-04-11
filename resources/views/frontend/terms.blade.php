@extends('layouts.frontend')
@section('title')
    FSTV | Terms and Condition
@endsection
@section('content')
       <!-- Main Breadcrumb Start -->
       <div class="main--breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{route('homepage')}}" class="btn-link"><i class="fa fm fa-home"></i>Home</a></li>
                <li class="active"><span>Privacy policy</span></li>
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
                        <div class="col-md-12">
                            <div class="post--info">
                                <div class="title">
                                    <h2 class="h4">{{@$terms->title}}</h2>
                                </div>
                            </div>

                            <div class="post--content">
                                <p>{!! html_entity_decode(@$terms->detail) !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Post Item End -->
            </div>
            <!-- Main Content End -->
        </div>
    </div>
    <!-- Main Content Section End -->
@endsection