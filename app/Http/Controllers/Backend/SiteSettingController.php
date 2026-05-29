<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiteSettingController extends Controller
{
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
        ]);

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
                }
            }
        }

        // 3. Handle multiple home banner uploads
        if ($request->hasFile('banners')) {
            foreach ($request->file('banners') as $file) {
                if ($file->isValid()) {
                    $currentBanners[] = $file->store('settings/banners', 'public');
                }
            }
        }

        // Save banner paths back to settings
        $settings->banners = $currentBanners;

        // 4. Handle text inputs
        $settings->address = $validated['address'];
        $settings->email = $validated['email'];
        $settings->contact_number = $validated['contact_number'];

        $settings->save();

        return redirect()->back()->with('success', 'Site settings updated successfully.');
    }
}
