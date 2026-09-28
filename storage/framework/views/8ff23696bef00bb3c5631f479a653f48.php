<label
    for="<?php echo e($attributes->get('for')); ?>"
    class="block font-medium leading-5 text-gray-700 pb-2"
>
    <?php echo e($slot); ?>

    <?php if($attributes->get('required', false)): ?>
        <span class="text-red-400">*</span>
    <?php endif; ?>
</label>
<?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/vendor/dacoto/laravel-wizard-installer/resources/views/components/label.blade.php ENDPATH**/ ?>