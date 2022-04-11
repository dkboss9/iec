@extends('layouts.operator')
@section('title','FSTV | Videos')
@section('content')

<div class="container-fluid">
                    
    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">FSTV Videos Elements</h5>
            
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
                        <h6 class="panel-title txt-dark">FSTV Videos Table</h6>
                    </div>
                    <div class="clearfix"></div>
                    {{-- <div class="pull-right">
                        <a href="{{ route('post.create') }}" class="btn btn-default btn-rounded" style="border-bottom: 50%">
                            <i class="fa fa-plus-circle">Add</i>
                        </a>
                    </div> --}}
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
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Tags</th>
                                            <th>Status</th>
                                            <th>Trending</th>
                                            <th>Featured</th>
                                            <th>Popular</th>
                                            <th>Added By</th>
                                            {{-- <th class="text-nowrap">Action</th> --}}
                                        </tr>
                                    </thead>
                                    
                                    <tbody>  
                                        @if ($data)
                                            @foreach ($data as $row) 
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{ $row->title}}</td>
                                                    <td>{{ $row->menu_info['title'] }} >> {{$row->submenu_info['title']}}
                                                        @isset($row->childmenu_info['title']) >>{{$row->childmenu_info['title']}} @endisset
                                                    </td>                                                       
                                                    <td>
                                                        @foreach($row->tags as $tag)
                                                            <label class="label label-info">{{ $tag['name'] }}</label>
                                                        @endforeach
                                                    </td>                                                       
                                                    <td>{{ $row->status}}</td>
                                                    <td>
                                                        <span>{{ ($row->is_trending == 1) ? 'Trending' : 'No'}}</span>
                                                    </td>          
                                                    <td>
                                                        <p id="featured{{$row->id}}" class="{{in_array($row->id, $featured_video_id)? 'unfeatured' : 'featured'}} " featured_id="{{$row->id}}">
                                                            @if(in_array($row->id, $featured_video_id))
                                                                YES
                                                            @else
                                                                NO                                                                                                                                                     
                                                            @endif
                                                        </p>                                                                                                            
                                                    </td> 
                                                    <td>
                                                        <p id="popular{{$row->id}}" class="{{in_array($row->id, $popular_video_id)? 'unpopular' : 'popular'}} " popular_id="{{$row->id}}">
                                                            @if(in_array($row->id, $popular_video_id))
                                                                YES
                                                            @else
                                                                NO                                                                                                                                                        
                                                            @endif
                                                        </p> 
                                                    </td>                                                                                                                                                      
                                                    <td>{{$row->created_by['name']}}</td>                                        
                                           
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