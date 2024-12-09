<?php

namespace Database\Seeders;

use App\Models\Blotter;
use App\Models\Project;
use App\Models\Resident;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->insert([
            'logo' => 'img\uploads\settings\logo.png',
            'barangay_name' => 'BARANGAY 73',
            'city' => 'CALOOCAN CITY',
            'province' => 'NATIONAL CAPITAL REGION - THIRD DISTRICT',
            'zone' => '7',
            'district' => '2',
            'notification_method' => 'EMAIL',
        ]);
    }
}
