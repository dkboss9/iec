@extends('layouts.admin')
@section('title','Admin')

@section('content')
<div class="container-fluid">
					
    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
          <h5 class="txt-dark">Admin </h5>
        </div>
    </div>
    <!-- /Title -->
    
    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view col-md-8">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Admin {{ isset($user_detail)? 'Update' : 'Add' }} Form</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="form-wrap">
                    @if(isset($user_detail))
                        {{ Form::open(['url'=>route('users.update', $user_detail->id), 'files'=>true, 'class'=> 'form']) }}
                        @method('put')
                    @else
                        {{ Form::open(['url'=>route('users.store'), 'files'=>true, 'class'=> 'form']) }}
                    @endif

                    <div class="form-group row">
                        {{ Form::label('name','Full Name*: ',['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{Form::text('name', @$user_detail->name, ['class'=>'form-control form-control-sm', 'id'=>'name', 'placeholder'=>'Enter Full name...', 'require'=>true]) }}
                            @error('name')
                            <span class="alert-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('email','Email*: ',['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{Form::email('email', @$user_detail->email, ['class'=>'form-control form-control-sm', 'id'=>'email', 'placeholder'=>'Enter User email...', 'require'=>true]) }}
                            @error('email')
                            <span class="alert-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>                    

                    <div class="form-group row {{ isset($user_detail) ? '': 'hidden' }}">
                        {{ Form::label('change_password','Change Password: ',['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{ Form::checkbox('change_password',1, )}} Yes
                        </div>
                    </div>

                    <div class="password_change {{ isset($user_detail) ? 'hidden': '' }}">
                        <div class="form-group row">
                            {{ Form::label('password','Password*: ',['class'=>'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{Form::password('password',['class'=>'form-control form-control-sm', 'id'=>'password', 'placeholder'=>'Enter User password...', 'require'=>(isset($user_detail) ? false : true )]) }}
                                @error('password')
                                <span class="alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('password_confirmation','Re-Password*: ',['class'=>'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{Form::password('password_confirmation',['class'=>'form-control form-control-sm', 'id'=>'password_confirmation', 'placeholder'=>'Enter User password_confirmation...', 'require'=>(isset($user_detail) ? false : true) ]) }}
                            </div>
                        </div>
                    </div>
                    @if (auth()->user()->id == 1)
                        <div class="form-group row hidden">
                            {{ Form::label('status','Status* : ',['class'=>'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{Form::select('status',['active'=>'Active', 'inactive'=>'Inactive'],@$user_detail->status, ['id'=>'status', 'require'=>true, 'class'=>'form-control form-control-sm']) }}
                                @error('status')
                                <span class="alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    @else
                    <div class="form-group row">
                        {{ Form::label('status','Status* : ',['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{Form::select('status',['active'=>'Active', 'inactive'=>'Inactive'],@$user_detail->status, ['id'=>'status', 'require'=>true, 'class'=>'form-control form-control-sm']) }}
                            @error('status')
                            <span class="alert-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    @endif

                    <div class="form-group row">
                        {{ Form::label('address','Address: ',['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{Form::text('address', @$user_detail->user_info['address'], ['class'=>'form-control form-control-sm', 'id'=>'address', 'placeholder'=>'Enter User address...', 'require'=>false]) }}
                            @error('address')
                            <span class="alert-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('phone','Phone Number: ',['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{Form::tel('phone', @$user_detail->user_info['phone'], ['class'=>'form-control form-control-sm', 'id'=>'phone', 'placeholder'=>'Enter User phone...', 'require'=>false]) }}
                            @error('phone')
                            <span class="alert-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                   
                    <div class="form-group row">
                        {{ Form::label('detail','Description: ',['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">   
                            {{Form::textarea('detail', @$user_detail->user_info['detail'], ['class'=>'form-control form-control-sm', 'id'=>'detail', 'placeholder'=>'Enter Additional Information...', 'require'=>false,'rows'=>5,'style'=>'resize-none']) }}
                            @error('detail')
                            <span class="alert-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('image', '',['class'=>'col-sm-3']) }}
                        <div class="col-sm-4">
                            {{ Form::file('image', ['id'=>'image', 'required'=>false, 'accept'=>'image/*'])}}
                            @error('image')
                            <span class="alert-danger">{{ $message }}</span>
                            @enderror  
                        </div>
                        <div class="col-sm-4">
                            <div class="thumbnail {{(isset($user_detail)? '': 'hidden')}}" id="view" >
                                <span class="close">&times;</span>
                                @if (isset($user_detail))
                                @if (file_exists(public_path().'/upload/users/'.$user_detail->user_info['image']))
                                <img id="old" src="{{ asset('/upload/users/'.$user_detail->user_info['image']) }}">
                                @endif
                                @endif
                                <img src="" id="preview">  
                            </div>
                        </div>                               
                    </div>
                    
                    <input type="hidden" name="role" id="role" value="admin">

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
        $('#change_password').change(function(e){
            let is_checked = $(this).prop('checked');
            if(is_checked){ 
                $('#password').attr('required','required');
                $('#password_confirmation').attr('required','required');
                $('.password_change').removeClass('hidden');
            } else {
                $('#password').removeAttr('required','required');
                $('#password_confirmation').removeAttr('required','required');
                $('.password_change').addClass('hidden');
            }
        });
    </script>

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
         $(document).ready(function(){
        if($('#current_user_time').val() ==""){
            var today = new Date();
            var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+(today.getDate() < 10 ? "0" : "") + today.getDate();
            var today = new Date();
            var time = (today.getHours() < 10 ? "0" : "") + today.getHours() + ":" + (today.getMinutes() < 10 ? "0" : "") + today.getMinutes() + ":" + (today.getSeconds() < 10 ? "0" : "") + today.getSeconds();;
            $('#current_user_time').val(date + ' ' + time);
        }
    });
    </script>
@endsection