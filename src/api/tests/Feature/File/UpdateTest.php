<?php

namespace Tests\Feature\File;

use App\Models\File;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();

        $this->file = File::factory()->create();
    }

    public function test_ファイル名を更新して返却(): void
    {
        $body = [
            'name' => $this->faker->unique()->bothify('???###'),
        ];

        $response = $this->json('patch', route('file.update', [
                        'file' => $this->file->id,
                    ]), $body);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'file' => [
                    'slug',
                    'name',
                    'filename',
                    'url',
                ],
            ])
            ->assertJson([
                'file' => [
                    'name' => $body['name'],
                ],
            ]);
    }
}
