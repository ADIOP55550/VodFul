<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Playlist>
 */
class PlaylistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->words($this->faker->numberBetween(1, 4)),
            'protected' => false
        ];
    }

    public function favourites()
    {
        return $this->state(function ($atts) {
            return [
                'name' => 'favourites',
                'protected' => true,
                'user_id' => null
            ];
        });
    }

    public function ignored()
    {
        return $this->state(function ($atts) {
            return [
                'name' => 'ignored',
                'protected' => true,
                'user_id' => null
            ];
        });
    }
}
