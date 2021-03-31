<?php

namespace Tests\Feature\Product;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_商品を作成して返却(): void
    {
        $body = [
            'name'    => $this->faker->lexify('商品????'),
            'slug'    => $this->faker->unique()->lexify('slug????'),
            'content' => $this->faker->optional()->realText,
        ];

        $response = $this->json('post', route('product.store'), $body);
        $response
            ->assertStatus(201)
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
