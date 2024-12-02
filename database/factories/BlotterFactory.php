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
        $resident = Resident::all()->random();
        $res = $resident->update(['isDerogatory' => 0]);
        // $randomOfficer = $officer->resident->firstName . ' ' . $officer->resident->middleName . ' ' . $officer->resident->lastName;

        return [
            'complainant' => Resident::all()->random()->id,
            'complainedResident' => $resident->id,
            'officerCharge' => $officer->id,
            'description' => fake()->text(150),
            'status' => fake()->numberBetween(1, 4),
            'isActive' => 1,
        ];
    }
}
