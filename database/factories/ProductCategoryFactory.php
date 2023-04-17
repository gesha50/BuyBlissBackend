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
            'title' => $this->faker->unique(true)->words(3, true),
            'slug' => $this->faker->unique(true)->words(3, true),
            'img' => null,
            'product_category_id' => 0,
            'level' => rand(0,1),
        ];
    }
}
