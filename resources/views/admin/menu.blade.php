@extends('layouts.admin')
@section('title')
    FSTV | Main Menu
@endsection
@section('content')
    <div class="container-fluid">
                        
        <!-- Title -->
        <div class="row heading-bg">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-dark">Main Menu element</h5>
                
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
                            <h6 class="panel-title txt-dark">Main Menu List</h6>
                        </div>
                        <div class="clearfix"></div>
                        <div class="pull-right">
                            <a href="" data-toggle="modal" class="btn btn-default btn-rounded" style="border-bottom: 50%" data-target="#myModal" }}">
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
                                                <th>S.N</th>                                    
                                                <th>Title</th>                                                                                             
                                                <th>Added By</th>
                                                <th>Created By</th>
                                              <th class="text-nowrap">Action</th>
                                          </tr>
                                        </thead>
                                        <tbody>  
                                            @if ($menu)
                                            <?php $i=0; ?>
                                                @foreach ($menu as $row) 
                                                    <?php $i++?>
                                                    <tr>
                                                        <td><?php echo $i;?></td>
                                                        <td>{{ $row->cat_info['title']}}</td>                                                      
                                                        
                                                        <td>{{ $row->created_by['name'] }}</td>
                                                        <td>{{ $row->created_at->format('Y-m-d') }}</td>
                                                        <td>
                                                            <ul class="nav nav-pills">                                                              
                                                                <li>
                                                                    <a href="">
                                                                        {{ Form::open(['url'=>route('menu.destroy', $row->id), 'class'=>'form float-right', 'onsubmit'=>'return confirm("Are you sure to delete??")']) }}
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

                                </div>
                            </div>
                        </div>
                    </div>
                </div>	
            </div>
        </div>
        <!-- /Row -->
        
    </div>

    <!-- Modal -->
    <div id="myModal" class="modal fade">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h5 class="modal-title" id="exampleModalLabel1">Add Menu Item</h5>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{route("menu.store")}}">
                        @csrf
                        <div class="form-group-row">
                            <label for="cat_id" class="control-label">Category:</label>
                            <select id="cat_id" name="cat_id" required= 'true'>
                                <option><--Select Category Name--></option>
                                @foreach ($category as $item) 
                                {
                                    <option value="{{ $item->id }}">{{ $item->title }}</option>
                                }
                                @endforeach
                            </select>                                                                                               
                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-danger">Reset</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>
    <!-- /.modal -->
@endsection