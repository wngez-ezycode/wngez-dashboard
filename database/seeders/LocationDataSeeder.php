<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use App\Models\Language;
use App\Models\State;
use App\Models\Translation;
use Illuminate\Database\Seeder;

class LocationDataSeeder extends Seeder
{
    public function run(): void
    {
        $languageIds = Language::whereIn('code', ['ar', 'en'])->pluck('id', 'code');

        $country = Country::updateOrCreate(
            ['iso2' => 'EG'],
            [
                'name' => 'Egypt',
                'iso3' => 'EGY',
                'numeric_code' => '818',
                'phonecode' => '20',
                'capital' => 'Cairo',
                'currency' => 'EGP',
                'currency_name' => 'Egyptian pound',
                'currency_symbol' => 'E£',
                'native' => 'مصر',
                'region' => 'Africa',
                'subregion' => 'Northern Africa',
                'latitude' => 26.8206,
                'longitude' => 30.8025,
                'flag' => 1,
                'status' => 1,
            ]
        );
        $this->translate($country, $languageIds, 'Egypt', 'مصر');

        $locations = [
            ['en' => 'Cairo', 'ar' => 'القاهرة', 'code' => 'C', 'lat' => 30.0444, 'lng' => 31.2357],
            ['en' => 'Giza', 'ar' => 'الجيزة', 'code' => 'GZ', 'lat' => 30.0131, 'lng' => 31.2089],
            ['en' => 'Alexandria', 'ar' => 'الإسكندرية', 'code' => 'AL', 'lat' => 31.2001, 'lng' => 29.9187],
        ];

        foreach ($locations as $location) {
            $state = State::updateOrCreate(
                ['country_id' => $country->id, 'state_code' => $location['code']],
                [
                    'name' => $location['en'],
                    'iso2' => $location['code'],
                    'latitude' => $location['lat'],
                    'longitude' => $location['lng'],
                    'flag' => 1,
                    'status' => 1,
                ]
            );
            $this->translate($state, $languageIds, $location['en'], $location['ar']);

            $city = City::updateOrCreate(
                ['state_id' => $state->id, 'name' => $location['en']],
                [
                    'state_code' => $location['code'],
                    'country_id' => $country->id,
                    'country_code' => 'EG',
                    'latitude' => $location['lat'],
                    'longitude' => $location['lng'],
                    'flag' => 1,
                    'status' => 1,
                ]
            );
            $this->translate($city, $languageIds, $location['en'], $location['ar']);
        }

        $this->command->info('Egypt locations seeded in Arabic and English.');
    }

    private function translate(object $model, $languageIds, string $english, string $arabic): void
    {
        foreach (['en' => $english, 'ar' => $arabic] as $code => $value) {
            if (empty($languageIds[$code])) {
                continue;
            }

            Translation::updateOrCreate(
                [
                    'translatable_id' => $model->id,
                    'translatable_type' => $model::class,
                    'language_id' => $languageIds[$code],
                    'key' => 'name',
                ],
                ['value' => $value]
            );
        }
    }
}
