@extends('layouts.frontend')
@section('title')
    Contact Us
@endsection
@section('content')
    <!-- Main Breadcrumb Start -->
    <div class="main--breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="home-1.html" class="btn-link"><i class="fa fm fa-home"></i>Home</a></li>
                <li class="active"><span>Contact</span></li>
            </ul>
        </div>
    </div>
    <!-- Main Breadcrumb End -->

    {{-- <!-- Map Start -->
    <div class="map--fluid mtop--30" data-trigger="map" data-map-latitude="23.790546" data-map-longitude="90.375583" data-map-zoom="16" data-map-marker="[[23.790546, 90.375583]]"></div>
    <!-- Map End --> --}}

    <!-- Contact Section Start -->
    <div class="contact--section">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-4 pbottom--30">
                    @foreach (@$contact as $item)
                    <!-- Contact Info Start -->
                    <div class="row contact--info">
                        <h2 class="h2 widget--title">{{($item->country == 'aus')? 'Australia' : 'Nepal'}}</h2>
                        <div class="col-md-3">
                            <div class="title">
                                <h3 class="h5"><i class="fa fa-phone-square"></i>Telephone</h3>
                            </div>
    
                            <div class="content">
                                <p>{{$item->phone}}</p>
                                <p>{{$item->phone2}}</p>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="title">
                                <h3 class="h5"><i class="fa fa-envelope-open"></i>E-mail Address</h3>
                            </div>

                            <div class="content">
                                <p>{{$item->email}}</p>
                                <p>{{$item->email2}}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="title">
                                <h3 class="h5"><i class="fa fa-map-marker"></i>Address</h3>
                            </div>

                            <div class="content">
                                <p>{{$item->address}}</p>
                                <p>{{$item->address2}}</p>
                            </div>
                        </div>
                       
                    </div>
                    <!-- Contact Info End -->
                        
                    @endforeach

                </div>

                <div class="col-md-6 col-sm-8 ptop--30 pbottom--30">
                    @if (Session::has('message'))
                        <div class="alert alert-info">{{ Session::get('message') }}</div>
                    @endif
                    <!-- Comment Form Start -->
                    <div class="comment--form">
                        <div class="comment-respond">
                            <form action="{{route('support.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <h3>Support</h3>
                                    <div class="col-xs-6 col-xxs-12">
                                        <label>
                                            <span>Name *</span>
                                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" required>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror 
                                        </label>

                                        <label>
                                            <span>Email Address *</span>
                                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" required>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror 
                                        </label>
                                        <label>
                                            <span>Phone No. </span>
                                            <input type="number" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" >                                           
                                            @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror 
                                        </label>
                                    </div>
                                    <div class="col-xs-6 col-xxs-12">
                                        <label>
                                            <span>Message *</span>
                                            <textarea name="comment" class="form-control @error('comment') is-invalid @enderror" required></textarea>
                                            @error('comment')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror 
                                        </label>
                                    </div>

                                    <div class="col-md-12 text-right">
                                        <button type="submit" class="btn btn-primary">Send Message</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Comment Form End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Contact Section End -->
@endsection
@section('scripts')
<script>
    $("document").ready(function(){
        setTimeout(function(){
           $(".alert-info").remove();
        }, 2000 ); // 5 secs   
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