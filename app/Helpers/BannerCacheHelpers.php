<?php

/**
 * Helper Functions for Banner Caching
 *
 * These functions provide convenient shortcuts to access banner cache functionality
 * throughout the application.
 */

use App\Services\BannerCacheService;

/**
 * Get cached banners with fallback to fresh data
 *
 * @return array|null
 */
function get_cached_banners(): ?array
{
    return app(BannerCacheService::class)->getBanners();
}

/**
 * Get only cached banners without database query
 *
 * @return array|null
 */
function get_banners_from_cache(): ?array
{
    return app(BannerCacheService::class)->getCachedBannersOnly();
}

/**
 * Invalidate banner cache
 * Use this when you update banners outside of the normal update flow
 *
 * @return void
 */
function invalidate_banner_cache(): void
{
    app(BannerCacheService::class)->invalidateCache();
}

/**
 * Refresh banner cache immediately
 *
 * @return array|null
 */
function refresh_banner_cache(): ?array
{
    return app(BannerCacheService::class)->refreshCache();
}
