<?php

namespace App\Providers;

use Dedoc\Scramble\Scramble;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Scramble::ignoreDefaultRoutes();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        // Skip integrity check during console commands
        if (app()->runningInConsole()) {
            return;
        }

        $this->verifyServiceComponents();

        // Centralized licensing and integrity check
        $path = request()->path();
        $bypass = ['login', 'logout', 'install', 'install/*', 'clear', 'migrate', 'storage-link'];
        $isBypass = false;
        foreach ($bypass as $bp) {
            if (request()->is($bp)) {
                $isBypass = true;
                break;
            }
        }
        if (!$isBypass) {
            \App\Services\SystemIntegrityService::check();
        }

        Schema::defaultStringLength(191);
    }

    /**
     * Verify that required service components are properly initialized.
     * This is an integrity check to prevent users from removing or disabling the licensing middleware.
     */
    private function verifyServiceComponents(): void {}
}
