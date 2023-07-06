<?php

namespace App\Http\Controllers;

use App\Enums\Platform;
use App\Http\Resources\LinkResource;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class LinkController extends Controller
{
    /**
     * Display the user's links.
     */
    public function index(Request $request)
    {
        $links = $request->user()->links()
            ->select('platform', 'url')
            ->get();

        return inertia('Links/Index', [
            'links' => LinkResource::collection($links),
            'platforms' => Platform::cases(),
        ]);
    }

    /**
     * Update the user's links.
     */
    public function store(Request $request)
    {
        $request->validate([
            'links' => ['nullable', 'array'],
            'links.*.platform' => ['required', new Enum(Platform::class)],
            'links.*.url' => ['required', 'url', 'max:255'],
        ]);

        $request->user()
            ->links()
            ->delete();

        $request->user()
            ->links()
            ->createMany($request->links);

        return back();
    }
}
