<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Banner;

class BannerSeeder extends Seeder
{
    public function run(): void
    {
        $banners = [
            [
                'title' => 'VERANO CONFORT',
                'image_url' => 'https://www.tiendamirage.mx/img/cms/Minisplit_VERANO EN CONFORT_BANNER.jpg',
                'link_url' => '/tienda/minisplits-inverter',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'CESAM',
                'image_url' => 'https://www.tiendamirage.mx/img/cms/Slide cesam.jpg',
                'link_url' => '#',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'VERANO CONFORT LB',
                'image_url' => 'https://www.tiendamirage.mx/img/cms/L&iacute;nea blanca_VERANO EN CONFORT_BANNER.jpg',
                'link_url' => '/tienda/linea-blanca',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'PayPal 18msi',
                'image_url' => 'https://www.tiendamirage.mx/img/cms/PayPal_Banner 18 meses.jpg',
                'link_url' => '#',
                'order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($banners as $banner) {
            Banner::create($banner);
        }
    }
}
