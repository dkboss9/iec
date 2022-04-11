@extends('layouts.operator')
@section('title','FSTV | News')
@section('content')

<div class="container-fluid">
                    
    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">News Elements</h5>
            
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
                        <h6 class="panel-title txt-dark">News Table</h6>
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
                                            <th>Detail</th>
                                            <th>Status</th>
                                            <th>Trending</th>
                                            <th>Hot News</th>
                                            <th>Featured</th>
                                            <th>Popular</th>
                                            <th>Added By</th>
                                            {{-- <th class="text-nowrap">Action</th> --}}
                                        </tr>
                                    </thead>
                                    
                                    <tbody>  
                                        @if ($post_data)
                                            @foreach ($post_data as $row) 
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{ $row->title}}</td>
                                                    <td>
                                                        {{ @$row->cat_info['title'] }}
                                                        @if ($row->sub_cat_info)
                                                            >> {{ $row->sub_cat_info['title'] }} 
                                                        @endif
                                                    </td>
                                                    <td>{!! Illuminate\Support\Str::limit(html_entity_decode($row->detail), 200) !!}</td>
                                                    <td>Published</td>
                                                    <td>
                                                        <span>{{ ($row->is_trending == 1) ? 'YES' : 'No'}}</span>
                                                    </td>
                                                    <td>
                                                        <p id="hotNews{{$row->id}}" class="{{in_array($row->id, $hotNews_post_id)? 'noHotNews' : 'hotNews'}} " hotNews_id="{{$row->id}}">
                                                            @if(in_array($row->id, $hotNews_post_id))
                                                                YES
                                                            @else
                                                                NO                                                                                                                                                        
                                                            @endif
                                                        </p>                                                                                                            
                                                    </td> 
                                                    <td>
                                                        <p id="featured{{$row->id}}" class="{{in_array($row->id, $featured_post_id)? 'unfeatured' : 'featured'}} " featured_id="{{$row->id}}">
                                                            @if(in_array($row->id, $featured_post_id))
                                                                YES
                                                            @else
                                                                NO                                                                                                                                                      
                                                            @endif
                                                        </p> 
                                                    </td>  
                                                    <td>
                                                        <p id="popular{{$row->id}}" class="{{in_array($row->id, $popular_post_id)? 'unpopular' : 'popular'}} " popular_id="{{$row->id}}">
                                                            @if(in_array($row->id, $popular_post_id))
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
                                {{-- {{$post_data->links()}} --}}
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