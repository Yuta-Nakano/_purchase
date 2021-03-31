<?php

namespace Tests\Feature\Order;

use App\Models\User;
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

        $this->user = User::factory()->create();
    }

    public function test_オーダーを作成して返却(): void
    {
        $body = [
            'user_id' => $this->user->id,
        ];

        $response = $this->json('post', route('order.store'), $body);

        $response
            ->assertStatus(201)
            ->assertJsonStructure([
                'order',
            ]);
    }
}
