<?php $__env->startSection('title'); ?>
    <?php echo e(__("Verification Fields")); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-title'); ?>
    <div class="page-title">
        <div class="row d-flex align-items-center">
            <div class="col-12 col-md-6">
                <h4 class="mb-0"><?php echo $__env->yieldContent('title'); ?></h4>
            </div>
            <div class="col-12 col-md-6 text-end">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('seller-verification-field-create')): ?>
                    <a href="<?php echo e(route('seller-verification.create')); ?>" class="btn btn-primary mb-0">+ <?php echo e(__("Create Verification Field")); ?> </a>
                <?php endif; ?>
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
                        <?php
                            $cols = [
                                ['field'=>'id','title'=>__('ID'),'align'=>'center','sortable'=>true],
                                ['field'=>'name','title'=>__('Name'),'align'=>'center','sortable'=>true],
                                ['field'=>'min_length','title'=>__('Min Length'),'align'=>'center','sortable'=>true],
                                ['field'=>'max_length','title'=>__('Max Length'),'align'=>'center','sortable'=>true],
                                ['field'=>'values','title'=>__('Values'),'align'=>'center','sortable'=>true,'formatter'=>'rejectedReasonFormatter'],
                            ];
                            if(auth()->user()->canany(['seller-verification-field-update','seller-verification-field-delete'])) {
                                $cols[] = ['field'=>'operate','title'=>__('Action'),'align'=>'center','sortable'=>false,'escape'=>false,'events'=>'verificationfeildEvents'];
                            }
                        ?>
                        <?php if (isset($component)) { $__componentOriginalc8463834ba515134d5c98b88e1a9dc03 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8463834ba515134d5c98b88e1a9dc03 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.data-table','data' => ['id' => 'table_list','url' => route('verification-field.show'),'clickToSelect' => true,'fixedColumns' => true,'filterControl' => true,'toolbarId' => 'filters','showExport' => true,'exportFileName' => 'verification-fields-list','extra' => ['data-search-align'=>'right'],'columns' => $cols]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('data-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'table_list','url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('verification-field.show')),'click-to-select' => true,'fixed-columns' => true,'filter-control' => true,'toolbar-id' => 'filters','show-export' => true,'export-file-name' => 'verification-fields-list','extra' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['data-search-align'=>'right']),'columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($cols)]); ?>
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


<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/seller-verification/verificationfield.blade.php ENDPATH**/ ?>