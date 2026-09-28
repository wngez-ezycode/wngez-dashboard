<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Open in App</title>
    <?php echo $__env->make('layouts.include', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <style>
        .bottom-sheet {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: #fff;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
            transform: translateY(100%);
            transition: transform 0.3s ease-out;
            z-index: 1050;
        }

        .bottom-sheet.show {
            transform: translateY(0);
        }

        /* @media (min-width: 1025px) {
            .bottom-sheet {
                display: none;
            }
        } */
    </style>
</head>
<body>

<?php echo $__env->make('layouts.footer_script', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<script>
$(document).ready(function () {
    let appScheme = '<?php echo e($scheme); ?>://' + window.location.host + window.location.pathname;
    let androidAppStoreLink = '<?php echo e($playStoreLink); ?>';
    let iosAppStoreLink = '<?php echo e($appStoreLink); ?>';
    let userAgent = navigator.userAgent || navigator.vendor || window.opera;
    let isAndroid = /android/i.test(userAgent);
    let isIOS = /iPad|iPhone|iPod/.test(userAgent) && !window.MSStream;
    let appStoreLink = isAndroid ? androidAppStoreLink : (isIOS ? iosAppStoreLink : androidAppStoreLink);

    window.location.href = appScheme;

    setTimeout(function () {
        if (!document.hidden && !document.webkitHidden) {
            if (confirm("<?php echo e($appName); ?> app is not installed. Would you like to download it from the app store?")) {
                window.location.href = appStoreLink;
            }
        }
    }, 1000);
});
</script>

</body>
</html>
<?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/deep-link/deep_link.blade.php ENDPATH**/ ?>