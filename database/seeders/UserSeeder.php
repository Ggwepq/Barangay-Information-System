<?php

// phpcs:IgnoreFile

namespace Database\Seeders;

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
            'id' => '1',
            'officerId' => '1',
            'email' => 'admin@gmail.com',
            'userRole' => '1',
            'password' => bcrypt('admin'),
            'isActive' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('users')->insert([
            'id' => '2',
            'officerId' => '2',
            'email' => 'juan@gmail.com',
            'userRole' => '1',
            'password' => bcrypt('juan'),
            'isActive' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
