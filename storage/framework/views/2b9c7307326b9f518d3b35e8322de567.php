<?php $__env->startSection('title'); ?>
    <?php echo e(__('Edit Email Template')); ?> - <?php echo e($displayName); ?>

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
        <div class="card">
            <form action="<?php echo e(route('settings.email-templates.store', $template)); ?>" method="post" class="create-form-without-reset">
                <?php echo csrf_field(); ?>
                <div class="card-body">
                    <?php if($template === 'email_template_new_login'): ?>
                        <div class="form-group row mb-3">
                            <div class="col-sm-12">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" 
                                           name="email_new_login_enabled" 
                                           id="email_new_login_enabled" 
                                           value="1"
                                           <?php echo e(($settings['email_new_login_enabled'] ?? '0') == '1' ? 'checked' : ''); ?>>
                                    <label class="form-check-label" for="email_new_login_enabled">
                                        <?php echo e(__('Enable New Login Email Notification')); ?>

                                    </label>
                                </div>
                                <small class="form-text text-muted">
                                    <?php echo e(__('When enabled, users will receive an email notification when a new device logs in to their account.')); ?>

                                </small>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="alert alert-warning mb-3">
                        <i class="fas fa-info-circle"></i>
                        <strong><?php echo e(__('Note:')); ?></strong>
                        <?php echo e(__('Emails will be sent using the template in the default language set in system settings.')); ?>

                        <?php
                            $defaultLangCode = $settings['default_language'] ?? 'en';
                            $defaultLang = $languages->where('code', $defaultLangCode)->first();
                        ?>
                        <?php if($defaultLang): ?>
                            <span class="badge bg-primary ms-2"><?php echo e(__('Current Default:')); ?> <?php echo e($defaultLang->name); ?></span>
                        <?php endif; ?>
                    </div>

                    <ul class="nav nav-tabs" id="languageTabs" role="tablist">
                        <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link <?php echo e($loop->first ? 'active' : ''); ?>" 
                                   id="tab-<?php echo e($lang->id); ?>"
                                   data-bs-toggle="tab" 
                                   href="#lang-<?php echo e($lang->id); ?>" 
                                   role="tab">
                                    <?php echo e($lang->name); ?>

                                </a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>

                    <div class="tab-content mt-3">
                        <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="tab-pane fade <?php echo e($loop->first ? 'show active' : ''); ?>" 
                                 id="lang-<?php echo e($lang->id); ?>" 
                                 role="tabpanel">
                                <input type="hidden" name="languages[]" value="<?php echo e($lang->id); ?>">
                                <div class="form-group">
                                    <label><?php echo e(__('Email Template Content')); ?> (<?php echo e($lang->name); ?>)</label>
                                    <textarea name="template_content[<?php echo e($lang->id); ?>]" 
                                              id="tinymce_editor_<?php echo e($lang->id); ?>" 
                                              class="tinymce_editor form-control" 
                                              rows="10"><?php echo e(old("template_content.$lang->id", $translations[$template][$lang->id] ?? ($templateValue ?? ''))); ?></textarea>
                                </div>
                                
                                <div class="alert alert-info mt-2">
                                    <strong><?php echo e(__('Available Variables:')); ?></strong>
                                    <small class="d-block text-muted mb-2"><?php echo e(__('Click on any variable to insert it into the template')); ?></small>
                                    <?php if($template === 'email_template_item_expiry'): ?>
                                        <ul class="mb-0 mt-2 list-unstyled">
                                            <li class="mb-1">
                                                <span class="template-variable" data-variable="user_name" data-editor="tinymce_editor_<?php echo e($lang->id); ?>" style="cursor: pointer;">
                                                    <code class="bg-primary text-white px-2 py-1 rounded">{{user_name}}</code>
                                                </span>
                                                <span class="ms-2">- <?php echo e(__('User name')); ?></span>
                                            </li>
                                            <li class="mb-1">
                                                <span class="template-variable" data-variable="item_name" data-editor="tinymce_editor_<?php echo e($lang->id); ?>" style="cursor: pointer;">
                                                    <code class="bg-primary text-white px-2 py-1 rounded">{{item_name}}</code>
                                                </span>
                                                <span class="ms-2">- <?php echo e(__('Advertisement name')); ?></span>
                                            </li>
                                            <li class="mb-1">
                                                <span class="template-variable" data-variable="expiry_date" data-editor="tinymce_editor_<?php echo e($lang->id); ?>" style="cursor: pointer;">
                                                    <code class="bg-primary text-white px-2 py-1 rounded">{{expiry_date}}</code>
                                                </span>
                                                <span class="ms-2">- <?php echo e(__('Expiry date')); ?></span>
                                            </li>
                                            <li class="mb-1">
                                                <span class="template-variable" data-variable="company_name" data-editor="tinymce_editor_<?php echo e($lang->id); ?>" style="cursor: pointer;">
                                                    <code class="bg-primary text-white px-2 py-1 rounded">{{company_name}}</code>
                                                </span>
                                                <span class="ms-2">- <?php echo e(__('Company name')); ?></span>
                                            </li>
                                        </ul>
                                    <?php elseif($template === 'email_template_package_expiry'): ?>
                                        <ul class="mb-0 mt-2 list-unstyled">
                                            <li class="mb-1">
                                                <span class="template-variable" data-variable="user_name" data-editor="tinymce_editor_<?php echo e($lang->id); ?>" style="cursor: pointer;">
                                                    <code class="bg-primary text-white px-2 py-1 rounded">{{user_name}}</code>
                                                </span>
                                                <span class="ms-2">- <?php echo e(__('User name')); ?></span>
                                            </li>
                                            <li class="mb-1">
                                                <span class="template-variable" data-variable="package_name" data-editor="tinymce_editor_<?php echo e($lang->id); ?>" style="cursor: pointer;">
                                                    <code class="bg-primary text-white px-2 py-1 rounded">{{package_name}}</code>
                                                </span>
                                                <span class="ms-2">- <?php echo e(__('Package name')); ?></span>
                                            </li>
                                            <li class="mb-1">
                                                <span class="template-variable" data-variable="expiry_date" data-editor="tinymce_editor_<?php echo e($lang->id); ?>" style="cursor: pointer;">
                                                    <code class="bg-primary text-white px-2 py-1 rounded">{{expiry_date}}</code>
                                                </span>
                                                <span class="ms-2">- <?php echo e(__('Expiry date')); ?></span>
                                            </li>
                                            <li class="mb-1">
                                                <span class="template-variable" data-variable="company_name" data-editor="tinymce_editor_<?php echo e($lang->id); ?>" style="cursor: pointer;">
                                                    <code class="bg-primary text-white px-2 py-1 rounded">{{company_name}}</code>
                                                </span>
                                                <span class="ms-2">- <?php echo e(__('Company name')); ?></span>
                                            </li>
                                        </ul>
                                    <?php elseif($template === 'email_template_new_login'): ?>
                                        <ul class="mb-0 mt-2 list-unstyled">
                                            <li class="mb-1">
                                                <span class="template-variable" data-variable="user_name" data-editor="tinymce_editor_<?php echo e($lang->id); ?>" style="cursor: pointer;">
                                                    <code class="bg-primary text-white px-2 py-1 rounded">{{user_name}}</code>
                                                </span>
                                                <span class="ms-2">- <?php echo e(__('User name')); ?></span>
                                            </li>
                                            <li class="mb-1">
                                                <span class="template-variable" data-variable="device_type" data-editor="tinymce_editor_<?php echo e($lang->id); ?>" style="cursor: pointer;">
                                                    <code class="bg-primary text-white px-2 py-1 rounded">{{device_type}}</code>
                                                </span>
                                                <span class="ms-2">- <?php echo e(__('Device type (Android/iOS)')); ?></span>
                                            </li>
                                            <li class="mb-1">
                                                <span class="template-variable" data-variable="ip_address" data-editor="tinymce_editor_<?php echo e($lang->id); ?>" style="cursor: pointer;">
                                                    <code class="bg-primary text-white px-2 py-1 rounded">{{ip_address}}</code>
                                                </span>
                                                <span class="ms-2">- <?php echo e(__('IP address')); ?></span>
                                            </li>
                                            <li class="mb-1">
                                                <span class="template-variable" data-variable="login_time" data-editor="tinymce_editor_<?php echo e($lang->id); ?>" style="cursor: pointer;">
                                                    <code class="bg-primary text-white px-2 py-1 rounded">{{login_time}}</code>
                                                </span>
                                                <span class="ms-2">- <?php echo e(__('Login time')); ?></span>
                                            </li>
                                            <li class="mb-1">
                                                <span class="template-variable" data-variable="company_name" data-editor="tinymce_editor_<?php echo e($lang->id); ?>" style="cursor: pointer;">
                                                    <code class="bg-primary text-white px-2 py-1 rounded">{{company_name}}</code>
                                                </span>
                                                <span class="ms-2">- <?php echo e(__('Company name')); ?></span>
                                            </li>
                                        </ul>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <div class="col-12 mt-3 d-flex justify-content-end">
                        <a href="<?php echo e(route('settings.email-templates.index')); ?>" class="btn btn-secondary me-2">
                            <?php echo e(__('Cancel')); ?>

                        </a>
                        <button class="btn btn-primary" type="submit"><?php echo e(__('Save')); ?></button>
                    </div>
                </div>
            </form>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <style>
        .template-variable code {
            transition: all 0.2s ease;
            display: inline-block;
        }
        .template-variable:hover code {
            background-color: #0056b3 !important;
            transform: scale(1.05);
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }
        .template-variable:active code {
            transform: scale(0.98);
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // Initialize TinyMCE editors
            const editors = {};
            tinymce.init({
                selector: '.tinymce_editor',
                height: 400,
                menubar: false,
                plugins: [
                    'advlist autolink lists link charmap preview anchor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime table paste code help wordcount'
                ],
                toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist | removeformat | code',
                setup: function(editor) {
                    // Store editor instance
                    editors[editor.id] = editor;
                    
                    editor.on("change keyup", function() {
                        editor.save();
                    });
                }
            });

            // Handle variable clicks
            document.querySelectorAll('.template-variable').forEach(function(element) {
                element.addEventListener('click', function() {
                    let variable = this.getAttribute('data-variable');
                    
                    const openBrace = '{';
                    const closeBrace = '}';
                    if (!variable.startsWith(openBrace + openBrace)) {
                        variable = openBrace + openBrace + variable + closeBrace + closeBrace;
                    }
                    
                    // Get the active tab's editor
                    const activeTab = document.querySelector('.tab-pane.active');
                    if (activeTab) {
                        const activeEditorId = activeTab.querySelector('.tinymce_editor')?.id;
                        if (activeEditorId && editors[activeEditorId]) {
                            const editor = editors[activeEditorId];
                            // Insert variable at cursor position
                            editor.insertContent(variable);
                            // Focus the editor
                            editor.focus();
                        }
                    }
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/settings/email-templates/edit.blade.php ENDPATH**/ ?>