<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;

class DummyProductsSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::where('slug', '!=', 'minisplits-inverter')->get();

        foreach ($categories as $category) {
            for ($i = 1; $i <= 4; $i++) {
                $name = 'Producto de Prueba ' . $i . ' - ' . $category->name;
                $slug = Str::slug($name . '-' . Str::random(5));
                
                $product = Product::firstOrCreate(['slug' => $slug], [
                    'category_id' => $category->id,
                    'name' => $name,
                    'sku' => 'DUMMY-' . strtoupper(Str::random(5)) . '-' . $i,
                    'price' => rand(500, 5000) + 0.99,
                    'discount_price' => rand(0, 1) ? (rand(300, 499) + 0.99) : null,
                    'stock' => rand(5, 50),
                    'short_description' => 'Descripción corta de prueba para ' . $category->name . '. Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                    'long_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                    'specifications' => [
                        'Característica de prueba 1 (Lorem ipsum)',
                        'Característica de prueba 2 (Lorem ipsum)',
                        'Característica de prueba 3 (Lorem ipsum)',
                    ],
                    'is_active' => true,
                ]);

                if ($product->images()->count() == 0) {
                    $realImages = [
                        'https://www.tiendamirage.mx/10214-home_default/inverter-x-2-ton-frio-calor-220.jpg',
                        'https://www.tiendamirage.mx/10212-home_default/inverter-x-1-ton-frio-calor-220.jpg',
                        'https://www.tiendamirage.mx/10202-home_default/inverter-x-1-ton-frio-calor-110.jpg',
                        'https://www.tiendamirage.mx/10204-home_default/inverter-2-ton-frio-220.jpg',
                        'https://www.tiendamirage.mx/10192-home_default/inverter-1-ton-frio-220.jpg',
                        'https://www.tiendamirage.mx/9826-home_default/mirage-magnum-22-2-ton-frio-calor-220v.jpg',
                        'https://www.tiendamirage.mx/9822-home_default/mirage-magnum-22-1-ton-frio-calor-220v.jpg',
                    ];
                    $product->images()->create([
                        'image_url'  => $realImages[array_rand($realImages)],
                        'is_primary' => true,
                    ]);
                }

                if ($product->variants()->count() == 0) {
                    // Create some variants
                    $product->variants()->create([
                        'name' => '1 Tonelada 110V',
                        'sku' => $product->sku . '-1T-110',
                        'price' => $product->price,
                        'discount_price' => $product->discount_price,
                        'stock' => rand(5, 20),
                        'is_active' => true,
                    ]);
                    $product->variants()->create([
                        'name' => '1.5 Toneladas 220V',
                        'sku' => $product->sku . '-15T-220',
                        'price' => $product->price + 1500,
                        'discount_price' => $product->discount_price ? $product->discount_price + 1500 : null,
                        'stock' => rand(5, 20),
                        'is_active' => true,
                    ]);
                }
            }
        }
    }
}
