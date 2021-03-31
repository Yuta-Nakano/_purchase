<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function test_ユーザーを認証して返却(): void
    {
        $response = $this->json('post', route('login'), [
            'email'    => $this->user->email,
            'password' => 'password',
        ]);
        $response
            ->assertStatus(200)
            ->assertJson(['name' => $this->user->name]);

        $this
            ->assertAuthenticatedAs($this->user);
    }
}
