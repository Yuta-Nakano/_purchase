<?php

namespace Tests\Feature\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_ユーザーを作成して返却(): void
    {
        $body = [
            'name'     => $this->faker->unique()->regexify('[a-zA-Z0-9_-]{6,12}'),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',    // password
            'email'    => $this->faker->unique()->safeEmail,
            'birthday' => $this->faker->optional()->date('Y-m-d', 'now'),
            'sex'      => $this->faker->optional()->randomElement(['male', 'female']),
        ];

        $response = $this->json('post', route('user.store'), $body);

        $response
            ->assertStatus(201)
            ->assertJsonStructure([
                'user' => [
                    'name',
                    'email',
                    'emailVerifiedAt',
                    'birthday',
                    'sex',
                ],
            ])
            ->assertJson([
                'user' => [
                    'name'     => $body['name'],
                    'email'    => $body['email'],
                    'birthday' => $body['birthday'],
                    'sex'      => $body['sex'],
                ],
            ]);
    }
}
