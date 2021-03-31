<?php

namespace Tests\Feature\ProductAttachment;

use App\Models\File;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_商品添付を作成して返却(): void
    {
        $body = [
            'product_id' => Product::factory()->create()->id,
            'file_id'    => File::factory()->create()->id,
        ];

        $response = $this
            ->json('post', route('product-attachment.store'), $body);
        $response
            ->assertStatus(201);
    }
}
