<?php $__env->startSection('title'); ?>
    <?php echo e(__('Create Chat Template')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-title'); ?>
    <div class="page-title">
        <div class="row d-flex align-items-center">
            <div class="col-12">
                <h4 class="mb-0"><?php echo $__env->yieldContent('title'); ?></h4>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="section">
        <form id="chat_template_form" action="<?php echo e(route('chat-templates.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="cs-card">
                        <div class="cs-header">
                            <p class="cs-title"><?php echo e(__('Basic Information')); ?></p>
                        </div>
                        <div class="ql-body">
                            <div>
                                <label class="cs-field-label"><?php echo e(__('Title')); ?> <span class="text-danger">*</span></label>
                                <ul class="nav nav-tabs" id="nameLangTabs" role="tablist">
                                    <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link <?php if($key == 0): ?> active <?php endif; ?>" id="name-tab-<?php echo e($lang->id); ?>"
                                                data-bs-toggle="tab" data-bs-target="#name-lang-<?php echo e($lang->id); ?>" type="button" role="tab">
                                                <?php echo e($lang->name); ?>

                                            </button>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                                <div class="tab-content mt-2">
                                    <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="tab-pane fade <?php if($key == 0): ?> show active <?php endif; ?>" id="name-lang-<?php echo e($lang->id); ?>" role="tabpanel">
                                            <input type="text" name="name[<?php echo e($lang->id); ?>]" class="cs-form-input"
                                                placeholder="<?php echo e(__('Enter template name')); ?>"
                                                <?php if($lang->id == 1): ?> required <?php endif; ?> maxlength="255">
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>

                            <div class="form-check form-switch mb-0">
                                <input class="form-check-input" type="checkbox" id="status" checked>
                                <input type="hidden" name="status" class="status-hidden" value="1">
                                <label class="form-check-label" for="status"><?php echo e(__('Active')); ?></label>
                            </div>
                        </div>
                    </div>

                    <?php echo $__env->make('chat-templates.question-section', [
                        'title' => __('Quick chats for buyer'),
                        'subtitle' => null,
                        'field_base' => 'customer_questions',
                        'questions' => [],
                        'languages' => $languages,
                        'default_lang_id' => 1,
                        'empty_text' => __('No message added yet. Click "Add Message" to configure conversation starters.'),
                    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                    <?php echo $__env->make('chat-templates.question-section', [
                        'title' => __('Quick chats for seller'),
                        'subtitle' => null,
                        'field_base' => 'seller_questions',
                        'questions' => [],
                        'languages' => $languages,
                        'default_lang_id' => 1,
                        'empty_text' => __('No message added yet. Click "Add Message" to configure conversation starters.'),
                    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>

                <div class="col-md-6 col-sm-12">
                    <?php echo $__env->make('category.category-scope', [
                        'categories' => $categories,
                        'selected_categories' => $selected_categories,
                        'selected_all_categories' => $selected_all_categories,
                        'wrapper_id' => 'category_selection_scope',
                        'subtitle' => __('Select the categories where this Chat Template Should be Applied'),
                        'show_global' => true,
                        'global_id' => 'is_global',
                        'global_label' => __('Global (Apply to All Categories)'),
                    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>
            </div>

            <div class="col-md-12 text-end mb-3">
                <a href="<?php echo e(route('chat-templates.index')); ?>" class="btn btn-secondary"><?php echo e(__('Cancel')); ?></a>
                <button type="submit" class="btn btn-primary"><?php echo e(__('Save')); ?></button>
            </div>
        </form>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        $('#status').on('change', function () {
            $(this).siblings('.status-hidden').val($(this).is(':checked') ? 1 : 0);
        });

        $('#is_global').on('change', function () {
            $('#chat_template_form input[name="selected_categories[]"]').prop('disabled', $(this).is(':checked'));
        });

        $('#chat_template_form').on('submit', function (e) {
            e.preventDefault();

            const $form = $(this);
            const $submitBtn = $form.find('button[type="submit"]');

            if ($submitBtn.prop('disabled')) {
                return;
            }

            if (typeof hasUnsavedQuestionDraft === 'function' && hasUnsavedQuestionDraft()) {
                showErrorToast('<?php echo e(__('You have an unsaved question. Please confirm or cancel it before saving.')); ?>');
                return;
            }

            const originalBtnHtml = $submitBtn.html();
            $submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>' + '<?php echo e(__('Saving...')); ?>');

            const formData = new FormData(this);

            ajaxRequest('POST', $form.attr('action'), formData, null, function (response) {
                showSuccessToast(response.message);
                setTimeout(function () {
                    window.location.href = "<?php echo e(route('chat-templates.index')); ?>";
                }, 1000);
            }, function (error) {
                $submitBtn.prop('disabled', false).html(originalBtnHtml);
                showErrorToast(error.message);
            }, function (response) {
                if (!response || response.error) {
                    $submitBtn.prop('disabled', false).html(originalBtnHtml);
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/chat-templates/create.blade.php ENDPATH**/ ?>