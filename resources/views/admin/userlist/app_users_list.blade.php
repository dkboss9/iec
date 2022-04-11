@extends('layouts.admin')
@section('title', 'FSTV | App Users')

@section('content')

    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">App Users List</h6>
                    </div>
                    <div class="clearfix"></div>
                    <div class="pull-right">
                        <a href="javascript:void();" class="btn btn-default btn-rounded push_notification" style="border-bottom: 50%">
                            <i class="fa fa-bell">Send Notification</i>
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
                                            <th scope="col">
                                                <input class="form-check-input" type="checkbox" id="masterCheck" value="checkUncheckAll">
                                                <span>S.N.</span> 
                                            </th>                                   
                                            <th>Name</th>                                  
                                            <th>Email</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        @if ($user_list)
                                            @foreach ($user_list as $row) 
                                                <tr>
                                                    <td>
                                                        <input class="form-check-input chk_users" value="{{$row->id}}" type="checkbox" id="row3" name="row-check[]" >
                                                    </td>
                                                    <td>{{ $row->name}}</td>
                                                    <td>{{ $row->email}}</td>
                                                </tr>                                                   
                                            @endforeach                                            
                                        @endif   
                                    </tbody>
                                </table>
                                {{$user_list->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>	
        </div>
    </div>
    <!-- /Row -->

@endsection
@section('scripts')
    
<script>
    $(function () {
    
    // Header Master Checkbox Event
    $("#masterCheck").on("click", function () { 
        if ($("input:checkbox").prop("checked")) {
            $("input:checkbox[name='row-check[]']").prop("checked", true);
        } else {
            $("input:checkbox[name='row-check[]']").prop("checked", false);
        }
    });
    
    // Check event on each table row checkbox
    $("input:checkbox[name='row-check']").on("change", function () {
        var total_check_boxes = $("input:checkbox[name='row-check']").length;
        var total_checked_boxes = $("input:checkbox[name='row-check']:checked").length;
    
        // If all checked manually then check master checkbox
        if (total_check_boxes === total_checked_boxes) {
            $("#masterCheck").prop("checked", true);
        }
        else {
            $("#masterCheck").prop("checked", false);
        }
    });
    
    $(".push_notification").click(function(){
        if($(".chk_users:checked").length == 0){
            alert("select users to send notification.");
            return false;
        }
        var appusers = [];
        $(".chk_users:checked").each(function(){
            appusers.push($(this).val());
        });
    
        $.ajax({
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
            url: ,
            data: { appusers: appusers, "_token": "{{ csrf_token() }}" }
        })
        .done(function( msg ) {
            alert("Notification Sent.");
        });
    });
    });
    </script> 
@endsection