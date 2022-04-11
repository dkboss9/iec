@extends('layouts.operator')
@section('title','FSTV| Support')
@section('content')
    <div class="container-fluid">
                        
        <!-- Title -->
        <div class="row heading-bg">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-dark">Support Elements</h5>
                
            </div>
        </div>
        <!-- /Title -->

        @if (Session::has('message'))
            <div class="success success-info">{{ Session::get('message') }}</div>
        @endif 
        
        <!-- Row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default card-view">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h6 class="panel-title txt-dark">Support Table</h6>
                        </div>
                        <div class="clearfix"></div>
                        <div class="pull-right">
                            <!-- Button trigger modal -->
                            <a type="button" class="btn btn-default btn-rounded" style="border-bottom: 50%" data-toggle="modal" data-target="#feedbackModal">
                                <i class="fa fa-plus-circle"><span></span> Create</i>
                            </a>
                            
                            <!-- Modal -->
                            <div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <form method="post" role="form" action="{{route('feedback.store')}}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>                                
                                            <h4 class="modal-title">Your message to Admin</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group row">
                                                {{ Form::label('title','Title* : ',['class'=>'col-sm-3']) }}
                                                <div class="col-sm-9">
                                                    {{Form::text('title', '', ['class'=>'form-control form-control-sm', 'id'=>'title', 'placeholder'=>'Enter title...', 'require'=>true]) }}
                                                    @error('title')
                                                    <span class="alert-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>                                                       
                                            <div class="form-group row">
                                                {{ Form::label('message','Message* : ',['class'=>'col-sm-3']) }}
                                                <div class="col-sm-9">
                                                    {{Form::textarea('message', '', ['class'=>'form-control', 'id'=>'message', 'placeholder'=>'Enter your message...', 'require'=>false, 'style'=>'resize: none;', 'rows' =>'8']) }}
                                                    @error('message')
                                                    <span class="alert-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>                                
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success" >Submit</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </form>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>                   


                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="table-wrap mt-40">
                                <div class="table-responsive">
                                    <table id="datable_1" class="table table-bordered table-hover display  pb-30" >
                                        <thead>
                                          <tr>
                                                <th>S.N</th>                                    
                                                <th>Title</th>
                                                <th>Message</th>                                               
                                          </tr>
                                        </thead>
                                        <tbody>  
                                            @if ($data)
                                            <?php $i=0; ?>
                                                @foreach ($data as $row) 
                                                    <?php $i++?>
                                                    <tr>
                                                        <td><?php echo $i;?></td>
                                                        <td>{{ $row->title }}</td>
                                                        <td>
                                                            {!! Illuminate\Support\Str::limit(html_entity_decode($row->message), 200) !!}
                                                        </td>
                                                    </tr>                                                   
                                                @endforeach                                            
                                            @endif 
                                        </tbody>
                                    </table>
                                    {{-- {{$data->links()}} --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>	
            </div>
        </div>
        <!-- /Row -->
        
    </div>

@endsection
