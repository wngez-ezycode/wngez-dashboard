<?php $__env->startSection('title'); ?>
    <?php echo e(__('Default Currency Settings')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-title'); ?>
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h4><?php echo $__env->yieldContent('title'); ?></h4>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first"></div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="section">
        <form class="create-form-without-reset" action="<?php echo e(route('settings.store')); ?>" method="post" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="row d-flex mb-3">
                <div class="col-12 mt-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="divider pt-3">
                                <h6 class="divider-text"><?php echo e(__('Default Currency Settings')); ?></h6>
                            </div>

                            <div class="form-group row">
                                <div class="col-lg-6 col-xl-4 mt-2">
                                    <label for="currency_iso_code" class="col-sm-12 form-check-label mt-2"><?php echo e(__('Default Currency ISO Code')); ?></label>
                                    <?php if(count($currencies) > 0): ?>
                                        <select name="currency_iso_code" id="currency_iso_code" class="form-select form-control-sm">
                                            <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($currency->iso_code); ?>" <?php echo e((isset($settings['currency_iso_code']) && $settings['currency_iso_code'] == $currency->iso_code) ? 'selected' : ''); ?>>
                                                    <?php echo e($currency->iso_code); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    <?php else: ?>
                                        <input type="text" name="currency_iso_code" id="currency_iso_code" class="form-control" 
                                            placeholder="e.g. USD" maxlength="3" required 
                                            value="<?php echo e($settings['currency_iso_code'] ?? ''); ?>"
                                            oninput="this.value = this.value.toUpperCase().replace(/[^A-Z]/g, '')">
                                    <?php endif; ?>
                                </div>

                                <div class="col-lg-6 col-xl-4 mt-2">
                                    <label for="currency_symbol" class="col-sm-12 form-check-label  mt-2"><?php echo e(__('Currency Symbol')); ?></label>
                                    <input id="currency_symbol" name="currency_symbol" type="text" class="form-control" placeholder="<?php echo e(__('Currency Symbol')); ?>" value="<?php echo e($settings['currency_symbol'] ?? ''); ?>">
                                </div>

                                <div class="col-lg-6 col-xl-4 mt-3">
                                    <label for="currency_symbol_position" class="col-sm-12 form-check-label  mt-2"><?php echo e(__('Currency Symbol Position')); ?></label>
                                    <div class="mt-2 d-flex align-items-center">
                                        <div class="form-check me-3">
                                            <input
                                                type="radio"
                                                id="currency_symbol_left"
                                                name="currency_symbol_position"
                                                value="left"
                                                class="form-check-input"
                                                <?php echo e((isset($settings['currency_symbol_position']) && $settings['currency_symbol_position'] === 'left') ? 'checked' : ''); ?>

                                            >
                                            <label for="currency_symbol_left" class="form-check-label"><?php echo e(__('Left')); ?></label>
                                        </div>
                                        <div class="form-check">
                                            <input
                                                type="radio"
                                                id="currency_symbol_right"
                                                name="currency_symbol_position"
                                                value="right"
                                                class="form-check-input"
                                                <?php echo e((isset($settings['currency_symbol_position']) && $settings['currency_symbol_position'] === 'right') ? 'checked' : ''); ?>

                                            >
                                            <label for="currency_symbol_right" class="form-check-label"><?php echo e(__('Right')); ?></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-xl-4 mt-3">
                                    <label for="decimal_places" class="col-sm-12 form-check-label  mt-2"><?php echo e(__('Decimal Places')); ?></label>
                                    <input id="decimal_places" name="decimal_places" type="number" class="form-control" value="<?php echo e($settings['decimal_places'] ?? 2); ?>" min="0" max="6">
                                </div>

                                <div class="col-lg-6 col-xl-4 mt-3">
                                    <label for="thousand_separator" class="col-sm-12 form-check-label  mt-2"><?php echo e(__('Thousand Separator')); ?></label>
                                    <input id="thousand_separator" name="thousand_separator" type="text" class="form-control" value="<?php echo e($settings['thousand_separator'] ?? ','); ?>" maxlength="1">
                                </div>

                                <div class="col-lg-6 col-xl-4 mt-3">
                                    <label for="decimal_separator" class="col-sm-12 form-check-label  mt-2"><?php echo e(__('Decimal Separator')); ?></label>
                                    <input id="decimal_separator" name="decimal_separator" type="text" class="form-control" value="<?php echo e($settings['decimal_separator'] ?? '.'); ?>" maxlength="1">
                                </div>

                            </div>

                            <div class="col-12 d-flex justify-content-end mt-3">
                                <button type="submit" class="btn btn-primary me-1 mb-3"><?php echo e(__('Save')); ?></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/settings/default-currency.blade.php ENDPATH**/ ?>