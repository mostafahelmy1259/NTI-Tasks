<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Article;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
            // Create a test user if it doesn't exist
            $user = User::firstOrCreate(
                ['email' => 'test@example.com'], // Check if user with this email exists
                ['name' => 'Test User', 'password' => bcrypt('password'), 'email_verified_at' => now(),] // Create with these values
            );

            // Create 5 fake articles for the test user
            $user->articles()->createMany(
                Article::factory()->count(5)->make()->toArray()
            );

            // Create additional users with articles
            User::factory(5)->create()->each(function ($user) {
            // Create 2-5 articles per user
            $user->articles()->createMany(
                Article::factory()->count(rand(2, 5))->make()->toArray()
            );
            
            Article::factory(3)->create([
            'title' => 'Featured: ' . fake()->sentence(),
            'body' => fake()->paragraphs(3, true),
            ]);
        });
    }


    
}

