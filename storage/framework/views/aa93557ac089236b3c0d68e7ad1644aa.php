

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><?php echo e(__('Verify Your Email Address')); ?></div>
                    <div class="card-body">
                        <?php if(session('resent')): ?>
                            <div class="alert alert-success" role="alert">
                                <?php echo e(__('A fresh verification link has been sent to your email address.')); ?>

                            </div>
                        <?php endif; ?>

                        <?php echo e(__('Before proceeding, please check your email for a verification link.')); ?>

                        <?php echo e(__('If you did not receive the email')); ?>,
                        <form class="d-inline" method="POST" action="<?php echo e(route('verification.resend')); ?>">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline"><?php echo e(__('click here to request another')); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/auth/verify.blade.php ENDPATH**/ ?>