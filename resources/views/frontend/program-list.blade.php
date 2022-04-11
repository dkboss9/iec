@extends('layouts.frontend')
@section('title')
    Program list
@endsection
@section('content')

    <!-- Main Breadcrumb Start -->
    <div class="main--breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{route('homepage')}}" class="btn-link"><i class="fa fm fa-home"></i>Home</a></li>
                <li class="active"><span>Program Participant Form</span></li>
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
                <div class="col-md-12 col-sm-12 ptop--30 pbottom--30">
                    @if (Session::has('message'))
                        <div class="alert alert-info">{{ Session::get('message') }}</div>
                    @endif
                    <!-- Comment Form Start -->
                    <div class="comment--form">
                        <div class="comment-respond">
                            <form action="{{route('support.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <h3>Please input with (*) are compulsory!!    </h3>
                                    <div class="col-xs-6 col-xxs-12">
                                        <label>
                                            <span>Full Name *</span>
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
                                        <div class="row">
                                            <div class="col-xs-6 col-xxs-12">
                                                <label>
                                                    <span>Birth Date*: </span>
                                                    <input type="date" name="dob" id="dob" class="form-control @error('dob') is-invalid @enderror" >                                           
                                                    @error('dob')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror 
                                                </label>
                                            </div>
                                            <div class="col-xs-6 col-xxs-12">
                                                <label>
                                                    <span>Contact No*. </span>
                                                    <input type="number" name="phone" id="phone" min="1" maxlength="13" minlength="9" class="form-control @error('phone') is-invalid @enderror" >                                           
                                                    @error('phone')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror 
                                                </label>
                                            </div>
                                        </div> 
                                        <label>
                                            <span>State*. </span>
                                            <input type="text" name="state" id="state" class="form-control @error('state') is-invalid @enderror" >                                           
                                            @error('state')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror 
                                        </label>    
                                        <label>
                                            <span>City*. </span>
                                            <input type="text" name="city" id="city" class="form-control @error('city') is-invalid @enderror" >                                           
                                            @error('city')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror 
                                        </label>    
                                        <label>
                                            <span>Address*. </span>
                                            <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" >                                           
                                            @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror 
                                        </label>                                  
                                    </div>
                                    <div class="col-xs-6 col-xxs-12">
                                        <label>
                                            <span>Talent Detail*.</span>
                                            <textarea name="talent" class="form-control @error('talent') is-invalid @enderror" required></textarea>
                                            @error('talent')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror 
                                        </label>
                                        <div class="row">
                                            <div class="col-xs-6 col-xxs-12">
                                                <label>
                                                    <span>Photo*.</span>
                                                    <input type="file" id="image" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*" required>
                                                    @error('image')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror 
                                                </label>
                                            </div>
                                            <div class="col-xs-6 col-xxs-12">
                                                <div class="thumbnail {{(isset($participant_detail)? '': 'hidden')}}" id="view" >
                                                    <span class="close">&times;</span>
                                                    @if (isset($participant_detail->image))
                                                    @if (file_exists(public_path().'/upload/participant/'.$participant_detail->image))
                                                    <img id="old" src="{{ asset('/upload/participant/'.$participant_detail->image) }}">
                                                    @endif
                                                    @endif
                                                    <img src="" id="preview">  
                                                </div>
                                            </div>
                                        </div>
                                        <label>
                                            <span>Nationality*.</span>
                                            <input type="file" id="nationality" name="nationality[]" class="form-control @error('nationality') is-invalid @enderror" multiple='' accept="image/*" required>
                                            @error('nationality')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror 
                                        </label>
                                        <div class="form-group row" id="preview_img">
                                        </div>
                                        
                                        <label>
                                            <span>Video*.</span>
                                            <input type="file" id="video" name="video" class="form-control @error('video') is-invalid @enderror" accept="video/mp4,video/x-m4v,video/*" required>
                                            @error('video')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror 
                                        </label>
                                    </div>

                                    <div class="col-md-12 text-right">
                                        <button type="submit" class="btn btn-primary">Submit</button>
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
    dob.max = new Date().toISOString().split("T")[0];
</script>
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#preview').attr('src', e.target.result);
                $('#view').removeClass('hidden');
                $('#old').remove();
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#image").change(function(){
        readURL(this);
    });

    $(document).on('click', '.close', function() {
        $(this).parent().remove();
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#nationality').on('change', function(){ //on file input change
        if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
        {

            var data = $(this)[0].files; //this file data

            $.each(data, function(index, file){ //loop though each file
                if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                    var fRead = new FileReader(); //new filereader
                    fRead.onload = (function(file){ //trigger function on successful read
                    return function(e) {
                        var img = $('<img/>').addClass('thumb col-xs-6 col-xxs-12').attr({
                            src: e.target.result,
                            height: "200px;"
                        }); //create image element 
                        $('#preview_img').append(img); //append image to output element
                    };
                    })(file);
                    fRead.readAsDataURL(file); //URL representing the file's data.
                }
            });
            $("#pvalue").hide();
                
        }else{
            alert("Your browser doesn't support File API!"); //if File API is absent
        }
        });
    });
</script>
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