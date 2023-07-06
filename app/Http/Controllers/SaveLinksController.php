<?php

namespace App\Http\Controllers;

use App\Enums\Platform;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

class SaveLinksController extends Controller
{
    public function __invoke(Request $request)
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
