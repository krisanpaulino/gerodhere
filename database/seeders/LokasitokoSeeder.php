<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LokasitokoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('lokasitoko')->insert([
            'lokasitoko_id' => 36962,
            'label' => 'GERODHERE, BOAWAE, NAGEKEO, NUSA TENGGARA TIMUR (NTT), 86462',
            'province_name' => 'NUSA TENGGARA TIMUR (NTT)',
            'city_name' => 'NAGEKEO',
            'district_name' => 'BOAWAE',
            'subdistrict_name' => 'GERODHERE',
            'zip_code' => '86462'
        ]);
    }
}
