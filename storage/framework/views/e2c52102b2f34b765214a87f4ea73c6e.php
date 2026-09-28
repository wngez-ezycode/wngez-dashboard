<?php $__env->startSection('title'); ?>
    <?php echo e(__('User Reports')); ?>

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
    <div class="row">
        <section class="section">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div id="filters">
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <label for="user_filter"><?php echo e(__("User")); ?></label>
                                                <select class="form-control bootstrap-table-filter-control-user_id" id="user_filter">
                                                    <option value=""><?php echo e(__("All")); ?></option>
                                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label for="item_filter"><?php echo e(__("Item")); ?></label>
                                                <select class="form-control bootstrap-table-filter-control-item_id" id="item_filter">
                                                    <option value=""><?php echo e(__("All")); ?></option>
                                                    <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if (isset($component)) { $__componentOriginalc8463834ba515134d5c98b88e1a9dc03 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8463834ba515134d5c98b88e1a9dc03 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.data-table','data' => ['id' => 'table_list','url' => route('report-reasons.user-reports.show'),'toolbarId' => 'filters','clickToSelect' => true,'filterControl' => true,'fixedColumns' => true,'showExport' => true,'exportFileName' => 'advertisement-package-list','extra' => ['data-query-params'=>'queryParams'],'columns' => [
                                            ['field'=>'id','title'=>__('ID'),'align'=>'center','sortable'=>true],
                                            ['field'=>'reason','title'=>__('Reason'),'align'=>'center','formatter'=>'descriptionFormatter'],
                                            ['field'=>'user.name','title'=>__('User'),'align'=>'center','sortable'=>true,'attrs'=>['data-sort-name'=>'user_name']],
                                            ['field'=>'item.name','title'=>__('Advertisement'),'align'=>'center','sortable'=>true,'attrs'=>['data-sort-name'=>'item_name']],
                                            ['field'=>'item.image','title'=>__('Advertisement Image'),'align'=>'center','sortable'=>false,'formatter'=>'imageFormatter'],
                                            ['field'=>'item_id','title'=>__('Advertisement ID'),'align'=>'center','sortable'=>true,'visible'=>false,'filterControl'=>'select','filterData'=>''],
                                            ['field'=>'user_id','title'=>__('User ID'),'align'=>'center','sortable'=>true,'visible'=>false,'filterControl'=>'select','filterData'=>''],
                                            ['field'=>'item_status','title'=>__('Advertisement Status'),'visible'=>true,'formatter'=>'itemStatusSwitchFormatter'],
                                            ['field'=>'view_ad','title'=>__('View Ad'),'align'=>'center','sortable'=>false,'escape'=>false],
                                        ]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('data-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'table_list','url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('report-reasons.user-reports.show')),'toolbar-id' => 'filters','click-to-select' => true,'filter-control' => true,'fixed-columns' => true,'show-export' => true,'export-file-name' => 'advertisement-package-list','extra' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['data-query-params'=>'queryParams']),'columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
                                            ['field'=>'id','title'=>__('ID'),'align'=>'center','sortable'=>true],
                                            ['field'=>'reason','title'=>__('Reason'),'align'=>'center','formatter'=>'descriptionFormatter'],
                                            ['field'=>'user.name','title'=>__('User'),'align'=>'center','sortable'=>true,'attrs'=>['data-sort-name'=>'user_name']],
                                            ['field'=>'item.name','title'=>__('Advertisement'),'align'=>'center','sortable'=>true,'attrs'=>['data-sort-name'=>'item_name']],
                                            ['field'=>'item.image','title'=>__('Advertisement Image'),'align'=>'center','sortable'=>false,'formatter'=>'imageFormatter'],
                                            ['field'=>'item_id','title'=>__('Advertisement ID'),'align'=>'center','sortable'=>true,'visible'=>false,'filterControl'=>'select','filterData'=>''],
                                            ['field'=>'user_id','title'=>__('User ID'),'align'=>'center','sortable'=>true,'visible'=>false,'filterControl'=>'select','filterData'=>''],
                                            ['field'=>'item_status','title'=>__('Advertisement Status'),'visible'=>true,'formatter'=>'itemStatusSwitchFormatter'],
                                            ['field'=>'view_ad','title'=>__('View Ad'),'align'=>'center','sortable'=>false,'escape'=>false],
                                        ])]); ?>
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
                </div>
            </div>
        </section>
    </div>

    
    <div id="userReportAdPreviewModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <h4 class="modal-title fw-bold"><?php echo e(__('Advertisement Details')); ?></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-3">
                    <div class="row g-4">
                        <div class="col-lg-8">
                            <div class="ad-preview-main-image mb-3">
                                <img id="urapMainImg" src="" alt="Advertisement" class="w-100 rounded-3" onerror="onErrorImage(event)">
                            </div>
                            <div class="ad-preview-gallery position-relative mb-4 d-none" id="urapGallery">
                                <div class="ad-gallery-track d-flex gap-2 overflow-auto" id="urapGalleryTrack"></div>
                            </div>
                            <div id="urapDescriptionWrap" class="mb-4 d-none">
                                <h5 class="fw-bold mb-3"><?php echo e(__('Description')); ?></h5>
                                <p class="text-muted mb-0" id="urapDescription"></p>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card shadow-sm border mb-3">
                                <div class="card-body">
                                    <h5 class="fw-bold mb-1" id="urapName"></h5>
                                    <h4 class="text-primary fw-bold mb-2" id="urapPrice"></h4>
                                    <div class="d-flex justify-content-end mb-2">
                                        <small class="text-muted" id="urapAdId"></small>
                                    </div>
                                    <div class="d-flex flex-wrap gap-3 text-muted small mb-3" id="urapMeta"></div>
                                    <div class="d-flex gap-2" id="urapActions"></div>
                                </div>
                            </div>
                            <div class="card shadow-sm border mb-3 d-none" id="urapLocationCard">
                                <div class="card-body">
                                    <h6 class="fw-bold mb-3"><?php echo e(__('Location')); ?></h6>
                                    <div class="d-flex align-items-start gap-2">
                                        <i class="fas fa-map-marker-alt text-muted mt-1"></i>
                                        <span id="urapAddress" class="small"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="card shadow-sm border mb-3 d-none" id="urapSellerCard">
                                <div class="card-body">
                                    <div class="d-flex align-items-center gap-3">
                                        <img id="urapSellerImg" src="" class="rounded-circle" width="48" height="48" onerror="onErrorImage(event)">
                                        <div class="flex-grow-1">
                                            <h6 class="mb-0 fw-bold" id="urapSellerName"></h6>
                                            <small class="text-muted" id="urapSellerEmail"></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
$(document).on('click', '.user-report-ad-view', function (e) {
    e.preventDefault();
    let row;
    try { row = JSON.parse($(this).attr('data-row')); } catch (err) { return; }
    if (!row) return;

    let mainImg = row.image || '';
    $('#urapMainImg').attr('src', mainImg);

    let imgs = [];
    if (mainImg) imgs.push(mainImg);
    if (row.gallery_images && row.gallery_images.length) {
        row.gallery_images.forEach(function (g) {
            if (g.image && g.image !== mainImg) imgs.push(g.image);
        });
    }
    let thumbHtml = '';
    imgs.forEach(function (src, i) {
        thumbHtml += `<img src="${src}" class="ad-gallery-thumb ${i === 0 ? 'active' : ''}" onerror="onErrorImage(event)" style="width:64px;height:64px;object-fit:cover;border-radius:6px;cursor:pointer;">`;
    });
    $('#urapGalleryTrack').html(thumbHtml);
    $('#urapGallery').toggleClass('d-none', imgs.length <= 1);

    $('#urapName').text(row.name || '');
    let sym = row.currency && row.currency.symbol ? row.currency.symbol : '$';
    let priceDisplay = row.price ? sym + parseFloat(row.price).toFixed(2) : '';
    if (row.min_salary && row.max_salary) {
        priceDisplay = sym + parseFloat(row.min_salary).toFixed(2) + ' - ' + sym + parseFloat(row.max_salary).toFixed(2);
    }
    $('#urapPrice').text(priceDisplay);
    $('#urapAdId').text('Ad id #' + row.id);

    let meta = '';
    if (row.created_at) meta += `<span><i class="far fa-calendar-alt me-1"></i> <?php echo e(__('Listed on')); ?>: ${String(row.created_at).substring(0,10)}</span>`;
    if (row.expiry_date) meta += `<span><i class="far fa-clock me-1"></i> <?php echo e(__('Expiry')); ?>: ${String(row.expiry_date).substring(0,10)}</span>`;
    if (row.clicks !== undefined) meta += `<span><i class="far fa-eye me-1"></i> <?php echo e(__('Views')); ?>: ${row.clicks || 0}</span>`;
    if (row.likes !== undefined) meta += `<span><i class="far fa-heart me-1"></i> <?php echo e(__('Favorites')); ?>: ${row.likes || 0}</span>`;
    if (row.status) meta += `<span><i class="fas fa-info-circle me-1"></i> <?php echo e(__('Status')); ?>: ${row.status}</span>`;
    $('#urapMeta').html(meta);

    let actions = '';
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('advertisement-update')): ?>
        actions += `<a href="<?php echo e(url('advertisement')); ?>/${row.id}/edit" class="btn btn-primary flex-fill"><?php echo e(__('Edit')); ?></a>`;
    <?php endif; ?>
    $('#urapActions').html(actions);

    if (row.description) {
        $('#urapDescription').text(row.description);
        $('#urapDescriptionWrap').removeClass('d-none');
    } else {
        $('#urapDescriptionWrap').addClass('d-none');
    }

    let addrParts = [row.address, row.city, row.state, row.country].filter(Boolean);
    if (addrParts.length) {
        $('#urapAddress').text(addrParts.join(', '));
        $('#urapLocationCard').removeClass('d-none');
    } else {
        $('#urapLocationCard').addClass('d-none');
    }

    if (row.user) {
        $('#urapSellerImg').attr('src', row.user.profile || '');
        $('#urapSellerName').text(row.user.name || '');
        $('#urapSellerEmail').text(row.user.email || '');
        $('#urapSellerCard').removeClass('d-none');
    } else {
        $('#urapSellerCard').addClass('d-none');
    }

    $('#userReportAdPreviewModal').modal('show');
});

$(document).on('click', '#urapGalleryTrack .ad-gallery-thumb', function () {
    $('#urapMainImg').attr('src', $(this).attr('src'));
    $('#urapGalleryTrack .ad-gallery-thumb').removeClass('active');
    $(this).addClass('active');
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/reports/user_reports.blade.php ENDPATH**/ ?>