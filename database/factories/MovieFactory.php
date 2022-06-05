<?php

namespace Database\Factories;

use Database\Factories\providers\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $this->faker->addProvider(new Movie($this->faker));
        return [
            'title' => $this->faker->title(),
            'rating' => $this->faker->rating(),
            'rating_count' => $this->faker->ratingCount(),
            'year' => $this->faker->year(),
            'description' => $this->faker->paragraph()
        ];
    }
}
