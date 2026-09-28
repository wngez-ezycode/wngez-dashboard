<?php $__env->startSection('title'); ?>
    <?php echo e(__('Cities')); ?>

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
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('city-update')): ?>
                    <a href="<?php echo e(route('cities.translation')); ?>" class="btn btn-primary">
                        <i class="fa fa-language me-2"></i> <?php echo e(__('Translate Cities')); ?>

                    </a>
                <?php endif; ?>
            </div>
        </div>

        <div class="row">
            <form class="create-form" action="<?php echo e(route('city.create')); ?>" method="POST" data-parsley-validate enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header"><?php echo e(__("Add City")); ?></div>
                        <div class="card-body mt-3">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="country" class="mandatory form-label"><?php echo e(__("Country")); ?></label>
                                    <select name="country_id" id="country" class="form-control form-select" data-placeholder="<?php echo e(__("Select Country")); ?>">
                                        <option value=""><?php echo e(__("Select Country")); ?></option>
                                        <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($country->id); ?>"><?php echo e($country->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="state" class="mandatory form-label"><?php echo e(__("State")); ?></label>
                                    <select name="state_id" id="state" class="form-control form-select" data-placeholder="<?php echo e(__("Select State")); ?>">
                                        <option value=""><?php echo e(__("Select State")); ?></option>
                                    </select>
                                </div>
                            </div>
                            <div id="city-container" >
                                <div class="row city-input-group">
                                    <div class="form-group col-md-4 col-sm-12">
                                        <label for="name" class="mandatory form-label mt-2"><?php echo e(__("City Name")); ?></label><span class="text-danger">*</span>
                                        <div class="d-flex mb-2">
                                            <input type="text" name="name[]" class="form-control me-2" placeholder="<?php echo e(__("Enter City name")); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 col-sm-12">
                                        <label for="latitude" class="mandatory form-label mt-2"><?php echo e(__("Latitude")); ?></label>
                                        <div class="d-flex mb-2">
                                            <input type="text" name="latitude[]" class="form-control me-2" placeholder="<?php echo e(__("Enter Latitude")); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 col-sm-12">
                                        <label for="longitude" class="mandatory form-label mt-2"><?php echo e(__("Longitude")); ?></label>
                                        <div class="d-flex mb-2">
                                            <input type="text" name="longitude[]" class="form-control me-2" placeholder="<?php echo e(__("Enter Longitude")); ?>">
                                            <button type="button" class="btn btn-secondary add-city-button">+</button>
                                            <button type="button" class="btn btn-danger remove-city-button ms-2">-</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <div id="map"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 m-2 text-end">
                                <input type="submit" class="btn btn-primary" value="<?php echo e(__("Create")); ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <?php
                            $filtersHtml = '<div class="row">
                                <div class="col-12 col-md-4">
                                    <label for="filter_country">'.__("Country").'</label>
                                    <select class="form-control bootstrap-table-filter-control-country_name" id="filter_country">
                                        <option value="">'.__("All").'</option>';
                            foreach($countries as $country) {
                                $filtersHtml .= '<option value="'.$country->id.'">'.$country->name.'</option>';
                            }
                            $filtersHtml .= '</select></div>
                                <div class="col-12 col-md-4">
                                    <label for="filter_state">'.__("State").'</label>
                                    <select class="form-control bootstrap-table-filter-control-state_name" id="filter_state">
                                        <option value="">'.__("All").'</option>
                                    </select></div></div>';
                        ?>

                        <?php if (isset($component)) { $__componentOriginalc8463834ba515134d5c98b88e1a9dc03 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8463834ba515134d5c98b88e1a9dc03 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.data-table','data' => ['id' => 'table_list','url' => route('cities.show',1),'toolbarId' => 'filters','toolbarSlot' => $filtersHtml,'clickToSelect' => true,'filterControl' => true,'fixedColumns' => true,'showExport' => true,'exportFileName' => 'city-list','tableName' => 'cities','statusColumn' => 'status','columns' => [
                                ['field'=>'id','title'=>__('ID'),'sortable'=>true],
                                ['field'=>'name','title'=>__('Name'),'sortable'=>true],
                                ['field'=>'country_name','title'=>__('Country Name'),'sortable'=>true,'filterName'=>'country_id','filterControl'=>'select','filterData'=>''],
                                ['field'=>'state_name','title'=>__('State Name'),'sortable'=>true,'filterName'=>'state_id','filterControl'=>'select','filterData'=>''],
                                ['field'=>'longitude','title'=>__('Longitude'),'sortable'=>false],
                                ['field'=>'latitude','title'=>__('Latitude'),'sortable'=>false],
                                ['field'=>'country.emoji','title'=>__('Flag')],
                                ['field'=>'status','title'=>__('Status'),'sortable'=>true,'escape'=>false,'formatter'=>'statusSwitchFormatter', 'align' => 'center'],
                                ['field'=>'operate','title'=>__('Action'),'sortable'=>false,'escape'=>false,'events'=>'cityEvents'],
                            ]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('data-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'table_list','url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('cities.show',1)),'toolbar-id' => 'filters','toolbar-slot' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($filtersHtml),'click-to-select' => true,'filter-control' => true,'fixed-columns' => true,'show-export' => true,'export-file-name' => 'city-list','table-name' => 'cities','status-column' => 'status','columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
                                ['field'=>'id','title'=>__('ID'),'sortable'=>true],
                                ['field'=>'name','title'=>__('Name'),'sortable'=>true],
                                ['field'=>'country_name','title'=>__('Country Name'),'sortable'=>true,'filterName'=>'country_id','filterControl'=>'select','filterData'=>''],
                                ['field'=>'state_name','title'=>__('State Name'),'sortable'=>true,'filterName'=>'state_id','filterControl'=>'select','filterData'=>''],
                                ['field'=>'longitude','title'=>__('Longitude'),'sortable'=>false],
                                ['field'=>'latitude','title'=>__('Latitude'),'sortable'=>false],
                                ['field'=>'country.emoji','title'=>__('Flag')],
                                ['field'=>'status','title'=>__('Status'),'sortable'=>true,'escape'=>false,'formatter'=>'statusSwitchFormatter', 'align' => 'center'],
                                ['field'=>'operate','title'=>__('Action'),'sortable'=>false,'escape'=>false,'events'=>'cityEvents'],
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
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('city-update')): ?>
                <!-- EDIT MODEL MODEL -->
                    <div id="editModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myModalLabel1"><?php echo e(__('Edit City')); ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="edit-form" class="edit-form" action="" method="POST" enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="country" class="mandatory form-label"><?php echo e(__("Country")); ?></label>
                                                <select name="country_id" id="edit_country" class="form-control country form-select" data-placeholder="<?php echo e(__("Select Country")); ?>">
                                                    <option value="">Select Country</option>
                                                    <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($country->id); ?>"><?php echo e($country->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>

                                            <div class="col-md-6 form-group">
                                                <label for="state" class="mandatory form-label"><?php echo e(__("State")); ?></label>
                                                <select name="state_id" id="edit_state" class="form-control form-select" data-placeholder="<?php echo e(__("Select State")); ?>">
                                                    <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($state->id); ?>"><?php echo e($state->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="form-group col-md-4 col-sm-12">
                                                <label for="name" class="mandatory form-label">City Name</label>
                                                <div class="d-flex mb-2">
                                                    <input type="text" name="name" class="form-control me-2" id="edit_name" placeholder="<?php echo e(__("Enter City name")); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4 col-sm-12">
                                                <label for="latitude" class="mandatory form-label">Latitude</label>
                                                <div class="d-flex mb-2">
                                                    <input type="text" name="latitude" id="edit_latitude" class="form-control me-2" placeholder="<?php echo e(__("Enter Latitude")); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4 col-sm-12">
                                                <label for="longitude" class="mandatory form-label">Longitude</label>
                                                <div class="d-flex mb-2">
                                                    <input type="text" name="longitude" id="edit_longitude" class="form-control me-2" placeholder="<?php echo e(__("Enter Longitude")); ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-12">
                                                <div id="edit_map" style="height: 400px;"></div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
                                            <button type="submit" class="btn btn-primary waves-effect waves-light"><?php echo e(__('Save')); ?></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        $(document).ready(function() {
            // Initialize map with default coordinates
            const map = window.mapUtils.initializeMap('map', 23.245131597411042, 69.66773986816408);

            window.updateAreaCoordinates = function(lat, lng) {
            // Get the last area input group (the one being edited)
            const $areaGroup = $('.city-input-group').last();

            // Update latitude and longitude fields
            $areaGroup.find('input[name="latitude[]"]').val(lat);
            $areaGroup.find('input[name="longitude[]"]').val(lng);
        };
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/places/city.blade.php ENDPATH**/ ?>