@extends('layouts.admin')
@section('title','Contributor')

@section('content')

<div class="container-fluid">
					
    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
          <h5 class="txt-dark">Contributor Elements</h5>
        </div>
    </div>
    <!-- /Title -->
    
    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view col-md-8">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Contributor {{ isset($contributor_detail)? 'Update' : 'Add' }} form</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="form-wrap">
                            @if(isset($contributor_detail))
                                {{ Form::open(['url'=>route('contributor.update', @$contributor_detail->id),'id'=>"uploadform", 'files'=>true, 'class'=> 'form']) }}
                                @method('put')
                            @else
                                {{ Form::open(['url'=>route('contributor.store'), 'files'=>true, 'class'=> 'form', 'id'=>"uploadform"]) }}
                            @endif
        
        
                            <div class="form-group row">
                                {{ Form::label('name','Full Name* : ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::text('name', @$contributor_detail->name, ['class'=>'form-control form-control-sm', 'id'=>'name', 'placeholder'=>'Enter name...', 'require'=>true]) }}
                                    @error('name')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                {{ Form::label('email','Email-address* : ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::email('email', @$contributor_detail->email, ['class'=>'form-control form-control-sm', 'id'=>'email', 'placeholder'=>'Enter email...', 'require'=>true]) }}
                                    @error('email')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                {{ Form::label('address','Address: ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::text('address', @$contributor_detail->address, ['class'=>'form-control form-control-sm', 'id'=>'address', 'placeholder'=>'Enter address...', 'require'=>false]) }}
                                    @error('address')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                {{ Form::label('phone','Contact no.: ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::number('phone', @$contributor_detail->phone, ['class'=>'form-control form-control-sm', 'id'=>'phone', 'placeholder'=>'Enter phone...', 'require'=>false]) }}
                                    @error('phone')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                {{ Form::label('detail','Descriptions: ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::textarea('detail', html_entity_decode(@$contributor_detail->detail), ['class'=>'form-control', 'id'=>'detail', 'placeholder'=>'Enter Category detail...', 'require'=>false, 'style'=>'resize: none;', 'rows' =>'5']) }}
                                  @error('detail')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                {{ Form::label('image', '',['class'=>'col-sm-3']) }}
                                <div class="col-sm-4">
                                    {{ Form::file('image', ['id'=>'image', 'required'=>(isset($contributor_detail)? false: true), 'accept'=>'image/*'])}} 
                                  @error('image')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-4">
                                    <div class="thumbnail {{(isset($contributor_detail)? '': 'hidden')}}" id="view" >
                                        <span class="close">&times;</span>
                                        @if (isset($contributor_detail))
                                        @if (file_exists(public_path().'/upload/contributor/'.$contributor_detail->image))
                                        <img id="old" src="{{ asset('/upload/contributor/'.$contributor_detail->image) }}">
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
