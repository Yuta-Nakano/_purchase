<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function test_ユーザーを返却(): void
    {
        $response = $this->json('get', route('user.show', [
            'user' => $this->user->name,
        ]));

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'user' => [
                    'id',
                    'name',
                    'email',
                    'emailVerifiedAt',
                    'birthday',
                    'sex',
                ],
            ]);
    }
}
