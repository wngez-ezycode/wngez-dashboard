<script>
    const urlParams = new URLSearchParams(window.location.search);

    const trxref = <?php echo json_encode($trxref, 15, 512) ?>;
    const reference = <?php echo json_encode($reference, 15, 512) ?>;


    window.opener.postMessage({
        status: 'cancel',
        reference: reference || 'your-payment-reference', // Use extracted reference, fallback if missing
        trxref: trxref
    }, '*');
    window.close();
</script>

<?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/payment/paypalcancle.blade.php ENDPATH**/ ?>