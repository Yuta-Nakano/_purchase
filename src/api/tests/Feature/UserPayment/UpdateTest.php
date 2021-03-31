<?php

namespace Tests\Feature\UserPayment;

use App\Models\UserPayment;
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

        $this->payment = UserPayment::factory()->create();
    }

    public function test_お届け先を更新して返却(): void
    {
        $paymentType = $this->faker->randomElement(['credit_card','bank_transfer']);
        $isCreditCard = $paymentType === 'credit_card';
        $body = [
            'user_id'                => $this->payment->user->id,
            'payment_type'           => $paymentType,
            'credit_card_type'       => $isCreditCard ?$this->faker->creditCardType :null,
            'credit_card_numbar'     => $isCreditCard ?$this->faker->creditCardNumber :null,
            'credit_expiration_date' => $isCreditCard ?$this->faker->creditCardExpirationDateString :null,
        ];

        $response = $this->json('patch', route('user-payment.update', [
                        'user' => $this->payment->user->name,
                        'payment' => $this->payment->id,
                    ]), $body);

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
