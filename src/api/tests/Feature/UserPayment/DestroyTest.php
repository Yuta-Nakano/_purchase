<?php

namespace Tests\Feature\UserPayment;

use App\Models\UserPayment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DestroyTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->payment = UserPayment::factory()->create();
    }

    public function test_決済方法を削除(): void
    {
        $response = $this->json('delete', route('user-payment.destroy', [
            'user'    => $this->payment->user->name,
            'payment' => $this->payment->id,
        ]));

        $response
            ->assertStatus(204)
            ->assertNoContent();
    }
}
