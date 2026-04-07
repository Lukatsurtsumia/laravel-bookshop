<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class ReviewFactory extends Factory
{
    public function definition(): array
    {
        $faker = \Faker\Factory::create();

        $createdAt = $faker->dateTimeBetween('-10 years', 'now');
        $updatedAt = $faker->dateTimeBetween($createdAt, 'now');

        return [
            'user_id' => User::inRandomOrder()->value('id'),
            'rating' => $faker->numberBetween(1,5),
            'comment' => $faker->paragraph(),
            'created_at' => $createdAt,
            'updated_at' => $updatedAt,
        ];
    }
}
