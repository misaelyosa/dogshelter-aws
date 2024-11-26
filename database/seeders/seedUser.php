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
    }
}
