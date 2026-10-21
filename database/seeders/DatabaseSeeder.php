<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            InstallationSeeder::class,
            SystemUpgradeSeeder::class,
            ArabicLanguageSeeder::class,
            LocationDataSeeder::class,
            CategoryDataSeeder::class,
            ItemDataSeeder::class,
            SliderDataSeeder::class,
            HomePageContentSeeder::class,
        ]);
    }
}
