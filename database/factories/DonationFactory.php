<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class DonationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'donator_name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'amount' => $this->faker->numberBetween($min = 10, $max = 25),
            'message' => $this->faker->text($maxNbChars = 50),
        ];
    }
}
