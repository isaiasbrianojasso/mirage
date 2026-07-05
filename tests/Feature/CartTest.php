<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_view_cart_page()
    {
        $response = $this->get(route('cart.index'));
        $response->assertStatus(200);
    }

    public function test_can_add_product_to_cart()
    {
        $category = \App\Models\Category::create(['name' => 'Test', 'slug' => 'test']);
        $product = Product::create([
            'category_id' => $category->id,
            'name' => 'Test Product',
            'slug' => 'test-product',
            'sku' => 'TEST-123',
            'price' => 100,
            'stock' => 10,
            'is_active' => 1,
            'description' => 'Test',
        ]);

        $response = $this->post(route('cart.add'), [
            'product_id' => $product->id,
            'quantity' => 2,
        ]);

        $response->assertSessionHas('success');
        
        $cart = session()->get('cart');
        $this->assertArrayHasKey($product->id, $cart);
        $this->assertEquals(2, $cart[$product->id]['quantity']);
    }

    public function test_can_update_cart_quantity()
    {
        $category = \App\Models\Category::create(['name' => 'Test', 'slug' => 'test2']);
        $product = Product::create([
            'category_id' => $category->id,
            'name' => 'Test Product',
            'slug' => 'test-product2',
            'sku' => 'TEST-124',
            'price' => 100,
            'stock' => 10,
            'is_active' => 1,
            'description' => 'Test',
        ]);

        // Add to cart first
        $this->post(route('cart.add'), [
            'product_id' => $product->id,
            'quantity' => 1,
        ]);

        // Update quantity
        $this->put(route('cart.update', $product->id), [
            'quantity' => 5,
        ]);

        $cart = session()->get('cart');
        $this->assertEquals(5, $cart[$product->id]['quantity']);
    }

    public function test_can_remove_product_from_cart()
    {
        $category = \App\Models\Category::create(['name' => 'Test', 'slug' => 'test3']);
        $product = Product::create([
            'category_id' => $category->id,
            'name' => 'Test Product',
            'slug' => 'test-product3',
            'sku' => 'TEST-125',
            'price' => 100,
            'stock' => 10,
            'is_active' => 1,
            'description' => 'Test',
        ]);

        $this->post(route('cart.add'), [
            'product_id' => $product->id,
            'quantity' => 1,
        ]);

        $this->delete(route('cart.remove', $product->id));

        $cart = session()->get('cart');
        $this->assertArrayNotHasKey($product->id, $cart);
    }
}
