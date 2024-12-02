<?php

namespace Database\Seeders;

use App\Models\Blotter;
use App\Models\Resident;
use Illuminate\Database\Seeder;

class BarangaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Resident::factory(500)->create();
        Blotter::factory(10)->create();
    }
}
