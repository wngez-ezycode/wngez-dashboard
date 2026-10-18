<?php $__env->startSection('title'); ?>
    <?php echo e(__('Settings')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php
        // Builds a search index for a settings view by pulling every translatable
        // string (labels, placeholders, tooltips, headings) straight out of the
        // blade source, so search stays accurate without hand-maintained keyword lists.
        $buildKw = function (string $view) {
            if (! view()->exists($view)) {
                return '';
            }

            $path = view()->getFinder()->find($view);
            $locale = app()->getLocale();
            $cacheKey = 'settings_search_kw_' . $locale . '_' . md5($view . '|' . filemtime($path));

            return \Illuminate\Support\Facades\Cache::remember($cacheKey, now()->addDay(), function () use ($path) {
                $source = file_get_contents($path);

                preg_match_all('/__\(\s*([\'"])(.*?)(?<!\\\\)\1\s*\)/s', $source, $matches);

                $words = collect($matches[2] ?? [])
                    ->map(fn ($key) => strtolower(trim(str_replace(['\\\'', '\\"'], ["'", '"'], __($key)))))
                    ->filter()
                    ->unique()
                    ->implode(' ');

                return $words;
            });
        };

        $settingsCards = [
            ['route' => route('settings.system'),                    'title' => __('Settings'),                   'desc' => __('General platform configuration'),        'icon' => 'fas fa-cogs',                     'view' => 'settings.system'],
            ['route' => route('settings.web-settings'),              'title' => __('Web Settings'),               'desc' => __('Website appearance and behaviour'),      'icon' => 'fas fa-cog',                      'view' => 'settings.web-settings'],
            ['route' => route('settings.notification-setting'),      'title' => __('Notification Settings'),      'desc' => __('Push and email notifications'),          'icon' => 'fas fa-bell',                     'view' => 'settings.notification-setting'],
            ['route' => route('settings.reel-settings'),             'title' => __('Video Ads Settings'),         'desc' => __('Reels and video advertisements'),        'icon' => 'fas fa-film',                     'view' => 'settings.reel-settings'],
            ['route' => route('settings.watermark-settings'),        'title' => __('Watermark Settings'),         'desc' => __('Image watermark configuration'),         'icon' => 'fas fa-image',                    'view' => 'settings.watermark-settings'],
            ['route' => route('settings.login-method'),              'title' => __('OTP Provider Settings'),      'desc' => __('Login and OTP providers'),               'icon' => 'fas fa-envelope',                 'view' => 'settings.login-method'],
            ['route' => route('settings.dummy-data.index'),          'title' => __('Dummy Data'),                 'desc' => __('Populate or remove demo data'),          'icon' => 'fas fa-database',                 'view' => 'settings.dummy-data'],
            ['route' => route('settings.admob.index'),               'title' => __('Admob'),                      'desc' => __('Google AdMob configuration'),            'icon' => 'fas fa-ad',                       'view' => 'settings.admob'],
            ['route' => route('settings.adsense.index'),             'title' => __('AdSense'),                    'desc' => __('Google AdSense configuration'),          'icon' => 'fab fa-google',                   'view' => 'settings.adsense'],
            ['route' => route('settings.about-us.index'),            'title' => __('About Us'),                   'desc' => __('About us page content'),                 'icon' => 'fas fa-info-circle',              'view' => 'settings.about-us'],
            ['route' => route('settings.terms-conditions.index'),    'title' => __('Terms & Conditions'),         'desc' => __('Terms and conditions content'),          'icon' => 'fas fa-file-contract',            'view' => 'settings.terms-conditions'],
            ['route' => route('settings.privacy-policy.index'),      'title' => __('Privacy Policy'),             'desc' => __('Privacy policy content'),                'icon' => 'fas fa-shield-alt',               'view' => 'settings.privacy-policy'],
            ['route' => route('settings.refund-policy.index'),       'title' => __('Refund Policy'),              'desc' => __('Refund policy content'),                 'icon' => 'fas fa-file-invoice-dollar',      'view' => 'settings.refund-policy'],
            ['route' => route('settings.contact-us.index'),          'title' => __('Contact Us'),                 'desc' => __('Contact details and page'),              'icon' => 'fas fa-address-book',             'view' => 'settings.contact-us'],
            ['route' => route('settings.firebase.index'),            'title' => __('Firebase Settings'),          'desc' => __('Firebase project credentials'),          'icon' => 'fas fa-cloud',                    'view' => 'settings.firebase'],
            ['route' => route('settings.language.index'),            'title' => __('Languages'),                  'desc' => __('Manage languages and translations'),     'icon' => 'fas fa-language',                 'view' => 'settings.language'],
            ['route' => route('settings.payment-gateway.index'),     'title' => __('Payment Gateways'),           'desc' => __('Configure payment providers'),           'icon' => 'fas fa-credit-card',              'view' => 'settings.payment-gateway'],
            ['route' => route('settings.system-status.index'),       'title' => __('System Status'),              'desc' => __('Health and connectivity checks'),        'icon' => 'fas fa-heartbeat',                'view' => 'settings.system-status'],
            ['route' => route('settings.seo-settings.index'),        'title' => __('Seo-Settings'),               'desc' => __('Search engine optimization'),            'icon' => 'fab fa-searchengin',              'view' => 'settings.seo-setting'],
            ['route' => route('settings.file-manager.index'),        'title' => __('File Manager'),               'desc' => __('Storage and file management'),           'icon' => 'fas fa-folder-open',              'view' => 'settings.file-manager'],
            ['route' => route('settings.email-templates.index'),     'title' => __('Email Templates'),            'desc' => __('Manage email templates'),                'icon' => 'fas fa-envelope-open-text',       'view' => 'settings.email-templates.index'],
            ['route' => route('settings.gemini-settings'),           'title' => __('Gemini AI'),                  'desc' => __('AI content generation settings'),        'icon' => 'fas fa-robot',                    'view' => 'settings.gemini-settings'],
            ['route' => route('settings.default-currency.index'),    'title' => __('Default Currency Settings'),  'desc' => __('Default currency configuration'),        'icon' => 'fas fa-coins',                    'view' => 'settings.default-currency'],
        ];

        if (auth()->check() && auth()->user()->hasRole('Super Admin')) {
            $settingsCards[] = ['route' => route('settings.error-logs.index'), 'title' => __('Log Viewer'), 'desc' => __('Find errors in your system'), 'icon' => 'fas fa-file-alt', 'view' => 'settings.error-logs.index'];
        }

        foreach ($settingsCards as &$card) {
            $card['kw'] = $buildKw($card['view']);
        }
        unset($card);
    ?>

    <section class="section st-settings">
        <header class="st-head">
            <div class="st-head-left">
                <p class="st-eyebrow"><?php echo e(__('WORKSPACE')); ?></p>
                <h1 class="st-title"><?php echo e(__('Settings')); ?></h1>
                <p class="st-sub"><?php echo e(__('Manage how your platform looks, works, and communicates.')); ?></p>
            </div>
            <div class="st-head-right">
                <label class="st-search">
                    <i class="fas fa-search st-search-icon"></i>
                    <input id="stSearch" type="text" placeholder="<?php echo e(__('Search settings')); ?>" autocomplete="off"
                        aria-label="<?php echo e(__('Search settings')); ?>">
                    <kbd class="st-kbd">
                        Enter
                    </kbd>
                </label>
            </div>
        </header>

        <div class="st-area">
            <div class="st-heading">
                <div class="st-heading-left">
                    <h2 id="stTitle" data-all="<?php echo e(__('All settings')); ?>" data-results="<?php echo e(__('Results for')); ?>"><?php echo e(__('All settings')); ?></h2>
                    <p><?php echo e(__('Search to find the setting you need.')); ?></p>
                </div>
                <div class="st-heading-right">
                    <span id="stCount" class="st-count" data-word="<?php echo e(__('settings')); ?>"><?php echo e(count($settingsCards)); ?> <?php echo e(__('settings')); ?></span>
                </div>
            </div>

            <div class="st-cards" id="stSettingsGrid">
                <?php $__currentLoopData = $settingsCards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e($s['route']); ?>" class="st-card"
                        data-search="<?php echo e(strtolower($s['title'] . ' ' . ($s['kw'] ?? ''))); ?>"
                        <?php if(str_contains($s['route'], 'payment-gateway')): ?> data-gateways="stripe razorpay paystack paytabs dpo phonepe flutterwave paypal bank" <?php endif; ?>>
                        <span class="st-icon"><i class="<?php echo e($s['icon']); ?>"></i></span>
                        <h3><?php echo e($s['title']); ?></h3>
                        <p><?php echo e($s['desc']); ?></p>
                        <i class="st-arrow fas fa-arrow-right"></i>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <div class="st-empty d-none" id="stEmpty">
                <h2><?php echo e(__('No matching settings')); ?></h2>
                <p class="text-muted"><?php echo e(__('Try a different keyword.')); ?></p>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/dashboard/resources/views/settings/index.blade.php ENDPATH**/ ?>