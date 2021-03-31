<?php

namespace Tests\Feature\OrderDetail;

use App\Models\OrderDetail;
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

        $this->orderDetail = OrderDetail::factory()->create();
    }

    public function test_オーダー詳細を更新して返却(): void
    {
        $body = [
            'order_id'    => $this->orderDetail->order->id,
            'standard_id' => $this->orderDetail->standard->id,
            'quantity'    => $this->faker->numberBetween(1, 3),
            'unit_price'  => $this->orderDetail->standard->price,
            'tax'         => 0.1,
            'shipping'    => $this->faker->randomElement([600, 1200]),
        ];

        $response = $this->json('patch', route('order-detail.update', [
            'orderDetail' => $this->orderDetail->id,
        ]), $body);

        $response
            ->assertStatus(200);
            // ->assertJsonStructure([
            //     'orderDetail' => [
            //         'order',
            //         'standard',
            //     ],
            // ]);
    }
}
