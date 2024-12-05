<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResidentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('residents')->insert([
            'firstName' => 'Erica',
            'middleName' => 'Magaro',
            'lastName' => 'Salinas',
            'province' => 'NATIONAL CAPITAL REGION - THIRD DISTRICT',
            'house_no' => '123',
            'street' => 'Admin St.',
            'brgy' => 'BARANGAY 73',
            'city' => 'CALOOCAN CITY',
            'citizenship' => 'Filipino',
            'religion' => 'Catholic',
            'image' => 'img/uploads/sadface.png',
            'gender' => 1,
            'birthdate' => '1950-09-09',
            'birthPlace' => 'Brunei',
            'civilStatus' => 'Single',
            'isActive' => 1,
            'contactNumber' => '09058883169',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('residents')->insert([
            'firstName' => 'Christian Gabriel',
            'middleName' => '',
            'lastName' => 'Manegkad',
            'province' => 'NATIONAL CAPITAL REGION - THIRD DISTRICT',
            'house_no' => '123',
            'street' => 'Heroes St.',
            'brgy' => 'BARANGAY 73',
            'city' => 'CALOOCAN CITY',
            'citizenship' => 'Filipino',
            'religion' => 'Catholic',
            'image' => 'img/uploads/steve.jpg',
            'gender' => 1,
            'birthdate' => '1990-09-09',
            'birthPlace' => 'Manila',
            'civilStatus' => 'Single',
            'isActive' => 1,
            'contactNumber' => '09058883169',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('parents')->insert([
            'residentId' => 1,
            'motherfirstName' => 'Ada',
            'motherlastName' => 'Administrator',
            'fatherfirstName' => 'Adel',
            'fatherlastName' => 'Administrator',
            'isActive' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('parents')->insert([
            'residentId' => 2,
            'motherfirstName' => 'Juana',
            'motherlastName' => 'Dela Cruz',
            'fatherfirstName' => 'Juan',
            'fatherlastName' => 'Dela Cruz',
            'isActive' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
