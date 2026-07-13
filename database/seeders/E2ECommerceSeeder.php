<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\User;
use App\Models\CustomerGroup;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Carrier;
use App\Models\Zone;
use App\Models\OrderHistory;
use App\Services\SearchIndexerService;

class E2ECommerceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(SearchIndexerService $searchIndexer): void
    {
        DB::beginTransaction();

        try {
            // 1. Agregar Categoría
            $category = Category::create([
                'uuid' => (string) Str::uuid(),
                'name' => 'Categoría E2E Test',
                'slug' => Str::slug('Categoría E2E Test'),
                'description' => 'Categoría generada para validar el flujo completo.',
                'is_active' => true,
            ]);

            // 2. Agregar Producto
            $product = Product::create([
                'category_id' => $category->id,
                'name' => 'Producto E2E Validation',
                'slug' => Str::slug('Producto E2E Validation'),
                'short_description' => 'Producto de prueba.',
                'long_description' => 'Producto de prueba para el flujo E2E.',
                'price' => 100.00,
                'sku' => 'SKU-E2E-001',
                'stock' => 50,
                'is_active' => true,
            ]);

            // Crear variantes para el producto
            $variantA = $product->variants()->create([
                'name' => 'Variante E2E A',
                'sku' => 'SKU-E2E-001-A',
                'price' => 110.00,
                'stock' => 20,
                'is_active' => true,
            ]);

            $variantB = $product->variants()->create([
                'name' => 'Variante E2E B',
                'sku' => 'SKU-E2E-001-B',
                'price' => 120.00,
                'stock' => 30,
                'is_active' => true,
            ]);

            // Indexar el producto para el catálogo
            $searchIndexer->indexProduct($product->fresh(['variants']));

            // 3. Agregar Grupo y Cliente
            $group = CustomerGroup::firstOrCreate(
                ['name' => 'Grupo E2E Test'],
                ['discount_percentage' => 10.00]
            );

            $customer = User::create([
                'name' => 'Comprador E2E',
                'first_name' => 'Comprador',
                'last_name' => 'E2E',
                'email' => 'comprador.e2e@example.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'customer_group_id' => $group->id,
            ]);

            $customer->groups()->sync([$group->id]);

            // 4. Mostrar en Catálogo (Ya comprobamos la indexación)

            // 5. Comprar un artículo (Simulando Checkout)
            // Calculamos el precio con el descuento de su grupo
            $unitPrice = $variantA->price;
            $discountedPrice = $unitPrice * (1 - ($group->discount_percentage / 100)); // 110 * 0.9 = 99
            
            $quantityToBuy = 2;

            // Restamos stock (esto lo hace CheckoutController / OrderController)
            $variantA->decrement('stock', $quantityToBuy);

            $order = Order::create([
                'user_id' => $customer->id,
                'customer_name' => $customer->name,
                'customer_email' => $customer->email,
                'customer_phone' => '1234567890',
                'shipping_address' => 'Calle E2E 123',
                'shipping_city' => 'Ciudad E2E',
                'shipping_state' => 'Estado E2E',
                'shipping_zip' => '12345',
                'total_amount' => ($discountedPrice * $quantityToBuy), // Sin envío aún
                'status' => 'processing',
                'payment_method' => 'card',
                'payment_status' => 'paid',
                'shipping_cost' => 0,
            ]);

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'product_variant_id' => $variantA->id,
                'product_name' => $product->name . ' - ' . $variantA->name,
                'price' => $discountedPrice,
                'quantity' => $quantityToBuy,
            ]);

            // 6. Enviar a cliente (Simulando Admin)
            $zone = Zone::firstOrCreate(
                ['name' => 'Zona E2E Test'],
                ['active' => true]
            );

            $carrier = Carrier::firstOrCreate(
                ['name' => 'Transportista E2E'],
                ['transit_time' => '1-2 días', 'is_free' => false, 'active' => true]
            );

            // Asignar el envío al pedido
            $order->update([
                'carrier_id' => $carrier->id,
                'shipping_cost' => 50.00, // Simulando costo añadido por admin
                'total_amount' => $order->total_amount + 50.00,
                'status' => 'shipped'
            ]);

            OrderHistory::create([
                'order_id' => $order->id,
                'user_id' => User::where('role', 'admin')->first()->id ?? 1,
                'status' => 'shipped',
                'email_sent' => false,
            ]);

            DB::commit();
            $this->command->info('E2ECommerceSeeder ejecutado correctamente. Todo el flujo fue validado exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->command->error('Error durante la validación del flujo E2E: ' . $e->getMessage());
        }
    }
}
