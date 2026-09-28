<?php $__env->startSection('title'); ?>
    <?php echo e(__('Countries')); ?>

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
       <div class="buttons d-flex justify-content-end">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('country-create')): ?>
            <a class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#countryModal">
                + <?php echo e(__("Import Countries")); ?>

            </a>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('country-update')): ?>
            <a class="btn btn-primary ms-2" href="<?php echo e(route('countries.translation')); ?>">
                 <i class="fa fa-language me-2"></i> <?php echo e(__("Translate Countries")); ?></a>
            <?php endif; ?>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <?php
                            $cols = [
                                ['field'=>'id','title'=>__('ID'),'sortable'=>true],
                                ['field'=>'name','title'=>__('Name'),'sortable'=>true],
                                ['field'=>'emoji','title'=>__('Flag')],
                                ['field'=>'status','title'=>__('Status'),'sortable'=>true,'escape'=>false,'formatter'=>'statusSwitchFormatter', 'align' => 'center'],
                                ['field'=>'operate','title'=>__('Action'),'escape'=>false],
                            ];
                        ?>
                        <?php if (isset($component)) { $__componentOriginalc8463834ba515134d5c98b88e1a9dc03 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8463834ba515134d5c98b88e1a9dc03 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.data-table','data' => ['id' => 'table_list','url' => route('countries.show',1),'clickToSelect' => true,'fixedColumns' => true,'filterControl' => true,'toolbarId' => 'filters','tableName' => 'countries','statusColumn' => 'status','showExport' => true,'exportFileName' => 'country-list','columns' => $cols]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('data-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'table_list','url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('countries.show',1)),'click-to-select' => true,'fixed-columns' => true,'filter-control' => true,'toolbar-id' => 'filters','table-name' => 'countries','status-column' => 'status','show-export' => true,'export-file-name' => 'country-list','columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($cols)]); ?>
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

        <div id="countryModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel1"><?php echo e(__('Import Country Data')); ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="create-form" action="<?php echo e(route('countries.import')); ?>" method="POST" data-success-function="successFunction">
                            <?php echo csrf_field(); ?>

                            <div class="row">
                                <div class="col-12 mb-3">
                                    <input type="text" id="countrySearchInput" class="form-control" placeholder="<?php echo e(__('Search countries...')); ?>">
                                </div>
                                <div class="col-12 mb-2">
                                    <input type="checkbox" id="selectAllCountries" class="form-check-input">
                                    <label for="selectAllCountries" class="form-label"><?php echo e(__('Select All')); ?></label>
                                </div>

                                <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-3">
                                        <input type="checkbox" id="<?php echo e($country['id']); ?>" name="countries[]" value="<?php echo e($country['id']); ?>" <?php echo e($country['is_already_exists'] ? "checked disabled" : ""); ?> class="form-check-input">
                                        <label for="<?php echo e($country['id']); ?>" class="form-label"><?php echo e($country['name'].' '.$country['emoji']); ?></label>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="text-end">
                                <input type="submit" value="<?php echo e(__("Save")); ?>" class="btn btn-primary mt-3">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script>
        function successFunction() {
            $('#countryModal').modal('hide');
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/places/country.blade.php ENDPATH**/ ?>