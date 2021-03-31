<?php

namespace Tests\Feature\Order;

use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DestroyTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->order = Order::factory()->create();
    }

    public function test_オーダーを削除(): void
    {
        $response = $this->json('delete', route('order.destroy', [
            'order' => $this->order->id,
        ]));

        $response
            ->assertStatus(204)
            ->assertNoContent();
    }
}
