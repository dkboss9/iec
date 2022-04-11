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
                <li class="active"><span>{{$program->title}} Participant Form</span></li>
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
                <div class="col-md-12 col-sm-12 ptop--30 pbottom--60">
                    @if (Session::has('message'))

                        <div class="alert alert-info">{{ Session::get('message') }}</div>
                    @endif
                    <!-- Comment Form Start -->
                    <div class="comment--form">
                        <div class="comment-respond">
                            <form action="{{route('participant-save')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <h3>Please input with (*) are compulsory!!    </h3>
                                    <input type="hidden" name="program_id" id="program_id" value="{{$program->id}}">
                                    <div class="col-xs-6 col-xxs-12">
                                        <label>
                                            <span>Full Name *</span>
                                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" required value="{{old('name')}}">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror 
                                        </label>

                                        <label>
                                            <span>Email Address *</span>
                                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" required value="{{old('email')}}">
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
                                                    <input type="date" name="dob" id="dob" class="form-control @error('dob') is-invalid @enderror" required value="{{old('dob')}}" >                                           
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
                                                    <input type="number" name="phone" id="phone" minlength="9" maxlength="13" class="form-control @error('phone') is-invalid @enderror" value="{{old('phone')}}" >                                           
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
                                            <input type="text" name="state" id="state" class="form-control @error('state') is-invalid @enderror" required value="{{old('state')}}" >                                           
                                            @error('state')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror 
                                        </label>    
                                        <label>
                                            <span>City*. </span>
                                            <input type="text" name="city" id="city" class="form-control @error('city') is-invalid @enderror" required value="{{old('city')}}" >                                           
                                            @error('city')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror 
                                        </label>    
                                        <label>
                                            <span>Address*. </span>
                                            <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" required value="{{old('address')}}" >                                           
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
                                            <textarea name="talent" class="form-control @error('talent') is-invalid @enderror" required>{{@old('talent')}}</textarea>
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
                                            <span>Identification Type*.</span>
                                            <select class="form-control" name="identification_type" id="identification_type">
                                                <option value="">Select Identification Type</option>
                                                <option value="citizenship">CitizenShip</option>
                                                <option value="passport">Passport</option>
                                                <option value="license">Licensed</option>
                                                <option value="birth_certificate">Birth Certificate</option>
                                            </select>
                                            {{-- <input type="file" id="identification" name="identification[]" class="form-control @error('identification') is-invalid @enderror" multiple='2' accept="image/*" required> --}}
                                            @error('identification')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror 
                                        </label>
                                        <label>
                                            <span>Identity*.</span>
                                            <input type="file" id="identification" name="identification[]" class="form-control @error('identification') is-invalid @enderror" multiple='2' accept="image/*" required>
                                            @error('identification')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror 
                                        </label>
                                        <div class="form-control clear text-right btn hidden" id="clea">Clear &times;</div>
                                        <div class="form-group row">
                                            <div class="row" id="preview_img"></div>
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

                                    <div class="col-md-12 text-center">
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
    $(document).ready(function(){
        $('.clear').on('click', function() { 
            $('#identification').val('');  
            $('#clea').addClass('hidden');  
            $("#preview_img img:last-child").remove()
        });
    });
</script>
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
        $('#image').val('');
        $('#preview').removeAttr('src');
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#identification').on('change', function(){ //on file input change
        if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
        {

            var data = $(this)[0].files; //this file data

            $.each(data, function(index, file){ //loop though each file
                if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                    var fRead = new FileReader(); //new filereader
                    fRead.onload = (function(file){ //trigger function on successful read
                    return function(e) {
                        var img = $('<img/>').addClass('pp thumb col-xs-6 col-xxs-12').attr({
                            src: e.target.result,
                            height: "200px;"
                        }); //create image element 
                        $('#preview_img').append(img); //append image to output element
                    };
                    })(file);
                    fRead.readAsDataURL(file); //URL representing the file's data.
                }
            });
            $('#clea').removeClass('hidden');
            $('#preview_img').show();
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
        }, 5000 ); // 5 secs   
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