<?php
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;
use function Pest\Laravel\{actingAs, get, put, assertDatabaseHas};

beforeEach(function () {
    $this->user = User::factory()->create([
        'first_name' => 'john',
        'last_name' => 'doe',
        'email' => 'johndoe@example.com',
    ]);
    actingAs($this->user);
});

it('can be viewed', function () {
    get('/profile')
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('Profile/Index')
        );
});

it('can be updated', function () {
    put('/profile', [
        'first_name' => 'new',
        'last_name' => 'name',
        'email' => 'newemail@example.com'
    ])
    ->assertRedirect();

    assertDatabaseHas(User::class, [
        'id' => $this->user->id,
        'first_name' => 'new',
        'last_name' => 'name',
        'email' => 'newemail@example.com',
    ]);
});
