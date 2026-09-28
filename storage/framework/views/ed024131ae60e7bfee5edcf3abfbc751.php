<?php $__env->startSection('title'); ?>
    <?php echo e(__('Create New Role')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <?php echo e(__('Create New Role')); ?>

            </h3>
        </div>
        <div class="row grid-margin">
            <div class="col-lg-12">
                <div class="mb-2">
                    <a class="btn btn-primary" href="<?php echo e(route('roles.index')); ?>"> <?php echo e(__('Back')); ?></a>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <form method="POST" action="<?php echo e(route('roles.store')); ?>" class="create-form" data-success-function="successFunction">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label><?php echo e(__('Name')); ?> <span class="text-danger">*</span></label>
                                        <input type="text" name="name" value="<?php echo e(old('name')); ?>" placeholder="<?php echo e(__('Name')); ?>" class="form-control">
                                    </div>
                                </div>
                                <div id="permission-list">

                                </div>
                                <div class="permission-tree ms-5 my-3">
                                    <ul>
                                        <?php $__currentLoopData = $groupedPermissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $groupName => $groupData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li data-jstree='{"opened":true}'>
                                                <?php echo e(__(ucwords(str_replace("-", " ", $groupName)))); ?>

                                                <?php $__currentLoopData = $groupData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <ul>
                                                        <li id="<?php echo e($permission->id); ?>"
                                                            data-name="<?php echo e($permission->name); ?>"
                                                            data-jstree='{"icon":"fa fa-user-cog"}'>
                                                            <?php echo e(__(ucfirst($permission->short_name))); ?>

                                                        </li>
                                                    </ul>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>

                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <button type="submit" class="btn btn-primary"><?php echo e(__('Submit')); ?></button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script>
        function successFunction() {
            $('.permission-tree').jstree(true).deselect_all();
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/roles/create.blade.php ENDPATH**/ ?>