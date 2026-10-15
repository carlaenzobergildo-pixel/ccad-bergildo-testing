<?php

namespace Database\Seeders;

use App\Models\Book;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Author;
use App\Models\Publisher;
use App\Models\AuthorProfile;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $publishers = Publisher::factory()->count(10)->create();

        foreach($publishers as $publisher) {

        Author::factory()
        ->count(3)
        ->create(['publisher_id' => $publisher->id])
        ->each(function( Author $author) use ($publisher) {

        AuthorProfile::factory()->create([
            'author_id' => $author->id
        ]);

        Book::factory()
            ->count(rand(2,10))
            ->create([
                'author_id' => $author->id,
                'publisher_id' => $publisher->id
            ]);

        });
        }

    }
}
