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
            'created_at' => $this->faker->dateTimeBetween('-6 month', '-1 hour'),
        ];
    }
}
