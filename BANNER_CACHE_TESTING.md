# Banner Cache System - Testing & Verification Guide

## Pre-Implementation Testing

Before running any tests, ensure you've completed the setup:

```bash
cd d:\my_project\QuizVerse
composer dump-autoload
php artisan config:clear
php artisan cache:clear
```

## Test 1: Verify Service Registration

**Purpose**: Ensure BannerCacheService is properly registered

```bash
php artisan tinker
```

Then in tinker:

```php
// Check if service is registered
$service = app(App\Services\BannerCacheService::class);
echo get_class($service); // Should output: App\Services\BannerCacheService

// Check if it's a singleton
$service1 = app(App\Services\BannerCacheService::class);
$service2 = app(App\Services\BannerCacheService::class);
echo $service1 === $service2 ? 'Singleton: YES' : 'Singleton: NO'; // YES
```

## Test 2: Verify Cache Driver

**Purpose**: Ensure cache is working

```bash
php artisan tinker
```

```php
// Test basic cache operations
Cache::put('banner_test', ['banner1.jpg', 'banner2.jpg'], 60);
$cached = Cache::get('banner_test');
dd($cached); // Should return the array

// Check cache driver
echo config('cache.default'); // Should show: redis, file, database, etc.
```

## Test 3: Test Cache Stats

**Purpose**: Check cache statistics functionality

```bash
php artisan banner:cache status
```

**Expected Output:**
```
=== Banner Cache Status ===
Cache Key: site_settings.banners
Is Cached: No
Banner Count: 0
TTL: 1440 minutes
```

## Test 4: Load Banner Data (First Cache)

**Purpose**: Test initial cache load from database

```bash
php artisan tinker
```

```php
$bannerCache = app(App\Services\BannerCacheService::class);

// Get banners (will load from DB first time)
$banners = $bannerCache->getBanners();
dd($banners);

// Check stats
$stats = $bannerCache->getCacheStats();
echo "Cached: " . ($stats['is_cached'] ? 'YES' : 'NO');
echo "Banner Count: " . $stats['banner_count'];
```

## Test 5: Verify Cache Persistence

**Purpose**: Confirm data stays cached

```bash
php artisan banner:cache status
```

Run this command twice. Banner count should be the same (same data, not re-queried).

## Test 6: Test Cache Invalidation

**Purpose**: Verify cache clears when needed

```bash
# Check initial cache
php artisan banner:cache status

# Manually invalidate
php artisan tinker
```

```php
$service = app(App\Services\BannerCacheService::class);
$service->invalidateCache();
echo "Cache invalidated";
```

Then check status:

```bash
php artisan banner:cache status
```

Should show `Is Cached: No`

## Test 7: Test Helper Functions

**Purpose**: Verify helper functions work

```bash
php artisan tinker
```

```php
// Test all helper functions
$banners1 = get_cached_banners();
echo "get_cached_banners(): " . (is_array($banners1) ? count($banners1) . ' items' : 'null');

$banners2 = get_banners_from_cache();
echo "get_banners_from_cache(): " . (is_array($banners2) ? 'has data' : 'null');

invalidate_banner_cache();
echo "Cache invalidated";

$banners3 = refresh_banner_cache();
echo "Cache refreshed: " . (is_array($banners3) ? 'success' : 'failed');
```

## Test 8: Test Observer Auto-Invalidation

**Purpose**: Verify observer clears cache on model changes

```bash
# Get initial cache status
php artisan banner:cache status
# Note: Is Cached: Yes (or No)

php artisan tinker
```

```php
// Update site settings (will trigger observer)
$settings = App\Models\SiteSetting::first();
$settings->address = "Updated at " . now();
$settings->save();

echo "Settings saved - observer should have cleared cache";
```

Then check:

```bash
php artisan banner:cache status
```

Should show `Is Cached: No` (cache was invalidated by observer)

## Test 9: Integration Test - Admin Panel Update

**Purpose**: Test real-world scenario

1. Go to admin settings page
2. Note current cache status:
   ```bash
   php artisan banner:cache status
   ```

3. Upload a new banner image in admin panel
4. Submit the form

5. Check cache immediately:
   ```bash
   php artisan banner:cache status
   ```
   Should show `Is Cached: No`

6. Refresh the home page
7. Check cache again:
   ```bash
   php artisan banner:cache status
   ```
   Should show `Is Cached: Yes` with updated banner count

## Test 10: Performance Comparison

**Purpose**: Measure actual performance improvement

```bash
php artisan tinker
```

```php
// Test database query time
$start = microtime(true);
$banners = App\Models\SiteSetting::first()->banners;
$dbTime = (microtime(true) - $start) * 1000;
echo "Database query: " . round($dbTime, 2) . "ms\n";

// Test cache hit time
$start = microtime(true);
$banners = get_cached_banners();
$cacheTime = (microtime(true) - $start) * 1000;
echo "Cache query: " . round($cacheTime, 2) . "ms\n";

echo "Improvement: " . round($dbTime / $cacheTime) . "x faster\n";
```

## Test 11: Logging Verification

**Purpose**: Verify logging is working

```bash
# Watch logs in real-time
Get-Content -Path storage\logs\laravel.log -Tail 20 -Wait

# Or search for banner cache logs
Select-String "Banner cache" storage\logs\laravel.log
```

Should see entries like:
```
[timestamp] local.INFO: Banner cache invalidated at [time]
```

## Test 12: Controller Integration Test

**Purpose**: Verify SiteSettingController properly invalidates cache

```bash
php artisan tinker
```

```php
// Simulate file upload scenario
$request = new Illuminate\Http\Request();

// Get the controller
$controller = new App\Http\Controllers\Backend\SiteSettingController(
    app(App\Services\BannerCacheService::class)
);

echo "Controller instantiated with BannerCacheService: SUCCESS";
```

## Test 13: Cache Refresh Command

**Purpose**: Test manual refresh command

```bash
# Check current state
php artisan banner:cache status

# Refresh cache
php artisan banner:cache refresh

# Verify refresh
php artisan banner:cache status
```

Should show cache is refreshed with current data.

## Test 14: Cache Clear Command

**Purpose**: Test cache clear command

```bash
# Clear cache without force (will prompt)
php artisan banner:cache clear

# Choose 'yes' when prompted

# Verify clear
php artisan banner:cache status
```

Should show `Is Cached: No`

## Test 15: Banner Deletion Scenario

**Purpose**: Test cache invalidation on deletion

```bash
# Get current banner list
php artisan banner:cache status

# Go to admin panel and delete a banner

# Check cache is invalidated
php artisan banner:cache status
```

Cache should show invalidated, and banner count should decrease after page refresh.

## Performance Benchmarking

Run this comprehensive test:

```bash
php artisan tinker
```

```php
$iterations = 1000;

// Benchmark database queries
$start = microtime(true);
for ($i = 0; $i < $iterations; $i++) {
    App\Models\SiteSetting::first();
}
$dbTime = microtime(true) - $start;

// Benchmark cache
$start = microtime(true);
for ($i = 0; $i < $iterations; $i++) {
    get_cached_banners();
}
$cacheTime = microtime(true) - $start;

echo "Database ($iterations queries): " . round($dbTime * 1000, 2) . "ms\n";
echo "Cache ($iterations queries): " . round($cacheTime * 1000, 2) . "ms\n";
echo "Improvement: " . round($dbTime / $cacheTime) . "x faster\n";
```

## Troubleshooting Tests

### If Cache Shows "Not Cached"

```php
// Check if database table exists
Schema::hasTable('site_settings') // Should be: true

// Check if records exist
App\Models\SiteSetting::count() // Should be: > 0

// Manually cache data
$service = app(App\Services\BannerCacheService::class);
$banners = $service->refreshCache();
dd($banners);
```

### If Observer Not Working

```php
// Check observer is registered
// In AppServiceProvider boot(), SiteSetting::observe(SiteSettingObserver::class) should exist

// Manually trigger observer
$settings = App\Models\SiteSetting::first();
$settings->touch(); // This will fire 'updated' event

// Check cache
php artisan banner:cache status
```

### If Helper Functions Not Loading

```bash
# Rebuild autoload
composer dump-autoload

# Verify helper file exists
composer show -f | grep BannerCacheHelpers

# In tinker
function_exists('get_cached_banners') ? 'YES' : 'NO'
```

## Final Verification Checklist

- [ ] Service registration test passes
- [ ] Cache driver test passes
- [ ] Cache stats command works
- [ ] Initial cache load works
- [ ] Cache persistence test passes
- [ ] Cache invalidation works
- [ ] Helper functions work
- [ ] Observer auto-invalidation works
- [ ] Admin panel integration works
- [ ] Performance improvement measurable
- [ ] Logging shows cache operations
- [ ] Controller integration works
- [ ] Refresh command works
- [ ] Clear command works
- [ ] Banner deletion triggers invalidation
- [ ] Performance benchmark shows improvement

## Success Criteria

✅ All tests should pass
✅ Cache should be at least 5x faster than database
✅ Cache should auto-invalidate on changes
✅ No database errors
✅ All logging working
✅ Helper functions accessible throughout app

---

If all tests pass, your banner caching system is **production-ready**! 🚀
