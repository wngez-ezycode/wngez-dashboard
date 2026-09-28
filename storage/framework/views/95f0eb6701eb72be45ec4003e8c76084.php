<?php
    $rawColor = $attributes->get('color', 'blue');
    $color = in_array($rawColor, ['blue', 'red'], true) ? $rawColor : 'blue';
?>
<button
    type="<?php echo e($attributes->get('type', 'button')); ?>"
    class="<?php echo \Illuminate\Support\Arr::toCssClasses([
        'text-white font-bold py-2 px-4 rounded inline-flex items-center',
        'bg-blue-500 hover:bg-blue-700' => $color === 'blue',
        'bg-red-500 hover:bg-red-700' => $color === 'red',
    ]); ?>"
>
    <?php echo e($slot); ?>

</button>
<?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/vendor/dacoto/laravel-wizard-installer/resources/views/components/button.blade.php ENDPATH**/ ?>