<?php $__env->startSection('step'); ?>
    <?php if($errors->any()): ?>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="bg-red-100 border-l-4 border-red-500 p-4 mb-3">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm leading-5 text-red-700">
                            <?php echo $error; ?>

                        </p>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php else: ?>
        <div class="bg-green-100 border-l-4 border-green-500 p-4 mb-3">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm leading-5 text-green-700">
                        Database connection successful
                    </p>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <p class="pb-3 text-gray-800">The installation of the database and the loading of all the basic data of the application will be carried out.</p>
    <p class="pb-3 text-gray-800">This may take a while, please wait and don't close the page.</p>
    <form method="post" action="<?php echo e(route('install.migrations')); ?>">
        <?php echo csrf_field(); ?>
        <div class="flex justify-end">
            <?php if($errors->any()): ?>
                <?php if (isset($component)) { $__componentOriginal4d1145e91513a9944e2cd16a315f69e8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4d1145e91513a9944e2cd16a315f69e8 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'installer::components.button','data' => ['type' => 'submit','color' => 'red']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('installer::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'submit','color' => 'red']); ?>
                    Try again
                    <svg class="fill-current w-5 h-5 ml-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4d1145e91513a9944e2cd16a315f69e8)): ?>
<?php $attributes = $__attributesOriginal4d1145e91513a9944e2cd16a315f69e8; ?>
<?php unset($__attributesOriginal4d1145e91513a9944e2cd16a315f69e8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4d1145e91513a9944e2cd16a315f69e8)): ?>
<?php $component = $__componentOriginal4d1145e91513a9944e2cd16a315f69e8; ?>
<?php unset($__componentOriginal4d1145e91513a9944e2cd16a315f69e8); ?>
<?php endif; ?>
            <?php else: ?>
                <?php if (isset($component)) { $__componentOriginal4d1145e91513a9944e2cd16a315f69e8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4d1145e91513a9944e2cd16a315f69e8 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'installer::components.button','data' => ['type' => 'submit']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('installer::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'submit']); ?>
                    Next step
                    <svg class="fill-current w-5 h-5 ml-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4d1145e91513a9944e2cd16a315f69e8)): ?>
<?php $attributes = $__attributesOriginal4d1145e91513a9944e2cd16a315f69e8; ?>
<?php unset($__attributesOriginal4d1145e91513a9944e2cd16a315f69e8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4d1145e91513a9944e2cd16a315f69e8)): ?>
<?php $component = $__componentOriginal4d1145e91513a9944e2cd16a315f69e8; ?>
<?php unset($__componentOriginal4d1145e91513a9944e2cd16a315f69e8); ?>
<?php endif; ?>
            <?php endif; ?>
        </div>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('installer::install', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/vendor/dacoto/laravel-wizard-installer/resources/views/steps/migrations.blade.php ENDPATH**/ ?>