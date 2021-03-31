<?php

namespace Tests\Feature\ProductStandard;

use App\Http\Resources\FileResource;
use App\Models\File;
use App\Models\ProductAttachment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();

        $attachment    = ProductAttachment::factory()->create();
        $this->product = $attachment->product;
        $this->thumb   = $attachment->file;
        $this->only    = ['slug','name','filename','url'];
    }

    public function test_商品詳細を作成して返却(): void
    {
        $body = [
            'product_id'      => $this->product->id,
            'name'            => $this->faker->lexify('カラー????'),
            'code'            => $this->faker->unique()->bothify('???###'),
            'thumb_id'        => $this->thumb->id,
            'thumb_target_id' => $this->thumb->id,
            'status'          => $this->faker->randomElement(['private', 'publish']),
            'stock'           => $this->faker->numberBetween(-1, 100),
            'price'           => $this->faker->numberBetween(0, 10000),
        ];

        $response = $this
            ->json('post', route('product-standard.store'), $body);

        $thumb       = File::find($body['thumb_id'])
            ->only($this->only);
        $thumbTarget = File::find($body['thumb_target_id'])
            ->only($this->only);

        $response
            ->assertStatus(201)
            ->assertJson([
                'standard' => [
                    'name'        => $body['name'],
                    'code'        => $body['code'],
                    'thumb'       => $thumb,
                    'thumbTarget' => $thumbTarget,
                    'status'      => $body['status'],
                    'stock'       => $body['stock'],
                    'price'       => $body['price'],
                ],
            ]);
    }
}
