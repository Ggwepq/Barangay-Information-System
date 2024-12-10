<?php

namespace Database\Factories;

use App\Models\Resident;
use App\Models\ResidentParent;
use App\Models\Setting;
use App\Models\Voter;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;

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
        $religion = fake()->randomElement(['Catholic', 'Islam', 'Iglesia ni Cristo', 'Iglesia ni Quiboloy', 'Aglipay', 'Seventh Day Adventist', "Jehovah's Witness"]);
        $randomBool = fake()->boolean(50);
        $maleFyp = ['1', '4', '5'];
        $femaleFyp = ['2', '3'];

        $image = $gender == 'Male' ? fake()->randomElement($maleFyp) : fake()->randomElement($femaleFyp);

        $is = $randomBool ? 1 : 0;
        $occupation = $randomBool ? fake()->jobTitle() : null;
        return [
            'firstName' => fake()->firstName($gender),
            'middleName' => fake()->lastName(),
            'lastName' => fake()->lastName(),
            'province' => Setting::first()->province,
            'house_no' => fake()->buildingNumber(),
            'street' => fake()->streetName(),
            'brgy' => Setting::first()->barangay_name,  // Barangay
            'city' => Setting::first()->city,
            'citizenship' => 'Filipino',
            'religion' => $religion,
            'dateCitizen' => fake()->date(),
            'occupation' => $occupation,
            'gender' => $gender == 'Male' ? 1 : 2,
            'birthdate' => fake()->date(),
            'birthPlace' => fake()->city(),
            'age' => fake()->numberBetween(1, 99),
            'civilStatus' => fake()->randomElement(['Single', 'Married', 'Widow/er', 'Legally Separated']),
            'contactNumber' => '09916759759',
            'image' => 'img/uploads/avatar' . $image . '.png',
            'isPWD' => $is,
            'is4Ps' => $is,
            'isDerogatory' => 1,
            'isRegistered' => 1,
            'isActive' => 1,
            'created_at' => fake()->dateTimeThisYear(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Resident $resident) {
            $email = $resident->firstName . $resident->lastName . fake()->numberBetween(1, 99) . '@gmail.com';
            User::create([
                'residentId' => $resident->id,
                'email' => strtolower($email),  // Unique email for the user
                'password' => Hash::make('resident'),  // Default password
                'userRole' => 3,  // Assuming userRole 3 is for residents
                'isActive' => 1,
            ]);

            ResidentParent::create([
                'residentId' => $resident->id,
                'motherFirstName' => fake()->firstNameFemale(),
                'motherMiddleName' => $resident->middleName,
                'motherLastName' => $resident->lastName,
                'fatherFirstName' => fake()->firstNameMale(),
                'fatherMiddleName' => $resident->middleName,
                'fatherLastName' => $resident->lastName,
                'isActive' => 1,
            ]);

            $randomBool = fake()->boolean(50);

            if ($randomBool) {
                $voterFormat = '####-####a-a###aaa#####-#';
                $voterId = fake()->bothify($voterFormat);

                $precint = (string) fake()->randomNumber(4) . fake()->randomLetter();

                Voter::create([
                    'residentId' => $resident->id,
                    'voterId' => $voterId,
                    'precintNo' => $precint,
                ]);
            }
        });
    }
}
