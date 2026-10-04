<?php
    $currentLocale = app()->getLocale();
    $currentLang = Session::get('language') ?? \App\Models\Language::where('code', $currentLocale)->first();
    $isRtl = ($currentLang && $currentLang->rtl) || $currentLocale === 'ar' || Session::get('is_rtl', false);
?>
<!DOCTYPE html>
<html lang="<?php echo e($currentLocale); ?>" <?php if($isRtl): ?> dir="rtl" class="rtl" <?php endif; ?>>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo e($favicon ?? url('assets/images/logo/wngez-icon.png')); ?>" type="image/png">
    <title><?php echo $__env->yieldContent('title'); ?> || <?php echo e(config('app.name')); ?></title>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
    <?php echo $__env->make('layouts.include', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->yieldContent('css'); ?>
</head>

<body>
    <div id="app">
        <?php echo $__env->make('layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <div id="main" class='layout-navbar'>
            <?php echo $__env->make('layouts.topbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <div id="main-content">
                <?php if(!request()->is('home')): ?>
                    <section class="wngez-page-hero" aria-label="<?php echo e(__('Page header')); ?>">
                        <div class="wngez-breadcrumb">
                            <a href="<?php echo e(url('home')); ?>"><i class="ph ph-house"></i> <?php echo e(__('Dashboard')); ?></a>
                            <i class="ph ph-caret-right"></i>
                            <span><?php echo $__env->yieldContent('title'); ?></span>
                        </div>
                        <h1><?php echo $__env->yieldContent('title'); ?></h1>
                        <p><?php echo e(__('Manage and organize your marketplace data with ease.')); ?></p>
                    </section>
                <?php endif; ?>
                <div class="page-heading">
                    <?php echo $__env->yieldContent('page-title'); ?>
                </div>
                <?php echo $__env->yieldContent('content'); ?>
            </div>
            <div class="dashboard-footer-wrap">
                <div class="content">
                    <?php echo $__env->make('layouts.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>
            </div>
        </div>
    </div>
    <?php echo $__env->make('layouts.footer_script', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('layouts.web-setup-popup', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->yieldContent('js'); ?>
    <?php echo $__env->yieldContent('script'); ?>

    <?php if(config('app.demo_mode')): ?>
        <!-- Floating Buy Now Button -->
        <div id="buyNowFloatBtn" class="buy-now-float-btn">
            <a href="https://wngez.com"
                target="_blank" class="buy-now-btn-content" rel="noopener noreferrer">
                <div class="buy-now-icon-wrapper">
                    <i class="fas fa-shopping-bag"></i>
                </div>
                <div class="buy-now-text-wrapper">
                    <span class="buy-now-btn-title"><?php echo e(__('Buy Now')); ?></span>
                    <span class="buy-now-btn-desc"><?php echo e(__('Like what you see? Get the full version')); ?></span>
                </div>
            </a>
            <div id="buyNowToggle" class="buy-now-btn-action">
                <i class="fas fa-chevron-right"></i>
            </div>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const btn = document.getElementById('buyNowFloatBtn');
                const toggle = document.getElementById('buyNowToggle');
                if (btn && toggle) {
                    // Read stored state
                    const isCollapsed = localStorage.getItem('buy_now_collapsed') === 'true';
                    if (isCollapsed) {
                        btn.classList.add('buy-now-collapsed');
                    }

                    toggle.addEventListener('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        const collapsed = btn.classList.toggle('buy-now-collapsed');
                        localStorage.setItem('buy_now_collapsed', collapsed ? 'true' : 'false');
                    });
                }
            });
        </script>
    <?php endif; ?>
</body>

</html>
<?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/layouts/main.blade.php ENDPATH**/ ?>