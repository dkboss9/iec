@extends('layouts.editor')
@section('title','FSTV| Popular')

@section('content')
<div class="container-fluid">
                    
    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">Popular Posts Elements</h5>
            
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
                        <h6 class="panel-title txt-dark">Popular Table</h6>
                    </div>
                    <div class="clearfix"></div>
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
                                            <th>Description</th>
                                            <th>Type(News/Video)</th>
                                            <th>Status</th>
                                      </tr>
                                    </thead>
                                    <tbody>  
                                        @if ($popular)
                                        <?php $i=0; ?>
                                            @foreach ($popular as $row) 
                                                <?php $i++?>
                                                <tr>
                                                    <td><?php echo $i;?></td>
                                                    @if ($row->post_info != null)
                                                        <td>{{ $row->post_info['title'] }}</td>
                                                        <td>{!! Illuminate\Support\Str::limit(html_entity_decode($row->post_info['detail']), 200) !!}</td>
                                                        <td>News</td>
                                                        <td>{{($row->post_info['status'] == 'active')? 'Published' : 'Unpublish' }}</td>
                                                    @else
                                                        <td>{{ $row->video_info['title'] }}</td>
                                                        <td>{!! Illuminate\Support\Str::limit(html_entity_decode($row->video_info['detail']), 200) !!}</td>
                                                        <td>Video</td>
                                                        <td>{{($row->video_info['status'] == 'active')? 'Published' : 'Unpublish' }}</td>
                                                    @endif 
                                                </tr>                                                   
                                            @endforeach                                            
                                        @endif 
                                    </tbody>
                                </table>
                                {{-- {{$popular->links()}} --}}
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