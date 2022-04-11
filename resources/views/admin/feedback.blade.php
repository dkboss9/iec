@extends('layouts.admin')
@section('title','FSTV| Feedback')
@section('content')
    <div class="container-fluid">
                        
        <!-- Title -->
        <div class="row heading-bg">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-dark">Feedback Elements</h5>
                
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
                            <h6 class="panel-title txt-dark">Feedback Table</h6>
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
                                                <th>Message</th>                                               
                                                <th>Created By</th>                                               
                                          </tr>
                                        </thead>
                                        <tbody>  
                                            @if ($data)
                                            <?php $i=0; ?>
                                                @foreach ($data as $row) 
                                                    <?php $i++?>
                                                    <tr>
                                                        <td><?php echo $i;?></td>
                                                        <td>{{ $row->title }}</td>
                                                        <td>
                                                            {!! Illuminate\Support\Str::limit(html_entity_decode($row->message), 200) !!}
                                                        </td>
                                                        <td>{{ $row->created_by['name'] }}</td>

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
