<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function test_認証済みのユーザーをログアウト(): void
    {
        $response = $this
            ->actingAs($this->user)
            ->json('get', route('logout'));

        $response
            ->assertStatus(204);
    }
}
