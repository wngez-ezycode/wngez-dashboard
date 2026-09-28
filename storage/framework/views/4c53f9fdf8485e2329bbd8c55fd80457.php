<?php $__env->startSection('title'); ?>
    <?php echo e(__('Refer & Earn Settings')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-title'); ?>
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h4><?php echo e(__('Refer & Earn Settings')); ?></h4>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="section">
        <form class="create-form-without-reset" action="<?php echo e(route('settings.store')); ?>" method="post"
            data-parsley-validate data-success-function="successFunction">
            <?php echo csrf_field(); ?>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="divider pt-3">
                                <h6 class="divider-text"><?php echo e(__('Refer & Earn Configuration')); ?></h6>
                            </div>

                            
                            <div class="form-group mt-3">
                                <label class="form-label" for="refer_earn_enabled"><?php echo e(__('Enable Refer & Earn')); ?></label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="refer_earn_enabled" id="refer_earn_enabled" value="1"
                                           <?php echo e(($settings['refer_earn_enabled'] ?? 0) == 1 ? 'checked' : ''); ?>

                                           onchange="toggleReferSettings()">
                                    <input type="hidden" name="refer_earn_enabled" value="0" id="refer_earn_enabled_hidden">
                                    <label class="form-check-label" for="refer_earn_enabled" id="refer-enabled-label">
                                        <?php echo e(($settings['refer_earn_enabled'] ?? 0) == 1 ? __('Enabled') : __('Disabled')); ?>

                                    </label>
                                </div>
                            </div>

                            <div id="refer-settings-group" class="row">
                                
                                <div class="form-group mt-3 col-lg-6">
                                    <label for="refer_points_for_referrer" class="form-label"><?php echo e(__('Points for Referrer')); ?></label>
                                    <input type="number" name="refer_points_for_referrer" id="refer_points_for_referrer"
                                           class="form-control" min="0"
                                           value="<?php echo e($settings['refer_points_for_referrer'] ?? 10); ?>"
                                           placeholder="<?php echo e(__('Points given to user whose code is used')); ?>">
                                    <small class="text-muted"><?php echo e(__('Points awarded to the user whose referral code is used (when referred user purchases a paid plan)')); ?></small>
                                </div>

                                
                                <div class="form-group mt-3 col-lg-6">
                                    <label for="refer_points_for_referred" class="form-label"><?php echo e(__('Points for Referred User')); ?></label>
                                    <input type="number" name="refer_points_for_referred" id="refer_points_for_referred"
                                           class="form-control" min="0"
                                           value="<?php echo e($settings['refer_points_for_referred'] ?? 5); ?>"
                                           placeholder="<?php echo e(__('Points given to user who enters the code')); ?>">
                                    <small class="text-muted"><?php echo e(__('Points awarded to the user who used a referral code (when they purchase a paid plan)')); ?></small>
                                </div>
                            </div>

                            <div class="divider pt-3">
                                <h6 class="divider-text"><?php echo e(__('Global Points Usage Limits')); ?></h6>
                            </div>

                            <div class="alert alert-info mt-3">
                                <i class="fas fa-info-circle"></i>
                                <?php echo e(__('1 Point = 1')); ?> <?php echo e($settings['currency_symbol'] ?? '$'); ?>.
                                <?php echo e(__('These are global defaults. You can override them per package in the package settings.')); ?>

                            </div>

                            <div id="refer-limits-group">
                                
                                <div class="form-group mt-3">
                                    <label for="refer_max_points_usage_percentage" class="form-label"><?php echo e(__('Max Points Usage Percentage')); ?> (%)</label>
                                    <input type="number" name="refer_max_points_usage_percentage" id="refer_max_points_usage_percentage"
                                            class="form-control" min="1" max="100"
                                            value="<?php echo e($settings['refer_max_points_usage_percentage'] ?? 10); ?>"
                                            placeholder="10">
                                    <small class="text-muted"><?php echo e(__('Maximum percentage of the discounted price that can be paid using refer points')); ?></small>
                                </div>

                                
                                <div class="form-group mt-3">
                                    <label for="refer_min_points_to_use" class="form-label"><?php echo e(__('Minimum Points to Use')); ?></label>
                                    <input type="number" name="refer_min_points_to_use" id="refer_min_points_to_use"
                                            class="form-control" min="1"
                                            value="<?php echo e($settings['refer_min_points_to_use'] ?? 5); ?>"
                                            placeholder="5">
                                    <small class="text-muted"><?php echo e(__('User must have at least this many points to use them. If user has fewer points, they cannot use points at all.')); ?></small>
                                </div>

                                
                                <div class="form-group mt-3">
                                    <label for="refer_max_points_to_use" class="form-label"><?php echo e(__('Maximum Points to Use')); ?></label>
                                    <input type="number" name="refer_max_points_to_use" id="refer_max_points_to_use"
                                            class="form-control" min="1"
                                            value="<?php echo e($settings['refer_max_points_to_use'] ?? 50); ?>"
                                            placeholder="50">
                                    <small class="text-muted"><?php echo e(__('Maximum number of points a user can use per purchase, regardless of available points')); ?> (1 <?php echo e(__('point')); ?> = 1 <?php echo e($settings['currency_symbol'] ?? '$'); ?>). <?php echo e(__('Only applies when package has no specific refer settings.')); ?></small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary me-1 mb-1"><?php echo e(__('Save Settings')); ?></button>
                </div>
            </div>
        </form>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
    function toggleReferSettings() {
        const enabled = document.getElementById('refer_earn_enabled').checked;
        const label = document.getElementById('refer-enabled-label');
        const settingsGroup = document.getElementById('refer-settings-group');
        const limitsGroup = document.getElementById('refer-limits-group');

        label.textContent = enabled ? '<?php echo e(__('Enabled')); ?>' : '<?php echo e(__('Disabled')); ?>';
        document.getElementById('refer_earn_enabled_hidden').value = enabled ? '1' : '0';

        settingsGroup.style.opacity = enabled ? '1' : '0.5';
        limitsGroup.style.opacity = enabled ? '1' : '0.5';

        const inputs = document.querySelectorAll('#refer-settings-group input, #refer-limits-group input');
        inputs.forEach(input => {
            input.disabled = !enabled;
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        toggleReferSettings();
    });

    function successFunction(response) {
        if(!response.error && !response.warning){
            setTimeout(() => {
                window.location.reload();
            }, 500);
        }
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/settings/refer-earn.blade.php ENDPATH**/ ?>