<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PackageHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('package_histories')->insert([
            [
                'user_id' => 1,
                'package_id' => 1,
                'start_date' => Carbon::parse('2023-01-01'),
                'end_date' => Carbon::parse('2023-06-01')
            ],
            [
                'user_id' => 1,
                'package_id' => 2,
                'start_date' => Carbon::parse('2023-06-02'),
                'end_date' => Carbon::parse('2023-12-31')
            ],
            [
                'user_id' => 1,
                'package_id' => 3,
                'start_date' => Carbon::parse('2024-01-01'),
                'end_date' => null // Ongoing package
            ]
        ]);
    }
}
