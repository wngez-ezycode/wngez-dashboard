<?php $__env->startSection('title'); ?>
    <?php echo e(__("Categories")); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-title'); ?>
    <div class="page-title">
        <div class="row align-items-center">
            <div class="col-12 col-md-6">
            </div>
            <div class="col-12 col-md-6 d-flex justify-content-end">
                <?php if(!empty($category)): ?>
                    <a class="btn btn-primary me-2" href="<?php echo e(route('category.index')); ?>">< <?php echo e(__("Back to All Categories")); ?> </a>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('category-create')): ?>
                        <a class="btn btn-primary me-2" href="<?php echo e(route('category.create', ['id' => $category->id])); ?>">+ <?php echo e(__("Add Subcategory")); ?> - /<?php echo e($category->name); ?> </a>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="section">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">
                        <div class="wngez-list-card-head">
                            <div class="wngez-list-title">
                                <span><i class="ph ph-sliders-horizontal"></i></span>
                                <div>
                                    <h2><?php echo e(__('Set Order of Categories')); ?></h2>
                                    <p><?php echo e(__('Drag and drop to change the order of categories.')); ?></p>
                                </div>
                            </div>
                            <div class="wngez-list-actions">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('category-create')): ?>
                                    <a class="btn btn-primary" href="<?php echo e(route('category.create')); ?>"><i class="ph ph-plus"></i><?php echo e(__('Add Category')); ?></a>
                                    <a href="<?php echo e(route('category.bulk-upload')); ?>" class="btn btn-success"><i class="ph ph-upload-simple"></i><?php echo e(__('Bulk Upload')); ?></a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('category-update')): ?>
                                    <a href="<?php echo e(route('category.bulk-update')); ?>" class="btn btn-warning"><i class="ph ph-note-pencil"></i><?php echo e(__('Bulk Update')); ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php
                            $cols = [
                                ['field'=>'id','title'=>__('ID'),'align'=>'center','sortable'=>true],
                                ['field'=>'name','title'=>__('Name'),'sortable'=>true,'formatter'=>'categoryNameFormatter'],
                                ['field'=>'image','title'=>__('Image'),'align'=>'center','formatter'=>'imageFormatter'],
                                ['field'=>'subcategories_count','title'=>__('Subcategories'),'align'=>'center','sortable'=>false],
                                ['field'=>'custom_fields_count','title'=>__('Custom Fields'),'align'=>'center','sortable'=>false],
                                ['field'=>'advertisements_count','title'=>__('Advertisement Count'),'align'=>'center','sortable'=>true],
                            ];
                            if(auth()->user()->can('category-update')) {
                                $cols[] = ['field'=>'status','title'=>__('Active'),'width'=>5,'sortable'=>true,'formatter'=>'statusSwitchFormatter'];
                            }
                            if(auth()->user()->canany(['category-update','category-delete'])) {
                                $cols[] = ['field'=>'operate','title'=>__('Action'),'escape'=>false,'sortable'=>false];
                            }
                        ?>
                        <?php if (isset($component)) { $__componentOriginalc8463834ba515134d5c98b88e1a9dc03 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8463834ba515134d5c98b88e1a9dc03 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.data-table','data' => ['id' => 'table_list','url' => route('category.show', $category->id ?? 0),'clickToSelect' => true,'sortName' => 'sequence','sortOrder' => 'asc','tableName' => 'categories','mobileResponsive' => false,'showExport' => true,'exportFileName' => 'category-list','extra' => ['data-search-align'=>'right','data-query-params'=>'queryParams','data-use-row-attr-func'=>'true'],'columns' => $cols]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('data-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'table_list','url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('category.show', $category->id ?? 0)),'click-to-select' => true,'sort-name' => 'sequence','sort-order' => 'asc','table-name' => 'categories','mobile-responsive' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false),'show-export' => true,'export-file-name' => 'category-list','extra' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['data-search-align'=>'right','data-query-params'=>'queryParams','data-use-row-attr-func'=>'true']),'columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($cols)]); ?>
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

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/category/index.blade.php ENDPATH**/ ?>