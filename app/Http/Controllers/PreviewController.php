<?php

namespace App\Http\Controllers;

use App\Http\Resources\LinkResource;
use App\Models\User;
use Illuminate\Http\Request;

class PreviewController extends Controller
{
    /**
     * Display the current user's preview.
     */
    public function index(Request $request)
    {
        $links = $request->user()->links()
            ->select('platform', 'url')
            ->get();

        return inertia('Previews/Index', [
            'links' => LinkResource::collection($links),
        ]);
    }

    /**
     * Display the specified preview.
     */
    public function show(User $user)
    {
        $links = $user->links()
            ->select('platform', 'url')
            ->get();

        return inertia('Previews/Show', [
            'user' => [
                'profile_picture' => $user->getFirstMediaUrl('profile_picture'),
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'links' => LinkResource::collection($links),
            ]
        ]);
    }
}
