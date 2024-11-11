<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bills')->insert([
            [
                'user_id' => 3,
                'ip_address_id' => 1,
                'package_id' => 1,
                'billing_month' => '2024-01',
                'package_name' => "Basic",
                'amount' => 20.00,
                'speed' => 10,
                'status' => 'Paid',
                'paid_on' => '2024-01-01'
            ],
            [
                'user_id' => 4,
                'ip_address_id' => 2,
                'package_id' => 1,
                'billing_month' => '2024-01',
                'package_name' => "Basic",
                'amount' => 20.00,
                'speed' => 10,
                'status' => 'Unpaid',
                'paid_on' => null
            ]
        ]);
    }
}
