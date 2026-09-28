<?php $__env->startSection('step'); ?>
    <p class="pb-3 text-gray-800">
        Below you should enter your database connection details. If you're not sure about these, contact your hosting provider.
    </p>
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
    <?php endif; ?>
    <form method="post" action="<?php echo e(route('install.database')); ?>">
        <?php echo csrf_field(); ?>
        <div class="mb-3">
            <?php if (isset($component)) { $__componentOriginal5451f1cefd11b08f3edc20a5984e2e5a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5451f1cefd11b08f3edc20a5984e2e5a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'installer::components.label','data' => ['for' => 'database_hostname','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('installer::label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'database_hostname','required' => true]); ?>Database host <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5451f1cefd11b08f3edc20a5984e2e5a)): ?>
<?php $attributes = $__attributesOriginal5451f1cefd11b08f3edc20a5984e2e5a; ?>
<?php unset($__attributesOriginal5451f1cefd11b08f3edc20a5984e2e5a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5451f1cefd11b08f3edc20a5984e2e5a)): ?>
<?php $component = $__componentOriginal5451f1cefd11b08f3edc20a5984e2e5a; ?>
<?php unset($__componentOriginal5451f1cefd11b08f3edc20a5984e2e5a); ?>
<?php endif; ?>
            <?php if (isset($component)) { $__componentOriginalc9356edcd26cae015b78102b3a75923a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc9356edcd26cae015b78102b3a75923a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'installer::components.input','data' => ['id' => 'database_hostname','name' => 'database_hostname','value' => ''.e(old('database_hostname', config('database.connections.mysql.host'))).'','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('installer::input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'database_hostname','name' => 'database_hostname','value' => ''.e(old('database_hostname', config('database.connections.mysql.host'))).'','required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc9356edcd26cae015b78102b3a75923a)): ?>
<?php $attributes = $__attributesOriginalc9356edcd26cae015b78102b3a75923a; ?>
<?php unset($__attributesOriginalc9356edcd26cae015b78102b3a75923a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc9356edcd26cae015b78102b3a75923a)): ?>
<?php $component = $__componentOriginalc9356edcd26cae015b78102b3a75923a; ?>
<?php unset($__componentOriginalc9356edcd26cae015b78102b3a75923a); ?>
<?php endif; ?>
        </div>
        <div class="mb-3">
            <?php if (isset($component)) { $__componentOriginal5451f1cefd11b08f3edc20a5984e2e5a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5451f1cefd11b08f3edc20a5984e2e5a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'installer::components.label','data' => ['for' => 'database_port','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('installer::label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'database_port','required' => true]); ?>Database port <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5451f1cefd11b08f3edc20a5984e2e5a)): ?>
<?php $attributes = $__attributesOriginal5451f1cefd11b08f3edc20a5984e2e5a; ?>
<?php unset($__attributesOriginal5451f1cefd11b08f3edc20a5984e2e5a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5451f1cefd11b08f3edc20a5984e2e5a)): ?>
<?php $component = $__componentOriginal5451f1cefd11b08f3edc20a5984e2e5a; ?>
<?php unset($__componentOriginal5451f1cefd11b08f3edc20a5984e2e5a); ?>
<?php endif; ?>
            <?php if (isset($component)) { $__componentOriginalc9356edcd26cae015b78102b3a75923a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc9356edcd26cae015b78102b3a75923a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'installer::components.input','data' => ['id' => 'database_port','name' => 'database_port','value' => ''.e(old('database_port', config('database.connections.mysql.port'))).'','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('installer::input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'database_port','name' => 'database_port','value' => ''.e(old('database_port', config('database.connections.mysql.port'))).'','required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc9356edcd26cae015b78102b3a75923a)): ?>
<?php $attributes = $__attributesOriginalc9356edcd26cae015b78102b3a75923a; ?>
<?php unset($__attributesOriginalc9356edcd26cae015b78102b3a75923a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc9356edcd26cae015b78102b3a75923a)): ?>
<?php $component = $__componentOriginalc9356edcd26cae015b78102b3a75923a; ?>
<?php unset($__componentOriginalc9356edcd26cae015b78102b3a75923a); ?>
<?php endif; ?>
        </div>
        <div class="mb-3">
            <?php if (isset($component)) { $__componentOriginal5451f1cefd11b08f3edc20a5984e2e5a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5451f1cefd11b08f3edc20a5984e2e5a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'installer::components.label','data' => ['for' => 'database_name','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('installer::label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'database_name','required' => true]); ?>Database name <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5451f1cefd11b08f3edc20a5984e2e5a)): ?>
<?php $attributes = $__attributesOriginal5451f1cefd11b08f3edc20a5984e2e5a; ?>
<?php unset($__attributesOriginal5451f1cefd11b08f3edc20a5984e2e5a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5451f1cefd11b08f3edc20a5984e2e5a)): ?>
<?php $component = $__componentOriginal5451f1cefd11b08f3edc20a5984e2e5a; ?>
<?php unset($__componentOriginal5451f1cefd11b08f3edc20a5984e2e5a); ?>
<?php endif; ?>
            <?php if (isset($component)) { $__componentOriginalc9356edcd26cae015b78102b3a75923a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc9356edcd26cae015b78102b3a75923a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'installer::components.input','data' => ['id' => 'database_name','name' => 'database_name','value' => ''.e(old('database_name', config('database.connections.mysql.database', 'laravel'))).'','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('installer::input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'database_name','name' => 'database_name','value' => ''.e(old('database_name', config('database.connections.mysql.database', 'laravel'))).'','required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc9356edcd26cae015b78102b3a75923a)): ?>
<?php $attributes = $__attributesOriginalc9356edcd26cae015b78102b3a75923a; ?>
<?php unset($__attributesOriginalc9356edcd26cae015b78102b3a75923a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc9356edcd26cae015b78102b3a75923a)): ?>
<?php $component = $__componentOriginalc9356edcd26cae015b78102b3a75923a; ?>
<?php unset($__componentOriginalc9356edcd26cae015b78102b3a75923a); ?>
<?php endif; ?>
        </div>
        <div class="mb-3">
            <?php if (isset($component)) { $__componentOriginal5451f1cefd11b08f3edc20a5984e2e5a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5451f1cefd11b08f3edc20a5984e2e5a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'installer::components.label','data' => ['for' => 'database_username','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('installer::label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'database_username','required' => true]); ?>Database user <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5451f1cefd11b08f3edc20a5984e2e5a)): ?>
<?php $attributes = $__attributesOriginal5451f1cefd11b08f3edc20a5984e2e5a; ?>
<?php unset($__attributesOriginal5451f1cefd11b08f3edc20a5984e2e5a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5451f1cefd11b08f3edc20a5984e2e5a)): ?>
<?php $component = $__componentOriginal5451f1cefd11b08f3edc20a5984e2e5a; ?>
<?php unset($__componentOriginal5451f1cefd11b08f3edc20a5984e2e5a); ?>
<?php endif; ?>
            <?php if (isset($component)) { $__componentOriginalc9356edcd26cae015b78102b3a75923a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc9356edcd26cae015b78102b3a75923a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'installer::components.input','data' => ['id' => 'database_username','name' => 'database_username','value' => ''.e(old('database_username', config('database.connections.mysql.username', 'root'))).'','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('installer::input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'database_username','name' => 'database_username','value' => ''.e(old('database_username', config('database.connections.mysql.username', 'root'))).'','required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc9356edcd26cae015b78102b3a75923a)): ?>
<?php $attributes = $__attributesOriginalc9356edcd26cae015b78102b3a75923a; ?>
<?php unset($__attributesOriginalc9356edcd26cae015b78102b3a75923a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc9356edcd26cae015b78102b3a75923a)): ?>
<?php $component = $__componentOriginalc9356edcd26cae015b78102b3a75923a; ?>
<?php unset($__componentOriginalc9356edcd26cae015b78102b3a75923a); ?>
<?php endif; ?>
        </div>
        <div class="mb-3">
            <?php if (isset($component)) { $__componentOriginal5451f1cefd11b08f3edc20a5984e2e5a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5451f1cefd11b08f3edc20a5984e2e5a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'installer::components.label','data' => ['for' => 'database_password']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('installer::label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'database_password']); ?>Database password <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5451f1cefd11b08f3edc20a5984e2e5a)): ?>
<?php $attributes = $__attributesOriginal5451f1cefd11b08f3edc20a5984e2e5a; ?>
<?php unset($__attributesOriginal5451f1cefd11b08f3edc20a5984e2e5a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5451f1cefd11b08f3edc20a5984e2e5a)): ?>
<?php $component = $__componentOriginal5451f1cefd11b08f3edc20a5984e2e5a; ?>
<?php unset($__componentOriginal5451f1cefd11b08f3edc20a5984e2e5a); ?>
<?php endif; ?>
            <?php if (isset($component)) { $__componentOriginalc9356edcd26cae015b78102b3a75923a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc9356edcd26cae015b78102b3a75923a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'installer::components.input','data' => ['id' => 'database_password','name' => 'database_password','type' => 'password','value' => ''.e(old('database_password')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('installer::input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'database_password','name' => 'database_password','type' => 'password','value' => ''.e(old('database_password')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc9356edcd26cae015b78102b3a75923a)): ?>
<?php $attributes = $__attributesOriginalc9356edcd26cae015b78102b3a75923a; ?>
<?php unset($__attributesOriginalc9356edcd26cae015b78102b3a75923a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc9356edcd26cae015b78102b3a75923a)): ?>
<?php $component = $__componentOriginalc9356edcd26cae015b78102b3a75923a; ?>
<?php unset($__componentOriginalc9356edcd26cae015b78102b3a75923a); ?>
<?php endif; ?>
        </div>
        <div class="mb-3">
            <?php if (isset($component)) { $__componentOriginal5451f1cefd11b08f3edc20a5984e2e5a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5451f1cefd11b08f3edc20a5984e2e5a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'installer::components.label','data' => ['for' => 'database_prefix']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('installer::label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'database_prefix']); ?>Database prefix <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5451f1cefd11b08f3edc20a5984e2e5a)): ?>
<?php $attributes = $__attributesOriginal5451f1cefd11b08f3edc20a5984e2e5a; ?>
<?php unset($__attributesOriginal5451f1cefd11b08f3edc20a5984e2e5a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5451f1cefd11b08f3edc20a5984e2e5a)): ?>
<?php $component = $__componentOriginal5451f1cefd11b08f3edc20a5984e2e5a; ?>
<?php unset($__componentOriginal5451f1cefd11b08f3edc20a5984e2e5a); ?>
<?php endif; ?>
            <?php if (isset($component)) { $__componentOriginalc9356edcd26cae015b78102b3a75923a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc9356edcd26cae015b78102b3a75923a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'installer::components.input','data' => ['id' => 'database_prefix','name' => 'database_prefix','value' => ''.e(old('database_prefix')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('installer::input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'database_prefix','name' => 'database_prefix','value' => ''.e(old('database_prefix')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc9356edcd26cae015b78102b3a75923a)): ?>
<?php $attributes = $__attributesOriginalc9356edcd26cae015b78102b3a75923a; ?>
<?php unset($__attributesOriginalc9356edcd26cae015b78102b3a75923a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc9356edcd26cae015b78102b3a75923a)): ?>
<?php $component = $__componentOriginalc9356edcd26cae015b78102b3a75923a; ?>
<?php unset($__componentOriginalc9356edcd26cae015b78102b3a75923a); ?>
<?php endif; ?>
        </div>
        <div class="flex justify-end">
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
        </div>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('installer::install', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/vendor/dacoto/laravel-wizard-installer/resources/views/steps/database.blade.php ENDPATH**/ ?>