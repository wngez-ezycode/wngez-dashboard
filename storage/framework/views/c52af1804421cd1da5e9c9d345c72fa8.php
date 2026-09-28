<?php $__env->startSection('title'); ?>
    <?php echo e(__('Change Profile')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <div class="divider">
                    <h4><?php echo e(__('Change Profile')); ?></h4>
                </div>
            </div>

            <form method="POST" action="<?php echo e(route('change-profile.update')); ?>" class="create-form-without-reset" enctype="multipart/form-data" data-success-function="successFunction">
            <div class="row mt-1">
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label text-alert text-center"><?php echo e(__('Profile')); ?></label>
                        <div class="col-sm-4 cs_field_img ">
                            <input type="file" name="profile" class="image" style="display: none" accept=" .jpg, .jpeg, .png, .svg">
                            <?php if(!empty(Auth::user()->getRawOriginal('profile'))): ?>
                                <img src="<?php echo e(Auth::user()->profile); ?>" alt="" class="img preview-image">
                            <?php elseif(!empty(Auth::user()->name)): ?>
                                <div id="initial-avatar-wrapper">
                                    <?php if (isset($component)) { $__componentOriginalbaf85fa9f435cae78878642caae8517e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbaf85fa9f435cae78878642caae8517e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.avatar-initial','data' => ['name' => Auth::user()->name,'size' => 100]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('avatar-initial'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(Auth::user()->name),'size' => 100]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalbaf85fa9f435cae78878642caae8517e)): ?>
<?php $attributes = $__attributesOriginalbaf85fa9f435cae78878642caae8517e; ?>
<?php unset($__attributesOriginalbaf85fa9f435cae78878642caae8517e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalbaf85fa9f435cae78878642caae8517e)): ?>
<?php $component = $__componentOriginalbaf85fa9f435cae78878642caae8517e; ?>
<?php unset($__componentOriginalbaf85fa9f435cae78878642caae8517e); ?>
<?php endif; ?>
                                </div>
                                <img src="" alt="" class="img preview-image" style="display: none;">
                            <?php else: ?>
                                <?php if (isset($component)) { $__componentOriginalbaf85fa9f435cae78878642caae8517e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbaf85fa9f435cae78878642caae8517e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.avatar-initial','data' => ['name' => '','size' => 100]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('avatar-initial'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(''),'size' => 100]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalbaf85fa9f435cae78878642caae8517e)): ?>
<?php $attributes = $__attributesOriginalbaf85fa9f435cae78878642caae8517e; ?>
<?php unset($__attributesOriginalbaf85fa9f435cae78878642caae8517e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalbaf85fa9f435cae78878642caae8517e)): ?>
<?php $component = $__componentOriginalbaf85fa9f435cae78878642caae8517e; ?>
<?php unset($__componentOriginalbaf85fa9f435cae78878642caae8517e); ?>
<?php endif; ?>
                            <?php endif; ?>
                            <div class='img_input'><?php echo e(__("Browse File")); ?></div>
                        </div>
                        <div class="img_error" style="color:#DC3545;"></div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-4 col-form-label text-alert text-center"><?php echo e(__('Name')); ?></label>
                        <div class="col-sm-4">
                            <input type="text" name="name" id="name" class="form-control form-control-lg form-control-solid mb-2" placeholder=<?php echo e(__('Name')); ?> value="<?php echo e(Auth::user()->name); ?>" required/>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="<?php echo e(__('email')); ?>" class="col-sm-4 col-form-label text-alert text-center"><?php echo e(__('Email')); ?></label>
                        <div class="col-sm-4">
                            <input type="email" name="<?php echo e(__('email')); ?>" id="<?php echo e(__('email')); ?>" class="form-control form-control-lg form-control-solid mb-2" placeholder="<?php echo e(__("Email")); ?>" value="<?php echo e(Auth::user()->email); ?>" required/>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label text-alert">&nbsp;</label>
                        <div class="col-sm-12 text-end">
                            <button type="submit" name="btnadd" value="btnadd" class="btn btn-primary float-right"><?php echo e(__('Change')); ?></button>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        let successFunction = () => {
            window.location.reload()
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/change_profile/index.blade.php ENDPATH**/ ?>