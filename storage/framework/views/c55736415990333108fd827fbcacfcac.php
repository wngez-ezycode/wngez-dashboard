<?php $__env->startSection('title'); ?>
    <?php echo e(__("Custom Fields")); ?> / <?php echo e(__("Sub Category")); ?>

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
        <div class="row">
            <div class="col-md-10">
                <div class="buttons text-start">
                    <a href="<?php echo e(route('category.index', $p_id)); ?>" class="btn btn-primary">< <?php echo e(__("Back To Category")); ?> </a>
                    <a href="<?php echo e(route('custom-fields.create', ['id' => $cat_id])); ?>" class="btn btn-primary">+ <?php echo e(__("Create Custom Field")); ?> / <?php echo e($category_name); ?></a>
                </div>
            </div>
        </div>

        <div class="col-md-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <?php
                        $cols = [
                            ['field'=>'state','title'=>'','checkbox'=>true],
                            ['field'=>'id','title'=>__('ID'),'align'=>'center','sortable'=>true],
                            ['field'=>'image','title'=>__('Image'),'align'=>'center','formatter'=>'imageFormatter'],
                            ['field'=>'name','title'=>__('Custom Field'),'align'=>'center','sortable'=>true],
                            ['field'=>'operate','title'=>__('Action'),'escape'=>false,'sortable'=>false],
                        ];
                    ?>
                    <?php if (isset($component)) { $__componentOriginalc8463834ba515134d5c98b88e1a9dc03 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8463834ba515134d5c98b88e1a9dc03 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.data-table','data' => ['id' => 'table_list','url' => route('category.custom-fields.show', $cat_id),'clickToSelect' => true,'fixedColumns' => true,'extra' => ['data-search-align'=>'right','data-query-params'=>'queryParams'],'columns' => $cols]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('data-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'table_list','url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('category.custom-fields.show', $cat_id)),'click-to-select' => true,'fixed-columns' => true,'extra' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['data-search-align'=>'right','data-query-params'=>'queryParams']),'columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($cols)]); ?>
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
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/category/custom-fields.blade.php ENDPATH**/ ?>