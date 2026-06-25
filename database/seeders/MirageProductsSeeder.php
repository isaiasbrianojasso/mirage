<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class MirageProductsSeeder extends Seeder
{
    public function run(): void
    {
        $catInverter = Category::firstOrCreate([
            'slug' => 'minisplits-inverter'
        ], [
            'name' => 'Minisplits Inverter',
            'description' => 'Equipos de aire acondicionado con tecnología Inverter.',
            'is_active' => true,
        ]);

        $products = [
            [
                'name' => 'Inverter X 2 Ton Frío - Calor 220',
                'slug' => 'inverter-x-2-ton-frio-calor-220',
                'price' => 12999.00,
                'discount_price' => null,
                'image' => 'https://www.tiendamirage.mx/10214-home_default/inverter-x-2-ton-frio-calor-220.jpg'
            ],
            [
                'name' => 'Inverter X 1 Ton Frio - Calor 220',
                'slug' => 'inverter-x-1-ton-frio-calor-220',
                'price' => 8599.00,
                'discount_price' => null,
                'image' => 'https://www.tiendamirage.mx/10212-home_default/inverter-x-1-ton-frio-calor-220.jpg'
            ],
            [
                'name' => 'Inverter X 1 Ton Frio - Calor 110',
                'slug' => 'inverter-x-1-ton-frio-calor-110',
                'price' => 8599.00,
                'discount_price' => null,
                'image' => 'https://www.tiendamirage.mx/10202-home_default/inverter-x-1-ton-frio-calor-110.jpg'
            ],
            [
                'name' => 'Inverter 2 Toneladas solo Frio 220v',
                'slug' => 'inverter-2-ton-frio-220',
                'price' => 11999.00,
                'discount_price' => null,
                'image' => 'https://www.tiendamirage.mx/10204-home_default/inverter-2-ton-frio-220.jpg'
            ],
            [
                'name' => 'Inverter 1 Tonelada solo Frio 220v',
                'slug' => 'inverter-1-ton-frio-220',
                'price' => 7499.00,
                'discount_price' => null,
                'image' => 'https://www.tiendamirage.mx/10192-home_default/inverter-1-ton-frio-220.jpg'
            ]
        ];

        foreach ($products as $data) {
            $image = $data['image'];
            unset($data['image']);
            
            $data['category_id'] = $catInverter->id;
            $data['stock'] = 10;
            $data['is_active'] = true;
            
            $product = Product::firstOrCreate(['slug' => $data['slug']], $data);
            
            if ($product->images()->count() == 0) {
                $product->images()->create([
                    'image_url' => $image,
                    'is_primary' => true
                ]);
            }
        }
    }
}
