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
    @if($errors->any())
    {{ implode('', $errors->all('<div>:message</div>')) }}
@endif
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
                                {{ Form::open(['url'=>route('quizprogram/update', @$program_detail->id),'id'=>"uploadform", 'files'=>true, 'class'=> 'form']) }}
                                @method('put')
                            @else
                                {{ Form::open(['url'=>route('quizprogram/store'), 'files'=>true, 'class'=> 'form', 'id'=>"uploadform"]) }}
                            @endif
        
        
                            <div class="form-group row">
                                {{ Form::label('name','Title* : ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::text('name', @$program_detail->name, ['class'=>'form-control form-control-sm', 'id'=>'title', 'placeholder'=>'Enter title...', 'require'=>true]) }}
                                    @error('name')
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
                                <div class="col-md-12">
                                    <div class="row">
                                        <?php 
                                        $time = $program_detail->start??null ? date('Y-m-d\TH:i', strtotime(@$program_detail->start)) : date('Y-m-d\TH:i');
                                        ?>
                                        {{ Form::label('program_time','Quiz time*: ',['class'=>'col-sm-3']) }}
                                        <div class="col-md-6">
                                            {{ Form::input('dateTime-local',  'program_time', $time,['id'=>'program_time', 'min'=>\Carbon\Carbon::now(), 'require'=>true, 'class'=>'form-control form-control-sm'] ) }}
                                            @error('start')
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
                                {{ Form::label('image', 'Image:',['class'=>'col-sm-3']) }}
                                <div class="col-sm-4">
                                    {{ Form::file('image', ['id'=>'image', 'accept'=>'image/*'])}} 
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
                            <?php
                            $free_yes = !isset($program_detail->is_free) ||  @$program_detail->is_free == 'Yes' ? "checked" : "";
                            $free_no = @$program_detail->is_free == 'No' ? "checked" : "";
                            ?>
                            <div class="form-group row">
                                <label class="col-sm-3">Is Free?</label>
                                <div class="col-sm-9">
                                {!! Form::radio('is_free', 'Yes',$free_yes,array("id"=>"free_yes")) !!} Yes
                                {!! Form::radio('is_free', 'No',$free_no,array("id"=>"free_no")) !!} No
                                </div>
                            </div>    

                            <div class="form-group row row_price" <?php echo $free_no == "" ? 'style="display: none;"' : '';?>>
                                <label class="col-sm-3">Price</label>
                                <div class="col-sm-3">
                                {{Form::text('price', @$program_detail->price, ['class'=>'form-control form-control-sm', 'id'=>'price', 'placeholder'=>'Enter price...']) }}
                                @error('price')
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
    $('#is_parent').change(function(){
       let is_checked =$(this).prop('checked');
       if (is_checked){
           $('#parent_id').change();
           $('#div_parent').addClass('hidden');
       } else {
           $('#div_parent').removeClass('hidden');
       }
    });

    $("#free_yes").click(function(){
        $(".row_price").hide();
    });

    $("#free_no").click(function(){
        $(".row_price").show();
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
