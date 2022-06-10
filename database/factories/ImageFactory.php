<?php

namespace Database\Factories;

use Database\Factories\providers\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $h = $this->faker->numberBetween(300, 500);
        $w = $this->faker->numberBetween(900, 1100);
        return [
            'filename' => $this->faker->imageUrl($w, $h, "movie"),
            'aspect_ratio' => $w / $h
        ];
    }
}
