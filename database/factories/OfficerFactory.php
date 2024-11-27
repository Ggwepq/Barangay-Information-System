<?php

namespace Database\Factories;

use App\Models\Position;
use App\Models\Resident;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Officer>
 */
class OfficerFactory extends Factory
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
            'positionId' => Position::factory(),
            'isActive' => 1,
        ];
    }
}
