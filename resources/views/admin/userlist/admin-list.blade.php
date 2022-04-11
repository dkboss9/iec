@extends('layouts.admin')
@section('title', 'FSTV | Admin list')

@section('content')
<div class="container-fluid">
                        
    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">Admin Elements</h5>
            
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
                        <h6 class="panel-title txt-dark">Admin List</h6>
                    </div>
                    <div class="clearfix"></div>
                    <div class="pull-right">
                        @if (auth()->user()->id == '1')
                        <a href="{{ route('users.create') }}" class="btn btn-default btn-rounded" style="border-bottom: 50%">
                            <i class="fa fa-plus-circle">Add</i>
                        </a>                            
                        @endif
                    </div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="table-wrap mt-40">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered table-dark mb-0">
                                    <thead>
                                      <tr>
                                            <th>S.N.</th>                                   
                                            <th>Name</th>                                  
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Status</th>
                                            @if (auth()->user()->id == '1')
                                            <th>Action</th>                                                
                                            @endif
                                      </tr>
                                    </thead>
                                    <tbody>
                                        @if ($data)
                                            @foreach ($data as $row) 
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{ $row->name}}</td>
                                                    <td>{{ $row->email}}</td>
                                                    <td>{{ $row->status}}</td>
                                                    <td>{{ ucfirst($row->role)}}</td>
                                                    @if (auth()->user()->id == '1')
                                                    <td>
                                                    <ul class="nav nav-pills">
                                                        <li>
                                                            <a data-toggle="tooltip" data-placement="bottom" title="edit" href="{{ route('users.edit', $row->id) }}">
                                                                <i class="fa fa-edit fa-2x" style="color:#878787;"></i>
                                                            </a> 
                                                        </li>
                                                            <li>
                                                                <a data-toggle="tooltip" data-placement="bottom" title="delete" href="">
                                                                    {{ Form::open(['url'=>route('users.destroy', $row->id), 'class'=>'form float-right', 'onsubmit'=>'return confirm("Are you sure to delete??")']) }}
                                                                    @method('delete')
                                                                    {{ Form::button('<i class="fa fa-trash fa-1x" style="color:#fa1b1b;"></i>',['type'=>'submit']) }}
                                                                    {{ Form::close() }}
                                                                </a>
                                                            </li>                                                                
                                                        </ul>                                                            
                                                    </td>
                                                    @endif
                                                </tr>                                                   
                                            @endforeach                                            
                                        @endif   
                                    </tbody>
                                </table>
                                {{$data->links()}}
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
@section('scripts')
    
@endsection