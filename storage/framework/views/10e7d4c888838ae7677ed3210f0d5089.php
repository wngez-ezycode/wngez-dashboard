<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'id' => 'table_list',
    'url' => null,
    'columns' => [],
    'toolbarId' => null,
    'toolbarSlot' => null,
    'pageSize' => 10,
    'pageList' => '[5, 10, 20, 50, 100, 200]',
    'search' => true,
    'showColumns' => true,
    'showRefresh' => true,
    'showExport' => false,
    'exportFileName' => 'export',
    'exportIgnore' => '["operate"]',
    'exportTypes' => "['pdf','json','xml','csv','txt','sql','doc','excel']",
    'sortName' => 'id',
    'sortOrder' => 'desc',
    'sidePagination' => 'server',
    'filterControl' => false,
    'fixedColumns' => false,
    'fixedNumber' => 1,
    'fixedRightNumber' => 1,
    'statusColumn' => null,
    'tableName' => null,
    'clickToSelect' => false,
    'responsive' => true,
    'mobileResponsive' => true,
    'escape' => true,
    'extra' => [],
    'caption' => null,
    'captionId' => null,
    'pagination' => true,
    'class' => '',
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'id' => 'table_list',
    'url' => null,
    'columns' => [],
    'toolbarId' => null,
    'toolbarSlot' => null,
    'pageSize' => 10,
    'pageList' => '[5, 10, 20, 50, 100, 200]',
    'search' => true,
    'showColumns' => true,
    'showRefresh' => true,
    'showExport' => false,
    'exportFileName' => 'export',
    'exportIgnore' => '["operate"]',
    'exportTypes' => "['pdf','json','xml','csv','txt','sql','doc','excel']",
    'sortName' => 'id',
    'sortOrder' => 'desc',
    'sidePagination' => 'server',
    'filterControl' => false,
    'fixedColumns' => false,
    'fixedNumber' => 1,
    'fixedRightNumber' => 1,
    'statusColumn' => null,
    'tableName' => null,
    'clickToSelect' => false,
    'responsive' => true,
    'mobileResponsive' => true,
    'escape' => true,
    'extra' => [],
    'caption' => null,
    'captionId' => null,
    'pagination' => true,
    'class' => '',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php if($toolbarSlot): ?>
    <div id="<?php echo e($toolbarId ?? $id . '-toolbar'); ?>"><?php echo $toolbarSlot; ?></div>
<?php endif; ?>

<div class="row">
    <div class="col-12">
        <table class="table-borderless table <?php echo e($class); ?>" aria-describedby="dataTable" id="<?php echo e($id); ?>"
            data-toggle="table" <?php if($url): ?> data-url="<?php echo e($url); ?>" <?php endif; ?>
            data-side-pagination="<?php echo e($sidePagination); ?>" data-pagination="<?php echo e($pagination ? 'true' : 'false'); ?>"
            data-page-size="<?php echo e($pageSize); ?>" data-page-list="<?php echo e($pageList); ?>"
            data-search="<?php echo e($search ? 'true' : 'false'); ?>" data-show-columns="<?php echo e($showColumns ? 'true' : 'false'); ?>"
            data-show-refresh="<?php echo e($showRefresh ? 'true' : 'false'); ?>" data-sort-name="<?php echo e($sortName); ?>"
            data-sort-order="<?php echo e($sortOrder); ?>" data-pagination-successively-size="3" data-trim-on-search="false"
            data-escape="<?php echo e($escape ? 'true' : 'false'); ?>"
            data-locale="<?php echo e(app()->getLocale() == 'ar' ? 'ar-SA' : 'en-US'); ?>"
            <?php if($clickToSelect): ?> data-click-to-select="true" <?php endif; ?>
            <?php if($responsive): ?> data-responsive="true" <?php endif; ?>
            <?php if($mobileResponsive): ?> data-mobile-responsive="true" <?php endif; ?>
            <?php if($tableName): ?> data-table="<?php echo e($tableName); ?>" <?php endif; ?>
            <?php if($statusColumn): ?> data-status-column="<?php echo e($statusColumn); ?>" <?php endif; ?>
            <?php if($fixedColumns): ?> data-fixed-columns="true"
                data-fixed-number="<?php echo e($fixedNumber); ?>"
                data-fixed-right-number="<?php echo e($fixedRightNumber); ?>" <?php endif; ?>
            <?php if($filterControl): ?> data-filter-control="true"
                <?php if($toolbarId): ?> data-filter-control-container="#<?php echo e($toolbarId); ?>" <?php endif; ?>
            <?php endif; ?>
            <?php if($toolbarId): ?> data-toolbar="#<?php echo e($toolbarId); ?>" <?php endif; ?>
            <?php if($showExport): ?> data-show-export="true"
                data-export-options='{"fileName": "<?php echo e($exportFileName); ?>", "ignoreColumn": <?php echo e($exportIgnore); ?>}'
                data-export-types="<?php echo e($exportTypes); ?>" <?php endif; ?>
            <?php $__currentLoopData = $extra; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo e($k); ?>="<?php echo e($v); ?>" <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            >
            <?php if($caption): ?>
                <caption <?php if($captionId): ?> id="<?php echo e($captionId); ?>" <?php endif; ?> class="visually-hidden">
                    <?php echo e($caption); ?></caption>
            <?php endif; ?>
            <thead class="thead-dark">
                <tr>
                    <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <th scope="col"
                            <?php if(isset($c['field'])): ?> data-field="<?php echo e($c['field']); ?>" <?php endif; ?>
                            <?php if(isset($c['sortable'])): ?> data-sortable="<?php echo e($c['sortable'] ? 'true' : 'false'); ?>" <?php endif; ?>
                            <?php if(isset($c['formatter'])): ?> data-formatter="<?php echo e($c['formatter']); ?>" <?php endif; ?>
                            <?php if(isset($c['events'])): ?> data-events="<?php echo e($c['events']); ?>" <?php endif; ?>
                            <?php if(isset($c['escape'])): ?> data-escape="<?php echo e($c['escape'] ? 'true' : 'false'); ?>" <?php endif; ?>
                            <?php if(isset($c['width'])): ?> data-width="<?php echo e($c['width']); ?>" <?php endif; ?>
                            <?php if(isset($c['align'])): ?> data-align="<?php echo e($c['align']); ?>" <?php endif; ?>
                            <?php if(isset($c['visible'])): ?>
                                data-visible="<?php echo e($c['visible'] ? 'true' : 'false'); ?>"
                            <?php else: ?>
                                <?php if(($c['field'] ?? '') === 'id'): ?>
                                    data-visible="false"
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if(isset($c['switchable'])): ?> data-switchable="<?php echo e($c['switchable'] ? 'true' : 'false'); ?>" <?php endif; ?>
                            <?php if(isset($c['checkbox'])): ?> data-checkbox="<?php echo e($c['checkbox'] ? 'true' : 'false'); ?>" <?php endif; ?>
                            <?php if(isset($c['filterControl'])): ?> data-filter-control="<?php echo e($c['filterControl']); ?>" <?php endif; ?>
                            <?php if(isset($c['filterName'])): ?> data-filter-name="<?php echo e($c['filterName']); ?>" <?php endif; ?>
                            <?php if(isset($c['filterData'])): ?> data-filter-data="<?php echo e($c['filterData']); ?>" <?php endif; ?>
                            <?php if(isset($c['attrs'])): ?>
                                <?php $__currentLoopData = $c['attrs']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ak => $av): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php echo e($ak); ?>="<?php echo e($av); ?>"
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>>
                            <?php echo e($c['title'] ?? ''); ?></th>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tr>
            </thead>
            <?php echo e($slot ?? ''); ?>

        </table>
    </div>
</div>

<?php if($search): ?>
    <script>
        window.addEventListener('load', function() {
            var q = new URLSearchParams(window.location.search).get('search');
            if (!q || !window.jQuery || !jQuery.fn.bootstrapTable) return;
            jQuery('#<?php echo e($id); ?>').bootstrapTable('resetSearch', q);
        });
    </script>
<?php endif; ?>
<?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/dashboard/resources/views/components/data-table.blade.php ENDPATH**/ ?>