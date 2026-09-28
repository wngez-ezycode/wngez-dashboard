<?php $__env->startSection('title'); ?>
    <?php echo e(__("Staff Management")); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-header">
        <h3 class="page-title">
            <?php echo e(__('Staff Management')); ?>

        </h3>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role-create')): ?>
            <div class="buttons">
                <a class="btn btn-primary" href="<?php echo e(route('staff.create')); ?>"> <?php echo e(__('Create New Staff')); ?></a>
            </div>
        <?php endif; ?>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">

                <div class="row">
                    <div class="col-12">
                        <?php
                            $cols = [
                                ['field'=>'id','title'=>__('ID'),'sortable'=>true,'align'=>'center'],
                                ['field'=>'name','title'=>__('Name'),'sortable'=>true,'align'=>'center'],
                                ['field'=>'email','title'=>__('Email'),'sortable'=>true,'align'=>'center'],
                            ];
                            if(auth()->user()->can('staff-update')) {
                                $cols[] = ['field'=>'status','title'=>__('Status'),'formatter'=>'statusSwitchFormatter','sortable'=>false,'align'=>'center'];
                            }
                            if(auth()->user()->canany(['staff-update','staff-delete'])) {
                                $cols[] = ['field'=>'operate','title'=>__('Action'),'escape'=>false,'sortable'=>false,'events'=>'staffEvents','align'=>'center'];
                            }
                        ?>
                        <?php if (isset($component)) { $__componentOriginalc8463834ba515134d5c98b88e1a9dc03 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8463834ba515134d5c98b88e1a9dc03 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.data-table','data' => ['id' => 'table_list','url' => route('staff.show',1),'clickToSelect' => true,'fixedColumns' => true,'tableName' => 'users','statusColumn' => 'deleted_at','showExport' => true,'exportFileName' => 'staff-list','extra' => ['data-query-params'=>'queryParams'],'columns' => $cols]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('data-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'table_list','url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('staff.show',1)),'click-to-select' => true,'fixed-columns' => true,'table-name' => 'users','status-column' => 'deleted_at','show-export' => true,'export-file-name' => 'staff-list','extra' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['data-query-params'=>'queryParams']),'columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($cols)]); ?>
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

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('staff-update')): ?>
        <!-- EDIT USER MODEL MODEL -->
        <div id="editModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel1"><?php echo e(__("Edit Staff")); ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form class="form-horizontal edit-form" method="POST" data-parsley-validate>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="form-group mandatory">
                                        <label for="edit_role" class="form-label col-12 "><?php echo e(__("Role")); ?></label>
                                        <select name="role_id" id="edit_role" class="form-control" data-parsley-required="true">
                                            <option value="">--<?php echo e(__("Select Role")); ?>--</option>
                                            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($role->id); ?>"><?php echo e($role->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12 col-12">
                                    <div class="form-group mandatory">
                                        <label for="edit_name" class="form-label text-center"><?php echo e(__("Name")); ?></label>
                                        <input type="text" id="edit_name" class="form-control col-12" placeholder="Name" name="name" data-parsley-required="true">
                                    </div>
                                </div>

                                <div class="col-md-12 col-12">
                                    <div class="form-group mandatory">
                                        <label for="edit_email" class="form-label text-center"><?php echo e(__("Email")); ?></label>
                                        <input type="email" id="edit_email" class="form-control col-12" placeholder="email" name="email" data-parsley-required="true">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal"><?php echo e(__("Close")); ?></button>
                            <button type="submit" class="btn btn-primary waves-effect waves-light"><?php echo e(__("Save")); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- RESET PASSWORD MODEL -->
        <div id="resetPasswordModel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel1"><?php echo e(__("Password Reset")); ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form class="form-horizontal edit-form" data-parsley-validate role="form" method="post">
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group mandatory">
                                    <label for="new_password" class="form-label"><?php echo e(__("New Password")); ?></label>
                                    <input type="password" class="form-control" name="new_password" id="new_password" placeholder="<?php echo e(__("New Password")); ?>" data-parsley-minlength="8" data-parsley-uppercase="1" data-parsley-lowercase="1" data-parsley-number="1" data-parsley-special="1" data-parsley-required="true">
                                </div>
                                <div class="form-group mandatory">
                                    <label for="confirm_password" class="form-label"><?php echo e(__("Confirm Password")); ?></label>
                                    <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="<?php echo e(__("Confirm Password")); ?>" data-parsley-equalto="#new_password" minlength="4" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal"><?php echo e(__("Close")); ?></button>
                            <button type="submit" class="btn btn-primary waves-effect waves-light"><?php echo e(__("Save")); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/staff/index.blade.php ENDPATH**/ ?>