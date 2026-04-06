<?php
namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    public function definition(): array
    {
        return [
            'image' => null,
            'title' => $this->faker->sentence(3),
            'author' => $this->faker->name(),
            'description' => $this->faker->paragraph(),
            'year' => $this->faker->year(),
            'price' => $this->faker->randomFloat(2, 5, 100),
            'user_id' => User::factory(),
        ];
    }
}
