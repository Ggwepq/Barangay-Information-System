<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OfficerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('officers')->insert([
            'id' => '1',
            'residentid' => '1',
            'positionId' => '1',
            'isActive' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('officers')->insert([
            'id' => '2',
            'residentid' => '2',
            'positionId' => '2',
            'isActive' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('officers')->insert([
            'id' => '3',
            'residentid' => '3',
            'positionId' => '3',
            'isActive' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('officers')->insert([
            'id' => '4',
            'residentid' => '4',
            'positionId' => '3',
            'isActive' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('officers')->insert([
            'id' => '5',
            'residentid' => '5',
            'positionId' => '3',
            'isActive' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('officers')->insert([
            'id' => '6',
            'residentid' => '6',
            'positionId' => '3',
            'isActive' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('officers')->insert([
            'id' => '7',
            'residentid' => '7',
            'positionId' => '3',
            'isActive' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('officers')->insert([
            'id' => '8',
            'residentid' => '8',
            'positionId' => '3',
            'isActive' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('officers')->insert([
            'id' => '9',
            'residentid' => '9',
            'positionId' => '3',
            'isActive' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('officers')->insert([
            'id' => '10',
            'residentid' => '10',
            'positionId' => '4',
            'isActive' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
