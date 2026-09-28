<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>" dir="<?php echo e(in_array(app()->getLocale(), ['ar','he','fa','ur']) ? 'rtl' : 'ltr'); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <title><?php echo e(__('Payment Receipt')); ?></title>

    <style>
        body {
            font-family: dejavusans, sans-serif;
            font-size: 14px;
            color: #333;
            line-height: 1.5;
        }
        .container {
            padding-left: 10px;
            padding-right: 10px;
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 20px;
        }
        .logo {
            height: 80px;
            max-width: 200px;
            margin: 0 auto 10px;
        }
        .receipt-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .receipt-number {
            font-size: 16px;
            color: #666;
        }
        .info-section {
            margin-bottom: 20px;
        }
        .info-section h3 {
            border-bottom: 1px solid #eee;
            padding-bottom: 5px;
            margin-bottom: 10px;
        }
        .info-row {
            margin-bottom: 8px;
            line-height: 1.4;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .table th {
            background-color: #f8f8f8;
        }
        .total-section {
            margin-top: 20px;
            text-align: right;
        }
        .total-row {
            margin-bottom: 5px;
        }
        .total-amount {
            font-size: 18px;
            font-weight: bold;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            color: #777;
            border-top: 1px solid #ddd;
            padding-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <?php if(!empty($settings['company_logo'])): ?>
                <img src="<?php echo e($settings['company_logo']); ?>" alt="<?php echo e(__('Company Logo')); ?>" class="logo"><br>
            <?php endif; ?>
            <div class="receipt-title"><?php echo e(__('Payment Receipt')); ?></div>
            <div class="receipt-number"><?php echo e(__('Receipt')); ?> #<?php echo e($payment->id); ?></div>
        </div>

        <div class="info-section">
            <h3><?php echo e(__('Customer Information')); ?></h3>
            <?php if($payment->user): ?>
                <div class="info-row">
                    <strong><?php echo e(__('Name')); ?>:</strong> <?php echo e($payment->user->name); ?>

                </div>
                <?php if($payment->user->email): ?>
                    <div class="info-row">
                        <strong><?php echo e(__('Email')); ?>:</strong> <?php echo e(\App\Services\HelperService::maskDemoEmail($payment->user->email)); ?>

                    </div>
                <?php endif; ?>
                <?php if($payment->user->mobile): ?>
                    <div class="info-row">
                        <strong><?php echo e(__('Mobile')); ?>:</strong> <?php echo e(\App\Services\HelperService::maskDemoMobile($payment->user->mobile)); ?>

                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>

        <div class="info-section">
            <h3><?php echo e(__('Payment Information')); ?></h3>
            <div class="info-row">
                <strong><?php echo e(__('Payment Date')); ?>:</strong> <?php echo e($payment->created_at->format('d M Y')); ?>

            </div>
            <?php if($payment->order_id): ?>
                <div class="info-row">
                    <strong><?php echo e(__('Order ID')); ?>:</strong> <?php echo e($payment->order_id); ?>

                </div>
            <?php endif; ?>
            <div class="info-row">
                <strong><?php echo e(__('Payment Gateway')); ?>:</strong> <?php echo e(__(ucfirst($payment->payment_gateway))); ?>

            </div>
            <div class="info-row">
                <strong><?php echo e(__('Payment Status')); ?>:</strong>
                <span class="payment-status status-<?php echo e($payment->payment_status); ?>"><?php echo e(__($payment->payment_status_upper)); ?></span>
            </div>
        </div>

        <?php
            $currencySymbol = $settings['currency_symbol'] ?? '$';
            $package = $payment->package_id ? \App\Models\Package::find($payment->package_id) : null;
        ?>

        <?php if($package): ?>
            <table class="table">
                <thead>
                    <tr>
                        <th><?php echo e(__('Package')); ?></th>
                        <th><?php echo e(__('Duration')); ?></th>
                        <th><?php echo e(__('Item Limit')); ?></th>
                        <th><?php echo e(__('Amount')); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo e($package->name); ?></td>
                        <td>
                            <?php if(is_null($package->duration) || $package->type == 'unlimited'): ?>
                                <?php echo e(__('Unlimited')); ?>

                            <?php else: ?>
                                <?php echo e($package->duration); ?> <?php echo e(__('Days')); ?>

                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($package->item_limit == 'unlimited' || $package->item_limit == 0): ?>
                                <?php echo e(__('Unlimited')); ?>

                            <?php else: ?>
                                <?php echo e($package->item_limit); ?>

                            <?php endif; ?>
                        </td>
                        <td><?php echo e($currencySymbol); ?> <?php echo e(number_format($payment->amount, 2)); ?></td>
                    </tr>
                </tbody>
            </table>
        <?php else: ?>
            <table class="table">
                <thead>
                    <tr>
                        <th><?php echo e(__('Description')); ?></th>
                        <th><?php echo e(__('Amount')); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo e(__('Payment Transaction')); ?></td>
                        <td><?php echo e($currencySymbol); ?> <?php echo e(number_format($payment->amount, 2)); ?></td>
                    </tr>
                </tbody>
            </table>
        <?php endif; ?>

        <?php if(($payment->original_price && $payment->original_price > 0) || ($payment->discount_price && $payment->discount_price > 0) || ($payment->refer_points_used && $payment->refer_points_used > 0)): ?>
            <table class="table">
                <tbody>
                    <?php if($payment->original_price && $payment->original_price > 0): ?>
                        <tr>
                            <td><strong><?php echo e(__('Original Price')); ?></strong></td>
                            <td><?php echo e($currencySymbol); ?> <?php echo e(number_format($payment->original_price, 2)); ?></td>
                        </tr>
                    <?php endif; ?>
                    <?php if($payment->discount_price && $payment->discount_price > 0): ?>
                        <tr>
                            <td><strong><?php echo e(__('Discount')); ?></strong></td>
                            <td>- <?php echo e($currencySymbol); ?> <?php echo e(number_format($payment->discount_price, 2)); ?></td>
                        </tr>
                    <?php endif; ?>
                    <?php if($payment->refer_points_used && $payment->refer_points_used > 0): ?>
                        <tr>
                            <td><strong><?php echo e(__('Refer Points Used')); ?></strong></td>
                            <td><?php echo e($payment->refer_points_used); ?></td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        <?php endif; ?>

        <div class="total-section">
            <div class="total-row">
                <span class="total-label"><?php echo e(__('Total Amount')); ?>:</span>
                <span class="total-amount"><?php echo e($currencySymbol); ?> <?php echo e(number_format($payment->amount, 2)); ?></span>
            </div>
        </div>

        <div class="footer">
            <?php if($payment->payment_status === 'succeed'): ?>
                <p><?php echo e(__('Thank you for your purchase!')); ?></p>
            <?php endif; ?>
            <p><?php echo e($settings['company_name'] ?? ''); ?><?php if(!empty($settings['company_address'])): ?> | <?php echo e($settings['company_address']); ?><?php endif; ?></p>
            <?php
                $phone = $settings['company_tel1'] ?? ($settings['company_tel2'] ?? '');
            ?>
            <p><?php if(!empty($settings['company_email'])): ?><?php echo e($settings['company_email']); ?><?php endif; ?> <?php if(!empty($phone)): ?>| <?php echo e($phone); ?><?php endif; ?></p>
            <p><?php echo e(__('Receipt generated on')); ?> <?php echo e(now()->format('d M Y, h:i A')); ?></p>
        </div>
    </div>
</body>
</html>
<?php /**PATH /home/mohamed/Videos/dashboard/بسم الله/codecanyon-MsYYrWvY-eclassify-classified-buy-and-sell-marketplace-flutter-app-with-laravel-admin-panel/eClassify-Project-v3.1.0/admin_panel/fresh/resources/views/payments/receipts/payment_receipt.blade.php ENDPATH**/ ?>