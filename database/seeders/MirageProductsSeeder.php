<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class MirageProductsSeeder extends Seeder
{
    public function run(): void
    {
        $catInverter = Category::firstOrCreate(
            ['slug' => 'minisplits-inverter'],
            [
                'name'        => 'Minisplits Inverter',
                'description' => 'Equipos de aire acondicionado con tecnología Inverter de alta eficiencia energética.',
                'is_active'   => true,
            ]
        );

        $products = [
            [
                'name'              => 'Inverter X 2 Ton Frío - Calor 220',
                'slug'              => 'inverter-x-2-ton-frio-calor-220',
                'sku'               => 'MRG-INV-X-2TC-220',
                'price'             => 14299.00,
                'discount_price'    => 12999.00,
                'stock'             => 5,
                'short_description' => 'El Inverter X de 2 toneladas con Frío-Calor en 220V es la solución perfecta para espacios amplios. Tecnología de ahorro energético superior.',
                'long_description'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. El Minisplit Inverter X 2 Toneladas Frío-Calor opera en 220V y está diseñado para espacios de hasta 50 m². Gracias a su tecnología Inverter de velocidad variable, el compresor ajusta su potencia de manera continua, eliminando los picos de consumo eléctrico que generan los equipos convencionales. Cuenta con función Frío-Calor para brindarte confort en cualquier temporada del año. Su motor X-Blade reduce turbulencias, mejora el flujo de aire y disminuye el nivel de ruido. Además incluye filtro con capa Ozone Fin anticorrosiva, My Sensor para ajuste de temperatura desde el control remoto, y diagnóstico inteligente Library App compatible con aplicación móvil. La garantía cubre 1 año en el equipo y hasta 6 años en el compresor si la instalación es realizada por un Centro de Servicios Autorizado Mirage (CESAM).',
                'specifications'    => [
                    'Tecnología Inverter de velocidad variable',
                    'Función Frío-Calor (heat pump)',
                    'Voltaje: 220V / 60Hz',
                    'Capacidad: 2 Toneladas (24,000 BTU)',
                    'SEER: hasta 22 – Máxima eficiencia energética',
                    'Nivel de ruido interior: 22 dB(A)',
                    'X-Blade: aspa aerodinámica de alto rendimiento',
                    'Ozone Fin: recubrimiento anticorrosivo',
                    'My Sensor: temperatura desde el control remoto',
                    'Library App: diagnóstico inteligente móvil',
                    'Garantía: 1 año equipo / 6 años compresor (CESAM)',
                ],
                'image' => 'https://www.tiendamirage.mx/10214-home_default/inverter-x-2-ton-frio-calor-220.jpg',
            ],
            [
                'name'              => 'Inverter X 1 Ton Frio - Calor 220',
                'slug'              => 'inverter-x-1-ton-frio-calor-220',
                'sku'               => 'MRG-INV-X-1TC-220',
                'price'             => 9499.00,
                'discount_price'    => 8599.00,
                'stock'             => 12,
                'short_description' => 'Minisplit Inverter X de 1 tonelada Frío-Calor en 220V ideal para habitaciones de hasta 25 m². Silencioso y de bajo consumo energético.',
                'long_description'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. El Minisplit Inverter X 1 Tonelada Frío-Calor 220V es la alternativa perfecta para habitaciones medianas de hasta 25 m². Su tecnología Inverter garantiza un ahorro de hasta un 60% en el consumo eléctrico comparado con equipos de velocidad fija. La función Frío-Calor (bomba de calor) te permite refrigerar en verano y calentar en invierno con un solo equipo. El compresor rotativo de alta velocidad y el motor X-Blade reducen las vibraciones y el ruido a niveles casi imperceptibles. Healthy Clean activa una corriente de secado después del modo enfriamiento para eliminar la humedad del evaporador, previniendo malos olores y hongos. Compatible con diagnóstico vía app Library App.',
                'specifications'    => [
                    'Tecnología Inverter de velocidad variable',
                    'Función Frío-Calor (heat pump)',
                    'Voltaje: 220V / 60Hz',
                    'Capacidad: 1 Tonelada (12,000 BTU)',
                    'SEER: hasta 20 – Alta eficiencia energética',
                    'Nivel de ruido interior: 20 dB(A)',
                    'X-Blade: aspa aerodinámica de alto rendimiento',
                    'Healthy Clean: secado anticorrosivo del evaporador',
                    'Cooling Boost: enfriamiento turbo para días de calor extremo',
                    'Library App: diagnóstico inteligente móvil',
                    'Garantía: 1 año equipo / 6 años compresor (CESAM)',
                ],
                'image' => 'https://www.tiendamirage.mx/10212-home_default/inverter-x-1-ton-frio-calor-220.jpg',
            ],
            [
                'name'              => 'Inverter X 1 Ton Frio - Calor 110',
                'slug'              => 'inverter-x-1-ton-frio-calor-110',
                'sku'               => 'MRG-INV-X-1TC-110',
                'price'             => 8599.00,
                'discount_price'    => 7999.00,
                'stock'             => 8,
                'short_description' => 'Versión 110V del Inverter X 1 tonelada con Frío-Calor. Perfecta para instalaciones estándar monofásicas sin necesidad de cambiar el cableado.',
                'long_description'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. El Minisplit Inverter X 1 Tonelada Frío-Calor 110V es la opción ideal para hogares con instalación eléctrica estándar de 110V/127V. No requiere inversión adicional en instalación eléctrica de alta tensión, lo que reduce el costo total de adquisición. Con la misma tecnología Inverter de velocidad variable que toda la línea X, este equipo regula el compresor de manera continua para mantener la temperatura deseada con el mínimo consumo posible. La función Leak Detect protege el compresor ante pérdidas de refrigerante mediante un ciclo de seguridad Safety Shut Down. El LT Sensor detecta congelamiento del evaporador y detiene el equipo para prevenir daños internos.',
                'specifications'    => [
                    'Tecnología Inverter de velocidad variable',
                    'Función Frío-Calor (heat pump)',
                    'Voltaje: 110V–127V / 60Hz',
                    'Capacidad: 1 Tonelada (12,000 BTU)',
                    'SEER: hasta 19 – Alta eficiencia energética',
                    'Nivel de ruido interior: 21 dB(A)',
                    'Leak Detect: protección ante pérdida de refrigerante',
                    'LT Sensor: prevención de congelamiento del evaporador',
                    'X-Blade: aspa aerodinámica de alto rendimiento',
                    'Library App: diagnóstico inteligente móvil',
                    'Garantía: 1 año equipo / 6 años compresor (CESAM)',
                ],
                'image' => 'https://www.tiendamirage.mx/10202-home_default/inverter-x-1-ton-frio-calor-110.jpg',
            ],
            [
                'name'              => 'Inverter 2 Toneladas solo Frio 220v',
                'slug'              => 'inverter-2-ton-frio-220',
                'sku'               => 'MRG-INV-2F-220',
                'price'             => 11999.00,
                'discount_price'    => null,
                'stock'             => 3,
                'short_description' => 'Minisplit Inverter de 2 toneladas de solo enfriamiento en 220V. Potente y eficiente para espacios grandes de hasta 40 m².',
                'long_description'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. El Minisplit Inverter 2 Toneladas Solo Frío 220V está diseñado para espacios amplios de hasta 40 m² donde se requiere un enfriamiento potente y continuo. Su compresor Inverter de velocidad variable elimina los arranques bruscos de la unidad, reduciendo el desgaste mecánico y el consumo eléctrico. La función Cooling Boost activa el turbo de enfriamiento con un solo toque del control remoto, ideal para los días de mayor temperatura. El ventilador X-Blade distribuye el flujo de aire de manera uniforme en todo el espacio, eliminando zonas calientes. Este equipo es ideal para salones, oficinas medianas, locales comerciales y tiendas. No incluye función de calefacción.',
                'specifications'    => [
                    'Tecnología Inverter de velocidad variable',
                    'Solo enfriamiento (sin bomba de calor)',
                    'Voltaje: 220V / 60Hz',
                    'Capacidad: 2 Toneladas (24,000 BTU)',
                    'SEER: hasta 18 – Eficiencia energética media-alta',
                    'Nivel de ruido interior: 24 dB(A)',
                    'X-Blade: distribución uniforme del flujo de aire',
                    'Cooling Boost: modo turbo de enfriamiento',
                    'Auto-reinicio tras corte de energía',
                    'Library App: diagnóstico inteligente móvil',
                    'Garantía: 1 año equipo / 6 años compresor (CESAM)',
                ],
                'image' => 'https://www.tiendamirage.mx/10204-home_default/inverter-2-ton-frio-220.jpg',
            ],
            [
                'name'              => 'Inverter 1 Tonelada solo Frio 220v',
                'slug'              => 'inverter-1-ton-frio-220',
                'sku'               => 'MRG-INV-1F-220',
                'price'             => 7499.00,
                'discount_price'    => 6999.00,
                'stock'             => 15,
                'short_description' => 'El minisplit Inverter de 1 tonelada solo frío en 220V. La opción de entrada más popular y eficiente para habitaciones de hasta 20 m².',
                'long_description'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. El Minisplit Inverter 1 Tonelada Solo Frío 220V es el equipo más vendido de la línea Mirage, combinando eficiencia energética, bajo ruido y facilidad de instalación en un paquete compacto. Ideal para habitaciones de hasta 20 m². Su tecnología Inverter garantiza hasta un 55% de ahorro en el consumo eléctrico comparado con equipos de velocidad fija de la misma capacidad. La función My Sensor registra la temperatura en tiempo real desde el control remoto para ajustes más precisos. Healthy Clean activa un ciclo de secado del evaporador para mantener el aire limpio y libre de hongos. El filtro lavable de malla fina retiene polvo y partículas, fácil de retirar y limpiar mensualmente. Incluye control remoto con pantalla retroiluminada y múltiples modos de operación.',
                'specifications'    => [
                    'Tecnología Inverter de velocidad variable',
                    'Solo enfriamiento (sin bomba de calor)',
                    'Voltaje: 220V / 60Hz',
                    'Capacidad: 1 Tonelada (12,000 BTU)',
                    'SEER: hasta 20 – Alta eficiencia energética',
                    'Nivel de ruido interior: 19 dB(A) – Ultra silencioso',
                    'My Sensor: registro de temperatura desde el RC',
                    'Healthy Clean: secado anticorrosivo del evaporador',
                    'Filtro lavable de malla fina',
                    'Control remoto con pantalla retroiluminada',
                    'Garantía: 1 año equipo / 6 años compresor (CESAM)',
                ],
                'image' => 'https://www.tiendamirage.mx/10192-home_default/inverter-1-ton-frio-220.jpg',
            ],
        ];

        foreach ($products as $data) {
            $image = $data['image'];
            unset($data['image']);

            $data['category_id'] = $catInverter->id;
            $data['is_active']   = true;

            $product = Product::firstOrCreate(['slug' => $data['slug']], $data);

            if ($product->images()->count() == 0) {
                $product->images()->create([
                    'image_url'  => $image,
                    'is_primary' => true,
                ]);
            }
        }
    }
}
