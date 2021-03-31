<?php

namespace Tests\Feature\UserAddress;

use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->count = 10;
        $this->user = User::factory()->create();
        $this->addresses = UserAddress::factory($this->count)->create([
            'user_id' => $this->user
        ]);
    }

    public function test_ユーザーのお届け先一覧とページネーションを返却(): void
    {
        $response = $this->json('get', route('user-address.index', [
            'user' => $this->user->name,
        ]));

        $response
            ->assertStatus(200)
            ->assertJsonCount($this->count, 'addresses')
            ->assertJsonStructure([
                'addresses' => [
                    '*' => [
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
                ],
                'meta' => [
                    'current_page',
                    'last_page',
                    'per_page',
                    'from',
                    'to',
                    'total',
                ],
            ]);
    }
}
