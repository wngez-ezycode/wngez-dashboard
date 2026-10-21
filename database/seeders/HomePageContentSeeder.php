<?php

namespace Database\Seeders;

use App\Models\HomeScreenSection;
use App\Models\Category;
use App\Models\PopularCategory;
use Illuminate\Database\Seeder;

class HomePageContentSeeder extends Seeder
{
    public function run(): void
    {
        $sections = [
            'hero' => [
                'ar' => ['title' => 'بيع واشتري وانجز', 'subtitle' => 'كل اللي بتدور عليه في مكان واحد', 'search_placeholder' => 'ابحث عن أي إعلان ...', 'search_button' => 'بحث', 'all_categories' => 'كل الأقسام', 'popular_searches' => 'أكثر ما يتم البحث عنه:', 'image' => '/assets/wngez_hero_art_cutout.png'],
                'en' => ['title' => 'Buy, Sell & Get It Done', 'subtitle' => 'Everything you need in one place', 'search_placeholder' => 'Search for anything...', 'search_button' => 'Search', 'all_categories' => 'All Categories', 'popular_searches' => 'Popular searches:', 'image' => '/assets/wngez_hero_art_cutout.png'],
            ],
            'browse_categories' => [
                'ar' => ['title' => 'تصفح حسب الفئة', 'view_all' => 'عرض الكل', 'more' => 'المزيد'],
                'en' => ['title' => 'Browse by Category', 'view_all' => 'View All', 'more' => 'More'],
            ],
            'featured_ads' => [
                'ar' => ['title' => 'أحدث الإعلانات', 'view_all' => 'عرض الكل', 'fallback_location' => 'مصر', 'fallback_time' => 'مؤخراً', 'currency' => 'ج.م'],
                'en' => ['title' => 'Featured Ads', 'view_all' => 'View All', 'fallback_location' => 'Egypt', 'fallback_time' => 'Recently', 'currency' => 'EGP'],
            ],
            'promotional_banners' => [
                'ar' => ['items' => [
                    ['title' => 'عقارك القادم بانتظارك', 'subtitle' => 'شقق - فلل - أراضي', 'button' => 'اكتشف العقارات', 'url' => '/ads/real-estate', 'image' => '/assets/wngez_promo_realestate_v2.webp'],
                    ['title' => 'سيارتك القادمة في انتظارك', 'subtitle' => 'سيارات جديدة ومستعملة', 'button' => 'اكتشف السيارات', 'url' => '/ads/vehicles', 'image' => '/assets/wngez_promo_vehicles_v2.webp'],
                ]],
                'en' => ['items' => [
                    ['title' => 'Your Next Property Awaits', 'subtitle' => 'Apartments - Villas - Lands', 'button' => 'Explore Properties', 'url' => '/ads/real-estate', 'image' => '/assets/wngez_promo_realestate_v2.webp'],
                    ['title' => 'Your Next Car Awaits', 'subtitle' => 'New & Used Cars', 'button' => 'Explore Cars', 'url' => '/ads/vehicles', 'image' => '/assets/wngez_promo_vehicles_v2.webp'],
                ]],
            ],
            'featured_categories' => [
                'ar' => ['title' => 'أقسام مميزة', 'view_all' => 'عرض الكل', 'items' => $this->categories('ar')],
                'en' => ['title' => 'Featured Categories', 'view_all' => 'View All', 'items' => $this->categories('en')],
            ],
            'how_it_works' => [
                'ar' => ['title' => 'كيف يعمل WngeZ ؟', 'items' => [['title' => 'أضف إعلانك', 'description' => 'أضف تفاصيل وصور إعلانك بسهولة'], ['title' => 'تواصل مع المشترين', 'description' => 'تواصل مباشرة واتفق على التفاصيل'], ['title' => 'بيع أو اشتري بكل أمان', 'description' => 'أكمل الصفقة بكل ثقة']]],
                'en' => ['title' => 'How WngeZ Works?', 'items' => [['title' => 'Post Your Ad', 'description' => 'Add details and photos easily'], ['title' => 'Connect with Buyers', 'description' => 'Connect directly and agree on details'], ['title' => 'Deal with Confidence', 'description' => 'Complete your transaction safely']]],
            ],
            'ads_by_city' => [
                'ar' => ['title' => 'إعلانات حسب المدينة', 'view_all' => 'عرض الكل', 'items' => $this->cities('ar')],
                'en' => ['title' => 'Ads by City', 'view_all' => 'View All', 'items' => $this->cities('en')],
            ],
            'download_app' => [
                'ar' => ['image' => '/assets/wngez_download_app_banner_wide.png', 'image_alt' => 'حمّل تطبيق WngeZ', 'play_store_url' => 'https://play.google.com', 'app_store_url' => 'https://apple.com'],
                'en' => ['image' => '/assets/wngez_download_app_banner_wide.png', 'image_alt' => 'Download WngeZ App', 'play_store_url' => 'https://play.google.com', 'app_store_url' => 'https://apple.com'],
            ],
            'why_us' => [
                'ar' => ['title' => 'لماذا WngeZ ؟', 'items' => [['title' => 'مجتمع كبير', 'description' => 'آلاف الإعلانات يومياً'], ['title' => 'جميع الفئات', 'description' => 'كل ما تحتاجه في مكان واحد'], ['title' => 'سريع وسهل', 'description' => 'انشر إعلاناتك خلال دقائق'], ['title' => 'موثوق وآمن', 'description' => 'تجربة بيع وشراء موثوقة']]],
                'en' => ['title' => 'Why WngeZ?', 'items' => [['title' => 'Large Community', 'description' => 'Thousands of daily ads'], ['title' => 'All Categories', 'description' => 'Everything in one place'], ['title' => 'Fast & Easy', 'description' => 'Post ads in minutes'], ['title' => 'Safe & Trusted', 'description' => 'A trusted buying and selling experience']]],
            ],
            'newsletter' => [
                'ar' => ['title' => 'اشترك في نشرتنا البريدية', 'subtitle' => 'احصل على أحدث الإعلانات والعروض مباشرة إلى بريدك الإلكتروني', 'placeholder' => 'أدخل بريدك الإلكتروني', 'button' => 'اشترك', 'success' => 'شكراً لاشتراكك في نشرتنا البريدية!', 'invalid' => 'يرجى إدخال بريد إلكتروني صالح'],
                'en' => ['title' => 'Subscribe to Our Newsletter', 'subtitle' => 'Get the latest ads and special offers delivered to your inbox', 'placeholder' => 'Enter your email address', 'button' => 'Subscribe', 'success' => 'Thank you for subscribing to our newsletter!', 'invalid' => 'Please enter a valid email'],
            ],
        ];

        $sequence = 1;
        foreach ($sections as $sectionType => $content) {
            HomeScreenSection::updateOrCreate(
                ['section_type' => $sectionType],
                ['is_active' => true, 'sequence' => $sequence++, 'content' => $content]
            );
        }

        $popularSlugs = [
            'vehicles',
            'real-estate',
            'mobile-phones-tablets',
            'electronics-home-appliances',
            'home-furniture',
            'fashion-beauty',
            'jobs-careers',
        ];

        foreach ($popularSlugs as $sequence => $slug) {
            $categoryId = Category::where('slug', $slug)->value('id');
            if ($categoryId) {
                PopularCategory::updateOrCreate(
                    ['category_id' => $categoryId],
                    ['sequence' => $sequence + 1]
                );
            }
        }
    }

    private function categories(string $locale): array
    {
        $names = $locale === 'ar'
            ? ['سيارات ومركبات', 'عقارات', 'موبايلات وتابلت', 'إلكترونيات وأجهزة منزلية', 'أثاث وديكور منزلي', 'موضة وأزياء', 'وظائف']
            : ['Vehicles & Cars', 'Properties', 'Phones & Tablets', 'Electronics & Appliances', 'Home & Furniture', 'Fashion & Beauty', 'Jobs'];
        $slugs = ['vehicles', 'real-estate', 'mobile-phones-tablets', 'electronics-home-appliances', 'home-furniture', 'fashion-beauty', 'jobs-careers'];
        return array_map(fn ($name, $slug) => ['name' => $name, 'slug' => $slug, 'image' => "https://admin.wngez.com/storage/category/{$slug}.jpg"], $names, $slugs);
    }

    private function cities(string $locale): array
    {
        $names = $locale === 'ar' ? ['الجيزة', 'طنطا', 'المنصورة', 'الإسكندرية', 'القاهرة', 'أسيوط'] : ['Giza', 'Tanta', 'Mansoura', 'Alexandria', 'Cairo', 'Assiut'];
        $queries = ['Giza', 'Tanta', 'Mansoura', 'Alexandria', 'Cairo', 'Assiut'];
        return array_map(fn ($name, $query) => ['name' => $name, 'query' => $query, 'image' => '/assets/city_' . strtolower($query) . '.jpg'], $names, $queries);
    }
}
