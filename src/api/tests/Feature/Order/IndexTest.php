<?php

namespace Tests\Feature\Order;

use App\Models\OrderDetail;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();

        $this->count = 15;
        $this->orderDetails = OrderDetail::factory($this->count)->create();
        $this->user = User::get()->random();
    }

    public function test_オーダー一覧とページネーションを返却(): void
    {
        $response = $this->json('get', route('order.index'));

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'orders',
            //     'products' => [
            //         '*' => [
            //             'id',
            //             'name',
            //             'slug',
            //             'content',
            //         ],
            //     ],
            //     'meta' => [
            //         'current_page',
            //         'last_page',
            //         'per_page',
            //         'from',
            //         'to',
            //         'total',
            //     ],
            ]);
    }
}
