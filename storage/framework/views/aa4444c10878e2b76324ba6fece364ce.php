<?php $__env->startSection('title'); ?>
    <?php echo e(__("Translate Areas")); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-title'); ?>
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6">
                <h4><?php echo $__env->yieldContent('title'); ?></h4>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="section">
    <form class="edit-form" action="<?php echo e(route('areas.translation.update')); ?>" method="POST" data-parsley-validate>
        <?php echo csrf_field(); ?>
        <div class="card">
            <div class="card-header">
                <h4><?php echo e(__('Translate Area Names')); ?></h4>
            </div>
            <div class="card-body">
                <?php if($countries->isNotEmpty()): ?>
                    <div class="form-group mb-3">
                        <label for="country_translation_area"><?php echo e(__('Select Country')); ?></label>
                        <select id="country_translation_area" class="form-control">
                            <option value=""><?php echo e(__('Select Country')); ?></option>
                            <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($country->id); ?>"><?php echo e($country->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="State_For_area"><?php echo e(__('Select State')); ?></label>
                        <select id="State_For_area" class="form-control" disabled>
                            <option value=""><?php echo e(__('Select State')); ?></option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="city_translation"><?php echo e(__('Select City')); ?></label>
                        <select id="city_translation" class="form-control" disabled>
                            <option value=""><?php echo e(__('Select City')); ?></option>
                        </select>
                    </div>

                    <div id="area_translations_container" class="mt-4"></div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary"><?php echo e(__("Save")); ?></button>
                    </div>
                <?php else: ?>
                    <p><?php echo e(__("No countries found.")); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </form>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script>
$('#country_translation_area').on('change', function () {
    console.log('here');
    let countryId = $(this).val();
    let url = window.baseurl + 'states/search?country_id=' + countryId;

    $('#State_For_area').html("<option value=''><?php echo e(__('Select State')); ?></option>");
    $('#city_translation').html("<option value=''><?php echo e(__('Select City')); ?></option>").prop('disabled', true);
    $('#State_For_area').prop('disabled', true);
    $('#area_translations_container').html("");

    if (!countryId) return;

    ajaxRequest('GET', url, null, null, function (response) {
        $.each(response.data, function (key, value) {
            console.log(
                response
            );

            $('#State_For_area').append($('<option>', { value: value.id, text: value.name }));
        });
        $('#State_For_area').prop('disabled', false);
    });
});

$('#State_For_area').on('change', function () {
    let stateId = $(this).val();
    $('#city_translation').html("<option value=''><?php echo e(__('Select City')); ?></option>").prop('disabled', true);
    $('#area_translations_container').html("");

    if (!stateId) return;

    let url = window.baseurl + 'cities/search?state_id=' + stateId;

    ajaxRequest('GET', url, null, null, function (response) {
        $.each(response.data, function (key, value) {
            $('#city_translation').append($('<option>', { value: value.id, text: value.name }));
        });
        $('#city_translation').prop('disabled', false);
    });
});

$('#city_translation').on('change', function () {
    let cityId = $(this).val();
    $('#area_translations_container').html("");

    if (!cityId) return;

    let url = window.baseurl + 'area-translations/' + cityId;

    $.ajax({
        url: url,
        type: 'GET',
        success: function (response) {
            $('#area_translations_container').html(response);
        },
        error: function () {
            $('#area_translations_container').html('<div class="text-danger">Failed to load translations.</div>');
        }
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/places/area_translation.blade.php ENDPATH**/ ?>