@extends('layouts.master')
@section('title')
    IEC - Institute for excelence center
@endsection
@section('content')
<div class="form-body">
    <div class="website-logo" >
        <a href="">
          {{-- <img class="logo-size" src="{{ asset('plugins/ausnep.jpg')}}" alt="">  --}}
        </a>
    </div>
    <div class="row">
        <div class="img-holder">
            <div class="bg"></div>
            <div class="info-holder">
                 <img class="logo-size" src="{{ asset('plugins/logo.png')}}" style="border-block-color: white; border:solid white 2mm " alt="logo">
            </div>
        </div>
        <div class="form-holder">
            <div class="form-content">
                <div class="form-items">
                    @if (Session::has('message'))
                        <div class="alert alert-info">{{ Session::get('message') }}</div>
                    @endif
                    <h3>Firescreen Television</h3>
                    {{-- <p>Administration Login</p> --}}
                    <div class="page-links">
                        <a href="{{ route('login') }}" class="active">Login</a>
                        {{-- <a href="{{route('register')}}">Register</a> --}}
                    </div>
                   
                    {{-- @if ($errors->any())
                        <ul>{!! implode('', $errors->all('<li style="color:red">:message</li>')) !!}</ul>
                    @endif                   --}}

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <input class="form-control" type="text" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="E-mail Address" required>
                        {{-- @if($errors->has('email'))
                                <div class="error">{{ $errors->first('email') }}</div>
                        @endif --}}

                        <input class="form-control" type="password" name="password" required autocomplete="current-password" placeholder="Password">
                        @if ($errors->any())
                        <ul style="color:red">{!! implode('', $errors->all(':message')) !!}</ul>
                    @endif 
                        
                        {{-- <input type="checkbox" id="chk1"><label for="chk1">{{ __('Remember Me') }}</label> --}}
                        <div class="form-button">
                            <button id="submit" type="submit" class="ibtn">{{ __('Login') }}</button> 
                            {{-- <a href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a> --}}
                        </div>
                    </form>
                    
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
           $("div.alert-info").remove();
        }, 3000 ); // 5 secs    
    });
</script>
    
@endsection