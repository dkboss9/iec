@extends('layouts.operator')
@section('title','FSTV| Gallery')
@section('content')
    <div class="container-fluid">
                        
        <!-- Title -->
        <div class="row heading-bg">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-dark">Gallery Elements</h5>
                
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
                            <h6 class="panel-title txt-dark">Gallery Table</h6>
                        </div>
                        <div class="clearfix"></div>
                        {{-- <div class="pull-right">
                            <a href="{{ route('gallery.create') }}" class="btn btn-default btn-rounded" style="border-bottom: 50%">
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
                                                <th>Title</th>
                                                <th>Status</th>
                                                <th>Image</th>
                                          </tr>
                                        </thead>
                                        <tbody>  
                                            @if ($gallery_data)
                                            <?php $i=0; ?>
                                                @foreach ($gallery_data as $row) 
                                                    <?php $i++?>
                                                    <tr>
                                                        <td><?php echo $i;?></td>
                                                        <td>{{ $row->title}}</td>
                                                        <td>{{ $row->status }}</td>
                                                        <td>
                                                            <a href="{{ asset('upload/gallery/'.$row->image) }}" target="_blank">
                                                               {{-- {{$row->image}} --}}
                                                                <img src="{{ asset('upload/gallery/'.$row->image) }}" style="max-width: 120px; max-height:90px;" alt="">
                                                            </a>
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