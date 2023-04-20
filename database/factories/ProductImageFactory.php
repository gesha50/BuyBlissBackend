<?php

namespace Database\Factories;

use App\Models\ColorProduct;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductImageFactory extends Factory
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
            'img' => null,
            'is_poster' => $this->faker->boolean(80),
            'is_universal' => $this->faker->boolean(80),
            'color_product_id' => ColorProduct::factory(),
        ];
    }
}
