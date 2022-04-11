@extends('layouts.admin')
@section('title','Question')

@section('content')

<div class="container-fluid">
					
    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
          <h5 class="txt-dark">Question Elements</h5>
        </div>
    </div>
    <!-- /Title -->
    
    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view col-md-8">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Question {{ isset($question_detail)? 'Update' : 'Add' }} form</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="form-wrap">
                            @if(isset($question_detail))
                                {{ Form::open(['url'=>route('quiz_question/update', @$question_detail->id),'id'=>"uploadform", 'files'=>true, 'class'=> 'form']) }}
                                @method('put')
                            @else
                                {{ Form::open(['url'=>route('quiz_question/store'), 'files'=>true, 'class'=> 'form', 'id'=>"uploadform"]) }}
                            @endif
        
                            
                             <div class="form-group row">
                                {{ Form::label('program','Program* : ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                {!! Form::select('program',  $quiz_programs, @$question_detail->program, ['class' => 'form-control']) !!}
                                    @error('program')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div> 
                            <div class="form-group row">
                                {{ Form::label('q_title','Question* : ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::textarea('title', @$question_detail->title, ['class'=>'form-control form-control-sm', 'id'=>'title', 'placeholder'=>'Enter question...', '']) }}
                                    @error('title')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                {{ Form::label('q_detail','Question descriptions : ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::textarea('detail', @$question_detail->detail, ['class'=>'form-control form-control-sm', 'id'=>'q_detail', 'placeholder'=>'Enter question...', '']) }}
                                    @error('detail')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                {{ Form::label('image', 'Image:',['class'=>'col-sm-3']) }}
                                <div class="col-sm-5">
                                    {{ Form::file('image', ['id'=>'image', 'accept'=>'image/*','class'=>'form-control'])}} 
                                  @error('image')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-4">
                                    <div class="thumbnail {{(@$question_detail->image !="" ? '': 'hidden')}}" id="view" >
                                        <span class="close delete_qimage" id="{{$question_detail->id}}">&times;</span>
                                        @if (isset($question_detail->image))
                                        @if (file_exists(public_path().'/upload/question/'.$question_detail->image))
                                        <img id="old" src="{{ asset('/upload/question/'.$question_detail->image) }}"  style="width: 100px;">
                                        @endif
                                        @endif
                                        <img src="" id="preview"  style="max-width: 100px;">  
                                    </div>
                                </div>                               
                            </div>          
                            <div class="form-group row">
                                {{ Form::label('point','Point* : ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::number('point', @$question_detail->point, ['class'=>'form-control form-control-sm', 'id'=>'point', 'min'=>1, 'placeholder'=>'Enter point...', 'required']) }}
                                    @error('point')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                {{ Form::label('time_period','Time Period (Secound)* : ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::number('time_period', @$question_detail->time_period, ['class'=>'form-control form-control-sm', 'id'=>'time_period', 'min'=>1, 'placeholder'=>'Enter time period', 'required']) }}
                                    @error('time_period')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">                               
                                {{ Form::label('status','Status* : ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::select('status',['active'=>'Publish', 'inactive'=>'Unpublish'],@$question_detail->status, ['id'=>'status', 'required', 'class'=>'form-control form-control-sm']) }}
                                    @error('status')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div><hr>
                           
                            <div class="option">
                                <?php  $counter = 1;?>
                                @if (@$question_detail)
                                    @foreach($question_detail->option_info as $key => $item)
                                     <?php $counter = $key++;?>
                                     <input type="hidden" name="old_options[]" value="{{$item->id}}">
                                    <div class="add">
                                        <div class="form-group row">
                                            {{ Form::label('option_text','Option* : ',['class'=>'col-sm-3']) }}
                                            <div class="col-sm-9">
                                                {{Form::text('option_text[]', @$item->option_text, ['class'=>'form-control form-control-sm', 'id'=>'option_text', 'placeholder'=>'Enter option_text...', 'required']) }}
                                                @error('option_text.*')
                                                <span class="alert-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                        {{ Form::label('option_text','Image : ',['class'=>'col-sm-3']) }}
                                        <div class="col-sm-5">
                                        {{ Form::file('answer_image[]', ['id'=>$counter,'accept'=>'image/*','class'=>'form-control answer_image'])}} 
                                            @error('option_text')
                                            <span class="alert-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-sm-4">
                                        <div class="thumbnail {{($item->answer_image != ""? '': 'hidden')}}" id="view" >
                                            <span class="close delete_oimage" id="{{$item->id}}">&times;</span>
                                            @if (isset($item->answer_image))
                                            @if (file_exists(public_path().'/upload/answer/'.$item->answer_image))
                                            <img id="old" src="{{ asset('/upload/answer/'.$item->answer_image) }}"  style="width: 100px;">
                                            @endif
                                            @endif
                                            <img src="" id="preview"  style="max-width: 100px;">  
                                        </div>
                                            <img src="" class="preview" style="width: 100px;">  
                                            <input type="hidden" name="txt_option_image[]" value="<?php echo $item->answer_image;?>" id="txt_option_image{{$counter}}">
                                        </div>
                                    </div>
                                    </div>
                                   
                                    @endforeach
                                    
                                @else 
                                <div class="add">
                                <input type="hidden" name="old_options[]" value="0">
                                    <div class="form-group row">
                                        {{ Form::label('option_text','Option* : ',['class'=>'col-sm-3']) }}
                                        <div class="col-sm-9">
                                            {{Form::text('option_text[]', @$question_detail->option_text, ['class'=>'form-control form-control-sm', 'id'=>'option_text', 'placeholder'=>'Enter option_text...', 'required']) }}
                                            @error('option_text.*')
                                            <span class="alert-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        {{ Form::label('option_text','Image : ',['class'=>'col-sm-3']) }}
                                        <div class="col-sm-5">
                                        {{ Form::file('answer_image[]', ['id'=>'1','accept'=>'image/*','class'=>'form-control answer_image'])}} 
                                            @error('option_text')
                                            <span class="alert-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-sm-4">
                                     

                                            <img src="" class="preview" style="width: 100px;">  
                                            <input type="hidden" name="txt_option_image[]" id="txt_option_image1">
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <a href="javascript:void(0);" id="add_more" class="btn btn-primary"><i class="fa fa-plus-circle"> Add Option</i></a>
                            <a href="javascript:void(0);" id="remove" class="btn btn-primary"><i class="fa fa-minus-circle"> Remove</i></a>
                            
                            <hr>
                            <div class="form-group row">
                                {{ Form::label('','',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{ Form::button("<i class='fa fa-trash'></i> Reset", ['class'=>'btn btn-danger','type'=>'reset']) }}
                                    {{ Form::button("<i class='fa fa-paper-pane'></i> Next", ['class'=>'btn btn-success','type'=>'submit']) }}
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
    $(document).ready(function() {
        $("#image").change(function(){
            readURL(this);
        });

    function readanswerURL(input,id) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
               $('#'+id).parent().next().find("img").attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

        $(document).on("change",".answer_image",function(){ 
          //  readanswerURL(this,$(this).attr("id"));
            var id = $(this).attr("id");
			var file_data = $(this).prop('files')[0];
			var form_data = new FormData();
			form_data.append('file', file_data);
            form_data.append('_token','{{ csrf_token() }}');

			$.ajax({
				url: '{{ route("quiz_question/upload") }}', 
				dataType: 'text', 
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,
				type: 'post',
				success: function (response) {
					img = JSON.parse(response);
                    $('#'+id).parent().next().find("img").attr('src', img.src);
                    $("#txt_option_image"+id).val(img.file_name);
				},
				error: function (response) {
					$('#post_img_profile').html(response); 
				}
			});
        });
        var answers = '{{$counter}}';
        var wrapper = $(".option"); //Fields wrapper
        $('#add_more').click(function(e){ //on add input button click
            e.preventDefault();
            answers = answers + 1;
           // alert(answers);
            //add input box
            var template = `<div class="add">
            <input type="hidden" name="old_options[]" value="0">
                                    <div class="form-group row">
                                        {{ Form::label('option_text','Option* : ',['class'=>'col-sm-3']) }}
                                        <div class="col-sm-9">
                                            {{Form::text('option_text[]', @$question_detail->option_text, ['class'=>'form-control form-control-sm', 'id'=>'option_text', 'placeholder'=>'Enter option_text...', 'required']) }}
                                            @error('option_text')
                                            <span class="alert-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        {{ Form::label('option_text','Image : ',['class'=>'col-sm-3']) }}
                                        <div class="col-sm-5">
                                        {{ Form::file('answer_image[]', ['id'=>'`+answers+`','accept'=>'image/*','class'=>'form-control answer_image'])}} 
                                            @error('option_text')
                                            <span class="alert-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-sm-4">
                                        <img src="" class="preview" style="width: 100px;">  
                                        <input type="hidden" name="txt_option_image[]" id="txt_option_image`+answers+`">
                                        </div>
                                    </div>
                                    </div>`;
            
            $(wrapper).append(template);
        });
        $('#remove').on('click', function() {
            if(!confirm("Are you sure to delete this option?"))
                return false;
           var d =  $('.add').last().remove();           
        });

        $(document).on("click",".delete_qimage",function(){
            if(!confirm("Are you sure to delete this image?"))
                return false;
            var id = $(this).attr("id");

            form_data = {id:id,_token:'{{ csrf_token() }}'}

            $.ajax({
            method: "POST",
            url: '{{ route("quiz_question/delete_image") }}',
            data: form_data
            })
            .done(function( msg ) {
              
            });
            $(this).parent().remove();
        });

        $(document).on("click",".delete_oimage",function(){
            if(!confirm("Are you sure to delete this image?"))
                return false;
            var id = $(this).attr("id");

            form_data = {id:id,_token:'{{ csrf_token() }}'}

            $.ajax({
            method: "POST",
            url: '{{ route("quiz_question/delete_option_image") }}',
            data: form_data
            })
            .done(function( msg ) {
                
            });

            $(this).parent().remove();
            
        });

         tinymce.init({
        selector: '#title'
    });
        
    });
</script>
@endsection
