<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin1',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin1'),
            'role' => 'admin',
        ]);
        // User::create([
        //     'name' => 'ps1',
        //     'email' => 'ps@gmail.com',
        //     'password' => Hash::make('ps1'),
        //     'role' => 'ps',
        // ]);
    }
}
