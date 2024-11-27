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
            'id' => '1',
            'firstName' => 'The Admin',
            'middleName' => 'admin',
            'lastName' => 'Administrator',
            'house_no' => '123',
            'street' => 'Admin St.',
            'brgy' => '120',
            'city' => 'Manila',
            'citizenship' => 'Filipino',
            'religion' => 'Catholic',
            'image' => 'img/sadface.png',
            'gender' => 1,
            'birthdate' => '1997-09-09',
            'birthPlace' => 'Brunei',
            'civilStatus' => 'Single',
            'isActive' => 1,
            'contactNumber' => '09058883169',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('residents')->insert([
            'id' => '2',
            'firstName' => 'Juan',
            'middleName' => '',
            'lastName' => 'Dela Cruz',
            'house_no' => '123',
            'street' => 'Heroes St.',
            'brgy' => '79',
            'city' => 'Caloocan',
            'citizenship' => 'Filipino',
            'religion' => 'Catholic',
            'image' => 'img/steve.jpg',
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
            'id' => '1',
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
            'id' => '2',
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
