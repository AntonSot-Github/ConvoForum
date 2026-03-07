<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\PhoneUpdateRequest;
use App\Http\Requests\AvatarUpdateRequest;
//use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

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

    //Update the user's phone number
    public function updatePhone(PhoneUpdateRequest $request)
    {
        $request->user()->update([
            'phone' => $request->phone,
        ]);

        return redirect()->route('profile.edit')->with('success', 'Phone updated');
    }

    //Update the user's avatar picture
    public function updateAvatar(AvatarUpdateRequest $request)
    {
        $user = $request->user();

        if ($request->hasFile('avatar')) {

            //Delete the old user's avatar if it isn't default
            if ($user->avatar && $user->avatar !== 'avatars/av_def.png') {
                Storage::disk('public')->delete($user->avatar);
            }

            //Save new avatar-image
            $imagePath = $request->file('avatar')
                ->store('avatars', 'public');

            //Update DB
            $user->update([
                'avatar' => $imagePath,
            ]);
        }

        return redirect()->route('profile.edit')->with('success', 'Avatar updated');
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
