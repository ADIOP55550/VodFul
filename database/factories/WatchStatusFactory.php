<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WatchStatus>
 */
class WatchStatusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'progress' => $this->faker->biasedNumberBetween(0, 1000) / 1000.0,
            'times_watched' => $this->faker->biasedNumberBetween(1, 20),
            'last_watched' => $this->faker->dateTimeThisYear()
        ];
    }
}
