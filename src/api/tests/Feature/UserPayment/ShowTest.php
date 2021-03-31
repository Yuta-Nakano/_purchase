<?php

namespace Tests\Feature\UserPayment;

use App\Models\UserPayment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->payment = UserPayment::factory()->create();
    }

    public function test_お届け先を返却(): void
    {
        $response = $this->json('get', route('user-payment.show', [
            'user'    => $this->payment->user->name,
            'payment' => $this->payment->id,
        ]));

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'payment' => [
                    'paymentType',
                    'creditCardType',
                    'creditCardNumbar',
                    'creditExpirationDate',
                ],
            ]);
    }
}
