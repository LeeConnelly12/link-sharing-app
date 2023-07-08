<?php

namespace App\Http\Controllers;

use App\Enums\Platform;
use App\Http\Resources\LinkResource;
use App\Models\Link;
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
            ->select('id', 'platform', 'url', 'order')
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

        foreach ($request->links as $index => $link) {
            Link::query()->create([
                'user_id' => $request->user()->id,
                'platform' => $link['platform'],
                'url' => $link['url'],
                'order' => $index,
            ]);
        }

        return back();
    }
}
