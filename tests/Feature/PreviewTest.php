<?php
use App\Models\Link;
use App\Models\User;
use function Pest\Laravel\{actingAs, get};
use Inertia\Testing\AssertableInertia as Assert;

it('can be viewed', function () {
    $user = User::factory()
        ->has(Link::factory()->count(3))
        ->create();

    actingAs($user)
        ->get('/preview')
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('Previews/Index')
            ->has('links', 3)
        );
});

it('can view others', function () {
    $user = User::factory()
        ->has(Link::factory()->count(3))
        ->create();

    get('/previews/'.$user->id)
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('Previews/Show')
            ->has('user', fn (Assert $page) => $page
                ->where('profile_picture', $user->getFirstMediaUrl('profile_picture'))
                ->where('first_name', $user->first_name)
                ->where('last_name', $user->last_name)
                ->where('email', $user->email)
                ->has('links', 3)
            )
        );
});
