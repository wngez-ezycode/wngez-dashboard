<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="category">
        <label>
            <input type="radio" name="selected_category" value="<?php echo e($category->id); ?>"
                <?php if($selected_category == $category->id): ?> checked <?php endif; ?>
                <?php if($category->subcategories->isNotEmpty()): ?> disabled <?php endif; ?>>
            <?php echo e($category->name); ?>

        </label>
        <?php if($category->subcategories->isNotEmpty()): ?>
            <?php
                // Get current language from Session
                $currentLang = Session::get('language');
                // Check RTL: use accessor which returns boolean (rtl != 0)
                $isRtl = false;
                if (!empty($currentLang)) {
                    try {
                        // Try to get raw attribute first, fallback to accessor
                        $rtlRaw = method_exists($currentLang, 'getRawOriginal') ? $currentLang->getRawOriginal('rtl') : null;
                        if ($rtlRaw !== null) {
                            $isRtl = ($rtlRaw == 1 || $rtlRaw === true);
                        } else {
                            $isRtl = ($currentLang->rtl == true || $currentLang->rtl === 1);
                        }
                    } catch (\Exception $e) {
                        $isRtl = ($currentLang->rtl == true || $currentLang->rtl === 1);
                    }
                }
                $arrowIcon = $isRtl ? '&#xf0d9;' : '&#xf0da;'; // fa-caret-left for RTL, fa-caret-right for LTR
            ?>
            <i class="fas toggle-button" style="font-size: 24px"><?php echo $arrowIcon; ?></i>
            <div class="subcategories" style="display: none;">
                <?php echo $__env->make('items.treeview', ['categories' => $category->subcategories, 'selected_category' => $selected_category], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>
        <?php endif; ?>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/items/treeview.blade.php ENDPATH**/ ?>