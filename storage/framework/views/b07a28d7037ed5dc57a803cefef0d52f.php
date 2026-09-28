<?php $__env->startSection('title'); ?>
    <?php echo e(__("Custom Fields")); ?>

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
        <form action="<?php echo e(route('custom-fields.store')); ?>" method="POST" class="create-form" data-success-function="afterCustomFieldCreationSuccess" data-parsley-validate enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-header"><?php echo e(__("Create Custom Field")); ?></div>
                        <div class="card-body mt-2">

                            <ul class="nav nav-tabs" id="langTabs" role="tablist">
                                <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link <?php if($key == 0): ?> active <?php endif; ?>" id="tab-<?php echo e($lang->id); ?>" data-bs-toggle="tab" data-bs-target="#lang-<?php echo e($lang->id); ?>" type="button" role="tab">
                                            <?php echo e($lang->name); ?>

                                        </button>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>

                            <div class="tab-content mt-3">
                                <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="tab-pane fade <?php if($key == 0): ?> show active <?php endif; ?>" id="lang-<?php echo e($lang->id); ?>" role="tabpanel">
                                        <input type="hidden" name="languages[]" value="<?php echo e($lang->id); ?>">

                                        <div class="form-group">
                                            <label><?php echo e(__('Field Name')); ?> (<?php echo e($lang->name); ?>)</label>
                                            <input type="text" name="name[<?php echo e($lang->id); ?>]" class="form-control" <?php if($lang->id != 1): ?><?php endif; ?>>
                                        </div>

                                        <?php if($lang->id == 1): ?>
                                            
                                            <div class="form-group">
                                                <label><?php echo e(__('Field Type')); ?></label>
                                                <select name="type" class="form-control" required>
                                                    <option value="number"><?php echo e(__("Number Input")); ?></option>
                                                    <option value="textbox"><?php echo e(__("Text Input")); ?></option>
                                                    <option value="fileinput"><?php echo e(__("File Input")); ?></option>
                                                    <option value="radio"><?php echo e(__("Radio")); ?></option>
                                                    <option value="dropdown"><?php echo e(__("Dropdown")); ?></option>
                                                    <option value="checkbox"><?php echo e(__("Checkboxes")); ?></option>
                                                </select>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6 form-group min-max-fields">
                                                    <label><?php echo e(__('Field Length (Min)')); ?></label>
                                                    <input type="number" name="min_length" class="form-control" min="0">
                                                </div>
                                                <div class="col-md-6 form-group min-max-fields">
                                                    <label><?php echo e(__('Field Length (Max)')); ?></label>
                                                    <input type="number" name="max_length" class="form-control" min="0">
                                                </div>
                                            </div>
                                        <?php else: ?>
                                            <div class="alert alert-info mt-2">
                                                <?php echo e(__('Field type, min/max length, and status can only be set in English.')); ?>

                                            </div>
                                        <?php endif; ?>

                                        <div class="form-group">
                                            <label><?php echo e(__('Field Values')); ?> (<?php echo e($lang->name); ?>)</label>
                                            <select name="values[<?php echo e($lang->id); ?>][]" data-tags="true" data-placeholder="<?php echo e(__("Select an option")); ?>" data-allow-clear="true"  data-token-separators="[',']" class="select2 w-100 full-width-select2" multiple="multiple" <?php if($lang->id == 1): ?> required <?php endif; ?>></select>
                                            <?php if($lang->id != 1): ?>
                                                <small class="text-muted"><?php echo e(__('Used for translatable field types.')); ?></small>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-12 form-group mandatory">
                                        <label for="image" class="form-label"><?php echo e(__('Icon ')); ?></label>
                                        <input type="file" name="image" id="image" class="form-control" data-parsley-required="true" accept=".svg">
                                        <?php echo e(__("(use 256 x 256 size for better view)")); ?>

                                        <div class="img_error" style="color:#DC3545;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group mandatory">
                                    <div class="form-check form-switch  ">
                                        <input type="hidden" name="required" id="required" value="0">
                                        <input class="form-check-input status-switch" type="checkbox" role="switch" aria-label="required"><?php echo e(__('Required')); ?>

                                        <label class="form-check-label" for="required"></label>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group mandatory">
                                    <div class="form-check form-switch  ">
                                        <input type="hidden" name="status" id="status" value="0">
                                        <input class="form-check-input status-switch" type="checkbox" role="switch" aria-label="status"><?php echo e(__('Active')); ?>

                                        <label class="form-check-label" for="status"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if($cat_id == 0): ?>
                    <div class="col-md-6 col-sm-12">
                        <?php echo $__env->make('category.category-scope', [
                            'categories' => $categories,
                            'selected_categories' => $selected_categories ?? [],
                            'selected_all_categories' => $selected_all_categories ?? [],
                            'wrapper_id' => 'category_selection_scope',
                            'subtitle' => __('Select the categories where this Custom Field Should be Applied'),
                        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </div>
                <?php else: ?>
                    <input type="hidden" name="selected_categories[]" value="<?php echo e($cat_id); ?>">
                <?php endif; ?>
                <div class="col-md-12 text-end">
                    <input type="submit" class="btn btn-primary" value="<?php echo e(__("Save and Back")); ?>">
                </div>
            </div>
        </form>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script>
                function updateCustomFieldUI() {
            const type = $('select[name="type"]').val();
            const valuesTypes = ['radio', 'dropdown', 'checkbox'];

            $('.tab-pane').each(function () {
                const $tab = $(this);

                const $fieldValues = $tab.find('select[name^="values"]')
                                         .closest('.form-group');

                const $minMaxGroup = $tab.find('.min-max-fields');

                if (valuesTypes.includes(type)) {
                    $fieldValues.show();
                    $minMaxGroup.hide();
                } else if (type === 'fileinput') {
                    $fieldValues.hide();
                    $minMaxGroup.hide();
                } else {
                    $fieldValues.hide();
                    $minMaxGroup.show();
                }
            });
        }

        $(document).ready(function () {
            updateCustomFieldUI();

            $(document).on('change', 'select[name="type"]', function () {
                updateCustomFieldUI();
            });
        });

        $(document).on('click', '.category-header label', function(e) {
            if ($(e.target).is('input[type="checkbox"]')) {
                e.stopPropagation();
            }
        });

      function afterCustomFieldCreationSuccess() {
        setTimeout(function () {
            window.location.href = "<?php echo e(route('custom-fields.index')); ?>";
        }, 1000)
    }
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/custom-fields/create.blade.php ENDPATH**/ ?>