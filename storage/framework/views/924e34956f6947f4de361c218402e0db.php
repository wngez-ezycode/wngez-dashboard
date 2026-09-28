<?php $__env->startSection('title'); ?>
    <?php echo e(__('Web Settings')); ?>

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
        <form class="create-form-without-reset" action="<?php echo e(route('settings.store')); ?>" method="post" enctype="multipart/form-data" data-success-function="successFunction" data-parsley-validate>
            <?php echo csrf_field(); ?>
            <div class="row d-flex mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="divider pt-3">
                        <h6 class="divider-text"><?php echo e(__('Web Settings')); ?></h6>
                    </div>
                    <div class="row">
                        <input type="hidden" name="web_setup" value="1">

                        <div class="form-group col-md-6 col-lg-3">
                            <label for="web_url" class="form-label"><?php echo e(__('Web URL')); ?></label>
                            <input id="web_url" name="web_url" type="url" class="form-control" placeholder="<?php echo e(__('Web URL')); ?>" value="<?php echo e($settings['web_url'] ?? ''); ?>" required>
                        </div>

                        <div class="form-group col-md-6 col-lg-3 d-flex align-items-center justify-content-center flex-column">
                            <label for="web_theme_color" class="form-label"><?php echo e(__('Theme Color')); ?></label>
                            <input id="web_theme_color" name="web_theme_color" type="color" class="form-control form-control-color" placeholder="<?php echo e(__('Theme Color')); ?>" value="<?php echo e($settings['web_theme_color'] ?? ''); ?>">
                        </div>

                        <div class="form-group col-md-6 col-lg-3 d-flex align-items-center justify-content-center flex-column">
                            <label class="form-label"><?php echo e(__('Show Landing Page')); ?></label>
                            <div class="form-check form-switch">
                                <input type="hidden" name="show_landing_page" value="0">
                                <input class="form-check-input" type="checkbox" id="show_landing_page" name="show_landing_page" value="1" <?php echo e(isset($settings['show_landing_page']) && $settings['show_landing_page'] == 1 ? 'checked' : ''); ?>>
                                <label class="form-check-label" for="show_landing_page">
                                    <?php echo e(__('On / Off')); ?>

                                </label>
                            </div>
                        </div>

                        <div class="form-group col-md-6 col-sm-12">
                            <label class="form-label "><?php echo e(__('Header Logo')); ?></label>
                            <input class="filepond" type="file" name="header_logo" id="header_logo">
                            <img src="<?php echo e($settings['header_logo'] ?? ''); ?>" data-custom-image="<?php echo e(asset('assets/images/logo/Header Logo.svg')); ?>" class="w-25" alt="image">
                        </div>

                        <div class="form-group col-md-6 col-sm-12">
                            <label class="form-label "><?php echo e(__('Footer Logo')); ?></label>
                            <input class="filepond" type="file" name="footer_logo" id="footer_logo">
                            <img src="<?php echo e($settings['footer_logo'] ?? ''); ?>" data-custom-image="<?php echo e(asset('assets/images/logo/Footer Logo.svg')); ?>" class="w-25" alt="image">
                        </div>

                        <div class="form-group col-md-6 col-sm-12">
                            <label class="form-label "><?php echo e(__('Placeholder image')); ?> <small><?php echo e(__('(This image will be displayed if no image is available.)')); ?></small></label>
                            <input class="filepond" type="file" name="placeholder_image" id="placeholder_image">
                            <img src="<?php echo e($settings['placeholder_image'] ?? ''); ?>" data-custom-image="<?php echo e(asset('assets/images/logo/favicon.png')); ?>" alt="image" style="height: 31%;width: 21%;">
                        </div>

                        <div class="form-group col-md-6 col-sm-12">
                            <label for="footer_description" class="form-label "><?php echo e(__('Footer Description')); ?></label>
                            <textarea id="footer_description" name="footer_description" class="form-control" rows="5" placeholder="<?php echo e(__('Footer Description')); ?>"><?php echo e($settings['footer_description'] ?? ''); ?></textarea>
                        </div>

                        <div class="form-group col-md-6 col-sm-12">
                            <label for="google_map_iframe_link" class="form-label "><?php echo e(__('Google Map Iframe Link')); ?></label>
                            <textarea id="google_map_iframe_link" name="google_map_iframe_link" type="text" class="form-control" rows="5" placeholder="<?php echo e(__('Google Map Iframe Link')); ?>"><?php echo e($settings['google_map_iframe_link'] ?? ''); ?></textarea>
                        </div>

                         <?php if($languages_translate->isNotEmpty()): ?>
                        <div class="col-md-12 mt-3">
                            <hr>
                            <h5><?php echo e(__("Translations") . " (" . __("Optional") . ")"); ?></h5>
                        </div>

                        <?php $__currentLoopData = $languages_translate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-6 mb-4 p-3 rounded">
                                <h6 class="mb-3 text-primary">
                                    <?php echo e(__("Translation for")); ?>: <strong><?php echo e($language->name); ?> (<?php echo e($language->code); ?>)</strong>
                                </h6>

                                <input type="hidden" name="translations[<?php echo e($language->id); ?>][name]" value="footer_description">

                                <div class="form-group">
                                    <label for="translation_<?php echo e($language->id); ?>" class="form-label">
                                        <?php echo e(__("Translated Footer Description")); ?>

                                    </label>
                                    <textarea class="form-control"
                                              name="translations[<?php echo e($language->id); ?>][value]"
                                              rows="4"
                                              placeholder="<?php echo e(__('Contact Us in') . ' ' . $language->name); ?>">
                                        <?php echo e(old("translations.{$language->id}.value", $translations['footer_description'][$language->id] ?? '')); ?>

                                    </textarea>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                    <div class="divider pt-3">
                        <h6 class="divider-text"><?php echo e(__('Social Media Links')); ?></h6>
                    </div>
                    <div class="form-group col-sm-12 col-md-4">
                        <label for="instagram_link" class="form-label "><?php echo e(__('Instagram Link')); ?></label>
                        <input id="instagram_link" name="instagram_link" type="url" class="form-control" placeholder="<?php echo e(__('Instagram Link')); ?>" value="<?php echo e($settings['instagram_link'] ?? ''); ?>">
                    </div>
                    <div class="form-group col-sm-12 col-md-4">
                        <label for="x_link" class="form-label "><?php echo e(__('X Link')); ?></label>
                        <input id="x_link" name="x_link" type="url" class="form-control" placeholder="<?php echo e(__('X Link')); ?>" value="<?php echo e($settings['x_link'] ?? ''); ?>">
                    </div>
                    <div class="form-group col-sm-12 col-md-4">
                        <label for="facebook_link" class="form-label "><?php echo e(__('Facebook Link')); ?></label>
                        <input id="facebook_link" name="facebook_link" type="url" class="form-control" placeholder="<?php echo e(__('Facebook Link')); ?>" value="<?php echo e($settings['facebook_link'] ?? ''); ?>">
                    </div>
                    <div class="form-group col-sm-12 col-md-4">
                        <label for="linkedin_link" class="form-label "><?php echo e(__('Linkedin Link')); ?></label>
                        <input id="linkedin_link" name="linkedin_link" type="url" class="form-control" placeholder="<?php echo e(__('Linkedin Link')); ?>" value="<?php echo e($settings['linkedin_link'] ?? ''); ?>">
                    </div>
                    <div class="form-group col-sm-12 col-md-4">
                        <label for="pinterest_link" class="form-label "><?php echo e(__('Pinterest Link')); ?></label>
                        <input id="pinterest_link" name="pinterest_link" type="url" class="form-control" placeholder="<?php echo e(__('Pinterest Link')); ?>" value="<?php echo e($settings['pinterest_link'] ?? ''); ?>">
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
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/settings/web-settings.blade.php ENDPATH**/ ?>