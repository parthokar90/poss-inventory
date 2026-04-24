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
            'product_qty' => 5
        ]);

        $response = $this->actingAs($user)->post('/purchases', [
            'supplier_id' => 1,
            'purchase_date' => now()->format('Y-m-d'),
            'purchased_by' => $user->id,
            'items' => [
                [
                    'product_id' => $product->id,
                    'product_qty' => 10,
                    'product_price' => 100
                ]
            ]
        ]);

        $response->assertStatus(302);

        $this->assertEquals(15, $product->fresh()->product_qty);
    }
}