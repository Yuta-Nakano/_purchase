<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        $addresses = UserAddress::get();
        if ($addresses->count()) {
            $address = $this->faker->randomElement([
                UserAddress::factory()->create(),
                $addresses->random(),
            ]);
        }
        else {
            $address = UserAddress::factory()->create();
        }

        return [
            'user_id' => $address->user->id,
        ];
    }
}
