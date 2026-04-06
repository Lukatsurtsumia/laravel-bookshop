<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\App;

use App\Models\Book;
use App\Models\User;

use App\Models\Category;
use Database\Seeders\CategorySeeder;
 
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
{
    // run fixed categories
    $this->call(CategorySeeder::class);

    $categories = Category::all();

    Book::factory(20)
        ->hasReviews(10)
        ->create()
        ->each(function ($book) use ($categories) {
            $book->categories()->attach(
                $categories
                    ->random(rand(1,3))
                    ->pluck('id')
            );

            $book->update([
                'image' => 'books/' . rand(1,20) . '.jpg'
            ]);
        });

    // create admin user
    User::factory()->create([
        'name' => 'Admin',
        'email' => 'admin@gmail.com',
        'password' => bcrypt('password'),
        'is_admin' => true
    ]);
}
   
}
