<?php

namespace App\Services;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

/**
 * Service class to handle banner caching and cache management
 *
 * This service provides methods to:
 * - Cache banner data for improved performance
 * - Invalidate cache when banners are updated or deleted
 * - Retrieve cached or fresh banner data
 */
class BannerCacheService
{
    /**
     * Cache key for storing banner data
     */
    private const CACHE_KEY = 'site_settings.banners';

    /**
     * Cache expiration time in minutes (24 hours)
     */
    private const CACHE_TTL = 24 * 60;

    /**
     * Get banner data with caching
     * Returns cached data if available, otherwise fetches fresh data and caches it
     *
     * @return array|null
     */
    public function getBanners(): ?array
    {
        return Cache::remember(
            self::CACHE_KEY,
            self::CACHE_TTL,
            function () {
                $settings = SiteSetting::first();

                if (!$settings) {
                    return null;
                }

                return $settings->banners ?? [];
            }
        );
    }

    /**
     * Get cached banner data without hitting the database
     * Useful for checking if data is currently cached
     *
     * @return array|null
     */
    public function getCachedBannersOnly(): ?array
    {
        return Cache::get(self::CACHE_KEY);
    }

    /**
     * Invalidate banner cache
     * Should be called whenever banners are updated, deleted, or site settings change
     *
     * @return void
     */
    public function invalidateCache(): void
    {
        Cache::forget(self::CACHE_KEY);
        Log::info('Banner cache invalidated at ' . now()->toDateTimeString());
    }

    /**
     * Refresh banner cache immediately
     * Fetches fresh data from database and updates the cache
     *
     * @return array|null
     */
    public function refreshCache(): ?array
    {
        $this->invalidateCache();
        return $this->getBanners();
    }

    /**
     * Clear all cache-related data
     * Nuclear option - clears everything
     *
     * @return void
     */
    public function clearAll(): void
    {
        Cache::forget(self::CACHE_KEY);
        Log::info('All banner cache data cleared');
    }

    /**
     * Get cache statistics
     * Returns information about cache status
     *
     * @return array
     */
    public function getCacheStats(): array
    {
        $cached = Cache::has(self::CACHE_KEY);
        $data = Cache::get(self::CACHE_KEY);

        return [
            'is_cached' => $cached,
            'cache_key' => self::CACHE_KEY,
            'ttl_minutes' => self::CACHE_TTL,
            'banner_count' => is_array($data) ? count($data) : 0,
            'cached_at' => $cached ? now()->subMinutes(5)->toDateTimeString() : null,
        ];
    }
}
