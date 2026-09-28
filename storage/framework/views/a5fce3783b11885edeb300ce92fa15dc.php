<?php $__env->startSection('title'); ?>
    <?php echo e(__("Create Staff")); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-title'); ?>
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h4><?php echo $__env->yieldContent('title'); ?></h4>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first"></div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="section">
        <div class="buttons">
            <a class="btn btn-primary" href="<?php echo e(route('staff.index')); ?>"> <?php echo e(__('Back')); ?></a>

        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <form action="<?php echo e(route('staff.store')); ?>" class="form-horizontal create-form" method="POST" data-parsley-validate>
                        <div class="col-md-12 col-12">
                            <div class="row">
                                <div class="form-group mandatory col-md-6 col-sm-12">
                                    <label for="role" class="form-label col-12 "><?php echo e(__("Role")); ?></label>
                                    <select name="role" id="role" class="form-control" data-parsley-required="true">
                                        <option value="">--<?php echo e(__("Select Role")); ?>--</option>
                                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($role->name); ?>"><?php echo e($role->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <div class="form-group mandatory col-md-6 col-sm-12">
                                    <label for="name" class="form-label col-12 "><?php echo e(__("Name")); ?></label>
                                    <input type="text" id="name" class="form-control col-12" placeholder="Name" name="name" data-parsley-required="true">
                                </div>

                                <div class="form-group mandatory col-md-6 col-sm-12">
                                    <label for="email" class="form-label col-12 "><?php echo e(__("Email")); ?></label>
                                    <input type="email" id="email" class="form-control col-12" placeholder="Email" name="email" data-parsley-required="true">
                                </div>

                                <div class="form-group mandatory col-md-6 col-sm-12">
                                    <label for="password" class="form-label col-12 "><?php echo e(__("Password")); ?></label>
                                    <input type="password" id="password" class="form-control col-12" placeholder="<?php echo e(__("Password")); ?>" name="password" data-parsley-minlength="8" data-parsley-uppercase="1" data-parsley-lowercase="1" data-parsley-number="1" data-parsley-special="1" data-parsley-required>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-primary waves-effect waves-light"><?php echo e(__("Save")); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/staff/create.blade.php ENDPATH**/ ?>