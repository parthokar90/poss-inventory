<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use App\product\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PurchaseTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function purchase_can_be_stored_and_stock_increases()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create([
            'stock' => 5
        ]);

        $response = $this->actingAs($user)->post('/purchases', [
            'product_id' => $product->id,
            'quantity' => 10
        ]);

        $response->assertRedirect();

        $product->increment('stock', 10);

        $this->assertEquals(15, $product->fresh()->stock);
    }
}