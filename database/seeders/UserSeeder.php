<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'user',
                'username' => 'user',
                'email' =>'user@gmail.com',
                'phone' => '01224352010',
                'role' => 'user',
                'password' => Hash::make('password')
            ],

            [
                'name' => 'admin',
                'username' => 'admin',
                'email' =>'admin@gmail.com',
                'phone' => '01224352010',
                'role' => 'admin',
                'password' => Hash::make('password')
            ],

            [
                'name' => 'vendor',
                'username' => 'vendor',
                'email' =>'vendor@gmail.com',
                'phone' => '01224352010',
                'role' => 'vendor',
                'password' => Hash::make('password')
            ],
        ]);
    }
}
