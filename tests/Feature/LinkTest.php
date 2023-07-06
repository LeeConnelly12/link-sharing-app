<?php
use App\Models\Link;
use App\Models\User;
use App\Enums\Platform;
use function Pest\Laravel\{actingAs, post, assertDatabaseCount, assertDatabaseHas, assertDatabaseEmpty};

beforeEach(function () {
    $this->user = User::factory()->create();
    actingAs($this->user);
});

it('can be created', function () {
    $links = Link::factory()->count(3)->make();

    post('/links', [
        'links' => $links->toArray(),
    ])
    ->assertRedirect();

    assertDatabaseCount(Link::class, 3);

    assertDatabaseHas(Link::class, [
        'platform' => $links->first()->platform,
        'url' => $links->first()->url,
    ]);
});

it('can be updated', function () {
    Link::factory()
        ->for($this->user)
        ->count(3)
        ->create();

    $newLink = Link::factory()->make([
        'platform' => Platform::GITHUB,
        'url' => 'https://github.com/LeeConnelly12',
    ]);

    post('/links', [
        'links' => [$newLink->toArray()],
    ])
    ->assertRedirect();

    assertDatabaseCount(Link::class, 1);

    assertDatabaseHas(Link::class, [
        'platform' => $newLink->platform,
        'url' => $newLink->url,
    ]);
});

it('can all be deleted', function () {
    Link::factory()
        ->for($this->user)
        ->count(3)
        ->create();

    post('/links', [
        'links' => [],
    ])
    ->assertRedirect();

    assertDatabaseEmpty(Link::class);
});
