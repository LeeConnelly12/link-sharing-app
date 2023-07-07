<?php
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Inertia\Testing\AssertableInertia as Assert;
use function Pest\Laravel\{actingAs, get, post, assertDatabaseHas};

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
    post('/profile', [
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

it('can upload profile picture', function () {
    Storage::fake();

    $image = UploadedFile::fake()->image('profile_picture.jpg');

    post('/profile', [
        'profile_picture' => $image,
        'first_name' => 'new',
        'last_name' => 'name',
        'email' => 'newemail@example.com',
    ])
    ->assertRedirect();

    expect($this->user->getFirstMediaUrl('profile_picture'))
        ->not
        ->toBeNull();
});
