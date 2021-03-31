<?php

namespace Tests\Feature\ProductAttachment;

use App\Models\ProductAttachment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DestroyTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->attachment = ProductAttachment::factory()->create();
    }

    public function test_商品添付を削除(): void
    {
        $response = $this->json('delete', route('product-attachment.destroy', [
            'attachment' => $this->attachment->id,
        ]));

        $response
            ->assertStatus(204)
            ->assertNoContent();
    }
}
