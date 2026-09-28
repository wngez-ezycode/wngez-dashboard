<?php $__env->startSection('title'); ?>
    <?php echo e(__("Translate Countries")); ?>

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
    <form class="edit-form" action="<?php echo e(route('countries.translation.update')); ?>" method="POST" data-parsley-validate enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="card">
            <div class="card-header">
                <h4><?php echo e(__('Translate Country Names')); ?></h4>
            </div>
            <div class="card-body">
                <?php if($languages->isNotEmpty()): ?>
                    <ul class="nav nav-tabs" id="languageTabs" role="tablist">
                        <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link <?php if($index === 0): ?> active <?php endif; ?>" id="tab-<?php echo e($language->id); ?>" data-bs-toggle="tab" data-bs-target="#lang-<?php echo e($language->id); ?>" type="button" role="tab">
                                    <?php echo e($language->name); ?>

                                </button>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>

                    <div class="tab-content border p-3 mt-3" id="languageTabContent">
                        <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="tab-pane fade <?php if($index === 0): ?> show active <?php endif; ?>" id="lang-<?php echo e($language->id); ?>" role="tabpanel">
                                <h5 class="text-primary mb-3"><?php echo e(__("Translations for")); ?>: <?php echo e($language->name); ?> (<?php echo e($language->code); ?>)</h5>
                                <div class="row">
                                    <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                            <div class="col-md-6 mb-3">
                                            <label class="form-label">
                                                <?php echo e($country->name); ?>

                                            </label>
                                            <?php
                                            $existingTranslation = $country->translations->where('language_id', $language->id)->where('key', 'name')->first();
                                            ?>
                                            <input type="text"
                                                name="translations[<?php echo e($language->id); ?>][<?php echo e($country->id); ?>]"
                                                class="form-control"
                                                value="<?php echo e($existingTranslation ? $existingTranslation->value : ''); ?>"
                                                placeholder="<?php echo e(__('Enter name for')); ?> <?php echo e($country->name); ?>">

                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <div class="mt-4 text-end">
                      <div class="col-md-12 m-2 text-end">
                                <input type="submit" class="btn btn-primary" value="<?php echo e(__("Save")); ?>">
                        </div>
                    </div>
                <?php else: ?>
                    <p><?php echo e(__("No languages found.")); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </form>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/places/country_translation.blade.php ENDPATH**/ ?>