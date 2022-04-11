
<?php $__env->startSection('title', 'FSTV | App Users'); ?>

<?php $__env->startSection('content'); ?>

    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">App Users List</h6>
                    </div>
                    <div class="clearfix"></div>
                    
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="table-wrap mt-40">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered table-dark mb-0">
                                    <thead>
                                      <tr>
                                            <th>
                                                
                                                S.N.
                                            </th>                                   
                                            <th>Name</th>                                  
                                            <th>Email</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        <?php if($user_list): ?>
                                            <?php $__currentLoopData = $user_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                                <tr>
                                                    <td>
                                                        <?php echo e($loop->iteration); ?>

                                                    </td>
                                                    <td><?php echo e($row->name); ?></td>
                                                    <td><?php echo e($row->email); ?></td>
                                                </tr>                                                   
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                            
                                        <?php endif; ?>   
                                    </tbody>
                                </table>
                                <?php echo e($user_list->links()); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>	
        </div>
    </div>
    <!-- /Row -->

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    
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
            data: { appusers: appusers, "_token": "<?php echo e(csrf_token()); ?>" }
        })
        .done(function( msg ) {
            alert("Notification Sent.");
        });
    });
    });
    </script> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ausnepc/firescreen.ausnep.com/resources/views/admin/userlist/app_users_list.blade.php ENDPATH**/ ?>