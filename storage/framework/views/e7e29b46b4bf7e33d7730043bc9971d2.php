<?php $__env->startSection('title'); ?>
    <?php echo e(__("Change Categories Order")); ?>

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
            <a class="btn btn-primary" href="<?php echo e(route('category.index')); ?>">< <?php echo e(__("Back to All Categories")); ?> </a>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="pt-3" id="update-team-member-rank-form" action="<?php echo e(route('category.order.change')); ?>" novalidate="novalidate">
                            <ul class="sortable row col-12 d-flex justify-content-center">
                                <div class="row bg-light pt-2 rounded mb-2 col-12 d-flex justify-content-center">
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li id="<?php echo e($row->id); ?>" class="ui-state-default draggable col-md-12 col-lg-5 mr-2 col-xl-3" style="cursor:grab">
                                            <div class="bg-light pt-2 rounded mb-2 col-12 d-flex justify-content-center">
                                                 <div class="row">
                                                    <div class="col-6" style="padding-left:15px; padding-right:5px;">
                                                        <img src="<?php echo e($row->image); ?>" alt="image" class="order-change"/>
                                                    </div>
                                                    <div class="col-6 d-flex flex-column justify-content-center align-items-center" style="padding-left: 5px; padding-right:5px;">
                                                        <strong> <?php echo e($row->name); ?> </strong>
                                                        <div>
                                                            <span style="font-size: 12px;"><?php echo e($row->designation); ?> </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </ul>
                            <input class="btn btn-primary" type="submit" value="<?php echo e(__("Update")); ?>"/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/category/sub-categories-order.blade.php ENDPATH**/ ?>