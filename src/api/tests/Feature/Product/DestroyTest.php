<?php

namespace Tests\Feature\Product;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DestroyTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->product = Product::factory()->create();
    }

    public function test_商品を削除(): void
    {
        $response = $this->json('delete', route('product.destroy', [
            'product' => $this->product->id,
        ]));

        $response
            ->assertStatus(204)
            ->assertNoContent();
    }
}
