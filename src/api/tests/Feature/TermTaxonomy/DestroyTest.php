<?php

namespace Tests\Feature\TermTaxonomy;

use App\Models\Taxonomy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DestroyTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->taxonomy = Taxonomy::factory()->create();
    }

    public function test_用語と用語分類を削除(): void
    {
        $response = $this->json('delete', route('term-taxonomy.' . $this->taxonomy->name . '.destroy', [
            'term' => $this->taxonomy->term->slug,
        ]));

        $response
            ->assertStatus(204)
            ->assertNoContent();
    }
}
