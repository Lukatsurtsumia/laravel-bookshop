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
        $this->call(CategorySeeder::class);

        $categories = Category::all();

        // create admin
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'is_admin' => true
        ]);

        // create books manually
        for ($i = 1; $i <= 20; $i++) {

            $book = Book::create([
                'title' => 'Sample Book '.$i,
                'author' => 'Author '.$i,
                'description' => 'Example book description',
                'year' => rand(2000,2024),
                'price' => rand(10,100),
                'quantity' => rand(1,20),
                'image' => 'books/'.$i.'.jpg',
                'user_id' => $admin->id
            ]);

            $book->categories()->attach(
                $categories->random(rand(1,3))->pluck('id')
            );
        }
    }
}
