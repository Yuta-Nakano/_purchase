<?php

namespace Tests\Feature\OrderDetail;

use App\Models\OrderDetail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->orderDetail = OrderDetail::factory()->create();
    }

    public function test_オーダー詳細を返却(): void
    {
        $response = $this->json('get', route('order-detail.show', [
            'orderDetail' => $this->orderDetail->id,
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
