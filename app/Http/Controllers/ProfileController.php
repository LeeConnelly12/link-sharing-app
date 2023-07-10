<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class ProfileController extends Controller
{
    /**
     * Display the user's profile.
     */
    public function index()
    {
        return inertia('Profile/Index');
    }

    /**
     * Update the user's profile.
     */
    public function update(Request $request)
    {
        $request->validate([
            'profile_picture' => ['nullable', File::types(['jpg', 'png'])],
            'first_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)->ignore($request->user())],
        ]);

        $request->user()->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
        ]);

        if ($request->hasFile('profile_picture')) {
            $request->user()
                ->addMedia($request->file('profile_picture'))
                ->toMediaCollection('profile_picture');
        }

        return back()->with('message', 'Your changes have been successfully saved!');
    }
}
