<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    public function definition(): array
    {
        $createdAt = fake()->dateTimeBetween('-10 years', 'now');
        $updatedAt = fake()->dateTimeBetween($createdAt, 'now');

        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'rating' => fake()->numberBetween(1, 5),
            'comment' => fake()->paragraph(),
            'created_at' => $createdAt,
            'updated_at' => $updatedAt,
        ];
    }
}
