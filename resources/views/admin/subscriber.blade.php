@extends('layouts.admin')
@section('title','Subscriber')
@section('content')

<div class="container-fluid">
                    
    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">Subscriber Elements</h5>
            
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
                        <h6 class="panel-title txt-dark">Subscriber Table</h6>
                    </div>
                    <div class="clearfix"></div>
                    {{-- <div class="pull-right">
                        <a href="{{ route('post.create') }}" class="btn btn-default btn-rounded" style="border-bottom: 50%">
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
                                                    <td>{{ $row->email}}</td>
                                                    <td>
                                                        <ul class="nav nav-pills">
                                                            <li>
                                                                <a href="">
                                                                    {{ Form::open(['url'=>route('sub-del', $row->id), 'class'=>'form float-right', 'onsubmit'=>'return confirm("Are you sure to delete??")']) }}
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
                url: "{{ route('featured-post') }}",
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
                url: "{{ route('unfeatured-post') }}",
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
    
            $(this).find('i').toggleClass('fa-star-o fa-star').css('color', '#e60a0a')
            var popular_id = $(this).attr("popular_id");
            // alert(popular_id);
            if(!popular_id){
                return false;
            }else{
            
                // alert(popular_id);
                $.ajax({
                    method: "POST",
                    url: "{{ route('popular-post') }}",
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
           
            $(this).find('i').toggleClass('fa-star fa-star-o')
            var popular_id = $(this).attr("popular_id");
            // alert(popular_id);
            if(!popular_id){
                return false;
            }else{
            
                // alert(popular_id);
                $.ajax({
                    method: "POST",
                    url: "{{ route('unpopular-post') }}",
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
<script>
    $(document).ready(function(e){
        $(document).on("click",".hotNews",function() {
    
            if(!confirm("Are you sure to make hot news?"))
            return false;
    
            $(this).find('i').toggleClass('fa-square-o fa-check-square-o')
            var hotNews_id = $(this).attr("hotNews_id");
            // alert(hotNews_id);
            if(!hotNews_id){
                return false;
            }else{
            
                // alert(hotNews_id);
                $.ajax({
                    method: "POST",
                    url: "{{ route('hotNews-post') }}",
                    data: { 
                        hotNews_id: hotNews_id ,
                        "_token": "{{ csrf_token() }}",
                        }
                })
                    .done(function() {
                        alert("added to hot news.");
                        $("#hotNews"+ hotNews_id).addClass("noHotNews");
                        $("#hotNews"+ hotNews_id).removeClass("hotNews");
                        location.reload();
                    });
            }
            
        });
    
        $(document).on("click",".noHotNews",function(e) {
    
            if(!confirm("Are you sure to remove Hot News?"))
            return false;
           
            $(this).find('i').toggleClass('fa-check-sqaure-o fa-square-o')
            var hotNews_id = $(this).attr("hotNews_id");
            // alert(hotNews_id);
            if(!hotNews_id){
                return false;
            }else{
            
                // alert(hotNews_id);
                $.ajax({
                    method: "POST",
                    url: "{{ route('noHotNews-post') }}",
                    data: { 
                        hotNews_id: hotNews_id ,
                        "_token": "{{ csrf_token() }}",
                        }
                })
                    .done(function() {
                        alert("Removed hotNews.");
                        $("#hotNews"+ hotNews_id).addClass("hotNews");
                        $("#hotNews"+ hotNews_id).removeClass("noHotNews");
                        location.reload();
                    });
            }
            
        });
    
       
    });
</script>
    
@endsection