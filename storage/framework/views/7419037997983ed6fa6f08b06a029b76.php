<?php $__env->startSection('title'); ?>
    <?php echo e(__("Edit Blogs")); ?>

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
            <a class="btn btn-primary" href="<?php echo e(route('blog.index')); ?>">< <?php echo e(__("Back to All Blogs")); ?> </a>
        </div>
        <div class="row">
            <form action="<?php echo e(route('blog.update', $blog->id)); ?>" id="blog-ajax-form" method="POST" data-parsley-validate enctype="multipart/form-data">
                <?php echo method_field('PUT'); ?>
                <?php echo csrf_field(); ?>
                <input type="hidden" name="edit_data" value="<?php echo e($blog->id); ?>">
                <div class="card">
                    <div class="card-header"><?php echo e(__("Edit Blogs")); ?></div>
                    <div class="card-body mt-3">
                        <ul class="nav nav-tabs" id="languageTabs" role="tablist">
                            <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link <?php echo e($lang->id == $defaultLanguage->id ? 'active' : ''); ?>" data-bs-toggle="tab" href="#lang-<?php echo e($lang->id); ?>">
                                        <?php echo e($lang->name); ?>

                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>

                        <div class="tab-content mt-3">
                            <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $isDefault = $lang->id == $defaultLanguage->id;
                                    $trans = isset($translations) ? ($translations instanceof \Illuminate\Support\Collection ? $translations->get($lang->id) : ($translations[$lang->id] ?? null)) : null;
                                    if ($isDefault) {
                                        $tagsRaw = $blog->tags ?? '';
                                    } else {
                                        $tagsRaw = $trans->tags ?? '';
                                    }
                                    if (is_string($tagsRaw)) {
                                        $decoded = json_decode($tagsRaw, true);
                                        $tagsArr = is_array($decoded) ? $decoded : array_filter(array_map('trim', explode(',', $tagsRaw)));
                                    } else {
                                        $tagsArr = is_array($tagsRaw) ? $tagsRaw : [];
                                    }
                                ?>
                                <div class="tab-pane fade <?php echo e($isDefault ? 'show active' : ''); ?>" id="lang-<?php echo e($lang->id); ?>">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo e(__("Title")); ?> (<?php echo e($lang->name); ?>) <?php if($isDefault): ?><span class="text-danger">*</span><?php endif; ?></label>
                                                <?php if($isDefault): ?>
                                                    <input type="text" name="title" class="form-control" data-parsley-required="true" value="<?php echo e($blog->title ?? ''); ?>">
                                                <?php else: ?>
                                                    <input type="text" name="translations[<?php echo e($lang->id); ?>][title]" class="form-control" value="<?php echo e($trans->title ?? ''); ?>">
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <?php if($isDefault): ?>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label><?php echo e(__("Slug")); ?> </label>
                                                    <input type="text" name="slug" class="form-control" data-parsley-pattern="^[a-z0-9]+(?:-[a-z0-9]+)*$" value="<?php echo e($blog->slug ?? ''); ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label><?php echo e(__("Image")); ?></label>
                                                    <?php if(!empty($blog->image)): ?>
                                                        <img src="<?php echo e($blog->image); ?>" alt="Image" style="max-height: 100px;" class="mb-2 d-block">
                                                    <?php endif; ?>
                                                    <input type="file" name="image" class="form-control" accept=".jpg,.jpeg,.png">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label><?php echo e(__("Category")); ?> <span class="text-danger">*</span></label>
                                                    <select name="category_id" class="form-control select-search" data-placeholder="<?php echo e(__('Select Category')); ?>" data-parsley-required="true">
                                                        <option value=""><?php echo e(__('Select Category')); ?></option>
                                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($category->id); ?>" <?php echo e($blog->category_id == $category->id ? 'selected' : ''); ?>><?php echo e($category->name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo e(__("Tags")); ?> (<?php echo e($lang->name); ?>) <?php if($isDefault): ?><span class="text-danger">*</span><?php endif; ?></label>
                                                <?php if($isDefault): ?>
                                                    <select name="tags[]" data-tags="true" data-placeholder="<?php echo e(__("Tags")); ?>" data-allow-clear="true" class="select-search col-12 w-100" multiple="multiple" data-parsley-required="true">
                                                        <?php $__currentLoopData = $tagsArr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($tag); ?>" selected><?php echo e($tag); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                <?php else: ?>
                                                    <select name="translations[<?php echo e($lang->id); ?>][tags][]" data-tags="true" data-placeholder="<?php echo e(__("Tags")); ?>" data-allow-clear="true" class="select-search col-12 w-100" multiple="multiple">
                                                        <?php $__currentLoopData = $tagsArr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($tag); ?>" selected><?php echo e($tag); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label><?php echo e(__("Description")); ?> (<?php echo e($lang->name); ?>) <?php if($isDefault): ?><span class="text-danger">*</span><?php endif; ?></label>
                                                <?php if($isDefault): ?>
                                                    <textarea name="blog_description" id="tinymce_editor_<?php echo e($lang->id); ?>" class="tinymce_editor form-control" rows="5" data-parsley-required="true"><?php echo e($blog->description ?? ''); ?></textarea>
                                                <?php else: ?>
                                                    <textarea name="translations[<?php echo e($lang->id); ?>][description]" id="tinymce_editor_<?php echo e($lang->id); ?>" class="tinymce_editor form-control" rows="5"><?php echo e($trans->description ?? ''); ?></textarea>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <?php echo $__env->make('components.seo-fields', ['lang' => $lang, 'seoTranslations' => $seoTranslations ?? []], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                    </div>
                </div>
                <div class="col-md-12 text-end">
                    <input type="submit" class="btn btn-primary" value="<?php echo e(__("Save and Back")); ?>">
                </div>
            </form>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script>
    document.addEventListener("DOMContentLoaded", () => {
        tinymce.init({
            selector: '.tinymce_editor',
            height: 400,
            menubar: false,
            plugins: [
                'advlist autolink lists link charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime table paste code help wordcount'
            ],
            toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist | removeformat | code',
            setup: function (editor) {
                editor.on("change keyup", function () {
                    editor.save();
                });
            }
        });

        const tabs = document.querySelectorAll('a[data-bs-toggle="tab"]');
        tabs.forEach(tab => {
            tab.addEventListener('shown.bs.tab', () => {
                tinymce.execCommand('mceRemoveEditor', false, null);
                tinymce.init({
                    selector: '.tinymce_editor',
                    height: 400,
                    menubar: false,
                    plugins: 'lists link image table code',
                    toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | bullist numlist | code'
                });
            });
        });
    });

    $(function() {
        const $form = $('#blog-ajax-form');
        if ($form.length && typeof $form.parsley === 'function') {
            $form.parsley().on('form:error', function() {
                const $firstErr = $form.find('.parsley-error, [data-parsley-error]').first();
                if (!$firstErr.length) return;
                const $pane = $firstErr.closest('.tab-pane');
                if (!$pane.length) return;
                const tabTrigger = document.querySelector(`a[data-bs-toggle="tab"][href="#${$pane.attr('id')}"]`);
                if (tabTrigger && window.bootstrap && bootstrap.Tab) {
                    bootstrap.Tab.getOrCreateInstance(tabTrigger).show();
                } else if (tabTrigger) {
                    $(tabTrigger).tab('show');
                }
                setTimeout(() => {
                    $firstErr[0].scrollIntoView({ behavior: 'smooth', block: 'center' });
                }, 200);
            });
        }
    });

    $(document).on('submit', '#blog-ajax-form', function (e) {
        e.preventDefault();
        let formElement = $(this);
        let submitButtonElement = $(this).find(':submit');
        if (typeof tinymce !== 'undefined') { tinymce.triggerSave(); }
        let data = new FormData(this);
        function successCallback(response) {
            setTimeout(function () {
                let url = (response && response.data && response.data.redirect_url) ? response.data.redirect_url : "<?php echo e(route('blog.index')); ?>";
                window.location.href = url;
            }, 800);
        }
        formAjaxRequest('POST', $(this).attr('action'), data, formElement, submitButtonElement, successCallback);
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/blog/edit.blade.php ENDPATH**/ ?>