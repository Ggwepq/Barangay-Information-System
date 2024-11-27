<?php

namespace Database\Seeders;

use App\Models\Blotter;
use App\Models\Officer;
use App\Models\Position;
use App\Models\Project;
use App\Models\Resident;
use App\Models\ResidentParent;
use App\Models\Schedule;
use App\Models\User;
use App\Models\Voter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarangaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Position::factory(2)->create();
        Resident::factory(100)->create();  // Then create residents
        Officer::factory(5)->create();  // Then officers who depend on residents

        User::factory(2)->create();  // Create some users
        ResidentParent::factory(100)->create();
        Project::factory(30)->create();
        Voter::factory(50)->create();  // Adjust count as needed
        Schedule::factory(10)->create();  // Adjust count as needed
        Blotter::factory(20)->create();
    }
}
