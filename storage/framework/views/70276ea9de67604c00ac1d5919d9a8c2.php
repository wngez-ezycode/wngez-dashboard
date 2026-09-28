<?php $__env->startSection('title'); ?>
    <?php echo e(__('Change Password')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="section row">
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <div class="divider">
                        <div class="divider-text">
                            <h4 class="mb-0"><?php echo e(__('Change Password')); ?></h4>
                        </div>
                    </div>
                </div>
                <div class="card-content">
                    <form method="POST" action="<?php echo e(route('change-password.update')); ?>" class="create-form" data-parsley-validate>
                    <?php echo csrf_field(); ?>
                    <div class="card-body">
                        <label for="old_password" class="form-label"><?php echo e(__('Current Password')); ?></label>
                        <div class="form-group position-relative has-icon-right mb-4 mandatory">
                            <input type="password" name="old_password" id="old_password" class="form-control form-control-solid mb-2" placeholder="<?php echo e(__('Current Password')); ?>" required/>
                            <div class="form-control-icon lh-1 top-0 mt-2">
                                <i class="bi bi-eye toggle-password"></i>
                            </div>
                        </div>

                        <label for="new_password" class="form-label"><?php echo e(__('New Password')); ?></label>
                        <div class="form-group position-relative has-icon-right mb-4 mandatory">
                            <input type="password" name="new_password" id="new_password" class="form-control form-control-solid" placeholder="<?php echo e(__('New Password')); ?>" data-parsley-minlength="8" data-parsley-uppercase="1" data-parsley-lowercase="1" data-parsley-number="1" data-parsley-special="1" data-parsley-required/>
                            <div class="form-control-icon lh-1 top-0 mt-2">
                                <i class="bi bi-eye toggle-password"></i>
                            </div>
                        </div>

                        <label for="confirm_password" class="form-label"><?php echo e(__('Confirm Password')); ?></label>
                        <div class="form-group position-relative has-icon-right mb-4 mandatory">
                            <input type="password" id="confirm_password" name="confirm_password" class="form-control form-control-solid" placeholder="<?php echo e(__('Confirm Password')); ?>" data-parsley-equalto="#new_password" required/>
                            <div class="form-control-icon lh-1 top-0 mt-2">
                                <i class="bi bi-eye toggle-password"></i>
                            </div>
                        </div>

                        <div class="form-group text-end">
                            <button type="submit" class="btn btn-primary"><?php echo e(__('Change')); ?></button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <div class="divider">
                        <div class="divider-text">
                            <h4 class="mb-0"><?php echo e(__('Reset Password')); ?></h4>
                        </div>
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="alert alert-light-primary mb-4">
                            <strong><?php echo e(__('Note')); ?>:</strong>
                            <?php echo e(__('Reset password works only on a valid admin email. OTP will be sent to the valid admin email, so SMTP details must be configured before using this option.')); ?>

                        </div>

                        <div id="admin-reset-email-section" class="<?php echo e($otpResetState['sent'] ? 'd-none' : ''); ?>">
                            <form method="POST" action="<?php echo e(route('change-password.send-reset-otp')); ?>" class="create-form-without-reset" data-parsley-validate data-success-function="handleAdminResetOtpSent">
                            <?php echo csrf_field(); ?>
                            <label for="admin_reset_email" class="form-label"><?php echo e(__('Admin Email')); ?></label>
                            <div class="form-group mb-4 mandatory">
                                <input
                                    type="email"
                                    id="admin_reset_email"
                                    name="email"
                                    class="form-control"
                                    value="<?php echo e($otpResetState['email']); ?>"
                                    placeholder="<?php echo e(__('Admin Email')); ?>"
                                    required
                                />
                            </div>
                            <div class="form-group text-end">
                                <button type="submit" class="btn btn-outline-primary"><?php echo e(__('Send OTP')); ?></button>
                            </div>
                            </form>
                        </div>

                        <div id="admin-reset-otp-section" class="<?php echo e($otpResetState['sent'] && ! $otpResetState['verified'] ? '' : 'd-none'); ?>">
                            <hr>
                            <h6><?php echo e(__('Verify OTP')); ?></h6>
                            <p class="text-muted mb-3"><?php echo e(__('Enter the OTP sent to your valid admin email to continue with password reset.')); ?></p>
                            <form method="POST" action="<?php echo e(route('change-password.verify-reset-otp')); ?>" class="create-form-without-reset" data-parsley-validate data-success-function="handleAdminResetOtpVerified">
                            <?php echo csrf_field(); ?>
                            <div class="form-group mb-4 mandatory">
                                <label for="admin_reset_otp" class="form-label"><?php echo e(__('OTP')); ?></label>
                                <input
                                    type="text"
                                    id="admin_reset_otp"
                                    name="otp"
                                    class="form-control"
                                    maxlength="6"
                                    placeholder="<?php echo e(__('Enter OTP')); ?>"
                                    data-parsley-type="digits"
                                    data-parsley-length="[6, 6]"
                                    required
                                />
                            </div>
                            <div class="form-group text-end">
                                <button type="submit" class="btn btn-primary"><?php echo e(__('Verify OTP')); ?></button>
                            </div>
                            </form>
                        </div>

                        <div id="admin-reset-password-section" class="<?php echo e($otpResetState['verified'] ? '' : 'd-none'); ?>">
                            <hr>
                            <h6><?php echo e(__('Set New Password')); ?></h6>
                            <form method="POST" action="<?php echo e(route('change-password.update-with-otp')); ?>" class="create-form-without-reset" data-parsley-validate data-success-function="handleAdminResetPasswordUpdated">
                            <?php echo csrf_field(); ?>
                            <label for="reset_new_password" class="form-label"><?php echo e(__('New Password')); ?></label>
                            <div class="form-group position-relative has-icon-right mb-4 mandatory">
                                <input type="password" name="new_password" id="reset_new_password" class="form-control form-control-solid" placeholder="<?php echo e(__('New Password')); ?>" data-parsley-minlength="8" data-parsley-uppercase="1" data-parsley-lowercase="1" data-parsley-number="1" data-parsley-special="1" data-parsley-required/>
                                <div class="form-control-icon lh-1 top-0 mt-2">
                                    <i class="bi bi-eye toggle-password"></i>
                                </div>
                            </div>

                            <label for="reset_confirm_password" class="form-label"><?php echo e(__('Confirm Password')); ?></label>
                            <div class="form-group position-relative has-icon-right mb-4 mandatory">
                                <input type="password" id="reset_confirm_password" name="confirm_password" class="form-control form-control-solid" placeholder="<?php echo e(__('Confirm Password')); ?>" data-parsley-equalto="#reset_new_password" required/>
                                <div class="form-control-icon lh-1 top-0 mt-2">
                                    <i class="bi bi-eye toggle-password"></i>
                                </div>
                            </div>

                            <div class="form-group text-end">
                                <button type="submit" class="btn btn-primary"><?php echo e(__('Reset Password')); ?></button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

    <?php $__env->startSection('js'); ?>
    <script>
        function showAdminResetStep(step) {
            document.getElementById('admin-reset-email-section').classList.toggle('d-none', step !== 'email');
            document.getElementById('admin-reset-otp-section').classList.toggle('d-none', step !== 'otp');
            document.getElementById('admin-reset-password-section').classList.toggle('d-none', step !== 'password');
        }

        function handleAdminResetOtpSent() {
            showAdminResetStep('otp');
        }

        function handleAdminResetOtpVerified() {
            showAdminResetStep('password');
        }

        function handleAdminResetPasswordUpdated() {
            showAdminResetStep('email');
            document.getElementById('admin_reset_otp').value = '';
            document.getElementById('admin_reset_email').value = '';
            document.getElementById('reset_new_password').value = '';
            document.getElementById('reset_confirm_password').value = '';
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/change_password/index.blade.php ENDPATH**/ ?>