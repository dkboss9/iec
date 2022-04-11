@extends('layouts.admin')
@section('title','FSTV | News Review')
@section('content')

<div class="container-fluid">
                    
    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">News Review Elements</h5>
            
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
                        <h6 class="panel-title txt-dark">News Review Table</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="table-wrap">
                            <div class="table-responsive">
                                <table id="datable_1" class="table table-bordered table-hover display  pb-30" >
                                    <thead>
                                        <tr>
                                            <th>S.N.</th>
                                            <th>News title</th>
                                            <th>Category</th>
                                            <th>Comments</th>                                            
                                            <th>Comments By</th>
                                            <th class="text-nowrap">Action</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>  
                                        @if ($data)
                                            @foreach ($data as $row) 
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{ $row->post_info['title']}}</td>
                                                    <td>
                                                        {{ @$row->post_info->cat_info['title'] }}
                                                        @if ($row->post_info->sub_cat_info)
                                                            >> {{ $row->post_info->sub_cat_info['title'] }} 
                                                        @endif
                                                    </td>
                                                    <td>{!! Illuminate\Support\Str::limit(html_entity_decode($row->comments), 500) !!}</td>
                                                    <td>{{$row->name}}</td>                                        
                                                    <td>
                                                        <ul class="nav nav-pills">
                                                            <li>
                                                                <a data-toggle="tooltip" data-placement="bottom" title="delete" href="">
                                                                    {{ Form::open(['url'=>route('review.destroy', $row->id), 'class'=>'form float-right', 'onsubmit'=>'return confirm("Are you sure to delete??")']) }}
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
                                {{-- {{$data->links()}} --}}
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
<script>
    $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip();   
    });
</script>
    
@endsection