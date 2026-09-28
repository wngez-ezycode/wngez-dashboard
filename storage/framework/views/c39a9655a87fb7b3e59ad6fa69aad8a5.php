<?php $__env->startSection('title'); ?>
    <?php echo e(__('Currencies')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-title'); ?>
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6">
                <h4><?php echo $__env->yieldContent('title'); ?></h4>
            </div>
            <div class="buttons col-12 col-md-6 d-flex justify-content-end">
                <a class="btn btn-primary" href="<?php echo e(route('currency.create')); ?>"><?php echo e(__('Create Currency')); ?></a>
                
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
                                    ['field'=>'id','title'=>__('ID'),'sortable'=>true],
                                    ['field'=>'iso_code','title'=>__('ISO Code'),'sortable'=>true],
                                    ['field'=>'name','title'=>__('Name'),'sortable'=>true],
                                    ['field'=>'symbol','title'=>__('Symbol'),'sortable'=>true],
                                    ['field'=>'symbol_position','title'=>__('Symbol Position'),'sortable'=>true],
                                    ['field'=>'country.name','title'=>__('Country'),'sortable'=>true,'attrs'=>['data-sort-name'=>'country_name']],
                                ];
                                if(auth()->user()->canany(['currency-update','currency-delete'])) {
                                    $cols[] = ['field'=>'operate','title'=>__('Action'),'escape'=>false];
                                }
                            ?>
                            <?php if (isset($component)) { $__componentOriginalc8463834ba515134d5c98b88e1a9dc03 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8463834ba515134d5c98b88e1a9dc03 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.data-table','data' => ['id' => 'table_list','url' => route('currency.show', 1),'clickToSelect' => true,'fixedColumns' => true,'filterControl' => true,'toolbarId' => 'filters','tableName' => 'currencies','statusColumn' => 'deleted_at','showExport' => true,'exportFileName' => 'currency-list','columns' => $cols]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('data-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'table_list','url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('currency.show', 1)),'click-to-select' => true,'fixed-columns' => true,'filter-control' => true,'toolbar-id' => 'filters','table-name' => 'currencies','status-column' => 'deleted_at','show-export' => true,'export-file-name' => 'currency-list','columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($cols)]); ?>
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

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/currency/index.blade.php ENDPATH**/ ?>