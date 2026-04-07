<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    public function definition(): array
    {
        $createdAt = $this->faker->dateTimeBetween('-10 years', 'now');
        $updatedAt = $this->faker->dateTimeBetween($createdAt, 'now');

        return [
            'rating' => $this->faker->numberBetween(1,5),
            'comment' => $this->faker->paragraph(),
            'created_at' => $createdAt,
            'updated_at' => $updatedAt,
        ];
    }
}
