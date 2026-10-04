<?php

namespace Database\Seeders;

use App\Models\Language;
use App\Services\CachingService;
use App\Services\HelperService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ArabicLanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $code = 'ar';
        $panelFile = 'ar.json';
        $appFile = 'ar_app.json';
        $webFile = 'ar_web.json';
        $imagePath = 'language/ar.svg';

        // 1. Ensure storage directory exists and copy the flag icon if available
        $storageDir = storage_path('app/public/language');
        if (!File::exists($storageDir)) {
            File::makeDirectory($storageDir, 0755, true);
        }

        $sourceSvg = public_path('assets/images/language/ar.svg');
        $targetSvg = storage_path('app/public/language/ar.svg');

        if (File::exists($sourceSvg) && !File::exists($targetSvg)) {
            File::copy($sourceSvg, $targetSvg);
        }

        // 2. Insert or update the Arabic Language in the database
        $language = Language::updateOrCreate(
            ['code' => $code],
            [
                'name'            => 'العربية',
                'name_in_english' => 'Arabic',
                'panel_file'      => $panelFile,
                'app_file'        => $appFile,
                'web_file'        => $webFile,
                'rtl'             => 1,
                'image'           => $imagePath,
                'country_code'    => 'SA',
                'status'          => 1,
            ]
        );

        // 3. Clear application caches and revalidate language codes
        CachingService::removeCache(config('constants.CACHE.LANGUAGE', 'language'));
        CachingService::removeCache('languages');
        HelperService::revalidateLanguageCodes();

        $this->command->info("Arabic Language (العربية) seeded successfully for Website, Dashboard, and Mobile App (ID: {$language->id}).");
    }
}
