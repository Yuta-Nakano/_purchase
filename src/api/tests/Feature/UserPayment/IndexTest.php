<?php

namespace Tests\Feature\UserPayment;

use App\Models\User;
use App\Models\UserPayment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->count = 10;
        $this->user = User::factory()->create();
        UserPayment::factory($this->count)->create([
            'user_id' => $this->user
        ]);
    }

    public function test_決済方法一覧とページネーションを返却(): void
    {
        $response = $this->json('get', route('user-payment.index', [
            'user' => $this->user->name,
        ]));

        $response
            ->assertStatus(200)
            ->assertJsonCount($this->count, 'payments')
            ->assertJsonStructure([
                'payments' => [
                    '*' => [
                        'paymentType',
                        'creditCardType',
                        'creditCardNumbar',
                        'creditExpirationDate',
                    ],
                ],
                'meta' => [
                    'current_page',
                    'last_page',
                    'per_page',
                    'from',
                    'to',
                    'total',
                ],
            ]);
    }
}
