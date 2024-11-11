<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('customers')->insert([
            [
                'user_id' => 3,
                'phone' => '555-555-5555',
                'address' => '123 Main St',
                'floor' => '2nd Floor',
            ],
            [
                'user_id' => 4,
                'phone' => '555-555-4555',
                'address' => '234 Main St',
                'floor' => '3rd Floor',
            ],
        ]);
    }
}
