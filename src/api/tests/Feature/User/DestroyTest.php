<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DestroyTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function test_ユーザーを削除(): void
    {
        $response = $this->json('delete', route('user.destroy', [
            'user' => $this->user->name,
        ]));

        $response
            ->assertStatus(204)
            ->assertNoContent();
    }
}
