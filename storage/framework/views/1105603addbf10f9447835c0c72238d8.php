<?php $__env->startSection('step'); ?>
    <p class="pb-2 text-gray-800">
        Welcome to the installation wizard.
    </p>
    <p class="pb-3 text-gray-800">
        Before getting started, we need some information on the database.
        You will need to know the following items before proceeding.
    </p>
    <div class="px-3 pb-3 text-gray-800">
        <ol class="list-decimal list-inside">
            <li>App url</li>
            <li>Database host</li>
            <li>Database port</li>
            <li>Database name</li>
            <li>Database username</li>
            <li>Database password</li>
        </ol>
    </div>
    <p class="pb-3 text-gray-800">
        Most likely these items were supplied to you by your Web Host.
        If you don’t have this information, then you will need to contact them before you can continue.
    </p>
    <p class="pb-3 text-gray-800">
        Installer will insert this information inside a configuration file so your site can communicate with your database.
    </p>
    <?php if(config('installer.support_url')): ?>
        <p class="pb-4 text-gray-800">
            Need more help?
            <a class="text-blue-500 hover:underline" href="<?php echo e(config('installer.support_url')); ?>" target="_blank">Contact support</a>.
        </p>
    <?php endif; ?>
    <div class="flex justify-end">
        <?php if (isset($component)) { $__componentOriginal95b89d0549cb1bb473641434b9cf3365 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal95b89d0549cb1bb473641434b9cf3365 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'installer::components.link','data' => ['href' => route('install.server')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('installer::link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('install.server'))]); ?>
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
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('installer::install', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/vendor/dacoto/laravel-wizard-installer/resources/views/steps/welcome.blade.php ENDPATH**/ ?>