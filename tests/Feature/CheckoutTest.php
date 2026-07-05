<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CheckoutTest extends TestCase
{
    use RefreshDatabase;

    public function test_cannot_access_checkout_with_empty_cart()
    {
        $response = $this->get(route('checkout.index'));
        
        $response->assertRedirect(route('cart.index'));
        $response->assertSessionHas('error');
    }

    public function test_checkout_requires_valid_data()
    {
        // Mock a cart in session
        $this->withSession(['cart' => ['some_product_id' => ['quantity' => 1, 'price' => 100]]]);

        $response = $this->post(route('checkout.store'), [
            // Sending empty data to trigger validation errors
        ]);

        $response->assertSessionHasErrors([
            'customer_name',
            'customer_email',
            'customer_phone',
            'shipping_address',
            'shipping_city',
            'shipping_zip',
            'zone_id',
            'carrier_id',
            'payment_method'
        ]);
    }
}
