<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create users FIRST
        User::factory(10)->create();

        // Create admin
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'is_admin' => true
        ]);

        // Run categories
        $this->call(CategorySeeder::class);

        $categories = Category::all();

        // Create books
        Book::factory(20)
            ->hasReviews(10)
            ->create()
            ->each(function ($book) use ($categories) {
                $book->categories()->attach(
                    $categories->random(rand(1,3))->pluck('id')
                );

                $book->update([
                    'image' => 'books/' . rand(1,20) . '.jpg'
                ]);
            });
    }
}
