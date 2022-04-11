@extends('layouts.operator')
@section('title','FSTV NEWS | Advertise')

@section('content')
<div class="container-fluid">
					
    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
          <h5 class="txt-dark">Advertise Elements</h5>
        </div>
    </div>
    <!-- /Title -->
    
    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view col-md-8">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Advertise {{ isset($advertise_detail)? 'Update' : 'Add' }} form</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="form-wrap">
                            @if(isset($advertise_detail))
                                {{ Form::open(['url'=>route('advertise.update', $advertise_detail->id), 'files'=>true, 'class'=> 'form']) }}
                                @method('put')
                            @else
                                {{ Form::open(['url'=>route('advertise.store'), 'files'=>true, 'class'=> 'form']) }}
                            @endif


                            <div class="form-group row">
                                {{ Form::label('title','Title* : ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::text('title', @$advertise_detail->title, ['class'=>'form-control form-control-sm', 'id'=>'title', 'placeholder'=>'Enter Advertise title...', 'require'=>true]) }}
                                    @error('title')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                {{ Form::label('link','Link* : ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::url('link',@$advertise_detail->link, ['class'=>'form-control form-control-sm', 'id'=>'link', 'placeholder'=>'Enter Advertise link...', 'require'=>true]) }}
                                    @error('link')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- <div class="form-group row">
                                {{ Form::label('position','Position* : ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::select('position',[
                                        'content'=>'Content',
                                        'sidebar'=>'Sidebar',
                                    ],                            
                                    @$advertise_detail->position, ['id'=>'position', 'require'=>true, 'class'=>'form-control form-control-sm', 'placeholder'=> '<--Select the position-->']) }}
                                    @error('position')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div> --}}

                            <div class="form-group row">
                                {{ Form::label('status','Status* : ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::select('status',['inactive'=>'Unpublish'],@$advertise_detail->status, ['disabled', 'id'=>'status', 'require'=>false, 'class'=>'form-control form-control-sm']) }}
                                    @error('status')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                {{ Form::label('type','Advertise Type* : ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::select('type',['image'=>'Image', 'video'=>'Video'],@$advertise_detail->type, ['id'=>'type', 'require'=>true, 'class'=>'form-control form-control-sm']) }}
                                    @error('type')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row" id="photo">
                                {{ Form::label('Image', 'Image/Video*:',['class'=>'col-sm-3']) }}
                                <div class="col-sm-4">
                                    {{ Form::file('image', ['id'=>'image', 'required'=>(isset($advertise_detail)? false: true), 'accept'=>'image/*'])}}  
                                </div>
                                <div class="col-sm-4">
                                    <div class="thumbnail {{(isset($advertise_detail)? '': 'hidden')}}" id="view" >
                                        <span class="close">&times;</span>
                                        @if (isset($advertise_detail))
                                        @if (file_exists(public_path().'/upload/advertise/'.$advertise_detail->image))
                                            <img id="old" src="{{ asset('/upload/advertise/'.$advertise_detail->image) }}">
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
<script>
$(document).ready(function(){
    $('#type').change(function (){
        let stype = $(this).val();
        img = stype != 'image' ? $('#image').attr("accept", "video/mp4,video/x-m4v,video/*") : '';
    });
    
});
</script>

<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#view').removeClass('hidden');
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
@endsection
