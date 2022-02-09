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
            'already_own' => $this->faker->boolean(),
            'in_basket' => $this->faker->boolean(),
        ];
    }
}
