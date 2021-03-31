<?php

namespace Tests\Feature\UserPayment;

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

    public function test_決済方法を作成して返却(): void
    {
        $paymentType = $this->faker->randomElement(['credit_card','bank_transfer']);
        $isCreditCard = $paymentType === 'credit_card';
        $body = [
            'user_id'                => $this->user->id,
            'payment_type'           => $paymentType,
            'credit_card_type'       => $isCreditCard ?$this->faker->creditCardType :null,
            'credit_card_numbar'     => $isCreditCard ?$this->faker->creditCardNumber :null,
            'credit_expiration_date' => $isCreditCard ?$this->faker->creditCardExpirationDateString :null,
        ];

        $response = $this->json('post', route('user-payment.store', [
            'user' => $this->user->name,
        ]), $body);

        $response
            ->assertStatus(201)
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
