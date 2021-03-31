<?php

namespace Tests\Feature\UserAddress;

use App\Models\UserAddress;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DestroyTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->address = UserAddress::factory()->create();
    }

    public function test_お届け先を削除(): void
    {
        $response = $this->json('delete', route('user-address.destroy', [
            'user'    => $this->address->user->name,
            'address' => $this->address->dist_name,
        ]));

        $response
            ->assertStatus(204)
            ->assertNoContent();
    }
}
