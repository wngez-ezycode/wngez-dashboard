<?php $__env->startSection('title'); ?>
    <?php echo e(__('Seo-settings')); ?>

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
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <div class="divider">
                            <div class="divider-text">
                                <h4><?php echo e(__('Seo Setting')); ?></h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row form-group">
                                <div class="col-sm-12 col-md-12 form-group">
                                    <form action="<?php echo e(route('seo-setting.store')); ?>" method="POST" enctype="multipart/form-data" data-parsley-validate class="create-form">
                                        <?php echo csrf_field(); ?>
                                        <div class="row">
                                            <div class="col-12">
                                                
                                                <div class="form-group mandatory">
                                                    <label for="page" class="form-label"><?php echo e(__('Page')); ?></label>
                                                    <select class="form-control" name="page" required>
                                                        <option value=""><?php echo e(__('Select Page')); ?></option>
                                                        <option value="home"><?php echo e(__('Home')); ?></option>
                                                        <option value="subscription"><?php echo e(__('Subscription')); ?></option>
                                                        <option value="blogs"><?php echo e(__('Blogs')); ?></option>
                                                        <option value="faqs"><?php echo e(__('Faqs')); ?></option>
                                                        <option value="ad-listing"><?php echo e(__('Ads')); ?></option>
                                                        <option value="about-us"><?php echo e(__('About us')); ?></option>
                                                        <option value="contact-us"><?php echo e(__('Contact us')); ?></option>
                                                        <option value="landing"><?php echo e(__('Landing')); ?></option>
                                                        <option value="privacy-policy"><?php echo e(__('Privacy Policy')); ?></option>
                                                         <option value="refund-policy"><?php echo e(__('Refund Policy')); ?></option>
                                                        <option value="terms-and-conditions"><?php echo e(__('Terms and Conditions')); ?></option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="image" class="form-label"><?php echo e(__('Image')); ?></label>
                                                    <input class="filepond" type="file" name="image" id="favicon_icon">
                                                </div>

                                                
                                                <ul class="nav nav-tabs mt-3" id="languageTabs" role="tablist">
                                                    <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li class="nav-item" role="presentation">
                                                            <a class="nav-link <?php echo e($loop->first ? 'active' : ''); ?>" id="tab-<?php echo e($lang->id); ?>" data-bs-toggle="tab" href="#lang-<?php echo e($lang->id); ?>" role="tab">
                                                                <?php echo e($lang->name); ?>

                                                            </a>
                                                        </li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>

                                                <div class="tab-content mt-3">
                                                    <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="tab-pane fade <?php echo e($loop->first ? 'show active' : ''); ?>" id="lang-<?php echo e($lang->id); ?>" role="tabpanel">
                                                            <input type="hidden" name="languages[]" value="<?php echo e($lang->id); ?>">

                                                            
                                                            <div class="form-group">
                                                                <label><?php echo e(__("Title")); ?> (<?php echo e($lang->name); ?>)</label>
                                                                <input type="text" name="title[<?php echo e($lang->id); ?>]" class="form-control" placeholder="<?php echo e(__('Enter Title')); ?>">
                                                            </div>

                                                            
                                                            <div class="form-group">
                                                                <label><?php echo e(__("Description")); ?> (<?php echo e($lang->name); ?>)</label>
                                                                <textarea name="description[<?php echo e($lang->id); ?>]" class="form-control" rows="3" placeholder="<?php echo e(__('Enter Description')); ?>"></textarea>
                                                            </div>

                                                            
                                                            <div class="form-group">
                                                                <label><?php echo e(__("Keywords")); ?> (<?php echo e($lang->name); ?>)</label>
                                                                <textarea name="keywords[<?php echo e($lang->id); ?>]" class="form-control" rows="2" placeholder="<?php echo e(__('Enter Keywords')); ?>"></textarea>
                                                            </div>

                                                            
                                                            <div class="form-group">
                                                                <label><?php echo e(__("Schema")); ?> (<?php echo e($lang->name); ?>)</label>
                                                                <textarea name="schema[<?php echo e($lang->id); ?>]" class="form-control" rows="4" placeholder="<?php echo e(__('Enter Schema')); ?>"></textarea>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12 d-flex justify-content-end mt-3">
                                                <button type="submit" class="btn btn-primary me-1 mb-1"><?php echo e(__('Save')); ?></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <?php
                                    $cols = [
                                        ['field'=>'id','title'=>__('ID'),'sortable'=>true],
                                        ['field'=>'page','title'=>__('Page'),'sortable'=>false],
                                        ['field'=>'title','title'=>__('Title'),'sortable'=>false],
                                        ['field'=>'description','title'=>__('Description'),'sortable'=>true],
                                        ['field'=>'keywords','title'=>__('Keywords'),'sortable'=>true],
                                        ['field'=>'schema','title'=>__('Schema'),'sortable'=>true],
                                        ['field'=>'image','title'=>__('Image'),'sortable'=>false,'formatter'=>'imageFormatter'],
                                        ['field'=>'operate','title'=>__('Action'),'escape'=>false,'sortable'=>false,'events'=>'SeoSettingEvents'],
                                    ];
                                ?>
                                <?php if (isset($component)) { $__componentOriginalc8463834ba515134d5c98b88e1a9dc03 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8463834ba515134d5c98b88e1a9dc03 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.data-table','data' => ['id' => 'table_list','url' => route('seo-setting.show',1),'clickToSelect' => true,'fixedColumns' => true,'extra' => ['data-query-params'=>'queryParams'],'columns' => $cols]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('data-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'table_list','url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('seo-setting.show',1)),'click-to-select' => true,'fixed-columns' => true,'extra' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['data-query-params'=>'queryParams']),'columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($cols)]); ?>
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

    <!-- EDIT MODEL MODEL -->
    <div id="editModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog">
            <form action="#" class="form-horizontal" id="edit-form" enctype="multipart/form-data" method="POST" data-parsley-validate>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel1"><?php echo e(__('Edit Seo Setting')); ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="col-md-12 col-12">
                                    <div class="form-group mandatory">
                                        <label for="edit_page" class="form-label col-12"><?php echo e(__('Page')); ?></label>
                                        <input type="text" id="edit_page" class="form-control col-12" placeholder="<?php echo e(__("Page")); ?>" name="page" data-parsley-required="true" disabled>
                                    </div>
                                </div>
                            </div>
                             <div class="col-sm-12 col-md-12 form-group">
                                <label class="col-form-label "><?php echo e(__('Image')); ?></label>
                                <div class="">
                                    <input class="filepond" type="file" name="image" id="edit_image">
                                </div>
                                <div id="edit_image_preview" class="mt-2"></div>
                            </div>
                            <ul class="nav nav-tabs mt-3" role="tablist">
                                <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link <?php echo e($loop->first ? 'active' : ''); ?>" id="edit-tab-<?php echo e($lang->id); ?>" data-bs-toggle="tab" href="#edit-lang-<?php echo e($lang->id); ?>" role="tab">
                                            <?php echo e($lang->name); ?>

                                        </a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>

                            <div class="tab-content mt-3">
                                <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="tab-pane fade <?php echo e($loop->first ? 'show active' : ''); ?>" id="edit-lang-<?php echo e($lang->id); ?>" role="tabpanel">
                                        <input type="hidden" name="languages[]" value="<?php echo e($lang->id); ?>">

                                        <div class="form-group">
                                            <label><?php echo e(__("Title")); ?> (<?php echo e($lang->name); ?>)</label>
                                            <input type="text" name="title[<?php echo e($lang->id); ?>]" id="edit_title_<?php echo e($lang->id); ?>" class="form-control" placeholder="<?php echo e(__('Enter Title')); ?>">
                                        </div>

                                        <div class="form-group">
                                            <label><?php echo e(__("Description")); ?> (<?php echo e($lang->name); ?>)</label>
                                            <textarea name="description[<?php echo e($lang->id); ?>]" id="edit_description_<?php echo e($lang->id); ?>" class="form-control" rows="3" placeholder="<?php echo e(__('Enter Description')); ?>"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label><?php echo e(__("Keywords")); ?> (<?php echo e($lang->name); ?>)</label>
                                            <textarea name="keywords[<?php echo e($lang->id); ?>]" id="edit_keywords_<?php echo e($lang->id); ?>" class="form-control" rows="2" placeholder="<?php echo e(__('Enter Keywords')); ?>"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label><?php echo e(__("Schema")); ?> (<?php echo e($lang->name); ?>)</label>
                                            <textarea name="schema[<?php echo e($lang->id); ?>]" id="edit_schema_<?php echo e($lang->id); ?>" class="form-control" rows="4" placeholder="<?php echo e(__('Enter Schema')); ?>"></textarea>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light"><?php echo e(__('Save')); ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script>
    const maxPixelWidth = 400;      // Adjust as needed
    const tooLongPixelWidth = 600;  // Adjust as needed

    // Reusable width calculator
    function getTextWidth(text, font) {
        const canvas = document.createElement("canvas");
        const context = canvas.getContext("2d");
        context.font = font;
        return context.measureText(text).width;
    }

    function updateMetaLength(inputId, maxPixelWidth, tooLongPixelWidth) {
        const input = $(`#${inputId}`);
        const countElement = $(`#${inputId}_count`);

        if (input.length && countElement.length) {
            const text = input.val().trim();
            let textPixelLength = Math.round(getTextWidth(text, '19.9px Arial'));

            let iconClass = 'fa-exclamation-triangle text-danger';
            let feedbackMessage = `Your Meta is too short.`;
            let feedbackColor = 'text-danger';

            if (textPixelLength >= maxPixelWidth && textPixelLength <= tooLongPixelWidth) {
                iconClass = 'fa-check-circle text-success';
                feedbackMessage = `Your Meta is an acceptable length.`;
                feedbackColor = 'text-success';
            } else if (textPixelLength > tooLongPixelWidth) {
                feedbackMessage = `Meta should be around ${tooLongPixelWidth}px in length.`;
            }

            countElement.html(`
                <i class="fa ${iconClass}"></i>
                <span><b>${textPixelLength}</b> pixels</span>
                <span class="${feedbackColor}"> -- ${feedbackMessage}</span>
            `);
        }
    }

    // Trigger check on input for each language
    $(document).ready(function () {
        <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            // Title
            $(`#meta_title_<?php echo e($lang->id); ?>`).on('input', function () {
                updateMetaLength('meta_title_<?php echo e($lang->id); ?>', maxPixelWidth, tooLongPixelWidth);
            });
            $(`#meta_description_<?php echo e($lang->id); ?>`).on('input', function () {
                updateMetaLength('meta_description_<?php echo e($lang->id); ?>', maxPixelWidth, tooLongPixelWidth);
            });

            $(`#meta_keywords_<?php echo e($lang->id); ?>`).on('input', function () {
                updateMetaLength('meta_keywords_<?php echo e($lang->id); ?>', maxPixelWidth, tooLongPixelWidth);
            });
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/settings/seo-setting.blade.php ENDPATH**/ ?>