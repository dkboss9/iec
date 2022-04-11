@extends('layouts.operator')
@section('title')
    FSTV NEWS | Advertise
@endsection
@section('content')
<div class="container-fluid">
                        
    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">Advertise Elements</h5>
            
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
                        <h6 class="panel-title txt-dark">Advertisment List</h6>
                    </div>
                    <div class="clearfix"></div>
                    {{-- <div class="pull-right">
                        <a href="{{ route('advertise.create') }}" class="btn btn-default btn-rounded" style="border-bottom: 50%">
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
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th>Views</th>
                                      </tr>
                                    </thead>
                                    <tbody>  
                                        @if ($advertise)
                                        <?php $i=0; ?>
                                            @foreach ($advertise as $row) 
                                                <?php $i++;
                                                    $a = App\Models\Adsvisit::where('ads_id',$row->id)->count();
                                                ?>
                                                <tr>
                                                    <td><?php echo $i;?></td>
                                                    <td>{{ ucfirst($row->title)}}</td>
                                                    <td>{{ $row->type}}</td>
                                                   
                                                    <td>
                                                        <span class="badge badge-{{ $row->status == 'active' ? 'success' : 'danger' }}">
                                                            {{ ucfirst(($row->status == 'active') ? 'Published' : 'Un-Published') }}
                                                        </span>
                                                    </td>
                                                    <td><?php echo $a;?></td>
                                                </tr>                                                   
                                            @endforeach                                            
                                        @endif 
                                    </tbody>
                                </table>
                                {{-- {{$advertise->links()}} --}}
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