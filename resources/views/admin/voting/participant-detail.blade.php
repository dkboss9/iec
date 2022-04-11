@extends('layouts.admin')
@section('title','Participant Detail')
@section('content')

<div class="container-fluid">
                    
    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">Participant Detail Elements</h5>            
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
                        <h6 class="panel-title txt-dark">Participant Detail Table</h6>
                    </div>
                    <div class="clearfix"></div>
                    {{-- <div class="pull-right">
                        <a href="{{ route('voting.create') }}" class="btn btn-default btn-rounded" style="border-bottom: 50%">
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
                                            <th>Name</th>
                                            <th>Program</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Image</th>
                                            {{-- <th>Action</th> --}}
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if($data)
                                        <tr>
                                            <td>{{ $data->name }}</td>
                                            <td>{{ $data->program_info['program'] }}</td>
                                            <td>{!! $data->detail !!}</td>
                                            <td>
                                                <span class="badge badge-{{ $data->status == 'active' ? 'success' : 'danger' }}">
                                                    {{ ucfirst(($data->status == 'active') ? 'Active' : 'In-active') }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ asset('upload/participant/'.$data->photo) }}">
                                                    <img src="{{ asset('upload/participant/'.$data->photo) }}" style="max-width: 150px; max-height:90px;" alt="">
                                                </a>
                                            </td>
                                        </tr>
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
