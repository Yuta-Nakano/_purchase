<?php

namespace Tests\Feature\Product;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->count = 3;
        Product::factory($this->count)->create();
    }

    public function test_商品一覧とページネーションを返却(): void
    {
        $response = $this->json('get', route('product.index'));

        $response
            ->assertStatus(200)
            ->assertJsonCount($this->count, 'products')
            ->assertJsonStructure([
                'products' => [
                    '*' => [
                        'id',
                        'name',
                        'slug',
                        'content',
                    ],
                ],
                'meta' => [
                    'current_page',
                    'last_page',
                    'per_page',
                    'from',
                    'to',
                    'total',
                ],
            ]);
    }
}
