<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IpAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ip_addresses')->insert([
            ['ip_address' => '192.168.1.1' ],
            ['ip_address' => '192.168.1.2' ],
            ['ip_address' => '192.168.1.3' ],
        ]);
    }
}
