<?php $__env->startSection('title'); ?>
    <?php echo e(__('Customers')); ?>

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
            <div class="card-body">
                <?php
                    $cols = [
                        ['field'=>'id','title'=>__('ID'),'sortable'=>true],
                        ['field'=>'name','title'=>__('Name'),'sortable'=>true, 'formatter'=>'customerProfileFormatter'],
                        ['field'=>'email','title'=>__('Email'),'sortable'=>true],
                        ['field'=>'mobile','title'=>__('Mobile'),'sortable'=>true],
                        ['field'=>'type','title'=>__('Type'),'sortable'=>true],
                        ['field'=>'address','title'=>__('Address'),'sortable'=>true],
                        ['field'=>'items_count','title'=>__('Total Post'),'sortable'=>true],
                    ];
                    if(auth()->user()->can('customer-update')) {
                        $cols[] = ['field'=>'status','title'=>__('Status'),'formatter'=>'statusSwitchFormatter','sortable'=>false];
                        $cols[] = ['field'=>'auto_approve_advertisement','title'=>__('Auto Approve Advertisement'),'formatter'=>'autoApproveItemSwitchFormatter','sortable'=>false];
                        $cols[] = ['field'=>'operate','title'=>__('Action'),'escape'=>false,'align'=>'center','sortable'=>false,'events'=>'userEvents'];
                    }
                ?>
                <?php if (isset($component)) { $__componentOriginalc8463834ba515134d5c98b88e1a9dc03 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8463834ba515134d5c98b88e1a9dc03 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.data-table','data' => ['id' => 'table_list','url' => route('customer.show',1),'clickToSelect' => true,'fixedColumns' => true,'showExport' => true,'exportFileName' => 'customer-list','tableName' => 'users','statusColumn' => 'deleted_at','extra' => ['data-query-params'=>'queryParams'],'columns' => $cols]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('data-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'table_list','url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('customer.show',1)),'click-to-select' => true,'fixed-columns' => true,'show-export' => true,'export-file-name' => 'customer-list','table-name' => 'users','status-column' => 'deleted_at','extra' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['data-query-params'=>'queryParams']),'columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($cols)]); ?>
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
        <div id="assignPackageModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel1"><?php echo e(__('Assign Packages')); ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="resetModal()"></button>
                    </div>
                    <div class="modal-body">
                        <form class="create-form" action="<?php echo e(route('customer.assign.package')); ?>" method="POST" data-parsley-validate data-success-function="assignApprovalSuccess">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="user_id" id='user_id'>
                            <div id="currency-settings" data-symbol="<?php echo e($currency_symbol); ?>"  data-position="<?php echo e($currency_symbol_position); ?>" data-free-ad-listing="<?php echo e($free_ad_listing); ?>"></div>
                            <?php if($free_ad_listing != 1): ?>
                            <div class="form-group row select-package">
                                <div class="col-md-6">
                                    <input type="radio" id="item_package" class="package_type form-check-input" name="package_type" value="item_listing" required>
                                    <label for="item_package"><?php echo e(__('Item Listing Package')); ?></label>
                                </div>
                                <div class="col-md-6">
                                    <input type="radio" id="advertisement_package" class="package_type form-check-input" name="package_type" value="advertisement" required>
                                    <label for="advertisement_package"><?php echo e(__('Advertisement Package')); ?></label>
                                </div>
                            </div>
                            <?php endif; ?>
                            <div class="row mt-3" id="item-listing-package-div" style="display: none;">
                                <div class="form-group col-md-12">
                                    <label for="package"><?php echo e(__("Select Item Listing Package")); ?></label>
                                    <select name="package_id" class="form-select package" id="item-listing-package" aria-label="Package">
                                        <option value="" disabled selected><?php echo e(__("Select Option")); ?></option>
                                        <?php $__currentLoopData = $itemListingPackage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($package->id); ?>" data-details="<?php echo e(json_encode($package)); ?>"><?php echo e($package->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-3" id="advertisement-package-div" style="<?php echo e($free_ad_listing == '1' ? 'display: block;' : 'display: none;'); ?>">
                                <div class="form-group col-md-12">
                                    <label for="package"><?php echo e(__("Select Advertisement Package")); ?></label>
                                    <select name="package_id" class="form-select package" id="advertisement-package" aria-label="Package">
                                        <option value="" disabled selected><?php echo e(__("Select Option")); ?></option>
                                        <?php $__currentLoopData = $advertisementPackage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($package->id); ?>" data-details="<?php echo e(json_encode($package)); ?>"><?php echo e($package->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div id="package_details" class="mt-3" style="display: none;">
                                <p><strong><?php echo e(__("Name")); ?>:</strong> <span id="package_name"></span></p>
                                <p><strong><?php echo e(__("Price")); ?>:</strong> <span id="package_price"></span></p>
                                <p><strong><?php echo e(__("Final Price")); ?>:</strong> <span id="package_final_price"></span></p>
                                <p><strong><?php echo e(__("Limitation")); ?>:</strong> <span id="package_duration"></span></p>
                            </div>
                            <div class="form-group row payment" style="display: none">
                                <div class="col-md-6">
                                    <input type="radio" id="cash_payment" class="payment_gateway form-check-input" name="payment_gateway" value="cash">
                                    <label for="cash_payment"><?php echo e(__('Cash')); ?></label>
                                </div>
                                <div class="col-md-6">
                                    <input type="radio" id="cheque_payment" class="payment_gateway form-check-input" name="payment_gateway" value="cheque">
                                    <label for="cheque_payment"><?php echo e(__('Cheque')); ?></label>
                                </div>
                            </div>
                            <div class="form-group cheque mt-3" style="display: none">
                                <label for="cheque"><?php echo e(__('Add cheque number')); ?></label>
                                <input type="text" id="cheque" class="form-control" name="cheque_number" data-parsley-required="true">
                            </div>
                            <input type="submit" value="<?php echo e(__("Save")); ?>" class="btn btn-primary mt-3">
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Manage Packages Modal (View Active Packages Only) -->
        <div id="managePackagesModal" class="modal fade modal-lg" tabindex="-1" role="dialog" aria-labelledby="managePackagesModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="managePackagesModalLabel"><?php echo e(__('Active Packages')); ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="resetManagePackagesModal()"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="manage_user_id" name="user_id">
                        
                        <div id="active-packages-list">
                            <div class="text-center">
                                <div class="spinner-border" role="status">
                                    <span class="visually-hidden"><?php echo e(__('Loading...')); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
                        <!-- <button type="button" class="btn btn-primary" onclick="refreshManagePackages()"><?php echo e(__('Refresh')); ?></button> -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Cancel Subscription Modal -->
        <div id="cancelSubscriptionModal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?php echo e(__('Cancel Subscription')); ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="cancel-subscription-form" class="create-form" action="<?php echo e(route('customer.cancel.package')); ?>" method="POST" data-success-function="cancelPackageSuccess">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" id="cancel-package-id" name="package_id" value="">

                        <div class="modal-body">
                            <p class="mb-3"><?php echo e(__('Are you sure you want to cancel this package subscription?')); ?></p>

                            <div id="cancel-package-details" class="mt-3 p-3 bg-light rounded">
                                <p class="mb-2"><strong><?php echo e(__('Package Name')); ?>:</strong> <span id="cancel-package-name" class="text-primary"></span></p>
                                <p class="mb-2"><strong><?php echo e(__('Type')); ?>:</strong> <span id="cancel-package-type" class="badge bg-info"></span></p>
                                <p class="mb-2"><strong><?php echo e(__('Start Date')); ?>:</strong> <span id="cancel-start-date"></span></p>
                                <p class="mb-0"><strong><?php echo e(__('End Date')); ?>:</strong> <span id="cancel-end-date"></span></p>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
                            <button type="submit" class="btn btn-danger" id="cancel-submit-btn"><?php echo e(__('Cancel Subscription')); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script>
        function assignApprovalSuccess() {
            $('#assignPackageModal').modal('hide');
            refreshTable();
        }
        
        function resetModal() {
            const modal = $('#assignPackageModal');
            const form = modal.find('form');
            form[0].reset();
            $('#package_details').hide();
            $('.payment').hide();
            $('.cheque').hide();
        }
        
        function resetManagePackagesModal() {
            $('#manage_user_id').val('');
            $('#active-packages-list').html('<div class="text-center"><div class="spinner-border" role="status"><span class="visually-hidden"><?php echo e(__('Loading...')); ?></span></div></div>');
        }
        
        function refreshTable() {
            if (typeof $('#table_list').bootstrapTable === 'function') {
                $('#table_list').bootstrapTable('refresh');
            } else {
                location.reload();
            }
        }
        
        function loadActivePackages(userId) {
            $.ajax({
                url: "<?php echo e(route('customer.active.packages')); ?>",
                type: 'GET',
                data: { user_id: userId },
                success: function(response) {
                    if (response.error === false && response.data) {
                        let html = '';
                        if (response.data.length === 0) {
                            html = '<p class="text-muted text-center"><?php echo e(__("No active packages found.")); ?></p>';
                        } else {
                            html = '<div class="table-responsive"><table class="table table-bordered">';
                            html += '<thead><tr><th><?php echo e(__("Package Name")); ?></th><th><?php echo e(__("Type")); ?></th><th><?php echo e(__("Start Date")); ?></th><th><?php echo e(__("End Date")); ?></th><th><?php echo e(__("Used/Total Limit")); ?></th><th><?php echo e(__("Remaining Days")); ?></th><th><?php echo e(__("Action")); ?></th></tr></thead><tbody>';
                            
                            response.data.forEach(function(pkg) {
                                html += '<tr>';
                                html += '<td>' + (pkg.package_name || '-') + '</td>';
                                html += '<td><span class="badge bg-info">' + (pkg.package_type === 'item_listing' ? '<?php echo e(__("Item Listing")); ?>' : '<?php echo e(__("Advertisement")); ?>') + '</span></td>';
                                html += '<td>' + pkg.start_date + '</td>';
                                html += '<td>' + pkg.end_date + '</td>';
                                html += '<td>' + pkg.used_limit + ' / ' + (pkg.total_limit === 'Unlimited' || pkg.total_limit === null ? '<?php echo e(__("Unlimited")); ?>' : pkg.total_limit) + '</td>';
                                html += '<td>' + (pkg.remaining_days === 'unlimited' || pkg.remaining_days === 'Unlimited' ? '<?php echo e(__("Unlimited")); ?>' : pkg.remaining_days + ' <?php echo e(__("days")); ?>') + '</td>';
                                html += '<td><button class="btn btn-sm btn-danger cancel-package-btn" data-package-id="' + pkg.id + '"><?php echo e(__("Cancel")); ?></button></td>';
                                html += '</tr>';
                            });
                            
                            html += '</tbody></table></div>';
                        }
                        $('#active-packages-list').html(html);
                    } else {
                        $('#active-packages-list').html('<p class="text-danger text-center"><?php echo e(__("Error loading packages.")); ?></p>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error loading packages:', error);
                    $('#active-packages-list').html('<p class="text-danger text-center"><?php echo e(__("Error loading packages.")); ?></p>');
                }
            });
        }
        
        // Handle manage packages button click
        $(document).on('click', '.manage_packages', function() {
            const userId = $(this).data('user-id');
            $('#manage_user_id').val(userId);
            $('#manage_user_id_form').val(userId);
            loadActivePackages(userId);
        });
        
        // Handle cancel package button click - Show cancel modal
        $(document).on('click', '.cancel-package-btn', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const row = $(this).closest('tr');
            const packageId = $(this).data('package-id');
            
            if (!packageId) {
                alert('<?php echo e(__("Package ID is missing")); ?>');
                return false;
            }

            // Populate cancel modal with package details
            $('#cancel-package-id').val(packageId);
            
            const packageName = row.find('td:eq(0)').text().trim();
            const packageType = row.find('td:eq(1)').text().trim();
            const startDate = row.find('td:eq(2)').text().trim();
            const endDate = row.find('td:eq(3)').text().trim();
            
            $('#cancel-package-name').text(packageName || '-');
            $('#cancel-package-type').text(packageType || '-');
            $('#cancel-start-date').text(startDate || '-');
            $('#cancel-end-date').text(endDate || '-');

            // Show cancel modal
            $('#cancelSubscriptionModal').modal('show');
            return false;
        });

        // Success callback for cancel subscription form
        function cancelPackageSuccess(response) {
            // Close cancel subscription modal
            $('#cancelSubscriptionModal').modal('hide');
            
            // Reset cancel modal fields
            resetCancelModal();

            // Refresh packages inside manage modal if it's open
            const userId = $('#manage_user_id').val();
            if (userId) {
                setTimeout(function() {
                    loadActivePackages(userId);
                }, 500);
            }

            // Refresh main table
            setTimeout(function() {
                refreshTable();
            }, 500);
        }

        // Function to refresh manage packages list
        function refreshManagePackages() {
            const userId = $('#manage_user_id').val();
            if (userId) {
                loadActivePackages(userId);
            } else {
                alert('<?php echo e(__("Please select a user first")); ?>');
            }
        }

        // Function to reset cancel modal
        function resetCancelModal() {
            $('#cancel-package-id').val('');
            $('#cancel-package-name').text('');
            $('#cancel-package-type').text('');
            $('#cancel-start-date').text('');
            $('#cancel-end-date').text('');
            $('#cancel-submit-btn').prop('disabled', false);
        }

        // Reset cancel modal when closed
        $('#cancelSubscriptionModal').on('hidden.bs.modal', function () {
            resetCancelModal();
        });
        
        // Prevent form submission if package ID is missing
        $('#cancel-subscription-form').on('submit', function(e) {
            const packageId = $('#cancel-package-id').val();
            if (!packageId) {
                e.preventDefault();
                alert('<?php echo e(__("Package ID is missing. Please try again.")); ?>');
                return false;
            }
        });

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/customer/index.blade.php ENDPATH**/ ?>