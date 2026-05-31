<?php

namespace App\Console\Commands;

use App\Services\BannerCacheService;
use Illuminate\Console\Command;

class BannerCacheCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'banner:cache {action=status} {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Manage banner cache (status, refresh, clear)';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(BannerCacheService $bannerCache): int
    {
        $action = $this->argument('action');

        switch ($action) {
            case 'status':
                return $this->showStatus($bannerCache);
            case 'refresh':
                return $this->refresh($bannerCache);
            case 'clear':
                return $this->clear($bannerCache);
            default:
                $this->error("Unknown action: {$action}");
                $this->line('Available actions: status, refresh, clear');
                return 1;
        }
    }

    /**
     * Show cache status
     *
     * @param BannerCacheService $bannerCache
     * @return int
     */
    private function showStatus(BannerCacheService $bannerCache): int
    {
        $stats = $bannerCache->getCacheStats();

        $this->info('=== Banner Cache Status ===');
        $this->line("Cache Key: {$stats['cache_key']}");
        $this->line("Is Cached: " . ($stats['is_cached'] ? 'Yes' : 'No'));
        $this->line("Banner Count: {$stats['banner_count']}");
        $this->line("TTL: {$stats['ttl_minutes']} minutes");

        if ($stats['is_cached']) {
            $this->line("Last Updated: {$stats['cached_at']}");
        }

        return 0;
    }

    /**
     * Refresh banner cache
     *
     * @param BannerCacheService $bannerCache
     * @return int
     */
    private function refresh(BannerCacheService $bannerCache): int
    {
        try {
            $banners = $bannerCache->refreshCache();
            $count = is_array($banners) ? count($banners) : 0;

            $this->info("Banner cache refreshed successfully!");
            $this->line("Total banners cached: {$count}");

            return 0;
        } catch (\Exception $e) {
            $this->error("Error refreshing cache: " . $e->getMessage());
            return 1;
        }
    }

    /**
     * Clear banner cache
     *
     * @param BannerCacheService $bannerCache
     * @return int
     */
    private function clear(BannerCacheService $bannerCache): int
    {
        if (!$this->option('force')) {
            if (!$this->confirm('Are you sure you want to clear the banner cache?')) {
                $this->warn('Cache clear cancelled.');
                return 0;
            }
        }

        try {
            $bannerCache->clearAll();
            $this->info('Banner cache cleared successfully!');
            return 0;
        } catch (\Exception $e) {
            $this->error("Error clearing cache: " . $e->getMessage());
            return 1;
        }
    }
}
