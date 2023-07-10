<?php

namespace App\Http\Controllers;

use App\Enums\Platform;
use App\Http\Requests\LinkRequest;
use App\Http\Resources\LinkResource;
use App\Models\Link;
use Illuminate\Http\Request;

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
    public function store(LinkRequest $request)
    {
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
