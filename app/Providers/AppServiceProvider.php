<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;
use App\Models\Setting;

require_once app_path('Helpers/helpers.php');

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        if (Schema::hasTable('settings')) {
            try {
                $allSettings = Setting::all()->pluck('value', 'key')->toArray();
                View::share('siteSettings', $allSettings);
            } catch (\Throwable $e) {
                View::share('siteSettings', []);
            }
        }
    }
}
