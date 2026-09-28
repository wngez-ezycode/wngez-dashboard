<?php $__env->startSection('title'); ?>
    <?php echo e(__("Blog Category")); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-title'); ?>
    <div class="page-title">
        <div class="row align-items-center">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h4 class="mb-0"><?php echo $__env->yieldContent('title'); ?></h4>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first d-flex justify-content-end">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('blog-create')): ?>
                    <a class="btn btn-primary" href="<?php echo e(route('blog-category.create')); ?>">+ <?php echo e(__("Add Blog Category")); ?></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <section class="section">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <?php
                                        $cols = [
                                            ['field'=>'id','title'=>__('ID'),'sortable'=>true],
                                            ['field'=>'name','title'=>__('Name'),'sortable'=>true],
                                            ['field'=>'slug','title'=>__('Slug'),'sortable'=>true],
                                        ];
                                        if(auth()->user()->can('blog-update')) {
                                            $cols[] = ['field'=>'is_active','title'=>__('Active'),'width'=>100,'sortable'=>false,'formatter'=>'statusSwitchFormatter'];
                                        }
                                        if(auth()->user()->canany(['blog-update','blog-delete'])) {
                                            $cols[] = ['field'=>'operate','title'=>__('Action'),'width'=>100,'escape'=>false];
                                        }
                                    ?>
                                    <?php if (isset($component)) { $__componentOriginalc8463834ba515134d5c98b88e1a9dc03 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8463834ba515134d5c98b88e1a9dc03 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.data-table','data' => ['id' => 'table_list','url' => route('blog-category.show', 1),'clickToSelect' => true,'fixedColumns' => true,'showExport' => true,'exportFileName' => 'blog-categories-list','extra' => ['data-query-params'=>'queryParams', 'data-table'=>'blog_categories', 'data-status-column'=>'is_active'],'columns' => $cols]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('data-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'table_list','url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('blog-category.show', 1)),'click-to-select' => true,'fixed-columns' => true,'show-export' => true,'export-file-name' => 'blog-categories-list','extra' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['data-query-params'=>'queryParams', 'data-table'=>'blog_categories', 'data-status-column'=>'is_active']),'columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($cols)]); ?>
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
                </div>
            </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/blog_category/index.blade.php ENDPATH**/ ?>