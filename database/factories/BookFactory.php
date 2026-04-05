<?php

namespace Database\Factories;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'image'=>null,
            'title'=> fake()->sentence(3),
            'author'=>fake()->name(),
            'description'=>fake()->paragraph(),
            'year'=>fake()->year(),
            'price'=>fake()->randomFloat(2, 5, 100),
            'user_id'=>User::inRandomOrder()->first()->id,
        ];
    }
}
