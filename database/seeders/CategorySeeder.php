<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $mainCategories = [
            [
                'uuid'        => 'c1a2b3c4-d5e6-7890-1234-56789abcdef0',
                'name'        => 'Refacciones',
                'slug'        => 'refacciones',
                'description' => 'Refacciones y repuestos originales Mirage para equipos de climatización y electrodomésticos. Compresor, capacitores, motores, válvulas y más.',
                'image_url'   => 'https://www.tiendamirage.mx/img/category/refacciones.jpg',
            ],
            [
                'uuid'        => 'd2b3c4d5-e6f7-8901-2345-67890abcdef1',
                'name'        => 'Aire Acondicionado',
                'slug'        => 'aire-acondicionado',
                'description' => 'Equipos de aire acondicionado Mirage para tu hogar o negocio. Minisplits, portátiles y sistemas de climatización de alta eficiencia energética.',
                'image_url'   => 'https://www.tiendamirage.mx/img/category/aire-acondicionado.jpg',
            ],
            [
                'uuid'        => 'e3c4d5e6-f7a8-9012-3456-78901abcdef2',
                'name'        => 'Minisplits Inverter',
                'slug'        => 'minisplits-inverter',
                'description' => 'Equipos de aire acondicionado con tecnología Inverter de última generación. Ahorra hasta un 60% de energía y mantén el confort durante todo el año.',
                'image_url'   => 'https://www.tiendamirage.mx/img/category/minisplits-inverter.jpg',
            ],
            [
                'uuid'        => 'f4d5e6f7-a8b9-0123-4567-89012abcdef3',
                'name'        => 'Línea Blanca',
                'slug'        => 'linea-blanca',
                'description' => 'Electrodomésticos de línea blanca Mirage para el hogar. Boilers, lavadoras, microondas, campanas, parrillas y dispensadores de alta calidad.',
                'image_url'   => 'https://www.tiendamirage.mx/img/category/linea-blanca.jpg',
            ],
            [
                'uuid'        => 'a5e6f7a8-b9c0-1234-5678-90123abcdef4',
                'name'        => 'Herramientas',
                'slug'        => 'herramientas',
                'description' => 'Herramientas profesionales y para el hogar Mirage. Taladros, lijadoras, compresoras, sopladores y accesorios para cada trabajo.',
                'image_url'   => 'https://www.tiendamirage.mx/img/category/herramientas-instalacion.jpg',
            ],
            [
                'uuid'        => 'b6f7a8b9-c0d1-2345-6789-01234abcdef5',
                'name'        => 'Souvenirs',
                'slug'        => 'souvenirs',
                'description' => 'Artículos de regalo y colección Mirage. Tazas, playeras, accesorios de oficina y artículos promocionales con la identidad de la marca.',
                'image_url'   => 'https://www.tiendamirage.mx/img/category/souvenirs.jpg',
            ],
            [
                'uuid'        => 'c7a8b9c0-d1e2-3456-7890-12345abcdef6',
                'name'        => 'Outlet',
                'slug'        => 'outlet',
                'description' => 'Productos en oferta, liquidación y precio especial. Equipos de exhibición, temporada pasada y unidades con empaque dañado a precios irrepetibles.',
                'image_url'   => 'https://www.tiendamirage.mx/img/category/outlet.jpg',
            ],
        ];

        foreach ($mainCategories as $data) {
            Category::firstOrCreate(
                ['uuid' => $data['uuid']],
                array_merge($data, ['is_active' => true, 'parent_id' => null])
            );
        }

        // ---- Subcategorías de Línea Blanca ----
        $lineaBlanca = Category::where('slug', 'linea-blanca')->first();

        if ($lineaBlanca) {
            $subCategories = [
                [
                    'uuid'        => 'a1b2c3d4-e5f6-7890-1234-56789abcdef0',
                    'name'        => 'Boiler / Calentadores Instantáneos de Agua',
                    'slug'        => 'boiler',
                    'description' => 'Calentadores de agua y boilers Mirage para uso doméstico e industrial. Disponibles en paso, depósito y solar, en diferentes capacidades.',
                    'image_url'   => 'https://www.tiendamirage.mx/img/category/boiler.jpg',
                ],
                [
                    'uuid'        => 'b2c3d4e5-f6a7-8901-2345-67890abcdef1',
                    'name'        => 'Campanas',
                    'slug'        => 'campanas',
                    'description' => 'Campanas extractoras para cocina Mirage. Diseños modernos con filtros de aluminio lavables, iluminación LED y control de velocidad múltiple.',
                    'image_url'   => 'https://www.tiendamirage.mx/img/category/campanas.jpg',
                ],
                [
                    'uuid'        => 'c3d4e5f6-a7b8-9012-3456-78901abcdef2',
                    'name'        => 'Dispensadores',
                    'slug'        => 'dispensadores',
                    'description' => 'Dispensadores de agua Mirage fríos, calientes y de temperatura ambiente. Diseño compacto y elegante para hogar y oficina.',
                    'image_url'   => 'https://www.tiendamirage.mx/img/category/dispensadores.jpg',
                ],
                [
                    'uuid'        => 'd4e5f6a7-b8c9-0123-4567-89012abcdef3',
                    'name'        => 'Parrillas',
                    'slug'        => 'parrillas',
                    'description' => 'Parrillas y estufas de gas y eléctricas Mirage. Quemadores de alto rendimiento, encendido automático y superficies de fácil limpieza.',
                    'image_url'   => 'https://www.tiendamirage.mx/img/category/parrillas.jpg',
                ],
                [
                    'uuid'        => 'e5f6a7b8-c9d0-1234-5678-90123abcdef4',
                    'name'        => 'Microondas',
                    'slug'        => 'microondas',
                    'description' => 'Microondas y hornos Mirage con tecnología de cocción uniforme. Múltiples modos, potencias ajustables y capacidades de 0.7 a 1.6 pies cúbicos.',
                    'image_url'   => 'https://www.tiendamirage.mx/img/category/microondas.jpg',
                ],
                [
                    'uuid'        => 'f6a7b8c9-d0e1-2345-6789-01234abcdef5',
                    'name'        => 'Lavadoras',
                    'slug'        => 'lavadoras',
                    'description' => 'Lavadoras de carga superior y frontal Mirage. Programas inteligentes, ciclos de lavado múltiples y alta eficiencia en el consumo de agua.',
                    'image_url'   => 'https://www.tiendamirage.mx/img/category/lavadoras.jpg',
                ],
                [
                    'uuid'        => '6e1ab2f3-c4d5-4b6c-8a90-1234567890a1',
                    'name'        => 'Congeladores',
                    'slug'        => 'congeladores',
                    'description' => 'Congeladores Mirage para mantener tus alimentos en perfecto estado.',
                    'image_url'   => 'https://www.tiendamirage.mx/img/category/congeladores.jpg',
                ],
                [
                    'uuid'        => '7f2bc3a4-d5e6-4c7d-9b01-2345678901b2',
                    'name'        => 'Purificadores de Aire',
                    'slug'        => 'purificadores-de-aire',
                    'description' => 'Respira aire limpio y purificado con los sistemas avanzados de filtrado Mirage.',
                    'image_url'   => 'https://www.tiendamirage.mx/img/category/purificadores.jpg',
                ],
                [
                    'uuid'        => '8a3cd4b5-e6f7-4d8e-0c12-3456789012c3',
                    'name'        => 'Refrigeradores',
                    'slug'        => 'refrigeradores',
                    'description' => 'Refrigeradores eficientes, diseño elegante y tecnología de conservación Mirage.',
                    'image_url'   => 'https://www.tiendamirage.mx/img/category/refrigeradores.jpg',
                ],
            ];

            foreach ($subCategories as $data) {
                Category::updateOrCreate(
                    ['slug' => $data['slug']],
                    array_merge($data, ['is_active' => true, 'parent_id' => $lineaBlanca->id])
                );
            }
        }

        // ---- Subcategorías de Aire Acondicionado ----
        $aireAcondicionado = Category::where('slug', 'aire-acondicionado')->first();

        if ($aireAcondicionado) {
            $acSubCategories = [
                [
                    'uuid'        => '9b4de5c6-f7a8-4e9f-1d23-4567890123d4',
                    'name'        => 'Comercial',
                    'slug'        => 'comercial',
                    'description' => 'Equipos de aire acondicionado comercial para grandes espacios.',
                    'image_url'   => 'https://www.tiendamirage.mx/img/category/comercial.jpg',
                ],
                [
                    'uuid'        => '0c5ef6d7-a8b9-4f0a-2e34-5678901234e5',
                    'name'        => 'Comercial Ligero',
                    'slug'        => 'comercial-ligero',
                    'description' => 'Soluciones eficientes para pequeños negocios y oficinas.',
                    'image_url'   => 'https://www.tiendamirage.mx/img/category/comercial-ligero.jpg',
                ],
                [
                    'uuid'        => '1d6fa7e8-b9c0-401b-3f45-6789012345f6',
                    'name'        => 'De Ventana',
                    'slug'        => 'de-ventana',
                    'description' => 'Clásicos equipos de ventana fáciles de instalar y usar.',
                    'image_url'   => 'https://www.tiendamirage.mx/img/category/ventana.jpg',
                ],
                [
                    'uuid'        => '2e7ab8f9-c0d1-412c-4a56-7890123456a7',
                    'name'        => 'MiniSplit',
                    'slug'        => 'minisplit',
                    'description' => 'Sistemas MiniSplit eficientes y silenciosos para el hogar.',
                    'image_url'   => 'https://www.tiendamirage.mx/img/category/minisplit.jpg',
                ],
                [
                    'uuid'        => '3f8bc9a0-d1e2-423d-5b67-8901234567b8',
                    'name'        => 'Multisplit',
                    'slug'        => 'multisplit',
                    'description' => 'Controla múltiples zonas con un solo condensador exterior.',
                    'image_url'   => 'https://www.tiendamirage.mx/img/category/multisplit.jpg',
                ],
                [
                    'uuid'        => '4a9cd0b1-e2f3-434e-6c78-9012345678c9',
                    'name'        => 'Portátiles',
                    'slug'        => 'portatiles',
                    'description' => 'Lleva el clima perfecto a donde lo necesites con sistemas portátiles.',
                    'image_url'   => 'https://www.tiendamirage.mx/img/category/portatiles.jpg',
                ]
            ];

            foreach ($acSubCategories as $data) {
                Category::updateOrCreate(
                    ['slug' => $data['slug']],
                    array_merge($data, ['is_active' => true, 'parent_id' => $aireAcondicionado->id])
                );
            }
        }
    }
}
