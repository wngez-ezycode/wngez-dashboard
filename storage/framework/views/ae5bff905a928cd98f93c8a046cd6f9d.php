<?php $__env->startSection('title'); ?>
    <?php echo e(__("Translate Cities")); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-title'); ?>
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6">
                <h4><?php echo $__env->yieldContent('title'); ?></h4>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="section">
    <form class="edit-form" action="<?php echo e(route('cities.translation.update')); ?>" method="POST" data-parsley-validate enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="card">
            <div class="card-header">
                <h4><?php echo e(__('Translate City Names')); ?></h4>
            </div>
            <div class="card-body">
                <?php if($countries->isNotEmpty()): ?>
                        <div class="form-group mb-3">
                            <label for="country_translation"><?php echo e(__('Select Country')); ?></label>
                            <select id="country_translation" class="form-control">
                                <option value=""><?php echo e(__('Select Country')); ?></option>
                                <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($country->id); ?>"><?php echo e($country->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="state_translation"><?php echo e(__('Select State')); ?></label>
                            <select id="state_translation" class="form-control" disabled>
                                <option value=""><?php echo e(__('Select State')); ?></option>
                            </select>
                        </div>

                        <div id="city_translations_container" class="mt-4"></div>



                    <div class="text-end">
                        <button type="submit" class="btn btn-primary"><?php echo e(__("Save")); ?></button>
                    </div>
                <?php else: ?>
                    <p><?php echo e(__("No countries found.")); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </form>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/places/city_translation.blade.php ENDPATH**/ ?>