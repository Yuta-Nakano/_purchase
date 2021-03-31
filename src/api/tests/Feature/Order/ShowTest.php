<?php

namespace Tests\Feature\Order;

use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->order = Order::factory()->create();
    }

    public function test_オーダーを返却(): void
    {
        $response = $this->json('get', route('order.show', [
            'order' => $this->order->id,
        ]));

        $response
            ->assertStatus(200);
            // ->assertJsonStructure([
            //     'product' => [
            //         'id',
            //         'name',
            //         'slug',
            //         'content',
            //     ],
            // ]);
    }
}
