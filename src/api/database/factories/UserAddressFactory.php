<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserAddressFactory extends Factory
{
    protected $model = UserAddress::class;

    public function definition(): array
    {
        if (User::get()->count()) {
            $user = $this->faker->randomElement([
                User::factory()->create(),
                User::all()->random(),
            ]);
        }
        else {
            $user = User::factory()->create([
                'email' => 'abs@example.org',
            ]);
        }

        return [
            'user_id'      => $user,
            'dist_name'    => $this->faker->lexify('お届け先????'),
            'last_name'    => $this->faker->lastName,
            'fast_name'    => $this->faker->firstName,
            'post_code'    => $this->faker->postcode,
            'prefecture'   => $this->faker->prefecture,
            'municipality' => $this->faker->city,
            'block_number' => $this->faker->optional()->streetAddress,
            'building'     => $this->faker->optional()->secondaryAddress,
            'phone_number' => $this->faker->phoneNumber,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (UserAddress $address) {
            $user = $address->user;
            if ($user->addresses->count()) {
                $user->billing_address_id = $user->addresses->random()->id;
                $user->save();
            }
        });
    }
}
