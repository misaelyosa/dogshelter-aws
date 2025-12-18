<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class seedShelter extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Indonesian cities with coordinates
        $cities = [
            ['city' => 'Jakarta', 'lat' => -6.2088, 'lng' => 106.8456],
            ['city' => 'Bandung', 'lat' => -6.9175, 'lng' => 107.6191],
            ['city' => 'Surabaya', 'lat' => -7.2575, 'lng' => 112.7521],
            ['city' => 'Yogyakarta', 'lat' => -7.7956, 'lng' => 110.3695],
            ['city' => 'Malang', 'lat' => -7.9666, 'lng' => 112.6326],
            ['city' => 'Denpasar', 'lat' => -8.6705, 'lng' => 115.2126],
            ['city' => 'Semarang', 'lat' => -6.9667, 'lng' => 110.4167],
            // ['city' => 'Medan', 'lat' => 3.5952, 'lng' => 98.6722],
            // ['city' => 'Makassar', 'lat' => -5.1477, 'lng' => 119.4327],
            // ['city' => 'Palembang', 'lat' => -2.9909, 'lng' => 104.7566],
            // ['city' => 'Batam', 'lat' => 1.0456, 'lng' => 104.0305],
            // ['city' => 'Bogor', 'lat' => -6.5950, 'lng' => 106.8166],
        ];

        foreach ($cities as $c) {

            // Add slight random offset so shelters are not stacked on the exact same point
            $lat = $c['lat'] + $faker->randomFloat(4, -0.02, 0.02);
            $lng = $c['lng'] + $faker->randomFloat(4, -0.02, 0.02);

            DB::table('shelters')->insert([
                'name' => 'Shelter ' . $faker->company,
                'owner' => $faker->name,
                'contact' => $faker->phoneNumber,
                'location' => $c['city'] . ', Indonesia',

                'latitude' => $lat,
                'longitude' => $lng,

                'capacity' => $faker->numberBetween(20, 70),
                'current_occupancy' => $faker->numberBetween(5, 30),

                'is_verified' => 1,

                'description' => $faker->sentence,
                'website' => $faker->optional()->url,
                'email' => $faker->safeEmail,
                'image' => null,

                'user_id' => null,

                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
