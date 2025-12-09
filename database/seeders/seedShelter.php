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

        $cityList = [
            'Jakarta', 'Bandung', 'Surabaya', 'Yogyakarta', 
            'Malang', 'Denpasar', 'Semarang', 'Medan',
            'Makassar', 'Palembang', 'Batam', 'Bogor'
        ];

        for ($i = 0; $i < 8; $i++) {
            DB::table('shelters')->insert([
                'name' => 'Shelter ' . $faker->company,
                'owner' => $faker->name,
                'contact' => $faker->phoneNumber,
                'location' => $faker->randomElement($cityList) . ', Indonesia',

                'capacity' => $faker->numberBetween(20, 70),
                'current_occupancy' => $faker->numberBetween(5, 30),

                'is_verified' => $faker->boolean(70),

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
