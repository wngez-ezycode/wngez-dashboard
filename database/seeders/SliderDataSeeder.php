<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Slider;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class SliderDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ensure sliders directory exists in storage
        $sliderDir = storage_path('app/public/sliders');
        if (!File::exists($sliderDir)) {
            File::makeDirectory($sliderDir, 0755, true);
        }

        // Define sliders data based on uploaded designs
        $sliders = [
            [
                'image' => 'sliders/slider_everything_marketplace.png',
                'model_type' => null,
                'model_id' => null,
                'third_party_link' => 'https://wngez.com',
                'sequence' => 1,
                'country_id' => null,
                'state_id' => null,
                'city_id' => null,
            ],
            [
                'image' => 'sliders/slider_drive_cars.png',
                'model_type' => Category::class,
                'model_id' => 1, // Vehicles & Cars
                'third_party_link' => '',
                'sequence' => 2,
                'country_id' => null,
                'state_id' => null,
                'city_id' => null,
            ],
            [
                'image' => 'sliders/slider_dream_home.png',
                'model_type' => Category::class,
                'model_id' => 7, // Properties & Real Estate
                'third_party_link' => '',
                'sequence' => 3,
                'country_id' => null,
                'state_id' => null,
                'city_id' => null,
            ],
            [
                'image' => 'sliders/slider_upgrade_tech.png',
                'model_type' => Category::class,
                'model_id' => 18, // Electronics & Appliances
                'third_party_link' => '',
                'sequence' => 4,
                'country_id' => null,
                'state_id' => null,
                'city_id' => null,
            ],
        ];

        // Clear existing sliders and re-insert fresh
        Slider::truncate();

        foreach ($sliders as $sliderData) {
            Slider::create($sliderData);
        }

        $this->command->info('Sliders seeded successfully! Total: ' . count($sliders));
    }
}
