<?php

namespace Tests\Feature\OrderDetail;

use App\Models\Order;
use App\Models\ProductStandard;
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

        $this->order    = Order::factory()->create();
        $this->standard = ProductStandard::factory()->create();
    }

    public function test_オーダー詳細を作成して返却(): void
    {
        $body = [
            'order_id'    => $this->order->id,
            'standard_id' => $this->standard->id,
            'quantity'    => $this->faker->numberBetween(1, 3),
            'unit_price'  => $this->standard->price,
            'tax'         => 0.1,
            'shipping'    => $this->faker->randomElement([600, 1200]),
        ];

        $response = $this->json('post', route('order-detail.store'), $body);

        $response
            ->assertStatus(201)
            ->assertJsonStructure([
                'orderDetail' => [
                    'order',
                    'standard',
                ],
            ]);
    }
}
