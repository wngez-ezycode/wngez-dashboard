<?php $__env->startSection('title'); ?>
    <?php echo e(__('Seller Review Reports')); ?>

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
                <div class="row">
                    <div class="col-12">
                        <?php
                            $srCols = [
                                ['field'=>'id','title'=>__('ID'),'sortable'=>true],
                                ['field'=>'seller','title'=>__('Seller Name'),'sortable'=>false,'formatter'=> 'sellerProfileFormatter'],
                                ['field'=>'buyer','title'=>__('Buyer Name'),'align'=>'center','sortable'=>false,'formatter'=> 'buyerProfileFormatter'],
                                ['field'=>'item_name','title'=>__('Advertisement'),'sortable'=>false],
                                ['field'=>'ratings','title'=>__('Ratings'),'visible'=>true,'formatter'=>'ratingFormatter'],
                                ['field'=>'review','title'=>__('Review'),'sortable'=>false,'formatter'=>'descriptionFormatter'],
                                ['field'=>'report_status','title'=>__('Report Status'),'sortable'=>true,'filterControl'=>'select','filterData'=>'','formatter'=>'reportStatusFormatter'],
                                ['field'=>'report_reason','title'=>__('Report Reason'),'sortable'=>false],
                                ['field'=>'report_rejected_reason','title'=>__('Report Rejection Reason'),'sortable'=>false],
                            ];
                            if(auth()->user()->canany(['item-update','item-delete'])) {
                                $srCols[] = ['field'=>'operate','title'=>__('Action'),'align'=>'center','sortable'=>false,'events'=>'reviewReportEvents','escape'=>false];
                            }
                            $exportOptions = ['pdf','json','xml','csv','txt','sql','doc','excel'];
                        ?>
                        <?php if (isset($component)) { $__componentOriginalc8463834ba515134d5c98b88e1a9dc03 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8463834ba515134d5c98b88e1a9dc03 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.data-table','data' => ['id' => 'table_list','url' => route('review-report.show',1),'toolbarId' => 'filters','clickToSelect' => true,'filterControl' => true,'fixedColumns' => true,'tableName' => 'seller_ratings','statusColumn' => 'deleted_at','extra' => ['data-show-export'=>'true','data-export-options'=>'sellerReviewReportExportOptions','data-export-types'=> json_encode($exportOptions)],'columns' => $srCols]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('data-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'table_list','url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('review-report.show',1)),'toolbar-id' => 'filters','click-to-select' => true,'filter-control' => true,'fixed-columns' => true,'table-name' => 'seller_ratings','status-column' => 'deleted_at','extra' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['data-show-export'=>'true','data-export-options'=>'sellerReviewReportExportOptions','data-export-types'=> json_encode($exportOptions)]),'columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($srCols)]); ?>
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
        <div id="editStatusModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
        aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title" id="myModalLabel1"><?php echo e(__('Status')); ?></h5>
                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                   <form class="edit-form" action="" method="POST" data-success-function="updateApprovalSuccess">
                       <?php echo csrf_field(); ?>
                       <div class="row">
                           <div class="col-md-12">
                               <select name="report_status" class="form-select" id="report_status" aria-label="status">
                                   <option value="" selected><?php echo e(__("Select Status")); ?></option>
                                   <option value="approved"><?php echo e(__("Approve")); ?></option>
                                   <option value="rejected"><?php echo e(__("Reject")); ?></option>
                               </select>
                           </div>
                       </div>
                       <div id="report_rejected_reason_container" class="col-md-12" style="display: none;">
                           <label for="rejected_reason" class="mandatory form-label"><?php echo e(__('Reason')); ?></label>
                           <textarea name="report_rejected_reason" id="report_rejected_reason" class="form-control" placeholder=<?php echo e(__('Reason')); ?>></textarea>
                       </div>
                       <input type="submit" value="<?php echo e(__("Save")); ?>" class="btn btn-primary mt-3">
                   </form>
               </div>
           </div>
       </div>
       <!-- /.modal-content -->
   </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        window.sellerReviewReportExportOptions = {
            fileName: 'seller-review-report-list',
            ignoreColumn: ['operate'],
            onCellHtmlData: function (cell, row, col, htmlData) {
                var $temp = $('<div>').html(htmlData);

                // Ratings column: convert star icons to numeric value
                if ($temp.find('i.fa-star, i.fa-star-half').length) {
                    var full  = $temp.find('i.fa-star.text-warning').length;
                    var half  = $temp.find('i.fa-star-half').length;
                    return full + (half ? '.5' : '') + ' / 5';
                }

                // Review column: return full text without the "View Less" link
                var $fullDesc = $temp.find('.full-description');
                if ($fullDesc.length) {
                    $fullDesc.find('a').remove();
                    return $fullDesc.text().trim();
                }

                return htmlData;
            }
        };

        function updateApprovalSuccess() {
            $('#editStatusModal').modal('hide');
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/seller_review/report.blade.php ENDPATH**/ ?>