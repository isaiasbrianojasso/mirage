<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // ---- Categorías principales (sin parent) ----
        $mainCategories = [
            [
                'name'        => 'Refacciones',
                'slug'        => '10-refacciones',
                'description' => 'Refacciones y repuestos originales Mirage para equipos de climatización y electrodomésticos. Compresor, capacitores, motores, válvulas y más.',
                'image_url'   => 'https://www.tiendamirage.mx/img/category/refacciones.jpg',
            ],
            [
                'name'        => 'Aire Acondicionado',
                'slug'        => '11-aire-acondicionado',
                'description' => 'Equipos de aire acondicionado Mirage para tu hogar o negocio. Minisplits, portátiles y sistemas de climatización de alta eficiencia energética.',
                'image_url'   => 'https://www.tiendamirage.mx/img/category/aire-acondicionado.jpg',
            ],
            [
                'name'        => 'Minisplits Inverter',
                'slug'        => 'minisplits-inverter',
                'description' => 'Equipos de aire acondicionado con tecnología Inverter de última generación. Ahorra hasta un 60% de energía y mantén el confort durante todo el año.',
                'image_url'   => 'https://www.tiendamirage.mx/img/category/minisplits-inverter.jpg',
            ],
            [
                'name'        => 'Línea Blanca',
                'slug'        => '13-linea-blanca',
                'description' => 'Electrodomésticos de línea blanca Mirage para el hogar. Boilers, lavadoras, microondas, campanas, parrillas y dispensadores de alta calidad.',
                'image_url'   => 'https://www.tiendamirage.mx/img/category/linea-blanca.jpg',
            ],
            [
                'name'        => 'Herramientas',
                'slug'        => '17-herramientas',
                'description' => 'Herramientas profesionales y para el hogar Mirage. Taladros, lijadoras, compresoras, sopladores y accesorios para cada trabajo.',
                'image_url'   => 'https://www.tiendamirage.mx/img/category/herramientas.jpg',
            ],
            [
                'name'        => 'Souvenirs',
                'slug'        => '14-souvenirs',
                'description' => 'Artículos de regalo y colección Mirage. Tazas, playeras, accesorios de oficina y artículos promocionales con la identidad de la marca.',
                'image_url'   => 'https://www.tiendamirage.mx/img/category/souvenirs.jpg',
            ],
            [
                'name'        => 'Outlet',
                'slug'        => '24-outlet',
                'description' => 'Productos en oferta, liquidación y precio especial. Equipos de exhibición, temporada pasada y unidades con empaque dañado a precios irrepetibles.',
                'image_url'   => 'https://www.tiendamirage.mx/img/category/outlet.jpg',
            ],
        ];

        foreach ($mainCategories as $data) {
            Category::firstOrCreate(
                ['slug' => $data['slug']],
                array_merge($data, ['is_active' => true, 'parent_id' => null])
            );
        }

        // ---- Subcategorías de Línea Blanca ----
        $lineaBlanca = Category::where('slug', '13-linea-blanca')->first();

        if ($lineaBlanca) {
            $subCategories = [
                [
                    'name'        => 'Boiler',
                    'slug'        => '18-boiler',
                    'description' => 'Calentadores de agua y boilers Mirage para uso doméstico e industrial. Disponibles en paso, depósito y solar, en diferentes capacidades.',
                    'image_url'   => 'https://www.tiendamirage.mx/img/category/boiler.jpg',
                ],
                [
                    'name'        => 'Campanas',
                    'slug'        => '19-campanas',
                    'description' => 'Campanas extractoras para cocina Mirage. Diseños modernos con filtros de aluminio lavables, iluminación LED y control de velocidad múltiple.',
                    'image_url'   => 'https://www.tiendamirage.mx/img/category/campanas.jpg',
                ],
                [
                    'name'        => 'Dispensadores',
                    'slug'        => '21-dispensadores',
                    'description' => 'Dispensadores de agua Mirage fríos, calientes y de temperatura ambiente. Diseño compacto y elegante para hogar y oficina.',
                    'image_url'   => 'https://www.tiendamirage.mx/img/category/dispensadores.jpg',
                ],
                [
                    'name'        => 'Parrillas',
                    'slug'        => '22-parillas',
                    'description' => 'Parrillas y estufas de gas y eléctricas Mirage. Quemadores de alto rendimiento, encendido automático y superficies de fácil limpieza.',
                    'image_url'   => 'https://www.tiendamirage.mx/img/category/parrillas.jpg',
                ],
                [
                    'name'        => 'Microondas',
                    'slug'        => '25-microondas',
                    'description' => 'Microondas y hornos Mirage con tecnología de cocción uniforme. Múltiples modos, potencias ajustables y capacidades de 0.7 a 1.6 pies cúbicos.',
                    'image_url'   => 'https://www.tiendamirage.mx/img/category/microondas.jpg',
                ],
                [
                    'name'        => 'Lavadoras',
                    'slug'        => '26-lavadoras',
                    'description' => 'Lavadoras de carga superior y frontal Mirage. Programas inteligentes, ciclos de lavado múltiples y alta eficiencia en el consumo de agua.',
                    'image_url'   => 'https://www.tiendamirage.mx/img/category/lavadoras.jpg',
                ],
            ];

            foreach ($subCategories as $data) {
                Category::firstOrCreate(
                    ['slug' => $data['slug']],
                    array_merge($data, ['is_active' => true, 'parent_id' => $lineaBlanca->id])
                );
                // Also update existing ones to have correct parent_id
                Category::where('slug', $data['slug'])->update(['parent_id' => $lineaBlanca->id]);
            }
        }
    }
}
