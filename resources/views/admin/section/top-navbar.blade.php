<?php
    use App\User;
    use App\Models\Userinfo;

    $newUser = User::first();
?>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="mobile-only-brand pull-left">
        <div class="nav-header pull-left">
            <div class="logo-wrap">
                <a href="{{route('home')}}">
                    <img class="brand-img" src="{{asset('plugins/logo.png')}}" width="65" alt=""/>
                    <span class="brand-text">IEC</span>
                </a>
            </div>
        </div>	
        <a id="toggle_nav_btn" class="toggle-left-nav-btn inline-block ml-20 pull-left" href="javascript:void(0);"><i class="zmdi zmdi-menu"></i></a>
        <a id="toggle_mobile_nav" class="mobile-only-view" href="javascript:void(0);"><i class="zmdi zmdi-more"></i></a>
        
        
    </div>
    <div id="mobile_only_nav" class="mobile-only-nav pull-right">
        <ul class="nav navbar-right top-nav pull-right">
            
            <li class="dropdown auth-drp">
                <a href="#" class="dropdown-toggle pr-0" data-toggle="dropdown"><img src="{{asset('plugins/user1.png')}}" alt="Admin" class="user-auth-img img-circle"/><span class="user-online-status"></span></a>
                <ul class="dropdown-menu user-auth-dropdown" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
                    <li>
                        <a href="{{route("profile")}}"><i class="zmdi zmdi-account"></i><span>Profile</span></a>
                    </li>
                    <li class="divider"></li>
                  
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>	
</nav>

@if ($message = Session::get('message'))
<div class="jq-toast-wrap top-right">
        <div class="jq-toast-single jq-has-icon jq-icon-success" style="text-align: left; display: relate;">
            <span class="jq-toast-loader jq-toast-loaded" style="-webkit-transition: width 3.1s ease-in; -o-transition: width 3.1s ease-in;                       transition: width 3.1s ease-in;                       background-color: #fec107;"></span>
            <span class="close-jq-toast-single">×</span>
            <h2 class="jq-toast-heading">{{ $message }}</h2>
        </div>
    </div>
@endif

@if ($message = Session::get('error'))
<div class="jq-toast-wrap top-right">
        <div class="jq-toast-single jq-has-icon jq-icon-danger" style="text-align: left; display: relate;">
            <span class="jq-toast-loader jq-toast-loaded" style="-webkit-transition: width 3.1s ease-in; -o-transition: width 3.1s ease-in;                       transition: width 3.1s ease-in;                       background-color: #fec107;"></span>
            <span class="close-jq-toast-single">×</span>
            <h2 class="jq-toast-heading">{{ $error }}</h2>
        </div>
    </div>
@endif