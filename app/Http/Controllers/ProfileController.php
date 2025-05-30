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
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('user.account')->with('status', 'profile-updated');
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

        if ($user->profile_picture) {
            Storage::delete($user->profile_picture);
        }

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function updateProfilePicture(Request $request): RedirectResponse
    {
        $request->validate([
            'profile_picture' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        $user = Auth::user();

        if ($user->profile_picture) {
            Storage::delete($user->profile_picture);
        }

        $path = $request->file('profile_picture')->store('profile-pictures', 'public');

        $user->update([
            'profile_picture' => $path,
        ]);

        return back()->with('status', 'profile-picture-updated');
    }

    public function userAccount(): View
    {
        return view('useraccount', [
            'user' => Auth::user(),
        ]);
    }
}
