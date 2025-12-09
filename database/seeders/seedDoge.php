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
        $vaccinStatus = ['vaccinated', 'not yet'];

        // dd(DB::table('shelters')->pluck('id')->toArray());
        $shelterIds = DB::table('shelters')->pluck('id')->toArray();
        $rand = [1,2,3,4,5,6,7,8];
        // dd($shelterIds);

        for ($i = 0; $i < 15; $i++) {
            DB::table('doge')->insert([
                'nama' => $faker->firstName,
                'dob' => $faker->dateTimeBetween('-5 years', '-6 months')->format('Y-m-d'),
                'trait' => $faker->randomElement($traits),
                'jenis_kelamin' => $faker->randomElement($genders),
                'keterangan' => $faker->paragraph,
                'vaccin_status' => $faker->randomElement($vaccinStatus),
                'img_route' => null,

                'user_id' => null,
                'shelter_id' => $rand[array_rand($rand)],

                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
