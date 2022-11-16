<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SLRecipeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'date' => $this->faker->boolean()
                    ? $this->faker->dateTimeBetween('-1 week', '+3 weeks')
                    : null,
        ];
    }
}
