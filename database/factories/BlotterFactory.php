<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blotter>
 */
class BlotterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $complainant = \App\Models\Resident::factory();
        $complainedResident = \App\Models\Resident::factory();

        return [
            'complainant' => $complainant,
            'complainedResident' => $complainedResident,
            'officerCharge' => fake()->name(),
            'description' => fake()->paragraph(),
            'status' => fake()->randomElement([1, 2, 3]),
            'isActive' => 1,
        ];
    }
}
