<?php

namespace Database\Factories;

use App\Models\Specification;
use Illuminate\Database\Eloquent\Factories\Factory;

class SpecificationValueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'value' => $this->faker->unique(true)->words(3, true),
            'description' => $this->faker->text(60),
            'img' => null,
//            'specification_id' => Specification::factory()
        ];
    }
}
