@extends('layouts.admin')
@section('title','Poll')

@section('content')

<div class="container-fluid">
					
    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
          <h5 class="txt-dark">Poll Elements</h5>
        </div>
    </div>
    <!-- /Title -->
    
    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view col-md-8">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Poll {{ isset($poll_detail)? 'Update' : 'Add' }} form</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="form-wrap">
                            @if(isset($poll_detail))
                                {{ Form::open(['url'=>route('poll.update', @$poll_detail->id),'id'=>"uploadform", 'files'=>true, 'class'=> 'form']) }}
                                @method('put')
                            @else
                                {{ Form::open(['url'=>route('poll.store'), 'files'=>true, 'class'=> 'form', 'id'=>"uploadform"]) }}
                            @endif
        
                        
                            <div class="form-group row">
                                {{ Form::label('title','Poll* : ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::text('title', @$poll_detail->title, ['class'=>'form-control form-control-sm', 'id'=>'title', 'placeholder'=>'Enter poll...', 'required']) }}
                                    @error('title')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                           
                            <div class="form-group row">                               
                                {{ Form::label('status','Status* : ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::select('status',['active'=>'Publish', 'inactive'=>'Unpublish'],@$poll_detail->status, ['id'=>'status', 'required', 'class'=>'form-control form-control-sm']) }}
                                    @error('status')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                          <div class="form-group row">
                                <div class="col-md-6">
                                    <div class="row">
                                        {{ Form::label('start','Start Date* : ',['class'=>'col-sm-3']) }}
                                        <div class="col-md-9">
                                            {{ Form::date('start', @$poll_detail->start,['id'=>'start', 'min'=>\Carbon\Carbon::now(), 'require'=>true, 'class'=>'form-control form-control-sm'] ) }}
                                            @error('start')
                                        <span class="alert-danger">{{ $message }}</span>
                                        @enderror                                        
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        {{ Form::label('end','End Date* : ',['class'=>'col-sm-3']) }}
                                        <div class="col-md-9">
                                            {{ Form::date('end', @$poll_detail->end,['id'=>'end', 'require'=>true, 'class'=>'form-control form-control-sm'] ) }}
                                            @error('end')
                                        <span class="alert-danger">{{ $message }}</span>
                                        @enderror                                        
                                        </div>
                                    </div>
                                </div>
                               
                            </div>
                            <hr>
                           
                            <div class="option">
                                @if (@$poll_detail)
                                    @foreach($poll_detail->vote_info as $key => $item)
                                        <div class="form-group row">
                                            {{ Form::label('vote','Option* : ',['class'=>'col-sm-3']) }}
                                            <div class="col-sm-9">
                                                {{Form::text('vote[]', @$item->vote, ['class'=>'form-control form-control-sm', 'id'=>'vote', 'placeholder'=>'Enter vote...', 'required']) }}
                                                @error('vote.*')
                                                <span class="alert-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    @endforeach
                                    
                                @else 
                                    <div class="form-group row">
                                        {{ Form::label('vote','Option* : ',['class'=>'col-sm-3']) }}
                                        <div class="col-sm-9">
                                            {{Form::text('vote[]', @$poll_detail->vote_info['vote'], ['class'=>'form-control form-control-sm', 'id'=>'vote', 'placeholder'=>'Enter vote...', 'required']) }}
                                            @error('vote.*')
                                            <span class="alert-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <a href="javascript:void(0);" id="add_more" class="btn btn-primary"><i class="fa fa-plus-circle"> Add Option</i></a>
                            <a href="javascript:void(0);" id="remove" class="btn btn-primary"><i class="fa fa-minus-circle"> Remove</i></a>
                            <br>
                            <br>
                            <div class="form-group row">
                                {{ Form::label('image', 'Image* :',['class'=>'col-sm-3']) }}
                                <div class="col-sm-4">
                                    {{ Form::file('image', ['id'=>'image', 'required'=>false, 'accept'=>'image/*'])}} 
                                  @error('image')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-4">
                                    <div class="thumbnail {{(isset($poll_detail)? '': 'hidden')}}" id="view" >
                                        <span class="close">&times;</span>
                                        @if (isset($poll_detail))
                                        @if (file_exists(public_path().'/upload/author/'.$poll_detail->image))
                                        <img id="old" src="{{ asset('/upload/author/'.$poll_detail->image) }}">
                                        @endif
                                        @endif
                                        <img src="" id="preview">  
                                    </div>
                                </div>                               
                            </div>
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
                                        {{ Form::label('vote','Option* : ',['class'=>'col-sm-3']) }}
                                        <div class="col-sm-9">
                                            {{Form::text('vote[]', @$poll_detail->vote_info['vote'], ['class'=>'form-control form-control-sm', 'id'=>'vote', 'placeholder'=>'Enter vote...', 'required']) }}
                                            @error('vote')
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
@endsection
