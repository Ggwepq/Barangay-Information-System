<?php

namespace Database\Factories;

use App\Models\Officer;
use App\Models\Resident;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'projectName' => fake()->words(3, true),
            'projectDev' => Resident::factory(),
            'description' => fake()->paragraph(),
            'officerCharge' => Officer::factory()->create()->id,
            'dateStarted' => fake()->date(),
            'dateEnded' => fake()->optional()->date(),  // Optional end date
            'status' => fake()->randomElement([1, 2, 3]),  // Example statuses
            'isActive' => 1,
        ];
    }
}
