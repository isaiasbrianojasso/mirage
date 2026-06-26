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
        \App\Models\BusinessSetting::updateOrCreate(
            ['id' => 1],
            [
                'name' => 'Mirage',
                'logo_path' => '/tienda_assets/img/mirage-logo-1534899548.jpg',
            ]
        );
    }
}
