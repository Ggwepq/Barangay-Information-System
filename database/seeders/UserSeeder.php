<?php

// phpcs:IgnoreFile

namespace Database\Seeders;

use App\Models\Resident;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'officerId' => '1',
            'email' => 'admin@gmail.com',
            'userRole' => '1',
            'password' => bcrypt('admin'),
            'isActive' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('users')->insert([
            'officerId' => '2',
            'email' => 'manegkad@gmail.com',
            'userRole' => '1',
            'password' => bcrypt('juan'),
            'isActive' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Resident Role
        DB::table('users')->insert([
            'residentId' => Resident::where('lastName', 'Abaloyan')->first()->id,
            'email' => 'juan@gmail.com',
            'userRole' => '3',
            'password' => bcrypt('juan'),
            'isActive' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
