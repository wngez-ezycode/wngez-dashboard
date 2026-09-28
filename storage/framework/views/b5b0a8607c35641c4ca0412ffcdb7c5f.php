<?php $__env->startSection('title'); ?>
    <?php echo e(__("FAQ")); ?>

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
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('faq-create')): ?>
            <div class="row">
                <form class="create-form" action="<?php echo e(route('faq.store')); ?>" method="POST" data-parsley-validate enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header"><?php echo e(__("Add FAQ")); ?></div>

                            <div class="card-body mt-3">
                                    <ul class="nav nav-tabs" role="tablist">
                                                    <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link <?php if($index === 0): ?> active <?php endif; ?>" data-bs-toggle="tab"
                                                                    data-bs-target="#lang-<?php echo e($language->id); ?>" type="button" role="tab">
                                                                <?php echo e($language->name); ?>

                                                            </button>
                                                        </li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>

                                                <div class="tab-content mt-3">
                                                    <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="tab-pane fade <?php if($index === 0): ?> show active <?php endif; ?>"
                                                            id="lang-<?php echo e($language->id); ?>" role="tabpanel">
                                                            <div class="form-group">
                                                                <label><?php echo e(__('Question')); ?> (<?php echo e($language->name); ?>) <span class="text-danger">*</span></label>
                                                                <input type="text" name="question[<?php echo e($language->id); ?>]" class="form-control"
                                                                    <?php echo e($language->code === 'en' ? 'required' : ''); ?>>
                                                            </div>
                                                            <div class="form-group mt-2">
                                                                <label><?php echo e(__('Answer')); ?> (<?php echo e($language->name); ?>) <span class="text-danger">*</span></label>
                                                                <textarea name="answer[<?php echo e($language->id); ?>]" class="form-control" rows="4"
                                                                        <?php echo e($language->code === 'en' ? 'required' : ''); ?>></textarea>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                    <div class="col-md-12 m-2 text-end">
                                        <input type="submit" class="btn btn-primary" value="<?php echo e(__("Create")); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <?php
                                    $cols = [
                                        ['field'=>'id','title'=>__('ID'),'sortable'=>true],
                                        ['field'=>'question','title'=>__('Questions'),'sortable'=>false],
                                        ['field'=>'answer','title'=>__('Answers'),'sortable'=>false,'formatter'=>'descriptionFormatter'],
                                        ['field'=>'operate','title'=>__('Action'),'sortable'=>false,'escape'=>false,'events'=>'faqEvents'],
                                    ];
                                ?>
                                <?php if (isset($component)) { $__componentOriginalc8463834ba515134d5c98b88e1a9dc03 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8463834ba515134d5c98b88e1a9dc03 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.data-table','data' => ['id' => 'table_list','url' => route('faq.show',1),'clickToSelect' => true,'fixedColumns' => true,'extra' => ['data-query-params'=>'queryParams'],'columns' => $cols]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('data-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'table_list','url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('faq.show',1)),'click-to-select' => true,'fixed-columns' => true,'extra' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['data-query-params'=>'queryParams']),'columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($cols)]); ?>
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
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('faq-update')): ?>
        <!-- EDIT MODEL MODEL -->
            <div id="editModal" class="modal fade modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="" class="form-horizontal edit-form" enctype="multipart/form-data" method="POST" novalidate>
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>
                                <input type="hidden" name="faq_id" id="edit_faq_id">

                                <div class="modal-header">
                                    <h5 class="modal-title"><?php echo e(__('Edit FAQ')); ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    
                                    <ul class="nav nav-tabs" role="tablist">
                                        <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link <?php if($index === 0): ?> active <?php endif; ?>" data-bs-toggle="tab"
                                                        data-bs-target="#edit-lang-<?php echo e($language->id); ?>" type="button" role="tab">
                                                    <?php echo e($language->name); ?>

                                                </button>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>

                                    
                                    <div class="tab-content mt-3">
                                        <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="tab-pane fade <?php if($index === 0): ?> show active <?php endif; ?>"
                                                id="edit-lang-<?php echo e($language->id); ?>" role="tabpanel">
                                                <div class="form-group">
                                                    <label><?php echo e(__('Question')); ?> (<?php echo e($language->name); ?>)</label>
                                                    <input type="text"
                                                        name="question[<?php echo e($language->id); ?>]"
                                                        id="edit_question_<?php echo e($language->id); ?>"
                                                        class="form-control"
                                                        <?php echo e($language->code === 'en' ? 'required' : ''); ?>>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <label><?php echo e(__('Answer')); ?> (<?php echo e($language->name); ?>)</label>
                                                    <textarea name="answer[<?php echo e($language->id); ?>]"
                                                            id="edit_answer_<?php echo e($language->id); ?>"
                                                            class="form-control"
                                                            rows="4"
                                                            <?php echo e($language->code === 'en' ? 'required' : ''); ?>></textarea>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

        <?php endif; ?>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/faq/create.blade.php ENDPATH**/ ?>