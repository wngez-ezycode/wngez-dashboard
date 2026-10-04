<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\FeaturedItems;
use App\Models\Item;
use App\Models\ItemImages;
use App\Models\Language;
use App\Models\SeoDetail;
use App\Models\Translation;
use App\Models\User;
use App\Services\HelperService;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ItemDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // 1. Language IDs
        $enId = Language::where('code', 'en')->value('id') ?? 1;
        $arId = Language::where('code', 'ar')->value('id') ?? 2;

        // 2. Ensure realistic users/sellers exist
        $adminUser = User::find(1);
        $ahmedUser = User::find(2);

        $nokhbaMotors = User::firstOrCreate(
            ['name' => 'معرض النخبة موتورز'],
            [
                'mobile' => '01011223344',
                'country_code' => '+20',
                'type' => '0',
                'notification' => 1,
                'show_personal_details' => 1,
                'is_verified' => 1,
                'auto_approve_item' => 1,
            ]
        );

        $deyarRealEstate = User::firstOrCreate(
            ['name' => 'ديار مصر للاستثمار العقاري'],
            [
                'mobile' => '01122334455',
                'country_code' => '+20',
                'type' => '0',
                'notification' => 1,
                'show_personal_details' => 1,
                'is_verified' => 1,
                'auto_approve_item' => 1,
            ]
        );

        $technoStore = User::firstOrCreate(
            ['name' => 'تكنو زون ستور'],
            [
                'mobile' => '01233445566',
                'country_code' => '+20',
                'type' => '0',
                'notification' => 1,
                'show_personal_details' => 1,
                'is_verified' => 1,
                'auto_approve_item' => 1,
            ]
        );

        $saraFashion = User::firstOrCreate(
            ['name' => 'سارة هوم وموضة'],
            [
                'mobile' => '01544556677',
                'country_code' => '+20',
                'type' => '0',
                'notification' => 1,
                'show_personal_details' => 1,
                'is_verified' => 1,
                'auto_approve_item' => 1,
            ]
        );

        // 3. Clear existing items and related tables safely
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        ItemImages::truncate();
        FeaturedItems::truncate();
        DB::table('item_offers')->truncate();
        DB::table('item_custom_field_values')->truncate();
        DB::table('favourites')->truncate();
        Translation::where('translatable_type', Item::class)->delete();
        SeoDetail::where('seoable_type', Item::class)->delete();
        Item::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 4. Listing Data (2 items per category = 20 items)
        $listings = [
            // -------------------------------------------------------------
            // Category 1: Vehicles & Cars (1)
            // -------------------------------------------------------------
            [
                'sub_slug' => 'cars-for-sale',
                'user_id' => $nokhbaMotors->id,
                'name_en' => 'Mercedes-Benz C200 2023 AMG Line - Mint Condition',
                'name_ar' => 'مرسيدس بنز C200 موديل 2023 باقة AMG بحالة الزيرو',
                'slug_base' => 'mercedes-benz-c200-2023-amg-line',
                'desc_en' => 'Mercedes-Benz C200 2023 AMG Line, only 18,000 km, full official agency maintenance history, 100% factory paint. Features panoramic sliding sunroof, 360-degree cameras, Burmester sound system, ambient lighting 64 colors, electric leather memory seats, head-up display, radar and blind spot monitor. Valid license for 2 years.',
                'desc_ar' => 'مرسيدس بنز C200 موديل 2023 بباقة AMG الرياضية الكاملة، عداد 18,000 كم فقط، صيانة دورية منتظمة بالتوكيل المعتمد، فابريكا بالكامل بدون أي دهانات نهائياً. مواصفات كاملة: سقف بانوراما، كاميرات 360 درجة، نظام صوتي Burmester، إضاءة محيطية 64 لون، مقاعد جلد كهربائية بذاكرة، رادار ونقطة عمياء، رخصة سارية سنتين.',
                'price' => 2850000,
                'min_salary' => null,
                'max_salary' => null,
                'city' => 'Cairo',
                'state' => 'Cairo',
                'country' => 'Egypt',
                'address' => 'التجمع الخامس، القاهرة الجديدة',
                'lat' => 30.0131,
                'lng' => 31.4913,
                'contact' => '+201011223344',
                'image' => 'item_images/mercedes_c200_2023.jpg',
                'gallery' => ['category/cars-for-sale.jpg', 'item_images/toyota-camry-thumb-1.png'],
                'is_featured' => true,
            ],
            [
                'sub_slug' => 'motorcycles-scooters',
                'user_id' => $ahmedUser ? $ahmedUser->id : 2,
                'name_en' => 'Honda CB750 Hornet 2024 - Like New with Extras',
                'name_ar' => 'هوندا هورنت CB750 موديل 2024 كسر زيرو مع إضافات',
                'slug_base' => 'honda-cb750-hornet-2024',
                'desc_en' => 'Honda CB750 Hornet 2024, matte gray with red trellis frame, only 2,500 km. 755cc twin-cylinder engine, full color 5-inch TFT screen with Bluetooth phone connectivity, 4 riding modes, traction control and dual-channel ABS. Fitted with original crash protectors and radiator guard. Registered with valid license.',
                'desc_ar' => 'دراجة هوندا هورنت CB750 موديل 2024، لون رمادي مط مع شاسيه أحمر، عداد 2,500 كم فقط. محرك 755 سي سي توين سلندر، شاشة TFT ملونة 5 بوصة تدعم البلوتوث والملاحة، 4 أنظمة قيادة مختلفة، مانع انزلاق وفرامل ABS أمامية وخلفية. مزودة بسلايدرات حماية أصلية وحماية رادياتير، رخصة سارية.',
                'price' => 385000,
                'min_salary' => null,
                'max_salary' => null,
                'city' => 'Giza',
                'state' => 'Giza',
                'country' => 'Egypt',
                'address' => 'الشيخ زايد، الجيزة',
                'lat' => 30.0444,
                'lng' => 30.9833,
                'contact' => '+201012345678',
                'image' => 'item_images/honda_cb750_hornet.jpg',
                'gallery' => ['category/motorcycles-scooters.jpg'],
                'is_featured' => false,
            ],

            // -------------------------------------------------------------
            // Category 2: Properties & Real Estate (7)
            // -------------------------------------------------------------
            [
                'sub_slug' => 'apartments-for-sale',
                'user_id' => $deyarRealEstate->id,
                'name_en' => 'Luxury Apartment 195m Ultra Super Lux - New Cairo',
                'name_ar' => 'شقة فاخرة 195م تشطيب ألترا سوبر لوكس بالتجمع الخامس',
                'slug_base' => 'luxury-apartment-195m-new-cairo',
                'desc_en' => 'Luxurious 195 sqm apartment in an exclusive compound in New Cairo near South 90th Street. 3 bedrooms (master en-suite with walk-in dressing), 3 modern bathrooms, expansive 3-piece open reception, fitted American kitchen, private terrace overlooking green parks and water features. Underground parking space and elevator.',
                'desc_ar' => 'شقة مميزة 195 متر في كمبوند راقي بالتجمع الخامس بالقرب من شارع التسعين الجنوبي. تتكون من 3 غرف نوم (منها ماستر بحمام ودريسنج روم)، 3 حمامات بتشطيب فندقي، ريسبشن واسع 3 قطع رخام، مطبخ أمريكي مجهز، وتراس بفيو مفتوح على المساحات الخضراء والبحيرات. حصة بالجراج ومصعد من الجراج للشقة.',
                'price' => 5400000,
                'min_salary' => null,
                'max_salary' => null,
                'city' => 'Cairo',
                'state' => 'Cairo',
                'country' => 'Egypt',
                'address' => 'شارع التسعين، التجمع الخامس، القاهرة',
                'lat' => 30.0245,
                'lng' => 31.4878,
                'contact' => '+201122334455',
                'image' => 'item_images/luxury_apartment_cairo.jpg',
                'gallery' => ['category/apartments-for-sale.jpg'],
                'is_featured' => true,
            ],
            [
                'sub_slug' => 'villas-houses-for-sale',
                'user_id' => $deyarRealEstate->id,
                'name_en' => 'Modern Townhouse Villa with Private Pool - Sheikh Zayed',
                'name_ar' => 'فيلا تاون هاوس مودرن بحمام سباحة خاص في الشيخ زايد',
                'slug_base' => 'modern-townhouse-villa-sheikh-zayed',
                'desc_en' => 'Architect-designed modern townhouse villa with 320 sqm built-up area and 180 sqm private landscaped garden. 4 master bedrooms with en-suite baths, maid room, large open living spaces, German designer kitchen, and private heated swimming pool with smart irrigation system. Immediate delivery, all utilities connected.',
                'desc_ar' => 'فيلا تاون هاوس مساحة المباني 320م والحديقة 180م بتصميم معماري حديث. 4 غرف نوم ماستر بحمامات خاصة، غرفة مربية بحمام، ريسبشن مفتوح واسع، مطبخ ألماني مجهز، حديقة منسقة مع حمام سباحة خاص بنظام تدفئة وري ذكي. استلام فوري وكاملة العدادات والمرافق.',
                'price' => 13800000,
                'min_salary' => null,
                'max_salary' => null,
                'city' => 'Giza',
                'state' => 'Giza',
                'country' => 'Egypt',
                'address' => 'الربوة، الشيخ زايد، الجيزة',
                'lat' => 30.0610,
                'lng' => 30.9622,
                'contact' => '+201122334455',
                'image' => 'item_images/modern_villa_zayed.jpg',
                'gallery' => ['category/villas-houses-for-sale.jpg'],
                'is_featured' => false,
            ],

            // -------------------------------------------------------------
            // Category 3: Mobile Phones & Tablets (13)
            // -------------------------------------------------------------
            [
                'sub_slug' => 'smartphones',
                'user_id' => $technoStore->id,
                'name_en' => 'iPhone 16 Pro Max 256GB Desert Titanium - Sealed Brand New',
                'name_ar' => 'آيفون 16 برو ماكس 256 جيجا تيتانيوم صحراوي جديد متبرشم',
                'slug_base' => 'iphone-16-pro-max-256gb-desert-titanium',
                'desc_en' => 'Apple iPhone 16 Pro Max 256GB in Desert Titanium. Brand new factory sealed box with zero battery cycles. Features A18 Pro chip, 48MP Fusion camera with 5x telephoto optical zoom, Camera Control button, and titanium grade 5 build. International official Apple warranty with invoice.',
                'desc_ar' => 'هاتف أبل آيفون 16 برو ماكس مساحة 256 جيجابايت، اللون Desert Titanium الأحدث. الجهاز جديد متبرشم بالكامل وارد الخارج، معالج A18 Pro الأحدث، كاميرا 48 ميجابكسل مع زوم بصري 5x، زر التحكم بالكاميرا الجديد، بطارية 100%، وضمان دولي مع الفاتورة.',
                'price' => 68000,
                'min_salary' => null,
                'max_salary' => null,
                'city' => 'Cairo',
                'state' => 'Cairo',
                'country' => 'Egypt',
                'address' => 'شارع عباس العقاد، مدينة نصر، القاهرة',
                'lat' => 30.0571,
                'lng' => 31.3364,
                'contact' => '+201233445566',
                'image' => 'item_images/iphone_16_pro_max.jpg',
                'gallery' => ['category/smartphones.jpg'],
                'is_featured' => true,
            ],
            [
                'sub_slug' => 'tablets-ipads',
                'user_id' => $technoStore->id,
                'name_en' => 'Apple iPad Pro M4 11" 256GB OLED Wi-Fi Space Black',
                'name_ar' => 'أبل آيباد برو M4 مقاس 11 بوصة OLED سعة 256 جيجا أسود فلكي',
                'slug_base' => 'apple-ipad-pro-m4-11-oled',
                'desc_en' => 'Latest Apple iPad Pro 11-inch with revolutionary M4 chip and Ultra Retina XDR Tandem OLED display. 256GB storage, Space Black finish. Used only 2 weeks in pristine condition with original box, 20W charger, cable, and Apple Pencil Pro included.',
                'desc_ar' => 'أحدث جهاز آيباد برو بشريحة M4 الخارقة، شاشة Ultra Retina XDR بتقنية Tandem OLED المزدوجة، مساحة 256 جيجابايت، لون أسود فلكي Space Black. استعمال أسبوعين فقط بحالة الزيرو بدون أي خدش، مع الكرتونة وكافة الملحقات وقلم Apple Pencil Pro الأصلي.',
                'price' => 46500,
                'min_salary' => null,
                'max_salary' => null,
                'city' => 'Giza',
                'state' => 'Giza',
                'country' => 'Egypt',
                'address' => 'شارع جامعة الدول العربية، المهندسين، الجيزة',
                'lat' => 30.0535,
                'lng' => 31.2001,
                'contact' => '+201233445566',
                'image' => 'item_images/ipad_pro_m4.jpg',
                'gallery' => ['category/tablets-ipads.jpg'],
                'is_featured' => false,
            ],

            // -------------------------------------------------------------
            // Category 4: Electronics & Appliances (18)
            // -------------------------------------------------------------
            [
                'sub_slug' => 'laptops-computers',
                'user_id' => $ahmedUser ? $ahmedUser->id : 2,
                'name_en' => 'Apple MacBook Pro 16" M3 Pro 36GB RAM 512GB SSD Space Black',
                'name_ar' => 'أبل ماك بوك برو 16 بوصة M3 Pro رام 36 جيجا SSD 512 أسود فلكي',
                'slug_base' => 'apple-macbook-pro-16-m3-pro',
                'desc_en' => 'Apple MacBook Pro 16-inch Liquid Retina XDR with 120Hz ProMotion. Apple M3 Pro 12-core CPU, 18-core GPU, 36GB unified memory, 512GB SSD. Perfect for software engineering and 4K/8K video production. 98% battery health with original 140W MagSafe charger and packaging.',
                'desc_ar' => 'لابتوب ماك بوك برو 16 إنش شاشة Liquid Retina XDR بتردد 120 هرتز، معالج أبل M3 Pro ذو 12 نواة معالج رسومي 18 نواة، رامات 36 جيجا موحدة، هارد 512 جيجا SSD فائق السرعة. ممتاز للبرمجة والمونتاج الاحترافي، بطارية 98% مع الشاحن الأصلي MagSafe بقوة 140 وات والكرتونة.',
                'price' => 95000,
                'min_salary' => null,
                'max_salary' => null,
                'city' => 'Cairo',
                'state' => 'Cairo',
                'country' => 'Egypt',
                'address' => 'دجلة المعادي، المعادي، القاهرة',
                'lat' => 29.9602,
                'lng' => 31.2789,
                'contact' => '+201012345678',
                'image' => 'item_images/macbook_pro_16_m3.jpg',
                'gallery' => ['category/laptops-computers.jpg'],
                'is_featured' => false,
            ],
            [
                'sub_slug' => 'tvs-audio-systems',
                'user_id' => $technoStore->id,
                'name_en' => 'LG OLED evo C3 65" 4K Smart TV 120Hz Gaming & Cinema',
                'name_ar' => 'شاشة إل جي OLED evo C3 سمارت 65 بوصة 4K تردد 120Hz للألعاب والسينما',
                'slug_base' => 'lg-oled-evo-c3-65-4k-smart-tv',
                'desc_en' => 'LG 65-inch OLED evo C3 4K Smart TV powered by alpha 9 Gen6 AI Processor. Featuring self-lit pixels for perfect black, Dolby Vision IQ, Dolby Atmos, and 4x HDMI 2.1 ports with 120Hz VRR, G-Sync, and FreeSync. Complete with Magic Remote, desk stand, original box and local warranty.',
                'desc_ar' => 'شاشة تلفزيون ذكية LG OLED evo C3 مقاس 65 بوصة بدقة 4K معالج Alpha 9 الجيل السادس، بيكسلات ذاتية الإضاءة مع سواد مطلق وتباين لا نهائي، تدعم Dolby Vision IQ و Dolby Atmos و 4 منافذ HDMI 2.1 بتردد 120 هرتز مخصصة للبلايستيشن 5 والألعاب. مع الريموت السحري والحامل والكرتونة والضمان.',
                'price' => 52000,
                'min_salary' => null,
                'max_salary' => null,
                'city' => 'Alexandria',
                'state' => 'Alexandria',
                'country' => 'Egypt',
                'address' => 'سموحة، الإسكندرية',
                'lat' => 31.2156,
                'lng' => 29.9553,
                'contact' => '+201233445566',
                'image' => 'item_images/lg_oled_c3_65.jpg',
                'gallery' => ['category/tvs-audio-systems.jpg'],
                'is_featured' => false,
            ],

            // -------------------------------------------------------------
            // Category 5: Home & Furniture (24)
            // -------------------------------------------------------------
            [
                'sub_slug' => 'living-room-furniture',
                'user_id' => $saraFashion->id,
                'name_en' => 'Modern L-Shaped Corner Sofa with Ottoman - Turkish Linen Fabric',
                'name_ar' => 'ركنة مودرن حرف L خشب زان قماش كتان تركي مستورد مع بف',
                'slug_base' => 'modern-l-shaped-corner-sofa',
                'desc_en' => 'Modern L-shaped sectional sofa (320 x 240 cm) constructed with solid Roman red beechwood and high-resilience density-36 foam. Upholstered in premium stain-repellent imported Turkish linen fabric in soft grey tone. Includes matching footstool ottoman and set of fluffy fiber accent cushions.',
                'desc_ar' => 'ركنة مودرن أنيقة مقاس 320 × 240 سم مصنعة من خشب الزان الأحمر الروماني المتين، تنجيد إسفنج سوفت كثافة 36 عالي الجودة لراحة فائقة، قماش كتان تركي مستورد معالج ضد البقع وسهل التنظيف بلون رمادي عصري. تأتي مع بف مطابق ومجموعة خداديات فايبر سوفت.',
                'price' => 21500,
                'min_salary' => null,
                'max_salary' => null,
                'city' => 'Cairo',
                'state' => 'Cairo',
                'country' => 'Egypt',
                'address' => 'ميدان الكوربة، مصر الجديدة، القاهرة',
                'lat' => 30.0890,
                'lng' => 31.3255,
                'contact' => '+201544556677',
                'image' => 'item_images/modern_l_shaped_sofa.jpg',
                'gallery' => ['category/living-room-furniture.jpg'],
                'is_featured' => false,
            ],
            [
                'sub_slug' => 'bedroom-furniture',
                'user_id' => $saraFashion->id,
                'name_en' => 'Luxury Hotel Master Bedroom Set - King Bed, Wardrobe & Vanity',
                'name_ar' => 'غرفة نوم ماستر فندقية كاملة سرير كينج مع دولاب جرار وتسريحة ذكية',
                'slug_base' => 'luxury-hotel-master-bedroom-set',
                'desc_en' => 'Complete 5-star hotel style master bedroom set. Includes 180x200cm King size bed with upholstered quilted headboard, spacious 6-door sliding wardrobe (280cm) with internal LED motion-sensor illumination, 2 nightstands with built-in hidden lighting, and a modern vanity dresser with touch-activated smart LED mirror.',
                'desc_ar' => 'غرفة نوم ماستر كاملة بتصميم فندقي 5 نجوم. تشمل سرير كينج 180×200 سم بتنجيد كابوتونيه فاخر، دولاب جرار ضخم 6 درف بعرض 280 سم بإضاءة LED ذكية بحساس حركة، 2 كومودينو بإضاءة دافئة مخفية، وتسريحة أنيقة مزودة بمرآة ذكية بإضاءة ليد تعمل باللمس. خشب طبيعي معالج وتشطيب ناعم ضد الخدش.',
                'price' => 42000,
                'min_salary' => null,
                'max_salary' => null,
                'city' => 'Giza',
                'state' => 'Giza',
                'country' => 'Egypt',
                'address' => 'شارع مصدق، الدقي، الجيزة',
                'lat' => 30.0381,
                'lng' => 31.2124,
                'contact' => '+201544556677',
                'image' => 'item_images/luxury_master_bedroom.jpg',
                'gallery' => ['category/bedroom-furniture.jpg'],
                'is_featured' => true,
            ],

            // -------------------------------------------------------------
            // Category 6: Fashion & Beauty (30)
            // -------------------------------------------------------------
            [
                'sub_slug' => 'watches-jewelry',
                'user_id' => $ahmedUser ? $ahmedUser->id : 2,
                'name_en' => 'Rolex Submariner Date 41mm Ref. 126610LN Box & Papers',
                'name_ar' => 'ساعة رولكس صبمارينر ديت 41 مم سيراميك أصلية بالعلبة والضمان',
                'slug_base' => 'rolex-submariner-date-41mm',
                'desc_en' => 'Authentic Rolex Submariner Date reference 126610LN. Features 41mm Oystersteel case, black dial with Chromalight luminescent display, unidirectional rotatable Cerachrom black ceramic bezel, 300m water resistance, and automatic Calibre 3235 movement with 70h power reserve. Complete set with original green box and international guarantee card.',
                'desc_ar' => 'ساعة يد فاخرة رولكس صبمارينر ديت كود 126610LN أصلية 100%. ميناء أسود ستانلس ستيل Oystersteel مقاس 41 مم، إطار سيراميك Cerachrom أسود غير قابل للخدش، مقاومة للماء حتى 300 متر، محرك أوتوماتيكي كاليبر 3235 باحتياطي طاقة 70 ساعة. طقم كامل بالصندوق الأخضر الأصلي وبطاقة الضمان الدولي.',
                'price' => 510000,
                'min_salary' => null,
                'max_salary' => null,
                'city' => 'Cairo',
                'state' => 'Cairo',
                'country' => 'Egypt',
                'address' => 'حي الزمالك، القاهرة',
                'lat' => 30.0631,
                'lng' => 31.2215,
                'contact' => '+201012345678',
                'image' => 'item_images/rolex_submariner_date.jpg',
                'gallery' => ['category/watches-jewelry.jpg'],
                'is_featured' => true,
            ],
            [
                'sub_slug' => 'womens-fashion-bags',
                'user_id' => $saraFashion->id,
                'name_en' => 'Chanel Classic Medium Double Flap Bag - Black Lambskin Gold Hardware',
                'name_ar' => 'حقيبة شانيل كلاسيك ميديوم دبل فلاب جلد طبيعي كافيار أسود حلية ذهبية',
                'slug_base' => 'chanel-classic-medium-double-flap-bag',
                'desc_en' => 'Authentic Chanel Classic Medium Double Flap bag in black quilted lambskin leather with iconic 24K gold-plated chain and CC turn-lock closure. Pristine condition with serial hologram intact, original microchip, protective dust bag, and magnetic boutique box.',
                'desc_ar' => 'حقيبة يد شانيل كلاسيك ميديوم دبل فلاب أصلية، مصنوعة من جلد الخراف الناعم الأسود المبطن بتطريز المربعات الأيقوني، مع سلسلة وحلية CC مطلية بالذهب عيار 24 قيراط. حالة ممتازة كالجديدة مع الشريحة الذكية الإلكترونية، الدست باج الأصلي، والعلبة المغناطيسية الفاخرة.',
                'price' => 165000,
                'min_salary' => null,
                'max_salary' => null,
                'city' => 'Giza',
                'state' => 'Giza',
                'country' => 'Egypt',
                'address' => 'بيفرلي هيلز، الشيخ زايد، الجيزة',
                'lat' => 30.0825,
                'lng' => 30.9320,
                'contact' => '+201544556677',
                'image' => 'item_images/chanel_classic_bag.jpg',
                'gallery' => ['category/womens-fashion-bags.jpg'],
                'is_featured' => false,
            ],

            // -------------------------------------------------------------
            // Category 7: Video Games & Consoles (35)
            // -------------------------------------------------------------
            [
                'sub_slug' => 'gaming-consoles',
                'user_id' => $technoStore->id,
                'name_en' => 'PlayStation 5 Slim Disc Edition 1TB with 2 DualSense & 3 Disc Games',
                'name_ar' => 'بلايستيشن 5 سليم قارئ أسطوانات 1 تيرا مع ذراعين و3 ألعاب أصلية',
                'slug_base' => 'playstation-5-slim-disc-edition-bundle',
                'desc_en' => 'Sony PlayStation 5 Slim Disc Edition with 1TB ultra-fast SSD storage. Comes bundled with 2 original DualSense wireless controllers (White & Midnight Black), vertical metallic stand, and 3 blockbuster physical games: EA Sports FC 24, Marvel Spider-Man 2, and God of War Ragnarok. Complete in original packaging.',
                'desc_ar' => 'جهاز سوني بلايستيشن 5 سليم إصدار قارئ الأقراص سعة 1 تيرابايت SSD، مع ذراعين تحكم أصليين DualSense باللونين الأبيض والأسود الملكي، حامل التثبيت الرأسي، و3 ألعاب أسطوانات أصلية: EA Sports FC 24، Spider-Man 2، God of War Ragnarok. حالة الزيرو بكامل الكرتونة والأسلاك.',
                'price' => 29500,
                'min_salary' => null,
                'max_salary' => null,
                'city' => 'Cairo',
                'state' => 'Cairo',
                'country' => 'Egypt',
                'address' => 'شارع النزهة، مصر الجديدة، القاهرة',
                'lat' => 30.0950,
                'lng' => 31.3412,
                'contact' => '+201233445566',
                'image' => 'item_images/ps5_slim_console.jpg',
                'gallery' => ['category/gaming-consoles.jpg'],
                'is_featured' => false,
            ],
            [
                'sub_slug' => 'gaming-controllers-gear',
                'user_id' => $technoStore->id,
                'name_en' => 'Meta Quest 3 Mixed Reality VR Headset 512GB with Elite Strap & Case',
                'name_ar' => 'نظارة الواقع الافتراضي ميتا كويست 3 سعة 512 جيجا مع حزام إيليت وحقيبة',
                'slug_base' => 'meta-quest-3-512gb-vr-bundle',
                'desc_en' => 'Meta Quest 3 512GB breakthrough Mixed Reality VR headset. Features 4K+ Infinite Display, Snapdragon XR2 Gen 2 processor, full-color passthrough cameras, and ergonomic Touch Plus controllers with TruTouch haptic feedback. Comes with official Elite Headstrap and carrying case.',
                'desc_ar' => 'نظارة الواقع المختلط والافتراضي الثورية Meta Quest 3 بأعلى سعة 512 جيجابايت. شاشة 4K+ فائقة النقاء، معالج Snapdragon XR2 Gen 2 القوي، كاميرات ملونة حقيقية تدمج الواقع الافتراضي بالمحيط، ذراعي تحكم Touch Plus بتقنية اللمس الدقيق، مع حزام رأس مريح Elite Strap وحقيبة حماية وسفر أصلية.',
                'price' => 34000,
                'min_salary' => null,
                'max_salary' => null,
                'city' => 'Alexandria',
                'state' => 'Alexandria',
                'country' => 'Egypt',
                'address' => 'شارع سوريا، رشدي، الإسكندرية',
                'lat' => 31.2291,
                'lng' => 29.9482,
                'contact' => '+201233445566',
                'image' => 'item_images/meta_quest_3_vr.jpg',
                'gallery' => ['category/gaming-controllers-gear.jpg'],
                'is_featured' => false,
            ],

            // -------------------------------------------------------------
            // Category 8: Jobs & Careers (40)
            // -------------------------------------------------------------
            [
                'sub_slug' => 'it-software-jobs',
                'user_id' => $adminUser ? $adminUser->id : 1,
                'name_en' => 'Senior Flutter & Laravel Full-Stack Developer (Hybrid - New Cairo)',
                'name_ar' => 'مطلوب مبرمج تطبيقات ومواقع أول فلتر ولارفيل (نظام عمل هجين)',
                'slug_base' => 'senior-flutter-laravel-full-stack-developer',
                'desc_en' => 'Innovative tech company in New Cairo is looking for an experienced Senior Full-Stack Developer with 4+ years in Flutter mobile development and Laravel backend architecture. Must have strong expertise in RESTful APIs, state management (Bloc/Provider), MySQL/PostgreSQL, and CI/CD pipelines. Competitive salary, hybrid work, and private medical insurance.',
                'desc_ar' => 'تعلن شركة برمجيات وتطبيقات كبرى بالتجمع الخامس عن حاجتها لضم مطور تطبيقات ومواقع أول (Senior Full-Stack Developer) بخبرة لا تقل عن 4 سنوات في تطوير تطبيقات الموبايل بفريم وورك Flutter وبناء الباك إند بإطار عمل Laravel. يشترط إتقان REST APIs وقواعد البيانات. نظام عمل هجين، تأمين صحي شامل، ومكافآت مجزية.',
                'price' => null,
                'min_salary' => 28000,
                'max_salary' => 45000,
                'city' => 'Cairo',
                'state' => 'Cairo',
                'country' => 'Egypt',
                'address' => 'مجمع البنوك، التجمع الخامس، القاهرة الجديدة',
                'lat' => 30.0195,
                'lng' => 31.4721,
                'contact' => '+201000000001',
                'image' => 'item_images/job_software_developer.jpg',
                'gallery' => ['category/it-software-jobs.jpg'],
                'is_featured' => false,
            ],
            [
                'sub_slug' => 'sales-marketing-jobs',
                'user_id' => $adminUser ? $adminUser->id : 1,
                'name_en' => 'Senior Performance Marketing & Growth Specialist (E-commerce)',
                'name_ar' => 'مطلوب أخصائي تسويق رقمي وإعلانات ممولة أول للتجارة الإلكترونية',
                'slug_base' => 'senior-performance-marketing-specialist',
                'desc_en' => 'Rapidly growing retail brand is hiring a Senior Performance Marketing Specialist. Proven track record managing multi-million budgets on Meta Ads, Google Ads (Search, Shopping & PMax), and TikTok Ads. Responsibilities include ROAS scaling, audience funneling, conversion rate optimization, and GA4 analytics.',
                'desc_ar' => 'مطلوب أخصائي تسويق رقمي وإعلانات ممولة أول لإدارة الحملات الإعلانية لمجموعة علامات تجارية رائدة. خبرة مثبتة في إدارة ميزانيات إعلانية على Meta Ads و Google Ads و TikTok Ads، وتحسين تكلفة الاستحواذ ومعدل العائد على الإنفاق الإعلاني ROAS، وتحليل البيانات عبر Google Analytics 4.',
                'price' => null,
                'min_salary' => 16000,
                'max_salary' => 26000,
                'city' => 'Giza',
                'state' => 'Giza',
                'country' => 'Egypt',
                'address' => 'ميدان المساحة، الدقي، الجيزة',
                'lat' => 30.0392,
                'lng' => 31.2185,
                'contact' => '+201000000001',
                'image' => 'item_images/job_digital_marketing.jpg',
                'gallery' => ['category/sales-marketing-jobs.jpg'],
                'is_featured' => false,
            ],

            // -------------------------------------------------------------
            // Category 9: Services & Business (46)
            // -------------------------------------------------------------
            [
                'sub_slug' => 'home-maintenance-services',
                'user_id' => $ahmedUser ? $ahmedUser->id : 2,
                'name_en' => 'Professional AC Maintenance, Chemical Wash & Gas Charging',
                'name_ar' => 'صيانة وغسيل كيميائي شامل للتكييفات وشحن فريون أصلي مع الضمان',
                'slug_base' => 'professional-ac-maintenance-refrigerant',
                'desc_en' => 'Certified HVAC repair and maintenance service for all air conditioner models (Split, Concealed, Central). High-pressure pump deep cleaning, indoor & outdoor unit sanitation, copper leak inspection, and original R410A / R22 gas refill. Fast same-day home visits across Greater Cairo with warranty.',
                'desc_ar' => 'مركز معتمد لصيانة وإصلاح أجهزة التكييف لجميع الماركات العالمية (شارب، كاريير، إل جي، ميديا، جري). تنظيف عميق وغسيل كيميائي للوحدات الداخلية والخارجية بمضخات الضغط العالي، فحص تسريبات النحاس، وشحن فريون أصلي R410A و R22 بأعلى كفاءة تبريد. زيارات منزلية فورية وضمان كتابي على كافة أعمال الصيانة.',
                'price' => 450,
                'min_salary' => null,
                'max_salary' => null,
                'city' => 'Cairo',
                'state' => 'Cairo',
                'country' => 'Egypt',
                'address' => 'خدمة فورية في القاهرة والجيزة والقاهرة الجديدة',
                'lat' => 30.0444,
                'lng' => 31.2357,
                'contact' => '+201012345678',
                'image' => 'item_images/ac_maintenance_service.jpg',
                'gallery' => ['category/home-maintenance-services.jpg'],
                'is_featured' => false,
            ],
            [
                'sub_slug' => 'cleaning-pest-control-services',
                'user_id' => $ahmedUser ? $ahmedUser->id : 2,
                'name_en' => 'Full Home & Villa Deep Cleaning, Steam Sanitization & Floor Polishing',
                'name_ar' => 'شركة تنظيف منازل وفلل وتعقيم شامل بالبخار وجلي وتلميع الرخام',
                'slug_base' => 'home-villa-deep-cleaning-steam',
                'desc_en' => 'Comprehensive residential and office deep cleaning service. Deep steam extraction for upholstery, sofas, and Persian carpets. Kitchen and bathroom degreasing, Italian floor marble crystallization and polishing, using safe, non-toxic eco-friendly German detergents. Professional uniformed crew.',
                'desc_ar' => 'خدمات النظافة الشاملة والعميقة للمنازل والفلل والقصور والشركات. غسيل وتعقيم الأنتريهات والمجالس والسجاد بالبخار عالي الحرارة لإزالة أصعب البقع والتعقيم من البكتيريا، تنظيف وإذابة دهون المطابخ، جلي وتلميع أرضيات الرخام والجرانيت، بمواد تنظيف ألمانية معتمدة وآمنة تماماً على الأطفال.',
                'price' => 1800,
                'min_salary' => null,
                'max_salary' => null,
                'city' => 'Giza',
                'state' => 'Giza',
                'country' => 'Egypt',
                'address' => 'الشيخ زايد و 6 أكتوبر وجميع أنحاء الجيزة',
                'lat' => 30.0620,
                'lng' => 30.9701,
                'contact' => '+201012345678',
                'image' => 'item_images/home_cleaning_service.jpg',
                'gallery' => ['category/cleaning-pest-control-services.jpg'],
                'is_featured' => false,
            ],

            // -------------------------------------------------------------
            // Category 10: Animals & Pets (52)
            // -------------------------------------------------------------
            [
                'sub_slug' => 'cats-kittens',
                'user_id' => $ahmedUser ? $ahmedUser->id : 2,
                'name_en' => 'Purebred Scottish Fold Kitten 2.5 Months - Fully Vaccinated with Passport',
                'name_ar' => 'قطة سكوتش فولد بيور عمر شهرين ونصف مطعمة بالدفتر الصحي',
                'slug_base' => 'purebred-scottish-fold-kitten',
                'desc_en' => 'Adorable female purebred Scottish Fold kitten, 2.5 months old. Luxurious silver tabby short coat with folded ears and amber eyes. Fully litter-box trained, playful, and affectionate temperament. Raised indoors on Royal Canin kitten food. Dewormed and vaccinated with official veterinary health certificate.',
                'desc_ar' => 'قطة أنثى سكوتش فولد بيور نقية عمر شهرين ونصف، لون سلفر تابي رائع وأذن مطوية مميزة بعيون عسلية واسعة. مدربة بالكامل على استخدام الليتر بوكس، متعودة على أكل الدراي فود والويت فود رويال كانين، نشيطة واجتماعية جداً وتحب اللعب، تم التطعيم الثلاثي والتخلص من الديدان ومعها الدفتر الصحي المعتمد من العيادة البيطرية.',
                'price' => 5500,
                'min_salary' => null,
                'max_salary' => null,
                'city' => 'Cairo',
                'state' => 'Cairo',
                'country' => 'Egypt',
                'address' => 'المعادي، القاهرة',
                'lat' => 29.9620,
                'lng' => 31.2610,
                'contact' => '+201012345678',
                'image' => 'item_images/scottish_fold_kitten.jpg',
                'gallery' => ['category/cats-kittens.jpg'],
                'is_featured' => false,
            ],
            [
                'sub_slug' => 'dogs-puppies',
                'user_id' => $ahmedUser ? $ahmedUser->id : 2,
                'name_en' => 'Champion Lineage Golden Retriever Puppy 60 Days Old - Microchipped',
                'name_ar' => 'جرو جولدن ريتريفر بيور عمر 60 يوماً دباديب مواصفات قياسية مع دفتر التطعيم',
                'slug_base' => 'golden-retriever-puppy-60-days',
                'desc_en' => 'Top-tier purebred male Golden Retriever puppy, 60 days old. Heavy bone structure, blocky head, and rich golden double coat. Extremely gentle and family-friendly temperament. Dewormed, microchipped, and received first two puppy core vaccinations with veterinary health book.',
                'desc_ar' => 'جرو ذكر جولدن ريتريفر أصلي مواصفات قياسية عالية (عضام عريضة ودباديب)، عمر 60 يوماً، لون ذهبي فاتح ممتاز وشعر كثيف وناعم. صحة ممتازة، لعوب ومحب للأطفال ومناسب للمنزل والحدائق. تم أخذ جرعات الديدان والتطعيم الثنائي والميكروتشيب مع دفتر الرعاية الصحية البيطرية.',
                'price' => 8500,
                'min_salary' => null,
                'max_salary' => null,
                'city' => 'Giza',
                'state' => 'Giza',
                'country' => 'Egypt',
                'address' => 'حدائق الأهرام، الجيزة',
                'lat' => 29.9801,
                'lng' => 31.1189,
                'contact' => '+201012345678',
                'image' => 'item_images/golden_retriever_puppy.jpg',
                'gallery' => ['category/dogs-puppies.jpg'],
                'is_featured' => false,
            ],
        ];

        // 5. Insert Each Listing
        foreach ($listings as $index => $data) {
            $category = Category::where('slug', $data['sub_slug'])->first();
            if (!$category) {
                $this->command->warn("Category slug not found: {$data['sub_slug']}");
                continue;
            }

            // Build category chain IDs (e.g., "1,2")
            $chainIds = [];
            $curr = $category;
            while ($curr) {
                array_unshift($chainIds, $curr->id);
                $curr = $curr->parent_category;
            }
            $allCategoryIdsStr = implode(',', $chainIds);

            // Generate slug
            $slug = HelperService::generateUniqueSlug(new Item(), $data['slug_base']);

            $item = new Item();
            $item->forceFill([
                'name' => $data['name_en'],
                'slug' => $slug,
                'description' => $data['desc_en'],
                'category_id' => $category->id,
                'all_category_ids' => $allCategoryIdsStr,
                'user_id' => $data['user_id'],
                'price' => $data['price'],
                'min_salary' => $data['min_salary'],
                'max_salary' => $data['max_salary'],
                'currency_id' => 1,
                'latitude' => $data['lat'],
                'longitude' => $data['lng'],
                'address' => $data['address'],
                'city' => $data['city'],
                'state' => $data['state'],
                'country' => $data['country'],
                'country_code' => 'EG',
                'contact' => $data['contact'],
                'show_mobile_number' => 1,
                'show_only_to_premium' => 0,
                'status' => 'approved',
                'item_type' => 'normal',
                'published_at' => Carbon::now()->subHours(rand(1, 72)),
                'clicks' => rand(35, 480),
                'is_dummy' => 0,
                'created_at' => Carbon::now()->subHours(rand(1, 72)),
                'updated_at' => Carbon::now(),
            ]);
            $item->save();

            // Insert Primary Image
            ItemImages::create([
                'item_id' => $item->id,
                'image' => $data['image'],
                'is_default' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            // Insert Additional Gallery Images
            if (!empty($data['gallery'])) {
                foreach ($data['gallery'] as $galleryImg) {
                    ItemImages::create([
                        'item_id' => $item->id,
                        'image' => $galleryImg,
                        'is_default' => 0,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                }
            }

            // Save English Translations
            Translation::updateOrCreate(
                [
                    'translatable_id' => $item->id,
                    'translatable_type' => Item::class,
                    'language_id' => $enId,
                    'key' => 'name',
                ],
                ['value' => $data['name_en']]
            );
            Translation::updateOrCreate(
                [
                    'translatable_id' => $item->id,
                    'translatable_type' => Item::class,
                    'language_id' => $enId,
                    'key' => 'description',
                ],
                ['value' => $data['desc_en']]
            );

            // Save Arabic Translations
            Translation::updateOrCreate(
                [
                    'translatable_id' => $item->id,
                    'translatable_type' => Item::class,
                    'language_id' => $arId,
                    'key' => 'name',
                ],
                ['value' => $data['name_ar']]
            );
            Translation::updateOrCreate(
                [
                    'translatable_id' => $item->id,
                    'translatable_type' => Item::class,
                    'language_id' => $arId,
                    'key' => 'description',
                ],
                ['value' => $data['desc_ar']]
            );

            // Save SEO Details
            SeoDetail::updateOrCreate(
                [
                    'seoable_id' => $item->id,
                    'seoable_type' => Item::class,
                ],
                [
                    'meta_title' => "{$data['name_ar']} | {$data['name_en']} - WngeZ",
                    'meta_description' => Str::limit($data['desc_ar'], 155),
                    'meta_keywords' => "{$data['name_ar']}, {$data['name_en']}, WngeZ, ونبيز, إعلانات مبوبة",
                ]
            );


            $catName = $category->name;
            $this->command->info("Seeded [{$item->id}] {$data['name_ar']} (Category: {$catName})");
        }

        $this->command->info("Successfully seeded all 20 advertisements across 10 categories!");
    }
}
