<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Distributor;
use App\Models\Post;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Review;
use App\Models\User;
use Illuminate\Support\Str;

class LoremIpsumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Seed Distributors
        Distributor::create([
            'name' => 'Aires y Servicios de Monterrey (Mirage Cumbres)',
            'address' => 'Av. Paseo de los Leones 2345, Cumbres 2º Sector',
            'city' => 'Monterrey',
            'state' => 'Nuevo León',
            'zip' => '64610',
            'phone' => '818-340-1234',
            'latitude' => 25.69843200,
            'longitude' => -100.37284100,
            'type' => 'venta'
        ]);

        Distributor::create([
            'name' => 'Distribuidora Climas Mirage CDMX Centro',
            'address' => 'Paseo de la Reforma 180, Juárez',
            'city' => 'Ciudad de México',
            'state' => 'CDMX',
            'zip' => '06600',
            'phone' => '555-520-5678',
            'latitude' => 19.42981200,
            'longitude' => -99.16124300,
            'type' => 'venta'
        ]);

        Distributor::create([
            'name' => 'Centro de Servicio Autorizado Mirage Guadalajara',
            'address' => 'Av. Ignacio L. Vallarta 4500, Americana',
            'city' => 'Guadalajara',
            'state' => 'Jalisco',
            'zip' => '44160',
            'phone' => '333-615-9090',
            'latitude' => 20.67439100,
            'longitude' => -103.38743200,
            'type' => 'servicio'
        ]);

        Distributor::create([
            'name' => 'Climas y Refacciones de Hermosillo',
            'address' => 'Blvd. Kino 310, Lomas de Hermosillo',
            'city' => 'Hermosillo',
            'state' => 'Sonora',
            'zip' => '83100',
            'phone' => '662-214-7777',
            'latitude' => 29.09843200,
            'longitude' => -110.94823100,
            'type' => 'venta'
        ]);

        Distributor::create([
            'name' => 'Servicio Técnico Autorizado Mirage Veracruz',
            'address' => 'Av. Salvador Díaz Mirón 1250, Centro',
            'city' => 'Veracruz',
            'state' => 'Veracruz',
            'zip' => '91700',
            'phone' => '229-931-4455',
            'latitude' => 19.18349200,
            'longitude' => -96.13421200,
            'type' => 'servicio'
        ]);


        // 2. Seed Posts (Blog)
        Post::create([
            'title' => 'Cómo ahorrar hasta un 40% de energía con tu Minisplit Inverter',
            'slug' => 'como-ahorrar-energia-minisplit-inverter',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. La tecnología inverter regula la velocidad del compresor para mantener una temperatura constante en lugar de encenderse y apagarse continuamente, lo que representa un gran ahorro en el recibo de luz. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'image_url' => '/tienda_assets/img/cms/banner_satisfaccion.jpg',
            'published_at' => now(),
            'status' => 'published'
        ]);

        Post::create([
            'title' => '5 consejos esenciales para el mantenimiento de tu aire acondicionado',
            'slug' => 'consejos-mantenimiento-aire-acondicionado',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. El mantenimiento periódico previene fallas costosas y asegura un aire limpio y saludable. 1. Limpia los filtros regularmente cada 15 días. 2. Mantén despejada la unidad exterior. 3. Revisa el desagüe de condensación. 4. Evita configurar temperaturas extremadamente frías (lo recomendado son 24°C). 5. Programa una revisión profesional con técnicos certificados Mirage una vez al año.',
            'image_url' => '/tienda_assets/img/cms/banner_envios.jpg',
            'published_at' => now(),
            'status' => 'published'
        ]);

        Post::create([
            'title' => 'Entendiendo la clasificación SEER y por qué importa en tu compra',
            'slug' => 'clasificacion-seer-importancia-compra',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. SEER (Seasonal Energy Efficiency Ratio) mide la eficiencia estacional del enfriamiento. A mayor número SEER, mayor será la eficiencia energética de tu minisplit. Los equipos Mirage de última generación cuentan con índices de hasta 22 SEER, asegurando el máximo confort con el mínimo consumo de watts.',
            'image_url' => '/tienda_assets/img/cms/banner_pagoseguros.jpg',
            'published_at' => now(),
            'status' => 'published'
        ]);


        // 3. Seed Orders & Order Items
        $admin = User::where('email', 'admin@mirage.com')->first();
        $products = Product::all();

        if ($admin && $products->count() > 0) {
            // Pedido 1
            $prod1 = $products->first();
            $order1 = Order::create([
                'user_id' => $admin->id,
                'customer_name' => $admin->name,
                'customer_email' => $admin->email,
                'customer_phone' => '818-123-4567',
                'shipping_address' => 'Av. Constitución 1000',
                'shipping_city' => 'Monterrey',
                'shipping_state' => 'Nuevo León',
                'shipping_zip' => '64000',
                'total_amount' => $prod1->price * 2,
                'status' => 'processing',
                'notes' => 'Entregar en horario de oficina.'
            ]);

            OrderItem::create([
                'order_id' => $order1->id,
                'product_id' => $prod1->id,
                'product_name' => $prod1->name,
                'price' => $prod1->price,
                'quantity' => 2
            ]);

            // Pedido 2
            if ($products->count() > 1) {
                $prod2 = $products->skip(1)->first();
                $order2 = Order::create([
                    'user_id' => $admin->id,
                    'customer_name' => $admin->name,
                    'customer_email' => $admin->email,
                    'customer_phone' => '818-123-4567',
                    'shipping_address' => 'Calle San Angel 456',
                    'shipping_city' => 'San Pedro Garza García',
                    'shipping_state' => 'Nuevo León',
                    'shipping_zip' => '66200',
                    'total_amount' => $prod2->price,
                    'status' => 'delivered',
                    'notes' => 'Dejar con el guardia de seguridad.'
                ]);

                OrderItem::create([
                    'order_id' => $order2->id,
                    'product_id' => $prod2->id,
                    'product_name' => $prod2->name,
                    'price' => $prod2->price,
                    'quantity' => 1
                ]);
            }
        }


        // 4. Seed Reviews for each product
        $reviewAuthors = [
            ['name' => 'Carlos Mendoza', 'email' => 'carlos@example.com'],
            ['name' => 'Andrea Villarreal', 'email' => 'andrea@example.com'],
            ['name' => 'Luis Fernando Gómez', 'email' => 'luis@example.com'],
            ['name' => 'Sofía Rodríguez', 'email' => 'sofia@example.com'],
            ['name' => 'Jorge Alberto Ortiz', 'email' => 'jorge@example.com'],
        ];

        $reviewTexts = [
            'Excelente minisplit, enfría la habitación en cuestión de minutos y el consumo de energía en el recibo de luz bajó notablemente comparado con mi equipo anterior de velocidad fija.',
            'La tecnología Inverter realmente cumple lo que promete. Es sumamente silencioso, apenas se escucha cuando está encendido. Lo recomiendo ampliamente.',
            'Muy buen diseño del panel interior, luce muy estético y moderno en la pared. La función X-Blade distribuye el aire de forma uniforme. Muy satisfecho con la compra.',
            'Un equipo magnífico. La conectividad con la aplicación móvil es muy práctica y los diagnósticos inteligentes de fallas me dan mucha tranquilidad sobre el mantenimiento del aparato.',
            'Instalación rápida y funcionamiento perfecto. Mirage sigue siendo la mejor opción en aire acondicionado por relación calidad-precio en México.',
        ];

        foreach ($products as $product) {
            // Añadir de 2 a 3 reseñas aleatorias a cada producto
            $numReviews = rand(2, 3);
            $selectedAuthors = array_rand($reviewAuthors, $numReviews);
            if (!is_array($selectedAuthors)) {
                $selectedAuthors = [$selectedAuthors];
            }

            foreach ($selectedAuthors as $index) {
                $author = $reviewAuthors[$index];
                $comment = $reviewTexts[rand(0, count($reviewTexts) - 1)];
                Review::create([
                    'product_id' => $product->id,
                    'customer_name' => $author['name'],
                    'customer_email' => $author['email'],
                    'rating' => rand(4, 5), // Calificaciones altas (4 o 5 estrellas) para pruebas
                    'comment' => $comment,
                    'is_approved' => true
                ]);
            }
        }
    }
}
