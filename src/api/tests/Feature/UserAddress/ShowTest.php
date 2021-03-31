<?php

namespace Tests\Feature\UserAddress;

use App\Models\UserAddress;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->address = UserAddress::factory()->create();
    }

    public function test_お届け先を返却(): void
    {
        $response = $this->json('get', route('user-address.show', [
            'user' => $this->address->user->name,
            'address' => $this->address->dist_name,
        ]));

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
