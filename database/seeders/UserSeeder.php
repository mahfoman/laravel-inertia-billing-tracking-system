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
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'ip_address' => '192.168.1.1'
            ],
            [
                'name' => 'Employee User',
                'email' => 'employee@example.com',
                'password' => Hash::make('password'),
                'ip_address' => '192.168.1.2'
            ]
        ]);

        DB::table('users')->insert([
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'phone' => '123-456-7890',
                'address' => "204 east kaful",
                'floor' => "2nd floor",
                'ip_address' => '192.168.1.3'
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'phone' => '987-654-3210',
                'address' => "413 east kaful",
                'floor' => "2nd floor",
                'ip_address' => '192.168.1.4'
            ]
        ]);
    }
}
