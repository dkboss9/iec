
<?php $__env->startSection('title'); ?>
    FSTV NEWS | Advertise
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="container-fluid">
                        
    <!-- Title -->
    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">Advertise Elements</h5>
            
        </div>
    </div>
    <!-- /Title -->
    <?php if(Session::has('message')): ?>
        <div class="success success-info"><?php echo e(Session::get('message')); ?></div>
    <?php endif; ?> 
    
    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Advertisment List</h6>
                    </div>
                    <div class="clearfix"></div>
                    <div class="pull-right">
                        <a href="<?php echo e(route('advertise.create')); ?>" class="btn btn-default btn-rounded" style="border-bottom: 50%">
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
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th>Link-Type</th>
                                            <th>Views</th>
                                            <th>Added By</th>
                                          <th class="text-nowrap">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>  
                                        <?php if($advertise): ?>
                                        <?php $i=0; ?>
                                            <?php $__currentLoopData = $advertise; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                                <?php $i++;
                                                    $a = App\Models\Adsvisit::where('ads_id',$row->id)->count();
                                                ?>
                                                <tr>
                                                    <td><?php echo $i;?></td>
                                                    <td><?php echo e(ucfirst($row->title)); ?></td>
                                                   
                                                    <td>
                                                        <span><a href="<?php echo e(asset('/upload/advertise/'.@$row->image)); ?>" target="_blank"><?php echo e($row->type); ?></a></span>
                                                    </td>
                                                   
                                                    <td>
                                                        <span class="badge badge-<?php echo e($row->status == 'active' ? 'success' : 'danger'); ?>">
                                                            <?php echo e(ucfirst(($row->status == 'active') ? 'Published' : 'Un-Published')); ?>

                                                        </span>
                                                    </td>
                                                    <td><?php echo e($row->link_type); ?></td>
                                                    <td><?php echo $a;?></td>
                                                    <td><?php echo e($row->created_by['name']); ?></td>
                                                    <td>
                                                        <ul class="nav nav-pills">
                                                            <li>
                                                                <a href="<?php echo e(route('advertise.edit', $row->id)); ?>">
                                                                    <i class="fa fa-edit fa-2x" style="color:#878787;"></i>
                                                                </a> 
                                                            </li>
                                                            <li>
                                                                <a href="">
                                                                    <?php echo e(Form::open(['url'=>route('advertise.destroy', $row->id), 'class'=>'form float-right', 'onsubmit'=>'return confirm("Are you sure to delete??")'])); ?>

                                                                    <?php echo method_field('delete'); ?>
                                                                    <?php echo e(Form::button('<i class="fa fa-trash fa-1x" style="color:#fa1b1b;"></i>',['type'=>'submit'])); ?>

                                                                    <?php echo e(Form::close()); ?>

                                                                </a>
                                                            </li>
                                                        </ul>                                                            
                                                    </td>
                                                </tr>                                                   
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                            
                                        <?php endif; ?> 
                                    </tbody>
                                </table>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>	
        </div>
    </div>
    <!-- /Row -->
    
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ausnepc/firescreen.ausnep.com/resources/views/admin/advertise.blade.php ENDPATH**/ ?>