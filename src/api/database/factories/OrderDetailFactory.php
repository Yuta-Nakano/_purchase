<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ProductStandard;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderDetailFactory extends Factory
{
    protected $model = OrderDetail::class;

    public function definition(): array
    {
        $orders = Order::get();
        $standard = ProductStandard::factory()->create();

        if ($orders->count()) {
            $order = $this->faker->randomElement([
                Order::factory()->create(),
                $orders->random(),
            ]);
        }
        else {
            $order = Order::factory()->create();
        }

        return [
            'order_id'    => $order->id,
            'standard_id' => $standard->id,
            'quantity'    => $this->faker->numberBetween(1, 3),
            'unit_price'  => $standard->price,
            'tax'         => 0.1,
            'shipping'    => $this->faker->randomElement([600, 1200]),
        ];
    }
}
