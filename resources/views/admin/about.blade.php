@extends('layouts.admin')
@section('title','About Us')
@section('content')
    <div class="container-fluid">
                        
        <!-- Title -->
        <div class="row heading-bg">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-dark">About Us Elements</h5>
                
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
                            <h6 class="panel-title txt-dark">About Us Table</h6>
                        </div>
                        <div class="clearfix"></div>
                        {{-- <div class="pull-right">
                            <a href="{{ route('about.create') }}" class="btn btn-default btn-rounded" style="border-bottom: 50%">
                                <i class="fa fa-plus-circle">Add</i>
                            </a>
                        </div> --}}
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="table-wrap mt-40">
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered table-dark mb-0">
                                        <thead>
                                          <tr>
                                                <th>S.N</th>                                    
                                                <th>Title</th>
                                                <th>Sub-title</th>
                                                <th>Description</th>
                                                <th>Image</th>
                                                <th>Created By</th>
                                              <th class="text-nowrap">Action</th>
                                          </tr>
                                        </thead>
                                        <tbody>  
                                            @if ($about_data)
                                            <?php $i=0; ?>
                                                @foreach ($about_data as $row) 
                                                    <?php $i++?>
                                                    <tr>
                                                        <td><?php echo $i;?></td>
                                                        <td>{{ $row->title}}</td>
                                                        <td>{{ $row->subtitle }}</td>
                                                        <td>{!! Illuminate\Support\Str::limit(html_entity_decode($row->detail), 200) !!}</td>
                                                        <td>
                                                            <a href="{{ asset('upload/about/'.$row->image) }}">
                                                                {{$row->image}}
                                                                {{-- <img src="{{ asset('upload/about/'.$row->image) }}" style="max-width: 120px; max-height:90px;" alt=""> --}}
                                                            </a>
                                                        </td>
                                                        <td>{{ $row->created_by['name']}}</td>
                                                        <td>
                                                            <ul class="nav nav-pills">
                                                                <li>
                                                                    <a href="{{ route('about.edit', $row->id) }}">
                                                                        <i class="fa fa-edit fa-2x" style="color:#878787;"></i>
                                                                    </a> 
                                                                </li>
                                                                {{-- <li>
                                                                    <a href="">
                                                                        {{ Form::open(['url'=>route('about.destroy', $row->id), 'class'=>'form float-right', 'onsubmit'=>'return confirm("Are you sure to delete??")']) }}
                                                                        @method('delete')
                                                                        {{ Form::button('<i class="fa fa-trash fa-1x" style="color:#fa1b1b;"></i>',['type'=>'submit']) }}
                                                                        {{ Form::close() }}
                                                                    </a>
                                                                </li> --}}
                                                            </ul>                                                            
                                                        </td>
                                                    </tr>                                                   
                                                @endforeach                                            
                                            @endif 
                                        </tbody>
                                    </table>
                                    {{$about_data->links()}}
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
