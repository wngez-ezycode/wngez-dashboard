<?php $__env->startSection('title'); ?>
    <?php echo e(__('Home Screen Sections')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-title'); ?>
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h4><?php echo $__env->yieldContent('title'); ?></h4>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="section">
        
        <div class="card">
            <div class="card-header">
                <h4><?php echo e(__('Section Visibility')); ?></h4>
            </div>
            <div class="card-body mt-3">
                <div class="row">
                    <?php
                        $sectionLabels = [
                            'all_categories' => __('All Categories'),
                            'slider' => __('Slider'),
                            'popular_categories' => __('Popular Categories'),
                            'featured_section' => __('Featured Section'),
                            'all_ads' => __('All Advertisement')
                        ];
                    ?>
                    <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-3 col-sm-6 mb-3">
                            <div class="card border shadow-sm h-100">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <strong><?php echo e($sectionLabels[$section->section_type] ?? $section->section_type); ?></strong>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('home-screen-section-update')): ?>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input section-toggle" type="checkbox" role="switch"
                                                data-id="<?php echo e($section->id); ?>"
                                                <?php echo e($section->is_active ? 'checked' : ''); ?>>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>

        
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4><?php echo e(__('Popular Categories')); ?></h4>
                <div>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('home-screen-section-update')): ?>
                        <?php if($popularCategories->count() > 1): ?>
                            <a href="<?php echo e(route('home-screen-section.popular-categories.order')); ?>"
                                class="btn btn-sm btn-info">
                                <i class="fas fa-sort"></i> <?php echo e(__('Change Order')); ?>

                            </a>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="card-body">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('home-screen-section-update')): ?>
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="border rounded p-3 bg-light mt-3">
                                <h6 class="mb-1">
                                    <i class="fas fa-plus-circle text-primary me-1"></i>
                                    <?php echo e(__('Add Category')); ?>

                                </h6>
                                <p class="text-muted small mb-3"><?php echo e(__('Search and select a category to add to the popular list')); ?></p>
                                <form id="add-popular-category-form" action="<?php echo e(route('home-screen-section.popular-categories.store')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <div class="d-flex row">
                                        <div class="col-md-6">
                                            <label for="p_category"><?php echo e(__('Category')); ?></label>
                                            <select name="category_id" id="p_category" class="form-control select2 bootstrap-table-filter-control-category" aria-label="category" data-placeholder="<?php echo e(__('All')); ?>">
                                                <option value=""><?php echo e(__('All')); ?></option>
                                                <?php echo $__env->make('category.dropdowntree', ['categories' => $categories], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3 mt-4">
                                            <button type="submit" class="btn btn-primary px-4">
                                                <i class="fas fa-plus me-1"></i> <?php echo e(__('Add')); ?>

                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php
                    $cols = [
                        ['field'=>'sequence','title'=>__('Sequence'),'sortable'=>true],
                        ['field'=>'image','title'=>__('Image'),'escape'=>false],
                        ['field'=>'name','title'=>__('Name')],
                        ['field'=>'type','title'=>__('Type'),'escape'=>false],
                    ];
                    if(auth()->user()->can('home-screen-section-update')) {
                        $cols[] = ['field'=>'action','title'=>__('Action'),'escape'=>false];
                    }
                ?>
                <?php if (isset($component)) { $__componentOriginalc8463834ba515134d5c98b88e1a9dc03 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8463834ba515134d5c98b88e1a9dc03 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.data-table','data' => ['id' => 'popular_categories_table','url' => route('home-screen-section.popular-categories.list'),'sortName' => 'sequence','sortOrder' => 'asc','columns' => $cols]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('data-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'popular_categories_table','url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('home-screen-section.popular-categories.list')),'sort-name' => 'sequence','sort-order' => 'asc','columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($cols)]); ?>
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
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        // Section toggle
        $('.section-toggle').on('change', function() {
            let id = $(this).data('id');
            let isActive = $(this).is(':checked') ? 1 : 0;

            ajaxRequest('POST', '<?php echo e(route("home-screen-section.toggle")); ?>', JSON.stringify({
                id: id,
                is_active: isActive,
                _token: '<?php echo e(csrf_token()); ?>'
            }), null, function(response) {
                showSuccessToast(response.message);
            }, function(response) {
                showErrorToast(response.message);
            });
        });

        // Add popular category form
        $('#add-popular-category-form').on('submit', function(e) {
            e.preventDefault();
            let formElement = $(this);
            let submitButtonElement = $(this).find(':submit');
            let url = $(this).attr('action');
            let data = new FormData(this);

            function successCallback(response) {
                setTimeout(function() {
                    window.location.reload();
                }, 500);
            }

            formAjaxRequest('POST', url, data, formElement, submitButtonElement, successCallback);
        });

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/home_screen_section/index.blade.php ENDPATH**/ ?>