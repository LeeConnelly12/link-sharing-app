<?php
use App\Models\Link;
use App\Models\User;
use App\Enums\Platform;
use Inertia\Testing\AssertableInertia as Assert;
use function Pest\Laravel\{actingAs, get, post, assertDatabaseCount, assertDatabaseHas, assertDatabaseEmpty};

beforeEach(function () {
    $this->user = User::factory()->create();
    actingAs($this->user);
});

it('can be viewed', function () {
    $links = Link::factory()
        ->for($this->user)
        ->count(3)
        ->create();

    get('/')
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('Links/Index')
            ->has('links', 3, fn (Assert $page) => $page
                ->where('platform', $links->first()->platform->value)
                ->where('url', $links->first()->url)
                ->etc()
            )
            ->has('platforms')
        );
});

it('can be created', function () {
    $links = [
        [
            'user_id' => $this->user->id,
            'platform' => Platform::GITHUB->value,
            'url' => 'https://github.com',
            'order' => 1,
        ],
    ];

    post('/links', [
        'links' => $links,
    ])
    ->assertRedirect();

    assertDatabaseCount(Link::class, 1);

    assertDatabaseHas(Link::class, [
        'platform' => $links[0]['platform'],
        'url' => $links[0]['url'],
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
