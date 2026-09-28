<?php $__env->startSection('title'); ?>
    <?php echo e(__('Slider')); ?>

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
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('slider-create')): ?>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <form method="POST" action="<?php echo e(route('slider.store')); ?>" enctype="multipart/form-data" class="create-form" id="slider-form" data-pre-submit-function="customValidation">
                                <?php echo csrf_field(); ?>
                                <div class="row mt-1">
                                    <div class="form-group col-md-12 col-sm-12 mandatory">
                                        <label for="image" class="col-md-12 col-sm-12 col-12 form-label"><?php echo e(__('Image')); ?></label>
                                        <input type="file" name="image" id="image" class="form-control" accept=".jpg,.jpeg,.png" data-parsley-required="true">
                                        <?php if(count($errors) > 0): ?>
                                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="alert alert-danger error-msg"><?php echo e($error); ?></div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </div>

                                    <label for="items" class="col-md-12 col-sm-12 col-form-label"><?php echo e(__('Item')); ?></label>
                                    <div class="col-md-12 col-sm-12">
                                        <select name="item" class="form-select form-control-sm select2" id="items" aria-label="items" data-parsley-errors-messages-disabled>
                                            <?php if(isset($items)): ?>
                                                <option value="" selected><?php echo e(__("Select Advertisement")); ?></option>
                                                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($row->id); ?>"><?php echo e($row->name); ?> </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                    <div class="col-12 d-flex justify-content-center align-items-center mt-3">
                                        <h6 class="mb-0"><?php echo e(__("OR")); ?></h6>

                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-12 form-group">
                                            <label for="category" class="form-label"><?php echo e(__('Category')); ?></label>
                                            <select name="category_id" id="category" class="form-select form-control select2" data-placeholder="<?php echo e(__("Select Category")); ?>">
                                                <option value=""><?php echo e(__("Select a Category")); ?></option>
                                                <?php echo $__env->make('category.dropdowntree', ['categories' => $categories], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-center align-items-center mt-3">
                                        <h6 class="mb-0"><?php echo e(__("OR")); ?></h6>

                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <label for="link" class="col-md-12 col-sm-12 col-form-label "><?php echo e(__('Third Party Link')); ?></label>
                                        <input type="text" name="link" id="link" value="<?php echo e(old('link', '')); ?>" class="form-control " placeholder="<?php echo e(__('link')); ?>" data-parsley-errors-messages-disabled>
                                    </div>
        
                                    <div class="col-md-12 form-group mt-3">
                                        
                                            <label for="country" class="mandatory form-label"><?php echo e(__('Country')); ?></label>
                                            <select class="form-control select2" id="country" name="country_id" >
                                                <option value=""><?php echo e(__('--Select Country--')); ?></option>
                                                <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($country->id); ?>"><?php echo e($country->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                       
                                    </div>
                                    <div class="col-md-12 form-group mt-3">
                                            <label for="state" class="mandatory form-label"><?php echo e(__('State')); ?></label>
                                            <select class="form-control select2" id="state" name="state_id" >
                                                <option value=""><?php echo e(__('--Select State--')); ?></option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 form-group mt-3">
                                            <label for="city" class="mandatory form-label"><?php echo e(__('City')); ?></label>
                                            <select class="form-control select2" id="city" name="city_id" >
                                                <option value=""><?php echo e(__('--Select City--')); ?></option>
                                        </select>
                                    </div>
                                    <div class="invalid-form-error-message"></div>
                                    <div class="col-12 d-flex justify-content-end mt-2" style="padding: 1% 2%;">
                                        <button type="submit" class="btn btn-primary me-1 mb-1"><?php echo e(__('Save')); ?></button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>


            <div class="<?php echo e(\Illuminate\Support\Facades\Auth::user()->can('slider-create') ? "col-md-8" : "col-md-12"); ?>">
                <div class="card">
                    <div class="card-content">
                        <div class="row mt-1">
                            <div class="card-body">
                                <div class="form-group row ">
                                    <div class="col-12">
                                        <?php
                                            $cols = [
                                                ['field'=>'id','title'=>__('ID'),'align'=>'center','sortable'=>true],
                                                ['field'=>'image','title'=>__('Image'),'align'=>'center','sortable'=>false,'formatter'=>'imageFormatter'],
                                                ['field'=>'model_type','title'=>__('Type'),'align'=>'center','sortable'=>true,'formatter'=>'typeFormatter'],
                                                ['field'=>'model.name','title'=>__('Name'),'align'=>'center','sortable'=>true,'attrs'=>['data-sort-name'=>'model_name']],
                                                ['field'=>'country.name','title'=>__('Country'),'align'=>'center','sortable'=>true,'attrs'=>['data-sort-name'=>'country_name']],
                                                ['field'=>'state.name','title'=>__('State'),'align'=>'center','sortable'=>true,'attrs'=>['data-sort-name'=>'state_name']],
                                                ['field'=>'city.name','title'=>__('City'),'align'=>'center','sortable'=>true,'attrs'=>['data-sort-name'=>'city_name']],
                                                ['field'=>'third_party_link','title'=>__('Third Party Link'),'align'=>'center','sortable'=>true],
                                            ];
                                            if(auth()->user()->can('slider-delete')) {
                                                $cols[] = ['field'=>'operate','title'=>__('Action'),'escape'=>false,'align'=>'center','sortable'=>false];
                                            }
                                        ?>
                                        <?php if (isset($component)) { $__componentOriginalc8463834ba515134d5c98b88e1a9dc03 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8463834ba515134d5c98b88e1a9dc03 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.data-table','data' => ['id' => 'table_list','url' => route('slider.show',1),'clickToSelect' => true,'fixedColumns' => true,'showExport' => true,'exportFileName' => 'slider-list','extra' => ['data-query-params'=>'queryParams','data-id-field'=>'id'],'columns' => $cols]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('data-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'table_list','url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('slider.show',1)),'click-to-select' => true,'fixed-columns' => true,'show-export' => true,'export-file-name' => 'slider-list','extra' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['data-query-params'=>'queryParams','data-id-field'=>'id']),'columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($cols)]); ?>
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
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/slider/index.blade.php ENDPATH**/ ?>