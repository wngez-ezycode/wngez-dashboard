<script>
    const urlParams = new URLSearchParams(window.location.search);

    const trxref = urlParams.get('trxref');
    const reference = urlParams.get('reference');

    window.opener.postMessage({
        status: 'success',
        reference: reference || 'your-payment-reference',
        trxref: trxref
    },  '*');

    window.close();
</script><?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/payment/paytabs.blade.php ENDPATH**/ ?>