<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function getRegions()
    {
        $path = public_path('json/regions.json');
        $json = file_get_contents($path);
        $data = json_decode($json, true);

        return response()->json($data['features']);
    }


    public function getDistricts($region)
{
    $path = public_path('json/districts.json');
    $json = file_get_contents($path);
    $data = json_decode($json, true);

    // Debugging: Log received region and data
    error_log('Region: ' . $region);
    error_log('Data:');
    error_log(print_r($data, true));

    $districts = array_filter($data['features'], function ($item) use ($region) {
        return $item['properties']['region'] == $region;
    });

    // Debugging: Log filtered districts
    error_log('Filtered Districts:');
    error_log(print_r($districts, true));

    return response()->json(array_values($districts));
}



    public function getWards($district)
    {
        $path = public_path('json/wards.json');
        $json = file_get_contents($path);
        $data = json_decode($json, true);

        $wards = array_filter($data['features'], function ($item) use ($district) {
            return $item['properties']['District'] == $district;
        });

        return response()->json($wards);
    }
}
