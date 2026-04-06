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
        $createdAt = $this->faker->dateTimeBetween('-10 years', 'now');
        $updatedAt = $this->faker->dateTimeBetween($createdAt, 'now');

        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'rating' => $this->faker->numberBetween(1, 5),
            'comment' => $this->faker->paragraph(),
            'created_at' => $createdAt,
            'updated_at' => $updatedAt,
        ];
    }
}
