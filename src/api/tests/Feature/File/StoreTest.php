<?php

namespace Tests\Feature\File;

use App\Models\File;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();

        Storage::fake('s3');
    }

    public function test_ファイルをアップロードして返却(): void
    {
        $body = [
            'name' => $this->faker->unique()->bothify('???###'),
            'file' => UploadedFile::fake()->image('photo.jpg'),
        ];

        $response = $this->json('post', route('file.store'), $body);

        $response
            ->assertStatus(201)
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

        $file = File::first();
        $this
            ->assertMatchesRegularExpression(
                '/^[0-9a-zA-Z-_]{12}$/',
                $file->slug
            );
        Storage::cloud()
            ->assertExists($file->filename)
            ->delete($file->filename);
    }
}
