<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
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
            'description' => $this->faker->text(60),
            'full_title' => $this->faker->text(40),
            'full_description' => $this->faker->paragraph(3, 6),
            'meta_title' => $this->faker->text(20),
            'meta_description' => $this->faker->text(40),
            'is_active' => $this->faker->boolean(80),
            'is_error' => false,
        ];
    }
}
