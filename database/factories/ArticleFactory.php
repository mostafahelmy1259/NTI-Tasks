<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(), // Generate fake sentence for title
            'body' => $this->faker->paragraph(), // Generate fake paragraph for body
            'user_id' => User::factory(), // Create a user for this article
        ];
    }

    public function featured(): static
        {
            return $this->state(fn (array $attributes) => [
                'title' => 'Featured: ' . fake()->sentence(),
                'body' => fake()->paragraphs(3, true),
            ]);
        }

}
