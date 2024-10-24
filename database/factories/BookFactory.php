<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

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
            'title' => $this->faker->sentence,
            'isbn' => $this->faker->isbn13,
            'description' => $this->faker->paragraph,
            'author_id' => User::inRandomOrder()->first()->id,
            'image_url' => $this->faker->imageUrl(200,325,true),
        ];
    }
}
