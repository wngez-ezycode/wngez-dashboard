<?php $__env->startSection('step'); ?>
    <p class="pb-3 text-gray-800">Verifying write and read permissions on folders</p>

    <div class="flex flex-wrap border border-gray-200 rounded-md mb-4 divide-y divider-gray-200">
        <?php $__currentLoopData = config('installer.folders'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $check): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="w-full px-4 py-2 text-gray-800">
                <?php echo e(base_path()); ?><?php echo e(str_replace('/', DIRECTORY_SEPARATOR, $check['name'])); ?>

                <div class="float-right">
                    <?php if(@File::chmod($check['check']['value']) < 755): ?>
                        <?php if (isset($component)) { $__componentOriginal17e85cd88ec3ade1991816a73c2156e6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal17e85cd88ec3ade1991816a73c2156e6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'installer::components.error-check-icon','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('installer::error-check-icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal17e85cd88ec3ade1991816a73c2156e6)): ?>
<?php $attributes = $__attributesOriginal17e85cd88ec3ade1991816a73c2156e6; ?>
<?php unset($__attributesOriginal17e85cd88ec3ade1991816a73c2156e6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal17e85cd88ec3ade1991816a73c2156e6)): ?>
<?php $component = $__componentOriginal17e85cd88ec3ade1991816a73c2156e6; ?>
<?php unset($__componentOriginal17e85cd88ec3ade1991816a73c2156e6); ?>
<?php endif; ?>
                    <?php else: ?>
                        <?php if (isset($component)) { $__componentOriginalefde6754c127adf5ed096365a72a0d4d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalefde6754c127adf5ed096365a72a0d4d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'installer::components.success-check-icon','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('installer::success-check-icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalefde6754c127adf5ed096365a72a0d4d)): ?>
<?php $attributes = $__attributesOriginalefde6754c127adf5ed096365a72a0d4d; ?>
<?php unset($__attributesOriginalefde6754c127adf5ed096365a72a0d4d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalefde6754c127adf5ed096365a72a0d4d)): ?>
<?php $component = $__componentOriginalefde6754c127adf5ed096365a72a0d4d; ?>
<?php unset($__componentOriginalefde6754c127adf5ed096365a72a0d4d); ?>
<?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="flex justify-end">
        <?php if($result): ?>
            <?php if (isset($component)) { $__componentOriginal95b89d0549cb1bb473641434b9cf3365 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal95b89d0549cb1bb473641434b9cf3365 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'installer::components.link','data' => ['href' => route('install.database')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('installer::link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('install.database'))]); ?>
                Next step
                <svg class="fill-current w-5 h-5 ml-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal95b89d0549cb1bb473641434b9cf3365)): ?>
<?php $attributes = $__attributesOriginal95b89d0549cb1bb473641434b9cf3365; ?>
<?php unset($__attributesOriginal95b89d0549cb1bb473641434b9cf3365); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal95b89d0549cb1bb473641434b9cf3365)): ?>
<?php $component = $__componentOriginal95b89d0549cb1bb473641434b9cf3365; ?>
<?php unset($__componentOriginal95b89d0549cb1bb473641434b9cf3365); ?>
<?php endif; ?>
        <?php else: ?>
            <?php if (isset($component)) { $__componentOriginal95b89d0549cb1bb473641434b9cf3365 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal95b89d0549cb1bb473641434b9cf3365 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'installer::components.link','data' => ['href' => route('install.server'),'color' => 'red']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('installer::link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('install.server')),'color' => 'red']); ?>
                Reload
                <svg class="fill-current w-5 h-5 ml-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path
                        fill-rule="evenodd"
                        d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z"
                        clip-rule="evenodd"
                    />
                </svg>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal95b89d0549cb1bb473641434b9cf3365)): ?>
<?php $attributes = $__attributesOriginal95b89d0549cb1bb473641434b9cf3365; ?>
<?php unset($__attributesOriginal95b89d0549cb1bb473641434b9cf3365); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal95b89d0549cb1bb473641434b9cf3365)): ?>
<?php $component = $__componentOriginal95b89d0549cb1bb473641434b9cf3365; ?>
<?php unset($__componentOriginal95b89d0549cb1bb473641434b9cf3365); ?>
<?php endif; ?>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('installer::install', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/vendor/dacoto/laravel-wizard-installer/resources/views/steps/folders.blade.php ENDPATH**/ ?>