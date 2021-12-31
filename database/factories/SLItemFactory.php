<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SLItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'suggestion_interval' => $this->faker->randomDigit(),
            'need_to_buy' => $this->faker->boolean(),
        ];
    }
}
