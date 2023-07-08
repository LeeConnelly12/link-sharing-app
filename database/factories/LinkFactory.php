<?php

namespace Database\Factories;

use App\Models\User;
use App\Enums\Platform;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Link>
 */
class LinkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'platform' => fake()->randomElement(Platform::cases()),
            'url' => fake()->url(),
            'order' => fake()->numberBetween(0, 100),
        ];
    }
}
