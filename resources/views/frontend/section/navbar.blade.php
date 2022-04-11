<!-- Header Topbar Start -->
<div class="playstore shown-xss hidden" id="playstore">
    <div class="container">
        <div class="float--left float--xs-none  text-xs-center">
            <button type="button" class="close modal-header" id="plays_colse" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <!-- Header Topbar Info Start -->
            <div class="playsapp">
                <div class="logowrap">
                    <a href=""><img src="{{asset('plugins/slogo.png')}}" style="height:65px;"></a>
                   
                </div>
                <div class="link_sec text-xs-center">
                    <div class="col-xxs-6 pull-left">
                        <h4><strong>Firescreentv app</strong></h4>
                      <p>Try for free</p>
                        

                    </div>
                    <div class="col-xxs-6 pull-right">
                      <h4>
                                                <a href="https://u4h4r.app.link/firescreentv" class="btn btn-success">Install</a>

                      </h4>

                    </div>
                    {{-- <h3>Fire Screen TV</h3>
                    <h6>Try free in App Store</h6>
                    <div class="text-xs-center" style="display: inline;">
                        <a href="https://u4h4r.app.link/firescreentv"><img src="{{asset('plugins/IOS.png')}}" style="max-height:20px"></a>
                        <a href="https://u4h4r.app.link/firescreentv"><img src="{{asset('plugins/Android.png')}}" style="max-height:20px"></a>
                    </div> --}}
                    {{-- <h6>Try free in App Store</h6> --}}
                </div>
            </div>
            <!-- Header Topbar Info End -->
        </div>

    </div>
</div>
<!-- Header Topbar End -->

<header class="header--section header--style-1">   

    <!-- Header Mainbar Start -->
    <div class="header--mainbar">
        <div class="container">
            <!-- Header Logo Start -->
            <div class="header--logo float--left float--sm-none text-sm-center">
                <h1 class="h1">
                    <a href="{{route('homepage')}}" class="btn-link">
                        <img src="{{asset('plugins/logo1.png')}}" height="55" alt="FSTV LOGO"><span>  </span>
                        <span><a href="{{route('homepage')}}" class="btn-link" style="text-decoration-color: white;"></a> </span>
                        <span class="hidden"> </span>
                    </a> 
                </h1>
            </div>
            
            <!-- Header Logo End -->

            <!-- Header Ad Start -->
            <div class="float--right float--xs-none">
                <!-- Header Topbar Action Start -->
                <ul class="header--topbar-action pull-right">
                    <a style="color: white;" href="{{route('login')}}"><i class="fa fm fa-user-o"></i>Login</a>
                </ul>
                <!-- Header Topbar Action End -->               
            </div>
            <!-- Header Ad End -->
        </div>
    </div>
    <!-- Header Mainbar End -->

    <!-- Header Navbar Start -->
    <div class="header--navbar style--1 navbar bd--color-1 bg--color-1" data-trigger="sticky">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#headerNav" aria-expanded="false" aria-controls="headerNav">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <div id="headerNav" class="navbar-collapse collapse float--left">
                <!-- Header Menu Links Start -->
                <ul class="header--menu-links nav navbar-nav" data-trigger="hoverIntent">
                    <li class="{{ Request::path() == '/' ? 'active' : '' }}"><a href="{{route('homepage')}}">Home</a></li>
                    
                    {{-- @foreach ($menu as $item)                   
                    <li><a href="{{route('cat-post', $item->cat_info['id'])}}">{{$item->cat_info['title']}}</a></li>
                    @endforeach --}}
                                 
                   @forelse ($cats->take(9) as $cat)
                    @if(!$cat->child_cats->isEmpty())
                    <li class="dropdown megamenu">
                        <li class="dropdown">
                            <a href="{{route('cat-post', $cat->id)}}" data-toggle="dropdown">{{$cat->title}}<i class="fa flm fa-angle-down"></i></a>
                            <ul class="dropdown-menu">                                
                                @foreach ($cat->child_cats as $item)
                                    <li><a href="{{route('childcat-post', $item->id)}}">{{$item->title}}</a></li>
                                @endforeach                                        
                            </ul>
                        </li>                                
                    </li>
                    @else
                    <li><a href="{{route('cat-post', $cat->id)}}">{{$cat->title}}</a></li>
                    @endif
                    @empty

                    @endforelse
                    
                    {{-- <li class="dropdown megamenu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Category<i class="fa flm fa-angle-down"></i></a>

                        <ul class="dropdown-menu">
                            @foreach ($category as $cat)
                            <li class="dropdown">
                                <a href="{{route('cat-post', $cat->id)}}">{{$cat->title}}</a>
                                <ul class="dropdown-menu">
                                @foreach ($cat->child_cats as $item)
                                    <li><a href="{{route('cat-post', $item->cat_info['id'])}}">{{$item->title}}</a></li>
                                @endforeach                                    
                                </ul>
                            </li>                                
                            @endforeach
                        </ul>
                    </li> --}}

                    <li class="{{ Request::path() == '/fstv' ? 'active' : '' }}"><a href="{{route('media')}}">FSTV TV</a></li>

                   {{-- <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pages<i class="fa flm fa-angle-down"></i></a>

                        <ul class="dropdown-menu">                            
                            <li><a href="{{route('blog')}}">Blog</a></li>
                            <li><a href="{{route('about-us')}}">About</a></li>
                            <li><a href="{{route('contact-us')}}">Contact</a></li>
                        </ul>
                    </li> --}}
                </ul>
                <!-- Header Menu Links End -->
            </div>

           
        </div>
    </div>
    <!-- Header Navbar End -->
</header>