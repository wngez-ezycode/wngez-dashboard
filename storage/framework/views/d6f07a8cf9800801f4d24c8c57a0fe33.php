<?php $__env->startSection('title'); ?>
    <?php echo e(__('System Settings')); ?>

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
        <form class="create-form-without-reset" action="<?php echo e(route('settings.store')); ?>" method="post"
            enctype="multipart/form-data" data-success-function="successFunction" data-parsley-validate>
            <?php echo csrf_field(); ?>
            <div class="row d-flex mb-3">
                <div class="col-md-4 d-flex">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="divider pt-3">
                                <h6 class="divider-text"><?php echo e(__('Company Details')); ?></h6>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 form-group mandatory">
                                    <label for="company_name"
                                        class="col-sm-6 col-md-6 form-label mt-1"><?php echo e(__('Company Name')); ?></label>
                                    <input name="company_name" type="text" class="form-control" id="company_name"
                                        placeholder="<?php echo e(__('Company Name')); ?>" value="<?php echo e($settings['company_name'] ?? ''); ?>"
                                        required>
                                </div>
                                <div class="col-sm-12 form-group mandatory">
                                    <label for="company_email"
                                        class="col-sm-12 col-md-6 form-label mt-1"><?php echo e(__('Email')); ?></label>
                                    <input id="company_email" name="company_email" type="email" class="form-control"
                                        placeholder="<?php echo e(__('Email')); ?>" value="<?php echo e($settings['company_email'] ?? ''); ?>"
                                        required>
                                </div>

                                <div class="col-sm-12 form-group mandatory">
                                    <label for="company_tel1"
                                        class="col-sm-12 col-md-6 form-label mt-1"><?php echo e(__('Contact Number') . ' 1'); ?></label>
                                    <input id="company_tel1" name="company_tel1" type="text" class="form-control"
                                        placeholder="<?php echo e(__('Contact Number') . ' 1'); ?>" maxlength="16"
                                        onKeyDown="if(this.value.length==16 && event.keyCode!=8) return false;"
                                        value="<?php echo e($settings['company_tel1'] ?? ''); ?>" required>
                                </div>

                                <div class="col-sm-12">
                                    <label for="company_tel2"
                                        class="col-sm-12 col-md-6 form-label mt-1"><?php echo e(__('Contact Number') . ' 2'); ?></label>
                                    <input id="company_tel2" name="company_tel2" type="text" class="form-control"
                                        placeholder="<?php echo e(__('Contact Number') . ' 2'); ?>" maxlength="16"
                                        onKeyDown="if(this.value.length==16 && event.keyCode!=8) return false;"
                                        value="<?php echo e($settings['company_tel2'] ?? ''); ?>">
                                </div>

                                <div class="col-sm-12">
                                    <label for="company_address"
                                        class="col-sm-12 col-md-6 form-label mt-1"><?php echo e(__('Address')); ?></label>
                                    <textarea id="company_address" name="company_address" type="text" class="form-control"
                                        placeholder="<?php echo e(__('Address')); ?>"><?php echo e($settings['company_address'] ?? ''); ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="col-md-8 d-flex">
                    <div class="card h-100 w-100">
                        <div class="card-body">
                            <div class="divider pt-3">
                                <h6 class="divider-text"><?php echo e(__('More Setting')); ?></h6>
                            </div>
                            <div class="row">
                                
                                <div class="form-group col-sm-12 col-md-6 col-xs-12 mandatory">
                                    <label for="default_language" class="form-label "><?php echo e(__('Default Language')); ?></label>
                                    <select name="default_language" id="default_language"
                                        class="form-select form-control-sm">
                                        <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php echo e($row); ?>

                                            <option value="<?php echo e($row->code); ?>"
                                                <?php echo e(isset($settings['default_language']) && $settings['default_language'] == $row->code ? 'selected' : ''); ?>>
                                                <?php echo e($row->name); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                
                                <div class="form-group col-sm-12 col-md-6">
                                    <label for="android_version" class="form-label "><?php echo e(__('Android Version')); ?></label>
                                    <input id="android_version" name="android_version" type="text" class="form-control" placeholder="<?php echo e(__('Android Version')); ?>" value="<?php echo e(isset($settings['android_version']) ? $settings['android_version'] : ''); ?>" required="">
                                </div>

                                
                                <div class="form-group col-sm-12 col-md-6">
                                    <label for="play_store_link" class="form-label "><?php echo e(__('Play Store Link')); ?></label>
                                    <input id="play_store_link" name="play_store_link" type="url" class="form-control" placeholder="<?php echo e(__('Play Store Link')); ?>" value="<?php echo e($settings['play_store_link'] ?? ''); ?>">
                                </div>

                                
                                <div class="form-group col-sm-12 col-md-6">
                                    <label for="ios_version" class="form-label "><?php echo e(__('IOS Version')); ?></label>
                                    <input id="ios_version" name="ios_version" type="text" class="form-control" placeholder="<?php echo e(__('IOS Version')); ?>" value="<?php echo e($settings['ios_version'] ?? ''); ?>" required="">
                                </div>

                                
                                <div class="form-group col-sm-12 col-md-6">
                                    <label for="app_store_link" class="form-label "><?php echo e(__('App Store Link')); ?></label>
                                    <input id="app_store_link" name="app_store_link" type="url" class="form-control" placeholder="<?php echo e(__('App Store Link')); ?>" value="<?php echo e($settings['app_store_link'] ?? ''); ?>">
                                </div>

                                
                                <div class="form-group col-sm-12 col-md-6">
                                    <label class="form-label"><?php echo e(__('Force Update App')); ?></label>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="force_update" id="force_update" class="checkbox-toggle-switch-input" value="<?php echo e(isset($settings['force_update']) ? (int) $settings['force_update'] : 0); ?>">
                                        <input class="form-check-input checkbox-toggle-switch" type="checkbox" role="switch" <?php echo e(isset($settings['force_update']) && (int) $settings['force_update'] === 1 ? 'checked' : ''); ?> id="switch_force_update">
                                        <label class="form-check-label" for="switch_force_update"></label>
                                    </div>
                                </div>

                                
                                <div class="form-group col-sm-12 col-md-6">
                                    <label class="form-label "><?php echo e(__('Android Maintenance Mode')); ?></label>
                                    <i class="fa fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('Temporary disable Android app.')); ?>" aria-label="<?php echo e(__('Temporary disable Android app.')); ?>"></i>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="android_maintenance_mode" id="android_maintenance_mode" class="checkbox-toggle-switch-input" value="<?php echo e($settings['android_maintenance_mode'] ?? 0); ?>">
                                        <input class="form-check-input checkbox-toggle-switch" type="checkbox" role="switch" <?php echo e(isset($settings['android_maintenance_mode']) && $settings['android_maintenance_mode'] == '1' ? 'checked' : ''); ?> id="switch_android_maintenance_mode">
                                        <label class="form-check-label" for="switch_android_maintenance_mode"></label>
                                    </div>
                                </div>

                                
                                <div class="form-group col-sm-12 col-md-6">
                                    <label class="form-label "><?php echo e(__('IOS Maintenance Mode')); ?></label>
                                    <i class="fa fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('Temporary disable IOS app.')); ?>" aria-label="<?php echo e(__('Temporary disable IOS app.')); ?>"></i>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="ios_maintenance_mode" id="ios_maintenance_mode" class="checkbox-toggle-switch-input" value="<?php echo e($settings['ios_maintenance_mode'] ?? 0); ?>">
                                        <input class="form-check-input checkbox-toggle-switch" type="checkbox" role="switch" <?php echo e(isset($settings['ios_maintenance_mode']) && $settings['ios_maintenance_mode'] == '1' ? 'checked' : ''); ?> id="switch_ios_maintenance_mode">
                                        <label class="form-check-label" for="switch_ios_maintenance_mode"></label>
                                    </div>
                                </div>

                                
                                <div class="form-group col-sm-12 col-md-6">
                                    <label class="form-label "><?php echo e(__('Web Maintenance Mode')); ?></label>
                                    <i class="fa fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('Temporary disable website.')); ?>" aria-label="<?php echo e(__('Temporary disable website.')); ?>"></i>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="web_maintenance_mode" id="web_maintenance_mode" class="checkbox-toggle-switch-input" value="<?php echo e($settings['web_maintenance_mode'] ?? 0); ?>">
                                        <input class="form-check-input checkbox-toggle-switch" type="checkbox" role="switch" <?php echo e(isset($settings['web_maintenance_mode']) && $settings['web_maintenance_mode'] == '1' ? 'checked' : ''); ?> id="switch_web_maintenance_mode">
                                        <label class="form-check-label" for="switch_web_maintenance_mode"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="card">
                <div class="card-body">
                    <div class="divider pt-3">
                        <h6 class="divider-text"><?php echo e(__('Advertisement Settings')); ?></h6>
                    </div>
                    <div class="row">
                        
                        <div class="form-group col-md-4 col-sm-12">
                            <label class="form-check-label"><?php echo e(__('Free Ad Listing')); ?>

                                <i class="fa fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('User can post ad without purchasing a package.')); ?>" aria-label="<?php echo e(__('User can post ad without purchasing a package.')); ?>"></i>
                            </label>
                            <div class="form-check form-switch mt-2">
                                <input type="hidden" name="free_ad_listing" id="free_ad_listing" class="checkbox-toggle-switch-input" value="<?php echo e($settings['free_ad_listing'] ?? 0); ?>">
                                <input class="form-check-input checkbox-toggle-switch" type="checkbox" role="switch" id="switch_Free_ad_listing" aria-label="switch_Free_ad_listing" data-bs-toggle="tooltip" data-bs-placement="top" <?php echo e(isset($settings['free_ad_listing']) && $settings['free_ad_listing'] == '1' ? 'checked' : ''); ?>>
                            </div>
                        </div>

                        
                        <div class="col-md-8 col-sm-12" id="free_ad_duration_container" style="<?php echo e(($settings['free_ad_listing'] ?? 0) == 1 ? 'display:block;' : 'display:none;'); ?>">
                            <div class="card bg-light border p-3 mb-3">
                                <label class="form-label fw-bold mb-2"><?php echo e(__('Free Ad Listing Duration')); ?>

                                    <i class="fa fa-info-circle ms-1" data-bs-toggle="tooltip" title="<?php echo e(__('Set how long free ads remain active.')); ?>"></i>
                                </label>
                                <div class="row align-items-center">
                                    <div class="col-sm-auto col-12">
                                        <div class="form-check form-switch mb-0">
                                            <input type="hidden" name="free_ad_unlimited" value="0">
                                            <input class="form-check-input" type="checkbox" id="free_ad_unlimited" name="free_ad_unlimited" value="1" <?php echo e(($settings['free_ad_unlimited'] ?? 0) == 1 ? 'checked' : ''); ?>>
                                            <label class="form-check-label mb-0" for="free_ad_unlimited">
                                                <?php echo e(__('Unlimited')); ?>

                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm col-12 mt-2 mt-sm-0" id="free_ad_duration_input" style="<?php echo e(($settings['free_ad_unlimited'] ?? 0) == 1 ? 'display:none;' : 'display:block;'); ?>">
                                        <div class="input-group">
                                            <span class="input-group-text mySpanClass"><?php echo e(__('Days')); ?></span>
                                            <input type="number" name="free_ad_duration_days" class="form-control" min="1" value="<?php echo e($settings['free_ad_duration_days'] ?? ''); ?>" placeholder="<?php echo e(__('Enter duration in days')); ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            
                            <div class="form-group col-sm-12 col-md-6 col-xs-12">
                                <label for="max_gallery_images" class="form-label"><?php echo e(__('Max Gallery Images Per Advertisement')); ?>

                                    <i class="fa fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('Maximum number of gallery images a user can upload per advertisement.')); ?>" aria-label="<?php echo e(__('Maximum number of gallery images a user can upload per advertisement.')); ?>"></i>
                                </label>
                                <input id="max_gallery_images" name="max_gallery_images" type="number" class="form-control" min="1" max="50" placeholder="<?php echo e(__('Enter Max Gallery Images')); ?>" value="<?php echo e($settings['max_gallery_images'] ?? 5); ?>">
                            </div>

                            
                            <div class="form-group col-sm-12 col-md-6 col-xs-12">
                                <label class="form-label" for="item_video_max_file_size_mb">
                                    <?php echo e(__('Max Video File Size (MB)')); ?> <span class="text-danger">*</span>
                                </label>
                                <input type="number" name="item_video_max_file_size_mb" id="item_video_max_file_size_mb" class="form-control" min="1" max="500" data-parsley-required="true" value="<?php echo e($settings['item_video_max_file_size_mb'] ?? 50); ?>">
                                <small class="text-muted"><?php echo e(__('Maximum allowed file size for video uploads on items. (1–500 MB)')); ?></small>
                            </div>

                            
                            <div class="form-group col-sm-12 col-md-6">
                                <label class="form-check-label"><?php echo e(__('Auto Approve Advertisements')); ?>

                                    <i class="fa fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('Item will be auto approved for all users.')); ?>" aria-label="<?php echo e(__('Item will be auto approved for all users.')); ?>"></i>
                                </label>
                                <div class="form-check form-switch">
                                    <input type="hidden" name="auto_approve_item" id="auto_approve_item" class="checkbox-toggle-switch-input" value="<?php echo e($settings['auto_approve_item'] ?? 0); ?>">
                                    <input class="form-check-input checkbox-toggle-switch" type="checkbox" role="switch" id="switch_auto_approve_item" aria-label="switch_Free_ad_listing" data-bs-toggle="tooltip" data-bs-placement="top" <?php echo e(isset($settings['auto_approve_item']) && $settings['auto_approve_item'] == '1' ? 'checked' : ''); ?>>
                                </div>
                            </div>

                            
                            <div class="form-group col-sm-12 col-md-6">
                                <label class="form-check-label"><?php echo e(__('Auto Approve Edited Advertisements')); ?>

                                    <i class="fa fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('Edited item will be auto approved for all users.')); ?>" aria-label="<?php echo e(__('Edited item will be auto approved for all users.')); ?>"></i>
                                </label>
                                <div class="form-check form-switch">
                                    <input type="hidden" name="auto_approve_edited_item" id="auto_approve_edited_item" class="checkbox-toggle-switch-input" value="<?php echo e($settings['auto_approve_edited_item'] ?? 0); ?>">
                                    <input class="form-check-input checkbox-toggle-switch" type="checkbox" role="switch" id="switch_auto_approve_edited_item" aria-label="switch_Free_ad_listing" data-bs-toggle="tooltip" data-bs-placement="top" <?php echo e(isset($settings['auto_approve_edited_item']) && $settings['auto_approve_edited_item'] == '1' ? 'checked' : ''); ?>>
                                </div>
                            </div>

                            
                            <div class="form-group col-lg-6 col-xl-4">
                                <label for="general_item_sorting" class="form-label "><?php echo e(__('General Item Sorting')); ?></label>
                                <select name="general_item_sorting" id="general_item_sorting" class="form-select form-control-sm">
                                    <?php if(isset($settings['general_item_sorting']) && !empty($settings['general_item_sorting'])): ?>
                                        <option value="latest" <?php echo e($settings['general_item_sorting'] == 'latest' ? 'selected' : ''); ?>><?php echo e(__('Latest')); ?></option>
                                        <option value="oldest" <?php echo e($settings['general_item_sorting'] == 'oldest' ? 'selected' : ''); ?>><?php echo e(__('Oldest')); ?></option>
                                        <option value="random" <?php echo e($settings['general_item_sorting'] == 'random' ? 'selected' : ''); ?>><?php echo e(__('Random')); ?></option>
                                    <?php else: ?>
                                        <option value="latest"><?php echo e(__('Latest')); ?></option>
                                        <option value="oldest"><?php echo e(__('Oldest')); ?></option>
                                        <option value="random" selected><?php echo e(__('Random')); ?></option>
                                    <?php endif; ?>
                                </select>
                            </div>

                            
                            <div class="form-group col-lg-6 col-xl-4">
                                <label for="feature_item_sorting" class="form-label "><?php echo e(__('Feature Item Sorting')); ?></label>
                                <select name="feature_item_sorting" id="feature_item_sorting" class="form-select form-control-sm">
                                    <?php if(isset($settings['feature_item_sorting']) && !empty($settings['feature_item_sorting'])): ?>
                                        <option value="latest" <?php echo e($settings['feature_item_sorting'] == 'latest' ? 'selected' : ''); ?>><?php echo e(__('Latest')); ?></option>
                                        <option value="oldest" <?php echo e($settings['feature_item_sorting'] == 'oldest' ? 'selected' : ''); ?>><?php echo e(__('Oldest')); ?></option>
                                        <option value="random" <?php echo e($settings['feature_item_sorting'] == 'random' ? 'selected' : ''); ?>><?php echo e(__('Random')); ?></option>
                                    <?php else: ?>
                                        <option value="latest"><?php echo e(__('Latest')); ?></option>
                                        <option value="oldest"><?php echo e(__('Oldest')); ?></option>
                                        <option value="random" selected><?php echo e(__('Random')); ?></option>
                                    <?php endif; ?>
                                </select>
                            </div>

                            
                            <div class="form-group col-lg-6 col-xl-4">
                                <label for="featured_items_weightage" class="form-label "><?php echo e(__('Featured Items Weightage (%)')); ?></label>
                                <select name="featured_items_weightage" id="featured_items_weightage" class="form-select form-control-sm">
                                    <?php $weightage = $settings['featured_items_weightage'] ?? 10; ?>
                                    <?php $__currentLoopData = [0, 10, 20, 30, 40, 50, 60, 70, 80, 90, 100]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $percent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($percent); ?>" <?php echo e($weightage == $percent ? 'selected' : ''); ?>><?php echo e($percent); ?>%</option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="card">
                <div class="card-body">
                    <div class="divider pt-3">
                        <h6 class="divider-text"><?php echo e(__('Map Settings')); ?></h6>
                    </div>
                    <div class="row">
                        
                        <div class="form-group col-lg-6">
                            <label for="map_provider" class="col-sm-12 form-check-label  mt-2"><?php echo e(__('Map Provider')); ?></label>
                            <select name="map_provider" id="map_provider" class="form-select form-control-sm">
                                <option value="google_places" <?php echo e(!empty($settings['map_provider']) && $settings['map_provider'] == 'google_places' ? 'selected' : ''); ?>><?php echo e(__('Place API')); ?></option>
                                <option value="free_api" <?php echo e(!empty($settings['map_provider']) && $settings['map_provider'] == 'free_api' ? 'selected' : ''); ?>><?php echo e(__('Free API')); ?></option>
                            </select>
                        </div>
                        
                        
                        <div class="form-group col-lg-6 position-relative has-icon-right" id="s3_div" style="display: none">
                            <label for="place_api_key" class="form-label"><?php echo e(__('Place API Key')); ?></label>
                            <input class="form-control" type="password" name="place_api_key" id="place_api_key" value="<?php echo e($settings['place_api_key'] ?? ''); ?>">
                            <div class="form-control-icon lh-1 top-0 mt-2">
                                <i class="bi bi-eye toggle-password"></i>
                            </div>
                            <small class="form-text text-muted"><?php echo e(__('Used for address search/autocomplete (Places API).')); ?></small>
                        </div>

                        
                        <div class="form-group col-lg-6 position-relative has-icon-right" id="google_map_key_div" style="display: none">
                            <label for="google_map_key" class="form-label"><?php echo e(__('Google Map Key')); ?></label>
                            <input class="form-control" type="password" name="google_map_key" id="google_map_key" value="<?php echo e($settings['google_map_key'] ?? ''); ?>">
                            <div class="form-control-icon lh-1 top-0 mt-2">
                                <i class="bi bi-eye toggle-password"></i>
                            </div>
                            <small class="form-text text-muted"><?php echo e(__('Used to render Google Maps (Maps JavaScript API key, separate from Place API Key).')); ?></small>
                        </div>

                        
                        <div class="form-group col-lg-6">
                            <label for="default_latitude" class="form-label "><?php echo e(__('Default Latitude')); ?></label>
                            <input id="default_latitude" name="default_latitude" type="text" class="form-control" placeholder="<?php echo e(__('Latitude')); ?>" value="<?php echo e($settings['default_latitude'] ?? ''); ?>">
                        </div>

                        
                        <div class="form-group col-lg-6">
                            <label for="default_longitude" class="form-label "><?php echo e(__('Default Longitude')); ?></label>
                            <input id="default_longitude" name="default_longitude" type="text" class="form-control" placeholder="<?php echo e(__('Longitude')); ?>" value="<?php echo e($settings['default_longitude'] ?? ''); ?>">
                        </div>

                        
                        <div class="form-group col-lg-6">
                            <label for="min_value" class="form-label"><?php echo e(__('Min Range')); ?> <i class="fa fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('Adding fixed minimum range for radius.(KM)')); ?>" aria-label="<?php echo e(__('Adding fixed minimum range for radius.(KM)')); ?>"></i></label>
                            <input id="min_length" name="min_length" type="number" class="form-control" placeholder="<?php echo e(__('Enter Min Length')); ?>" value="<?php echo e($settings['min_length'] ?? ''); ?>">
                        </div>

                        
                        <div class="form-group col-lg-6">
                            <label for="max_value" class="form-label"><?php echo e(__('Max Range')); ?><i class="fa fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('Adding fixed maximum range for radius.(KM)')); ?>" aria-label="<?php echo e(__('Adding fixed maximum range for radius.(KM)')); ?>"></i></label>
                            <input id="max_length" name="max_length" type="number" class="form-control" placeholder="<?php echo e(__('Enter Max Length')); ?>" value="<?php echo e($settings['max_length'] ?? ''); ?>">
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="card">
                <div class="card-body">
                    <div class="divider pt-3">
                        <h6 class="divider-text"><?php echo e(__('Images')); ?></h6>
                    </div>

                    <div class="row">
                        
                        <div class="form-group col-lg-4">
                            <label class=" col-form-label "><?php echo e(__('Favicon Icon')); ?></label>
                            <input class="filepond" type="file" name="favicon_icon" id="favicon_icon">
                            <img src="<?php echo e($settings['favicon_icon'] ?? ''); ?>" data-custom-image="<?php echo e(asset('assets/images/logo/favicon.png')); ?>" class="mt-2 favicon_icon" alt="image" style=" height: 31%;width: 21%;">
                        </div>

                        
                        <div class="form-group col-lg-4">
                            <label class="form-label "><?php echo e(__('Company Logo')); ?></label>
                            <input class="filepond" type="file" name="company_logo" id="company_logo">
                            <img src="<?php echo e($settings['company_logo'] ?? ''); ?>" data-custom-image="<?php echo e(asset('assets/images/logo/logo.png')); ?>" class="mt-2 company_logo" alt="image" style="height: 31%;width: 21%;">
                        </div>

                        
                        <div class="form-group col-lg-4">
                            <label class="form-label "><?php echo e(__('Login Page Image')); ?></label>
                            <input class="filepond" type="file" name="login_image" id="login_image">
                            <img src="<?php echo e($settings['login_image'] ?? ''); ?>" data-custom-image="<?php echo e(asset('assets/images/bg/login.jpg')); ?>" class="mt-2 login_image" alt="image" style="height: 31%;width: 21%;">
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="card">
                <div class="card-body">
                    <div class="divider pt-3">
                        <h6 class="divider-text"><?php echo e(__('Admin Panel Appearance')); ?></h6>
                    </div>
                    <div class="row mt-3">
                        
                        <div class="form-group col-lg-6">
                            <label for="admin_primary_color" class="form-label"><?php echo e(__('Primary Color')); ?><i class="fa fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('Choose the primary color for the admin panel theme')); ?>" aria-label="<?php echo e(__('Choose the primary color for the admin panel theme')); ?>"></i></label>
                            <div class="input-group">
                                <input id="admin_primary_color" name="admin_primary_color" type="color" 
                                    class="form-control form-control-color" 
                                    value="<?php echo e($settings['admin_primary_color'] ?? '#0878F9'); ?>"
                                    title="<?php echo e(__('Choose primary color')); ?>">
                                <input type="text" class="form-control" id="admin_primary_color_text" 
                                    value="<?php echo e($settings['admin_primary_color'] ?? '#0878F9'); ?>" 
                                    placeholder="#00B2CA" maxlength="7" pattern="^#[0-9A-Fa-f]{6}$">
                                <button class="btn btn-outline-secondary" type="button" id="reset_primary_color">
                                    <i class="fa fa-undo"></i> <?php echo e(__('Reset')); ?>

                                </button>
                            </div>
                            <small class="text-muted d-block mt-1">
                                <?php echo e(__('Default color: #00B2CA')); ?>

                            </small>
                        </div>

                        
                        <div class="form-group col-lg-6 d-flex align-items-center">
                            <div class="color-preview-box" style="width: 100%; height: 60px; border-radius: 8px; background-color: <?php echo e($settings['admin_primary_color'] ?? '#0878F9'); ?>; border: 2px solid #dee2e6; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; text-shadow: 1px 1px 2px rgba(0,0,0,0.3);">
                                <?php echo e(__('Color Preview')); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="card">
                <div class="card-body">
                    <div class="divider pt-3">
                        <h6 class="divider-text"><?php echo e(__('Deep Link')); ?></h6>
                    </div>
                    <div class="form-group row mt-3">
                        <div class="col-md-12">
                            <label for="scheme" class="form-label"><?php echo e(__('Deep Link Scheme')); ?></label>
                            <input id="scheme" name="deep_link_scheme" type="text" class="form-control" placeholder="e.g., myapp" pattern="^[a-z][a-z0-9]*$" title="<?php echo e(__('Must start with a letter, lowercase, and contain no spaces or special characters.')); ?>" value="<?php echo e($settings['deep_link_scheme'] ?? ''); ?>">
                            <small class="text-muted d-block mt-1"> <?php echo e(__('Must start with a letter, be lowercase, and contain no spaces or special characters.')); ?></small>
                            <small class="text-muted"><?php echo e(__('Example: ')); ?><strong>myapp://</strong></small>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="card">
                <div class="card-body">
                    <div class="divider pt-3">
                        <h6 class="divider-text"><?php echo e(__('Authentication Setting (Enable/Disable)')); ?></h6>
                    </div>
                    <div class="form-group row mt-3">
                        
                        <div class="form-group col-md-6 col-xl-3">
                            <label class="form-label"><?php echo e(__('Mobile Authentication')); ?></label>
                            <div class="form-check form-switch">
                                <input type="hidden" name="mobile_authentication" value="0">
                                <input class="form-check-input auth" type="checkbox" id="mobile_authentication" name="mobile_authentication" value="1" <?php echo e(isset($settings['mobile_authentication']) && $settings['mobile_authentication'] == 1 ? 'checked' : ''); ?>>
                                <label class="form-check-label" for="google_authentication"> <?php echo e(__('On / Off')); ?> </label>
                            </div>
                        </div>

                        
                        <div class="form-group col-md-6 col-xl-3">
                            <label class="form-label"><?php echo e(__('Google Authentication')); ?></label>
                            <div class="form-check form-switch">
                                <input type="hidden" name="google_authentication" value="0">
                                <input class="form-check-input auth" type="checkbox" id="google_authentication" name="google_authentication" value="1" <?php echo e(isset($settings['google_authentication']) && $settings['google_authentication'] == 1 ? 'checked' : ''); ?>>
                                <label class="form-check-label" for="google_authentication"> <?php echo e(__('On / Off')); ?> </label>
                            </div>
                        </div>

                        
                        <div class="form-group col-md-6 col-xl-3">
                            <label class="form-label"><?php echo e(__('Email Authentication')); ?></label>
                            <div class="form-check form-switch">
                                <input type="hidden" name="email_authentication" value="0">
                                <input class="form-check-input auth" type="checkbox" id="email_authentication" name="email_authentication" value="1" <?php echo e(isset($settings['email_authentication']) && $settings['email_authentication'] == 1 ? 'checked' : ''); ?>>
                                <label class="form-check-label" for="email_authentication"> <?php echo e(__('On / Off')); ?> </label>
                            </div>
                        </div>

                        
                        <div class="form-group col-md-6 col-xl-3">
                            <label class="form-label"><?php echo e(__('Apple Authentication')); ?></label>
                            <div class="form-check form-switch">
                                <input type="hidden" name="apple_authentication" value="0">
                                <input class="form-check-input auth" type="checkbox" id="email_authentication" name="apple_authentication" value="1" <?php echo e(isset($settings['apple_authentication']) && $settings['apple_authentication'] == 1 ? 'checked' : ''); ?>>
                                <label class="form-check-label" for="apple_authentication"> <?php echo e(__('On / Off')); ?> </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row d-flex mb-3">
                <div class="col-md-12 d-flex">
                    <div class="card h-100 w-100">
                        <div class="card-body">
                            <div class="divider pt-3">
                                <h6 class="divider-text"><?php echo e(__('Network-Adaptive Image Resizing')); ?></h6>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12 col-md-6">
                                    <label class="form-check-label"><?php echo e(__('Enable Image Resizing')); ?>

                                        <i class="fa fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('When enabled, image URLs in API responses are resized based on the X-Network-Type header sent by the app.')); ?>" aria-label="<?php echo e(__('When enabled, image URLs in API responses are resized based on the X-Network-Type header sent by the app.')); ?>"></i>
                                    </label>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="feature_image_resizing" id="feature_image_resizing" class="checkbox-toggle-switch-input" value="<?php echo e($settings['feature_image_resizing'] ?? 1); ?>">
                                        <input class="form-check-input checkbox-toggle-switch" type="checkbox" role="switch" id="switch_feature_image_resizing" <?php echo e(($settings['feature_image_resizing'] ?? 1) != '0' ? 'checked' : ''); ?>>
                                        <label class="form-check-label" for="switch_feature_image_resizing"></label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-sm-12 col-md-6">
                                    <label class="form-label d-block"><?php echo e(__('Resized Image Cache')); ?></label>
                                    <p class="mb-2">
                                        <span id="image_cache_count"><?php echo e(__('Loading...')); ?></span>
                                    </p>
                                    <button type="button" id="btn_clear_image_cache_all" class="btn btn-outline-danger btn-sm me-2"><?php echo e(__('Clear All Cache')); ?></button>
                                    <button type="button" id="btn_clear_image_cache_old" class="btn btn-outline-secondary btn-sm"><?php echo e(__('Clear Cache Older Than 7 Days')); ?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="col-12 d-flex justify-content-end">
                <button type="submit" value="btnAdd" class="btn btn-primary me-1 mb-3"><?php echo e(__('Save')); ?></button>
            </div>
        </form>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script>
        function successFunction() {
            window.location.reload();
        }


        function toggleFreeAdOptions() {
            const isFreeAdEnabled = $('#switch_Free_ad_listing').is(':checked');
            if (isFreeAdEnabled) {
                $('#free_ad_duration_container').slideDown();
                // Enable inputs to allow submitting
                $('#free_ad_duration_container').find('input').prop('disabled', false);
                
                // Also toggle the days input based on Unlimited status
                if ($('#free_ad_unlimited').is(':checked')) {
                    $('#free_ad_duration_input').hide();
                    $('#free_ad_duration_input').find('input').prop('disabled', true);
                } else {
                    $('#free_ad_duration_input').show();
                    $('#free_ad_duration_input').find('input').prop('disabled', false);
                }
            } else {
                $('#free_ad_duration_container').slideUp();
                // Disable inputs to bypass form validation
                $('#free_ad_duration_container').find('input').prop('disabled', true);
            }
        }

        $('#switch_Free_ad_listing').on('change', function () {
            toggleFreeAdOptions();
        });

        $('#free_ad_unlimited').on('change', function () {
            toggleFreeAdOptions();
        });

        // Initialize state on page load
        toggleFreeAdOptions();

        // Color picker synchronization
        const colorPicker = $('#admin_primary_color');
        const colorText = $('#admin_primary_color_text');
        const colorPreview = $('.color-preview-box');
        const defaultColor = '#00B2CA';

        // Sync color picker to text input
        colorPicker.on('input change', function() {
            const color = $(this).val().toUpperCase();
            colorText.val(color);
            colorPreview.css('background-color', color);
        });

        // Sync text input to color picker
        colorText.on('input', function() {
            let color = $(this).val().trim();
            // Add # if missing
            if (color && !color.startsWith('#')) {
                color = '#' + color;
            }
            // Validate hex color
            if (/^#[0-9A-Fa-f]{6}$/.test(color)) {
                colorPicker.val(color);
                colorPreview.css('background-color', color);
            }
        });

        // Reset to default color
        $('#reset_primary_color').on('click', function() {
            colorPicker.val(defaultColor);
            colorText.val(defaultColor);
            colorPreview.css('background-color', defaultColor);
        });

        // Image cache stats + clear
        function loadImageCacheStats() {
            $.get("<?php echo e(route('settings.image-cache.stats')); ?>", function(res) {
                const data = res.data;
                $('#image_cache_count').text(data.count + " <?php echo e(__('cached variant(s)')); ?> — " + data.size_human);
            }).fail(function() {
                $('#image_cache_count').text("<?php echo e(__('Unable to load cache stats.')); ?>");
            });
        }
        loadImageCacheStats();

        function clearImageCache(days) {
            $.ajax({
                url: "<?php echo e(route('settings.image-cache.clear')); ?>",
                method: 'POST',
                data: {
                    _token: '<?php echo e(csrf_token()); ?>',
                    days: days
                },
                success: function(res) {
                    showSuccessToast(res.message);
                    loadImageCacheStats();
                },
                error: function(xhr) {
                    showErrorToast(xhr.responseJSON?.message || "<?php echo e(__('Failed to clear cache.')); ?>");
                }
            });
        }

        $('#btn_clear_image_cache_all').on('click', function() {
            clearImageCache(null);
        });

        $('#btn_clear_image_cache_old').on('click', function() {
            clearImageCache(7);
        });

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/settings/system.blade.php ENDPATH**/ ?>