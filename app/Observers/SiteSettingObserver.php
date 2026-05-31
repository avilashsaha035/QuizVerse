<?php

namespace App\Observers;

use App\Models\SiteSetting;
use App\Services\BannerCacheService;

/**
 * Observer class for SiteSetting model
 *
 * Automatically handles cache invalidation when SiteSetting model is:
 * - Updated: Invalidates banner cache
 * - Deleted: Invalidates banner cache
 * - Saved: Invalidates banner cache
 */
class SiteSettingObserver
{
    /**
     * Handle the SiteSetting "saved" event.
     * Fired when model is created or updated
     *
     * @param  \App\Models\SiteSetting  $siteSetting
     * @return void
     */
    public function saved(SiteSetting $siteSetting): void
    {
        $this->invalidateBannerCache();
    }

    /**
     * Handle the SiteSetting "updated" event.
     *
     * @param  \App\Models\SiteSetting  $siteSetting
     * @return void
     */
    public function updated(SiteSetting $siteSetting): void
    {
        // Additional logging for debugging
        $this->invalidateBannerCache();
    }

    /**
     * Handle the SiteSetting "deleted" event.
     *
     * @param  \App\Models\SiteSetting  $siteSetting
     * @return void
     */
    public function deleted(SiteSetting $siteSetting): void
    {
        $this->invalidateBannerCache();
    }

    /**
     * Handle the SiteSetting "force deleted" event (for soft deletes).
     *
     * @param  \App\Models\SiteSetting  $siteSetting
     * @return void
     */
    public function forceDeleted(SiteSetting $siteSetting): void
    {
        $this->invalidateBannerCache();
    }

    /**
     * Invalidate banner cache
     *
     * @return void
     */
    private function invalidateBannerCache(): void
    {
        $cacheService = app(BannerCacheService::class);
        $cacheService->invalidateCache();
    }
}
