<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class seedUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
        [
            'name' => 'admin1',
            'email' => 'admin1@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ], [
            'name' => 'Budi',
            'email' => 'budi@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]]);

        // Create a shelter owner and link them to an existing shelter (first shelter)
        $shelterOwnerId = DB::table('users')->insertGetId([
            'name' => 'ShelterOwner1',
            'email' => 'owner1@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'shelter_owner',
        ]);

        $firstShelterId = DB::table('shelters')->value('id');
        if ($firstShelterId) {
            DB::table('shelters')->where('id', $firstShelterId)->update([
                'user_id' => $shelterOwnerId,
                'owner' => 'ShelterOwner1'
            ]);
        }
    }
}
