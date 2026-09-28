<?php $__env->startSection('title'); ?>
    <?php echo e(__('OTP Provider Settings')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-title'); ?>
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h4><?php echo $__env->yieldContent('title'); ?></h4>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="section">
        <form class="create-form-without-reset" action="<?php echo e(route('settings.store')); ?>" method="post"
            data-success-function="successFunction" data-parsley-validate>
            <?php echo csrf_field(); ?>

            <div class="card">
                <div class="card-body">

                    <div class="divider pt-3">
                        <h6 class="divider-text"><?php echo e(__('OTP Provider Settings')); ?></h6>
                    </div>

                    
                    <div class="form-group row mt-3">
                        <label class="col-sm-12 form-label-mandatory">
                            <?php echo e(__('OTP Service Provider')); ?>

                        </label>
                        <div class="col-md-6 col-sm-12">
                            <select name="otp_service_provider" id="otp_service_provider" class="form-select">
                                <option value="firebase"
                                    <?php echo e(($settings['otp_service_provider'] ?? '') == 'firebase' ? 'selected' : ''); ?>>
                                    <?php echo e(__('Firebase')); ?>

                                </option>
                                <option value="twilio"
                                    <?php echo e(($settings['otp_service_provider'] ?? '') == 'twilio' ? 'selected' : ''); ?>>
                                    <?php echo e(__('Twilio')); ?>

                                </option>
                                <option value="2factor"
                                    <?php echo e(($settings['otp_service_provider'] ?? '') == '2factor' ? 'selected' : ''); ?>>
                                    <?php echo e(__('2Factor')); ?>

                                </option>
                            </select>
                        </div>
                    </div>

                    
                    <div class="col-12 mt-4 p-4 row bg-light d-none" id="twilio-settings">
                        <h5><?php echo e(__('Twilio SMS Settings')); ?></h5>

                        <div class="form-group row mt-3">
                            <div class="col-md-6">
                                <label><?php echo e(__('Account SID')); ?></label>
                                <input type="text" name="twilio_account_sid" class="form-control"
                                    value="<?php echo e($settings['twilio_account_sid'] ?? ''); ?>">
                            </div>

                            <div class="col-md-6">
                                <label><?php echo e(__('Auth Token')); ?></label>
                                <input type="text" name="twilio_auth_token" class="form-control"
                                    value="<?php echo e($settings['twilio_auth_token'] ?? ''); ?>">
                            </div>
                        </div>

                        <div class="form-group row mt-3">
                            <div class="col-md-6">
                                <label><?php echo e(__('Twilio Phone Number')); ?></label>
                                <input type="text" name="twilio_my_phone_number" class="form-control"
                                    value="<?php echo e($settings['twilio_my_phone_number'] ?? ''); ?>">
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-12 mt-4 p-4 row bg-light d-none" id="twofactor-settings">
                        <h5><?php echo e(__('2Factor OTP Settings')); ?></h5>

                        <div class="form-group row mt-3">
                            <div class="col-md-6">
                                <label class="form-label mandatory">
                                    <?php echo e(__('2Factor API Key')); ?>

                                </label>
                                <input type="text" name="twofactor_api_key" class="form-control"
                                    placeholder="xxxxxxxxxxxxxxxx" value="<?php echo e($settings['twofactor_api_key'] ?? ''); ?>">
                            </div>
                        </div>

                        <div class="form-group row mt-3">
                            <div class="col-md-6">
                                <label><?php echo e(__('DLT Sender ID (Optional)')); ?></label>
                                <input type="text" name="twofactor_sender_id" class="form-control"
                                    value="<?php echo e($settings['twofactor_sender_id'] ?? ''); ?>">
                            </div>

                            <div class="col-md-6">
                                <label><?php echo e(__('DLT Template ID (Optional)')); ?></label>
                                <input type="text" name="twofactor_template_id" class="form-control"
                                    value="<?php echo e($settings['twofactor_template_id'] ?? ''); ?>">
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-12 d-flex justify-content-end mt-3">
                <button type="submit" class="btn btn-primary">
                    <?php echo e(__('Save Settings')); ?>

                </button>
            </div>
        </form>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        function toggleOtpProviders() {
            let provider = document.getElementById('otp_service_provider').value;

            document.getElementById('twilio-settings').classList.add('d-none');
            document.getElementById('twofactor-settings').classList.add('d-none');

            if (provider === 'twilio') {
                document.getElementById('twilio-settings').classList.remove('d-none');
            }

            if (provider === '2factor') {
                document.getElementById('twofactor-settings').classList.remove('d-none');
            }
        }

        document.getElementById('otp_service_provider')
            .addEventListener('change', toggleOtpProviders);

        toggleOtpProviders();

        function successFunction() {
            window.location.reload();
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/settings/login-method.blade.php ENDPATH**/ ?>