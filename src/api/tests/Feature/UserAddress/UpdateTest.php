<?php

namespace Tests\Feature\UserAddress;

use App\Models\UserAddress;
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

        $this->address = UserAddress::factory()->create();
    }

    public function test_お届け先を更新して返却(): void
    {
        $body = [
            'user_id'      => $this->address->user->id,
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

        $response = $this->json('patch', route('user-address.update', [
                        'user' => $this->address->user->name,
                        'address' => $this->address->dist_name,
                    ]), $body);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'address' => [
                    'id',
                    'distName',
                    'lastName',
                    'fastName',
                    'postCode',
                    'prefecture',
                    'municipality',
                    'blockNumber',
                    'building',
                    'phoneNumber',
                    'user',
                ],
            ]);
    }
}
