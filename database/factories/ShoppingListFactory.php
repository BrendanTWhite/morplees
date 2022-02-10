<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ShoppingListFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'override_name' => null,
            'active'    => ($this->faker->randomDigit()) < 3, // we want 3 in 10 to be TRUE
            'created_at' => $this->faker->dateTimeBetween('-6 month', '-2 days'),
        ];
    }
}
