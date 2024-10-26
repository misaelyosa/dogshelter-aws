<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class seedDoge extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $traits = ['friendly', 'big eater', 'love to play', 'calm'];
        $genders = ['male', 'female'];

        for ($i = 0; $i < 10; $i++) {
            DB::table('doge')->insert([
                'nama' => $faker->firstName,
                'dob' => $faker->dateTimeBetween('2019-01-01', '2023-12-31')->format('Y-m-d'),
                'trait' => $faker->randomElement($traits),
                'jenis_kelamin' => $faker->randomElement($genders),
                'keterangan' => null,
                'img_route' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
