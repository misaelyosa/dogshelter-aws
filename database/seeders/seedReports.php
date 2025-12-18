<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class seedReports extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $shelters = DB::table('shelters')->get();

        foreach ($shelters as $shelter) {
            // $count = rand(2, 3);

            for ($i = 0; $i < 2; $i++) {
                // small random offset so reports are near the shelter
                $lat = $shelter->latitude !== null ? $shelter->latitude + $faker->randomFloat(6, -0.01, 0.01) : null;
                $lng = $shelter->longitude !== null ? $shelter->longitude + $faker->randomFloat(6, -0.01, 0.01) : null;

                DB::table('reports')->insert([
                    'reporter_name' => $faker->name,
                    'latitude' => $lat,
                    'longitude' => $lng,
                    'time_found' => $faker->dateTimeBetween('-1 month', 'now')->format('Y-m-d H:i:s'),
                    'location' => $shelter->location ?? $faker->address,
                    'description' => $faker->sentence,
                    'doge_pic' => 'https://dogshelter-images-s3.s3.us-east-1.amazonaws.com/reports/no-image.png',
                    'status' => 'pending',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
