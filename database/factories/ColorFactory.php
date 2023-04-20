<?php

namespace Database\Factories;

use App\Models\ColorCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ColorFactory extends Factory
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
            'color_code' => $this->faker->unique(true)->words(3, true),
            'img' => null,
            'color_category_id' => ColorCategory::factory(),
        ];
    }
}
