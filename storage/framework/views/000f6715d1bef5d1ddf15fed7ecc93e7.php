<?php $__env->startSection('title'); ?>
    <?php echo e(__('Notification Settings')); ?>

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
        <form class="create-form-without-reset" action="<?php echo e(route('settings.store')); ?>" method="post" enctype="multipart/form-data" data-success-function="successFunction" data-parsley-validate>
            <?php echo csrf_field(); ?>
            <div class="row d-flex mb-3">
                <div class="card mb-0">
                    <div class="card-body">
                        <div class="divider pt-3">
                            <h6 class="divider-text"><?php echo e(__('FCM Notification Settings')); ?></h6>
                        </div>
                        <div class="form-group row mt-3">
                            <div class="col-md-6 col-sm-12">
                                <label for="firebase_project_id" class="form-label"><?php echo e(__('Firebase Project Id')); ?></label>
                                <input type="text" id="firebase_project_id" name="firebase_project_id" class="form-control" placeholder="<?php echo e(__('Firebase Project Id')); ?>" value="<?php echo e($settings['firebase_project_id'] ?? ''); ?>"/>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="service_file" class="form-label"><?php echo e(__('Service Json File')); ?></label><span style="color: #00B2CA">
                                    * <?php echo e(__('Accept only Json File')); ?></span>
                                <input id="service_file" name="service_file" type="file" class="form-control">
                                <p style="display: none" id="img_error_msg" class="badge rounded-pill bg-danger"></p>
                                <?php if(isset($notificationSettings['fcm_service_file_exists']) && $notificationSettings['fcm_service_file_exists']): ?>
                                    <span class="badge rounded-pill bg-success"><?php echo e(__('File Exists')); ?></span>
                                <?php else: ?>
                                    <span class="badge rounded-pill bg-danger"><?php echo e(__('File Not Exists')); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row d-flex mb-3">
                <div class="card mb-0">
                    <div class="card-body">
                        <div class="divider pt-3">
                            <h6 class="divider-text"><?php echo e(__('Email Notification Settings')); ?></h6>
                        </div>
                        <div class="form-group row mt-3">
                            <div class="col-md-6 col-sm-12">
                                <label for="mail_mailer" class="form-label"><?php echo e(__('Mail Mailer')); ?></label>
                                <input type="text" id="mail_mailer" name="mail_mailer" class="form-control" placeholder="<?php echo e(__('Mail Mailer')); ?>" value="<?php echo e($settings['mail_mailer'] ?? ''); ?>"/>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="mail_host" class="form-label"><?php echo e(__('Mail Host')); ?></label>
                                <input type="text" id="mail_host" name="mail_host" class="form-control" placeholder="<?php echo e(__('Mail Host')); ?>" value="<?php echo e($settings['mail_host'] ?? ''); ?>"/>
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <div class="col-md-6 col-sm-12">
                                <label for="mail_port" class="form-label"><?php echo e(__('Mail Port')); ?></label>
                                <input type="text" id="mail_port" name="mail_port" class="form-control" placeholder="<?php echo e(__('Mail Port')); ?>" value="<?php echo e($settings['mail_port'] ?? ''); ?>"/>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="mail_username" class="form-label"><?php echo e(__('Mail Username')); ?></label>
                                <input type="text" id="mail_username" name="mail_username" class="form-control" placeholder="<?php echo e(__('Mail Username')); ?>" value="<?php echo e($settings['mail_username'] ?? ''); ?>"/>
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <div class="col-md-6 col-sm-12 position-relative has-icon-right">
                                <label for="mail_password" class="form-label"><?php echo e(__('Mail Password')); ?></label>
                                <input type="password" id="mail_password" name="mail_password" class="form-control" placeholder="<?php echo e(__('Mail Password')); ?>" value="<?php echo e($settings['mail_password'] ?? ''); ?>"/>
                                <div class="form-control-icon lh-1 top-0 mt-2">
                                    <i class="bi bi-eye toggle-password"></i>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="mail_encryption" class="form-label"><?php echo e(__('Mail Encryption')); ?></label>
                                <input type="text" id="mail_encryption" name="mail_encryption" class="form-control" placeholder="<?php echo e(__('Mail Encryption')); ?>" value="<?php echo e($settings['mail_encryption'] ?? ''); ?>"/>
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <div class="col-md-6 col-sm-12">
                                <label for="mail_from_address" class="form-label"><?php echo e(__('Mail From Address')); ?></label>
                                <input type="text" id="mail_from_address" name="mail_from_address" class="form-control" placeholder="<?php echo e(__('Mail From Address')); ?>" value="<?php echo e($settings['mail_from_address'] ?? ''); ?>"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 d-flex justify-content-end">
                <button type="submit" value="btnAdd" class="btn btn-primary me-1 mb-3"><?php echo e(__('Save')); ?></button>
            </div>
        </form>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script>
        function successFunction() {
            window.location.reload();
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/settings/notification-setting.blade.php ENDPATH**/ ?>