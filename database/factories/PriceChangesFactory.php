<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PriceChangesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'new_price' => $this->faker->numerify('#####.##'),
            'price_with_discount' => $this->faker->numerify('#####.##'),
            'discount_finish_at' => $this->faker->dateTime,
        ];
    }
}
