<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

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

        view()->composer('*', function ($view) {
            $branding = cache()->rememberForever('branding_settings', fn () => Setting::first());
            $view->with('branding', $branding);
        });

        Blade::if('canFeature', function (string $feature) {
            $user = auth()->user();
            if (! $user) {
                return false;
            }

            if ($user->role && $user->role->name === 'Super Admin') {
                return true;
            }

            return $user->hasPermission($feature);
        });
    }
}
