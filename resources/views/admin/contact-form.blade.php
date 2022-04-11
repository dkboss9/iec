@extends('layouts.admin')
@section('title','Contact')

@section('content')

<div class="container-fluid">
					
    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
          <h5 class="txt-dark">Contact Elements</h5>
        </div>
    </div>
    <!-- /Title -->
    
    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view col-md-8">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Contact {{ isset($contact_detail)? 'Update' : 'Add' }} form</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="form-wrap">
                            @if(isset($contact_detail))
                                {{ Form::open(['url'=>route('contact.update', @$contact_detail->id),'id'=>"uploadform", 'files'=>true, 'class'=> 'form']) }}
                                @method('put')
                            @else
                                {{ Form::open(['url'=>route('contact.store'), 'files'=>true, 'class'=> 'form', 'id'=>"uploadform"]) }}
                            @endif
        
                                  
                            <div class="form-group row">
                                {{ Form::label('country','Country* : ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::select('country',['aus'=>'Australia', 'nep'=>'Nepal'],@$contact_detail->country, ['id'=>'country', 'require'=>true, 'class'=>'form-control form-control-sm']) }}
                                    @error('country')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                {{ Form::label('email','Email-address* : ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::email('email', @$contact_detail->email, ['class'=>'form-control form-control-sm', 'id'=>'email', 'placeholder'=>'Enter email...', 'require'=>true]) }}
                                    @error('email')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                {{ Form::label('email2','Email alternative: ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::email('email2', @$contact_detail->email2, ['class'=>'form-control form-control-sm', 'id'=>'email2', 'placeholder'=>'Enter email2...', 'require'=>false]) }}
                                    @error('email2')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                {{ Form::label('address','Address* : ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::text('address', @$contact_detail->address, ['class'=>'form-control form-control-sm', 'id'=>'address', 'placeholder'=>'Enter address...', 'require'=>false]) }}
                                    @error('address')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                {{ Form::label('address2','Alt Address: ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::text('address2', @$contact_detail->address2, ['class'=>'form-control form-control-sm', 'id'=>'address2', 'placeholder'=>'Enter address2...', 'require'=>false]) }}
                                    @error('address2')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                {{ Form::label('phone','Contact no.* : ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::number('phone', @$contact_detail->phone, ['class'=>'form-control form-control-sm', 'id'=>'phone', 'placeholder'=>'Enter phone...', 'require'=>false]) }}
                                    @error('phone')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                {{ Form::label('phone2','Alt Contact no.: ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::number('phone2', @$contact_detail->phone2, ['class'=>'form-control form-control-sm', 'id'=>'phone2', 'placeholder'=>'Enter phone2...', 'require'=>false]) }}
                                    @error('phone2')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
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
    tinymce.init({
        selector: '#detail'
    });
</script>
@endsection