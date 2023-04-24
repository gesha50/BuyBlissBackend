<?php

namespace Database\Factories;

use App\Models\SpecificationCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class SpecificationFactory extends Factory
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
            'type' => $this->faker->words(1, true),
            'is_filter' => $this->faker->boolean,
        ];
    }
}
