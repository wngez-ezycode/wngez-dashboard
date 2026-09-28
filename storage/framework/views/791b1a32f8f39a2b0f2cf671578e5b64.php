<?php $__env->startSection('title'); ?>
    <?php echo e(__('Edit Language')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="section">
        <div class="row">
            <form action="<?php echo e(route('updatelanguage', ['id' => $language->id, 'type' => $type])); ?>" method="POST" enctype="multipart/form-data" class="editlanguage-form">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="card">
                    <div class="card-header"><?php echo e(__("Language JSON - " .($type))); ?>

                        <!-- <button type="button" class="btn btn-secondary float-end" onclick="location.href='<?php echo e(route('auto-translate', ['id' => $language->id, 'type' => $type, 'locale' => $language->code])); ?>'">
                            Auto Translate
                        </button> -->

                    </div>
                    <div class="card-body mt-3">
                        <div class="row">
                            <?php $__currentLoopData = $enLabels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="value-<?php echo e($loop->index); ?>" class="form-labe"><?php echo e($key); ?></label>
                                            <input type="text" class="form-control" id="value-<?php echo e($loop->index); ?>" name="values[]" value="<?php echo e($value); ?>" required>
                                        </div>
                                    </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary"><?php echo e(__("Save Changes")); ?></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/settings/languageedit.blade.php ENDPATH**/ ?>