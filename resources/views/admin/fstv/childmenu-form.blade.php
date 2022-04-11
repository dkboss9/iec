@extends('layouts.admin')
@section('title','Child-menu')

@section('content')

<div class="container-fluid">
					
    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
          <h5 class="txt-dark">Child-menu Elements</h5>
        </div>
    </div>
    <!-- /Title -->
    
    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view col-md-8">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Child-menu {{ isset($childmenu_detail)? 'Update' : 'Add' }} form</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="form-wrap">
                            @if(isset($childmenu_detail))
                                {{ Form::open(['url'=>route('childmenu.update', @$childmenu_detail->id),'id'=>"uploadform", 'files'=>true, 'class'=> 'form']) }}
                                @method('put')
                            @else
                                {{ Form::open(['url'=>route('childmenu.store'), 'files'=>true, 'class'=> 'form', 'id'=>"uploadform"]) }}
                            @endif
        
        
                            <div class="form-group row">
                                {{ Form::label('title','Title* : ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::text('title', @$childmenu_detail->title, ['class'=>'form-control form-control-sm', 'id'=>'title', 'placeholder'=>'Enter title...', 'require'=>true]) }}
                                    @error('title')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                {{ Form::label('subtitle','Sub-title: ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::text('subtitle', @$childmenu_detail->subtitle, ['class'=>'form-control form-control-sm', 'id'=>'subtitle', 'placeholder'=>'Enter subtitle...', 'require'=>false]) }}
                                    @error('subtitle')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                {{ Form::label('menu_id','Category* : ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::select('menu_id',$menu_info,@$childmenu_detail->menu_id, ['id'=>'menu_id', 'require'=>true, 'class'=>'form-control form-control-sm','placeholder'=>'--Select any one--']) }}
                                    @error('menu_id')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row " id="sub_menu_div">
                                {{ Form::label('submenu_id','Sub Category*: ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::select('submenu_id',[],@$childmenu_detail->submenu_id, ['id'=>'submenu_id', 'require'=>false, 'class'=>'form-control form-control-sm','placeholder'=>'--Select any one--']) }}
                                    @error('submenu_id')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                                                        
                            <div class="form-group row">
                                {{ Form::label('detail','Descriptions: ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::textarea('detail', html_entity_decode(@$childmenu_detail->detail), ['class'=>'form-control', 'id'=>'detail', 'placeholder'=>'Enter Category detail...', 'require'=>false, 'style'=>'resize: none;', 'rows' =>'5']) }}
                                  @error('detail')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                {{ Form::label('status','Status* : ',['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{Form::select('status',['active'=>'Publish', 'inactive'=>'Unpublish'],@$childmenu_detail->status, ['id'=>'status', 'require'=>true, 'class'=>'form-control form-control-sm']) }}
                                    @error('status')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                {{ Form::label('', 'Image',['class'=>'col-sm-3']) }}
                                <div class="col-sm-4">
                                    {{ Form::file('image', ['id'=>'image', 'required'=>false, 'accept'=>'iamge/*'])}} 
                                  @error('image')
                                    <span class="alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-4">
                                    <div class="thumbnail {{(isset($childmenu_detail)? '': 'hidden')}}" id="view" >
                                        <span class="close">&times;</span>
                                        @if (isset($childmenu_detail))
                                        @if (file_exists(public_path().'/upload/fstv/childmenu/'.$childmenu_detail->image))
                                        <img id="old" src="{{ asset('/upload/fstv/childmenu/'.$childmenu_detail->image) }}">
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
    $('#menu_id').change(function () {
            let menu_id = $(this).val();
            let submenu_id = "{{ isset($childmenu_detail) ? $childmenu_detail->submenu_id : null }}";

            $.ajax({
                url: "{{ route('get-submenu') }}",
                type: "post",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "menu_id": menu_id
                },
                success: function (response) {
                    if (typeof (response) != 'object') {
                        response = $.parseJSON(response);
                    }

                    var html_option = "<option value='' selected>--Select Any One--</option>"
                    if (response.status) {
                        //child category exists
                        $.each(response.data, function (key, value) {

                            html_option += "<option value='"+value.id+"' ";
                            if (submenu_id != null && submenu_id == value.id){
                                html_option += ' selected ';
                            }
                            html_option += ">" + value.title + "</option>"
                        });

                        $('#sub_menu_div').removeClass('hidden');
                    } else {
                        //child category do not exists
                        $('#sub_menu_div').addClass('hidden');
                    }

                    $('#submenu_id').html(html_option)
                }
            });
        });
        $('#menu_id').change();
</script>

<script>
    tinymce.init({
        selector: '#detail'
    });
</script>
@endsection
