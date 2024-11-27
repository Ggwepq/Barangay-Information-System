<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class LocationController extends Controller
{
    private $locations;

    public function __construct()
    {
        $path = storage_path('json\locations.json');
        if (File::exists($path)) {
            $this->locations = json_decode(File::get($path), true);
        } else {
            $this->locations = [];
        }
    }

    public function getProvinces()
    {
        $provinces = [];

        foreach ($this->locations as $region) {
            $provinces = array_merge($provinces, array_keys($region['province_list']));
        }

        return response()->json($provinces);
    }

    public function getCities(Request $request)
    {
        $provinceName = $request->input('province');

        foreach ($this->locations as $region) {
            if (isset($region['province_list'][$provinceName])) {
                $municipalities = $region['province_list'][$provinceName]['municipality_list'] ?? [];
                return response()->json(array_keys($municipalities));
            }
        }

        return response()->json([]);
    }

    public function getBarangays(Request $request)
    {
        $provinceName = $request->input('province');
        $cityName = $request->input('city');

        foreach ($this->locations as $region) {
            if (isset($region['province_list'][$provinceName])) {
                $barangays = $region['province_list'][$provinceName]['municipality_list'][$cityName]['barangay_list'] ?? [];
                return response()->json($barangays);
            }
        }

        return response()->json([]);
    }
}
