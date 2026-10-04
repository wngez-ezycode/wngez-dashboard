<?php
    $currentLocale = app()->getLocale();
    $currentLang = Session::get('language') ?? \App\Models\Language::where('code', $currentLocale)->first();
    $isRtl = ($currentLang && $currentLang->rtl) || $currentLocale === 'ar' || Session::get('is_rtl', false);
?>

<?php if(!$isRtl): ?>
    
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/main/app.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/pages/otherpages.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/custom.css')); ?>" />
    <link rel="stylesheet"
        href="<?php echo e(asset('assets/css/wngez-dashboard.css')); ?>?v=<?php echo e(filemtime(public_path('assets/css/wngez-dashboard.css'))); ?>" />
<?php else: ?>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/main/rtl.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/pages/otherpages_rtl.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/custom.css')); ?>" />
    <link rel="stylesheet"
        href="<?php echo e(asset('assets/css/wngez-dashboard.css')); ?>?v=<?php echo e(filemtime(public_path('assets/css/wngez-dashboard.css'))); ?>" />
    <style>
        body,
        html,
        .sidebar-wrapper,
        .navbar,
        .btn,
        .form-control,
        .form-select,
        table,
        .modal,
        .card,
        .dropdown-menu {
            font-family: 'Cairo', system-ui, -apple-system, sans-serif !important;
        }
    </style>
<?php endif; ?>

<link rel="stylesheet" href="<?php echo e(asset('assets/css/bootstrap-switch-button.min.css')); ?>">


<link rel="stylesheet" href="<?php echo e(asset('assets/libs/phosphor-icons/regular/style.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/libs/phosphor-icons/bold/style.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/libs/phosphor-icons/fill/style.css')); ?>">
<link rel="stylesheet" href="https://unpkg.com/@phosphor-icons/web@2.1.1/src/regular/style.css">
<link rel="stylesheet" href="https://unpkg.com/@phosphor-icons/web@2.1.1/src/bold/style.css">
<link rel="stylesheet" href="https://unpkg.com/@phosphor-icons/web@2.1.1/src/fill/style.css">


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


<?php
    use App\Services\CachingService;
    $adminColorDB = CachingService::getSystemSettings('admin_primary_color');
    $adminPrimaryColor = !empty($adminColorDB) ? $adminColorDB : '#0878F9';

    // Convert hex to RGB for rgba usage
    $hex = str_replace('#', '', $adminPrimaryColor);
    $r = hexdec(substr($hex, 0, 2));
    $g = hexdec(substr($hex, 2, 2));
    $b = hexdec(substr($hex, 4, 2));
    $rgba = "$r, $g, $b, 0.15";
?>


<style>
    :root {
        --bs-primary: <?php echo e($adminPrimaryColor); ?> !important;
        --bs-primary-rgb: <?php echo e($r); ?>, <?php echo e($g); ?>, <?php echo e($b); ?> !important;
        --bs-primary-rgba: <?php echo e($rgba); ?> !important;
        --bs-blue: <?php echo e($adminPrimaryColor); ?> !important;
        --wngez-navy: #073A78;
        --wngez-blue: #0878D1;
        --wngez-orange: #FF6500;
        --wngez-orange-rgb: 255, 101, 0;
    }
</style>


<link rel="stylesheet" href="<?php echo e(asset('assets/extensions/toastify-js/toastify.css')); ?>">


<link rel="stylesheet" href="<?php echo e(asset('assets/extensions/bootstrap-table/bootstrap-table.min.css')); ?>"
    type="text/css" />
<link rel="stylesheet"
    href="<?php echo e(asset('assets/extensions/bootstrap-table/fixed-columns/bootstrap-table-fixed-columns.min.css')); ?>"
    type="text/css" />
<link rel="stylesheet" href="<?php echo e(asset('assets/extensions/bootstrap-table/bootstrap-table-reorder-rows.css')); ?>">



<link rel="stylesheet" href="<?php echo e(asset('assets/extensions/@fortawesome/fontawesome-free/css/all.min.css')); ?>"
    type="text/css" />


<link rel="stylesheet" href="<?php echo e(asset('assets/extensions/magnific-popup/magnific-popup.css')); ?>">


<link rel="stylesheet" href="<?php echo e(asset('assets/extensions/select2/select2.min.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('assets/extensions/select2/select2-bootstrap-5-theme.min.css')); ?>" />


<link rel="stylesheet" href="<?php echo e(asset('assets/extensions/tagify/tagify.css')); ?>" type="text/css" />


<link rel="stylesheet" href="<?php echo e(asset('assets/extensions/sweetalert2/sweetalert2.min.css')); ?>" />


<link rel="stylesheet" href="<?php echo e(asset('assets/extensions/filepond/filepond.min.css')); ?>" type="text/css" />
<link rel="stylesheet" href="<?php echo e(asset('assets/extensions/filepond/filepond-plugin-image-preview.min.css')); ?>"
    type="text/css" />
<link rel="stylesheet" href="<?php echo e(asset('assets/extensions/filepond/filepond-plugin-pdf-preview.min.css')); ?>"
    type="text/css" />


<link rel="stylesheet" href="<?php echo e(asset('assets/css/pages/jquery-jvectormap-2.0.5.css')); ?>" type="text/css" />


<link rel="stylesheet" href="<?php echo e(asset('assets/extensions/jstree/jstree.min.css')); ?>" />




<link rel="stylesheet" href="<?php echo e(asset('assets/css/leaflet.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/css/map.css')); ?>">
<?php echo $__env->yieldContent('css'); ?>

<script>
    // Function to handle image errors
    function handleImageError(image) {
        image.classList.contains('custom-default-image')
        if (image.getAttribute('data-custom-image') != null) {
            image.src = image.getAttribute('data-custom-image');
        } else if ("<?php echo e($favicon); ?>") {
            image.src = "<?php echo e($favicon); ?>";
        } else {
            image.src = "<?php echo e(asset('/assets/images/no_image_available.png')); ?>";
        }
        // console.log('Image failed to load: ' + image.src);
    }

    // Create a MutationObserver to watch for DOM changes
    const observer = new MutationObserver((mutationsList) => {
        mutationsList.forEach((mutation) => {
            if (mutation.addedNodes) {
                mutation.addedNodes.forEach((node) => {
                    // Check if the added node is an image element
                    if (node instanceof HTMLImageElement && !node.hasAttribute(
                            'data-no-auto-error')) {
                        node.addEventListener('error', () => {
                            handleImageError(node);
                        });
                    }
                });
            }
        });
    });

    // Start observing changes in the DOM
    observer.observe(document, {
        childList: true,
        subtree: true
    });

    window.defaultProfileImage = "<?php echo e(asset('assets/images/default-profile-icon.svg')); ?>";

    const onErrorImage = (e) => {
        e.target.src = "<?php echo e($favicon); ?>";
    };

    const onErrorImageSidebarHorizontalLogo = (e) => {
        e.target.src = "<?php echo e($company_logo); ?>";
    };
</script>
<?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/layouts/include.blade.php ENDPATH**/ ?>