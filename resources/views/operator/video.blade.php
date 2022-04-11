@extends('layouts.operator')
@section('title','FSTV| Videos')
@section('content')
    <div class="container-fluid">
                        
        <!-- Title -->
        <div class="row heading-bg">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-dark">FSTV Videos</h5>
                
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
                            <h6 class="panel-title txt-dark">FSTV Videos Table</h6>
                        </div>
                        <div class="clearfix"></div>
                        <div class="pull-right">
                            <a href="{{ route('video.create') }}" class="btn btn-default btn-rounded" style="border-bottom: 50%">
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
                                                <th>Category</th>                                                
                                                <th>Tags</th>                                                
                                                <th>Status</th>
                                                <th>Trending</th>
                                                {{-- <th>Added By</th> --}}
                                                <th class="text-nowrap">Action</th>
                                          </tr>
                                        </thead>
                                        <tbody>  
                                            @if ($data)
                                            <?php $i=0; ?>
                                                @foreach ($data as $row) 
                                                    <?php $i++?>
                                                    <tr>
                                                        <td><?php echo $i;?></td>
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
                                                        
                                                        {{-- <td>{{ ($row->created_by['name']) }}</td> --}}
                                                        <td>
                                                            <ul class="nav nav-pills">
                                                                
                                                                <li>
                                                                    <a data-toggle="tooltip" data-placement="bottom" title="edit" href="{{ route('video.edit', $row->id) }}">
                                                                        <i class="fa fa-edit fa-2x" style="color:#878787;"></i>
                                                                    </a> 
                                                                </li>
                                                                <li>
                                                                    <a data-toggle="tooltip" data-placement="bottom" title="featured" href="javascript:void(0);" id="featured{{$row->id}}" class="{{in_array($row->id, $featured_video_id)? 'unfeatured' : 'featured'}} " featured_id="{{$row->id}}">
                                                                        @if(in_array($row->id, $featured_video_id))
                                                                            <i class="fa fa-2x fa-star" style="color:#e60a0a;" id="icon"></i>
                                                                        @else
                                                                            <i class="fa fa-2x fa-star-o" style="color:#e60a0a;" id="icon"></i>                                                                                                                                                        
                                                                        @endif
                                                                    </a> 
                                                                </li>
                                                                <li>
                                                                    <a data-toggle="tooltip" data-placement="bottom" title="popular" href="javascript:void(0);" id="popular{{$row->id}}" class="{{in_array($row->id, $popular_video_id)? 'unpopular' : 'popular'}} " popular_id="{{$row->id}}">
                                                                        @if(in_array($row->id, $popular_video_id))
                                                                            <i class="fa fa-2x fa-heart" style="color:#e60a0a;" id="icon"></i>
                                                                        @else
                                                                            <i class="fa fa-2x fa-heart-o" style="color:#e60a0a;" id="icon"></i>                                                                                                                                                        
                                                                        @endif
                                                                    </a> 
                                                                </li>
                                                                <li>
                                                                    <a data-toggle="tooltip" data-placement="bottom" title="delete" href="">
                                                                        {{ Form::open(['url'=>route('video.destroy', $row->id), 'class'=>'form float-right', 'onsubmit'=>'return confirm("Are you sure to delete??")']) }}
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
    $("document").ready(function(){
        setTimeout(function(){
           $(".success-info").remove();
        }, 5000 ); // 5 secs   
    });
</script>
<script>
    $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip();   
    });
</script>
<script>
$(document).ready(function(e){
    $(document).on("click",".featured",function() {

        if(!confirm("Are you sure to make featured?"))
        return false;

        $(this).find('i').toggleClass('fa-star-o fa-star').css('color', '#e60a0a')
        var featured_id = $(this).attr("featured_id");
        // alert(featured_id);
        if(!featured_id){
            return false;
        }else{
        
            // alert(featured_id);
            $.ajax({
                method: "POST",
                url: "{{ route('featured-video') }}",
                data: { 
                    featured_id: featured_id ,
                    "_token": "{{ csrf_token() }}",
                    }
            })
                .done(function() {
                    alert("added to featured.");
                    $("#featured"+ featured_id).addClass("unfeatured");
                    $("#featured"+ featured_id).removeClass("featured");
                    location.reload();
                });
        }
        
    });

    $(document).on("click",".unfeatured",function(e) {

        if(!confirm("Are you sure to remove featured?"))
        return false;
        
        $(this).find('i').toggleClass('fa-star fa-star-o')
        var featured_id = $(this).attr("featured_id");
        // alert(featured_id);
        if(!featured_id){
            return false;
        }else{
        
            // alert(featured_id);
            $.ajax({
                method: "POST",
                url: "{{ route('unfeatured-video') }}",
                data: { 
                    featured_id: featured_id ,
                    "_token": "{{ csrf_token() }}",
                    }
            })
                .done(function() {
                    alert("Removed featured.");
                    $("#featured"+ featured_id).addClass("featured");
                    $("#featured"+ featured_id).removeClass("unfeatured");
                    location.reload();
                });
        }
        
    });

    
});
</script>
<script>
    $(document).ready(function(e){
        $(document).on("click",".popular",function() {
    
            if(!confirm("Are you sure to make popular?"))
            return false;
    
            $(this).find('i').toggleClass('fa-heart-o fa-heart').css('color', '#e60a0a')
            var popular_id = $(this).attr("popular_id");
            // alert(popular_id);
            if(!popular_id){
                return false;
            }else{
            
                // alert(popular_id);
                $.ajax({
                    method: "POST",
                    url: "{{ route('popular-video') }}",
                    data: { 
                        popular_id: popular_id ,
                        "_token": "{{ csrf_token() }}",
                        }
                })
                    .done(function() {
                        alert("added to popular.");
                        $("#popular"+ popular_id).addClass("unpopular");
                        $("#popular"+ popular_id).removeClass("popular");
                        location.reload();
                    });
            }
            
        });
    
        $(document).on("click",".unpopular",function(e) {
    
            if(!confirm("Are you sure to remove popular?"))
            return false;

            $(this).find('i').toggleClass('fa-heart fa-heart-o')
            var popular_id = $(this).attr("popular_id");
            // alert(popular_id);
            if(!popular_id){
                return false;
            }else{
            
                // alert(popular_id);
                $.ajax({
                    method: "POST",
                    url: "{{ route('unpopular-video') }}",
                    data: { 
                        popular_id: popular_id ,
                        "_token": "{{ csrf_token() }}",
                        }
                })
                    .done(function() {
                        alert("Removed popular.");
                        $("#popular"+ popular_id).addClass("popular");
                        $("#popular"+ popular_id).removeClass("unpopular");
                        location.reload();
                    });
            }
            
        });
    
        
    });
</script>
@endsection
