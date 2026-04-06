<?php
namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
public function definition(): array
{
    $faker = \Faker\Factory::create();

    return [
        'image' => null,
        'title' => $faker->sentence(3),
        'author' => $faker->name(),
        'description' => $faker->paragraph(),
        'year' => $faker->year(),
        'price' => $faker->randomFloat(2, 5, 100),
        'user_id' => \App\Models\User::factory(),
    ];
}
