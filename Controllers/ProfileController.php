<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
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
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
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

    public function complete()
    {
        return view('profile.complete');
    }

    public function updates(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'date_of_birth' => 'required|date',
            'department' => 'required|string',
            'phone_number' => 'required|string|max:15',
            'profile_picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // adjust max file size as needed
        ]);

        // Get the authenticated user
        $user = Auth::user();

        // Update the user's profile information
        $user->profile->update([
            'date_of_birth' => $request->date_of_birth,
            'department' => $request->department,
            'phone_number' => $request->phone_number,
        ]);

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');

            // Update profile picture path in the user's profile
            $user->profile->update([
                'profile_picture' => $profilePicturePath,
            ]);
        }

        // Redirect the user after profile update
        return redirect()->route('home')->with('success', 'Profile updated successfully!');
    }

}
