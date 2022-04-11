
<?php $__env->startSection('title','Newsletter Detail'); ?>
<?php $__env->startSection('content'); ?>

<div class="container-fluid">
                    
    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">Newsletter Elements</h5>
            
        </div>
    </div>
    <!-- /Title -->

    <?php if(Session::has('message')): ?>
    <div class="success success-info"><?php echo e(Session::get('message')); ?></div>
<?php endif; ?>
    
    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view col-md-8">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Newsletter Table [Detail] : </h6>
                    </div>                    
                    <div class="clearfix"></div>
                </div>
                <div class="form-group row ">
                    <input type="hidden" id="newsletter_id" name="newsletter_id" value="<?php echo e($detail->id); ?>" class="newsletter_id">
                    <div class="col-sm-3">
                        <label for="">Title : </label>
                    </div>
                    <div class="col-sm-9 title" id="title" name="title" value="<?php echo e($detail->title); ?>" >
                        <?php echo e($detail->title); ?>                       
                    </div>
                </div>
                <div class="form-group row ">
                    <div class="col-sm-3">
                        <label for="">Message : </label>
                    </div>
                    <div class="col-sm-9 message" id="message" name="message" value="<?php echo html_entity_decode($detail->message); ?>" >
                        <?php echo html_entity_decode($detail->message); ?>                      
                    </div>
                </div>
                <div class="form-group row ">
                    <div class="col-sm-3">
                        <label for="">Attachment : </label>
                    </div>
                    <div class="col-sm-4 attachment" id="attachment" name="attachment" value="<?php echo e($detail->attachment); ?>">
                        <a href="<?php echo e(asset('/upload/newsletter/'.$detail->attachment)); ?>"><?php echo e($detail->attachment); ?></a>                      
                    </div>
                    <div class="col-sm-4">
                        <?php if(isset($detail)): ?>                       
                            <?php if(file_exists('upload/newsletter/'.$detail->attachment)): ?>
                                <a href="<?php echo e(asset('upload/newsletter/'.$detail->attachment)); ?>" target="_blank"><i class="fa fa-paperclip fa-4x"></i>  </a>
                            <?php endif; ?>                                
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group row">
                    <?php echo e(Form::label('','Send to : ',['class'=>'col-sm-3'])); ?>

                    <div class="col-sm-9">
                        <table class="table table-hover table-bordered table-dark mb-0">
                            <thead>
                              <tr>
                                    <th scope="col">
                                        <input class="form-check-input" type="checkbox" id="masterCheck" value="checkUncheckAll">
                                    </th>                                   
                                    <th>Email </th>
                              </tr>
                            </thead>
                            <tbody>  
                                <?php if($subs): ?>
                                    <?php $__currentLoopData = $subs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                        <tr>
                                            <td>
                                                <input class="form-check-input chk_subscriber" value="<?php echo e($row->id); ?>" type="checkbox" id="row2" name="row-check[]" >
                                            </td>
                                            <td><?php echo e($row->email); ?></td>
                                        </tr>                                                   
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                            
                                <?php endif; ?> 
                            </tbody>
                        </table>
                        <?php echo e($subs->links()); ?>

                    </div>
                </div>

                <div class="form-group row">
                    <?php echo e(Form::label('','',['class'=>'col-sm-3'])); ?>

                    <div class=" btn col-sm-9">
                            <a href="javascript:void(0);" class="btn btn-success link_email">
                                <i class="fa fa-paper-plane"><span></span></i>  SEND
                            </a>
                    </div>
                </div>
               
            </div>	
        </div>
    </div>
    <!-- /Row -->
    
</div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>
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
    
    $(".link_email").click(function(){
        if($(".chk_subscriber:checked").length ==0){
            alert("select vistor to send email.");
            return false;
        }
        var subscriber = [];
        $(".chk_subscriber:checked").each(function(){
            subscriber.push($(this).val());
        });
        // alert(subscriber);

        var newsletter_id = $(".newsletter_id").attr('value');
        $.ajax({
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
            url: "<?php echo e(route('send_newsletter')); ?>",
            data: {
                subscriber: subscriber,
                newsletter_id: newsletter_id, 
                "_token": "<?php echo e(csrf_token()); ?>" 
                }        
        })
        .done(function( msg ) {
            alert("Email Sent");
        });
    });
    });
    </script> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ausnepc/firescreen.ausnep.com/resources/views/admin/newsletter-detail.blade.php ENDPATH**/ ?>