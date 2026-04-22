<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SalesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function sale_can_be_created_and_redirected_to_invoice()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create([
            'stock' => 10
        ]);

        $response = $this->actingAs($user)->post('/sales', [
            'product_id' => $product->id,
            'quantity' => 2,
            'total' => 2000
        ]);

        $response->assertRedirect('/invoice');

        $this->assertDatabaseHas('sales', [
            'product_id' => $product->id
        ]);
    }
}