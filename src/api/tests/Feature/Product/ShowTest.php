<?php

namespace Tests\Feature\Product;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->product = Product::factory()->create();
    }

    public function test_商品を返却(): void
    {
        $response = $this->json('get', route('product.show', [
            'product' => $this->product->slug,
        ]));

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'product' => [
                    'id',
                    'name',
                    'slug',
                    'content',
                ],
            ]);
    }
}
