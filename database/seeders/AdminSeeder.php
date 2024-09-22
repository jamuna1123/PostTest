<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
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
            'password' => Hash::make('12345678'), // Hashing the password
             'created_at' => Carbon::now(), // Set current timestamp for created_at
            'created_by' => 1, // Assuming '1' is the ID of the user who created this record
        ]);
    }
}
