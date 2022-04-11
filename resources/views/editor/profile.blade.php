
@extends('layouts.editor')
@section('title','FSTV | Editor Profile')

@section('content')
<div class="container-fluid">
					
    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
          <h5 class="txt-dark">Editor Information</h5>
        </div>
    </div>
    <!-- /Title -->
    @if (Session::has('message'))
        <div class="success success-info">{{ Session::get('message') }}</div>
    @endif 
    
    <!-- Row -->
        <div class="row">
            <div class="col-lg-8 col-xs-12">
                <div class="panel panel-default card-view  pa-0">
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body  pa-0">
                            <div class="profile-box">
                               
                                <div class="profile-info text-center mt-30">
                                    
                                    <img src="{{ asset('/upload/users/'.auth()->user()->editor_info['image']) }}" style="max-width: 200px; max-height:300px;" alt="">                                        
                                   
                                {{-- <img class="inline-block mb-10" src="{{ request()->user()->editor_info['image']}}" alt="user"> --}}
                                    	
                                <h5 class="block mt-10 mb-5 weight-500 capitalize-font">{{ request()->user()->name}}</h5>
                                    <p class="block pb-20">{{ auth()->user()->email}}</p>
                                </div>	
                                <div class="social-info">
                                    <div class="row">
                                        <div class="col-md-6">
                                        <label><strong>Name:</strong> </label> {{auth()->user()->name}}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                        <label><strong>Country:</strong> </label> {{auth()->user()->editor_info['country']}}
                                        </div>                                        
                                        
                                        <div class="col-md-6">
                                        <label><strong>City:</strong> </label> {{auth()->user()->editor_info['city']}}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                        <label><strong>Address:</strong> </label> {{auth()->user()->editor_info['address']}}
                                        </div>                                        
                                        
                                        <div class="col-md-6">
                                        <label><strong>Phone:</strong> </label> {{auth()->user()->editor_info['phone']}}
                                        </div>
                                    </div>                                   
                                    <div class="row">
                                        <div class="col-md-6">
                                        <label><strong>Citizenship/Passport No:</strong> </label> {{auth()->user()->editor_info['citizenship']}}
                                        </div>                                        
                                        
                                        <div class="col-md-6">
                                        <label><strong>Other ID:</strong> </label> {{auth()->user()->editor_info['other_id']}}
                                        </div>
                                    </div>  
                        
                                    <div class="row">
                                        <div class="col-md-4">
                                        <label><strong>News Category Permitted:</strong> </label> @foreach ($cat_list as $item)
                                            <li>{{$item->c}}</li>
                                        @endforeach
                                        </div>                                        
                                        
                                        <div class="col-md-4">
                                            <label><strong>Video Category Permitted:</strong> </label> @foreach ($menu_list as $item)
                                                <li>{{$item->m}}</li>
                                            @endforeach
                                        </div> 
                                        <div class="col-md-4">
                                            <label><strong>Other Permission:</strong> </label> 
                                            @if(auth()->user()->editor_info['blog'] == 1)
                                            <li>Blogs</li>                                                
                                            @endif
                                            @if(auth()->user()->editor_info['gallery'] == 1)
                                            <li>Gallery</li>
                                            @endif                                           
                                        </div> 
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                        <label><strong>Description:</strong> </label> {{auth()->user()->editor_info['detail']}}
                                        </div>            
                                    </div>
                                  
                                    <div class="row" style="margin-top: 20px;">
                                        <div class="col-md-12" style="text-align: center;">
                                    <button class="btn btn-success"><i class="fa fa-pencil"></i> <span class="btn-text"><a href="{{route('profile-edit', auth()->user()->id)}}" style="color:#fff;">Edit profile</a> </span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- /Row -->
    
</div>
    
@endsection
