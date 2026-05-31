<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Services\BannerCacheService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiteSettingController extends Controller
{
    /**
     * BannerCacheService instance
     */
    protected BannerCacheService $bannerCache;

    /**
     * Constructor
     */
    public function __construct(BannerCacheService $bannerCache)
    {
        $this->bannerCache = $bannerCache;
    }

    /**
     * Display a single-page view for creating and editing site settings.
     */
    public function edit()
    {
        // Get the first record of a new Model so inputs are safe even if empty
        $settings = SiteSetting::first() ?? new SiteSetting();
        return view('backend.settings.edit', compact('settings'));
    }

    /**
     * Store or update site settings.
     */
    public function update(Request $request)
    {
        $settings = SiteSetting::firstOrCreate([]);

        $validated = $request->validate([
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'banners.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:4096',
            'address' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'contact_number' => 'nullable|string|max:50',
            'deleted_banners' => 'nullable|array',
            'deleted_banners.*' => 'string',
            'facebook_link' => 'nullable|url|max:255',
            'linkedin_link' => 'nullable|url|max:255',
            'instagram_link' => 'nullable|url|max:255',
            'whatsapp_link' => 'nullable|string|max:255',
        ]);

        $bannerModified = false;

        // 1. Handle single logo upload
        if ($request->hasFile('logo')) {
            // Delete old logo if it exists
            if ($settings->logo) {
                Storage::disk('public')->delete($settings->logo);
            }
            // Store new logo
            $settings->logo = $request->file('logo')->store('settings', 'public');
        }

        // Retrieve current banners array
        $currentBanners = $settings->banners ?? [];

        // 2. Handle deletion of specific banners
        if ($request->has('deleted_banners')) {
            foreach ($request->deleted_banners as $path) {
                // Ensure the path exists in current banners before deleting
                if (in_array($path, $currentBanners)) {
                    Storage::disk('public')->delete($path);
                    $currentBanners = array_values(array_diff($currentBanners, [$path]));
                    $bannerModified = true;
                }
            }
        }

        // 3. Handle multiple home banner uploads
        if ($request->hasFile('banners')) {
            foreach ($request->file('banners') as $file) {
                if ($file->isValid()) {
                    $currentBanners[] = $file->store('settings/banners', 'public');
                    $bannerModified = true;
                }
            }
        }

        // Save banner paths back to settings
        $settings->banners = $currentBanners;

        // 4. Handle text inputs
        $settings->address = $validated['address'];
        $settings->email = $validated['email'];
        $settings->contact_number = $validated['contact_number'];
        $settings->facebook_link = $validated['facebook_link'];
        $settings->linkedin_link = $validated['linkedin_link'];
        $settings->instagram_link = $validated['instagram_link'];
        $settings->whatsapp_link = $validated['whatsapp_link'];

        $settings->save();

        // Explicitly invalidate cache if banners were modified
        // This ensures immediate cache refresh on the next request
        if ($bannerModified) {
            $this->bannerCache->invalidateCache();
        }

        return redirect()->back()->with('success', 'Site settings updated successfully.');
    }
}
