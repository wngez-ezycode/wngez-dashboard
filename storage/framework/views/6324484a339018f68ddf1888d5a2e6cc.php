<?php $__env->startSection('title'); ?>
    <?php echo e(__("Custom Fields")); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-title'); ?>
    <div class="page-title">
        <div class="row d-flex align-items-center">
            <div class="col-12 col-md-6">
                <h4 class="mb-0"><?php echo $__env->yieldContent('title'); ?></h4>
            </div>
            <div class="col-12 col-md-6 text-end mt-2 mt-md-0">
                <div class="d-flex flex-wrap gap-2 justify-content-end">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('custom-field-create')): ?>
                        <a href="<?php echo e(route('custom-fields.create', ['id' => 0])); ?>" class="btn btn-primary mb-0">
                            <span class="d-none d-sm-inline">+ <?php echo e(__("Create Custom Field")); ?></span>
                            <span class="d-sm-none">+ <?php echo e(__("Create")); ?></span>
                        </a>
                        <a href="<?php echo e(route('custom-fields.bulk-upload')); ?>" class="btn btn-success mb-0">
                            <i class="fas fa-upload"></i> <span class="d-none d-sm-inline"><?php echo e(__("Bulk Upload")); ?></span><span class="d-sm-none"><?php echo e(__("Upload")); ?></span>
                        </a>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('custom-field-update')): ?>
                        <a href="<?php echo e(route('custom-fields.bulk-update')); ?>" class="btn btn-warning mb-0">
                            <i class="fas fa-edit"></i> <span class="d-none d-sm-inline"><?php echo e(__("Bulk Update")); ?></span><span class="d-sm-none"><?php echo e(__("Update")); ?></span>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div id="filters">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <label for="filter"><?php echo e(__("Category")); ?></label>
                                    <select name="category" class="form-control select2 bootstrap-table-filter-control-category_names" aria-label="category">
                                        <option value=""><?php echo e(__("All")); ?></option>
                                        <?php echo $__env->make('category.dropdowntree', ['categories' => $categories], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                    </select>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="type"><?php echo e(__("Type")); ?></label>
                                    <select name="type" class="form-select form-control bootstrap-table-filter-control-type" id="type">
                                        <option value=""><?php echo e(__("All")); ?></option>
                                        <option value="number"><?php echo e(__("Number Input")); ?></option>
                                        <option value="textbox"><?php echo e(__("Text Input")); ?></option>
                                        <option value="fileinput"><?php echo e(__("File Input")); ?></option>
                                        <option value="radio"><?php echo e(__("Radio")); ?></option>
                                        <option value="dropdown"><?php echo e(__("Dropdown")); ?></option>
                                        <option value="checkbox"><?php echo e(__("Checkboxes")); ?></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <?php
                            $cfCols = [
                                ['field'=>'state','title'=>'','checkbox'=>true],
                                ['field'=>'id','title'=>__('ID'),'align'=>'center','sortable'=>true],
                                ['field'=>'image','title'=>__('Image'),'align'=>'center','formatter'=>'imageFormatter'],
                                ['field'=>'name','title'=>__('Name'),'align'=>'center','escape'=>true,'sortable'=>true],
                                ['field'=>'category_names','title'=>__('Category'),'align'=>'center','filterName'=>'category_id','filterControl'=>'select','filterData'=>''],
                                ['field'=>'type','title'=>__('Type'),'align'=>'center','sortable'=>true,'filterName'=>'type','filterControl'=>'select','filterData'=>''],
                            ];
                            if(auth()->user()->canany(['custom-field-update','custom-field-delete'])) {
                                $cfCols[] = ['field'=>'operate','title'=>__('Action'),'escape'=>false,'sortable'=>false];
                            }
                        ?>
                        <?php if (isset($component)) { $__componentOriginalc8463834ba515134d5c98b88e1a9dc03 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8463834ba515134d5c98b88e1a9dc03 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.data-table','data' => ['id' => 'table_list','url' => route('custom-fields.show',1),'toolbarId' => 'filters','clickToSelect' => true,'filterControl' => true,'fixedColumns' => true,'showExport' => true,'exportFileName' => 'custom-field-list','extra' => ['data-search-align'=>'right'],'columns' => $cfCols]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('data-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'table_list','url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('custom-fields.show',1)),'toolbar-id' => 'filters','click-to-select' => true,'filter-control' => true,'fixed-columns' => true,'show-export' => true,'export-file-name' => 'custom-field-list','extra' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['data-search-align'=>'right']),'columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($cfCols)]); ?>
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
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/custom-fields/index.blade.php ENDPATH**/ ?>