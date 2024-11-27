<?php

namespace Database\Factories;

use App\Models\Officer;
use App\Models\Resident;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Schedule>
 */
class ScheduleFactory extends Factory
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
            'officerId' => Officer::factory(),
            'date' => fake()->date(),
            'start' => fake()->time(),
            'end' => fake()->time(),
            'isActive' => 1,
        ];
    }
}
