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
        $resident = Resident::all()->random();
        // $projectDev = $resident->firstName . ' ' . $resident->middleName . ' ' . $resident->lastName;

        return [
            'projectName' => fake()->words(3, true),
            'projectDev' => $resident->id,
            'description' => fake()->text(150),
            'officerCharge' => Officer::all()->random()->id,
            'dateStarted' => fake()->date(),
            'dateEnded' => fake()->optional()->date(),  // Optional end date
            'status' => fake()->numberBetween(1, 4),  // Example statuses
            'isActive' => 1,
        ];
    }
}
