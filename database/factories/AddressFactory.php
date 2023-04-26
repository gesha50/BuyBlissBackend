<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'index' => $this->faker->numerify('######'),
            'region' => $this->faker->words(2, true),
            'city' => $this->faker->word,
            'street' => $this->faker->words(3, true),
            'house' => $this->faker->numerify('##'),
            'floor' => $this->faker->numerify('#'),
            'entrance' => $this->faker->numerify('##'),
            'flat' => $this->faker->numerify('###'),
            'is_private_house' => $this->faker->boolean,
            'is_main' => $this->faker->boolean,
            'user_id' => null
        ];
    }
}
