<?php

namespace Tests\Feature\OrderDetail;

use App\Models\OrderDetail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DestroyTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->orderDetail = OrderDetail::factory()->create();
    }

    public function test_オーダー詳細を削除(): void
    {
        $response = $this->json('delete', route('order-detail.destroy', [
            'orderDetail' => $this->orderDetail->id,
        ]));

        $response
            ->assertStatus(204)
            ->assertNoContent();
    }
}
