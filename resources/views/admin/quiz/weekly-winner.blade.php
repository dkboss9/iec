@extends('layouts.admin')
@section('title','Weekly Quiz Winner')
@section('content')

<div class="container-fluid">
                    
    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">Weekly Quiz Winner Elements</h5>            
        </div>
    </div>
    <!-- /Title -->
    @if (Session::has('message'))
        <div class="success success-info">{{ Session::get('message') }}</div>
    @endif 
    @if (Session::has('error'))
        <div class="success success-info">{{ Session::get('error') }}</div>
    @endif 
    
    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Weekly Quiz Winner Table</h6>
                    </div>
                    <div class="clearfix"></div>
                    {{-- <div class="pull-right">
                        <a href="{{ route('question.create') }}" class="btn btn-default btn-rounded" style="border-bottom: 50%">
                            <i class="fa fa-plus-circle">Add</i>
                        </a>
                    </div> --}}
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="table-wrap mt-40">
                            <div class="table-responsive">
                                <table id="datable_1" class="table table-bordered table-hover display  pb-30" >
                                    <thead>
                                        <tr>
                                            <th>S.N</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            {{-- <th>Question</th> --}}
                                            {{-- <th>Action</th> --}}
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if($data)
                                            @foreach($data as $key => $value)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{ $value->created_by['name'] }}</td>
                                                    <td>{{@ $value->created_by['email'] }}</td>
                                                    {{-- <td>{{ $value->question_info['title'] }}</td> --}}
                                                    
                                                    {{-- <td>
                                                        <ul class="nav nav-pills">
                                                            <li>
                                                                <a data-toggle="tooltip" data-placement="bottom" title="edit" href="{{ route('question.edit', $value->id) }}">
                                                                    <i class="fa fa-edit fa-2x" style="color:#878787;"></i>
                                                                </a> 
                                                            </li>
                                                            <li>
                                                                <a data-toggle="tooltip" data-placement="bottom" title="delete" href="">
                                                                    {{ Form::open(['url'=>route('question.destroy', $value->id), 'class'=>'form float-right', 'onsubmit'=>'return confirm("Are you sure to delete??")']) }}
                                                                    @method('delete')
                                                                    {{ Form::button('<i class="fa fa-trash fa-1x" style="color:#fa1b1b;"></i>',['type'=>'submit']) }}
                                                                    {{ Form::close() }}
                                                                </a>
                                                            </li>
                                                        </ul>                                                            
                                                    </td> --}}
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                    {{-- {{ $data->links() }}                                 --}}
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
