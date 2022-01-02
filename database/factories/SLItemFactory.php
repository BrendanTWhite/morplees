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
            'needed' => $this->faker->boolean(),
            'bought' => $this->faker->boolean(),
        ];
    }
}
