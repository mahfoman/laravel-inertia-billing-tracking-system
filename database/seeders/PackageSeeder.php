<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('packages')->insert([
            ['name' => 'Basic', 'price' => 500, 'speed' => '10 Mbps'],
            ['name' => 'Standard', 'price' => 600, 'speed' => '50 Mbps'],
            ['name' => 'Premium', 'price' => 1500, 'speed' => '100 Mbps'],
        ]);
    }
}
