# Banner Image Caching System Documentation

## Overview

This document describes the banner image caching system implemented for QuizVerse. The system automatically caches banner images on the home page and invalidates the cache when images are updated or deleted, ensuring optimal performance while maintaining data freshness.

## Architecture

### Components

1. **BannerCacheService** (`app/Services/BannerCacheService.php`)
   - Core service handling all cache operations
   - Provides methods for getting, refreshing, and clearing cache
   - Default cache TTL: 24 hours

2. **SiteSettingObserver** (`app/Observers/SiteSettingObserver.php`)
   - Automatically listens to SiteSetting model changes
   - Invalidates cache on `saved`, `updated`, and `deleted` events
   - Ensures cache stays fresh without manual intervention

3. **Updated SiteSettingController** (`app/Http/Controllers/Backend/SiteSettingController.php`)
   - Explicitly invalidates cache when banners are modified
   - Tracks banner changes to optimize cache invalidation

4. **Updated AppServiceProvider** (`app/Providers/AppServiceProvider.php`)
   - Registers BannerCacheService as a singleton
   - Registers SiteSettingObserver
   - Shares cached banner data with all views

5. **BannerCacheCommand** (`app/Console/Commands/BannerCacheCommand.php`)
   - Artisan command for manual cache management
   - Commands: `status`, `refresh`, `clear`

6. **Helper Functions** (`app/Helpers/BannerCacheHelpers.php`)
   - Convenient shortcuts for cache operations
   - Auto-loaded via composer.json

## How It Works

### Cache Flow

```
1. View requests siteSettings.banners
   ↓
2. AppServiceProvider loads cached banners via BannerCacheService
   ↓
3. BannerCacheService checks if banners are cached
   ├─ If cached: Return cached data (fast, no DB query)
   └─ If not cached: Query DB, cache for 24 hours, return data
   ↓
4. View renders cached banner data
```

### Cache Invalidation Flow

```
Banner Updated/Deleted
   ↓
SiteSettingController.update()
   ├─ Detects banner changes
   ├─ Calls bannerCache->invalidateCache()
   └─ Saves model
   ↓
SiteSettingObserver.saved() [Dual protection]
   └─ Calls bannerCache->invalidateCache()
   ↓
Next View Request
   └─ BannerCacheService detects cache miss
   └─ Refreshes from database
```

## Usage

### In Blade Templates

Since banners are shared via AppServiceProvider, use them normally:

```blade
@if($siteSettings && $siteSettings->banners)
    @foreach($siteSettings->banners as $banner)
        <img src="{{ asset('storage/' . $banner) }}" />
    @endforeach
@endif
```

### In Controllers

Use the helper functions:

```php
// Get cached banners (with fallback to DB)
$banners = get_cached_banners();

// Get only cached banners (returns null if not cached)
$cachedBanners = get_banners_from_cache();

// Refresh cache immediately
$banners = refresh_banner_cache();

// Invalidate cache manually
invalidate_banner_cache();
```

Or use the service directly:

```php
use App\Services\BannerCacheService;

public function myMethod(BannerCacheService $bannerCache)
{
    $banners = $bannerCache->getBanners();
    $stats = $bannerCache->getCacheStats();
}
```

### Artisan Commands

```bash
# Check cache status
php artisan banner:cache status

# Refresh cache immediately
php artisan banner:cache refresh

# Clear cache (requires confirmation)
php artisan banner:cache clear

# Clear cache without confirmation
php artisan banner:cache clear --force
```

## Configuration

### Cache TTL

Default cache duration is 24 hours. To modify:

Edit `app/Services/BannerCacheService.php`:

```php
private const CACHE_TTL = 24 * 60; // Change this value (in minutes)
```

### Cache Key

Cache is stored under key: `site_settings.banners`

To use a different key:

Edit `app/Services/BannerCacheService.php`:

```php
private const CACHE_KEY = 'site_settings.banners'; // Change this
```

## Performance Benefits

- **Reduced Database Queries**: Banner data cached for 24 hours
- **Faster Page Loads**: Cached data retrieved from Redis/Memcached (much faster than DB)
- **Automatic Invalidation**: Cache automatically refreshed when data changes
- **Dual Protection**: Both observer and controller ensure cache consistency

## Cache Statistics

Get cache information with:

```php
$stats = app(BannerCacheService::class)->getCacheStats();

// Returns:
[
    'is_cached' => true,
    'cache_key' => 'site_settings.banners',
    'ttl_minutes' => 1440,
    'banner_count' => 3,
    'cached_at' => '2024-05-31 10:30:45'
]
```

## Testing

### Test Cache Invalidation

1. Note current banners with `php artisan banner:cache status`
2. Update/delete banners in admin panel
3. Check cache is cleared: `php artisan banner:cache status`
4. Verify new banners loaded correctly

### Test Cache Performance

Monitor your application logs to see cache hits:

```bash
# Watch logs in real-time
tail -f storage/logs/laravel.log | grep "Banner cache"
```

## Troubleshooting

### Cache Not Invalidating

**Problem**: Changed banners but old ones still showing

**Solutions**:
1. Ensure observer is registered (check AppServiceProvider)
2. Manually refresh: `php artisan banner:cache refresh`
3. Check cache driver is working: `php artisan tinker`

```php
Cache::put('test', 'works', 60);
Cache::get('test'); // Should return 'works'
```

### Cache Driver Issues

If using Redis/Memcached, ensure:
- Service is running: `redis-cli ping` (should return PONG)
- Configuration is correct in `.env`
- Credentials are valid

If issues persist, reset cache:

```bash
php artisan cache:clear
php artisan banner:cache refresh
```

## Best Practices

1. **Always use helpers**: Use `get_cached_banners()` instead of querying directly
2. **Monitor cache stats**: Regularly check `php artisan banner:cache status`
3. **Log changes**: Cache invalidation is logged to `storage/logs/laravel.log`
4. **Test on staging**: Test cache behavior before deploying to production
5. **Keep TTL reasonable**: 24 hours is good for most use cases

## Migration to Caching

If you already have the system running:

1. Run `composer dump-autoload` to load the new helper file
2. Check cache with `php artisan banner:cache status`
3. Monitor logs during first 24 hours
4. No database migrations needed!

## Security Notes

- Banner cache is stored in your configured cache driver
- Cache keys are not sensitive (just `site_settings.banners`)
- Ensure your cache driver is secured (Redis password, etc.)
- Cache is invalidated before displaying new banners

## Performance Metrics

Expected improvements:
- **Uncached**: 5-15ms (database query)
- **Cached**: 0.5-2ms (cache retrieval)
- **Performance gain**: 10-20x faster for banner loading

## Future Enhancements

Possible improvements:
1. Cache warming on application start
2. Cache preheating on deployment
3. Cache hit/miss statistics API
4. Webhook integration for cache invalidation
5. CDN integration for image delivery
