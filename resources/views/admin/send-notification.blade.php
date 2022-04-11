@extends('layouts.admin')
@section('title','FSTV| Notification')

@section('content')
<div class="container-fluid">
					
    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
          <h5 class="txt-dark">Mass Notification</h5>
        </div>
    </div>
    <!-- /Title -->
    
    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view col-md-8">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Mass Notification Form</h6>
                    </div>
                    <div class="clearfix"></div>
                    <p>(Please fill up any one)</p>
                </div>

                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="form-wrap">
                    @if(isset($notification_detail))
                        {{ Form::open(['url'=>route('usernotification.update', $notification_detail->id), 'files'=>true, 'class'=> 'form']) }}
                        @method('put')
                    @else
                        {{ Form::open(['url'=>route('usernotification.store'), 'files'=>true, 'class'=> 'form']) }}
                    @endif

                    <div class="form-group row">
                        <div class="col-sm-12">
                            {{ Form::label('title','Title: ',['class'=>'col-sm-3']) }}
                            {{Form::text('title', @$notification_detail->title, ['class'=>'form-control form-control-sm', 'id'=>'title', 'placeholder'=>'Enter title...']) }}
                            @error('title')
                            <span class="alert-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-12">   
                            {{ Form::label('description','Message: ') }}
                            {{Form::textarea('description', @$notification_detail->description, ['class'=>'form-control form-control-sm', 'id'=>'description', 'placeholder'=>'Enter Additional Information...', 'require'=>false,'rows'=>5,'style'=>'resize-none']) }}
                            @error('description')
                            <span class="alert-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        {{ Form::label('','',['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">
                           {{ Form::button("<i class='fa fa-paper-plane'></i> SEND", ['class'=>'btn btn-success','type'=>'submit']) }}
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