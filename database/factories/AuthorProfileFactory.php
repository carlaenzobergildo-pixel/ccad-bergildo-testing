<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\AuthorProfile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<AuthorProfile>
 */
class AuthorProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'author_id' => Author::factory(),
            'bio' => $this->faker->paragraph(),
        ];
    }
}
