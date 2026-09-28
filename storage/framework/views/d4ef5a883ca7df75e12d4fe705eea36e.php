<?php $__env->startSection('title'); ?>
    <?php echo e(__('States')); ?>

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
        <div class="row m-3">
            <div class="col-12 text-end">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('state-update')): ?>
                    <a href="<?php echo e(route('states.translation')); ?>" class="btn btn-primary">
                        <i class="fa fa-language me-2"></i> <?php echo e(__('Translate States')); ?>

                    </a>
                <?php endif; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <?php
                            $filtersHtml = '<div class="row"><div class="col-12 col-md-12">
                                <label for="filter_country">'.__("Country").'</label>
                                <select class="form-control bootstrap-table-filter-control-country_name" id="filter_country">
                                    <option value="">'.__("All").'</option>';
                            foreach($countries as $country) {
                                $filtersHtml .= '<option value="'.$country->id.'">'.$country->name.'</option>';
                            }
                            $filtersHtml .= '</select></div></div>';
                        ?>

                        <?php if (isset($component)) { $__componentOriginalc8463834ba515134d5c98b88e1a9dc03 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8463834ba515134d5c98b88e1a9dc03 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.data-table','data' => ['id' => 'table_list','url' => route('states.show',1),'toolbarId' => 'filters','toolbarSlot' => $filtersHtml,'clickToSelect' => true,'filterControl' => true,'fixedColumns' => true,'showExport' => true,'exportFileName' => 'state-list','tableName' => 'states','statusColumn' => 'status','columns' => [
                                ['field'=>'id','title'=>__('ID'),'sortable'=>true],
                                ['field'=>'name','title'=>__('Name'),'sortable'=>true],
                                ['field'=>'country_name','title'=>__('Country'),'sortable'=>true,'filterName'=>'country_id','filterControl'=>'select','filterData'=>''],
                                ['field'=>'country.emoji','title'=>__('Flag')],
                                ['field'=>'status','title'=>__('Status'),'sortable'=>true,'escape'=>false,'formatter'=>'statusSwitchFormatter', 'align' => 'center'],
                                ['field'=>'operate','title'=>__('Action'),'sortable'=>false,'escape'=>false],
                            ]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('data-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'table_list','url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('states.show',1)),'toolbar-id' => 'filters','toolbar-slot' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($filtersHtml),'click-to-select' => true,'filter-control' => true,'fixed-columns' => true,'show-export' => true,'export-file-name' => 'state-list','table-name' => 'states','status-column' => 'status','columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
                                ['field'=>'id','title'=>__('ID'),'sortable'=>true],
                                ['field'=>'name','title'=>__('Name'),'sortable'=>true],
                                ['field'=>'country_name','title'=>__('Country'),'sortable'=>true,'filterName'=>'country_id','filterControl'=>'select','filterData'=>''],
                                ['field'=>'country.emoji','title'=>__('Flag')],
                                ['field'=>'status','title'=>__('Status'),'sortable'=>true,'escape'=>false,'formatter'=>'statusSwitchFormatter', 'align' => 'center'],
                                ['field'=>'operate','title'=>__('Action'),'sortable'=>false,'escape'=>false],
                            ])]); ?>
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

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/places/state.blade.php ENDPATH**/ ?>