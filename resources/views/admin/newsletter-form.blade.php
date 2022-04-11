@extends('layouts.admin')
@section('title','Newsletter')
@section ('styles')
    <link rel="stylesheet" href="{{ asset('plugins/datetimepicker/jquery.datetimepicker.css') }}">
@endsection
@section('content')

<div class="container-fluid">
					
    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
          <h5 class="txt-dark">Newsletter Elements</h5>
        </div>
    </div>
    <!-- /Title -->
    
    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view col-md-8">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Newsletter {{ isset($newsletter)? 'Update' : 'Add' }} form</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="form-wrap">
                            @if(isset($newsletter))
                                {{ Form::open(['url'=>route('newsletter.update', @$newsletter->id),'id'=>"uploadform", 'files'=>true, 'class'=> 'form']) }}
                                @method('put')
                            @else
                                {{ Form::open(['url'=>route('newsletter.store'), 'files'=>true, 'class'=> 'form', 'id'=>"uploadform"]) }}
                            @endif
        
        
                            <div class="form-group row">
                                {{ Form::label('title','Title : ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::text('title', @$newsletter->title, ['class'=>'form-control form-control-sm', 'id'=>'title', 'placeholder'=>'Enter title...', 'require'=>true]) }}
                                    @error('title')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                {{ Form::label('message','Message : ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::textarea('message', html_entity_decode(@$newsletter->message), ['class'=>'form-control', 'id'=>'message', 'placeholder'=>'Enter Category message...', 'require'=>true, 'style'=>'resize: none;', 'rows' =>'5']) }}
                                    @error('message')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- <div class="form-group row">
                                {{ Form::label('schedule_date','Schedule date : ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::text('schedule_date', @$newsletter->schedule_date, ['class'=>'form-control', 'id'=>'schedule_date', 'name'=>'schedule_date', 'placeholder'=>'Pick schedule date', 'require'=>false, 'style'=>'resize: none;', 'rows' =>'5']) }}
                                    @error('schedule_date')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div> --}}

                            @if (isset($newsletter))
                                <div class="form-group row">
                                    {{ Form::label('status','Status : ',['class'=>'col-sm-3']) }}
                                    <div class="col-sm-9">
                                        {{Form::select('status',['sent'=>'Sent', 'pending'=>'Pending'],@$newsletter->status, ['id'=>'status', 'require'=>true, 'class'=>'form-control form-control-sm']) }}
                                        @error('status')
                                        <span class="alert-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>                                            
                            @endif
                        
                            <div class="form-group row">
                                {{ Form::label('Attachment :', '',['class'=>'col-sm-3']) }}
                                <div class="col-sm-4">
                                    {{ Form::file('attachment', ['id'=>'attachment', 'required'=>false, 'accept'=>'file'])}} 
                                  @error('attachment')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-4">
                                    <div class="thumbnail {{(isset($newsletter)? '': 'hidden')}}" id="view" >
                                        <span class="close">&times;</span>
                                        @if (isset($newsletter))
                                        @if (file_exists('upload/newsletter/'.$newsletter->attachment))
                                         <a href="{{ asset('upload/newsletter/'.$newsletter->attachment) }}" target="_blank"><i class="fa fa-paperclip fa-4x"></i>  </a>
                                        @endif 
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
            
            reader.onload = function (e) {
                $('#preview').attr('src', e.target.result);
                $('#view').removeClass('hidden');
                $('#old').remove();
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#attachment").change(function(){
        readURL(this);
    });

    $(document).on('click', '.close', function() {
        $(this).parent().remove();
    });
</script>
<script src="{{ asset('plugins/datetimepicker/build/jquery.datetimepicker.full.js') }}"></script>
<script>
        $('#schedule_date').datetimepicker({
        format: 'Y-m-d H:i:s',
    });
   
</script>
<script>
    tinymce.init({
        selector: '#message'
    });
</script>

@endsection
