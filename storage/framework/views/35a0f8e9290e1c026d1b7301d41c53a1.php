<?php $__env->startSection('title'); ?>
    <?php echo e(__('Create Blog Category')); ?>

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
        <div class="buttons">
            <a class="btn btn-primary" href="<?php echo e(route('blog-category.index')); ?>">
                < <?php echo e(__('Back to Blog Categories')); ?> </a>
        </div>
        <div class="row">
            <form action="<?php echo e(route('blog-category.store')); ?>" method="POST" data-parsley-validate enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header"><?php echo e(__('Add Blog Category')); ?></div>

                        <div class="card-body mt-2">
                            <ul class="nav nav-tabs" id="langTabs" role="tablist">
                                <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link <?php if($key == 0): ?> active <?php endif; ?>"
                                            id="tab-<?php echo e($lang->id); ?>" data-bs-toggle="tab"
                                            data-bs-target="#lang-<?php echo e($lang->id); ?>" type="button" role="tab">
                                            <?php echo e($lang->name); ?>

                                        </button>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>

                            <div class="tab-content mt-3">
                                <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="tab-pane fade <?php if($key == 0): ?> show active <?php endif; ?>"
                                        id="lang-<?php echo e($lang->id); ?>" role="tabpanel">
                                        <input type="hidden" name="languages[]" value="<?php echo e($lang->id); ?>">

                                        <div class="form-group">
                                            <label><?php echo e(__('Name')); ?> (<?php echo e($lang->name); ?>)</label> <span class="text-danger">*</span>
                                            <input type="text" name="name[<?php echo e($lang->id); ?>]" class="form-control"
                                                placeholder="<?php echo e(__('Enter Name')); ?>"
                                                value=""
                                                data-parsley-maxlength="191"
                                                maxlength="191"
                                                data-parsley-maxlength-message="<?php echo e(__('Name cannot exceed 191 characters.')); ?>"
                                                <?php if($lang->id == 1): ?> data-parsley-required="true" <?php endif; ?>>
                                        </div>

                                        <?php if($lang->id == 1): ?>
                                            <div class="row mt-3">
                                                <div class="col-md-6">
                                                    <div class="form-check form-switch">
                                                        <input type="hidden" name="is_active" id="is_active" value="1">
                                                        <input class="form-check-input status-switch" type="checkbox" role="switch" id="isActiveSwitch" checked>
                                                        <label class="form-check-label" for="isActiveSwitch"><?php echo e(__('Active')); ?></label>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <?php echo $__env->make('components.seo-fields', ['lang' => $lang, 'seoTranslations' => []], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 text-end">
                        <input type="submit" class="btn btn-primary" value="<?php echo e(__('Save and Back')); ?>">
                    </div>
                </div>
            </form>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form[data-parsley-validate]');
        if (!form) return;

        const submitBtn = form.querySelector('input[type="submit"], button[type="submit"]');
        form.addEventListener('submit', function(e) {
            if (typeof $(form).parsley === 'function') {
                if (!$(form).parsley().isValid()) {
                    return;
                }
            }
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.value = '<?php echo e(__('Saving...')); ?>';
            }
        });
    });

    $(document).ready(function () {
        $('form[data-parsley-validate]').parsley().on('form:error', function () {
            this.fields.forEach(function (field) {
                if (!field.isValid()) {
                    var $field = $(field.element);
                    var $tabPane = $field.closest('.tab-pane');
                    if ($tabPane.length && !$tabPane.hasClass('active')) {
                        var paneId = $tabPane.attr('id');
                        var $tabBtn = $('[data-bs-target="#' + paneId + '"]');
                        if ($tabBtn.length) {
                            var tabInstance = new bootstrap.Tab($tabBtn[0]);
                            tabInstance.show();
                        }
                        return false;
                    }
                }
            });
        });
    });
</script>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/blog_category/create.blade.php ENDPATH**/ ?>