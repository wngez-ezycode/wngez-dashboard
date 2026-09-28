<?php $__env->startSection('title'); ?>
    <?php echo e(__('Admob')." ".__("Settings")); ?>

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
        <form class="create-form-without-reset" action="<?php echo e(route('settings.store')); ?>" method="post" enctype="multipart/form-data">
            <div class="row d-flex mb-3">
                <div class="col-md-6 mt-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="divider pt-3">
                                <h6 class="divider-text"><?php echo e(__('Banner Ad')); ?></h6>
                            </div>

                            <div class="form-group row mt-3">
                                <label for="banner_ad_id_android" class="col-sm-12 form-check-label  mt-2"><?php echo e(__('Banner Ad Id Android')); ?></label>
                                <div class="col-sm-12 mt-2">
                                    <input id="banner_ad_id_android" name="banner_ad_id_android" type="text" class="form-control" placeholder="<?php echo e(__('Banner Ad Id Android')); ?>" value="<?php echo e($settings['banner_ad_id_android'] ?? ''); ?>">
                                </div>

                                <label for="banner_ad_id_ios" class="col-sm-12 form-check-label  mt-2"><?php echo e(__('Banner Ad Id IOS')); ?></label>
                                <div class="col-sm-12 mt-2">
                                    <input id="banner_ad_id_ios" name="banner_ad_id_ios" type="text" class="form-control" placeholder="<?php echo e(__('Banner Ad Id IOS')); ?>" value="<?php echo e($settings['banner_ad_id_ios'] ?? ''); ?>">
                                </div>
                                <label class="col-sm-12 form-check-label  mt-2" id='banner_ad_status'><?php echo e(__("Status")); ?></label>
                                <div class="col-sm-2 col-md-12 col-xs-12  mt-2">
                                    <div class="form-check form-switch ">
                                        <input type="hidden" name="banner_ad_status" id="banner_ad_status" value="<?php echo e($settings['banner_ad_status'] ?? 0); ?>">
                                        <input class="form-check-input switch-input status-switch" type="checkbox" role="switch" <?php echo e(isset($settings['banner_ad_status']) && $settings['banner_ad_status'] == '1' ? 'checked' : ''); ?> id="switch_banner_ad_status" aria-label="switch_banner_ad_status">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mt-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="divider pt-3">
                                <h6 class="divider-text"><?php echo e(__('Interstitial Ad')); ?></h6>
                            </div>

                            <div class="form-group row mt-3">
                                <label for="interstitial_ad_id_android" class="col-sm-12 form-check-label  mt-2"><?php echo e(__('Interstitial Ad Id Android')); ?></label>
                                <div class="col-sm-12 mt-2">
                                    <input id="interstitial_ad_id_android" name="interstitial_ad_id_android" type="text" class="form-control" placeholder="<?php echo e(__('Interstitial Ad Id Android')); ?>" value="<?php echo e($settings['interstitial_ad_id_android'] ?? ''); ?>">
                                </div>

                                <label for="interstitial_ad_id_ios" class="col-sm-12 form-check-label  mt-2"><?php echo e(__('Interstitial Ad Id IOS')); ?></label>
                                <div class="col-sm-12 mt-2">
                                    <input id="interstitial_ad_id_ios" name="interstitial_ad_id_ios" type="text" class="form-control" placeholder="<?php echo e(__('Interstitial Ad Id IOS')); ?>" value="<?php echo e($settings['interstitial_ad_id_ios'] ?? ''); ?>">
                                </div>
                                <label class="col-sm-12 form-check-label  mt-2" id='interstitial_ad_status'><?php echo e(__("Status")); ?></label>
                                <div class="col-sm-2 col-md-12 col-xs-12  mt-2">
                                    <div class="form-check form-switch ">
                                        <input type="hidden" name="interstitial_ad_status" id="interstitial_ad_status" value="<?php echo e($settings['interstitial_ad_status'] ?? 0); ?>">
                                        <input class="form-check-input switch-input status-switch" type="checkbox" role="switch" <?php echo e(isset($settings['interstitial_ad_status']) && $settings['interstitial_ad_status'] == '1' ? 'checked' : ''); ?> id="switch_interstitial_ad_status" aria-label="switch_interstitial_ad_status">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="divider pt-3">
                                <h6 class="divider-text"><?php echo e(__('Native Ad')); ?></h6>
                            </div>

                            <div class="form-group row mt-3">
                                <label for="native _app_id_android" class="col-sm-12 form-check-label  mt-2"><?php echo e(__('Native  App Id Android')); ?></label>
                                <div class="col-sm-12 mt-2">
                                    <input id="native_app_id_android" name="native_app_id_android" type="text" class="form-control" placeholder="<?php echo e(__('Native  App Id Android')); ?>" value="<?php echo e($settings['native_app_id_android'] ?? ''); ?>">
                                </div>

                                <label for="native _app_id_ios" class="col-sm-12 form-check-label  mt-2"><?php echo e(__('Native  App Id iOS')); ?></label>
                                <div class="col-sm-12 mt-2">
                                    <input id="native_app_id_ios" name="native_app_id_ios" type="text" class="form-control" placeholder="<?php echo e(__('Native  App Id iOS')); ?>" value="<?php echo e($settings['native_app_id_ios'] ?? ''); ?>">
                                </div>
                                <label class="col-sm-12 form-check-label  mt-2" id='native _ad_status'><?php echo e(__("Status")); ?></label>
                                <div class="col-sm-2 col-md-12 col-xs-12  mt-2">
                                    <div class="form-check form-switch ">
                                        <input type="hidden" name="native_ad_status" id="native_ad_status" value="<?php echo e($settings['native _ad_status'] ?? 0); ?>">
                                        <input class="form-check-input switch-input status-switch" type="checkbox" role="switch" <?php echo e(isset($settings['native_ad_status']) && $settings['native_ad_status'] == '1' ? 'checked' : ''); ?> id="switch_native_ad_status" aria-label="switch_native_ad_status">
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary me-1 mb-3"><?php echo e(__('Save')); ?></button>
            </div>
        </form>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/settings/admob.blade.php ENDPATH**/ ?>