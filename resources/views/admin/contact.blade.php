@extends('layouts.admin')
@section('title','Contact')
@section('content')
    <div class="container-fluid">
                        
        <!-- Title -->
        <div class="row heading-bg">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-dark">Contact Elements</h5>
                
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
                            <h6 class="panel-title txt-dark">Contact Table</h6>
                        </div>
                        <div class="clearfix"></div>
                        {{-- <div class="pull-right">
                            <a href="{{ route('contact.create') }}" class="btn btn-default btn-rounded" style="border-bottom: 50%">
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
                                                <th>Email</th>
                                                <th>Address</th>
                                                <th>Phone No.</th>
                                                {{-- <th>Description</th> --}}
                                                <th>Country</th>
                                              <th class="text-nowrap">Action</th>
                                          </tr>
                                        </thead>
                                        <tbody>  
                                            @if ($contact_data)
                                            <?php $i=0; ?>
                                                @foreach ($contact_data as $row) 
                                                    <?php $i++?>
                                                    <tr>
                                                        <td><?php echo $i;?></td>
                                                        <td>{{ $row->email }} <?php echo "<br>" ?> {{$row->email2}} </td>
                                                        <td>{{ $row->address }} <?php echo "<br>" ?> {{ $row->address2 }}</td>
                                                        <td>{{ $row->phone }} <?php echo "<br>" ?> {{ $row->phone2 }}</td>
                                                        {{-- <td>{!! Illuminate\Support\Str::limit(html_entity_decode($row->detail), 200) !!}</td> --}}

                                                        <td>{{($row->country == 'aus')? 'Australia' : 'Nepal' }}</td>{{-- <td>{{ $row->created_by['name'] }}</td> --}}
                                                        <td>
                                                            <ul class="nav nav-pills">
                                                                <li>
                                                                    <a href="{{ route('contact.edit', $row->id) }}">
                                                                        <i class="fa fa-edit fa-2x" style="color:#878787;"></i>
                                                                    </a> 
                                                                </li>
                                                                {{-- <li>
                                                                    <a href="">
                                                                        {{ Form::open(['url'=>route('contact.destroy', $row->id), 'class'=>'form float-right', 'onsubmit'=>'return confirm("Are you sure to delete??")']) }}
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
                                    {{$contact_data->links()}}
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
