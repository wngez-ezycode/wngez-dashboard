<?php $__env->startSection('title'); ?>
    <?php echo e(__('Chat Template')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-title'); ?>
    <div class="page-title">
        <div class="row d-flex align-items-center">
            <div class="col-12 col-md-6">
                <h4 class="mb-0"><?php echo $__env->yieldContent('title'); ?></h4>
                <p class="text-muted mb-0"><?php echo e(__('Manage and Create Pre-Defined Chat Templates')); ?></p>
            </div>
            <div class="col-12 col-md-6 text-end mt-2 mt-md-0">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('chat-template-create')): ?>
                    <a href="<?php echo e(route('chat-templates.create')); ?>" class="btn btn-primary mb-0">
                        <span class="d-none d-sm-inline">+ <?php echo e(__('Create Chat Template')); ?></span>
                        <span class="d-sm-none">+ <?php echo e(__('Create')); ?></span>
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
                <div class="row">
                    <div class="col-12">
                        <div id="filters">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <label for="filter"><?php echo e(__('Category')); ?></label>
                                    <select name="category" class="form-control select2 bootstrap-table-filter-control-category_id" aria-label="category">
                                        <option value=""><?php echo e(__('All')); ?></option>
                                        <?php echo $__env->make('category.dropdowntree', ['categories' => $categories], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <?php
                            $ctCols = [
                                ['field' => 'id', 'title' => __('ID'), 'align' => 'center', 'sortable' => true, 'visible' => false],
                                ['field' => 'name', 'title' => __('Name'), 'sortable' => true, 'escape' => true],
                                ['field' => 'category_names', 'title' => __('Categories'), 'formatter' => 'chatTemplateCategoryFormatter', 'escape' => false, 'filterName' => 'category_id', 'filterControl' => 'select', 'filterData' => ''],
                                ['field' => 'customer_questions_count', 'title' => __('Matrices and Timeline'), 'formatter' => 'chatTemplateMetricsFormatter', 'escape' => false],
                                ['field' => 'status', 'title' => __('Activity'), 'align' => 'center', 'sortable' => true, 'formatter' => 'statusSwitchFormatter', 'escape' => false],
                            ];
                            if (auth()->user()->canany(['chat-template-update', 'chat-template-delete'])) {
                                $ctCols[] = ['field' => 'operate', 'title' => __('Action'), 'align' => 'center', 'escape' => false, 'sortable' => false];
                            }
                        ?>
                        <?php if (isset($component)) { $__componentOriginalc8463834ba515134d5c98b88e1a9dc03 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8463834ba515134d5c98b88e1a9dc03 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.data-table','data' => ['id' => 'table_list','url' => route('chat-templates.show', 1),'toolbarId' => 'filters','filterControl' => true,'fixedColumns' => true,'showExport' => true,'exportFileName' => 'chat-template-list','tableName' => 'chat_templates','extra' => ['data-search-align' => 'right'],'columns' => $ctCols]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('data-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'table_list','url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('chat-templates.show', 1)),'toolbar-id' => 'filters','filter-control' => true,'fixed-columns' => true,'show-export' => true,'export-file-name' => 'chat-template-list','table-name' => 'chat_templates','extra' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['data-search-align' => 'right']),'columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($ctCols)]); ?>
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

<?php $__env->startSection('js'); ?>
    <script>
        function chatTemplateCategoryFormatter(value, row) {
            if (!Array.isArray(value) || value.length === 0) {
                return '-';
            }
            var cls = row.is_global ? 'ct-pill ct-pill-success' : 'ct-pill';
            return value.map(function (name) {
                return '<span class="' + cls + '">' + $('<div>').text(name).html() + '</span>';
            }).join(' ');
        }

        function chatTemplateMetricsFormatter(value, row) {
            return '<span class="ct-metrics">' + row.customer_questions_count + ' ' + '<?php echo e(__('Messages')); ?>' +
                '<span class="ct-dot"></span>' + row.seller_questions_count + ' ' + '<?php echo e(__('Replies')); ?>' + '</span>';
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/chat-templates/index.blade.php ENDPATH**/ ?>