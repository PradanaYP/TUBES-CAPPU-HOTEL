<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123'),
            'email_verified_at' => now(),
            'role' => 'admin',
        ]);

        DB::table('users')->insert([
            'name' => 'yepe',
            'email' => 'yepe@gmail.com',
            'password' => Hash::make('123'),
            'email_verified_at' => now(),
            'role' => 'costumer',
        ]);
    }
}
