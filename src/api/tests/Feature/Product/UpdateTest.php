<?php

namespace Tests\Feature\Product;

use App\Models\Product;
use App\Models\ProductStandard;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();

        $standard = ProductStandard::factory()->create();
        $this->product = $standard->product;
    }

    public function test_商品を更新して返却(): void
    {
        $body = [
            'name'    => $this->faker->lexify('商品????'),
            'slug'    => $this->faker->lexify('slug????'),
            'content' => $this->faker->optional()->realText,
        ];

        $response = $this->json('patch', route('product.update', [
                        'product' => $this->product->id,
                    ]), $body);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'product' => [
                    'id',
                    'name',
                    'slug',
                    'content',
                ],
            ])
            ->assertJson([
                'product' => [
                    'name'    => $body['name'],
                    'slug'    => $body['slug'],
                    'content' => $body['content'],
                ],
            ]);
    }
}
