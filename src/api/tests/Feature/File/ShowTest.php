<?php

namespace Tests\Feature\File;

use App\Models\File;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->file = File::factory()->create();
    }

    public function test_ファイルを返却(): void
    {
        $response = $this->json('get', route('file.show', [
            'file' => $this->file->slug,
        ]));

        $response
            ->assertStatus(200)
            ->assertJson([
                'file' => [
                    'slug'     => $this->file->slug,
                    'name'     => $this->file->name,
                    'filename' => $this->file->filename,
                    'url'      => $this->file->url,
                ],
            ]);
    }
}
