<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->fill($request->validated()); //Update user table fields
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        $request->user()->save();

        // Prepare participant data
        $participantData = [
            'age' => $request->age,
            'date_of_birth' => $request->date_of_birth,
            'division' => $request->division,
            'district' => $request->district,
            'upazilla' => $request->upazilla,
            'address' => $request->address,
        ];

        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            // Delete old file if exists
            if ($user->participant->profile_image) {
                Storage::disk('public')->delete($user->participant->profile_image);
            }

            // Save new file with original name
            $filename = $file->getClientOriginalName();
            $path = $file->storeAs('profile_image', $filename, 'public');
            $participantData['profile_image'] = $path;
        }

        // Update participant record
        $user->participant->update($participantData);

        return Redirect::route('dashboard')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
