@extends('layouts.admin')
@section('title','Media')

@section('content')

<div class="container-fluid">
					
    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
          <h5 class="txt-dark">Media Elements</h5>
        </div>
    </div>
    <!-- /Title -->
    
    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view col-md-8">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Media {{ isset($media_detail)? 'Update' : 'Add' }} form</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="form-wrap">
                            @if(isset($media_detail))
                                {{ Form::open(['url'=>route('media.update', @$media_detail->id),'id'=>"uploadform", 'files'=>true, 'class'=> 'form']) }}
                                @method('put')
                            @else
                                {{ Form::open(['url'=>route('media.store'), 'files'=>true, 'class'=> 'form', 'id'=>"uploadform"]) }}
                            @endif
        
        
                            <div class="form-group row">
                                {{ Form::label('title','Title: ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::text('title', @$media_detail->title, ['class'=>'form-control form-control-sm', 'id'=>'title', 'placeholder'=>'Enter title...', 'require'=>true]) }}
                                    @error('title')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>                                                       
                            <div class="form-group row">
                                {{ Form::label('subtitle','Sub-title: ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::text('subtitle', @$media_detail->subtitle, ['class'=>'form-control form-control-sm', 'id'=>'subtitle', 'placeholder'=>'Enter subtitle...', 'require'=>false]) }}
                                    @error('subtitle')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                {{ Form::label('detail','Descriptions: ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::textarea('detail', @$media_detail->detail, ['class'=>'form-control', 'id'=>'detail', 'placeholder'=>'Enter Category detail...', 'require'=>false, 'style'=>'resize: none;', 'rows' =>'5']) }}
                                </div>
                            </div>
                            {{-- <div class="form-group row">
                                {{ Form::label('author_id','Author: ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::select('author_id',$author_info,@$media_detail->author_id, ['id'=>'author_id', 'require'=>false, 'class'=>'form-control form-control-sm','placeholder'=>'<--Select any one-->']) }}
                                    @error('author_id')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                {{ Form::label('contributor_id','Contributor: ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::select('contributor_id',$contributor_info,@$media_detail->contributor_id, ['id'=>'contributor_id', 'require'=>false, 'class'=>'form-control form-control-sm','placeholder'=>'<--Select any one-->']) }}
                                    @error('contributor_id')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div> --}}

                            <div class="form-group row">
                                {{ Form::label('link','Link: ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::url('link', @$media_detail->link, ['class'=>'form-control form-control-sm', 'id'=>'link', 'placeholder'=>'Enter Media link...', 'require'=>false]) }}
                                    @error('link')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                {{ Form::label('video', '',['class'=>'col-sm-3']) }}
                                <div class="col-sm-4">
                                    {{ Form::file('video', ['id'=>'video', 'required'=>false, 'accept'=>'file'])}} 
                                  @error('video')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-4">
                                    <div class="thumbnail {{(isset($post_detail)? '': 'hidden')}}" id="view" >
                                        <span class="close">&times;</span>
                                        @if (isset($media_detail))
                                        @if (file_exists(public_path().'/upload/media/'.$media_detail->video))
                                        <video src="{{ asset('/upload/media/'.$media_detail->video) }}" height="200" width="300">
                                        </video>
                                        {{-- <img id="old" src="{{ asset('/upload/media/'.$media_detail->video) }}"> --}}
                                        @endif
                                        @endif
                                        <img src="" id="preview" alt="Preview">  
                                    </div>
                                </div>                               
                            </div>
        
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
    $("#thumbnail").change(function(){
        readURL(this);
    });

    $(document).on('click', '.close', function() {
        $(this).parent().remove();
    });
</script>
<script>
    tinymce.init({
        selector: '#detail'
    });
</script>
@endsection
