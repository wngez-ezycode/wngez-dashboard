<?php $__env->startSection('title'); ?>
    <?php echo e(__('User Subscriptions')); ?>

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
                                        ['field'=>'package.name','title'=>__('Package Name'),'align'=>'center','sortable'=>false],
                                        ['field'=>'start_date','title'=>__('Start Date'),'align'=>'center'],
                                        ['field'=>'end_date','title'=>__('End Date'),'align'=>'center','formatter'=>'unlimitedBadgeFormatter','sortable'=>true],
                                        ['field'=>'status','title'=>__('Status'),'align'=>'center','formatter'=>'userPackageStatusBadgeFormatter'],
                                        ['field'=>'total_limit','title'=>__('Total Limit'),'align'=>'center','formatter'=>'unlimitedBadgeFormatter','sortable'=>true],
                                        ['field'=>'used_limit','title'=>__('Used Limit'),'align'=>'center','sortable'=>true],
                                    ];
                                ?>
                                <?php
                                    $selectedStatus = request('status');
                                    $statusFilter = '<div class="col-lg-2">
                                        <label for="filter_status">'.__('Status').'</label>
                                        <select id="filter_status" class="form-select" onchange="$(\'#table_list\').bootstrapTable(\'refresh\')">
                                            <option value="">'.__('All').'</option>
                                            <option value="active"'.($selectedStatus === 'active' ? ' selected' : '').'>'.__('Active').'</option>
                                            <option value="expired"'.($selectedStatus === 'expired' ? ' selected' : '').'>'.__('Expired').'</option>
                                        </select>
                                    </div>';
                                ?>
                                <?php if (isset($component)) { $__componentOriginalc8463834ba515134d5c98b88e1a9dc03 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8463834ba515134d5c98b88e1a9dc03 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.data-table','data' => ['id' => 'table_list','url' => route('package.users.show'),'clickToSelect' => true,'fixedColumns' => true,'tableName' => 'packages','showExport' => true,'exportFileName' => 'user-package-list','toolbarId' => 'user-package-toolbar','toolbarSlot' => $statusFilter,'extra' => ['data-search-align'=>'right','data-query-params'=>'userPackageQueryParams'],'columns' => $cols]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('data-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'table_list','url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('package.users.show')),'click-to-select' => true,'fixed-columns' => true,'table-name' => 'packages','show-export' => true,'export-file-name' => 'user-package-list','toolbar-id' => 'user-package-toolbar','toolbar-slot' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($statusFilter),'extra' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['data-search-align'=>'right','data-query-params'=>'userPackageQueryParams']),'columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($cols)]); ?>
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

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/packages/user.blade.php ENDPATH**/ ?>