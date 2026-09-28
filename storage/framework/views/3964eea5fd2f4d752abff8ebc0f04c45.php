<?php $__env->startSection('title'); ?>
    <?php echo e(__('Custom Fields')); ?>

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
            <a class="btn btn-primary" href="<?php echo e(url('custom-fields')); ?>">
                < <?php echo e(__('Back to Custom Fields')); ?> </a>
                    <?php if(in_array($custom_field->type, ['radio', 'checkbox', 'dropdown'])): ?>
                        <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target='#addModal'>+
                            <?php echo e(__('Add Options')); ?></a>
                    <?php endif; ?>
        </div>
        <form action="<?php echo e(route('custom-fields.update', $custom_field->id)); ?>" class="edit-form"
            data-success-function="afterCustomFieldUpdate" method="POST" data-parsley-validate
            enctype="multipart/form-data">
            <?php echo method_field('PUT'); ?>
            <?php echo csrf_field(); ?>
            <div class="row">

                <div class="col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-header"><?php echo e(__('Edit Custom Field')); ?></div>
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
                                            <label><?php echo e(__('Field Name')); ?> (<?php echo e($lang->name); ?>)</label>
                                            <input type="text" name="name[<?php echo e($lang->id); ?>]" class="form-control"
                                                value="<?php echo e($translations[$lang->id]['name'] ?? ''); ?>"
                                                <?php if($lang->id == 1): ?> <?php endif; ?>>
                                        </div>

                                        <?php if($lang->id == 1): ?>
                                            
                                            <div class="form-group">
                                                <label><?php echo e(__('Field Type')); ?></label>
                                                <select name="type" id="type" class="form-control" required
                                                    disabled>
                                                    <option value="number"
                                                        <?php echo e($custom_field->type == 'number' ? 'selected' : ''); ?>>
                                                        <?php echo e(__('Number Input')); ?></option>
                                                    <option value="textbox"
                                                        <?php echo e($custom_field->type == 'textbox' ? 'selected' : ''); ?>>
                                                        <?php echo e(__('Text Input')); ?></option>
                                                    <option value="fileinput"
                                                        <?php echo e($custom_field->type == 'fileinput' ? 'selected' : ''); ?>>
                                                        <?php echo e(__('File Input')); ?></option>
                                                    <option value="radio"
                                                        <?php echo e($custom_field->type == 'radio' ? 'selected' : ''); ?>>
                                                        <?php echo e(__('Radio')); ?></option>
                                                    <option value="dropdown"
                                                        <?php echo e($custom_field->type == 'dropdown' ? 'selected' : ''); ?>>
                                                        <?php echo e(__('Dropdown')); ?></option>
                                                    <option value="checkbox"
                                                        <?php echo e($custom_field->type == 'checkbox' ? 'selected' : ''); ?>>
                                                        <?php echo e(__('Checkboxes')); ?></option>
                                                </select>
                                                <input type="hidden" name="type" value="<?php echo e($custom_field->type); ?>">
                                                <small
                                                    class="text-muted"><?php echo e(__('Field type cannot be changed after creation.')); ?></small>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6 form-group min-max-fields">
                                                    <label><?php echo e(__('Field Length (Min)')); ?></label>
                                                    <input type="number" name="min_length" class="form-control"
                                                        value="<?php echo e($custom_field->min_length !== null ? $custom_field->min_length : ''); ?>" min="0">
                                                </div>
                                                <div class="col-md-6 form-group min-max-fields">
                                                    <label><?php echo e(__('Field Length (Max)')); ?></label>
                                                    <input type="number" name="max_length" class="form-control"
                                                        value="<?php echo e($custom_field->max_length !== null ? $custom_field->max_length : ''); ?>" min="0">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="col-md-12 form-group">
                                                        <label for="image"
                                                            class="form-label"><?php echo e(__('Icon ')); ?></label>
                                                        <input type="file" name="image" id="image"
                                                            class="form-control" accept=".svg">
                                                        <?php echo e(__('(use 256 x 256 size for better view)')); ?>

                                                        <div class="field_img mt-2">
                                                            <img src="<?php echo e(empty($custom_field->image) ? asset('assets/img_placeholder.jpeg') : $custom_field->image); ?>"
                                                                alt="" id="blah"
                                                                class="preview-image img w-25">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 form-group mandatory">
                                                    <div class="form-check form-switch  ">
                                                        <input type="hidden" name="required" id="required"
                                                            value="<?php echo e($custom_field->required ? '1' : '0'); ?>">
                                                        <input class="form-check-input status-switch" type="checkbox"
                                                            role="switch" aria-label="required"
                                                            <?php echo e($custom_field->required ? 'checked' : ''); ?>><?php echo e(__('Required')); ?>

                                                        <label class="form-check-label" for="required"></label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 form-group mandatory">
                                                    <div class="form-check form-switch  ">
                                                        <input type="hidden" name="status" id="status"
                                                            value="<?php echo e($custom_field->status ? '1' : '0'); ?>">
                                                        <input class="form-check-input status-switch" type="checkbox"
                                                            role="switch" aria-label="status"
                                                            <?php echo e($custom_field->status ? 'checked' : ''); ?>><?php echo e(__('Active')); ?>

                                                        <label class="form-check-label" for="status"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <div class="form-group">
                                            <label><?php echo e(__('Field Values')); ?> (<?php echo e($lang->name); ?>)</label>
                                            
                                            <?php
                                                $fieldValues = [];

                                                if ($lang->id == 1) {
                                                    $fieldValues = is_array($custom_field->values)
                                                        ? $custom_field->values
                                                        : [];
                                                } elseif (
                                                    isset($translations[$lang->id]['value']) &&
                                                    !empty($translations[$lang->id]['value'])
                                                ) {
                                                    $fieldValues = $translations[$lang->id]['value'];
                                                }

                                                if (is_string($fieldValues)) {
                                                    $fieldValues = json_decode($fieldValues, true);
                                                }
                                            
                                                if (!is_array($fieldValues)) {
                                                    $fieldValues = [];
                                                }
                                                
                                                // Ensure all values including 0 are preserved as strings for Tagify
                                                $fieldValues = array_map(function($v) {
                                                    return $v !== null && $v !== '' ? (string)$v : '';
                                                }, $fieldValues);
                                            ?>


                                            <input
                                                type="text"
                                                name="values[<?php echo e($lang->id); ?>]"
                                                class="tagify-input w-100"
                                                value='<?php echo json_encode($fieldValues ?? [], 15, 512) ?>'
                                                data-field-values='<?php echo json_encode($fieldValues ?? [], 15, 512) ?>'
                                            >



                                            <?php if($lang->id != 1): ?>
                                                <small
                                                    class="text-muted"><?php echo e(__('Used for translatable field types.')); ?></small>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-sm-12">
                    <?php echo $__env->make('category.category-scope', [
                        'categories' => $categories,
                        'selected_categories' => $selected_categories,
                        'selected_all_categories' => $selected_all_categories,
                        'wrapper_id' => 'category_selection_scope',
                        'subtitle' => __('Select the categories where this Custom Field Should be Applied'),
                    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>

                <div class="col-md-12 text-end mb-3">
                    <input type="submit" class="btn btn-primary" value="<?php echo e(__('Save and Back')); ?>">
                </div>
            </div>
        </form>
        <!-- <?php if(in_array($custom_field->type, ['radio', 'checkbox', 'dropdown'])): ?>
    <div class="col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-borderless table-striped" id="table_list"
                                   data-toggle="table" data-url="<?php echo e(route('custom-fields.value.show', $custom_field->id)); ?>"
                                   data-click-to-select="true"
                                   data-page-list="[5, 10, 20, 50, 100, 200]" data-search="true" data-search-align="right"
                                   data-toolbar="#toolbar" data-show-columns="true" data-show-refresh="true"
                                   data-trim-on-search="false" data-responsive="true" data-sort-name="id"
                                   data-escape="true"
                                   data-sort-order="desc" data-query-params="queryParams"
                                   data-table="custom_fields" data-use-row-attr-func="true" data-mobile-responsive="true">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col" data-field="id" data-align="center" data-sortable="true"><?php echo e(__('ID')); ?></th>
                                    <th scope="col" data-field="value" data-align="center" data-sortable="true"><?php echo e(__('Value')); ?></th>
                                    <th scope="col" data-field="operate"data-escape="false" data-align="center" data-sortable="false" data-events="customFieldValueEvents"><?php echo e(__('Action')); ?></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
    <?php endif; ?> -->
        
        <?php if(in_array($custom_field->type, ['radio', 'checkbox', 'dropdown'])): ?>
            <div id="addModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel1"><?php echo e(__('Add Values')); ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="<?php echo e(route('custom-fields.value.add', $custom_field->id)); ?>"
                                class="create-form form-horizontal" enctype="multipart/form-data" method="POST"
                                data-parsley-validate>
                                <?php echo csrf_field(); ?>
                                <div class="col-md-12 form-group mandatory">
                                    <label for="values" class="mandatory form-label"><?php echo e(__('Field Values')); ?></label>
                                    <input type="text" name="values" id="values" class="form-control"
                                        value="<?php echo e(old('values')); ?>" data-parsley-required="true">
                                </div>

                                <input type="hidden" name="field_id" id="field_id" value="<?php echo e($custom_field->id); ?>">
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary waves-effect"
                                        data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
                                    <button type="submit"
                                        class="btn btn-primary waves-effect waves-light"><?php echo e(__('Save')); ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            
            <div id="editModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel1"><?php echo e(__('Edit Custome Field Values')); ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="<?php echo e(route('custom-fields.value.update', $custom_field->id)); ?>"
                                class="edit-form form-horizontal" enctype="multipart/form-data" method="POST"
                                data-parsley-validate>
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="old_custom_field_value" id="old_custom_field_value" />
                                <div class="col-md-12 form-group mandatory">
                                    <label for="new_custom_field_value"
                                        class="mandatory form-label"><?php echo e(__('Name')); ?></label>
                                    <input type="text" name="new_custom_field_value" id="new_custom_field_value"
                                        class="form-control" value="" data-parsley-required="true">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary waves-effect"
                                        data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
                                    <button type="submit"
                                        class="btn btn-primary waves-effect waves-light"><?php echo e(__('Save')); ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.modal-content -->
        <?php endif; ?>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script>
        window.existingTranslations = <?php echo json_encode($translations ?? [], 15, 512) ?>;
        // console.log('Loaded Translations:', window.existingTranslations);
    </script>

    <script>
        function updateCustomFieldUI() {
            const type = $('input[name="type"]').val() || $('select[name="type"]').val();
            const valuesTypes = ['radio', 'dropdown', 'checkbox'];

            $('.tab-pane').each(function() {
                const $tab = $(this);

                const $fieldValues = $tab.find('.tagify-input, select[name^="values"]')
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

        $(document).ready(function() {
            updateCustomFieldUI();

            $(document).on('change', 'select[name="type"]', function() {
                updateCustomFieldUI();
            });

            // Initialize select2 for all value selects
            $('select[name^="values"]').each(function() {
                if (!$(this).hasClass('select2-hidden-accessible')) {
                    $(this).select2({
                        tags: true,
                        tokenSeparators: [','],
                        placeholder: "<?php echo e(__('Select an option')); ?>",
                        allowClear: true
                    });
                }
            });

            // Image preview functionality
            $('#image').on('change', function() {
                const [file] = this.files;
                if (file) {
                    $('#blah').attr('src', URL.createObjectURL(file));
                }
            });

            // Reflect stored (parent-level) category selections onto their
            // children in the UI, same as the manual click cascade.
        });

        $(document).on('click', '.category-header label', function(e) {
            if ($(e.target).is('input[type="checkbox"]')) {
                e.stopPropagation();
            }
        });

        function afterCustomFieldUpdate() {
            setTimeout(function() {
                window.location.href = "<?php echo e(route('custom-fields.index')); ?>"
            }, 1000)
        }

document.addEventListener('DOMContentLoaded', function () {
    const defaultLangId = '<?php echo e($languages->first()->id ?? 1); ?>';
    const tagifyInstances = {};

    document.querySelectorAll('.tagify-input').forEach((input) => {
        // Extract language ID from input name: values[1] -> 1
        const name = input.getAttribute('name');
        const match = name ? name.match(/values\[(\d+)\]/) : null;
        if (!match) return;

        const langId = match[1];

        // Get existing Tagify instance (may have been created by custom.js) or create new one
        let tagify = input.__tagify || null;

        if (!tagify) {
            tagify = new Tagify(input, {
                delimiters: ",",
                editTags: true,
                duplicate: false,
                dropdown: { enabled: 0 },
                transformTag: function(tagData) {
                    if (tagData.value !== null && tagData.value !== undefined) {
                        tagData.value = String(tagData.value);
                    }
                    return tagData;
                },
                whitelist: [],
                enforceWhitelist: false,
                trim: false
            });
        }

        // Load correct initial values from data-field-values attribute
        let initialValues = [];
        try {
            const dataValues = input.getAttribute('data-field-values');
            if (dataValues) {
                initialValues = JSON.parse(dataValues);
            }
        } catch (e) {
            console.warn('Error parsing initial values:', e);
        }

        initialValues = initialValues
            .map(v => (v !== null && v !== undefined) ? String(v) : '')
            .filter(v => v !== '');

        // Reset and load the correct values
        tagify.removeAllTags();
        if (initialValues.length > 0) {
            tagify.addTags(initialValues);
        }

        tagifyInstances[langId] = tagify;
    });

    // Sync: when a tag is removed on the default language,
    // propagate the removal to all other language Tagify instances.
    // (Adding a new option is intentionally NOT auto-copied to other
    // languages — it must be translated manually.)
    const defaultTagify = tagifyInstances[defaultLangId];
    if (defaultTagify) {
        let syncing = false;

        defaultTagify.on('remove', function (e) {
            if (syncing) return;
            syncing = true;

            const removedIndex = e.detail.index;

            Object.keys(tagifyInstances).forEach(function (langId) {
                if (langId === defaultLangId) return;
                const otherTagify = tagifyInstances[langId];
                const tagElms = otherTagify.getTagElms();

                if (removedIndex !== undefined && tagElms.length > removedIndex) {
                    otherTagify.removeTags([tagElms[removedIndex]]);
                }
            });

            syncing = false;
        });
    }
});


    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/custom-fields/edit.blade.php ENDPATH**/ ?>