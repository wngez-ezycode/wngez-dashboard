<?php $__env->startSection('title'); ?>
    <?php echo e(__("Firebase Settings")); ?>

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
        <div class="alert alert-info mb-3" role="alert">
            <i class="fas fa-info-circle me-2"></i>
            <strong><?php echo e(__('Firebase Configuration')); ?>:</strong>
            <ul class="mb-0 mt-2">
                <li><strong><?php echo e(__('Service JSON File')); ?>:</strong> <?php echo e(__('Used for server-side notifications (mobile apps)')); ?></li>
                <li><strong><?php echo e(__('Web Config Below')); ?>:</strong> <?php echo e(__('Required for admin chat live refresh (web browser)')); ?></li>
                <li><strong><?php echo e(__('Get web config from')); ?>:</strong> Firebase Console → Project Settings → General → Your apps → Web app</li>
            </ul>
        </div>
        <div class="card">
            <form class="create-form-without-reset" action="<?php echo e(route('settings.firebase.update')); ?>" method="POST">
                <div class="card-body">
                    <div class="row mt-1">
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="apiKey" class="col-sm-2 col-form-label text-center"><?php echo e(__("Api Key")); ?> <span class="text-danger">*</span></label>
                                <div class="col-sm-4 position-relative has-icon-right">
                                    <input name="apiKey" type="password" class="form-control" placeholder="<?php echo e(__("Api Key")); ?>" id="apiKey" value="<?php echo e($settings['apiKey'] ?? ''); ?>" required="">
                                    <div class="form-control-icon lh-1 top-0 mt-2">
                                        <i class="bi bi-eye toggle-password"></i>
                                    </div>
                                </div>

                                <label for="authDomain" class="col-sm-2 col-form-label text-center"><?php echo e(__("Auth Domain")); ?> <span class="text-danger">*</span></label>
                                <div class="col-sm-4">
                                    <input required name="authDomain" type="text" class="form-control" placeholder="<?php echo e(__("Auth Domain")); ?>" id="authDomain" value="<?php echo e($settings['authDomain'] ?? ''); ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="projectId" class="col-sm-2 col-form-label text-center"><?php echo e(__("Project Id")); ?> <span class="text-danger">*</span></label>
                                <div class="col-sm-4">
                                    <input name="projectId" type="text" class="form-control" placeholder="<?php echo e(__("Project Id")); ?>" id="projectId" value="<?php echo e($settings['projectId'] ?? ''); ?>" required="">
                                </div>
                                <label for="storageBucket" class="col-sm-2 col-form-label text-center"><?php echo e(__("Storage Bucket")); ?> <span class="text-danger">*</span></label>
                                <div class="col-sm-4">
                                    <input name="storageBucket" type="text" class="form-control" id="storageBucket" placeholder="<?php echo e(__("Storage Buckets")); ?>" value="<?php echo e($settings['storageBucket'] ?? ''); ?>" required="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="messagingSenderId" class="col-sm-2 col-form-label text-center"><?php echo e(__("Messaging Sender Id")); ?> <span class="text-danger">*</span></label>
                                <div class="col-sm-4">
                                    <input name="messagingSenderId" type="text" class="form-control" placeholder="<?php echo e(__("Messaging Sender Id")); ?>" id="messagingSenderId" value="<?php echo e($settings['messagingSenderId'] ?? ''); ?>" required="">
                                </div>
                                <label for="appId" class="col-sm-2 col-form-label text-center"><?php echo e(__("App Id")); ?> <span class="text-danger">*</span></label>
                                <div class="col-sm-4">
                                    <input name="appId" id="appId" type="text" class="form-control" placeholder="<?php echo e(__("App Id")); ?>" value="<?php echo e($settings['appId'] ?? ''); ?>" required="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="measurementId" class="col-sm-2 col-form-label text-center"><?php echo e(__("Measurement Id")); ?></label>
                                <div class="col-sm-4">
                                    <input name="measurementId" type="text" class="form-control" id="measurementId" placeholder="<?php echo e(__("Measurement Id")); ?>" value="<?php echo e($settings['measurementId'] ?? ''); ?>">
                                </div>
                                <label for="vapidKey" class="col-sm-2 col-form-label text-center"><?php echo e(__("VAPID Key")); ?> <span class="text-danger">*</span></label>
                                <div class="col-sm-4 position-relative has-icon-right">
                                    <input name="vapidKey" type="password" class="form-control" id="vapidKey" placeholder="<?php echo e(__("VAPID Public Key")); ?>" value="<?php echo e($settings['vapidKey'] ?? ''); ?>" required="">
                                    <div class="form-control-icon lh-1 top-0 mt-2">
                                        <i class="bi bi-eye toggle-password"></i>
                                    </div>
                                    <small class="form-text text-muted"><?php echo e(__("Get from Firebase Console → Project Settings → Cloud Messaging → Web Push certificates")); ?></small>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" value="btnAdd" class="btn btn-primary me-1 mb-1"><?php echo e(__("Save")); ?></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/settings/firebase.blade.php ENDPATH**/ ?>