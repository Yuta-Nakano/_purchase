<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserPayment;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserPaymentFactory extends Factory
{
    protected $model = UserPayment::class;

    public function definition(): array
    {
        $users = User::get();
        if ($users->count()) {
            $user = $this->faker->randomElement([
                User::factory()->create(),
                $users->random(),
            ]);
        }
        else {
            $user = User::factory()->create([
                'email' => 'abs@example.org',
            ]);
        }

        $paymentType = $this->faker->randomElement(['credit_card','bank_transfer']);
        $isCreditCard = $paymentType === 'credit_card';
        return [
            'user_id'                => $user,
            'payment_type'           => $paymentType,
            'credit_card_type'       => $isCreditCard ?$this->faker->creditCardType :null,
            'credit_card_numbar'     => $isCreditCard ?$this->faker->creditCardNumber :null,
            'credit_expiration_date' => $isCreditCard ?$this->faker->creditCardExpirationDateString :null,
        ];
    }
}
