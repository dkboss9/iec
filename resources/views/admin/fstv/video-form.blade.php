@extends('layouts.admin')
@section('title','Videos')

@section('content')

<div class="container-fluid">
					
    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
          <h5 class="txt-dark">Fstv Videos Elements</h5>
        </div>
    </div>
    <!-- /Title -->
    
    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view col-md-8">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">FSTV Videos {{ isset($video_detail)? 'Update' : 'Add' }} form</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                {{-- @if ($errors->any())
                    <ul>{!! implode('', $errors->all('<li style="color:red">:message</li>')) !!}</ul>
                @endif --}}
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">

                        <div class="form-wrap">
                            @if(isset($video_detail))
                                {{ Form::open(['url'=>route('video.update', @$video_detail->id),'id'=>"uploadform", 'files'=>true, 'class'=> 'form']) }}
                                @method('put')
                            @else
                                {{ Form::open(['url'=>route('video.store'), 'files'=>true, 'class'=> 'form', 'id'=>"uploadform"]) }}
                            @endif
        
        
                            <div class="form-group row">
                                {{ Form::label('title','Title* : ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::text('title', @$video_detail->title, ['class'=>'form-control form-control-sm', 'id'=>'title', 'placeholder'=>'Enter title...', 'require'=>true]) }}
                                    @error('title')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                {{ Form::label('subtitle','Sub-title: ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::text('subtitle', @$video_detail->subtitle, ['class'=>'form-control form-control-sm', 'id'=>'subtitle', 'placeholder'=>'Enter subtitle...', 'require'=>false]) }}
                                    @error('subtitle')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                {{ Form::label('menu_id','Category* : ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::select('menu_id',$menu_info,@$video_detail->menu_id, ['id'=>'menu_id', 'require'=>true, 'class'=>'form-control form-control-sm','placeholder'=>'--Select any one--']) }}
                                    @error('menu_id')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row" id="sub_menu_div">
                                {{ Form::label('submenu_id','Sub Category* : ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{-- <input type="select" id="submenu_id"  value="{{@$video_detail->submenu_id}}"> --}}
                                    {{Form::select('submenu_id',[],@$video_detail->submenu_id, ['id'=>'submenu_id', 'require'=>false, 'class'=>'form-control form-control-sm','placeholder'=>'--Select any one--']) }}
                                    @error('submenu_id')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                           
                            <div class="form-group row" id="child_menu_div">
                                {{ Form::label('childmenu_id','Child Category: ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::select('childmenu_id',[], @$video_detail->childmenu_id, ['id'=>'childmenu_id', 'require'=>false, 'class'=>'form-control form-control-sm','placeholder'=>'--Select any one--']) }}
                                    @error('childmenu_id')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                                                        
                            <div class="form-group row">
                                {{ Form::label('detail','Descriptions: ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::textarea('detail', html_entity_decode(@$video_detail->detail), ['class'=>'form-control', 'id'=>'detail', 'placeholder'=>'Enter Category detail...', 'require'=>true, 'style'=>'resize: none;', 'rows' =>'5']) }}
                                  @error('detail')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                {{ Form::label('tags','Tags: ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    @if (@$video_detail)
                                    <input class="form-control form-control-sm" name="tags" data-role="tagsinput" id="input-tags" value=" 
                                        @foreach(@$video_detail->tags as $tag)
                                            {{ $tag['name'].',' }}
                                        @endforeach " 
                                    style="width:500px !important" />
                                    @else
                                    <input class="form-control form-control-sm" name="tags" data-role="tagsinput" id="input-tags" style="width:500px !important" />    
                                    @endif

                                    {{-- {{Form::text('tags', , ['id'=>'input-tags', 'data-role'=>'tagsinput', 'require'=>false, 'class'=>'form-control form-control-sm']) }} --}}
                                    @error('tags')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                {{ Form::label('status','Status* : ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::select('status',['active'=>'Publish', 'inactive'=>'Unpublish'],@$video_detail->status, ['id'=>'status', 'require'=>true, 'class'=>'form-control form-control-sm']) }}
                                    @error('status')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                          <div class="form-group row">                                
                                {{ Form::label('notify','Send Notification: ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{ Form::checkbox('notify', 'yes', true) }}
                                    Yes
                                    @error('notify')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                {{ Form::label('is_trending','Make Trending: ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::checkbox('is_trending',1, @$video_detail->is_trending, ['id'=>'is_trending']) }}                                    
                                    Yes
                                    @error('is_trending')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                {{ Form::label('date','Schedule-date : ',['class'=>'col-sm-3']) }}
                                <div class="col-md-9" id="datetimepicker1">
                                    {{ Form::date('date', @$video_detail->date, ['id'=>'date','min'=> Carbon\Carbon::tomorrow(), 'require'=>false, 'class'=>'form-control form-control-sm']) }}                                
                                    @error('date')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            @if (isset($video_detail))
                                @if ($video_detail->link)
                                <div class="form-group row">
                                    {{ Form::label('link','Link: ',['class'=>'col-sm-3']) }}
                                    <div class="col-sm-9">
                                        {{Form::url('link', @$video_detail->link, ['class'=>'form-control form-control-sm', 'id'=>'link', 'placeholder'=>'Enter Media link...']) }}
                                        @error('link')
                                        <span class="alert-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                @elseif($video_detail->video)
                                <div class="form-group row">
                                    {{ Form::label('video', 'Video: ',['class'=>'col-sm-3']) }}
                                    <div class="col-sm-4">
                                        {{ Form::file('video', ['id'=>'video', 'accept'=>'video/mp4,video/x-m4v,video/*'])}} 
                                    @error('video')
                                        <span class="alert-danger">{{ $message }}</span>
                                        @enderror
                                    </div>                                
                                </div>
                                @endif                              
                            @else
                            <div class="form-group row" id="lin">
                                {{ Form::label('link','Link: ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::url('link', '',['class'=>'form-control form-control-sm', 'id'=>'link', 'placeholder'=>'Enter Media link...']) }}
                                    @error('link')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row" id="vido">
                                {{ Form::label('video', '',['class'=>'col-sm-3']) }}
                                <div class="col-sm-4">
                                    {{ Form::file('video', @$video_detail->video,['id'=>'video', 'accept'=>'video/mp4,video/x-m4v,video/*'])}} 
                                  @error('video')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>                                
                            </div>

                            @endif

                            <div class="form-group row">
                                {{ Form::label('', 'Video Thumbnail* :',['class'=>'col-sm-3']) }}
                                <div class="col-sm-4">
                                    {{ Form::file('image', ['id'=>'image', 'required'=>(isset($video_detail->image)? false : true), 'accept'=>'image/*'])}}
                                    @error('image')
                                     <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-4">
                                    <div class="thumbnail {{(isset($video_detail)? '': 'hidden')}}" id="view" >
                                        <span class="close">&times;</span>
                                        @if (isset($video_detail->image))
                                        @if (file_exists(public_path().'/upload/fstv/video/'.$video_detail->image))
                                            <img id="old" src="{{ asset('/upload/fstv/video/'.$video_detail->image) }}">
                                        @else
                                        @endif  
                                        @endif
                                            <img src="" id="preview">  
                                    </div>
                                </div>                               
                            </div>   
                                    
                            <div class="form-group row">
                                {{ Form::label('','',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{ Form::button("<i class='fa fa-recycle'></i> Reset", ['class'=>'btn btn-danger','type'=>'reset', 'onClick'=> 'window.location.reload()']) }}
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
        $("#link").keyup(function(e){
            e.preventDefault();
            let key = $('#link').val();
            f = key != '' ? $("#vido").hide() : '';         
        });
       
    });
</script>
<script type="text/javascript">
$(function() {
  $("#vido").change(function(){
    let key = $("input:file", this).val();
    f = key != '' ? $("#lin").hide() : ''; 
  });
});
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

<script>
    $('#menu_id').change(function () {
        let menu_id = $(this).val();
        let submenu_id = "{{ isset($video_detail) ? $video_detail->submenu_id : null }}";

        $.ajax({
            url: "{{ route('get-submenu') }}",
            type: "post",
            data: {
                "_token": "{{ csrf_token() }}",
                "menu_id": menu_id
            },
            success: function (response) {
                if (typeof (response) != 'object') {
                    response = $.parseJSON(response);
                }

                var html_option = "<option value='' selected>--Select Any One--</option>"
                if (response.status) {
                    //child category exists
                    $.each(response.data, function (key, value) {

                        html_option += "<option value='"+value.id+"' ";
                        if (submenu_id != null && submenu_id == value.id){
                            html_option += ' selected ';
                        }
                        html_option += ">" + value.title + "</option>"
                    });

                    $('#sub_menu_div').removeClass('hidden');
                } else {
                    //child category do not exists
                    $('#sub_menu_div').addClass('hidden');
                }

                $('#submenu_id').html(html_option)
            }
        });
    });
    $('#menu_id').change();
</script>
<script>
    $('#submenu_id').change(function () {

        let submenu_id = "{{ isset($video_detail) ? $video_detail->submenu_id : '' }}";
        submenu_id = submenu_id != '' ? submenu_id : $(this).val(); 
        let childmenu_id = "{{ isset($video_detail) ? $video_detail->childmenu_id : null }}";


        $.ajax({
            url: "{{ route('get-childmenu') }}",
            type: "post",
            data: {
                "_token": "{{ csrf_token() }}",
                "submenu_id": submenu_id
            },
            success: function (response) {
                if (typeof (response) != 'object') {
                    response = $.parseJSON(response);
                }

                var html_option = "<option value='' selected>--Select Any One--</option>"
                if (response.status) {
                    //child category exists
                    $.each(response.data, function (key, value) {

                        html_option += "<option value='"+value.id+"' ";
                        if (childmenu_id != null && childmenu_id == value.id){
                            html_option += ' selected ';
                        }
                        html_option += ">" + value.title + "</option>"
                    });

                    $('#child_menu_div').removeClass('hidden');
                } else {
                    //child category do not exists
                    $('#child_menu_div').addClass('hidden');
                }

                $('#childmenu_id').html(html_option)
            }
        });
    });
    $('#submenu_id').change();
</script>
<script>
    tinymce.init({
        selector: '#detail'
    });
</script>
<script type="text/javascript">
	$('#input-tags').tagsInput();
</script>
@endsection
