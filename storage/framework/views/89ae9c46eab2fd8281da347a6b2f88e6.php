<?php $__env->startSection('title'); ?>
    <?php echo e(__('Subscription Packages')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-title'); ?>
    <div class="page-title">
        <div class="row d-flex align-items-center">
            <div class="col-12 col-md-6">
                <h4 class="mb-0"><?php echo $__env->yieldContent('title'); ?></h4>
            </div>
            <div class="col-12 col-md-6 text-end">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('advertisement-listing-package-create')): ?>
                    <a class="btn btn-primary me-2" href="<?php echo e(route('package.create')); ?>"><?php echo e(__('Create Subscription Package')); ?></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user-package-list')): ?>
<script>
var currentSubscriberPackageId = null;

function subscribersQueryParams(p) {
    return $.extend({}, p, { package_id: currentSubscriberPackageId, status: 'active' });
}

function loadSubscribers(el) {
    currentSubscriberPackageId = $(el).data('package-id');
    $('#subscribersModalLabel').text('<?php echo e(__('Active Subscribers')); ?> — ' + $(el).data('package-name'));
    $('#subscribers_table').bootstrapTable('refresh', { silent: false });
}

$('#subscribersModal').on('hidden.bs.modal', function () {
    currentSubscriberPackageId = null;
    $('#subscribers_table').bootstrapTable('load', { total: 0, rows: [] });
});
</script>
<?php endif; ?>

<script>
var currentPackageView = 'active'; // 'all' | 'active' | 'discontinued'

function packageQueryParams(p) {
    var params = $.extend({}, p);
    params.status = null;
    if (currentPackageView === 'active') {
        params.is_discontinued = 0;
    } else if (currentPackageView === 'discontinued') {
        params.is_discontinued = 1;
    } else if (currentPackageView === 'inactive'){
        params.is_discontinued = 0;
        params.status = 0;
    }
    var typeVal = $('#type').val();
    if (typeVal) {
        params.filter = JSON.stringify({ type: typeVal });
    }
    return params;
}

$(function () {
    function setActiveBtn(view) {
        $('#btn-all-packages, #btn-active-packages, #btn-discontinued-packages, #btn-inactive-packages').removeClass('active');
        if (view === 'all') $('#btn-all-packages').addClass('active');
        else if (view === 'active') $('#btn-active-packages').addClass('active');
        else if (view === 'discontinued') $('#btn-discontinued-packages').addClass('active');
        else if (view === 'inactive') $('#btn-inactive-packages').addClass('active');
    }

    function applyColumnVisibility(view) {
        var showDiscontinued = (view === 'discontinued' || view === 'all');
        var showActiveOnly   = (view === 'active' || view === 'all');
        var showInactiveOnly = (view === 'inactive' || view === 'all');

        if (showDiscontinued) {
            $('#table_list').bootstrapTable('showColumn', 'discontinued_at');
            $('#table_list').bootstrapTable('showColumn', 'active_subscribers');
        } else {
            $('#table_list').bootstrapTable('hideColumn', 'discontinued_at');
            $('#table_list').bootstrapTable('hideColumn', 'active_subscribers');
        }

        if (showActiveOnly || showInactiveOnly) {
            $('#table_list').bootstrapTable('showColumn', 'total_revenue');
            $('#table_list').bootstrapTable('showColumn', 'total_subscribers');
        } else {
            $('#table_list').bootstrapTable('hideColumn', 'total_revenue');
            $('#table_list').bootstrapTable('hideColumn', 'total_subscribers');
        }

        // package_status column always visible
    }

    $('#btn-active-packages').addClass('active');
    applyColumnVisibility('active');

    $('#btn-all-packages').on('click', function () {
        currentPackageView = 'all';
        setActiveBtn('all');
        applyColumnVisibility('all');
        $('#table_list').bootstrapTable('refresh');
    });

    $('#btn-active-packages').on('click', function () {
        currentPackageView = 'active';
        setActiveBtn('active');
        applyColumnVisibility('active');
        $('#table_list').bootstrapTable('refresh');
    });

    $('#btn-discontinued-packages').on('click', function () {
        currentPackageView = 'discontinued';
        setActiveBtn('discontinued');
        applyColumnVisibility('discontinued');
        $('#table_list').bootstrapTable('refresh');
    });

    $('#btn-inactive-packages').on('click', function () {
        currentPackageView = 'inactive';
        setActiveBtn('inactive');
        applyColumnVisibility('inactive');
        $('#table_list').bootstrapTable('refresh');
    });

    $('#type').on('change', function () {
        $('#table_list').bootstrapTable('refresh');
    });
});

function packageStatusFormatter(value, row) {
    if (value == 1) {
        return '<span class="badge bg-danger"><?php echo e(__('Discontinued')); ?></span>';
    }
    if(row.status == 0){
        return '<span class="badge bg-warning"><?php echo e(__('Inactive')); ?></span>';
    }
    return '<span class="badge bg-success"><?php echo e(__('Active')); ?></span>';
}

function activeSubscribersBadgeFormatter(value) {
    if (value > 0) {
        return '<span class="badge bg-warning text-dark">' + value + ' <?php echo e(__('active')); ?></span>';
    }
    return '<span class="badge bg-secondary"><?php echo e(__('None')); ?></span>';
}

$(document).on('click', '.discontinue-btn', function () {
    var btn = $(this);
    var name = btn.data('name');
    var subscribers = parseInt(btn.data('subscribers')) || 0;
    var url = btn.data('url');

    $('#discontinuePackageName').text(name);
    var msg = '<?php echo e(__("This package will stop appearing for new purchases. Existing subscribers will keep access until their subscription expires. This action cannot be undone.")); ?>';
    if (subscribers > 0) {
        msg += ' <strong><?php echo e(__("There are currently")); ?> ' + subscribers + ' <?php echo e(__("active subscriber(s).")); ?></strong>';
    }
    $('#discontinueWarningMsg').html(msg);
    $('#confirmDiscontinueBtn').data('url', url);
    $('#discontinueModal').modal('show');
});

$('#confirmDiscontinueBtn').on('click', function () {
    var url = $(this).data('url');
    $.ajax({
        url: url,
        type: 'PUT',
        data: { _token: '<?php echo e(csrf_token()); ?>' },
        success: function (res) {
            $('#discontinueModal').modal('hide');
            $('#table_list').bootstrapTable('refresh');
            if (res.status) {
                toastMessage(res.message || '<?php echo e(__("Package discontinued successfully.")); ?>', 'success');
            } else {
                toastMessage(res.message || '<?php echo e(__("Something went wrong.")); ?>', 'error');
            }
        },
        error: function () {
            $('#discontinueModal').modal('hide');
            toastMessage('<?php echo e(__("Something went wrong.")); ?>', 'error');
        }
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['advertisement-listing-package-update','featured-advertisement-package-update'])): ?>
    <div class="modal fade" id="discontinueModal" tabindex="-1" aria-labelledby="discontinueModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="discontinueModalLabel">
                        <i class="ph ph-warning me-1"></i> <?php echo e(__('Discontinue Package')); ?>

                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="fw-semibold mb-2"><?php echo e(__('You are about to discontinue:')); ?> <span id="discontinuePackageName" class="text-danger"></span></p>
                    <div class="alert alert-warning" id="discontinueWarningMsg"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
                    <button type="button" class="btn btn-danger" id="confirmDiscontinueBtn"><?php echo e(__('Yes, Discontinue')); ?></button>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user-package-list')): ?>
    <div class="modal fade" id="subscribersModal" tabindex="-1" aria-labelledby="subscribersModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="subscribersModalLabel"><?php echo e(__('Active Subscribers')); ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php
                        $subCols = [
                            ['field'=>'id','title'=>__('ID'),'align'=>'center','sortable'=>true],
                            ['field'=>'user.name','title'=>__('User Name'),'align'=>'center'],
                            ['field'=>'start_date','title'=>__('Start Date'),'align'=>'center','sortable'=>true],
                            ['field'=>'end_date','title'=>__('End Date'),'align'=>'center','formatter'=>'unlimitedBadgeFormatter','sortable'=>true],
                            ['field'=>'status','title'=>__('Status'),'align'=>'center','formatter'=>'userPackageStatusBadgeFormatter','escape'=>false],
                            ['field'=>'total_limit','title'=>__('Total Limit'),'align'=>'center','formatter'=>'unlimitedBadgeFormatter','sortable'=>true],
                            ['field'=>'used_limit','title'=>__('Used Limit'),'align'=>'center','sortable'=>true],
                        ];
                    ?>
                    <?php if (isset($component)) { $__componentOriginalc8463834ba515134d5c98b88e1a9dc03 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8463834ba515134d5c98b88e1a9dc03 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.data-table','data' => ['id' => 'subscribers_table','url' => route('package.users.show'),'columns' => $subCols,'tableName' => 'subscribers','showColumns' => false,'showRefresh' => false,'showExport' => false,'extra' => ['data-query-params'=>'subscribersQueryParams']]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('data-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'subscribers_table','url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('package.users.show')),'columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($subCols),'table-name' => 'subscribers','show-columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false),'show-refresh' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false),'show-export' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false),'extra' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['data-query-params'=>'subscribersQueryParams'])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc8463834ba515134d5c98b88e1a9dc03)): ?>
<?php $attributes = $__attributesOriginalc8463834ba515134d5c98b88e1a9dc03; ?>
<?php unset($__attributesOriginalc8463834ba515134d5c98b88e1a9dc03); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc8463834ba515134d5c98b88e1a9dc03)): ?>
<?php $component = $__componentOriginalc8463834ba515134d5c98b88e1a9dc03; ?>
<?php unset($__componentOriginalc8463834ba515134d5c98b88e1a9dc03); ?>
<?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="row g-2 mb-3 align-items-center">
                            <div class="col-12 col-md-auto">
                                <button type="button" class="btn btn-outline-primary all w-100" id="btn-all-packages">
                                    <?php echo e(__('All Packages')); ?>

                                </button>
                            </div>
                            <div class="col-12 col-md-auto">
                                <button type="button" class="btn btn-outline-success w-100" id="btn-active-packages">
                                    <?php echo e(__('Active Packages')); ?>

                                </button>
                            </div>

                            <div class="col-12 col-md-auto">
                                <button type="button" class="btn btn-outline-warning w-100" id="btn-inactive-packages">
                                    <?php echo e(__('Inactive Packages')); ?>

                                </button>
                            </div>

                            <div class="col-12 col-md-auto">
                                <button type="button" class="btn btn-outline-danger w-100" id="btn-discontinued-packages">
                                    <?php echo e(__('Discontinued Packages')); ?>

                                </button>
                            </div>
                        </div>

                        <div id="filters">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <label for="type"><?php echo e(__('Package Type')); ?></label>
                                    <select name="type" class="form-control" aria-label="type" id="type">
                                        <option value=""><?php echo e(__('All')); ?></option>
                                        <option value="item_listing"><?php echo e(__('Item Listing (Ads)')); ?></option>
                                        <option value="advertisement"><?php echo e(__('Advertisement (Featured Ads)')); ?></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <?php
                            $pkgCols = [
                                ['field'=>'id','title'=>__('ID'),'align'=>'center','sortable'=>true],
                                ['field'=>'icon','title'=>__('Image'),'align'=>'center','formatter'=>'imageFormatter'],
                                ['field'=>'name','title'=>__('Name'),'align'=>'center','escape'=>true],
                                ['field'=>'type','title'=>__('Type'),'align'=>'center','formatter'=>'packageTypeFormatter'],
                                ['field'=>'category_names','title'=>__('Categories'),'align'=>'center','formatter'=>'categoryNamesFormatter'],
                                ['field'=>'price','title'=>__('Price'),'align'=>'center','sortable'=>true],
                                ['field'=>'discount_in_percentage','title'=>__('Discount (%)'),'align'=>'center','sortable'=>true],
                                ['field'=>'final_price','title'=>__('Final Price'),'align'=>'center','sortable'=>true],
                                ['field'=>'duration','title'=>__('Package Duration'),'align'=>'center','sortable'=>true],
                                ['field'=>'total_revenue','title'=>__('Total Revenue'),'align'=>'center','sortable'=>true, 'visible' => false],
                                ['field'=>'total_subscribers','title'=>__('Active Subscribers'),'align'=>'center','sortable'=>true, 'visible' => false],
                                ['field'=>'active_subscribers','title'=>__('Remaining Subscribers'),'align'=>'center','sortable'=>true,'visible'=>false,'formatter'=>'activeSubscribersBadgeFormatter','escape'=>false],
                                ['field'=>'discontinued_at','title'=>__('Discontinued On'),'align'=>'center','sortable'=>true, 'visible'=>false],
                                ['field'=>'is_discontinued','title'=>__('Package Status'),'align'=>'center','sortable'=>false, 'formatter'=>'packageStatusFormatter','escape'=>false],
                                ['field'=>'is_reel_allowed','title'=>__('Is Video Ads Allowed ?'),'align'=>'center','visible'=>false,'sortable'=>true,'formatter'=>'yesNoFormatter'],
                            ];
                            if(auth()->user()->canany(['advertisement-listing-package-update','featured-advertisement-package-update'])) {
                                $pkgCols[] = ['field'=>'status','title'=>__('Status'),'align'=>'center','sortable'=>true,'formatter'=>'statusSwitchFormatter','escape'=>false];
                            }
                            if(auth()->user()->canany(['advertisement-listing-package-update','advertisement-listing-package-delete','featured-advertisement-package-update','featured-advertisement-package-delete','user-package-list'])) {
                                $pkgCols[] = ['field'=>'operate','title'=>__('Action'),'align'=>'center','escape'=>false,'sortable'=>false];
                            }
                        ?>
                        <?php if (isset($component)) { $__componentOriginalc8463834ba515134d5c98b88e1a9dc03 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8463834ba515134d5c98b88e1a9dc03 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.data-table','data' => ['id' => 'table_list','url' => route('package.show', 1),'toolbarId' => 'filters','fixedColumns' => true,'showExport' => true,'exportFileName' => 'package-list','tableName' => 'packages','extra' => ['data-search-align'=>'right','data-query-params'=>'packageQueryParams'],'columns' => $pkgCols]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('data-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'table_list','url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('package.show', 1)),'toolbar-id' => 'filters','fixed-columns' => true,'show-export' => true,'export-file-name' => 'package-list','table-name' => 'packages','extra' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['data-search-align'=>'right','data-query-params'=>'packageQueryParams']),'columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($pkgCols)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc8463834ba515134d5c98b88e1a9dc03)): ?>
<?php $attributes = $__attributesOriginalc8463834ba515134d5c98b88e1a9dc03; ?>
<?php unset($__attributesOriginalc8463834ba515134d5c98b88e1a9dc03); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc8463834ba515134d5c98b88e1a9dc03)): ?>
<?php $component = $__componentOriginalc8463834ba515134d5c98b88e1a9dc03; ?>
<?php unset($__componentOriginalc8463834ba515134d5c98b88e1a9dc03); ?>
<?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/packages/index.blade.php ENDPATH**/ ?>