<?php

namespace Database\Factories;

use App\Models\Resident;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ResidentParentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'residentId' => Resident::factory(),
            'motherfirstName' => fake()->firstName('female'),
            'mothermiddleName' => fake()->lastName(),
            'motherlastName' => fake()->lastName(),
            'fatherfirstName' => fake()->firstName('male'),
            'fathermiddleName' => fake()->lastName(),
            'fatherlastName' => fake()->lastName(),
            'isActive' => 1,
        ];
    }
}
