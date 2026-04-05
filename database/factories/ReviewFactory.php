<?php

namespace Database\Factories;
use APP\Models\Book;
use APP\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
   

    public function definition(): array
    {
        $createAt = fake()->dateTimeBetween('-10 year', 'now');
        $updatedAt = fake()->dateTimeBetween($createAt, 'now');
        return [
            'user_id'=>User::inRandomOrder()->first()->id,
            'rating'=>fake()->numberBetween(1, 5),
            'comment' => fake()->paragraph(),
            'created_at' => $createAt,
            'updated_at' => $updatedAt,
        ];
    }
}
