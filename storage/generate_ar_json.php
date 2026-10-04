<?php

require __DIR__ . '/../vendor/autoload.php';

use Stichoza\GoogleTranslate\GoogleTranslate;

$enPath = __DIR__ . '/../resources/lang/en.json';
$arPath = __DIR__ . '/../resources/lang/ar.json';
$arWebPath = __DIR__ . '/../resources/lang/ar_web.json';
$enWebPath = __DIR__ . '/../resources/lang/en_web.json';

if (!file_exists($enPath)) {
    die("en.json not found!\n");
}

$enData = json_decode(file_get_contents($enPath), true);
echo "Total keys in en.json: " . count($enData) . "\n";

$arData = file_exists($arPath) ? json_decode(file_get_contents($arPath), true) : [];

// 1. Curated high-priority marketplace translations dictionary
$curated = [
    'Dashboard' => 'لوحة التحكم',
    'Advertisement' => 'الإعلانات',
    'Ads Listing' => 'قائمة الإعلانات',
    'All Ads' => 'كل الإعلانات',
    'Categories' => 'الأقسام',
    'Category' => 'القسم',
    'Custom Fields' => 'الحقول المخصصة',
    'Content Management' => 'إدارة المحتوى',
    'Slider' => 'شريط التمرير (السلايدر)',
    'Home Screen' => 'الشاشة الرئيسية',
    'Feature Section' => 'الأقسام المميزة',
    'Offer Item Tips' => 'نصائح العروض',
    'Banner Ads' => 'إعلانات البانر',
    'Chat Management' => 'إدارة المحادثات',
    'Chats' => 'المحادثات',
    'Chat Templates' => 'قوالب المحادثة',
    'Package Management' => 'إدارة الباقات',
    'Subscription Packages' => 'باقات الاشتراك',
    'User Subscriptions' => 'اشتراكات المستخدمين',
    'Payment Transactions' => 'المعاملات المالية',
    'Bank Transfer' => 'التحويل البنكي',
    'Seller Management' => 'إدارة البائعين',
    'Verification Fields' => 'حقول التحقق',
    'Seller Verification' => 'توثيق البائعين',
    'Seller Review' => 'تقييمات البائعين',
    'Seller Review Report' => 'بلاغات التقييمات',
    'Forms & Blogs' => 'النماذج والمقالات',
    'Blogs' => 'المقالات',
    'Blog Category' => 'أقسام المقالات',
    'FAQs' => 'الأسئلة الشائعة',
    'Customers & Roles' => 'العملاء والأدوار',
    'Customers' => 'العملاء',
    'Customer' => 'العميل',
    'Role' => 'الأدوار والصلاحيات',
    'Roles' => 'الأدوار',
    'Staff Management' => 'إدارة الموظفين',
    'Staff' => 'فريق العمل',
    'User Queries' => 'استفسارات المستخدمين',
    'Location' => 'المواقع والمناطق',
    'Currencies' => 'العملات',
    'Currency' => 'العملة',
    'Countries' => 'الدول',
    'Country' => 'الدولة',
    'States' => 'المحافظات / المناطق',
    'State' => 'المحافظة / المنطقة',
    'Cities' => 'المدن',
    'City' => 'المدينة',
    'Areas' => 'الأحياء / المناطق',
    'Area' => 'الحي / المنطقة',
    'Reports' => 'البلاغات والتقارير',
    'Report Reasons' => 'أسباب البلاغات',
    'User Reports' => 'بلاغات المستخدمين',
    'Notification' => 'الإشعارات',
    'Notifications' => 'الإشعارات',
    'Settings' => 'الإعدادات',
    'Plugin Manager' => 'إدارة الإضافات',
    'System Update' => 'تحديث النظام',
    'General Settings' => 'الإعدادات العامة',
    'Web Settings' => 'إعدادات الموقع',
    'Notification Settings' => 'إعدادات الإشعارات',
    'Video Ads Settings' => 'إعدادات إعلانات الفيديو',
    'Watermark Settings' => 'إعدادات العلامة المائية',
    'OTP Provider Settings' => 'إعدادات مزود OTP',
    'Dummy Data' => 'البيانات التجريبية',
    'Admob' => 'جوجل أد موب',
    'AdSense' => 'جوجل أدسنس',
    'About Us' => 'من نحن',
    'Terms & Conditions' => 'الشروط والأحكام',
    'Privacy Policy' => 'سياسة الخصوصية',
    'Refund Policy' => 'سياسة الاسترجاع',
    'Contact Us' => 'اتصل بنا',
    'Firebase Settings' => 'إعدادات فايربيس',
    'Languages' => 'اللغات',
    'Language' => 'اللغة',
    'Payment Gateways' => 'بوابات الدفع',
    'System Status' => 'حالة النظام',
    'Seo-Settings' => 'إعدادات السيو (SEO)',
    'File Manager' => 'إدارة الملفات',
    'Email Templates' => 'قوالب البريد الإلكتروني',
    'Gemini AI' => 'الذكاء الاصطناعي (Gemini)',
    'Default Currency Settings' => 'إعدادات العملة الافتراضية',
    'Log Viewer' => 'سجل الأخطاء',
    'Total Ads' => 'إجمالي الإعلانات',
    'Featured Ads' => 'الإعلانات المميزة',
    'Active Ads' => 'الإعلانات النشطة',
    'Expired Ads' => 'الإعلانات المنتهية',
    'Sold Ads' => 'الإعلانات المباعة',
    'All Users' => 'كل المستخدمين',
    'Subscriptions' => 'الاشتراكات',
    'Favorite Ads' => 'الإعلانات المفضلة',
    'Total Reviews' => 'إجمالي التقييمات',
    'Revenue' => 'الإيرادات',
    'Subscription' => 'الاشتراكات',
    'Feature Ads' => 'الإعلانات المميزة',
    'Feature ads' => 'إعلانات مميزة',
    'This Week' => 'هذا الأسبوع',
    'This Month' => 'هذا الشهر',
    'This Year' => 'هذا العام',
    'All Time' => 'كل الأوقات',
    'Recent Ads' => 'أحدث الإعلانات',
    'Latest ads added to your marketplace' => 'أحدث الإعلانات المضافة إلى منصتك',
    'View All' => 'عرض الكل',
    'Recent Reports' => 'أحدث البلاغات',
    'Recent Chats' => 'أحدث المحادثات',
    'Ads Statistics' => 'إحصائيات الإعلانات',
    'Top 5 Categories by Ads' => 'أعلى 5 أقسام حسب عدد الإعلانات',
    'Top Sold Items by Category' => 'أعلى المنتجات المباعة حسب القسم',
    'Customer Statistics' => 'إحصائيات العملاء',
    'Most Viewed' => 'الأكثر مشاهدة',
    'No messages' => 'لا توجد رسائل',
    'View more' => 'عرض المزيد',
    'View More' => 'عرض المزيد',
    'View Less' => 'عرض أقل',
    'Item' => 'المنتج / الإعلان',
    'Items' => 'المنتجات / الإعلانات',
    'User' => 'المستخدم',
    'Users' => 'المستخدمين',
    'Description' => 'الوصف',
    'Change Status' => 'تغيير الحالة',
    'Approve' => 'موافقة / اعتماد',
    'Approved' => 'معتمد',
    'Soft Rejected' => 'مرفوض مؤقتاً',
    'Permanent Rejected' => 'مرفوض نهائياً',
    'Reason' => 'السبب',
    'Save' => 'حفظ',
    'Ad Title' => 'عنوان الإعلان',
    'View' => 'عرض',
    'Action' => 'الإجراء',
    'Actions' => 'الإجراءات',
    'Date' => 'التاريخ',
    'Price' => 'السعر',
    'Status' => 'الحالة',
    'Title' => 'العنوان',
    'Name' => 'الاسم',
    'Image' => 'الصورة',
    'Images' => 'الصور',
    'Item Owner' => 'صاحب الإعلان',
    'Ad Status' => 'حالة الإعلان',
    'Are you sure' => 'هل أنت متأكد؟',
    'You wont be able to revert this' => 'لن تتمكن من التراجع عن هذا الإجراء!',
    'Yes Delete' => 'نعم، احذف',
    'Cancel' => 'إلغاء',
    'Delete' => 'حذف',
    'Edit' => 'تعديل',
    'Active' => 'نشط',
    'Inactive' => 'غير نشط',
    'Under Review' => 'قيد المراجعة',
    'Sold Out' => 'تم البيع',
    'Featured' => 'مميز',
    'Not Featured' => 'غير مميز',
    'Expired' => 'منتهي الصلاحية',
    'Resubmitted' => 'معاد إرساله',
    'Pending' => 'معلق',
    'Rejected' => 'مرفوض',
    'Subcategories' => 'الأقسام الفرعية',
    'Yes' => 'نعم',
    'No' => 'لا',
    'Video Ad' => 'إعلان فيديو',
    'Regular' => 'عادي',
    'Unknown' => 'غير معروف',
    'Search here...' => 'ابحث هنا...',
    'Search' => 'بحث',
    'Search settings' => 'بحث في الإعدادات',
    'All settings' => 'جميع الإعدادات',
    'Results for' => 'نتائج البحث عن',
    'settings' => 'إعدادات',
    'WORKSPACE' => 'مساحة العمل',
    'Manage and organize your marketplace data with ease.' => 'إدارة وتنظيم بيانات سوق الإعلانات بكل سهولة.',
    'Manage how your platform looks, works, and communicates.' => 'إدارة مظهر المنصة وعملها والتواصل فيها.',
    'Search to find the setting you need.' => 'ابحث للعثور على الإعداد الذي تحتاجه.',
    'Total' => 'الإجمالي',
    'Other' => 'أخرى',
    'Default' => 'افتراضي',
    'Set Default' => 'تعيين كافتراضي',
    'Change Password' => 'تغيير كلمة المرور',
    'Change Profile' => 'تعديل الملف الشخصي',
    'Logout' => 'تسجيل الخروج',
    'Welcome back' => 'مرحباً بعودتك',
    'Demo Mode' => 'الوضع التجريبي',
    'Page header' => 'ترويسة الصفحة',
    'Home' => 'الرئيسية',
    'General platform configuration' => 'الإعدادات العامة وتكوين المنصة',
    'Website appearance and behaviour' => 'مظهر الموقع وسلوكه',
    'Push and email notifications' => 'إشعارات الويب وتطبيق الجوال والبريد',
    'Reels and video advertisements' => 'الريلز وإعلانات الفيديو',
    'Image watermark configuration' => 'إعدادات العلامة المائية للصور',
    'Login and OTP providers' => 'بوابات تسجيل الدخول والتحقق برمز OTP',
    'Populate or remove demo data' => 'توليد أو مسح البيانات التجريبية',
    'Google AdMob configuration' => 'إعدادات جوجل أد موب',
    'Google AdSense configuration' => 'إعدادات جوجل أدسنس',
    'About us page content' => 'محتوى صفحة من نحن',
    'Terms and conditions content' => 'محتوى الشروط والأحكام',
    'Privacy policy content' => 'محتوى سياسة الخصوصية',
    'Refund policy content' => 'محتوى سياسة الاسترجاع',
    'Contact details and page' => 'بيانات التواصل وصفحة اتصل بنا',
    'Firebase project credentials' => 'بيانات اعتماد مشروع فايربيس',
    'Manage languages and translations' => 'إدارة اللغات وملفات الترجمة',
    'Configure payment providers' => 'إعداد وتكوين بوابات الدفع الإلكتروني',
    'Health and connectivity checks' => 'فحص صحة النظام والاتصال',
    'Search engine optimization' => 'تحسين محركات البحث (SEO)',
    'Storage and file management' => 'إدارة التخزين والملفات المرفوعة',
    'Manage email templates' => 'إدارة قوالب وتنسيقات البريد الإلكتروني',
    'AI content generation settings' => 'إعدادات توليد المحتوى بالذكاء الاصطناعي',
    'Default currency configuration' => 'إعداد العملة الافتراضية للمنصة',
    'Find errors in your system' => 'البحث عن الأخطاء وسجلات النظام',
    'No notifications found' => 'لا توجد إشعارات حتى الآن',
    'You are all caught up!' => 'أنت على اطلاع بكل جديد!',
    'More' => 'المزيد',
    'Play Video Ad' => 'تشغيل إعلان الفيديو',
    'View Video Ad' => 'عرض إعلان الفيديو',
    'Item Listing (Ads)' => 'إعلان عادي',
    'Advertisement (Featured Ads)' => 'إعلان مميز',
    'Global' => 'عام',
    'Category Based' => 'حسب القسم',
    'No translations available' => 'لا توجد ترجمات متاحة',
    'Reported' => 'تم الإبلاغ',
    'Ad not visible in frontend' => 'الإعلان غير ظاهر في واجهة الموقع',
    'DELETED' => 'محذوف',
    'No Ads Data Available' => 'لا تتوفر بيانات للإعلانات حالياً',
    'Advertisement statistics will appear here once listings become active on the platform.' => 'ستظهر إحصائيات الإعلانات هنا بمجرد نشر إعلانات نشطة في المنصة.',
    'No Category Data Found' => 'لا تتوفر بيانات للأقسام حالياً',
    'Category-wise advertisement insights will appear once ads are posted across categories.' => 'ستظهر إحصائيات الأقسام عند إضافة إعلانات ضمن الأقسام المختلفة.',
    'No Sold Item Analytics Available' => 'لا تتوفر تحليلات للمنتجات المباعة',
    'Sold item statistics will be displayed after completed transactions are recorded.' => 'ستظهر إحصائيات المنتجات المباعة بمجرد تسجيل عمليات بيع مكتملة.',
    'No Customer Statistics Available' => 'لا تتوفر إحصائيات للعملاء حالياً',
    'Customer insights and engagement data will appear once platform activity is available.' => 'ستظهر تحليلات العملاء وتفاعلهم فور توفر نشاط في المنصة.',
    'Buy Now' => 'شراء الآن',
    'Like what you see? Get the full version' => 'أعجبك النظام؟ احصل على النسخة الكاملة الآن',
    'Create' => 'إنشاء',
    'Add' => 'إضافة',
    'Add New' => 'إضافة جديد',
    'Submit' => 'إرسال',
    'Filter' => 'تصفية',
    'Reset' => 'إعادة تعيين',
    'Close' => 'إغلاق',
    'Back' => 'رجوع',
    'Success' => 'نجاح',
    'Error' => 'خطأ',
    'Warning' => 'تحذير',
    'Info' => 'معلومات',
    'Yes, Delete' => 'نعم، احذف',
    'Yes, delete it!' => 'نعم، احذفه!',
    'Are you sure you want to delete this?' => 'هل أنت متأكد من رغبتك في حذف هذا العنصر؟',
    'Operation Failed' => 'فشلت العملية',
    'Operation Successful' => 'تمت العملية بنجاح',
    'Data Created Successfully' => 'تم إنشاء البيانات بنجاح',
    'Data Updated Successfully' => 'تم تحديث البيانات بنجاح',
    'Data Deleted Successfully' => 'تم حذف البيانات بنجاح',
];

// 2. Map from en_web / ar_web
if (file_exists($enWebPath) && file_exists($arWebPath)) {
    $enWeb = json_decode(file_get_contents($enWebPath), true);
    $arWeb = json_decode(file_get_contents($arWebPath), true);
    foreach ($enWeb as $k => $v) {
        $trimV = trim($v);
        if (isset($arWeb[$k]) && !empty($arWeb[$k])) {
            $curated[$trimV] = $arWeb[$k];
        }
    }
}

// Apply curated
foreach ($curated as $k => $v) {
    if (isset($enData[$k])) {
        $arData[$k] = $v;
    }
}

echo "Curated / Web matched: " . count($arData) . " keys.\n";

// 3. Find remaining keys to translate
$missing = [];
foreach ($enData as $k => $v) {
    if (!isset($arData[$k]) || empty($arData[$k])) {
        $missing[$k] = $v;
    }
}

echo "Remaining keys to translate: " . count($missing) . "\n";

$translator = new GoogleTranslate('ar');
$translator->setSource('en');

// Process in chunks of 20 keys with ~~~ delimiter
$chunks = array_chunk($missing, 20, true);
$totalChunks = count($chunks);
$chunkIndex = 0;

$delimiter = ' ~~~ ';

foreach ($chunks as $chunk) {
    $chunkIndex++;
    $keys = array_keys($chunk);
    $values = array_values($chunk);

    // Clean values for batching (remove ~~~ if present inside value)
    $cleanValues = array_map(function ($val) {
        return str_replace('~~~', '-', $val);
    }, $values);

    $batchText = implode($delimiter, $cleanValues);

    try {
        $translatedBatch = $translator->translate($batchText);
        $translatedParts = array_map('trim', explode('~~~', $translatedBatch));

        if (count($translatedParts) === count($values)) {
            foreach ($keys as $i => $k) {
                $arData[$k] = $translatedParts[$i];
            }
        } else {
            // Count mismatch: translate individually
            echo "Chunk {$chunkIndex}: count mismatch (" . count($translatedParts) . " vs " . count($values) . "), translating individually...\n";
            foreach ($chunk as $k => $v) {
                try {
                    $arData[$k] = $translator->translate($v);
                } catch (\Exception $e) {
                    $arData[$k] = $v;
                }
            }
        }
    } catch (\Exception $e) {
        echo "Chunk {$chunkIndex} error: " . $e->getMessage() . " - fallback to individual\n";
        foreach ($chunk as $k => $v) {
            try {
                $arData[$k] = $translator->translate($v);
            } catch (\Exception $ex) {
                $arData[$k] = $v;
            }
        }
    }

    echo "Chunk {$chunkIndex}/{$totalChunks} done (" . count($arData) . "/" . count($enData) . ")\n";
    flush();

    // Save after every 2 chunks
    if ($chunkIndex % 2 === 0 || $chunkIndex === $totalChunks) {
        // Re-apply curated so high priority strings are never overridden
        foreach ($curated as $ck => $cv) {
            if (isset($enData[$ck])) {
                $arData[$ck] = $cv;
            }
        }
        file_put_contents($arPath, json_encode($arData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }
}

// Final save
foreach ($curated as $ck => $cv) {
    if (isset($enData[$ck])) {
        $arData[$ck] = $cv;
    }
}

file_put_contents($arPath, json_encode($arData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
echo "\nDONE! Successfully generated " . count($arData) . " translations in resources/lang/ar.json\n";
