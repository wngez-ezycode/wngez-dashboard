<?php $__env->startSection('title'); ?>
    <?php echo e(__("Tips")); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-title'); ?>
    <div class="page-title">
        <div class="row align-items-center">
            <div class="col-12 col-md-6">
                <h4 class="mb-0"><?php echo $__env->yieldContent('title'); ?></h4>
            </div>
            <div class="col-12 col-md-6 d-flex justify-content-end">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('tip-create')): ?>
                    <a class="btn btn-primary" href="<?php echo e(route('tips.create')); ?>">+ <?php echo e(__("Add Tip")); ?> </a>
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
                        <div id="toolbar">
                            <small class="text-danger">* <?php echo e(__("To change the order, Drag the Table column Up & Down")); ?></small>
                        </div>
                        <div class="table-responsive">
                            <?php
                                $cols = [
                                    ['field'=>'id','title'=>__('ID'),'align'=>'center','sortable'=>true],
                                    ['field'=>'description','title'=>__('Description'),'sortable'=>true,'formatter'=>'descriptionFormatter'],
                                ];
                                if(auth()->user()->can('tip-update')) {
                                    $cols[] = ['field'=>'status','title'=>__('Active'),'width'=>5,'sortable'=>false,'formatter'=>'statusSwitchFormatter'];
                                }
                                if(auth()->user()->canany(['tip-update','tip-delete'])) {
                                    $cols[] = ['field'=>'operate','title'=>__('Action'),'escape'=>false,'sortable'=>false];
                                }
                            ?>
                            <?php if (isset($component)) { $__componentOriginalc8463834ba515134d5c98b88e1a9dc03 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8463834ba515134d5c98b88e1a9dc03 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.data-table','data' => ['id' => 'table_list','url' => route('tips.show', 0),'toolbarId' => 'toolbar','clickToSelect' => true,'sortName' => 'sequence','sortOrder' => 'asc','tableName' => 'tips','statusColumn' => 'deleted_at','showExport' => true,'exportFileName' => 'tips-list','extra' => ['data-search-align'=>'right','data-query-params'=>'queryParams','data-reorderable-rows'=>'true','data-use-row-attr-func'=>'true','data-detail-view'=>'true','data-detail-formatter'=>'detailFormatter'],'columns' => $cols]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('data-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'table_list','url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('tips.show', 0)),'toolbar-id' => 'toolbar','click-to-select' => true,'sort-name' => 'sequence','sort-order' => 'asc','table-name' => 'tips','status-column' => 'deleted_at','show-export' => true,'export-file-name' => 'tips-list','extra' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['data-search-align'=>'right','data-query-params'=>'queryParams','data-reorderable-rows'=>'true','data-use-row-attr-func'=>'true','data-detail-view'=>'true','data-detail-formatter'=>'detailFormatter']),'columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($cols)]); ?>
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
    </section>

    <!-- Description Modal -->
    <div class="modal fade" id="descriptionModal" tabindex="-1" role="dialog" aria-labelledby="descriptionModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="descriptionModalLabel"><?php echo e(__('Full Description')); ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Full description will be injected here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/tip/index.blade.php ENDPATH**/ ?>