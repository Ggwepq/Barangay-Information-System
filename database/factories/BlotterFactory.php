<?php

namespace Database\Factories;

use App\Models\Officer;
use App\Models\Resident;
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
        $officer = Officer::all()->random();
        // $randomOfficer = $officer->resident->firstName . ' ' . $officer->resident->middleName . ' ' . $officer->resident->lastName;

        return [
            'complainant' => Resident::all()->random()->id,
            'complainedResident' => Resident::all()->random()->id,
            'officerCharge' => $officer->id,
            'description' => fake()->paragraph(),
            'status' => fake()->randomElement([1, 2, 3]),
            'isActive' => 1,
        ];
    }
}
