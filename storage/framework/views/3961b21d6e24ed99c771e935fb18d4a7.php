<!DOCTYPE html>
<html>
<head>
    <title>DPO Payment Success</title>
</head>
<body>
    <div style="text-align: center; padding: 50px; font-family: Arial, sans-serif;">
        <h2>Payment Processing</h2>
        <p id="message"><?php echo e($message ?? 'Processing your payment...'); ?></p>
        <?php if(isset($transactionToken)): ?>
        <p style="color: #666; font-size: 12px;">Transaction Token: <?php echo e($transactionToken); ?></p>
        <?php endif; ?>
    </div>
    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const transactionToken = urlParams.get('TransactionToken') || urlParams.get('token') || '<?php echo e($transactionToken ?? ''); ?>';
        const companyRef = urlParams.get('CompanyRef') || '<?php echo e($companyRef ?? ''); ?>';

        // If opened in popup/iframe, send message to parent
        if (window.opener) {
            window.opener.postMessage({
                status: 'success',
                transactionToken: transactionToken,
                companyRef: companyRef,
                message: '<?php echo e($message ?? "Payment processed successfully"); ?>'
            }, '*');
            setTimeout(() => window.close(), 2000);
        }
    </script>
</body>
</html>
<?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/payment/dpo.blade.php ENDPATH**/ ?>