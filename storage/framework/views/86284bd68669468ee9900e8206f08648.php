<?php $__env->startSection('title'); ?>
    <?php echo e(__("Blogs")); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-title'); ?>
    <div class="page-title">
        <div class="row align-items-center">
            <div class="col-12 col-md-6">
                <h4 class="mb-0"><?php echo $__env->yieldContent('title'); ?></h4>
            </div>
            <div class="col-12 col-md-6 d-flex justify-content-end">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('blog-create')): ?>
                    <a class="btn btn-primary" href="<?php echo e(route('blog.create')); ?>">+ <?php echo e(__("Add blog")); ?> </a>
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
                        <div id="filters row">
                            <div class="row">
                                <div class="col-lg-4">
                                    <label for="filter_category_id"><?php echo e(__("Category")); ?></label>
                                    <select id="filter_category_id" class="form-control select-search" data-placeholder="<?php echo e(__('All')); ?>">
                                        <option value=""><?php echo e(__("All")); ?></option>
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <?php
                            $cols = [
                                ['field'=>'id','title'=>__('ID'),'align'=>'center','sortable'=>true],
                                ['field'=>'title','title'=>__('Title'),'align'=>'center','sortable'=>true],
                                ['field'=>'category.name','title'=>__('Category'),'align'=>'center','sortable'=>true],
                                ['field'=>'slug','title'=>__('Slug'),'align'=>'center','sortable'=>true],
                                ['field'=>'description','title'=>__('Description'),'align'=>'center','escape'=>false,'formatter'=>'truncateDescription'],
                                ['field'=>'image','title'=>__('Image'),'align'=>'center','formatter'=>'imageFormatter'],
                                ['field'=>'tags','title'=>__('Tags'),'align'=>'center'],
                                ['field'=>'views','title'=>__('Views'),'align'=>'center', 'sortable' => true],
                                ['field'=>'useful_count','title'=>__('Useful'),'align'=>'center','sortable'=>true],
                                ['field'=>'not_useful_count','title'=>__('Not Useful'),'align'=>'center','sortable'=>true],
                                ['field'=>'useful_percentage','title'=>__('Useful %'),'align'=>'center','sortable'=>false,'formatter'=>'usefulPercentageFormatter', 'visible' => false],
                                ['field'=>'created_at','title'=>__('Date'),'align'=>'center'],
                            ];
                            if(auth()->user()->canany(['blog-update','blog-delete'])) {
                                $cols[] = ['field'=>'operate','title'=>__('Action'),'escape'=>false];
                            }
                        ?>
                        <?php if (isset($component)) { $__componentOriginalc8463834ba515134d5c98b88e1a9dc03 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8463834ba515134d5c98b88e1a9dc03 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.data-table','data' => ['id' => 'table_list','url' => route('blog.show', 0),'toolbarId' => 'filters','clickToSelect' => true,'tableName' => 'blogs','class' => 'translatable-table','extra' => ['data-search-align'=>'right','data-query-params'=>'blogQueryParams','data-use-row-attr-func'=>'true'],'columns' => $cols]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('data-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'table_list','url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('blog.show', 0)),'toolbar-id' => 'filters','click-to-select' => true,'table-name' => 'blogs','class' => 'translatable-table','extra' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['data-search-align'=>'right','data-query-params'=>'blogQueryParams','data-use-row-attr-func'=>'true']),'columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($cols)]); ?>
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

<?php $__env->startSection('script'); ?>
<script>
    function blogQueryParams(p) {
        return {
            ...p,
            category_id: $('#filter_category_id').val()
        };
    }

    function usefulPercentageFormatter(value, row) {
        return value + '%';
    }

    $('#filter_category_id').on('change', function() {
        $('#table_list').bootstrapTable('refresh');
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/blog/index.blade.php ENDPATH**/ ?>