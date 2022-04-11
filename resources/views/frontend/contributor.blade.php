@extends('layouts.frontend')
@section('title')
 Our Contributors
@endsection
@section('content')
    <!-- Main Breadcrumb Start -->
    <div class="main--breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{route('homepage')}}" class="btn-link"><i class="fa fm fa-home"></i>Home</a></li>
                <li class="active"><span>Contributors</span></li>
            </ul>
        </div>
    </div>
    <!-- Main Breadcrumb End -->

    <!-- Main Content Section Start -->
    <div class="main-content--section pbottom--30">
        <div class="container">
            <!-- Main Content Start -->
            <div class="main--content">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <!-- Page Title Start -->
                        <div class="page--title pd--30-0 text-center">
                            <h2 class="h2">Our Contributors</h2>

                            <div class="content">
                                {{-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p> --}}
                            </div>

                        </div>
                        <!-- Page Title End -->
                    </div>
                </div>

                <!-- Contributor Items Start -->
                <div class="contributor--items ptop--30">
                    <ul class="nav row AdjustRow">
                        @foreach ($contributor as $item)
                        <li class="col-md-3 col-xs-6 col-xxs-12 pbottom--30">
                            <!-- Contributor Item Start -->
                            <div class="contributor--item style--3">
                                <div class="img" height="250">
                                    <img src="{{asset('upload/contributor/'.'Thumb-lg-'.$item->image)}}" height="250" alt="">
                                </div>

                                <div class="info bg--color-1 bd--color-1">
                                    <div class="name">
                                        <h3 class="h4">{{$item->name}}</h3>
                                    </div>

                                    <div class="desc">
                                        <p>{{$item->address}}</p>
                                        <p>{{$item->email}}</p>
                                    </div>
                                    <div class="action">
                                        <a href="{{route('contributor-detail', $item->id)}}" class="btn btn-default">Contributor Posts</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Contributor Item End -->
                        </li>
                            
                        @endforeach
                        {{$contributor->links()}}
                    </ul>
                </div>
                <!-- Contributor Items End -->
            </div>
            <!-- Main Content End -->
        </div>
    </div>
    <!-- Main Content Section End -->
@endsection