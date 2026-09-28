<?php $__env->startSection('title'); ?>
    <?php echo e(__("Seller Verification")); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-title'); ?>
    <div class="page-title">
        <div class="row d-flex align-items-center">
            <div class="col-12 col-md-6">
                <h4 class="mb-0"><?php echo $__env->yieldContent('title'); ?></h4>
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
                        <?php
                            $cols = [
                                ['field'=>'id','title'=>__('ID'),'align'=>'center','sortable'=>true],
                                ['field'=>'user_name','title'=>__('User'),'align'=>'center','sortable'=>true,'formatter' => 'userProfileFormatter'],
                                ['field'=>'status','title'=>__('Status'),'align'=>'center','sortable'=>true,'filterControl'=>'select','formatter'=>'sellerverificationStatusFormatter'],
                            ];
                            if(auth()->user()->canany(['seller-verification-request-update'])) {
                                $cols[] = ['field'=>'operate','title'=>__('Action'),'align'=>'center','sortable'=>false,'escape'=>false,'events'=>'verificationEvents'];
                            }
                        ?>
                        <?php if (isset($component)) { $__componentOriginalc8463834ba515134d5c98b88e1a9dc03 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8463834ba515134d5c98b88e1a9dc03 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.data-table','data' => ['id' => 'table_list','url' => route('verification_requests.show'),'clickToSelect' => true,'fixedColumns' => true,'filterControl' => true,'toolbarId' => 'filters','showExport' => true,'exportFileName' => 'verification_requests-list','extra' => ['data-search-align'=>'right'],'columns' => $cols]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('data-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'table_list','url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('verification_requests.show')),'click-to-select' => true,'fixed-columns' => true,'filter-control' => true,'toolbar-id' => 'filters','show-export' => true,'export-file-name' => 'verification_requests-list','extra' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['data-search-align'=>'right']),'columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($cols)]); ?>
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
        <div id="editStatusModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel1"><?php echo e(__('Status')); ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="edit-form" action="" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <select name="status" class="form-select" id="verification_status" aria-label="status">
                                        <option value="pending"><?php echo e(__("Pending")); ?></option>
                                        <option value="approved"><?php echo e(__("Approved")); ?></option>
                                        <option value="rejected"><?php echo e(__("Rejected")); ?></option>
                                    </select>
                                </div>
                                <div class="form-group " id="rejectionReasonField" style="display: none;">
                                    <label for="rejection_reason"><?php echo e(__("Rejection Reason")); ?> </label><span class="text-danger">*</span>
                                    <textarea id="rejection_reason" name="rejection_reason" class="form-control"></textarea>
                                </div>
                            </div>
                            <input type="submit" value="<?php echo e(__("Save")); ?>" class="btn btn-primary mt-3">
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <div id="editModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel1"><?php echo e(__('Verification Details')); ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="center" id="verification_fields"></div>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>

    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/seller-verification/index.blade.php ENDPATH**/ ?>