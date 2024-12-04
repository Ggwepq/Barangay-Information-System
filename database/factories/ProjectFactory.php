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

        if ($status == 1) {  // Planned
            $startDate = null;
            $endDate = Carbon::now()->addYears(fake()->numberBetween(1, 5));
        } elseif ($status == 2) {  // Ongoing
            $startDate = fake()->dateTimeBetween('-1 year', 'now');
            $endDate = Carbon::now()->addYears(fake()->numberBetween(1, 3));
        } else {  // Done
            $startDate = fake()->dateTimeBetween('-5 years', '-1 year');
            $endDate = fake()->dateTimeBetween($startDate, 'now');
        }

        return [
            'projectName' => fake()->words(3, true),
            'projectDev' => $resident->id,
            'description' => fake()->text(150),
            'officerCharge' => Officer::all()->random()->id,
            'dateStarted' => $startDate,
            'dateEnded' => $endDate,
            'status' => $status,
            'isActive' => 1,
        ];
    }
}
