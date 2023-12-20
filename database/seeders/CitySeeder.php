<?php
// database/seeders/CitySeeder.php

namespace Database\Seeders;
use Illuminate\Http\Request;
use Illuminate\Database\Seeder;
use App\Models\City;
//use League\Csv\Reader;

class CitySeeder extends Seeder
{
    public function run(Request $request)
    {
        set_time_limit(300);
        if (City::count() > 0) {
            $this->command->info('Cities collection is already seeded.');
            return;
        }
        $filePath = __DIR__ . '\GeoLiteCityLocation.csv';
        $file = fopen($filePath, 'r');

        while (($line = fgets($file)) !== false) {
            $record = str_getcsv($line);
            $record = array_map(function ($value) {
                return mb_convert_encoding($value, 'UTF-8', 'ISO-8859-1');
            }, $record);
        
            $locId = $record[0] ?? null;
            $country = !empty($record[1]) ? $record[1] : null;
            $region = !empty($record[2]) ? $record[2] : null;
            $city = !empty($record[3]) ? $record[3] : null;
            $postalCode = !empty($record[4]) ? $record[4] : null;
            $latitude = !empty($record[5]) ? $record[5] : null;
            $longitude = !empty($record[6]) ? $record[6] : null;
            $metroCode = !empty($record[7]) ? $record[7] : null;
            $areaCode = !empty($record[8]) ? $record[8] : null;

            City::create([
                'locId' => $locId,
                'country' => $country,
                'region' => $region,
                'city' => $city,
                'postalCode' => $postalCode,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'metroCode' => $metroCode,
                'areaCode' => $areaCode,
            ]);
        }
        
        fclose($file);
    }
}
