<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Business;
use App\Models\UserMeta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

use Illuminate\Support\Facades\Log;


class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {

        // $user = $request->user();
        $user = Auth::user()->load('userMeta.business');

        $userMeta = $user->userMeta; // Assuming you have a relationship defined in the User model
        $chambers = Chamber::where('approved', true)->get(); // Fetch approved chambers
        $groups = Group::where('approved', true)->get(); // Fetch approved groups

        return view('profile.edit', compact('user', 'userMeta', 'chambers', 'groups'));
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        // Handle business name update
        if ($request->has('business')) {
            $businessName = $request->input('business');
            $business = Business::where('name', $businessName)->first();

            if ($business) {
                $userMeta = $user->meta; // Assuming you have a relationship set up
                $userMeta->business_id = $business->id;
                $userMeta->save();
            } else {
                // Handle case where business is not found
                return Redirect::route('profile.edit')->withErrors(['business' => 'Business not found']);
            }
        }

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

    public function showProfile(Request $request): View
    {
        $user = $request->user();
        $userMeta = UserMeta::where('user_id', $user->id)->first();

        $roles = config('app.roles'); // If added to config/app.php

        return view('profile.show', compact('user', 'userMeta', 'roles'));
    }
    public function updateChamber(Request $request)
    {
    // Check if the authenticated user is user_id 1
    if (Auth::id() !== 1) {
        return redirect()->back()->withErrors(['error' => 'You are not authorized to perform this action.']);
    }

    $request->validate([
        'chamber' => 'required|exists:chambers,id',
    ]);

    $user = Auth::user();
    $userMeta = $user->meta;

    if (!$userMeta) {
        $userMeta = new UserMeta();
        $userMeta->user_id = $user->id;
    }

    $userMeta->chamber_id = $request->input('chamber');
    $userMeta->save();

    return redirect()->back()->with('status', 'Chamber updated successfully!');
    }

    public function updateGroup(Request $request)
    {
    // Check if the authenticated user is user_id 1
    if (Auth::id() !== 1) {
        return redirect()->back()->withErrors(['error' => 'You are not authorized to perform this action.']);
    }

    $request->validate([
        'group' => 'required|exists:groups,id',
    ]);

    $user = Auth::user();
    $userMeta = $user->meta;

    if (!$userMeta) {
        $userMeta = new UserMeta();
        $userMeta->user_id = $user->id;
    }

    $userMeta->group_id = $request->input('group');
    $userMeta->save();

    return redirect()->back()->with('status', 'Group updated successfully!');
    }
}
