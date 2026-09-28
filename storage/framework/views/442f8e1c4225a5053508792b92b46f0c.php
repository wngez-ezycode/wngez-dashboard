<?php $__env->startSection('title'); ?>
    <?php echo e(__('Edit Package')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-title'); ?>
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h4><?php echo $__env->yieldContent('title'); ?></h4>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="section">
        <div class="buttons">
            <a class="btn btn-primary" href="<?php echo e(route('package.index')); ?>">
                < <?php echo e(__('Back to Packages')); ?>

            </a>
        </div>
        <form action="<?php echo e(route('package.update', $package->id)); ?>" class="edit-form"
            data-success-function="afterPackageUpdate" method="POST" data-parsley-validate
            enctype="multipart/form-data">
            <?php echo method_field('PUT'); ?>
            <?php echo csrf_field(); ?>
            <div class="row">

                <div class="col-md-6 col-sm-12">
                    <div class="card">
                        
                        <div class="card-header"><?php echo e(__('Edit Package')); ?> <small class="text-muted ms-2"><?php echo e(__('(Only Name, Description, Key Points, and Icon can be edited)')); ?></small></div>
                        <div class="card-body mt-2">

                            <ul class="nav nav-tabs" id="langTabs" role="tablist">
                                <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link <?php if($key == 0): ?> active <?php endif; ?>"
                                            id="tab-<?php echo e($lang->id); ?>" data-bs-toggle="tab"
                                            data-bs-target="#lang-<?php echo e($lang->id); ?>" type="button" role="tab">
                                            <?php echo e($lang->name); ?>

                                        </button>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>

                            <div class="tab-content mt-3">
                                <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="tab-pane fade <?php if($key == 0): ?> show active <?php endif; ?>"
                                        id="lang-<?php echo e($lang->id); ?>" role="tabpanel">
                                        <input type="hidden" name="languages[]" value="<?php echo e($lang->id); ?>">
                                        <?php if($lang->id == 1): ?>
                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <label><?php echo e(__('Package Name')); ?> (<?php echo e($lang->name); ?>) <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="name[<?php echo e($lang->id); ?>]" class="form-control"
                                                        value="<?php echo e($translations[$lang->id]['name'] ?? ''); ?>"
                                                        data-parsley-required="true">
                                                </div>
                                                
                                                <div class="col-md-6 form-group">
                                                    <label><?php echo e(__('IOS Product ID')); ?></label>
                                                    <input type="text" name="ios_product_id" class="form-control"
                                                        value="<?php echo e($package->ios_product_id); ?>">
                                                </div>
                                            </div>
                                        <?php else: ?>
                                            <div class="form-group">
                                                <label><?php echo e(__('Package Name')); ?> (<?php echo e($lang->name); ?>) <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="name[<?php echo e($lang->id); ?>]" class="form-control"
                                                    value="<?php echo e($translations[$lang->id]['name'] ?? ''); ?>">
                                            </div>
                                        <?php endif; ?>
                                        <?php if($lang->id == 1): ?>
                                            <?php
                                                $packageDurationType = is_null($package->duration) ? 'unlimited' : 'limited';
                                                $packageDurationValue = is_null($package->duration) ? '' : $package->duration;
                                                
                                                $adsItemLimitType = ($package->item_limit == 'unlimited') ? 'unlimited' : 'limited';
                                                $adsItemLimitValue = ($package->item_limit == 'unlimited') ? '' : $package->item_limit;
                                                
                                                $adsListingDurationType = $package->listing_duration_type ?? 'standard';
                                                $adsListingDurationDays = $package->listing_duration_days ?? null;
                                                
                                                $featuredItemLimitType = ($package->item_limit == 'unlimited') ? 'unlimited' : 'limited';
                                                $featuredItemLimitValue = ($package->item_limit == 'unlimited') ? '' : $package->item_limit;
                                                
                                                $featuredAdsDurationType = $package->listing_duration_type ?? 'standard';
                                                $featuredAdsDurationDays = $package->listing_duration_days ?? null;
                                                
                                                $keyPoints = [];
                                                if (!empty($package->key_points)) {
                                                    $keyPoints = json_decode($package->key_points, true) ?? [];
                                                }
                                            ?>
                                            
                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <label><?php echo e(__('Price')); ?> (<?php echo e($currency_symbol); ?>)</label>
                                                    <input type="number" class="form-control bg-light" min="0" step="0.01"
                                                        value="<?php echo e($package->price); ?>" readonly>
                                                    <input type="hidden" name="price" value="<?php echo e($package->price); ?>">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label><?php echo e(__('Discount')); ?> (%)</label>
                                                    <input type="number" class="form-control bg-light" min="0" max="100"
                                                        step="0.01" value="<?php echo e($package->discount_in_percentage); ?>" readonly>
                                                    <input type="hidden" name="discount_in_percentage" value="<?php echo e($package->discount_in_percentage); ?>">
                                                </div>
                                            </div>

                                            
                                            <div class="row">
                                                <div class="col-md-12 form-group">
                                                    <label><?php echo e(__('Final Price')); ?> (<?php echo e($currency_symbol); ?>)</label>
                                                    <input type="number" id="final_price" class="form-control bg-light" min="0" step="0.01"
                                                        value="<?php echo e($package->final_price); ?>" readonly>
                                                    <input type="hidden" name="final_price" value="<?php echo e($package->final_price); ?>">
                                                </div>
                                            </div>

                                            
                                            <div class="row">
                                                <div class="col-lg-4 form-group">
                                                    <label><?php echo e(__('Package Duration Type')); ?></label>
                                                    <div class="form-check form-check-inline mt-2">
                                                        <input class="form-check-input package-duration-type" type="radio"
                                                            name="package_duration_type" id="package_duration_limited"
                                                            value="limited" <?php echo e($packageDurationType == 'limited' ? 'checked' : ''); ?> disabled>
                                                        <label class="form-check-label"
                                                            for="package_duration_limited"><?php echo e(__('Limited')); ?></label>
                                                    </div>
                                                    <div class="form-check form-check-inline mt-2">
                                                        <input class="form-check-input package-duration-type" type="radio"
                                                            name="package_duration_type" id="package_duration_unlimited"
                                                            value="unlimited" <?php echo e($packageDurationType == 'unlimited' ? 'checked' : ''); ?> disabled>
                                                        <label class="form-check-label"
                                                            for="package_duration_unlimited"><?php echo e(__('Unlimited')); ?></label>
                                                    </div>
                                                    <input type="hidden" name="package_duration_type" value="<?php echo e($packageDurationType); ?>">
                                                </div>
                                                <div id="package_duration_input" style="display: <?php echo e($packageDurationType == 'limited' ? 'block' : 'none'); ?>;" class="mt-2 col-lg-8">
                                                    <div class="col-md-12 form-group">
                                                        <label><?php echo e(__('Duration (Days)')); ?></label>
                                                        <input type="number" class="form-control bg-light" min="1" value="<?php echo e($packageDurationValue); ?>" readonly>
                                                        <input type="hidden" name="duration" value="<?php echo e($packageDurationValue); ?>">
                                                    </div>
                                                </div>
                                            </div>

                                            
                                            <div class="row form-group">
                                                <label><?php echo e(__('Package Type')); ?> <span class="text-danger">*</span></label>
                                                <small class="text-muted d-block mb-2"><?php echo e(__('Package type cannot be changed after creation.')); ?></small>
                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input package-type-radio"
                                                            type="radio" name="type" id="type_item_listing"
                                                            value="item_listing" <?php echo e($package->type == 'item_listing' ? 'checked' : ''); ?>

                                                            disabled>
                                                        <label class="form-check-label" for="type_item_listing">
                                                            <?php echo e(__('Ad Listing Package')); ?>

                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input package-type-radio"
                                                            type="radio" name="type" id="type_advertisement"
                                                            value="advertisement" <?php echo e($package->type == 'advertisement' ? 'checked' : ''); ?>

                                                            disabled>
                                                        <label class="form-check-label" for="type_advertisement">
                                                            <?php echo e(__('Featured Ads Package')); ?>

                                                        </label>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="type" id="package_type"
                                                    value="<?php echo e($package->type); ?>">
                                            </div>

                                            
                                            <div id="ad_listing_section"
                                                style="display: <?php echo e($package->type == 'item_listing' ? 'block' : 'none'); ?>;"
                                                class="border rounded p-3 mb-3 bg-light">
                                                <h6 class="mb-3"><?php echo e(__('Ad Listing Package Settings')); ?> <small class="text-muted">(<?php echo e(__('View Only')); ?>)</small></h6>

                                                
                                                <div class="form-group mb-3">
                                                    <label><?php echo e(__('Item Limit')); ?></label>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input ads-item-limit-type" type="radio"
                                                            name="ads_item_limit_type" id="ads_limit_limited"
                                                            value="limited" <?php echo e($adsItemLimitType == 'limited' ? 'checked' : ''); ?> disabled>
                                                        <label class="form-check-label"
                                                            for="ads_limit_limited"><?php echo e(__('Limited')); ?></label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input ads-item-limit-type" type="radio"
                                                            name="ads_item_limit_type" id="ads_limit_unlimited"
                                                            value="unlimited" <?php echo e($adsItemLimitType == 'unlimited' ? 'checked' : ''); ?> disabled>
                                                        <label class="form-check-label"
                                                            for="ads_limit_unlimited"><?php echo e(__('Unlimited')); ?></label>
                                                    </div>
                                                    <input type="hidden" name="ads_item_limit_type" value="<?php echo e($adsItemLimitType); ?>">
                                                    <div id="ads_item_limit_input"
                                                        style="display: <?php echo e($adsItemLimitType == 'limited' ? 'block' : 'none'); ?>;"
                                                        class="mt-2">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text myDivClass"
                                                                    style="height: 42px;">
                                                                    <span class="mySpanClass"><?php echo e(__('Number')); ?></span>
                                                                </div>
                                                            </div>
                                                            <input type="number" class="form-control" min="1"
                                                                value="<?php echo e($adsItemLimitValue); ?>" readonly>
                                                            <input type="hidden" name="ads_item_limit" value="<?php echo e($adsItemLimitValue); ?>">
                                                        </div>
                                                    </div>
                                                </div>

                                                
                                                <div class="form-group mb-3">
                                                    <label><?php echo e(__('Listing Duration Type')); ?></label>
                                                    <div class="form-check">
                                                        <input class="form-check-input ads-listing-duration-type"
                                                            type="radio" name="ads_listing_duration_type"
                                                            id="ads_listing_standard" value="standard"
                                                            <?php echo e($adsListingDurationType == 'standard' ? 'checked' : ''); ?> disabled>
                                                        <label class="form-check-label"
                                                            for="ads_listing_standard"><?php echo e(__('Standard (30 days)')); ?></label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input ads-listing-duration-type"
                                                            type="radio" name="ads_listing_duration_type"
                                                            id="ads_listing_package" value="package"
                                                            <?php echo e($adsListingDurationType == 'package' ? 'checked' : ''); ?> disabled>
                                                        <label class="form-check-label"
                                                            for="ads_listing_package"><?php echo e(__('Package')); ?></label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input ads-listing-duration-type"
                                                            type="radio" name="ads_listing_duration_type"
                                                            id="ads_listing_custom" value="custom"
                                                            <?php echo e($adsListingDurationType == 'custom' ? 'checked' : ''); ?> disabled>
                                                        <label class="form-check-label"
                                                            for="ads_listing_custom"><?php echo e(__('Custom')); ?></label>
                                                    </div>
                                                    <input type="hidden" name="ads_listing_duration_type" value="<?php echo e($adsListingDurationType); ?>">
                                                    <div id="ads_listing_duration_days_input"
                                                        style="display: <?php echo e($adsListingDurationType == 'custom' ? 'block' : 'none'); ?>;"
                                                        class="mt-2">
                                                        <div class="col-md-12 form-group">
                                                            <label><?php echo e(__('Days')); ?></label>
                                                            <input type="number" class="form-control bg-white" min="1" value="<?php echo e($adsListingDurationDays); ?>" readonly>
                                                            <input type="hidden" name="ads_listing_duration_days" value="<?php echo e($adsListingDurationDays); ?>">
                                                        </div>
                                                    </div>
                                                </div>

                                                
                                                <div class="form-group mb-0">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="is_reel_allowed" id="is_reel_allowed" value="1" disabled
                                                            <?php echo e($package->is_reel_allowed ? 'checked' : ''); ?>>
                                                        <label class="form-check-label" for="is_reel_allowed">
                                                            <?php echo e(__('Allow Video Ads Upload')); ?>

                                                        </label>
                                                    </div>
                                                    <small class="text-muted"><?php echo e(__('Users with this package can upload a Video Ad for their listings.')); ?></small>
                                                </div>
                                            </div>

                                            
                                            <div id="featured_ads_section"
                                                style="display: <?php echo e($package->type == 'advertisement' ? 'block' : 'none'); ?>;"
                                                class="border rounded p-3 mb-3 bg-light">
                                                <h6 class="mb-3"><?php echo e(__('Featured Ads Package Settings')); ?> <small class="text-muted">(<?php echo e(__('View Only')); ?>)</small></h6>

                                                
                                                <div class="form-group mb-3">
                                                    <label><?php echo e(__('Item Limit')); ?></label>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input featured-item-limit-type"
                                                            type="radio" name="featured_item_limit_type"
                                                            id="featured_limit_limited" value="limited"
                                                            <?php echo e($featuredItemLimitType == 'limited' ? 'checked' : ''); ?> disabled>
                                                        <label class="form-check-label"
                                                            for="featured_limit_limited"><?php echo e(__('Limited')); ?></label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input featured-item-limit-type"
                                                            type="radio" name="featured_item_limit_type"
                                                            id="featured_limit_unlimited" value="unlimited"
                                                            <?php echo e($featuredItemLimitType == 'unlimited' ? 'checked' : ''); ?> disabled>
                                                        <label class="form-check-label"
                                                            for="featured_limit_unlimited"><?php echo e(__('Unlimited')); ?></label>
                                                    </div>
                                                    <input type="hidden" name="featured_item_limit_type" value="<?php echo e($featuredItemLimitType); ?>">
                                                    <div id="featured_item_limit_input"
                                                        style="display: <?php echo e($featuredItemLimitType == 'limited' ? 'block' : 'none'); ?>;"
                                                        class="mt-2">
                                                        <input type="number" class="form-control" min="1"
                                                            value="<?php echo e($featuredItemLimitValue); ?>" readonly>
                                                        <input type="hidden" name="featured_item_limit" value="<?php echo e($featuredItemLimitValue); ?>">
                                                    </div>
                                                </div>

                                                
                                                <div class="form-group mb-3">
                                                    <label><?php echo e(__('Featured Ads Duration Type')); ?></label>
                                                    <div class="form-check">
                                                        <input class="form-check-input featured-ads-duration-type"
                                                            type="radio" name="featured_ads_duration_type"
                                                            id="featured_ads_standard" value="standard"
                                                            <?php echo e($featuredAdsDurationType == 'standard' ? 'checked' : ''); ?> disabled>
                                                        <label class="form-check-label"
                                                            for="featured_ads_standard"><?php echo e(__('Standard (30 days)')); ?></label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input featured-ads-duration-type"
                                                            type="radio" name="featured_ads_duration_type"
                                                            id="featured_ads_package" value="package"
                                                            <?php echo e($featuredAdsDurationType == 'package' ? 'checked' : ''); ?> disabled>
                                                        <label class="form-check-label"
                                                            for="featured_ads_package"><?php echo e(__('Package')); ?></label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input featured-ads-duration-type"
                                                            type="radio" name="featured_ads_duration_type"
                                                            id="featured_ads_custom" value="custom"
                                                            <?php echo e($featuredAdsDurationType == 'custom' ? 'checked' : ''); ?> disabled>
                                                        <label class="form-check-label"
                                                            for="featured_ads_custom"><?php echo e(__('Custom')); ?></label>
                                                    </div>
                                                    <input type="hidden" name="featured_ads_duration_type" value="<?php echo e($featuredAdsDurationType); ?>">
                                                    <div id="featured_ads_duration_days_input"
                                                        style="display: <?php echo e($featuredAdsDurationType == 'custom' ? 'block' : 'none'); ?>;"
                                                        class="mt-2">
                                                        <div class="col-md-12 form-group">
                                                            <label><?php echo e(__('Days')); ?></label>
                                                            <input type="number" class="form-control bg-white" min="1" value="<?php echo e($featuredAdsDurationDays); ?>" readonly>
                                                            <input type="hidden" name="featured_ads_duration_days" value="<?php echo e($featuredAdsDurationDays); ?>">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            
                                            <div class="form-group">
                                                <label><?php echo e(__('Key Points')); ?> (<?php echo e($lang->name); ?>)</label>
                                                <div id="key_points_container_<?php echo e($lang->id); ?>">
                                                    <?php if(!empty($keyPoints) && count($keyPoints) > 0): ?>
                                                        <?php $__currentLoopData = $keyPoints; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $keyPoint): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <div class="form-group key-point-item">
                                                                <div class="input-group">
                                                                    <input type="text" name="key_points[<?php echo e($lang->id); ?>][]"
                                                                        class="form-control"
                                                                        placeholder="<?php echo e(__('Enter key point')); ?>"
                                                                        value="<?php echo e($keyPoint); ?>">
                                                                    <button type="button"
                                                                        class="btn btn-danger remove-key-point"
                                                                        style="<?php echo e(count($keyPoints) > 1 ? '' : 'display: none;'); ?>">
                                                                        <i class="fas fa-times"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php else: ?>
                                                        <div class="form-group key-point-item">
                                                            <div class="input-group">
                                                                <input type="text" name="key_points[<?php echo e($lang->id); ?>][]"
                                                                    class="form-control"
                                                                    placeholder="<?php echo e(__('Enter key point')); ?>">
                                                                <button type="button" class="btn btn-danger remove-key-point"
                                                                    style="display: none;">
                                                                    <i class="fas fa-times"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                                <button type="button" class="btn btn-sm btn-primary mt-2 add-key-point"
                                                    data-lang-id="<?php echo e($lang->id); ?>">
                                                    <i class="fas fa-plus me-1"></i> <?php echo e(__('Add Key Point')); ?>

                                                </button>
                                            </div>

                                            
                                            <div class="form-group">
                                                <label for="icon" class="form-label"><?php echo e(__('Icon')); ?></label>
                                                <input type="file" name="icon" id="icon" class="form-control"
                                                    accept=".jpg, .jpeg, .png">
                                                <?php echo e(__('(Leave empty to keep current image)')); ?>

                                                <div class="field_img mt-2">
                                                    <img src="<?php echo e(empty($package->icon) ? asset('assets/img_placeholder.jpeg') : $package->icon); ?>"
                                                        alt="" id="blah"
                                                        class="preview-image img w-25">
                                                </div>
                                                <div class="img_error" style="color:#DC3545;"></div>
                                            </div>
                                        <?php else: ?>
                                            <?php
                                                $translatedKeyPoints = [];
                                                if (!empty($package->translations)) {
                                                    $kpTrans = $package->translations->where('language_id', $lang->id)->where('key', 'key_points')->first();
                                                    if ($kpTrans && !empty($kpTrans->value)) {
                                                        $translatedKeyPoints = json_decode($kpTrans->value, true) ?? [];
                                                    }
                                                }
                                            ?>
                                            
                                            <div class="form-group">
                                                <label><?php echo e(__('Key Points')); ?> (<?php echo e($lang->name); ?>)</label>
                                                <div id="key_points_container_<?php echo e($lang->id); ?>">
                                                    <?php if(!empty($translatedKeyPoints) && count($translatedKeyPoints) > 0): ?>
                                                        <?php $__currentLoopData = $translatedKeyPoints; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $keyPoint): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <div class="form-group key-point-item">
                                                                <div class="input-group">
                                                                    <input type="text" name="key_points[<?php echo e($lang->id); ?>][]"
                                                                        class="form-control"
                                                                        placeholder="<?php echo e(__('Enter key point')); ?>"
                                                                        value="<?php echo e($keyPoint); ?>">
                                                                    <button type="button"
                                                                        class="btn btn-danger remove-key-point"
                                                                        style="<?php echo e(count($translatedKeyPoints) > 1 ? '' : 'display: none;'); ?>">
                                                                        <i class="fas fa-times"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php else: ?>
                                                        <div class="form-group key-point-item">
                                                            <div class="input-group">
                                                                <input type="text" name="key_points[<?php echo e($lang->id); ?>][]"
                                                                    class="form-control"
                                                                    placeholder="<?php echo e(__('Enter key point')); ?>">
                                                                <button type="button" class="btn btn-danger remove-key-point"
                                                                    style="display: none;">
                                                                    <i class="fas fa-times"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                                <button type="button" class="btn btn-sm btn-primary mt-2 add-key-point"
                                                    data-lang-id="<?php echo e($lang->id); ?>">
                                                    <i class="fas fa-plus me-1"></i> <?php echo e(__('Add Key Point')); ?>

                                                </button>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-sm-12">
                    <input type="hidden" name="is_global" value="<?php echo e($package->is_global); ?>">

                    <?php echo $__env->make('category.category-scope', [
                        'categories' => $categories,
                        'selected_categories' => $selected_categories,
                        'selected_all_categories' => $selected_all_categories,
                        'wrapper_id' => 'category_selection_scope',
                        'disabled' => true,
                        'subtitle' => __('Select the categories where this Package Should be Applied'),
                        'show_global' => true,
                        'global_id' => 'is_global',
                        'global_field_name' => 'is_global_display',
                        'global_checked' => $package->is_global == 1,
                        'global_label' => __('Global (Apply to All Categories)'),
                    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>

                
                

                <div class="col-md-12 text-end mb-3">
                    <input type="submit" class="btn btn-primary" value="<?php echo e(__('Save and Back')); ?>">
                </div>
            </div>
        </form>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        $(document).ready(function() {
            // Package type radio buttons are read-only in edit mode; only toggle section visibility.
            $('.package-type-radio').on('change', function() {
                const selectedType = $(this).val();

                if (selectedType === 'item_listing') {
                    $('#ad_listing_section').show();
                    $('#featured_ads_section').hide();
                    $('#is_global').prop('disabled', true);
                    $('.category-checkbox').prop('disabled', true);
                    if ($('#is_global').is(':checked')) {
                        $('#category_selection').hide();
                    } else {
                        $('#category_selection').show();
                    }
                } else if (selectedType === 'advertisement') {
                    $('#ad_listing_section').hide();
                    $('#featured_ads_section').show();
                    $('#is_global').prop('checked', true).prop('disabled', true);
                    $('.category-checkbox').prop('checked', false).prop('disabled', true);
                    $('#category_selection').hide();
                }
            });
            
            // Initialize on page load
            const currentPackageType = $('#package_type').val();
            if (currentPackageType) {
                $('.package-type-radio[value="' + currentPackageType + '"]').trigger('change');
            }
            // Sync category selection visibility based on is_global state after init
            $('#is_global').trigger('change');

            // Ad listing item limit toggle
            $('.ads-item-limit-type').on('change', function() {
                if ($(this).val() === 'limited') {
                    $('#ads_item_limit_input').show();
                } else {
                    $('#ads_item_limit_input').hide();
                }
            });

            // Ad listing duration type toggle
            $('.ads-listing-duration-type').on('change', function() {
                if ($(this).val() === 'custom') {
                    $('#ads_listing_duration_days_input').show();
                } else {
                    $('#ads_listing_duration_days_input').hide();
                }
            });

            // Featured item limit toggle
            $('.featured-item-limit-type').on('change', function() {
                if ($(this).val() === 'limited') {
                    $('#featured_item_limit_input').show();
                } else {
                    $('#featured_item_limit_input').hide();
                }
            });

            // Featured ads duration type toggle
            $('.featured-ads-duration-type').on('change', function() {
                if ($(this).val() === 'custom') {
                    $('#featured_ads_duration_days_input').show();
                } else {
                    $('#featured_ads_duration_days_input').hide();
                }
            });

            // Package duration type toggle
            $('.package-duration-type').on('change', function() {
                if ($(this).val() === 'limited') {
                    $('#package_duration_input').show();
                    $('#package_duration_input input[name="duration"]').attr('data-parsley-required', 'true');
                } else {
                    $('#package_duration_input').hide();
                    $('#package_duration_input input[name="duration"]').removeAttr('data-parsley-required');
                }
            });

            // Add key point
            $(document).on('click', '.add-key-point', function() {
                const langId = $(this).data('lang-id');
                const container = $('#key_points_container_' + langId);
                const newPoint = container.find('.key-point-item').first().clone();
                newPoint.find('input').val('');
                newPoint.find('.remove-key-point').show();
                container.append(newPoint);
                updateRemoveButtons();
            });

            // Remove key point
            $(document).on('click', '.remove-key-point', function() {
                const container = $(this).closest('#key_points_container_' + $(this).closest('.tab-pane')
                    .find('input[name="languages[]"]').val());
                if ($(this).closest('.key-point-item').siblings('.key-point-item').length > 0) {
                    $(this).closest('.key-point-item').remove();
                    updateRemoveButtons();
                }
            });

            function updateRemoveButtons() {
                $('.key-point-item').each(function() {
                    const container = $(this).closest('#key_points_container_' + $(this).closest(
                        '.tab-pane').find('input[name="languages[]"]').val());
                    const count = container.find('.key-point-item').length;
                    container.find('.remove-key-point').toggle(count > 1);
                });
            }

            // Global package toggle
            $('#is_global').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#category_selection').hide();
                    $('.category-checkbox').prop('checked', false);
                } else {
                    $('#category_selection').show();
                }
            });

            // Image preview functionality
            $('#icon').on('change', function() {
                const [file] = this.files;
                if (file) {
                    $('#blah').attr('src', URL.createObjectURL(file));
                }
            });

            // Initialize category selection state based on current package type
            if (currentPackageType === 'advertisement') {
                // Disable all category checkboxes for featured ads
                $('.category-checkbox').prop('disabled', true);
            }

            // Auto-calculate final price based on price and discount
            function calculateFinalPrice() {
                const price = parseFloat($('input[name="price"]').val()) || 0;
                const discount = parseFloat($('input[name="discount_in_percentage"]').val()) || 0;
                
                if (price > 0 && discount >= 0 && discount <= 100) {
                    const discountAmount = (price * discount) / 100;
                    const finalPrice = price - discountAmount;
                    $('#final_price').val(finalPrice.toFixed(2));
                }
            }

            $('input[name="price"], input[name="discount_in_percentage"]').on('input', calculateFinalPrice);
        });

        function afterPackageUpdate() {
            setTimeout(function() {
                window.location.href = "<?php echo e(route('package.index')); ?>";
            }, 1000)
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/packages/edit.blade.php ENDPATH**/ ?>