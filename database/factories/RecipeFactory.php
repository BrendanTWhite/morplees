<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RecipeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->catchPhrase(),
            'prep_time' => $this->faker->randomNumber(3, false),
            'cook_time' => $this->faker->randomNumber(3, false),
        ];
    }
}
