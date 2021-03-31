<?php

namespace Tests\Feature\UserAddress;

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

    public function test_お届け先を作成して返却(): void
    {
        $body = [
            'user_id'      => $this->user->id,
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

        $response = $this->json('post', route('user-address.store', [
            'user' => $this->user->name,
        ]), $body);

        $response
            ->assertStatus(201)
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
