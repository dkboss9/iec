@extends('layouts.admin')
@section('title','Programs')


@section('content')

<div class="container-fluid">
					
    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
          <h5 class="txt-dark">Programs Elements</h5>
        </div>
    </div>
    <!-- /Title -->
    
    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view col-md-8">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Programs {{ isset($participant_detail)? 'Update' : 'Add' }} form</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="form-wrap">
                            @if(isset($participant_detail))
                                {{ Form::open(['url'=>route('participant.update', @$participant_detail->id),'id'=>"uploadform", 'files'=>true, 'class'=> 'form']) }}
                                @method('put')
                            @else
                                {{ Form::open(['url'=>route('participant.store'), 'files'=>true, 'class'=> 'form', 'id'=>"uploadform"]) }}
                            @endif
        
        
                            <div class="form-group row">
                                {{ Form::label('program_id','Program* : ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::select('program_id',$program, @$participant_detail->program_id, ['id'=>'program_id', 'required'=>true, 'class'=>'form-control form-control-sm','placeholder'=>'--Select any one--']) }}
                                    @error('program_id')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                {{ Form::label('name','Full Name* : ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::text('name', @$participant_detail->name, ['class'=>'form-control form-control-sm', 'id'=>'name', 'placeholder'=>'Enter name...', 'required'=>true]) }}
                                    @error('name')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                {{ Form::label('email','Email Address* : ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::email('email', @$participant_detail->email, ['class'=>'form-control form-control-sm', 'id'=>'email', 'placeholder'=>'Enter email address...', 'required'=>true]) }}
                                    @error('email')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                {{ Form::label('state','State* : ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::text('state', @$participant_detail->state, ['class'=>'form-control form-control-sm', 'id'=>'state', 'placeholder'=>'Enter state...', 'required'=>true]) }}
                                    @error('state')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                {{ Form::label('city','City* : ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::text('city', @$participant_detail->city, ['class'=>'form-control form-control-sm', 'id'=>'city', 'placeholder'=>'Enter city...', 'required'=>true]) }}
                                    @error('city')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                {{ Form::label('address','Address* : ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::text('address', @$participant_detail->address, ['class'=>'form-control form-control-sm', 'id'=>'address', 'placeholder'=>'Enter address...', 'required'=>true]) }}
                                    @error('address')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                {{ Form::label('phone','Contact No.* : ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::text('phone', @$participant_detail->phone, ['class'=>'form-control form-control-sm', 'id'=>'phone', 'placeholder'=>'Enter phone...', 'required'=>true]) }}
                                    @error('phone')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>                            
                            <div class="form-group row">
                                {{ Form::label('talent','Talent Detail*: ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::textarea('talent', html_entity_decode(@$participant_detail->talent), ['class'=>'form-control', 'id'=>'talent', 'placeholder'=>'Enter Programs talent...', 'require'=>true, 'style'=>'resize: none;', 'rows' =>'5']) }}
                                  @error('talent')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                {{ Form::label('dob','Birth Date*: ',['class'=>'col-sm-3']) }}
                                <div class="col-md-9">
                                    {{ Form::input('date',  'dob', date('Y-m-d', strtotime(@$participant->dob)),['id'=>'dob', 'max'=>\Carbon\Carbon::now(), 'required'=>true, 'class'=>'form-control form-control-sm'] ) }}
                                    @error('dob')
                                <span class="alert-danger">{{ $message }}</span>
                                @enderror                                        
                                </div>
                            </div>        
                            <div class="form-group row">
                                {{ Form::label('status','Status: ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::select('status',['active'=>'Publish', 'inactive'=>'Unpublish'],@$participant_detail->status, ['id'=>'status', 'required'=>true, 'class'=>'form-control form-control-sm']) }}
                                    @error('status')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>     
                            <div class="form-group row">
                                {{ Form::label('image', 'Photo*:',['class'=>'col-sm-3']) }}
                                <div class="col-sm-4">
                                    {{ Form::file('image', ['id'=>'image', 'required'=>(isset($participant_detail->image)? false: true), 'class'=>'form-control', 'accept'=>'image/*'])}} 
                                    @error('image')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-4">
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
                            
                            <div class="form-group row">
                                {{ Form::label('identification_type','Identification Type* : ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::select('identification_type',[
                                        'citizenship'=>'Citizenship', 
                                        'passport'=>'Passport',
                                        'license'=>'License',
                                        'birth_certificate'=>'Birth Certificate',
                                    ],@$participant_detail->identification_type, ['id'=>'identification_type', 'required'=>true, 'placeholder'=>'Select any one','class'=>'form-control form-control-sm']) }}
                                    @error('identification_type')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>   
                            <div class="form-group row">
                                {{ Form::label('identification', 'Identity*:',['class'=>'col-sm-3']) }}
                                <div class="col-sm-4">
                                    {{ Form::file('identification[]', ['id'=>'identification', 'required'=>(isset($participant_detail->identification)? false: true), 'multiple'=> 2, 'class'=>'form-control', 'accept'=>'image/*'])}} 
                                    @error('identification')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group clear btn btn-primary hide" id="clea">Clear &times;</div>
                            </div>                             
                            
                            <div class="form-group row" id="preview_img"></div>
                            @if (@$participant_detail)
                                <div class="form-group row thumb" id="pvalue">
                                    @php
                                        $array = explode("|", $participant_detail->identification);
                                    @endphp
                                    @foreach ($array as $item)
                                        <a target="blank_" href="{{ asset('upload/participant/'.$item) }}">
                                            <img src="{{ asset('upload/participant/'.$item) }}" style="max-height:200px;" alt="">
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                            {{-- <div class="form-group row" id="preview_img">
                            </div>    --}}
                            
                            <div class="form-group row">
                                {{ Form::label('video', 'Video*:',['class'=>'col-sm-3']) }}
                                <div class="col-sm-4">
                                    {{ Form::file('video', ['id'=>'video', 'require'=>(isset($participant_detail->video)? false: true), 'class'=>'form-control', 'accept'=>'video/mp4,video/x-m4v,video/*'])}} 
                                    @error('video')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                @if (@$participant_detail->video != null)
                                <div class="col-sm-4">
                                    <div class=" {{(isset($participant_detail->video)? '': 'hidden')}}" id="view" >
                                       <a href="{{route('download-video',@$participant_detail->video)}}" class="btn btn-primary">Preview</a>
                                    </div>
                                </div>  
                                @endif
                            </div>
                            @if (@$participant_detail->video != null)
                                <div class="form-group row hide">
                                    <div class="card-footer p-4 form-group" >
                                        <video id="videoPreview" src="{{isset($participant_detail)? asset('upload/program-participate/'.$participant_detail->video) : ''}}" controls="controls" style="width: 100%; height: auto"></video>
                                    </div>
                                </div>
                            @endif
                            
                            <div class="form-group row">
                                {{ Form::label('','',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{ Form::button("<i class='fa fa-trash'></i> Reset", ['class'=>'btn btn-danger','type'=>'reset']) }}
                                    {{ Form::button("<i class='fa fa-paper-plane'></i> Submit", ['class'=>'btn btn-success','type'=>'submit']) }}
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>            
        </div>
    </div>
    <!-- /Row -->
    
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function(){
        $('.clear').on('click', function() { 
            $('#identification').val('');  
            $('#clea').addClass('hide');  
            $("#preview_img img:last-child").remove();   
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
                        var img = $('<img/>').addClass('thumb').attr({
                            src: e.target.result,
                            width: '50%',
                            height: "200px;"
                        }); //create image element 
                        $('#preview_img').append(img); //append image to output element
                    };
                    })(file);
                    fRead.readAsDataURL(file); //URL representing the file's data.
                }
            });
            $('#clea').removeClass('hide');
            $("#pvalue").hide();
                
        }else{
            alert("Your browser doesn't support File API!"); //if File API is absent
        }
        });
    });
</script>
{{-- <script src="https://cdn.jsdelivr.net/npm/resumablejs@1.1.0/resumable.min.js"></script>

<script type="text/javascript">
    let browseFile = $('#browseFile');
    let resumable = new Resumable({
        target: '{{ route('upload-file') }}',
        query:{_token:'{{ csrf_token() }}', 'vid':'{{isset($participant_detail)?@$participant_detail->video : ''}}'} ,// CSRF token
        fileType: ['mp4'],
        headers: {
            'Accept' : 'application/json'
        },
        testChunks: false,
        throttleProgressCallbacks: 1,
    });

    resumable.assignBrowse(browseFile[0]);

    resumable.on('fileAdded', function (file) { // trigger when file picked
        showProgress();
        resumable.upload() // to actually start uploading.
    });

    resumable.on('fileProgress', function (file) { // trigger when file progress update
        updateProgress(Math.floor(file.progress() * 100));
    });

    resumable.on('fileSuccess', function (file, response) { // trigger when file upload complete
        response = JSON.parse(response)
        $('#videoPreview').attr('src', response.path);
        // $("#video").val(response.filename);
        $('.card-footer').show();
    });

    resumable.on('fileError', function (file, response) { // trigger when there is any error
        alert(response);
    });


    let progress = $('.progress');
    function showProgress() {
        progress.find('.progress-bar').css('width', '0%');
        progress.find('.progress-bar').html('0%');
        progress.find('.progress-bar').removeClass('bg-success');
        progress.show();
    }

    function updateProgress(value) {
        progress.find('.progress-bar').css('width', `${value}%`)
        progress.find('.progress-bar').html(`${value}%`)
    }

    function hideProgress() {
        progress.hide();
    }
</script> --}}
<script>
    tinymce.init({
        selector: '#talent'
    });
</script>
@endsection
