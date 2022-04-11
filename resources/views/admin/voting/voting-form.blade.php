@extends('layouts.admin')
@section('title','Voting')

@section('content')

<div class="container-fluid">
					
    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
          <h5 class="txt-dark">Voting Elements</h5>
        </div>
    </div>
    <!-- /Title -->
    
    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view col-md-8">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Voting {{ isset($voting_detail)? 'Update' : 'Add' }} form</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="form-wrap">
                            @if(isset($voting_detail))
                                {{ Form::open(['url'=>route('voting.update', @$voting_detail->id),'id'=>"uploadform", 'files'=>true, 'class'=> 'form']) }}
                                @method('put')
                            @else
                                {{ Form::open(['url'=>route('voting.store'), 'files'=>true, 'class'=> 'form', 'id'=>"uploadform"]) }}
                            @endif
        
                        
                            <div class="form-group row">
                                {{ Form::label('program','Program* : ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::text('program', @$voting_detail->program, ['class'=>'form-control form-control-sm', 'id'=>'program', 'placeholder'=>'Enter voting...', 'required']) }}
                                    @error('program')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                {{ Form::label('detail','Descriptions* : ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::textarea('detail', html_entity_decode(@$voting_detail->detail), ['class'=>'form-control', 'id'=>'detail', 'placeholder'=>'Enter detail...', 'require'=>false, 'style'=>'resize: none;', 'rows' =>'5']) }}
                                  @error('detail')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>                           
                            <div class="form-group row">                               
                                {{ Form::label('status','Status* : ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::select('status',['active'=>'Publish', 'inactive'=>'Unpublish'],@$voting_detail->status, ['id'=>'status', 'required', 'class'=>'form-control form-control-sm']) }}
                                    @error('status')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <div class="row">
                                        {{ Form::label('start','Start Date*: ',['class'=>'col-sm-3']) }}
                                        <div class="col-md-9">
                                            {{ Form::input('dateTime-local',  'start', date('Y-m-d\TH:i', strtotime(@$voting_detail->start)),['id'=>'start', 'min'=>\Carbon\Carbon::now(), 'require'=>true, 'class'=>'form-control form-control-sm'] ) }}
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
                                            {{ Form::input('dateTime-local',  'end', date('Y-m-d\TH:i', strtotime(@$voting_detail->end)),['id'=>'end', 'require'=>true, 'class'=>'form-control form-control-sm'] ) }}
                                            {{-- {{ Form::datetime('end', @$voting_detail->end,['id'=>'end', 'require'=>true, 'class'=>'form-control form-control-sm'] ) }} --}}
                                            @error('end')
                                        <span class="alert-danger">{{ $message }}</span>
                                        @enderror                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                {{ Form::label('image', 'Image*:',['class'=>'col-sm-3']) }}
                                <div class="col-sm-4">
                                    {{ Form::file('image', ['id'=>'image', 'required'=>(isset($voting_detail->image)? false: true), 'accept'=>'image/*'])}} 
                                  @error('image')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-4">
                                    <div class="thumbnail {{(isset($voting_detail)? '': 'hidden')}}" id="view" >
                                        <span class="close">&times;</span>
                                        @if (isset($voting_detail))
                                        @if (file_exists(public_path().'/upload/voting/'.$voting_detail->image))
                                        <img id="old" src="{{ asset('/upload/voting/'.$voting_detail->image) }}">
                                        @endif
                                        @endif
                                        <img src="" id="preview">  
                                    </div>
                                </div>                               
                            </div>
                            <hr>
                           
                            <div class="option">
                                @if (@$voting_detail)
                                    @foreach($voting_detail->participant_info as $key => $item)
                                        <div class="form-group row">
                                            {{ Form::label('name','Participants* : ',['class'=>'col-sm-3']) }}
                                            <div class="col-sm-9">
                                                {{Form::text('name[]', @$item->name, ['class'=>'form-control form-control-sm', 'id'=>'name', 'placeholder'=>'Enter Participant name...', 'required']) }}
                                                @error('name.*')
                                                <span class="alert-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            {{ Form::label('description','Descriptions* : ',['class'=>'col-sm-3']) }}
                                            <div class="col-sm-9">
                                                {{Form::textarea('description[]', html_entity_decode(@$item->description), ['class'=>'form-control', 'id'=>'description', 'placeholder'=>'Enter Participant description...', 'require'=>false, 'style'=>'resize: none;', 'rows' =>'5']) }}
                                              @error('description')
                                                <span class="alert-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>                                       
                                        <div class="form-group row">                               
                                            {{ Form::label('stat','Status* : ',['class'=>'col-sm-3']) }}
                                            <div class="col-sm-9">
                                                {{Form::select('stat[]',['active'=>'Publish', 'inactive'=>'Unpublish'],@$item->status, ['id'=>'stat', 'required', 'class'=>'form-control form-control-sm']) }}
                                                @error('stat')
                                                <span class="alert-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            {{ Form::label('photo', 'Image*:',['class'=>'col-sm-3']) }}
                                            <div class="col-sm-4">
                                                {{ Form::file('photo[]', ['id'=>'photo', 'required'=>(isset($item->photo)? false: true), 'accept'=>'image/*'])}} 
                                              @error('photo')
                                                <span class="alert-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="thumbnail {{(isset($item->photo)? '': 'hidden')}}" id="view" >
                                                    <span class="close">&times;</span>
                                                    @if (isset($item->photo))
                                                    @if (file_exists(public_path().'/upload/participant/'.$item->photo))
                                                    <img id="old" src="{{ asset('/upload/participant/'.$item->photo) }}">
                                                    @endif
                                                    @endif
                                                    <img src="" id="preview">  
                                                </div>
                                            </div>                               
                                        </div> 
                                    @endforeach
                                    
                                @else 
                                    <div class="form-group row">
                                        {{ Form::label('name','Participants* : ',['class'=>'col-sm-3']) }}
                                        <div class="col-sm-9">
                                            {{Form::text('name[]', @$voting_detail->participant_info['name'], ['class'=>'form-control form-control-sm', 'id'=>'name', 'placeholder'=>'Enter participant name...', 'required']) }}
                                            @error('name.*')
                                            <span class="alert-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        {{ Form::label('description','Descriptions* : ',['class'=>'col-sm-3']) }}
                                        <div class="col-sm-9">
                                            {{Form::textarea('description[]', html_entity_decode(@$voting_detail->participant_info['description']), ['class'=>'form-control', 'id'=>'description', 'placeholder'=>'Enter participant description...', 'require'=>false, 'style'=>'resize: none;', 'rows' =>'5']) }}
                                          @error('description')
                                            <span class="alert-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>                                   
                                    <div class="form-group row">                               
                                        {{ Form::label('stat','Status* : ',['class'=>'col-sm-3']) }}
                                        <div class="col-sm-9">
                                            {{Form::select('stat[]',['active'=>'Publish', 'inactive'=>'Unpublish'],@$voting_detail->participant_info['status'], ['id'=>'stat', 'required', 'class'=>'form-control form-control-sm']) }}
                                            @error('stat')
                                            <span class="alert-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        {{ Form::label('photo', 'Image*:',['class'=>'col-sm-3']) }}
                                        <div class="col-sm-4">
                                            {{ Form::file('photo[]', ['id'=>'photo', 'required'=>(isset($voting_detail->participant_info['photo'])? false: true), 'accept'=>'image/*'])}} 
                                          @error('photo')
                                            <span class="alert-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="thumbnail {{(isset($voting_detail->participant_info)? '': 'hidden')}}" id="view" >
                                                <span class="close">&times;</span>
                                                @if (isset($voting_detail->participant_info['photo']))
                                                @if (file_exists(public_path().'/upload/participant/'.$voting_detail->participant_info['photo']))
                                                <img id="old" src="{{ asset('/upload/participant/'.$voting_detail->participant_info['photo']) }}">
                                                @endif
                                                @endif
                                                <img src="" id="preview">  
                                            </div>
                                        </div>                               
                                    </div>                                  
                                @endif
                            </div>
                            <a href="javascript:void(0);" id="add_more" class="btn btn-primary"><i class="fa fa-plus-circle"> Add Option</i></a>
                            <a href="javascript:void(0);" id="remove" class="btn btn-primary"><i class="fa fa-minus-circle"> Remove</i></a>
                            <br>
                            <br>
                            
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
            var template = `
                            <div class="add">                          
                            <hr>  
                            <div class="form-group row">
                                {{ Form::label('name','Participant* : ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::text('name[]', @$voting_detail->participant_info['name'], ['class'=>'form-control form-control-sm', 'id'=>'name', 'placeholder'=>'Enter participant name...', 'required']) }}
                                    @error('name')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                {{ Form::label('description','Descriptions* : ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::textarea('description[]', html_entity_decode(@$voting_detail->participant_info['description']), ['class'=>'form-control', 'id'=>'description', 'placeholder'=>'Enter participant description...', 'require'=>false, 'style'=>'resize: none;', 'rows' =>'5']) }}
                                    @error('description')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>                                   
                            <div class="form-group row">                               
                                {{ Form::label('stat','Status* : ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::select('stat[]',['active'=>'Publish', 'inactive'=>'Unpublish'],@$voting_detail->participant_info['status'], ['id'=>'stat', 'required', 'class'=>'form-control form-control-sm']) }}
                                    @error('stat')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                {{ Form::label('photo', 'Image*:',['class'=>'col-sm-3']) }}
                                <div class="col-sm-4">
                                    {{ Form::file('photo[]', ['id'=>'photo', 'required'=>false, 'accept'=>'image/*'])}} 
                                    @error('photo')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-4">
                                    <div class="thumbnail {{(isset($voting_detail->participant_info)? '': 'hidden')}}" id="view" >
                                        <span class="close">&times;</span>
                                        @if (isset($voting_detail->participant_info['photo']))
                                        @if (file_exists(public_path().'/upload/participant/'.$voting_detail->participant_info['photo']))
                                        <img id="old" src="{{ asset('/upload/participant/'.$voting_detail->participant_info['photo']) }}">
                                        @endif
                                        @endif
                                        <img src="" id="preview">  
                                    </div>
                                </div>                               
                            </div>   
                            </div>
                            `;
            
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
