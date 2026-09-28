<?php $__env->startSection('title'); ?>
    <?php echo e(__('Banner Ads')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-title'); ?>
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h4><?php echo $__env->yieldContent('title'); ?></h4>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('banner-ad-create')): ?>
                    <a href="<?php echo e(route('banner-ad.create')); ?>" class="btn btn-primary float-end">
                        <?php echo e(__('Create Banner Ad')); ?>

                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div id="bannerAdFilters">
                    <div class="row g-2 align-items-end mb-3">
                        <div class="col-lg-3 col-md-6">
                            <label for="filter_platform"><?php echo e(__('Platform')); ?></label>
                            <select id="filter_platform" class="form-control">
                                <option value=""><?php echo e(__('All')); ?></option>
                                <option value="web"><?php echo e(__('Web')); ?></option>
                                <option value="app"><?php echo e(__('App')); ?></option>
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <label for="filter_page"><?php echo e(__('Page')); ?></label>
                            <select id="filter_page" class="form-control">
                                <option value=""><?php echo e(__('All')); ?></option>
                                <option value="home"><?php echo e(__('Homepage')); ?></option>
                                <option value="detail"><?php echo e(__('Ads Details Page')); ?></option>
                                <option value="listing"><?php echo e(__('Listing Page')); ?></option>
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <label for="filter_layout"><?php echo e(__('Layout')); ?></label>
                            <select id="filter_layout" class="form-control">
                                <option value=""><?php echo e(__('All')); ?></option>
                                <option value="single"><?php echo e(__('Single')); ?></option>
                                <option value="dual"><?php echo e(__('Dual')); ?></option>
                                <option value="single_side"><?php echo e(__('Single Side')); ?></option>
                                <option value="dual_side"><?php echo e(__('Dual Side')); ?></option>
                                <option value="large"><?php echo e(__('Large')); ?></option>
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <label for="filter_ad_type"><?php echo e(__('Ad Type')); ?></label>
                            <select id="filter_ad_type" class="form-control">
                                <option value=""><?php echo e(__('All')); ?></option>
                                <option value="only_banner"><?php echo e(__('Only Banner')); ?></option>
                                <option value="category"><?php echo e(__('Category')); ?></option>
                                <option value="advertisement"><?php echo e(__('Advertisement')); ?></option>
                                <option value="external_link"><?php echo e(__('External Link')); ?></option>
                            </select>
                        </div>
                    </div>
                </div>
                <?php
                    $cols = [
                        ['field' => 'id', 'title' => __('ID'), 'visible' => false],
                        ['field' => 'images', 'title' => __('Banner Image'), 'escape' => false, 'formatter' => 'bannerImagesFormatter'],
                        ['field' => 'platform', 'title' => __('Platform')],
                        ['field' => 'page', 'title' => __('Page')],
                        ['field' => 'layout', 'title' => __('Layout')],
                        ['field' => 'ad_type', 'title' => __('Ad Type')],
                    ];
                    if (auth()->user()->canany(['banner-ad-update', 'banner-ad-delete'])) {
                        $cols[] = ['field' => 'action', 'title' => __('Action'), 'escape' => false];
                    }
                ?>
                <?php if (isset($component)) { $__componentOriginalc8463834ba515134d5c98b88e1a9dc03 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8463834ba515134d5c98b88e1a9dc03 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.data-table','data' => ['id' => 'table_list','url' => route('banner-ad.show', 'list'),'sortName' => 'id','sortOrder' => 'desc','extra' => ['data-query-params' => 'bannerAdQueryParams'],'columns' => $cols]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('data-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'table_list','url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('banner-ad.show', 'list')),'sort-name' => 'id','sort-order' => 'desc','extra' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['data-query-params' => 'bannerAdQueryParams']),'columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($cols)]); ?>
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

<?php $__env->startSection('script'); ?>
    <script>
        $(function () {
            $('#filter_platform, #filter_page, #filter_layout, #filter_ad_type').on('change', function () {
                $('#table_list').bootstrapTable('refresh');
            });
        });

        function bannerAdQueryParams(params) {
            params.platform = $('#filter_platform').val() || '';
            params.page_filter = $('#filter_page').val() || '';
            params.layout = $('#filter_layout').val() || '';
            params.ad_type = $('#filter_ad_type').val() || '';
            return params;
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/banner-ad/index.blade.php ENDPATH**/ ?>