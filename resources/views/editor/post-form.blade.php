@extends('layouts.editor')
@section('title','FSTV| Posts')

@section('content')

<div class="container-fluid">
					
    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
          <h5 class="txt-dark">Posts Elements</h5>
        </div>
    </div>
    <!-- /Title -->
    
    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view col-md-8">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Posts {{ isset($post_detail)? 'Update' : 'Add' }} form</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="form-wrap">
                            @if(isset($post_detail))
                                {{ Form::open(['url'=>route('post.update', @$post_detail->id),'id'=>"uploadform", 'files'=>true, 'class'=> 'form']) }}
                                @method('put')
                            @else
                                {{ Form::open(['url'=>route('post.store'), 'files'=>true, 'class'=> 'form', 'id'=>"uploadform"]) }}
                            @endif
        
        
                            <div class="form-group row">
                                {{ Form::label('title','Title* : ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::text('title', @$post_detail->title, ['class'=>'form-control form-control-sm', 'id'=>'title', 'placeholder'=>'Enter title...', 'require'=>true]) }}
                                    @error('title')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                {{ Form::label('subtitle','Sub-title: ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::text('subtitle', @$post_detail->subtitle, ['class'=>'form-control form-control-sm', 'id'=>'subtitle', 'placeholder'=>'Enter subtitle...', 'require'=>false]) }}
                                    @error('subtitle')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                {{ Form::label('cat_id','Category* : ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::select('cat_id',$parent_cats,@$post_detail->cat_id, ['id'=>'cat_id', 'require'=>true, 'class'=>'form-control form-control-sm','placeholder'=>'--Select any one--']) }}
                                    @error('cat_id')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row " id="sub_cat_div">
                                {{ Form::label('sub_cat_id','Child Category: ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::select('sub_cat_id',[],@$post_detail->sub_cat_id, ['id'=>'sub_cat_id', 'require'=>false, 'class'=>'form-control form-control-sm','placeholder'=>'--Select any one--']) }}
                                    @error('sub_cat_id')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                {{ Form::label('detail','Descriptions: ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::textarea('detail', html_entity_decode(@$post_detail->detail), ['class'=>'form-control', 'id'=>'detail', 'placeholder'=>'Enter Category detail...', 'require'=>true, 'style'=>'resize: none;', 'rows' =>'5']) }}
                                  @error('detail')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                {{ Form::label('status','Status* : ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::select('status',['inactive'=>'Unpublish'],@$post_detail->status, ['disabled', 'id'=>'status', 'require'=>false, 'class'=>'form-control form-control-sm']) }}
                                    @error('status')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                {{ Form::label('is_trending','Make Trending: ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::checkbox('is_trending',1, @$post_detail->is_trending, ['id'=>'is_trending']) }}
                                    Yes
                                    @error('is_trending')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        
                            <div class="form-group row">
                                {{ Form::label('image', '',['class'=>'col-sm-3']) }}
                                <div class="col-sm-4">
                                    {{ Form::file('image', ['id'=>'image', 'required'=>(isset($post_detail)? false: true), 'accept'=>'image/*'])}} 
                                  @error('image')
                                    <span class="alert-danger">{{ $message }} Upload validate format</span>
                                    @enderror
                                </div>
                                <div class="col-sm-4">
                                    <div class="thumbnail {{(isset($post_detail)? '': 'hidden')}}" id="view" >
                                        <span class="close">&times;</span>
                                        @if (isset($post_detail))
                                        @if (file_exists(public_path().'/upload/post/'.$post_detail->image))
                                        <img id="old" src="{{ asset('/upload/post/'.$post_detail->image) }}">
                                        @endif
                                        @else
                                        @endif
                                        <img src="" id="preview">  
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
            
                $('#view').removeClass('hidden');
            reader.onload = function (e) {
                $('#preview').attr('src', e.target.result);
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
    $('#cat_id').change(function () {
            let cat_id = $(this).val();
            let sub_cat_id = "{{ isset($post_detail) ? $post_detail->sub_cat_id : null }}";

            $.ajax({
                url: "{{ route('get-Child-Cats') }}",
                type: "post",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "cat_id": cat_id
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
                            if (sub_cat_id != null && sub_cat_id == value.id){
                                html_option += ' selected ';
                            }
                            html_option += ">" + value.title + "</option>"
                        });

                        $('#sub_cat_div').removeClass('hidden');
                    } else {
                        //child category do not exists
                        $('#sub_cat_div').addClass('hidden');
                    }

                    $('#sub_cat_id').html(html_option)
                }
            });
        });
        $('#cat_id').change();
</script>

<script>
    tinymce.init({
        selector: '#detail'
    });
</script>

@endsection
