<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('companies')->insert([
            [
                'name' => 'Company A',
                'email' => 'gMh0w@example.com',
                'phone' => '555-555-1234',
                'website' => 'https://companya.com',
                'logo' => null,
            ],
            [
                'name' => 'Company B',
                'email' => 'pCnZI@example.com',
                'phone' => '555-555-5678',
                'website' => 'https://companyb.com',
                'logo' => null,
            ],
        ]);
    }
}
