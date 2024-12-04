<?php

namespace Database\Factories;

use App\Models\Officer;
use App\Models\Resident;
use Carbon\Carbon;
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
        $status = fake()->randomElement([1, 2, 3]);  // 1 Planned, 2 Ongoing, 3 Done

        $startDate = $status != 1 ? fake()->dateTimeBetween('-1') : null;
        $endDate = $status != 3 ? Carbon::now()->addYears($status) : fake()->dateTimeBetween('-5', '-1');

        return [
            'projectName' => fake()->words(3, true),
            'projectDev' => $resident->id,
            'description' => fake()->text(150),
            'officerCharge' => Officer::all()->random()->id,
            'dateStarted' => $startDate,
            'dateEnded' => $endDate,
            'status' => fake()->numberBetween(1, 4),
            'isActive' => 1,
        ];
    }
}
