<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Str;

class RealisticProductSeeder extends Seeder
{
    public function run()
    {
        // 1. Boiler Gas LP 1 Servicio
        $boiler1 = Product::create([
            'id' => '13400000-0000-0000-0000-000000000000', // Force legacy ID for the testing user is doing
            'category_id' => 8, // Boiler
            'name' => 'Boiler Gas LP 1 Servicio Mirage',
            'slug' => 'boiler-gas-lp-1-servicio',
            'sku' => 'B-GLP-1S',
            'price' => 1999.00,
            'stock' => 50,
            'short_description' => 'Boiler de paso ideal para 1 servicio, ahorro de gas garantizado.',
            'long_description' => 'Calentador de agua de paso tipo instantáneo a Gas LP. Ahorra hasta 70% de gas. Disfruta de agua caliente continua e ilimitada. Ideal para 1 servicio simultáneo.',
            'specifications' => ['Tipo de gas: LP', 'Servicios: 1', 'Encendido: Automático', 'Ahorro de gas: 70%'],
            'is_active' => true,
        ]);
        ProductImage::create(['product_id' => '13400000-0000-0000-0000-000000000000', 'image_url' => 'https://www.tiendamirage.mx/7751-home_default/boiler-gas-lp-1-servicio.jpg']);

        // 2. Boiler Gas LP 2 Servicios
        $boiler2 = Product::create([
            'id' => '13410000-0000-0000-0000-000000000000',
            'category_id' => 8,
            'name' => 'Boiler Gas LP 2 Servicios Mirage',
            'slug' => 'boiler-gas-lp-2-servicios',
            'sku' => 'B-GLP-2S',
            'price' => 2899.00,
            'stock' => 30,
            'short_description' => 'Boiler de paso ideal para 2 servicios, máximo rendimiento.',
            'long_description' => 'Calentador de agua de paso tipo instantáneo a Gas LP. Ahorra hasta 70% de gas. Disfruta de agua caliente continua e ilimitada. Ideal para 2 servicios simultáneos.',
            'specifications' => ['Tipo de gas: LP', 'Servicios: 2', 'Encendido: Automático', 'Ahorro de gas: 70%'],
            'is_active' => true,
        ]);
        ProductImage::create(['product_id' => '13410000-0000-0000-0000-000000000000', 'image_url' => 'https://www.tiendamirage.mx/7751-home_default/boiler-gas-lp-1-servicio.jpg']);

        // 3. Minisplit Inverter 1 Tonelada
        $minisplit1 = Product::create([
            'id' => '20010000-0000-0000-0000-000000000000',
            'category_id' => 3, // Minisplits Inverter
            'name' => 'Minisplit Magnum 22 Inverter 1 Tonelada',
            'slug' => 'minisplit-magnum-22-1-tonelada',
            'sku' => 'MS-M22-1T',
            'price' => 8999.00,
            'stock' => 20,
            'short_description' => 'Minisplit Inverter de alta eficiencia, 1 tonelada, frío/calor.',
            'long_description' => 'Ahorra energía con su tecnología Inverter. Operación ultra silenciosa y enfriamiento rápido.',
            'specifications' => ['Tecnología: Inverter', 'Capacidad: 1 Tonelada', 'Voltaje: 220V', 'Refrigerante: R410A'],
            'is_active' => true,
        ]);
        ProductImage::create(['product_id' => '20010000-0000-0000-0000-000000000000', 'image_url' => 'https://www.tiendamirage.mx/9822-home_default/mirage-magnum-22-1-ton-frio-calor-220v.jpg']);

        // 4. Minisplit Inverter 2 Toneladas
        $minisplit2 = Product::create([
            'id' => '20020000-0000-0000-0000-000000000000',
            'category_id' => 3,
            'name' => 'Minisplit Magnum 22 Inverter 2 Toneladas',
            'slug' => 'minisplit-magnum-22-2-toneladas',
            'sku' => 'MS-M22-2T',
            'price' => 14999.00,
            'stock' => 15,
            'short_description' => 'Minisplit Inverter de alta capacidad, 2 toneladas.',
            'long_description' => 'Ideal para espacios grandes. Ahorro y máximo confort garantizado.',
            'specifications' => ['Tecnología: Inverter', 'Capacidad: 2 Toneladas', 'Voltaje: 220V', 'Refrigerante: R410A'],
            'is_active' => true,
        ]);
        ProductImage::create(['product_id' => '20020000-0000-0000-0000-000000000000', 'image_url' => 'https://www.tiendamirage.mx/9826-home_default/mirage-magnum-22-2-ton-frio-calor-220v.jpg']);
    }
}
