<?php

namespace Database\Factories\providers;

use Faker;

class Movie extends Faker\Provider\Base
{

    public function title($nbWords = null)
    {
        if (is_null($nbWords))
            $nbWords = $this->generator->numberBetween(3, 7);
        $sentence = $this->generator->sentence($nbWords);
        return substr($sentence, 0, strlen($sentence) - 1);
    }

    public function rating()
    {
        return $this->generator->biasedNumberBetween(0, 1000) / 100.0;
    }

    public function ratingCount()
    {
        return 99000 - ($this->generator->biasedNumberBetween() * 1000) + ($this->generator->numberBetween(0, 1000));
    }

}
