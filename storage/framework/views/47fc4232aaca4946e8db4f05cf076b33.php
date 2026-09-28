<?php $__env->startSection('title'); ?>
    <?php echo e(__('Privacy Policy')); ?>

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
        <div class="card">
            <form action="<?php echo e(route('settings.store')); ?>" method="post" class="create-form-without-reset">
                <?php echo csrf_field(); ?>
                <div class="card-body">
                    <div class="row form-group">
                        <div class="col-2 d-flex justify-content-end">
                            <a href="<?php echo e(route('public.privacy-policy')); ?>" target="_blank" class="col-sm-12 col-md-12 d-fluid btn icon btn-primary btn-sm rounded-pill" onclick="" title="Enable">
                                <i class="bi bi-eye-fill"></i>
                            </a>
                        </div>
                       <ul class="nav nav-tabs" id="privacyTabs" role="tablist">
                    <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link <?php echo e($loop->first ? 'active' : ''); ?>"
                               id="privacy-tab-<?php echo e($lang->id); ?>"
                               data-bs-toggle="tab"
                               href="#privacy-lang-<?php echo e($lang->id); ?>"
                               role="tab">
                                <?php echo e($lang->name); ?>

                            </a>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>

                <!-- Tab Panes -->
                <div class="tab-content mt-3">
                    <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="tab-pane fade <?php echo e($loop->first ? 'show active' : ''); ?>"
                             id="privacy-lang-<?php echo e($lang->id); ?>"
                             role="tabpanel">
                            <input type="hidden" name="languages[]" value="<?php echo e($lang->id); ?>">
                            <div class="form-group">
                                <label><?php echo e(__("Privacy Policy")); ?> (<?php echo e($lang->name); ?>)</label>
                                <textarea name="privacy_policy[<?php echo e($lang->id); ?>]"
                                          id="tinymce_editor_privacy_<?php echo e($lang->id); ?>"
                                          class="tinymce_editor form-control"
                                          rows="6"><?php echo e(old("privacy_policy.$lang->id", $translations['privacy_policy'][$lang->id] ?? ($settings['privacy_policy'] ?? ''))); ?></textarea>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <!-- Save Button -->
                <div class="col-12 mt-3 d-flex justify-content-end">
                    <button class="btn btn-primary" type="submit"><?php echo e(__('Save')); ?></button>
                </div>
            </div>
            </form>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        tinymce.init({
            selector: '.tinymce_editor',
            height: 400,
            menubar: false,
            plugins: [
                'advlist autolink lists link charmap preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime table paste code help wordcount'
            ],
            toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist | removeformat | code',
            setup: function (editor) {
                editor.on("change keyup", function () {
                    editor.save();
                });
            }
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/settings/privacy-policy.blade.php ENDPATH**/ ?>