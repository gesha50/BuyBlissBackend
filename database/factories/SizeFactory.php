<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SizeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->text(20),
            'length' => $this->faker->numerify('###'),
            'width' => $this->faker->numerify('###'),
            'height' => $this->faker->numerify('###'),
        ];
    }
}
