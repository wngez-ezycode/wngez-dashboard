<?php $__env->startSection('title'); ?>
    <?php echo e(__('Seller Reviews')); ?>

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
                            $cols = [
                                ['field'=>'id','title'=>__('ID'),'sortable'=>true],
                                ['field'=>'seller','title'=>__('Seller Name'),'sortable'=>false,'formatter' => 'sellerProfileFormatter'],
                                ['field'=>'buyer','title'=>__('Buyer Name'),'align'=>'center','sortable'=>false,'formatter' => 'buyerProfileFormatter'],
                                ['field'=>'item_name','title'=>__('Advertisement'),'sortable'=>false],
                                ['field'=>'ratings','title'=>__('Ratings'),'visible'=>true,'formatter'=>'ratingFormatter'],
                                ['field'=>'review','title'=>__('Review'),'sortable'=>true,'formatter'=>'descriptionFormatter'],
                            ];
                            $exportOptions = ['pdf','json','xml','csv','txt','sql','doc','excel'];
                        ?>
                        <?php if (isset($component)) { $__componentOriginalc8463834ba515134d5c98b88e1a9dc03 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8463834ba515134d5c98b88e1a9dc03 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.data-table','data' => ['id' => 'table_list','url' => route('seller-review.show',1),'clickToSelect' => true,'fixedColumns' => true,'filterControl' => true,'tableName' => 'seller_ratings','statusColumn' => 'deleted_at','extra' => ['data-show-export'=>'true','data-export-options'=>'sellerReviewReportExportOptions','data-export-types'=> json_encode($exportOptions)],'columns' => $cols]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('data-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'table_list','url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('seller-review.show',1)),'click-to-select' => true,'fixed-columns' => true,'filter-control' => true,'table-name' => 'seller_ratings','status-column' => 'deleted_at','extra' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['data-show-export'=>'true','data-export-options'=>'sellerReviewReportExportOptions','data-export-types'=> json_encode($exportOptions)]),'columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($cols)]); ?>
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
    </script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/seller_review/index.blade.php ENDPATH**/ ?>