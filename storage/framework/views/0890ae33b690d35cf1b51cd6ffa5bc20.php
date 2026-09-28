<?php $__env->startSection('title'); ?>
    <?php echo e(__('Video Ads Settings')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-title'); ?>
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h4><?php echo e(__('Video Ads Settings')); ?></h4>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="section">
        <form method="POST" action="<?php echo e(route('settings.reel-settings.store')); ?>" data-parsley-validate class="create-form" data-success-function="formSuccessFunction">
            <?php echo csrf_field(); ?>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header"><?php echo e(__('Video Ads Upload Limits')); ?></div>
                        <div class="card-body row">
                            <div class="form-group mt-2 col-lg-6">
                                <label class="form-label" for="reel_max_file_size_mb">
                                    <?php echo e(__('Max File Size (MB)')); ?> <span class="text-danger">*</span>
                                </label>
                                <input type="number" name="reel_max_file_size_mb" id="reel_max_file_size_mb"
                                    class="form-control" min="1" max="500" data-parsley-required="true"
                                    value="<?php echo e($settings['reel_max_file_size_mb'] ?? 50); ?>">
                                <small class="text-muted"><?php echo e(__('Maximum allowed video file size for Video Ad uploads. (1–500 MB)')); ?></small>
                            </div>

                            <div class="form-group mt-2 col-lg-6">
                                <label class="form-label" for="reel_max_duration_sec">
                                    <?php echo e(__('Max Duration (Seconds)')); ?> <span class="text-danger">*</span>
                                </label>
                                <input type="number" name="reel_max_duration_sec" id="reel_max_duration_sec"
                                    class="form-control" min="1" max="600" data-parsley-required="true"
                                    value="<?php echo e($settings['reel_max_duration_sec'] ?? 60); ?>">
                                <small class="text-muted"><?php echo e(__('Maximum allowed Video Ad duration in seconds. (1–600 sec)')); ?></small>
                            </div>

                            <div class="mt-4 text-end">
                                <button type="submit" class="btn btn-primary"><?php echo e(__('Save')); ?></button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        const formSuccessFunction = () => {
            setTimeout(() => {
                window.location.reload();
            }, 1000);
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/settings/reel-settings.blade.php ENDPATH**/ ?>