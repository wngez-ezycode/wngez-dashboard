<?php if($languages->isNotEmpty()): ?>
    <ul class="nav nav-tabs mb-3">
        <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="nav-item">
                <a class="nav-link <?php if($index == 0): ?> active <?php endif; ?>"
                   data-bs-toggle="tab"
                   href="#lang-<?php echo e($language->id); ?>-<?php echo e($state->id); ?>">
                    <?php echo e($language->name); ?>

                </a>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>

    <div class="tab-content mb-4">
        <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="tab-pane fade <?php if($index == 0): ?> show active <?php endif; ?>"
                 id="lang-<?php echo e($language->id); ?>-<?php echo e($state->id); ?>">
                <div class="row">
                    <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $translation = $city->translations->where('language_id', $language->id)->where('key', 'name')->first();
                        ?>
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><?php echo e($city->name); ?></label>
                            <input type="text"
                                   name="translations[<?php echo e($language->id); ?>][<?php echo e($city->id); ?>]"
                                   class="form-control"
                                   value="<?php echo e($translation?->value); ?>"
                                   placeholder="<?php echo e(__('Enter name for')); ?> <?php echo e($city->name); ?>">
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php endif; ?>
<?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/places/city_translation_tab.blade.php ENDPATH**/ ?>