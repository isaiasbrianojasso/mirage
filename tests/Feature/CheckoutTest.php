<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\Zone;
use App\Models\Carrier;
use App\Models\CustomerGroup;

class CheckoutTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_calculate_shipping_and_process_checkout()
    {
        // 1. Setup data
        $customerGroup = CustomerGroup::create(['name' => 'General', 'show_prices' => true]);
        
        $user = User::factory()->create([
            'customer_group_id' => $customerGroup->id,
        ]);
        
        $zone = Zone::create(['name' => 'Jalisco', 'active' => true]);

        $carrier = Carrier::create([
            'name' => 'Fedex',
            'is_free' => false,
            'active' => true,
            'billing_behavior' => 'weight',
            'out_of_range_behavior' => 'highest_range',
            'max_weight' => 100,
        ]);
        
        $carrier->customerGroups()->attach($customerGroup->id);
        
        $range = $carrier->ranges()->create([
            'delimiter1' => 0,
            'delimiter2' => 50,
        ]);
        
        $range->zonePrices()->create([
            'carrier_id' => $carrier->id,
            'zone_id' => $zone->id,
            'price' => 150.00,
        ]);

        $category = \App\Models\Category::create(['name' => 'Laptops', 'slug' => 'laptops']);

        $product = Product::create([
            'name' => 'Laptop Gamer',
            'slug' => 'laptop-gamer',
            'price' => 20000,
            'stock' => 10,
            'is_active' => true,
            'weight' => 2.5,
            'category_id' => $category->id,
        ]);

        // 2. Add product to cart (mocking session)
        $cart = [
            $product->id . '_' => [
                'product_id' => $product->id,
                'name' => $product->name,
                'quantity' => 1,
            ]
        ];

        // 3. Test Shipping Calculation Endpoint
        $response = $this->actingAs($user)
            ->withSession(['cart' => $cart])
            ->postJson(route('checkout.shipping-rates'), [
                'zone_id' => $zone->id,
            ]);

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'id' => $carrier->id,
            'cost' => 150.00,
        ]);

        // 4. Test Checkout Process (Store Order)
        $checkoutData = [
            'customer_name' => $user->name,
            'customer_email' => $user->email,
            'customer_phone' => '1234567890',
            'shipping_address' => 'Av Siempreviva 123',
            'shipping_city' => 'Guadalajara',
            'shipping_zip' => '44100',
            'zone_id' => $zone->id,
            'payment_method' => 'cash',
            'carrier_id' => $carrier->id,
        ];

        $checkoutResponse = $this->actingAs($user)
            ->withSession(['cart' => $cart])
            ->post(route('checkout.store'), $checkoutData);

        // It should redirect to success
        $checkoutResponse->assertStatus(302);
        
        // Ensure stock was decremented
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'stock' => 9,
        ]);

        // Ensure order was created
        $this->assertDatabaseHas('orders', [
            'customer_email' => $user->email,
            'total_amount' => 20150.00, // 20000 product + 150 shipping
            'status' => 'pending',
            'shipping_cost' => 150.00,
        ]);

        // Ensure cart is cleared
        $this->assertNull(session('cart'));
    }
}
