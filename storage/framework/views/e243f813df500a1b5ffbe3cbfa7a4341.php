<?php $__env->startSection('title'); ?>
    <?php echo e(__('Show Role')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <?php echo e(__('Show Role')); ?>

            </h3>
            <a class="btn btn-primary mb-2" href="<?php echo e(route('roles.index')); ?>"><?php echo e(__('Back')); ?></a>
        </div>
        <div class="row grid-margin">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong><?php echo e(__('Name')); ?>:</strong>
                                    <?php echo e($role->name); ?>

                                </div>
                            </div>
                          <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="row">
                                    <?php $__currentLoopData = $formattedPermissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $perm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-lg-3 col-sm-12 col-xs-12 col-md-3">
                                            <label class="label label-success">
                                                <?php echo e(__(ucfirst($perm['group']))); ?> - <?php echo e(__(ucfirst($perm['action']))); ?>

                                            </label>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/roles/show.blade.php ENDPATH**/ ?>