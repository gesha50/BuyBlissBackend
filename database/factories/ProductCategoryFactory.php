<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->unique(true)->text(20),
            'slug' => $this->faker->unique(true)->text(20),
            'img' => null,
            'product_category_id' => 0,
            'level' => rand(0,1),
        ];
    }
}
