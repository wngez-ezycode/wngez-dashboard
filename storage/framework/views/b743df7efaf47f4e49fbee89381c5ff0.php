<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header position-relative">
            <div class="d-flex align-items-center justify-content-between">
                <div class="logo">
                    <a href="<?php echo e(url('home')); ?>">
                        <img src="<?php echo e($company_logo ?? ''); ?>"
                            data-custom-image="<?php echo e(url('assets/images/logo/wngez-logo.png')); ?>" alt="WngeZ.com"
                            srcset="">
                    </a>
                </div>
                <a href="#" class="burger-btn burger-toggle sidebar-burger-btn d-block ms-2">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </div>
        </div>

        <div class="sidebar-menu">
            <ul class="menu" id="sidebarMenu">
                <li class="sidebar-item">
                    <a href="<?php echo e(url('home')); ?>" class='sidebar-link'>
                        <i class="ph ph-house"></i>
                        <span class="menu-item"><?php echo e(__('Dashboard')); ?></span>
                    </a>
                </li>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['advertisement-list', 'advertisement-create', 'advertisement-update', 'advertisement-delete',
                    'category-list', 'category-create', 'category-update', 'category-delete', 'custom-field-list',
                    'custom-field-create', 'custom-field-update', 'custom-field-delete', 'feature-section-list',
                    'feature-section-create', 'feature-section-update', 'feature-section-delete', 'slider-list',
                    'slider-create', 'slider-update', 'slider-delete', 'home-screen-section-list',
                    'home-screen-section-update', 'tip-list', 'tip-create', 'tip-update', 'tip-delete', 'banner-ad-list',
                    'banner-ad-create', 'banner-ad-update', 'banner-ad-delete'])): ?>
                    <li class="sidebar-item has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="ph ph-cards"></i>
                            <span class="menu-item"><?php echo e(__('Ads Listing')); ?></span>
                        </a>
                        <ul class="submenu" style="padding-inline-start: 0rem">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['advertisement-list', 'advertisement-create', 'advertisement-update',
                                'advertisement-delete'])): ?>
                                <li class="submenu-item">
                                    <a href="<?php echo e(route('advertisement.index')); ?>"><?php echo e(__('All Ads')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['category-list', 'category-create', 'category-update', 'category-delete'])): ?>
                                <li class="submenu-item">
                                    <a href="<?php echo e(route('category.index')); ?>"><?php echo e(__('Categories')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['custom-field-list', 'custom-field-create', 'custom-field-update',
                                'custom-field-delete'])): ?>
                                <li class="submenu-item">
                                    <a href="<?php echo e(route('custom-fields.index')); ?>"><?php echo e(__('Custom Fields')); ?></a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>


                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['advertisement-list', 'advertisement-create', 'advertisement-update', 'advertisement-delete',
                    'category-list', 'category-create', 'category-update', 'category-delete', 'custom-field-list',
                    'custom-field-create', 'custom-field-update', 'custom-field-delete', 'feature-section-list',
                    'feature-section-create', 'feature-section-update', 'feature-section-delete', 'slider-list',
                    'slider-create', 'slider-update', 'slider-delete', 'home-screen-section-list',
                    'home-screen-section-update', 'tip-list', 'tip-create', 'tip-update', 'tip-delete', 'banner-ad-list',
                    'banner-ad-create', 'banner-ad-update', 'banner-ad-delete'])): ?>
                    <li class="sidebar-item has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="ph ph-layout"></i>
                            <span class="menu-item"><?php echo e(__('Content Management')); ?></span>
                        </a>
                        <ul class="submenu" style="padding-inline-start: 0rem">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['slider-list', 'slider-create', 'slider-update', 'slider-delete'])): ?>
                                <li class="submenu-item">
                                    <a href="<?php echo e(url('slider')); ?>"><?php echo e(__('Slider')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['home-screen-section-list', 'home-screen-section-update'])): ?>
                                <li class="submenu-item">
                                    <a href="<?php echo e(route('home-screen-section.index')); ?>"><?php echo e(__('Home Screen')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['feature-section-list', 'feature-section-create', 'feature-section-update',
                                'feature-section-delete'])): ?>
                                <li class="submenu-item">
                                    <a href="<?php echo e(route('feature-section.index')); ?>"><?php echo e(__('Feature Section')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['tip-list', 'tip-create', 'tip-update', 'tip-delete'])): ?>
                                <li class="submenu-item">
                                    <a href="<?php echo e(route('tips.index')); ?>"><?php echo e(__('Offer Item Tips')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['banner-ad-list', 'banner-ad-create', 'banner-ad-update', 'banner-ad-delete'])): ?>
                                <li class="submenu-item">
                                    <a href="<?php echo e(route('banner-ad.index')); ?>"><?php echo e(__('Banner Ads')); ?></a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['admin-chat-manage', 'chat-template-list', 'chat-template-create', 'chat-template-update',
                    'chat-template-delete'])): ?>
                    <li class="sidebar-item has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="ph ph-chats-circle"></i>
                            <span class="menu-item"><?php echo e(__('Chat Management')); ?></span>
                        </a>
                        <ul class="submenu" style="padding-inline-start: 0rem">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin-chat-manage')): ?>
                                <li class="submenu-item">
                                    <a href="<?php echo e(route('admin-chat.index')); ?>"><?php echo e(__('Chats')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['chat-template-list', 'chat-template-create', 'chat-template-update',
                                'chat-template-delete'])): ?>
                                <li class="submenu-item">
                                    <a href="<?php echo e(route('chat-templates.index')); ?>"><?php echo e(__('Chat Templates')); ?></a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['advertisement-listing-package-list', 'advertisement-listing-package-create',
                    'advertisement-listing-package-update', 'advertisement-listing-package-delete',
                    'featured-advertisement-package-list', 'featured-advertisement-package-create',
                    'featured-advertisement-package-update', 'featured-advertisement-package-delete', 'user-package-list',
                    'payment-transactions-list'])): ?>
                    <li class="sidebar-item has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="ph ph-credit-card"></i>
                            <span class="menu-item"><?php echo e(__('Package Management')); ?></span>
                        </a>
                        <ul class="submenu" style="padding-inline-start: 0rem">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['advertisement-listing-package-list', 'advertisement-listing-package-create',
                                'advertisement-listing-package-update', 'advertisement-listing-package-delete',
                                'featured-advertisement-package-list', 'featured-advertisement-package-create',
                                'featured-advertisement-package-update', 'featured-advertisement-package-delete'])): ?>
                                <li class="submenu-item">
                                    <a href="<?php echo e(route('package.index')); ?>"><?php echo e(__('Subscription Packages')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user-package-list')): ?>
                                <li class="submenu-item">
                                    <a href="<?php echo e(route('package.users.index')); ?>"><?php echo e(__('User Subscriptions')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('payment-transactions-list')): ?>
                                <li class="submenu-item">
                                    <a
                                        href="<?php echo e(route('package.payment-transactions.index')); ?>"><?php echo e(__('Payment Transactions')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('payment-transactions-list')): ?>
                                <li class="submenu-item">
                                    <a href="<?php echo e(route('package.bank-transfer.index')); ?>"><?php echo e(__('Bank Transfer')); ?></a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['seller-verification-field-list', 'seller-verification-field-create',
                    'seller-verification-field-update', 'seller-verification-field-delete',
                    'seller-verification-request-list', 'seller-verification-request-create',
                    'seller-verification-request-update', 'seller-verification-request-delete', 'seller-review-list',
                    'seller-review-update', 'seller-review-delete'])): ?>
                    <li class="sidebar-item has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="ph ph-user-focus"></i>
                            <span class="menu-item"><?php echo e(__('Seller Management')); ?></span>
                        </a>
                        <ul class="submenu" style="padding-inline-start: 0rem">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['seller-verification-field-list', 'seller-verification-field-create',
                                'seller-verification-field-update', 'seller-verification-field-delete'])): ?>
                                <li class="submenu-item">
                                    <a
                                        href="<?php echo e(route('seller-verification.verification-field')); ?>"><?php echo e(__('Verification Fields')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['seller-verification-request-list', 'seller-verification-request-create',
                                'seller-verification-request-update', 'seller-verification-request-delete'])): ?>
                                <li class="submenu-item">
                                    <a href="<?php echo e(route('seller-verification.index')); ?>"><?php echo e(__('Seller Verification')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['seller-review-list', 'seller-review-update', 'seller-review-delete'])): ?>
                                <li class="submenu-item">
                                    <a href="<?php echo e(route('seller-review.index')); ?>"><?php echo e(__('Seller Review')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['seller-review-list', 'seller-review-update', 'seller-review-delete'])): ?>
                                <li class="submenu-item">
                                    <a href="<?php echo e(route('review-report.index')); ?>"><?php echo e(__('Seller Review Report')); ?></a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['blog-list', 'blog-create', 'blog-update', 'blog-delete', 'faq-create', 'faq-list',
                    'faq-update', 'faq-delete'])): ?>
                    <li class="sidebar-item has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="ph ph-article"></i>
                            <span class="menu-item"><?php echo e(__('Forms & Blogs')); ?></span>
                        </a>
                        <ul class="submenu" style="padding-inline-start: 0rem">

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['blog-list', 'blog-create', 'blog-update', 'blog-delete'])): ?>
                                <li class="submenu-item">
                                    <a href="<?php echo e(route('blog.index')); ?>"><?php echo e(__('Blogs')); ?></a>
                                </li>
                                <li class="submenu-item">
                                    <a href="<?php echo e(route('blog-category.index')); ?>"><?php echo e(__('Blog Category')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['faq-create', 'faq-list', 'faq-update', 'faq-delete'])): ?>
                                <li class="submenu-item">
                                    <a href="<?php echo e(route('faq.index')); ?>"><?php echo e(__('FAQs')); ?></a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>


                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['role-list', 'role-create', 'role-update', 'role-delete', 'staff-list', 'staff-create',
                    'staff-update', 'staff-delete', 'customer-list', 'customer-create', 'customer-update',
                    'customer-delete', 'user-queries-list'])): ?>
                    <li class="sidebar-item has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="ph ph-users-three"></i>
                            <span class="menu-item"><?php echo e(__('Customers & Roles')); ?></span>
                        </a>
                        <ul class="submenu" style="padding-inline-start: 0rem">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['customer-list', 'customer-create', 'customer-update', 'customer-delete'])): ?>
                                <li class="submenu-item">
                                    <a href="<?php echo e(url('customer')); ?>"><?php echo e(__('Customers')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['role-list', 'role-create', 'role-update', 'role-delete'])): ?>
                                <li class="submenu-item">
                                    <a href="<?php echo e(route('roles.index')); ?>"><?php echo e(__('Role')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['staff-list', 'staff-create', 'staff-update', 'staff-delete'])): ?>
                                <li class="submenu-item">
                                    <a href="<?php echo e(route('staff.index')); ?>"><?php echo e(__('Staff Management')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['user-queries-list'])): ?>
                                <li class="submenu-item">
                                    <a href="<?php echo e(route('contact-us.index')); ?>"><?php echo e(__('User Queries')); ?></a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['currency-list', 'currency-create', 'currency-update', 'currency-delete', 'country-list',
                    'country-create', 'country-update', 'country-delete', 'state-list', 'state-create', 'state-update',
                    'state-delete', 'city-list', 'city-create', 'city-update', 'city-delete', 'area-create', 'area-list',
                    'area-update', 'area-delete'])): ?>
                    <li class="sidebar-item has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="ph ph-globe-hemisphere-east"></i>
                            <span class="menu-item"><?php echo e(__('Location')); ?></span>
                        </a>
                        <ul class="submenu" style="padding-inline-start: 0rem">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['currency-list', 'currency-create', 'currency-update', 'currency-delete'])): ?>
                                <li class="submenu-item">
                                    <a href="<?php echo e(route('currency.index')); ?>"><?php echo e(__('Currencies')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['country-list', 'country-create', 'country-update', 'country-delete'])): ?>
                                <li class="submenu-item">
                                    <a href="<?php echo e(route('countries.index')); ?>"><?php echo e(__('Countries')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['state-list', 'state-create', 'state-update', 'state-delete'])): ?>
                                <li class="submenu-item">
                                    <a href="<?php echo e(route('states.index')); ?>"><?php echo e(__('States')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['city-list', 'city-create', 'city-update', 'city-delete'])): ?>
                                <li class="submenu-item">
                                    <a href="<?php echo e(route('cities.index')); ?>"><?php echo e(__('Cities')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['area-list', 'area-create', 'area-update', 'area-delete'])): ?>
                                <li class="submenu-item">
                                    <a href="<?php echo e(route('area.index')); ?>"><?php echo e(__('Areas')); ?></a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['report-reason-list', 'report-reason-create', 'report-reason-update', 'report-reason-delete',
                    'user-reports-list'])): ?>
                    <li class="sidebar-item has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="ph ph-flag"></i>
                            <span class="menu-item"><?php echo e(__('Reports')); ?></span>
                        </a>
                        <ul class="submenu" style="padding-inline-start: 0rem">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['report-reason-list', 'report-reason-create', 'report-reason-update',
                                'report-reason-delete'])): ?>
                                <li class="submenu-item">
                                    <a href="<?php echo e(route('report-reasons.index')); ?>"><?php echo e(__('Report Reasons')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['user-reports-list'])): ?>
                                <li class="submenu-item">
                                    <a href="<?php echo e(route('report-reasons.user-reports.index')); ?>"><?php echo e(__('User Reports')); ?></a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['notification-list', 'notification-create', 'notification-update', 'notification-delete'])): ?>
                    <li class="sidebar-item">
                        <a href="<?php echo e(url('notification')); ?>" class='sidebar-link'>
                            <i class="ph ph-bell"></i>
                            <span class="menu-item"><?php echo e(__('Notification')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('settings-update')): ?>
                    <div class="sidebar-new-title"><?php echo e(__('Settings')); ?></div>
                <?php endif; ?>
                
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('settings-update')): ?>
                    <li class="sidebar-item">
                        <a href="<?php echo e(route('settings.index')); ?>" class='sidebar-link'>
                            <i class="ph ph-gear"></i>
                            <span class="menu-item"><?php echo e(__('Settings')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
                
            </ul>
        </div>
    </div>
</div>
<?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/dashboard/resources/views/layouts/sidebar.blade.php ENDPATH**/ ?>