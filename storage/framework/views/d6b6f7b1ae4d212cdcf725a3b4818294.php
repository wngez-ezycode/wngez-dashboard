<?php
    $depth = $depth ?? 0;
    $disabled = $disabled ?? false;
    $auto_expand = $auto_expand ?? false;
?>
<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
        $hasChildren = !empty($category->subcategories);
        $isOpen = $auto_expand && in_array($category->id, $selected_all_categories);
        $isChecked = in_array($category->id, $selected_categories);
        $icon = $hasChildren ? ($depth === 0 ? 'ph-folder-open' : 'ph-folder') : 'ph-tag';
    ?>
    <div class="category cs-category <?php echo e($isOpen ? 'open' : ''); ?>" data-depth="<?php echo e($depth); ?>">
        <div class="category-header cs-row" style="padding-left: <?php echo e(10 + ($depth * 28)); ?>px;">
            <?php if($hasChildren): ?>
                <button type="button" class="cs-toggle <?php echo e($isOpen ? 'open' : ''); ?>" aria-label="<?php echo e(__('Toggle')); ?>">
                    <i class="ph ph-caret-down"></i>
                </button>
            <?php else: ?>
                <span class="cs-toggle-spacer"></span>
            <?php endif; ?>

            <label class="cs-check">
                <input type="checkbox"
                       name="<?php echo e($checkbox_name ?? 'selected_categories[]'); ?>"
                       value="<?php echo e($category->id); ?>"
                       class="category-checkbox"
                       <?php echo e($isChecked ? 'checked' : ''); ?>

                       <?php echo e($disabled ? 'disabled' : ''); ?>>
                <span class="cs-check-box"><i class="ph-bold ph-check cs-check-icon"></i></span>
            </label>

            <span class="cs-cat-icon"><i class="ph <?php echo e($icon); ?>"></i></span>
            <span class="cs-cat-name"><?php echo e($category->name); ?></span>

            <?php if($hasChildren): ?>
                <span class="cs-badge" data-selected-badge>0 <?php echo e(__('Selected')); ?></span>
            <?php endif; ?>
        </div>

        <?php if($hasChildren): ?>
            <div class="subcategories cs-subcategories" style="display: <?php echo e($isOpen ? 'block' : 'none'); ?>; --line-left: <?php echo e(22 + ($depth * 28)); ?>px;">
                <?php echo $__env->make('category.treeview', [
                    'categories' => $category->subcategories,
                    'selected_categories' => $selected_categories,
                    'selected_all_categories' => $selected_all_categories,
                    'checkbox_name' => $checkbox_name ?? 'selected_categories[]',
                    'depth' => $depth + 1,
                    'disabled' => $disabled,
                    'auto_expand' => $auto_expand,
                ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>
        <?php endif; ?>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/category/treeview.blade.php ENDPATH**/ ?>