<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\SiteSetting;
use App\Observers\SiteSettingObserver;
use App\Services\BannerCacheService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register BannerCacheService as singleton
        $this->app->singleton(BannerCacheService::class, function ($app) {
            return new BannerCacheService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register model observer for automatic cache invalidation
        SiteSetting::observe(SiteSettingObserver::class);

        // Share site settings with all views, using cached banner data
        if (\Illuminate\Support\Facades\Schema::hasTable('site_settings')) {
            $settings = SiteSetting::first();

            if ($settings) {
                // Cache the entire settings object and use cached banners if available
                $bannerCache = app(BannerCacheService::class);
                $settings->banners = $bannerCache->getBanners();
            }

            \Illuminate\Support\Facades\View::share('siteSettings', $settings);
        }
    }
}
