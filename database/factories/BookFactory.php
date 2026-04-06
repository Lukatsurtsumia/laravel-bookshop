<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition(): array
    {
        return [
            'image' => null,
            'title' => $this->faker->sentence(3),
            'author' => $this->faker->name(),
            'description' => $this->faker->paragraph(),
            'year' => $this->faker->year(),
            'price' => $this->faker->randomFloat(2, 5, 100),
            'user_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
