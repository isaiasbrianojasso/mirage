<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BusinessSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\BusinessSetting::firstOrCreate(
            ['id' => 1],
            [
                'name' => 'Mirage',
                'logo_path' => '/tienda/img/mirage-logo-1534899548.jpg',
            ]
        );
    }
}
