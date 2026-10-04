<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Language;
use App\Models\SeoDetail;
use App\Models\Translation;
use App\Services\CachingService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CategoryDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // 1. Ensure target directory for category images exists
        $categoryDir = storage_path('app/public/category');
        if (!File::exists($categoryDir)) {
            File::makeDirectory($categoryDir, 0755, true);
        }

        // 2. Fetch language IDs
        $enLang = Language::where('code', 'en')->first();
        $arLang = Language::where('code', 'ar')->first();

        $enId = $enLang ? $enLang->id : 1;
        $arId = $arLang ? $arLang->id : 2;

        // 3. Define Comprehensive Real Categories Data
        $categoriesData = [
            [
                'name_en' => 'Vehicles & Cars',
                'name_ar' => 'سيارات ومركبات',
                'slug' => 'vehicles',
                'icon_symbol' => '🚗',
                'color_start' => '#0284c7',
                'color_end' => '#0369a1',
                'desc_en' => 'Find new and used cars, motorcycles, auto spare parts, commercial trucks, and vehicle rental services.',
                'desc_ar' => 'بيع وشراء السيارات الجديدة والمستعملة، الدراجات النارية، قطع الغيار، والشاحنات، وخدمات تأجير السيارات.',
                'is_job' => 0,
                'price_optional' => 0,
                'subcategories' => [
                    [
                        'name_en' => 'Cars for Sale',
                        'name_ar' => 'سيارات للبيع',
                        'slug' => 'cars-for-sale',
                        'icon_symbol' => '🚘',
                        'desc_en' => 'Sedan, SUV, Hatchback, Luxury, and Electric cars for sale.',
                        'desc_ar' => 'سيارات سيدان، دفع رباعي، هاتشباك، وسيارات كهربائية للبيع.',
                    ],
                    [
                        'name_en' => 'Motorcycles & Scooters',
                        'name_ar' => 'دراجات نارية وسكوتر',
                        'slug' => 'motorcycles-scooters',
                        'icon_symbol' => '🏍️',
                        'desc_en' => 'Sports bikes, cruisers, scooters, and quad bikes.',
                        'desc_ar' => 'دراجات رياضية، سكوترات، ودراجات صحراوية.',
                    ],
                    [
                        'name_en' => 'Auto Spare Parts & Accessories',
                        'name_ar' => 'قطع غيار واكسسوارات',
                        'slug' => 'auto-parts-accessories',
                        'icon_symbol' => '⚙️',
                        'desc_en' => 'Engines, tires, car audio, lighting, and performance parts.',
                        'desc_ar' => 'محركات، إطارات، أنظمة صوتية، إضاءة، وقطع تعديل.',
                    ],
                    [
                        'name_en' => 'Commercial Trucks & Heavy Vehicles',
                        'name_ar' => 'شاحنات ومعدات ثقيلة',
                        'slug' => 'trucks-heavy-vehicles',
                        'icon_symbol' => '🚚',
                        'desc_en' => 'Vans, pickup trucks, trailers, and construction equipment.',
                        'desc_ar' => 'حافلات، بيك أب، شاحنات نقل، وآليات بناء.',
                    ],
                    [
                        'name_en' => 'Car Rental Services',
                        'name_ar' => 'تأجير سيارات',
                        'slug' => 'car-rental-services',
                        'icon_symbol' => '🔑',
                        'desc_en' => 'Daily, weekly, and monthly vehicle rentals.',
                        'desc_ar' => 'عقود تأجير سيارات يومية وأسبوعية وشهرية.',
                    ],
                ]
            ],
            [
                'name_en' => 'Properties & Real Estate',
                'name_ar' => 'عقارات',
                'slug' => 'real-estate',
                'icon_symbol' => '🏡',
                'color_start' => '#059669',
                'color_end' => '#047857',
                'desc_en' => 'Residential apartments, luxury villas, commercial offices, and prime lands for sale and rent.',
                'desc_ar' => 'شقق سكنية، فلل فاخرة، مكاتب تجارية، وأراضٍ مميزة للبيع وللإيجار بأفضل الأسعار.',
                'is_job' => 0,
                'price_optional' => 0,
                'subcategories' => [
                    [
                        'name_en' => 'Apartments for Sale',
                        'name_ar' => 'شقق للبيع',
                        'slug' => 'apartments-for-sale',
                        'icon_symbol' => '🏢',
                        'desc_en' => 'Modern apartments, studios, and penthouses for purchase.',
                        'desc_ar' => 'شقق سكنية، استوديوهات، وبنتهاوس للتملك.',
                    ],
                    [
                        'name_en' => 'Apartments for Rent',
                        'name_ar' => 'شقق للإيجار',
                        'slug' => 'apartments-for-rent',
                        'icon_symbol' => '🔑',
                        'desc_en' => 'Furnished and unfurnished rental flats.',
                        'desc_ar' => 'شقق مفروشة وغير مفروشة للإيجار السنوي والشهري.',
                    ],
                    [
                        'name_en' => 'Villas & Houses for Sale',
                        'name_ar' => 'فلل ومنازل للبيع',
                        'slug' => 'villas-houses-for-sale',
                        'icon_symbol' => '🏰',
                        'desc_en' => 'Stand-alone villas, townhouses, and family duplexes.',
                        'desc_ar' => 'فلل مستقلة، تاون هاوس، ودوبلكس عائلي.',
                    ],
                    [
                        'name_en' => 'Commercial Properties & Offices',
                        'name_ar' => 'عقارات تجارية ومكاتب',
                        'slug' => 'commercial-properties',
                        'icon_symbol' => '🏬',
                        'desc_en' => 'Shops, showrooms, warehouses, and executive offices.',
                        'desc_ar' => 'محلات، معارض، مستودعات، ومكاتب إدارية.',
                    ],
                    [
                        'name_en' => 'Lands & Plots for Sale',
                        'name_ar' => 'أراضي ومزارع للبيع',
                        'slug' => 'lands-plots-for-sale',
                        'icon_symbol' => '🏞️',
                        'desc_en' => 'Residential, commercial, industrial, and agricultural plots.',
                        'desc_ar' => 'أراضٍ سكنية، تجارية، صناعية، ومزارع.',
                    ],
                ]
            ],
            [
                'name_en' => 'Mobile Phones & Tablets',
                'name_ar' => 'هواتف وأجهزة لوحية',
                'slug' => 'mobile-phones-tablets',
                'icon_symbol' => '📱',
                'color_start' => '#4f46e5',
                'color_end' => '#3730a3',
                'desc_en' => 'Latest Apple iPhones, Samsung Galaxy, Android tablets, smartwatches, and accessories.',
                'desc_ar' => 'أحدث هواتف آيفون وسامسونج، أجهزة لوحية، ساعات ذكية، وشواحن وإكسسوارات.',
                'is_job' => 0,
                'price_optional' => 0,
                'subcategories' => [
                    [
                        'name_en' => 'Smartphones',
                        'name_ar' => 'هواتف ذكية',
                        'slug' => 'smartphones',
                        'icon_symbol' => '📲',
                        'desc_en' => 'Apple iPhone, Samsung, Xiaomi, Google Pixel, Huawei.',
                        'desc_ar' => 'آبل آيفون، سامسونج، شاومي، جوجل بكسل، هواوي.',
                    ],
                    [
                        'name_en' => 'Tablets & iPads',
                        'name_ar' => 'أجهزة لوحية وآيباد',
                        'slug' => 'tablets-ipads',
                        'icon_symbol' => '📟',
                        'desc_en' => 'Apple iPad Pro, Air, Mini, Samsung Galaxy Tab.',
                        'desc_ar' => 'آيباد برو، آيباد إير، وسامسونج جالاكسي تاب.',
                    ],
                    [
                        'name_en' => 'Smart Watches & Bands',
                        'name_ar' => 'ساعات ذكية وأساور',
                        'slug' => 'smart-watches',
                        'icon_symbol' => '⌚',
                        'desc_en' => 'Apple Watch, Galaxy Watch, fitness trackers.',
                        'desc_ar' => 'ساعات آبل، ساعات سامسونج، وأساور رياضية.',
                    ],
                    [
                        'name_en' => 'Mobile Accessories',
                        'name_ar' => 'إكسسوارات الهواتف',
                        'slug' => 'mobile-accessories',
                        'icon_symbol' => '🎧',
                        'desc_en' => 'Phone cases, wireless chargers, AirPods, power banks.',
                        'desc_ar' => 'كفرات حماية، شواحن لاسلكية، سماعات، وبنوك طاقة.',
                    ],
                ]
            ],
            [
                'name_en' => 'Electronics & Appliances',
                'name_ar' => 'إلكترونيات وأجهزة منزلية',
                'slug' => 'electronics-home-appliances',
                'icon_symbol' => '💻',
                'color_start' => '#0284c7',
                'color_end' => '#1d4ed8',
                'desc_en' => 'High performance laptops, 4K TVs, home cinema, refrigerators, and washing machines.',
                'desc_ar' => 'أجهزة لابتوب قوية، شاشات 4K، مسارح منزلية، ثلاجات، وغسالات ملابس وأطباق.',
                'is_job' => 0,
                'price_optional' => 0,
                'subcategories' => [
                    [
                        'name_en' => 'Laptops & Computers',
                        'name_ar' => 'لابتوبات وأجهزة كمبيوتر',
                        'slug' => 'laptops-computers',
                        'icon_symbol' => '💻',
                        'desc_en' => 'MacBook, Dell, HP, Lenovo, Gaming Desktops, monitors.',
                        'desc_ar' => 'ماك بوك، ديل، إتش بي، لينوفو، كمبيوترات وشاشات.',
                    ],
                    [
                        'name_en' => 'TVs & Audio Systems',
                        'name_ar' => 'شاشات وأنظمة صوتية',
                        'slug' => 'tvs-audio-systems',
                        'icon_symbol' => '📺',
                        'desc_en' => 'Smart OLED/QLED TVs, soundbars, home cinema.',
                        'desc_ar' => 'شاشات أوليد وكيوليد سمارت، ساوند بار، ومكبرات صوت.',
                    ],
                    [
                        'name_en' => 'Large Home Appliances',
                        'name_ar' => 'أجهزة منزلية كبيرة',
                        'slug' => 'large-home-appliances',
                        'icon_symbol' => '🧊',
                        'desc_en' => 'Refrigerators, washing machines, dryers, air conditioners.',
                        'desc_ar' => 'ثلاجات، غسالات ملابس، مجففات، ومكيفات هواء.',
                    ],
                    [
                        'name_en' => 'Small Kitchen Appliances',
                        'name_ar' => 'أجهزة المطبخ الصغيرة',
                        'slug' => 'small-kitchen-appliances',
                        'icon_symbol' => '☕',
                        'desc_en' => 'Coffee machines, microwaves, air fryers, blenders.',
                        'desc_ar' => 'ماكينات قهوة، ميكروويف، قلايات هوائية، وخلاطات.',
                    ],
                    [
                        'name_en' => 'Cameras & Photography',
                        'name_ar' => 'كاميرات ومعدات تصوير',
                        'slug' => 'cameras-photography',
                        'icon_symbol' => '📷',
                        'desc_en' => 'DSLR, mirrorless cameras, lenses, drones, lighting.',
                        'desc_ar' => 'كاميرات احترافية، عدسات، طائرات درون، ومعدات إضاءة.',
                    ],
                ]
            ],
            [
                'name_en' => 'Home & Furniture',
                'name_ar' => 'أثاث وديكور منزلي',
                'slug' => 'home-furniture',
                'icon_symbol' => '🛋️',
                'color_start' => '#d97706',
                'color_end' => '#92400e',
                'desc_en' => 'Elegant living room sets, master bedrooms, modern kitchens, carpets, and lighting decor.',
                'desc_ar' => 'أطقم كنب عصرية، غرف نوم رئيسية، مطابخ حديثة، سجاد فاخر، وإضاءة ديكورية.',
                'is_job' => 0,
                'price_optional' => 0,
                'subcategories' => [
                    [
                        'name_en' => 'Living Room Furniture',
                        'name_ar' => 'أثاث غرفة المعيشة',
                        'slug' => 'living-room-furniture',
                        'icon_symbol' => '🛋️',
                        'desc_en' => 'Sofas, sectionals, recliners, coffee tables, TV units.',
                        'desc_ar' => 'كنب، كراسي استرخاء، طاولات قهوة، ووحدات تلفزيون.',
                    ],
                    [
                        'name_en' => 'Bedroom Furniture',
                        'name_ar' => 'أثاث غرف النوم',
                        'slug' => 'bedroom-furniture',
                        'icon_symbol' => '🛏️',
                        'desc_en' => 'Beds, mattresses, wardrobes, dressers, nightstands.',
                        'desc_ar' => 'أسرة، مراتب طبية، خزائن ملابس، وتسريحات.',
                    ],
                    [
                        'name_en' => 'Kitchen & Dining Furniture',
                        'name_ar' => 'مطابخ وغرف طعام',
                        'slug' => 'kitchen-dining-furniture',
                        'icon_symbol' => '🍽️',
                        'desc_en' => 'Dining tables, chairs, bar stools, kitchen cabinets.',
                        'desc_ar' => 'طاولات طعام، كراسي، مطابخ جاهزة، وخزائن.',
                    ],
                    [
                        'name_en' => 'Home Decor & Rugs',
                        'name_ar' => 'ديكور وسجاد وإضاءة',
                        'slug' => 'home-decor-rugs',
                        'icon_symbol' => '🖼️',
                        'desc_en' => 'Wall art, mirrors, luxury carpets, chandeliers.',
                        'desc_ar' => 'لوحات جدارية، مرايا، سجاد تركي وفاخر، ونجف.',
                    ],
                    [
                        'name_en' => 'Garden & Outdoor Furniture',
                        'name_ar' => 'أثاث الحدائق والخارجية',
                        'slug' => 'garden-outdoor-furniture',
                        'icon_symbol' => '🪴',
                        'desc_en' => 'Patio sets, outdoor chairs, swings, umbrellas.',
                        'desc_ar' => 'جلسات حدائق، كراسي شرفة، مراجيح، ومظلات خارجية.',
                    ],
                ]
            ],
            [
                'name_en' => 'Fashion & Beauty',
                'name_ar' => 'أزياء وموضة وجمال',
                'slug' => 'fashion-beauty',
                'icon_symbol' => '👗',
                'color_start' => '#e11d48',
                'color_end' => '#9f1239',
                'desc_en' => 'Trendy fashion for men, women, and kids, luxury brand watches, jewelry, perfumes, and shoes.',
                'desc_ar' => 'أحدث صيحات الموضة للرجال والنساء والأطفال، ساعات ماركات، مجوهرات، وعطور أصلية.',
                'is_job' => 0,
                'price_optional' => 0,
                'subcategories' => [
                    [
                        'name_en' => 'Men\'s Fashion & Shoes',
                        'name_ar' => 'ملابس وأحذية رجالية',
                        'slug' => 'mens-fashion-shoes',
                        'icon_symbol' => '👔',
                        'desc_en' => 'Suits, shirts, casual wear, sneakers, leather shoes.',
                        'desc_ar' => 'بدلات، قمصان، ملابس كاجوال، وأحذية رياضية ورسمية.',
                    ],
                    [
                        'name_en' => 'Women\'s Fashion & Bags',
                        'name_ar' => 'ملابس وحقائب نسائية',
                        'slug' => 'womens-fashion-bags',
                        'icon_symbol' => '👜',
                        'desc_en' => 'Abayas, dresses, designer handbags, evening wear.',
                        'desc_ar' => 'عبايات، فساتين سهرة، حقائب ماركات، وملابس راقية.',
                    ],
                    [
                        'name_en' => 'Kids & Baby Clothing',
                        'name_ar' => 'ملابس وأحذية أطفال',
                        'slug' => 'kids-baby-clothing',
                        'icon_symbol' => '👶',
                        'desc_en' => 'Infant outfits, school wear, party wear, kids shoes.',
                        'desc_ar' => 'ملابس مواليد، ملابس مدرسية، وأحذية أطفال.',
                    ],
                    [
                        'name_en' => 'Watches & Jewelry',
                        'name_ar' => 'ساعات ومجوهرات',
                        'slug' => 'watches-jewelry',
                        'icon_symbol' => '💎',
                        'desc_en' => 'Luxury Swiss watches, gold jewelry, diamonds, sunglasses.',
                        'desc_ar' => 'ساعات سويسرية فاخرة، ذهب وألماس، ونظارات شمسية.',
                    ],
                ]
            ],
            [
                'name_en' => 'Video Games & Consoles',
                'name_ar' => 'ألعاب فيديو وأجهزة ترفيه',
                'slug' => 'video-games-consoles',
                'icon_symbol' => '🎮',
                'color_start' => '#7c3aed',
                'color_end' => '#5b21b6',
                'desc_en' => 'PlayStation 5, Xbox Series X, Nintendo Switch, Gaming PCs, controllers, and VR headsets.',
                'desc_ar' => 'أجهزة بلايستيشن 5، إكس بوكس سيريس، نينتندو، أجهزة قيمنق، ونظارات واقع افتراضي.',
                'is_job' => 0,
                'price_optional' => 0,
                'subcategories' => [
                    [
                        'name_en' => 'Gaming Consoles',
                        'name_ar' => 'أجهزة الألعاب',
                        'slug' => 'gaming-consoles',
                        'icon_symbol' => '🕹️',
                        'desc_en' => 'PS5, PS4, Xbox Series X/S, Nintendo Switch OLED.',
                        'desc_ar' => 'بلايستيشن 5 و 4، إكس بوكس، ونينتندو سويتش.',
                    ],
                    [
                        'name_en' => 'Video Games & Titles',
                        'name_ar' => 'أشرطة وألعاب فيديو',
                        'slug' => 'video-games-discs',
                        'icon_symbol' => '💿',
                        'desc_en' => 'FIFA, Call of Duty, GTA, RPGs, adventure games.',
                        'desc_ar' => 'فيفا، كول أوف ديوتي، ألعاب مغامرات وأكشن.',
                    ],
                    [
                        'name_en' => 'Controllers & Gaming Gear',
                        'name_ar' => 'أذرع تحكم وإكسسوارات قيمنق',
                        'slug' => 'gaming-controllers-gear',
                        'icon_symbol' => '🎧',
                        'desc_en' => 'Wireless controllers, gaming headsets, racing wheels.',
                        'desc_ar' => 'أذرع تحكم لاسلكية، سماعات قيمنق محيطية، ومقود سباق.',
                    ],
                    [
                        'name_en' => 'Gaming Chairs & Desks',
                        'name_ar' => 'كراسي وطاولات قيمنق',
                        'slug' => 'gaming-furniture',
                        'icon_symbol' => '🪑',
                        'desc_en' => 'Ergonomic gaming chairs, RGB desks.',
                        'desc_ar' => 'كراسي قيمنق طبية مريحة، وطاولات مزودة بإضاءة RGB.',
                    ],
                ]
            ],
            [
                'name_en' => 'Jobs & Careers',
                'name_ar' => 'وظائف وفرص عمل',
                'slug' => 'jobs-careers',
                'icon_symbol' => '💼',
                'color_start' => '#2563eb',
                'color_end' => '#1e40af',
                'desc_en' => 'Find verified job vacancies, recruitment announcements, and career opportunities across all industries.',
                'desc_ar' => 'ابحث عن وظائف شاغرة، فرص عمل مميزة، وعروض توظيف معتمدة في كافة التخصصات والشركات.',
                'is_job' => 1,
                'price_optional' => 1,
                'subcategories' => [
                    [
                        'name_en' => 'IT & Software Development',
                        'name_ar' => 'تكنولوجيا وتطوير برمجيات',
                        'slug' => 'it-software-jobs',
                        'icon_symbol' => '💻',
                        'desc_en' => 'Full-stack developers, mobile app devs, UI/UX, DevOps.',
                        'desc_ar' => 'مبرمجين، مطوري تطبيقات، مصممي واجهات، وأمن سيبراني.',
                    ],
                    [
                        'name_en' => 'Sales & Marketing',
                        'name_ar' => 'مبيعات وتسويق',
                        'slug' => 'sales-marketing-jobs',
                        'icon_symbol' => '📈',
                        'desc_en' => 'Sales executives, digital marketing specialists, account managers.',
                        'desc_ar' => 'مسؤولي مبيعات، أخصائيي تسويق رقمي، وإدارة حسابات.',
                    ],
                    [
                        'name_en' => 'Accounting & Finance',
                        'name_ar' => 'محاسبة ومالية',
                        'slug' => 'accounting-finance-jobs',
                        'icon_symbol' => '📊',
                        'desc_en' => 'Senior accountants, financial analysts, auditors.',
                        'desc_ar' => 'محاسبين قانونيين، محللين ماليين، ومدققي حسابات.',
                    ],
                    [
                        'name_en' => 'Customer Service & Admin',
                        'name_ar' => 'خدمة عملاء وإدارة',
                        'slug' => 'customer-service-admin-jobs',
                        'icon_symbol' => '📞',
                        'desc_en' => 'Call center agents, executive assistants, receptionists.',
                        'desc_ar' => 'خدمة عملاء، سكرتارية وتنظيم إداري، وموظفي استقبال.',
                    ],
                    [
                        'name_en' => 'Engineering & Technical',
                        'name_ar' => 'هندسة وفنيين',
                        'slug' => 'engineering-technical-jobs',
                        'icon_symbol' => '🏗️',
                        'desc_en' => 'Civil, electrical, mechanical engineers and technicians.',
                        'desc_ar' => 'مهندسين مدني، كهرباء، ميكانيكا، وفنيين متخصصين.',
                    ],
                ]
            ],
            [
                'name_en' => 'Services & Business',
                'name_ar' => 'خدمات وأعمال',
                'slug' => 'services-business',
                'icon_symbol' => '🛠️',
                'color_start' => '#0891b2',
                'color_end' => '#0e7490',
                'desc_en' => 'Professional home repair, furniture moving, deep cleaning, graphic design, and private tutoring.',
                'desc_ar' => 'صيانة منزلية شاملة، نقل وتغليف أثاث، تنظيف عميق، تصميم جرافيك، ودروس خصوصية.',
                'is_job' => 0,
                'price_optional' => 1,
                'subcategories' => [
                    [
                        'name_en' => 'Home Maintenance & Electricity',
                        'name_ar' => 'صيانة منزلية وكهرباء',
                        'slug' => 'home-maintenance-services',
                        'icon_symbol' => '🔧',
                        'desc_en' => 'Plumbing, electrical work, HVAC, painting, carpentry.',
                        'desc_ar' => 'سباكة، تمديدات كهرباء، تكييف وتبريد، ودهانات.',
                    ],
                    [
                        'name_en' => 'Moving & Furniture Transport',
                        'name_ar' => 'نقل وتغليف عفش',
                        'slug' => 'moving-furniture-transport',
                        'icon_symbol' => '📦',
                        'desc_en' => 'Professional relocation, packing, assembly, express delivery.',
                        'desc_ar' => 'نقل عفش مع الفك والتركيب والتغليف الاحترافي.',
                    ],
                    [
                        'name_en' => 'Cleaning & Pest Control',
                        'name_ar' => 'تنظيف ومكافحة حشرات',
                        'slug' => 'cleaning-pest-control-services',
                        'icon_symbol' => '🧹',
                        'desc_en' => 'Home cleaning, carpet washing, safe pest eradication.',
                        'desc_ar' => 'تنظيف منازل وفلل، غسيل كنب وسجاد، ورش مبيدات آمنة.',
                    ],
                    [
                        'name_en' => 'Design & Digital Marketing',
                        'name_ar' => 'تصميم وتسويق رقمي',
                        'slug' => 'design-digital-marketing-services',
                        'icon_symbol' => '🎨',
                        'desc_en' => 'Logo design, social media ads, web development, SEO.',
                        'desc_ar' => 'تصميم هويات بصرية، إدارة إعلانات، وبرمجة مواقع.',
                    ],
                    [
                        'name_en' => 'Tutoring & Private Lessons',
                        'name_ar' => 'تعليم ودروس خصوصية',
                        'slug' => 'tutoring-private-lessons',
                        'icon_symbol' => '📚',
                        'desc_en' => 'School curriculum, language courses, musical training.',
                        'desc_ar' => 'مدرسين خصوصيين للمناهج والجامعات، وتعليم لغات.',
                    ],
                ]
            ],
            [
                'name_en' => 'Animals & Pets',
                'name_ar' => 'حيوانات أليفة ومستلزماتها',
                'slug' => 'animals-pets',
                'icon_symbol' => '🐾',
                'color_start' => '#10b981',
                'color_end' => '#047857',
                'desc_en' => 'Cats, purebred dogs, birds, horses, premium pet foods, cages, and veterinary accessories.',
                'desc_ar' => 'قطط شيرازي، كلاب حراسة وتربية، طيور زينة، خيول، وأغذية ومستلزمات بيطرية متكاملة.',
                'is_job' => 0,
                'price_optional' => 0,
                'subcategories' => [
                    [
                        'name_en' => 'Cats & Kittens',
                        'name_ar' => 'قطط',
                        'slug' => 'cats-kittens',
                        'icon_symbol' => '🐱',
                        'desc_en' => 'Persian, Siamese, British Shorthair, Scottish Fold kittens.',
                        'desc_ar' => 'قطط شيرازي، سيامي، بريطاني، وهيمالايا.',
                    ],
                    [
                        'name_en' => 'Dogs & Puppies',
                        'name_ar' => 'كلاب',
                        'slug' => 'dogs-puppies',
                        'icon_symbol' => '🐶',
                        'desc_en' => 'Golden Retriever, German Shepherd, Husky, Poodle.',
                        'desc_ar' => 'جولدن ريتريفر، جيرمن شيبرد، وهاسكي.',
                    ],
                    [
                        'name_en' => 'Birds & Parrots',
                        'name_ar' => 'طيور وببغاوات',
                        'slug' => 'birds-parrots',
                        'icon_symbol' => '🦜',
                        'desc_en' => 'African Grey, Cockatiel, Budgie, Canaries, Lovebirds.',
                        'desc_ar' => 'ببغاء كاسكو، كروان، كناري، وطيور حب ملونة.',
                    ],
                    [
                        'name_en' => 'Horses & Livestock',
                        'name_ar' => 'خيول ومواشي',
                        'slug' => 'horses-livestock',
                        'icon_symbol' => '🐎',
                        'desc_en' => 'Arabian horses, sheep, goats, camels, stable equipment.',
                        'desc_ar' => 'خيول عربية أصيلة، أغنام، ماعز، وإبل ومعدات إسطبلات.',
                    ],
                    [
                        'name_en' => 'Pet Supplies & Food',
                        'name_ar' => 'أغذية ومستلزمات حيوانات',
                        'slug' => 'pet-supplies-food',
                        'icon_symbol' => '🦴',
                        'desc_en' => 'Dry food, cages, carriers, scratching posts, medical supplies.',
                        'desc_ar' => 'أطعمة جافة، أقفاص، حقائب تنقل، وأدوية ومكملات.',
                    ],
                ]
            ],
        ];

        $sequence = 1;

        foreach ($categoriesData as $catData) {
            // Check for real photo first, fallback to SVG
            $jpgFile = "category/{$catData['slug']}.jpg";
            $svgFile = "category/{$catData['slug']}.svg";
            
            if (File::exists(storage_path("app/public/{$jpgFile}"))) {
                $imageFilename = $jpgFile;
            } else {
                $imageFilename = $svgFile;
                $this->createCategorySvg(
                    storage_path("app/public/{$svgFile}"),
                    $catData['name_en'],
                    $catData['name_ar'],
                    $catData['icon_symbol'],
                    $catData['color_start'],
                    $catData['color_end']
                );
            }

            // Create or update main category
            $mainCategory = Category::updateOrCreate(
                ['slug' => $catData['slug']],
                [
                    'name' => $catData['name_en'],
                    'parent_category_id' => null,
                    'image' => $imageFilename,
                    'description' => $catData['desc_en'],
                    'status' => 1,
                    'sequence' => $sequence++,
                    'is_featured' => 1,
                    'is_job_category' => $catData['is_job'] ?? 0,
                    'price_optional' => $catData['price_optional'] ?? 0,
                    'is_dummy' => 0,
                ]
            );

            // Store English & Arabic Translations for Main Category
            $this->saveTranslations($mainCategory->id, $enId, $catData['name_en'], $catData['desc_en']);
            $this->saveTranslations($mainCategory->id, $arId, $catData['name_ar'], $catData['desc_ar']);

            // Store SEO Meta
            $this->saveSeoDetail($mainCategory->id, $catData['name_en'], $catData['name_ar'], $catData['desc_en']);

            // Create Subcategories
            $subSequence = 1;
            foreach ($catData['subcategories'] as $subData) {
                $subJpgFile = "category/{$subData['slug']}.jpg";
                $subSvgFile = "category/{$subData['slug']}.svg";

                if (File::exists(storage_path("app/public/{$subJpgFile}"))) {
                    $subImageFilename = $subJpgFile;
                } else {
                    $subImageFilename = $subSvgFile;
                    $this->createCategorySvg(
                        storage_path("app/public/{$subSvgFile}"),
                        $subData['name_en'],
                        $subData['name_ar'],
                        $subData['icon_symbol'],
                        $catData['color_start'],
                        $catData['color_end']
                    );
                }

                $subcategory = Category::updateOrCreate(
                    ['slug' => $subData['slug']],
                    [
                        'name' => $subData['name_en'],
                        'parent_category_id' => $mainCategory->id,
                        'image' => $subImageFilename,
                        'description' => $subData['desc_en'],
                        'status' => 1,
                        'sequence' => $subSequence++,
                        'is_featured' => 0,
                        'is_job_category' => $catData['is_job'] ?? 0,
                        'price_optional' => $catData['price_optional'] ?? 0,
                        'is_dummy' => 0,
                    ]
                );

                // Store Translations for Subcategory
                $this->saveTranslations($subcategory->id, $enId, $subData['name_en'], $subData['desc_en']);
                $this->saveTranslations($subcategory->id, $arId, $subData['name_ar'], $subData['desc_ar']);

                // Store SEO Meta
                $this->saveSeoDetail($subcategory->id, $subData['name_en'], $subData['name_ar'], $subData['desc_en']);
            }
        }

        // 4. Invalidate and refresh cache
        CachingService::removeCache('categories');
        CachingService::removeCache('categories.all');

        $this->command->info('10 Main Categories & 47 Subcategories with Arabic & English translations and images seeded successfully!');
    }

    /**
     * Generate an attractive SVG badge for categories
     */
    private function createCategorySvg(string $filePath, string $nameEn, string $nameAr, string $icon, string $colorStart, string $colorEnd): void
    {
        $svgContent = <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" width="600" height="450" viewBox="0 0 600 450">
  <defs>
    <linearGradient id="catGrad" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" style="stop-color:{$colorStart};stop-opacity:1" />
      <stop offset="100%" style="stop-color:{$colorEnd};stop-opacity:1" />
    </linearGradient>
    <filter id="shadow" x="-10%" y="-10%" width="120%" height="120%">
      <feDropShadow dx="0" dy="12" stdDeviation="16" flood-color="#000000" flood-opacity="0.3" />
    </filter>
  </defs>
  <!-- Background Card -->
  <rect width="600" height="450" rx="32" fill="url(#catGrad)" />
  
  <!-- Subtle decorative circles -->
  <circle cx="520" cy="80" r="140" fill="rgba(255,255,255,0.06)" />
  <circle cx="80" cy="380" r="110" fill="rgba(255,255,255,0.05)" />
  
  <!-- Center Icon Halo -->
  <circle cx="300" cy="170" r="75" fill="rgba(255,255,255,0.22)" filter="url(#shadow)" />
  <circle cx="300" cy="170" r="65" fill="rgba(255,255,255,0.28)" />
  
  <!-- Emoji / Icon Symbol -->
  <text x="300" y="195" font-size="64" text-anchor="middle">{$icon}</text>
  
  <!-- English Title -->
  <text x="300" y="295" font-family="'Plus Jakarta Sans', system-ui, -apple-system, sans-serif" font-size="28" font-weight="800" fill="#ffffff" text-anchor="middle">{$nameEn}</text>
  
  <!-- Arabic Title -->
  <text x="300" y="340" font-family="'Cairo', Tahoma, Arial, sans-serif" font-size="26" font-weight="700" fill="#f8fafc" text-anchor="middle">{$nameAr}</text>
  
  <!-- Sub-label -->
  <text x="300" y="385" font-family="'Plus Jakarta Sans', sans-serif" font-size="14" font-weight="600" fill="rgba(255,255,255,0.7)" text-anchor="middle" letter-spacing="2">WNGEZ MARKETPLACE</text>
</svg>
SVG;

        File::put($filePath, $svgContent);
    }

    /**
     * Store name and description translations
     */
    private function saveTranslations(int $categoryId, int $langId, string $name, string $description): void
    {
        Translation::updateOrCreate(
            [
                'translatable_id' => $categoryId,
                'translatable_type' => Category::class,
                'language_id' => $langId,
                'key' => 'name',
            ],
            ['value' => $name]
        );

        Translation::updateOrCreate(
            [
                'translatable_id' => $categoryId,
                'translatable_type' => Category::class,
                'language_id' => $langId,
                'key' => 'description',
            ],
            ['value' => $description]
        );
    }

    /**
     * Store SEO meta details
     */
    private function saveSeoDetail(int $categoryId, string $nameEn, string $nameAr, string $descEn): void
    {
        SeoDetail::updateOrCreate(
            [
                'seoable_id' => $categoryId,
                'seoable_type' => Category::class,
            ],
            [
                'meta_title' => "{$nameEn} - {$nameAr} | WngeZ",
                'meta_description' => Str::limit($descEn, 155),
                'meta_keywords' => "{$nameEn}, {$nameAr}, classifieds, buy and sell, marketplace, online shopping",
            ]
        );
    }
}
