<?php

namespace Tests\Feature\ProductStandard;

use App\Models\File;
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

        $this->standard = ProductStandard::factory()->create();
        $this->only = ['slug','name','filename','url'];
    }

    public function test_商品詳細を更新して返却(): void
    {
        $body = [
            'name'            => $this->faker->lexify('カラー????'),
            'code'            => $this->faker->unique()->bothify('???###'),
            'thumb_id'        => $this->standard->thumb->id,
            'thumb_target_id' => $this->standard->thumbTarget->id,
            'status'          => $this->faker->randomElement(['private', 'publish']),
            'stock'           => $this->faker->numberBetween(-1, 100),
            'price'           => $this->faker->numberBetween(0, 10000),
        ];

        $response = $this
            ->json('patch', route('product-standard.update', [
                'standard' => $this->standard->id,
            ]), $body);

        $thumb       = File::find($body['thumb_id'])
            ->only($this->only);
        $thumbTarget = File::find($body['thumb_target_id'])
            ->only($this->only);

        $response
            ->assertStatus(200)
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
