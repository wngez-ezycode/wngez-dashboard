<?php $__env->startSection('title'); ?>
    <?php echo e(__("Seller Verifications")); ?>

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
            <a class="btn btn-primary" href="<?php echo e(route('seller-verification.verification-field')); ?>">< <?php echo e(__("Back to Verification Fields")); ?> </a>
            <?php if(in_array($verification_field->type,['radio','checkbox','dropdown'])): ?>
                <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target='#addModal'>+ <?php echo e(__("Add Options")); ?></a>
            <?php endif; ?>
        </div>
        <div class="row">
            <form action="<?php echo e(route('seller-verification.update', $verification_field->id)); ?>" method="POST" data-success-function="afterCustomFieldCreation" enctype="multipart/form-data" class="edit-form">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="card">
                            <div class="card-header"><?php echo e(__("Verification Field")); ?></div>
                            <div class="card-body mt-3">
                                    
                                    <ul class="nav nav-tabs" role="tablist">
                                            <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li class="nav-item">
                                                    <a class="nav-link <?php if($key == 0): ?> active <?php endif; ?>"
                                                    data-bs-toggle="tab"
                                                    href="#lang-<?php echo e($lang->id); ?>"><?php echo e($lang->name); ?></a>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>

                                        <div class="tab-content mt-3">
                                            <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                    $langTranslations = $verification_field->translations->where('language_id', $lang->id);
                                                    $translatedName = optional($langTranslations->firstWhere('key', 'name'))->value;
                                                    $translatedValuesRow = $langTranslations->firstWhere('key', 'value');
                                                    $translatedValues = $translatedValuesRow ? $translatedValuesRow->value : [];
                                                    if (is_string($translatedValues)) {
                                                        $decoded = json_decode($translatedValues, true);
                                                        $translatedValues = is_array($decoded) ? $decoded : [];
                                                    }
                                                    $isEnglish = $lang->id == 1;
                                                ?>
                                                <div class="tab-pane fade <?php if($key == 0): ?> show active <?php endif; ?>" id="lang-<?php echo e($lang->id); ?>" role="tabpanel">
                                                    <input type="hidden" name="languages[]" value="<?php echo e($lang->id); ?>">

                                                    
                                                    <div class="form-group mb-3">
                                                        <label><?php echo e(__('Field Name')); ?> (<?php echo e($lang->name); ?>)</label>
                                                        <input type="text"
                                                            name="name[<?php echo e($lang->id); ?>]"
                                                            class="form-control"
                                                            value="<?php echo e($isEnglish ? $verification_field->name : ($translatedName ?? '')); ?>"
                                                            <?php if($isEnglish): ?> required <?php endif; ?>>
                                                    </div>

                                                    <?php if($isEnglish): ?>
                                                        
                                                        <div class="form-group mb-3">
                                                            <label><?php echo e(__('Field Type')); ?></label>
                                                            <select name="type" id="type" class="form-control" required>
                                                                 <option value="<?php echo e($verification_field->type); ?>" selected><?php echo e(ucfirst($verification_field->type)); ?></option>
                                                            </select>
                                                        </div>

                                                        
                                                        <div class="row min-max-fields">
                                                            <div class="col-md-6">
                                                                <label><?php echo e(__('Field Length (Min)')); ?></label>
                                                                <input type="number" name="min_length" class="form-control" value="<?php echo e($verification_field->min_length); ?>">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label><?php echo e(__('Field Length (Max)')); ?></label>
                                                                <input type="number" name="max_length" class="form-control" value="<?php echo e($verification_field->max_length); ?>">
                                                            </div>
                                                        </div>
                                                    <?php else: ?>
                                                        <div class="alert alert-info">
                                                            <?php echo e(__('Field type, min/max length, required and status can only be set in English.')); ?>

                                                        </div>
                                                    <?php endif; ?>

                                                    <?php if($verification_field->type == 'radio' || $verification_field->type == 'checkbox' || $verification_field->type == 'select'): ?>                                                        
                                                        
                                                        <?php
                                                            $values = $isEnglish
                                                                ? ($verification_field->values ?? [])
                                                                : ($translatedValues ?? []);
                                                        ?>

                                                        <div class="form-group">
                                                            <label><?php echo e(__('Field Values')); ?> (<?php echo e($lang->name); ?>)</label>
                                                            <select name="values[<?php echo e($lang->id); ?>][]" data-tags="true" class="form-control select2" multiple>
                                                                <?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($val); ?>" selected><?php echo e($val); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                            <?php if(!$isEnglish): ?>
                                                                <small class="text-muted"><?php echo e(__('Used for translatable fields like dropdown, radio, checkbox.')); ?></small>
                                                            <?php endif; ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    <div class="row">
                                        <div class="col-md-6 form-group mandatory">
                                            <div class="form-check form-switch  ">
                                                <input type="hidden" name="is_required" id="required" value="<?php echo e($verification_field->is_required ? '1' : '0'); ?>">
                                                <input class="form-check-input status-switch" type="checkbox" role="switch" aria-label="required" <?php echo e($verification_field->is_required ? 'checked' : ''); ?>><?php echo e(__('Required')); ?>

                                                <label class="form-check-label" for="required"></label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 form-group mandatory">
                                            <div class="form-check form-switch">

                                                <input type="hidden" name="status" id="status" value="<?php echo e($verification_field->deleted_at ? '0' : '1'); ?>">

                                                <input class="form-check-input status-switch" type="checkbox" role="switch" aria-label="status"
                                                       <?php echo e($verification_field->deleted_at ? '' : 'checked'); ?>>
                                                <?php echo e(__('Active')); ?>

                                                <label class="form-check-label" for="status"></label>
                                            </div>
                                        </div>
                                    <div class="col-md-12 text-end mb-3">
                                        <input type="submit" class="btn btn-primary" value="<?php echo e(__("Save and Back")); ?>">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <?php if(in_array($verification_field->type,['radio','checkbox','dropdown'])): ?>
            <div class="col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <?php
                            $cols = [
                                ['field'=>'id','title'=>__('ID'),'align'=>'center','sortable'=>true],
                                ['field'=>'value','title'=>__('Value'),'align'=>'center','sortable'=>true],
                                ['field'=>'operate','title'=>__('Action'),'escape'=>false,'align'=>'center','sortable'=>false,'events'=>'verificationFieldValueEvents'],
                            ];
                        ?>
                        <?php if (isset($component)) { $__componentOriginalc8463834ba515134d5c98b88e1a9dc03 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8463834ba515134d5c98b88e1a9dc03 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.data-table','data' => ['id' => 'table_list','url' => route('seller-verification.value.show', $verification_field->id),'clickToSelect' => true,'extra' => ['data-search-align'=>'right','data-query-params'=>'queryParams','data-use-row-attr-func'=>'true'],'columns' => $cols]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('data-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'table_list','url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('seller-verification.value.show', $verification_field->id)),'click-to-select' => true,'extra' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['data-search-align'=>'right','data-query-params'=>'queryParams','data-use-row-attr-func'=>'true']),'columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($cols)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc8463834ba515134d5c98b88e1a9dc03)): ?>
<?php $attributes = $__attributesOriginalc8463834ba515134d5c98b88e1a9dc03; ?>
<?php unset($__attributesOriginalc8463834ba515134d5c98b88e1a9dc03); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc8463834ba515134d5c98b88e1a9dc03)): ?>
<?php $component = $__componentOriginalc8463834ba515134d5c98b88e1a9dc03; ?>
<?php unset($__componentOriginalc8463834ba515134d5c98b88e1a9dc03); ?>
<?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        
        <?php if(in_array($verification_field->type,['radio','checkbox','dropdown'])): ?>
            <div id="addModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel1"><?php echo e(__('Add Values')); ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="<?php echo e(route('seller-verification.value.add',$verification_field->id)); ?>" class="create-form form-horizontal" enctype="multipart/form-data" method="POST" data-parsley-validate>
                                <?php echo csrf_field(); ?>
                                <div class="col-md-12 form-group mandatory">
                                    <label for="values" class="mandatory form-label"><?php echo e(__('Field Values')); ?></label>
                                    <input type="text" name="values" id="values" class="form-control" value="<?php echo e(old('values')); ?>" data-parsley-required="true">
                                </div>

                                <input type="hidden" name="field_id" id="field_id" value="<?php echo e($verification_field->id); ?>">
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light"><?php echo e(__('Save')); ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            
            <div id="editModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel1"><?php echo e(__('Edit Verfication Field Values')); ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="<?php echo e(route('seller-verification.value.update',$verification_field->id)); ?>" class="edit-form form-horizontal" enctype="multipart/form-data" method="POST" data-parsley-validate>
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>
                                <input type="hidden" name="old_verification_field_value" id="old_verification_field_value"/>
                                <div class="col-md-12 form-group mandatory">
                                    <label for="new_verification_field_value" class="mandatory form-label"><?php echo e(__('Name')); ?></label>
                                    <input type="text" name="new_verification_field_value" id="new_verification_field_value" class="form-control" value="" data-parsley-required="true">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light"><?php echo e(__('Save')); ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.modal-content -->
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        function updateVerificationFieldUI() {
    const type = $('select[name="type"]').val();
    const valuesTypes = ['radio', 'dropdown', 'checkbox'];

    $('.tab-pane').each(function () {
        const $tab = $(this);
        const $fieldValues = $tab.find('select[name^="values"]').closest('.form-group');
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
    updateVerificationFieldUI();
    $('select[name="type"]').on('change', updateVerificationFieldUI);
});

        function afterCustomFieldCreation() {
            setTimeout(function () {
                window.location.href = "<?php echo e(route('seller-verification.verification-field')); ?>";
            }, 1000)
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/seller-verification/edit.blade.php ENDPATH**/ ?>