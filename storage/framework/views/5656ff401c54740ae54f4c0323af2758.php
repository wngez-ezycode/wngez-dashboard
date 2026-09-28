<?php $__env->startSection('title'); ?>
    <?php echo e(__('Role Management')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <?php echo e(__('Role Management')); ?>

            </h3>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role-create')): ?>
                <div class="buttons">
                    <a class="btn btn-primary" href="<?php echo e(route('roles.create')); ?>"> <?php echo e(__('Create New Role')); ?></a>
                </div>
            <?php endif; ?>
        </div>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role-list')): ?>
            <div class="row grid-margin">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <?php
                                $cols = [
                                    ['field'=>'id','title'=>__('ID'),'sortable'=>true,'visible'=>false],
                                    ['field'=>'no','title'=>__('No.')],
                                    ['field'=>'name','title'=>__('Name'),'sortable'=>true],
                                    ['field'=>'operate','title'=>__('Action'),'escape'=>false],
                                ];
                            ?>
                            <?php if (isset($component)) { $__componentOriginalc8463834ba515134d5c98b88e1a9dc03 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8463834ba515134d5c98b88e1a9dc03 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.data-table','data' => ['id' => 'table_list','url' => route('roles.list'),'clickToSelect' => true,'fixedNumber' => 2,'fixedColumns' => true,'showExport' => true,'exportFileName' => 'roles-list-' . date('d-m-y'),'extra' => ['data-maintain-selected'=>'true','data-export-data-type'=>'all','data-query-params'=>'queryParams'],'columns' => $cols]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('data-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'table_list','url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('roles.list')),'click-to-select' => true,'fixed-number' => 2,'fixed-columns' => true,'show-export' => true,'export-file-name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('roles-list-' . date('d-m-y')),'extra' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['data-maintain-selected'=>'true','data-export-data-type'=>'all','data-query-params'=>'queryParams']),'columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($cols)]); ?>
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
        <?php endif; ?>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/roles/index.blade.php ENDPATH**/ ?>