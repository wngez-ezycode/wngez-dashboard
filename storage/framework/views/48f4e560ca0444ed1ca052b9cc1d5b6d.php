<!DOCTYPE html>
<html>
<head>
    <title>Payment Failed</title>
</head>
<body>
    <div style="text-align: center; padding: 50px; font-family: Arial, sans-serif;">
        <h2>Payment Failed</h2>
        <p><?php echo e($message ?? __('Your payment could not be completed.')); ?></p>
        <?php if(isset($transaction)): ?>
            <p style="color: #666; font-size: 12px;"><?php echo e(__('Transaction ID')); ?>: <?php echo e($transaction->id); ?></p>
        <?php endif; ?>
    </div>
    <script>
        if (window.opener) {
            window.opener.postMessage({
                status: 'failed',
                paymentTransactionId: <?php echo e($transaction->id ?? 'null'); ?>,
                gateway: '<?php echo e($transaction->payment_gateway ?? ''); ?>',
            }, '*');
            setTimeout(() => window.close(), 2000);
        }
    </script>
</body>
</html>
<?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/plugin-payment/failed.blade.php ENDPATH**/ ?>