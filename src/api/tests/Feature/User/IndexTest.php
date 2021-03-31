<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->count = 3;
        User::factory($this->count)->create();
    }

    public function test_ユーザー一覧とページネーションを返却(): void
    {
        $response = $this->json('get', route('user.index'));

        $response
            ->assertStatus(200)
            ->assertJsonCount($this->count, 'users')
            ->assertJsonStructure([
                'users' => [
                    '*' => [
                        'id',
                        'name',
                        'email',
                        'emailVerifiedAt',
                        'birthday',
                        'sex',
                        'addresses',
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
