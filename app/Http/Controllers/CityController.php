<?php

namespace App\Http\Controllers;

use App\Models\City;

use Illuminate\Http\Request;
use Spatie\LaravelIgnition\Solutions\SolutionProviders\LazyLoadingViolationSolutionProvider;

class CityController extends Controller
{
    public function cities()
    {
        $cities = City::whereNotNull('city')->pluck('city');
        return view("cities", compact("cities"));
    }

    public function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        // Radius of the Earth in kilometers
        $radius = 6371;

        // Convert latitude and longitude from degrees to radians
        $lat1 = deg2rad($lat1);
        $lon1 = deg2rad($lon1);
        $lat2 = deg2rad($lat2);
        $lon2 = deg2rad($lon2);

        // Calculate differences
        $latDiff = $lat2 - $lat1;
        $lonDiff = $lon2 - $lon1;

        // Haversine formula
        $a = sin($latDiff / 2) * sin($latDiff / 2) +
            cos($lat1) * cos($lat2) * sin($lonDiff / 2) * sin($lonDiff / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        // Distance in kilometers
        $distance = $radius * $c;

        return $distance;
    }

    public function getClosestCities($referenceCity, $limit = 5)
    {
        // Retrieve all cities from the database
        $allCities = City::all();

        // Calculate distances and store them in an array
        $distances = [];
        foreach ($allCities as $city) {
            $distance = $this->calculateDistance(
                $referenceCity['latitude'],
                $referenceCity['longitude'],
                $city['latitude'],
                $city['longitude']
            );

            $distances[$city['locId']] = $distance;
        }

        // Sort the distances array in ascending order
        asort($distances);

        // Extract the first $limit cities from the sorted array
        $closestCities = array_slice($distances, 1, $limit, true);

        // Retrieve the actual City models for the closest cities
        $closestCityModels = City::whereIn('locId', array_keys($closestCities))->get();

        return $closestCityModels;
    }

    public function city($cityParam)
    {
        $city = City::where('city', $cityParam)->first();
        $referenceCity = ['latitude' => $city['latitude'], 'longitude' => $city['longitude']]; // Fix typo here
        $closestCities = $this->getClosestCities($referenceCity);
        return view("city", compact("city", "closestCities"));
    }
}
