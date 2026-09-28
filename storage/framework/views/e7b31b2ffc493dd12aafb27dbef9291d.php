<?php $__env->startSection('title'); ?>
    <?php echo e(__('Payment Transactions')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-title'); ?>
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h4><?php echo $__env->yieldContent('title'); ?></h4>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first"></div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="section">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                        

                        <div class="row">
                            <div class="col-12">
                                <?php
                                    $cols = [
                                        ['field'=>'id','title'=>__('ID'),'align'=>'center','sortable'=>true],
                                        ['field'=>'user.name','title'=>__('User Name'),'align'=>'center','sortable'=>false, 'formatter' => 'userProfileFormatter'],
                                        ['field'=>'amount','title'=>__('Amount'),'align'=>'center','sortable'=>false],
                                        ['field'=>'payment_gateway','title'=>__('Payment Gateway'),'align'=>'center'],
                                        ['field'=>'payment_status','title'=>__('Payment Status'),'align'=>'center','sortable'=>true],
                                        ['field'=>'order_id','title'=>__('Order Id'),'visible'=>false,'align'=>'center','sortable'=>true],
                                        ['field'=>'created_at','title'=>__('Created At'),'align'=>'center','sortable'=>true],
                                        ['field'=>'operate','title'=>__('Action'),'align'=>'center','sortable'=>false,'escape'=>false],
                                    ];
                                ?>
                                <?php if (isset($component)) { $__componentOriginalc8463834ba515134d5c98b88e1a9dc03 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8463834ba515134d5c98b88e1a9dc03 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.data-table','data' => ['id' => 'table_list','url' => route('package.payment-transactions.show'),'clickToSelect' => true,'fixedColumns' => true,'tableName' => 'packages','showExport' => true,'exportFileName' => 'user-package-list','extra' => ['data-search-align'=>'right','data-query-params'=>'queryParams'],'columns' => $cols]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('data-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'table_list','url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('package.payment-transactions.show')),'click-to-select' => true,'fixed-columns' => true,'table-name' => 'packages','show-export' => true,'export-file-name' => 'user-package-list','extra' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['data-search-align'=>'right','data-query-params'=>'queryParams']),'columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($cols)]); ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/packages/payment-transactions.blade.php ENDPATH**/ ?>