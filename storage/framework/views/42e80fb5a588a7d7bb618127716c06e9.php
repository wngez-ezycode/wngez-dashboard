<?php $__env->startSection('title'); ?>
    <?php echo e(__('File Manager')); ?>

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
        <form class="create-form-without-reset" action="<?php echo e(route('settings.file-manager.store')); ?>" method="post" enctype="multipart/form-data">
            <div class="row d-flex mb-3">
                <div class="col-md-6 mt-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="divider pt-3">
                                <h6 class="divider-text"><?php echo e(__('File Manager Setting')); ?></h6>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12 mt-2">
                                    <label for="file_manager" class="col-sm-12 form-check-label  mt-2"><?php echo e(__('File Manager')); ?></label>
                                    <select name="file_manager" id="file_manager" class="form-select form-control-sm">
                                        <option value="public"><?php echo e(__('Local Server')); ?></option>
                                        <option value="s3"><?php echo e(__('AWS S3')); ?></option>
                                    </select>
                                </div>

                                <div id="s3_div" style="display: none">
                                    <label for="stripe_secret_key" class="col-sm-12 form-check-label  mt-2"><?php echo e(__('AWS Access Key ID')); ?></label>
                                    <div class="col-sm-12 mt-2">
                                        <input id="stripe_secret_key" name="S3_aws_access_key_id" type="text" class="form-control" placeholder="<?php echo e(__('AWS Access Key ID')); ?>" value="<?php echo e($settings['S3_aws_access_key_id'] ?? ''); ?>" >
                                    </div>

                                    <label for="stripe_publishable_key" class="col-sm-12 form-check-label  mt-2"><?php echo e(__('AWS Secret Access Key')); ?></label>
                                    <div class="col-sm-12 mt-2">
                                        <input id="AWS_SECRET_ACCESS_KEY" name="s3_aws_secret_access_key" type="text" class="form-control" placeholder="<?php echo e(__('AWS Secret Access Key')); ?>" value="<?php echo e($settings['s3_aws_secret_access_key'] ?? ''); ?>" >
                                    </div>

                                    <label for="stripe_webhook_secret" class="col-sm-12 form-check-label  mt-2"><?php echo e(__('AWS Default Region')); ?></label>
                                    <div class="col-sm-12 mt-2">
                                        <input id="AWS_DEFAULT_REGION" name="s3_aws_default_region" type="text" class="form-control" placeholder="<?php echo e(__('AWS Default Region')); ?>" value="<?php echo e($settings['s3_aws_default_region'] ?? ''); ?>" >
                                    </div>

                                    <label for="stripe_webhook_url" class="col-sm-12 form-check-label  mt-2"><?php echo e(__('AWS Bucket')); ?></label>
                                    <div class="col-sm-12 mt-2">
                                        <input id="AWS_BUCKET" name="s3_aws_bucket" type="text" class="form-control" placeholder="<?php echo e(__('AWS Bucket')); ?>" value="<?php echo e($settings['s3_aws_default_region'] ?? ''); ?>" >
                                    </div>
                                    <label for="stripe_webhook_url" class="col-sm-12 form-check-label  mt-2"><?php echo e(__('AWS URL')); ?></label>
                                    <div class="col-sm-12 mt-2">
                                        <input id="AWS_URL" name="s3_aws_url" type="text" class="form-control" placeholder="<?php echo e(__('AWS URL')); ?>" value="<?php echo e($settings['s3_aws_url'] ?? ''); ?>" >
                                    </div>
                                </div>

                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-3"><?php echo e(__('Save')); ?></button>
                            </div>
                        </div>
                    </div>

                </div>
                



            </div>

        </form>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script type="text/javascript">
        $('#file_manager').val("<?php echo e($settings['file_manager'] ?? ''); ?>").trigger("change");
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/settings/file-manager.blade.php ENDPATH**/ ?>