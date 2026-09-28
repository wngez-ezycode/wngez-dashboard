
<header>
    <nav class="navbar navbar-expand navbar-light dashboard-topbar">
        <div class="container-fluid">
            <div class="dashboard-topbar-start d-flex align-items-center">
                <a href="<?php echo e(url('home')); ?>" class="dashboard-brand">
                    <img src="<?php echo e($settings['company_logo'] ?? asset('assets/images/logo/wngez-logo.png')); ?>"
                        data-custom-image="<?php echo e(asset('assets/images/logo/wngez-logo.png')); ?>" alt="WngeZ.com">
                </a>
                <div class="dashboard-topbar-toggle">
                    <a href="#" class="burger-btn burger-toggle topbar-burger-btn d-block">
                        <i class="bi bi-justify fs-3"></i>
                    </a>
                </div>

                <?php if(config('app.demo_mode')): ?>
                    <div class="col-2">
                        <span class="badge alert-info primary-background-color"><?php echo e(__("Demo Mode")); ?></span>
                    </div>
                <?php endif; ?>
            </div>


            <div class="dashboard-topbar-end justify-content-end d-flex">
                <div class="collapse navbar-collapse">

                    <div class="dropdown me-3">
                        <a href="#" class="user-dropdown d-flex align-items-center dropdown-toggle"
                            data-bs-toggle="dropdown">

                            <button class="dropdown-btn">


                                <img src="<?php echo e($currentLanguage?->image); ?>" class="flag">
                                <span><?php echo e(strtoupper($currentLanguage?->code)); ?></span>
                                <span class="arrow">&#9662;</span>
                            </button>
                        </a>
                        
                        
                        <ul class="dropdown-menu dropdown-menu-end">

                            <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <li class="d-flex justify-content-between align-items-center px-2 py-1" data-language-code="<?php echo e($language->code); ?>">

                                    <a class="dropdown-item d-flex align-items-center flex-grow-1"
                                        href="<?php echo e(route('language.set-current', $language->code)); ?>">
                                        <img src="<?php echo e($language->image); ?>" class="flag me-2">
                                        <?php echo e($language->name); ?>

                                    </a>
                                    <form action="<?php echo e(route('settings.set-default-language')); ?>" method="POST"
                                        class="ms-2">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" name="default_language" value="<?php echo e($language->code); ?>">

                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('settings-update')): ?>
                                            <button type="submit" class="btn btn-sm btn-primary py-0 px-2"
                                                <?php if($defaultLanguage && $defaultLanguage->code == $language->code): ?> disabled <?php endif; ?>>
                                                <?php echo e($defaultLanguage && $defaultLanguage->code == $language->code ? __('Default') : __('Set Default')); ?>

                                            </button>
                                        <?php endif; ?>

                                    </form>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </ul>
                    </div>

                    <a href="<?php echo e(url('notification')); ?>" class="topbar-notification" aria-label="<?php echo e(__('Notification')); ?>">
                        <i class="ph ph-bell"></i>
                        <span></span>
                    </a>

                    <span class="topbar-divider"></span>

                    <div class="dropdown">
                        <a href="#" id="profileDropdown"
                            class="user-dropdown d-flex align-items-center dropend dropdown-toggle"
                            data-bs-toggle="dropdown" aria-expanded="false">

                            <div class="avatar avatar-md2 flex-shrink-0">
                                <?php if(!empty(Auth::user()->getRawOriginal('profile'))): ?>
                                    <img
                                        src="<?php echo e(Auth::user()->profile); ?>"
                                        alt="Profile"
                                        class="img-fluid rounded-circle" data-no-auto-error onerror="onErrorUserAvatar(event)" data-name="<?php echo e(Auth::user()->name); ?>">
                                <?php elseif(!empty(Auth::user()->name)): ?>
                                    <?php if (isset($component)) { $__componentOriginalbaf85fa9f435cae78878642caae8517e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbaf85fa9f435cae78878642caae8517e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.avatar-initial','data' => ['name' => Auth::user()->name,'size' => 40]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('avatar-initial'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(Auth::user()->name),'size' => 40]); ?>
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
                                <?php else: ?>
                                    <?php if (isset($component)) { $__componentOriginalbaf85fa9f435cae78878642caae8517e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbaf85fa9f435cae78878642caae8517e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.avatar-initial','data' => ['name' => '','size' => 40]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('avatar-initial'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(''),'size' => 40]); ?>
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
                            </div>

                            <!-- Admin name visible on all screens -->
                            <div class="text ms-2">
                                <h6 class="user-dropdown-name mb-0 text-truncate" style="max-width:120px;">
                                    <?php echo e(Auth::user()->name); ?>

                                </h6>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end topbarUserDropdown"
                            aria-labelledby="topbarUserDropdown">
                            <li><a class="dropdown-item" href="<?php echo e(route('change-password.index')); ?>"><i
                                        class="icon-mid bi bi-gear me-2"></i><?php echo e(__('Change Password')); ?></a></li>
                            <li><a class="dropdown-item" href="<?php echo e(route('change-profile.index')); ?>"><i
                                        class="icon-mid bi bi-person me-2"></i><?php echo e(__('Change Profile')); ?></a></li>
                            <li><a class="dropdown-item" href="<?php echo e(route('logout')); ?> "
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                        class="icon-mid bi bi-box-arrow-left me-2"></i> <?php echo e(__('Logout')); ?></a></li>
                            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                                <?php echo e(csrf_field()); ?>

                            </form>
                        </ul>

                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                            <?php echo csrf_field(); ?>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </nav>
    
</header>
<?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/layouts/topbar.blade.php ENDPATH**/ ?>