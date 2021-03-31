<?php

namespace Tests\Feature\File;

use App\Models\File;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->count = 5;
        File::factory()
            ->count($this->count)
            ->create();
    }

    public function test_ファイル一覧とページネーションを返却(): void
    {
        $response = $this->json('get', route('file.index'));

        $response
            ->assertStatus(200)
            ->assertJsonCount($this->count, 'files')
            ->assertJsonStructure([
                'files' => [
                    '*' => [
                        'slug',
                        'name',
                        'filename',
                        'url',
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
