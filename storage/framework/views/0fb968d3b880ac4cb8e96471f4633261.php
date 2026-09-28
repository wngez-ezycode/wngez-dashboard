<?php $__env->startSection('title'); ?>
    <?php echo e(__('Send Notification')); ?>

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
    <div class="row">
        <section class="section">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('notification-create')): ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <form action="<?php echo e(route('notification.store')); ?>" class="create-form needs-validation" method="post" data-parsley-validate enctype="multipart/form-data" data-success-function="successFunction">
                                <div class="card-body">
                                    <textarea id="user_id" name="user_id" style="visibility: hidden;position: absolute;" aria-label="user_id"></textarea>
                                    <div class="form-group row">
                                        <div class="col-md-12 col-sm-12">
                                            <label for="send_to" class="form-label"><?php echo e(__('Select User')); ?></label> <span class="text-danger">*</span>
                                            <select id="send_to" name="send_to" class="form-control w-100" required>
                                                <option value="all"><?php echo e(__('All')); ?></option>
                                                <option value="selected"><?php echo e(__('Selected Only')); ?></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-12 col-sm-12">
                                            <label for="title" class="form-label"><?php echo e(__('Title')); ?> </label> <span class="text-danger">*</span>
                                            <input name="title" id="title" type="text" class="form-control" placeholder=<?php echo e(__('Title')); ?> required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label for="message" class="form-label"><?php echo e(__('Message')); ?></label> <span class="text-danger">*</span>
                                            <textarea id="message" name="message" class="form-control" placeholder=<?php echo e(__('Message')); ?> required></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-check">
                                                <input id="include_image" name="include_image" type="checkbox" class="form-check-input">
                                                <label for="include_image" class="form-check-label"><?php echo e(__('Include Image')); ?></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row" id="show_image" style="display: none">
                                        <div class="col-md-12 col-sm-12">
                                            <label class="form-label"><?php echo e(__('Image')); ?></label>
                                            <input id="file" name="file" type="file" accept="image/*" class="form-control">
                                            <p style="display: none" id="img_error_msg" class="badge rounded-pill bg-danger"></p>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-12 col-sm-12">
                                            <label for="item_id" class="form-label"><?php echo e(__('Advertisement')); ?> </label>
                                            <select name="item_id" class="select2 form-select form-control-sm" data-parsley-minSelect='1' id="item_id">
                                                <option value=""> <?php echo e(__('Select Advertisement')); ?> </option>
                                                <?php $__currentLoopData = $item_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($row->id); ?>" data-parametertypes='<?php echo e($row->name); ?>'><?php echo e($row->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12 d-flex justify-content-end">
                                        <button class="btn btn-primary" type="submit" name="submit"><?php echo e(__('Submit')); ?></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <?php
                                            $userCols = [
                                                ['field'=>'state','title'=>'','checkbox'=>true],
                                                ['field'=>'id','title'=>__('ID'),'sortable'=>true],
                                                ['field'=>'name','title'=>__('Name'),'sortable'=>true],
                                                ['field'=>'mobile','title'=>__('Number'),'sortable'=>true],
                                            ];
                                        ?>
                                        <?php if (isset($component)) { $__componentOriginalc8463834ba515134d5c98b88e1a9dc03 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8463834ba515134d5c98b88e1a9dc03 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.data-table','data' => ['id' => 'user_notification_list','url' => route('customer.show',1),'clickToSelect' => true,'fixedColumns' => true,'extra' => ['data-query-params'=>'notificationUserList'],'columns' => $userCols]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('data-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'user_notification_list','url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('customer.show',1)),'click-to-select' => true,'fixed-columns' => true,'extra' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['data-query-params'=>'notificationUserList']),'columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($userCols)]); ?>
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
            <?php endif; ?>

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div id="toolbar">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('notification-delete')): ?>
                                    <a href="<?php echo e(route('notification.batch.delete')); ?>" class="btn btn-danger btn-sm btn-icon text-white" id="delete_multiple" title="Delete Notification"><em class='fa fa-trash'></em></a>
                                <?php endif; ?>
                            </div>
                            <?php
                                $notifCols = [];
                                if(auth()->user()->can('notification-delete')) {
                                    $notifCols[] = ['field'=>'state','title'=>'','checkbox'=>true];
                                }
                                $notifCols[] = ['field'=>'id','title'=>__('ID'),'sortable'=>true];
                                $notifCols[] = ['field'=>'title','title'=>__('Title'),'sortable'=>true];
                                $notifCols[] = ['field'=>'message','title'=>__('Message'),'sortable'=>true];
                                $notifCols[] = ['field'=>'image','title'=>__('Image'),'formatter'=>'imageFormatter'];
                                $notifCols[] = ['field'=>'send_to','title'=>__('Send To'),'sortable'=>true];
                                if(auth()->user()->can('notification-delete')) {
                                    $notifCols[] = ['field'=>'operate','title'=>__('Action'),'escape'=>false];
                                }
                            ?>
                            <?php if (isset($component)) { $__componentOriginalc8463834ba515134d5c98b88e1a9dc03 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8463834ba515134d5c98b88e1a9dc03 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.data-table','data' => ['id' => 'table_list','url' => route('notification.show',1),'toolbarId' => 'toolbar','clickToSelect' => true,'fixedColumns' => true,'showExport' => true,'exportFileName' => 'notification-list','columns' => $notifCols]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('data-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'table_list','url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('notification.show',1)),'toolbar-id' => 'toolbar','click-to-select' => true,'fixed-columns' => true,'show-export' => true,'export-file-name' => 'notification-list','columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($notifCols)]); ?>
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
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script type="text/javascript">
        function successFunction(response) {
            setTimeout(function () {
                window.location.reload();
            }, 1500);
        }
        // function responseHandler(res) {
        //     $.each(res.rows, function (i, row) {
        //         row.state = $.inArray(row.id, selections) !== -1
        //     })
        //     return res;
        // }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/notification/index.blade.php ENDPATH**/ ?>