@extends('layouts.operator')
@section('title','FSTV| Operator')

@section('content')
<div class="container-fluid">
					
    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
          <h5 class="txt-dark">Operator Elements </h5>
        </div>
    </div>
    <!-- /Title -->
    
    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view col-md-8">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Operator {{ isset($user_detail)? 'Update' : 'Add' }} Form</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="form-wrap">
                    @if(isset($user_detail))
                        {{ Form::open(['url'=>route('operator.update', $user_detail->id), 'files'=>true, 'class'=> 'form']) }}
                        @method('put')
                    @else
                        {{ Form::open(['url'=>route('operator.store'), 'files'=>true, 'class'=> 'form']) }}
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
                            {{Form::email('email', @$user_detail->email, [ 'readonly','class'=>'form-control form-control-sm', 'id'=>'email', 'placeholder'=>'Enter User email...', 'require'=>(isset($user_detail) ? false : true )]) }}
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
                            {{ Form::label('password_confirmation','Confirm-Password*: ',['class'=>'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{Form::password('password_confirmation',['class'=>'form-control form-control-sm', 'id'=>'password_confirmation', 'placeholder'=>'Enter User password_confirmation...', 'require'=>(isset($user_detail) ? false : true) ]) }}
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('citizenship','Citizenship/Passport No*: ',['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{Form::text('citizenship', @$user_detail->operator_info['citizenship'], ['class'=>'form-control form-control-sm', 'id'=>'citizenship', 'placeholder'=>'Enter citizenship/passport number...', 'require'=>true]) }}
                            @error('citizenship')
                            <span class="alert-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('other_id','Other ID: ',['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{Form::text('other_id', @$user_detail->operator_info['other_id'], ['class'=>'form-control form-control-sm', 'id'=>'other_id', 'placeholder'=>'Enter User other_id...', 'require'=>false]) }}
                            @error('other_id')
                            <span class="alert-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('is_verified','ID verification: ',['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{Form::checkbox('is_verified',1, @$user_detail->operator_info['is_verified'], ['id'=>'is_verified']) }}
                            Yes
                            @error('is_verified')
                            <span class="alert-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>  
                    <div class="form-group row hidden">
                        {{ Form::label('category','News Category* : ',['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">
                            @foreach ($category as $item)
                            <?php
                                $checked = false;
                                        //as we loop through a list of all itens, we compare to the values retrieved from our pivot table
                                if (isset($ass)) {
                                    if(in_array($item->id, $ass)) $checked = true;
                                }
                            ?>
                            {{ Form::checkbox('category[]', $item->id, $checked) }}
                            {{ $item->title}}
                                {{-- <label><input type="checkbox" name="category[]" value="{{$item->id}}"> {{$item->title}}</label><span></span> --}}
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group row hidden">
                        {{ Form::label('menu','Video Category* : ',['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">
                            @foreach ($menu as $item)
                            <?php
                                $checked = false;
                                        //as we loop through a list of all itens, we compare to the values retrieved from our pivot table
                                if (isset($men)) {
                                    if(in_array($item->id, $men)) $checked = true;
                                }
                            ?>
                            {{ Form::checkbox('menu[]', $item->id, $checked) }}
                            {{ $item->title}}
                                {{-- <label><input type="checkbox" name="menu[]" value="{{$item->id}}"> {{$item->title}}</label><span></span> --}}
                            @endforeach
                        </div>
                    </div>  
                    <div class="form-group row hidden">
                        {{ Form::label('blog','Blogs: ',['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{Form::checkbox('blog',1, @$user_detail->operator_info['blog'], ['id'=>'blog']) }}
                            Yes
                            @error('blog')
                            <span class="alert-danger">{{ $message }}</span>
                            @enderror
                        </div>                        
                    </div> 
                    <div class="form-group row hidden">
                        {{ Form::label('gallery','Gallery: ',['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{Form::checkbox('gallery',1, @$user_detail->operator_info['gallery'], ['id'=>'gallery']) }}
                            Yes
                            @error('gallery')
                            <span class="alert-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row hidden">
                        {{ Form::label('advertise','Advertise: ',['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{Form::checkbox('advertise',1, @$user_detail->operator_info['advertise'], ['id'=>'advertise']) }}
                            Yes
                            @error('advertise')
                            <span class="alert-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>               
                                        
                    <div class="form-group row">
                        {{ Form::label('country','Country*: ',['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{Form::text('country', @$user_detail->operator_info['country'], ['class'=>'form-control form-control-sm', 'id'=>'country', 'placeholder'=>'Enter country...', 'require'=>true]) }}
                            @error('country')
                            <span class="alert-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('city','City*: ',['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{Form::text('city', @$user_detail->operator_info['city'], ['class'=>'form-control form-control-sm', 'id'=>'city', 'placeholder'=>'Enter city...', 'require'=>true]) }}
                            @error('city')
                            <span class="alert-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('address','Address: ',['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{Form::text('address', @$user_detail->operator_info['address'], ['class'=>'form-control form-control-sm', 'id'=>'address', 'placeholder'=>'Enter User address...', 'require'=>false]) }}
                            @error('address')
                            <span class="alert-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>                                        
                    <div class="form-group row">
                        {{ Form::label('phone','Phone Number: ',['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{Form::tel('phone', @$user_detail->operator_info['phone'], ['class'=>'form-control form-control-sm', 'id'=>'phone', 'placeholder'=>'Enter User phone...', 'require'=>false]) }}
                            @error('phone')
                            <span class="alert-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                   
                    <div class="form-group row">
                        {{ Form::label('detail','Description: ',['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">   
                            {{Form::textarea('detail', @$user_detail->operator_info['detail'], ['class'=>'form-control form-control-sm', 'id'=>'detail', 'placeholder'=>'Enter Additional Information...', 'require'=>false,'rows'=>5,'style'=>'resize-none']) }}
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
                                @if (file_exists(public_path().'/upload/users/'.$user_detail->operator_info['image']))
                                <img id="old" src="{{ asset('/upload/users/'.$user_detail->operator_info['image']) }}">
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
@endsection