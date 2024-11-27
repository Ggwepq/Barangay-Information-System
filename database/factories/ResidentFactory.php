<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Resident>
 */
class ResidentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gender = fake()->randomElement(['Male', 'Female']);  // Simplified gender
        return [
            'firstName' => fake()->firstName($gender),
            'middleName' => fake()->lastName(),
            'lastName' => fake()->lastName(),
            'province' => fake()->state(),
            'house_no' => fake()->buildingNumber(),
            'street' => fake()->streetName(),
            'brgy' => fake()->citySuffix(),  // Barangay
            'city' => fake()->city(),
            'citizenship' => fake()->country(),
            'religion' => fake()->word(),
            'dateCitizen' => fake()->date(),
            'occupation' => fake()->jobTitle(),
            'gender' => $gender == 'Male' ? 1 : 0,  // 1 for Male, 0 for Female
            'birthdate' => fake()->date(),
            'birthPlace' => fake()->city(),
            'civilStatus' => fake()->randomElement(['Single', 'Married', 'Widow/er', 'Legally Separated']),
            'contactNumber' => fake()->phoneNumber(),
            'image' => 'img/steve.jpg',  // Or use a placeholder image URL
            'isDerogatory' => 1,
            'isRegistered' => 1,
            'isActive' => 1,
        ];
    }
}
