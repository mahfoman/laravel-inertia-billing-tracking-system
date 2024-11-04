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
                'name' => 'Admin User',
                'role_id' => 1,
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Employee User',
                'role_id' => 2,
                'email' => 'employee@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'John Doe',
                'role_id' => 3,
                'email' => 'john@example.com',
                'password' => ''
            ],
            [
                'name' => 'Jane Smith',
                'role_id' => 3,
                'email' => 'jane@example.com',
                'password' => ''
            ]
        ]);
    }
}
