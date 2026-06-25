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
            ['name' => 'Refacciones',       'slug' => '10-refacciones',    'description' => 'Refacciones para equipos de climatización y electrodomésticos.'],
            ['name' => 'Aire Acondicionado','slug' => '11-aire-acondicionado', 'description' => 'Equipos de aire acondicionado para tu hogar o negocio.'],
            ['name' => 'Minisplits Inverter','slug' => 'minisplits-inverter', 'description' => 'Equipos de aire acondicionado con tecnología Inverter.'],
            ['name' => 'Línea Blanca',      'slug' => '13-linea-blanca',   'description' => 'Electrodomésticos de línea blanca.'],
            ['name' => 'Herramientas',      'slug' => '17-herramientas',   'description' => 'Herramientas para el hogar y profesionales.'],
            ['name' => 'Souvenirs',         'slug' => '14-souvenirs',      'description' => 'Artículos de regalo y souvenirs Mirage.'],
            ['name' => 'Outlet',            'slug' => '24-outlet',         'description' => 'Productos en oferta y liquidación.'],
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
                ['name' => 'Boiler',       'slug' => '18-boiler',        'description' => 'Calentadores de agua y boilers.'],
                ['name' => 'Campanas',     'slug' => '19-campanas',      'description' => 'Campanas para cocina.'],
                ['name' => 'Dispensadores','slug' => '21-dispensadores', 'description' => 'Dispensadores de agua.'],
                ['name' => 'Parillas',     'slug' => '22-parillas',      'description' => 'Parrillas y estufas.'],
                ['name' => 'Microondas',   'slug' => '25-microondas',    'description' => 'Microondas y hornos.'],
                ['name' => 'Lavadoras',    'slug' => '26-lavadoras',     'description' => 'Lavadoras y secadoras.'],
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
