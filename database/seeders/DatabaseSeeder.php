<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Blotter;
use App\Models\DocumentRequest;
use App\Models\Project;
use App\Models\Resident;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(ResidentSeeder::class);
        Resident::factory(500)->create();
        $this->call(PositionSeeder::class);
        $this->call(OfficerSeeder::class);
        $this->call(UserSeeder::class);
        Blotter::factory(100)->create();
        Project::factory(25)->create();
        DocumentRequest::factory(50)->create();
        $this->call(BarangaySeeder::class);
    }
}
