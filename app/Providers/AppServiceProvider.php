<?php

namespace App\Providers;

use App\Models\Config;
use Illuminate\Support\ServiceProvider;

use function Laravel\Prompts\error;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void {}

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        try {
            $siteSettings = cache()->remember(
                'settings',
                60 * 5,
                fn () => Config::all()->keyBy('key'),
            );
            
        } catch (\Throwable $th) {
            error('The `configs` table does not exist. Please Run Migrations or Restore from Old SQL Backups That Has configs table');
        }
    }
}
