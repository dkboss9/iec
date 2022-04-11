@extends('layouts.admin')
@section('title','Gallery')
@section('content')
    <div class="container-fluid">
                        
        <!-- Title -->
        <div class="row heading-bg">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-dark">Company Elements</h5>
                
            </div>
        </div>
        <!-- /Title -->
        @if (Session::has('message'))
            <div class="success success-info">{{ Session::get('message') }}</div>
        @endif 
        @if (Session::has('error'))
            <div class="alert alert-info">{{ Session::get('error') }}</div>
        @endif 
        
        <!-- Row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default card-view">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h6 class="panel-title txt-dark">Company Table</h6>
                        </div>
                        <div class="clearfix"></div>
                        <div class="pull-right">
                            <a href="{{ route('company/create') }}" class="btn btn-default btn-rounded" style="border-bottom: 50%">
                                <i class="fa fa-plus-circle">Add</i>
                            </a>
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
                                                <th>Image</th>
                                                <th>Status</th>
                                                <th>Added By</th>
                                              <th class="text-nowrap">Action</th>
                                          </tr>
                                        </thead>
                                        <tbody>  
                                            @if ($company_data)
                                            <?php $i=0; ?>
                                                @foreach ($company_data as $row) 
                                                    <?php $i++?>
                                                    <tr>
                                                        <td><?php echo $i;?></td>
                                                        <td>{{ $row->title}}</td>                                                       
                                                        <td>
                                                            <a href="{{ asset('upload/company/'.$row->image) }}">
                                                                <img src="{{ asset('upload/company/'.$row->image) }}" style="max-width: 120px; max-height:90px;" alt="">
                                                            </a>
                                                        </td>
                                                        <td>{{($row->status)}}</td>
                                                        <td>{{($row->created_by['name'])}}</td>
                                                        <td>
                                                            <ul class="nav nav-pills">
                                                                <li>
                                                                    <a href="{{ route('company/edit', $row->id) }}">
                                                                        <i class="fa fa-edit fa-2x" style="color:#878787;"></i>
                                                                    </a> 
                                                                </li>
                                                                <li>
                                                                    <a href="">
                                                                        {{ Form::open(['url'=>route('company/destroy', $row->id), 'class'=>'form float-right', 'onsubmit'=>'return confirm("Are you sure to delete??")']) }}
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
                                    {{-- {{$gallery_data->links()}} --}}
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
