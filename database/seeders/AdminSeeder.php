<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            'name' => 'Jamuna',
            'email' => 'jamunagrg98@gmail.com',
            'password' => bcrypt('jamuna12'),

        ]);
    }
}
