<?php

namespace Tests\Feature\File;

use App\Models\File;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DestroyTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->file = File::factory()->create();
    }

    public function test_ファイルを削除(): void
    {
        $response = $this->json('delete', route('file.destroy', [
            'file' => $this->file->id,
        ]));

        $response
            ->assertStatus(204)
            ->assertNoContent();
    }
}
