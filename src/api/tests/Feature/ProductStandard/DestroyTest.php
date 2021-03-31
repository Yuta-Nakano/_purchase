<?php

namespace Tests\Feature\ProductStandard;

use App\Models\ProductStandard;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DestroyTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->standard = ProductStandard::factory()->create();
    }

    public function test_商品詳細を削除(): void
    {
        $response = $this->json('delete', route('product-standard.destroy', [
            'standard' => $this->standard->id,
        ]));

        $response
            ->assertStatus(204)
            ->assertNoContent();
    }
}
