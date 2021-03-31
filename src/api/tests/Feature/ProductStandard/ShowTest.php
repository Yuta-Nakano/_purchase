<?php

namespace Tests\Feature\ProductStandard;

use App\Models\ProductStandard;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->standard = ProductStandard::factory()->create();
    }

    public function test_商品を返却(): void
    {
        $response = $this->json('get', route('product-standard.show', [
            'standard' => $this->standard->id,
        ]));

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'standard' => [
                    'name',
                    'code',
                    'thumb',
                    'thumbTarget',
                    'status',
                    'stock',
                    'price',
                ],
            ]);
    }
}
