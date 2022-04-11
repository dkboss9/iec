@extends('layouts.admin')
@section('title', 'FSTV | Operators list')

@section('content')
<div class="container-fluid">
                        
    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">Operators Elements</h5>
            
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
                        <h6 class="panel-title txt-dark">Operators List</h6>
                    </div>
                    <div class="clearfix"></div>
                    <div class="pull-right">
                        <a href="{{ route('operator.create') }}" class="btn btn-default btn-rounded" style="border-bottom: 50%">
                            <i class="fa fa-plus-circle">Add</i>
                        </a>
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
                                            <th>Status</th>
                                            <th>News Category Permitted</th>
                                            <th>Video Category Permitted</th>
                                            <th>Other Permission</th>
                                            <th>Action</th>
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
                                                    <td>
                                                        @isset($row->categories)                                                            
                                                        @foreach ($row->categories as $item)
                                                            <li>{{($item->c)}}</li>
                                                        @endforeach
                                                        @endisset
                                                    </td>
                                                    <td>
                                                        @isset($row->menu)
                                                        @foreach ($row->menu as $item)
                                                            <li>{{($item->m)}}</li>
                                                        @endforeach
                                                        @endisset
                                                    </td>
                                                    <td><ul>
                                                            <li>{{ ($row->operator_info['blog'] == 1) ? 'Blogs' : ''}}</li>
                                                            <li>{{ ($row->operator_info['gallery'] == 1) ? 'Gallery' : ''}}</li>
                                                            <li>{{ ($row->operator_info['adver'] == 1) ? 'Advertise' : ''}}</li>
                                                        </ul>   
                                                    </td>
                                                    <td>
                                                        <ul class="nav nav-pills">
                                                            <li>
                                                                <a data-toggle="tooltip" data-placement="bottom" title="edit" href="{{ route('operator.edit', $row->id) }}">
                                                                    <i class="fa fa-edit fa-2x" style="color:#878787;"></i>
                                                                </a> 
                                                            </li>
                                                            <li>
                                                                <a data-toggle="tooltip" data-placement="bottom" title="delete" href="">
                                                                    {{ Form::open(['url'=>route('operator.destroy', $row->id), 'class'=>'form float-right', 'onsubmit'=>'return confirm("Are you sure to delete??")']) }}
                                                                    @method('delete')
                                                                    {{ Form::button('<i class="fa fa-trash fa-1x" style="color:#fa1b1b;"></i>',['type'=>'submit']) }}
                                                                    {{ Form::close() }}
                                                                </a>
                                                            </li>
                                                        </ul>                                                            
                                                    </td>
                                                </tr>                                                   
                                            @endforeach                                            
                                        @endif   
                                    </tbody>
                                </table>
                                {{-- {!! $data->render() !!} --}}
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