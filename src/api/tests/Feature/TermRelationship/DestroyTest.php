<?php

namespace Tests\Feature\TermRelationship;

use App\Models\TermRelationship;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DestroyTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();


        $this->termRel = TermRelationship::factory()->create();
    }

    public function test_用語分類関連付けを削除(): void
    {
        $response = $this->json('delete', route('product-taxonomy.destroy', [
            'termRel' => $this->termRel->id,
        ]));

        $response
            ->assertStatus(204)
            ->assertNoContent();
    }
}
