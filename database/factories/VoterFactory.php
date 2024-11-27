<?php

namespace Database\Factories;

use App\Models\Voter;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Voter>
 */
class VoterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'residentId' => Voter::factory(),
            'voterId' => fake()->randomNumber(8, true),  // Example 8-digit voter ID
            'precintNo' => fake()->randomNumber(4, true),  // Example 4-digit precinct number
            'isActive' => 1,
        ];
    }
}
