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
                                {{ Form::open(['url'=>route('question.update', @$question_detail->id),'id'=>"uploadform", 'files'=>true, 'class'=> 'form']) }}
                                @method('put')
                            @else
                                {{ Form::open(['url'=>route('question.store'), 'files'=>true, 'class'=> 'form', 'id'=>"uploadform"]) }}
                            @endif
        
                            
                            {{-- <div class="form-group row">
                                {{ Form::label('title','Title* : ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::text('title', @$question_detail->title, ['class'=>'form-control form-control-sm', 'id'=>'title', 'placeholder'=>'Enter title...', 'required']) }}
                                    @error('title')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div> --}}
                            <div class="form-group row">
                                {{ Form::label('title','Question* : ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::text('title', @$question_detail->title, ['class'=>'form-control form-control-sm', 'id'=>'title', 'placeholder'=>'Enter question...', 'required']) }}
                                    @error('title')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
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
                                {{ Form::label('status','Status* : ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::select('status',['active'=>'Publish', 'inactive'=>'Unpublish'],@$question_detail->status, ['id'=>'status', 'required', 'class'=>'form-control form-control-sm']) }}
                                    @error('status')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div><hr>
                           
                            <div class="option">
                                @if (@$question_detail)
                                    @foreach($question_detail->option_info as $key => $item)
                                        <div class="form-group row">
                                            {{ Form::label('option_text','Option* : ',['class'=>'col-sm-3']) }}
                                            <div class="col-sm-9">
                                                {{Form::text('option_text[]', @$item->option_text, ['class'=>'form-control form-control-sm', 'id'=>'option_text', 'placeholder'=>'Enter option_text...', 'required']) }}
                                                @error('option_text.*')
                                                <span class="alert-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    @endforeach
                                    
                                @else 
                                    <div class="form-group row">
                                        {{ Form::label('option_text','Option* : ',['class'=>'col-sm-3']) }}
                                        <div class="col-sm-9">
                                            {{Form::text('option_text[]', @$question_detail->option_text, ['class'=>'form-control form-control-sm', 'id'=>'option_text', 'placeholder'=>'Enter option_text...', 'required']) }}
                                            @error('option_text.*')
                                            <span class="alert-danger">{{ $message }}</span>
                                            @enderror
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
    tinymce.init({
        selector: '#detail'
    });
</script>
<script>
    $(document).ready(function() {
        var wrapper = $(".option"); //Fields wrapper
        $('#add_more').click(function(e){ //on add input button click
            e.preventDefault();
            //add input box
            var template = `<div class="form-group row add">
                                        {{ Form::label('option_text','Option* : ',['class'=>'col-sm-3']) }}
                                        <div class="col-sm-9">
                                            {{Form::text('option_text[]', @$question_detail->option_text, ['class'=>'form-control form-control-sm', 'id'=>'option_text', 'placeholder'=>'Enter option_text...', 'required']) }}
                                            @error('option_text')
                                            <span class="alert-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>`;
            
            $(wrapper).append(template);
        });
        $('#remove').on('click', function() {
           var d =  $('.add').last().remove();           
        });
    });
</script>
@endsection
