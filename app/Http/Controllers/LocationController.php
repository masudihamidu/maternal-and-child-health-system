<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class LocationController extends Controller
{
    public function getRegions()
    {
        $path = public_path('json/Regions.json');
        $data = json_decode(File::get($path), true);

        return response()->json($data['features']);
    }


    public function getDistricts($region)
{
    $path = public_path('json/Districts.json');
    $data = json_decode(File::get($path), true);
    $districts = [];

    foreach ($data['features'] as $districtObject) {
        if ($districtObject['properties']['region'] === $region) {
            $districts[] = $districtObject;
        }
    }

    return response()->json($districts);
}


    public function getWards($district)
    {
        $path = public_path('json/Wards.json');
        $data = json_decode(File::get($path), true);
        $wards = [];

        foreach ($data['features'] as $wardObject) {
            if (stripos($wardObject['properties']['District'], $district) !== false) {
                $wards[] = $wardObject;
            }
        }

        return response()->json($wards);
    }
}
