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
                        <h6 class="panel-title txt-dark">Programs {{ isset($program_detail)? 'Update' : 'Add' }} form</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="form-wrap">
                            @if(isset($program_detail))
                                {{ Form::open(['url'=>route('program.update', @$program_detail->id),'id'=>"uploadform", 'files'=>true, 'class'=> 'form']) }}
                                @method('put')
                            @else
                                {{ Form::open(['url'=>route('program.store'), 'files'=>true, 'class'=> 'form', 'id'=>"uploadform"]) }}
                            @endif
        
        
                            <div class="form-group row">
                                {{ Form::label('title','Title* : ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::text('title', @$program_detail->title, ['class'=>'form-control form-control-sm', 'id'=>'title', 'placeholder'=>'Enter title...', 'require'=>true]) }}
                                    @error('title')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                {{ Form::label('detail','Descriptions*: ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::textarea('detail', html_entity_decode(@$program_detail->detail), ['class'=>'form-control', 'id'=>'detail', 'placeholder'=>'Enter Programs detail...', 'require'=>true, 'style'=>'resize: none;', 'rows' =>'5']) }}
                                  @error('detail')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <div class="row">
                                        {{ Form::label('start','Start Date*: ',['class'=>'col-sm-3']) }}
                                        <div class="col-md-9">
                                            {{ Form::input('dateTime-local',  'start', date('Y-m-d\TH:i', strtotime(@$program_detail->start)),['id'=>'start', 'min'=>\Carbon\Carbon::now(), 'require'=>true, 'class'=>'form-control form-control-sm'] ) }}
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
                                            {{ Form::input('dateTime-local',  'end', date('Y-m-d\TH:i', strtotime(@$program_detail->end)),['id'=>'end', 'require'=>true, 'class'=>'form-control form-control-sm'] ) }}
                                            @error('end')
                                        <span class="alert-danger">{{ $message }}</span>
                                        @enderror                                        
                                        </div>
                                    </div>
                                </div>
                            </div>        
                            <div class="form-group row">
                                {{ Form::label('status','Status: ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::select('status',['active'=>'Publish', 'inactive'=>'Unpublish'],@$program_detail->status, ['id'=>'status', 'require'=>true, 'class'=>'form-control form-control-sm']) }}
                                    @error('status')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>     
                            <div class="form-group row">
                                {{ Form::label('image', 'Image*:',['class'=>'col-sm-3']) }}
                                <div class="col-sm-4">
                                    {{ Form::file('image', ['id'=>'image', 'required'=>(isset($program_detail->image)? false: true), 'accept'=>'image/*'])}} 
                                  @error('image')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-4">
                                    <div class="thumbnail {{(isset($program_detail)? '': 'hidden')}}" id="view" >
                                        <span class="close">&times;</span>
                                        @if (isset($program_detail->image))
                                        @if (file_exists(public_path().'/upload/program/'.$program_detail->image))
                                        <img id="old" src="{{ asset('/upload/program/'.$program_detail->image) }}">
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
<script>
    $('#is_parent').change(function(){
       let is_checked =$(this).prop('checked');
       if (is_checked){
           $('#parent_id').change();
           $('#div_parent').addClass('hidden');
       } else {
           $('#div_parent').removeClass('hidden');
       }
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
    tinymce.init({
        selector: '#detail'
    });
</script>
@endsection
