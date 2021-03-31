<?php

namespace Tests\Feature\TermTaxonomy;

use App\Models\Taxonomy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        $this->taxonomy = Taxonomy::factory()
            ->create();
        $this->term = $this->taxonomy->term;
    }

    public function test_用語を返却(): void
    {
        $response = $this->json('get', route('term-taxonomy.' . $this->taxonomy->name . '.show', [
            'term' => $this->term->slug,
        ]));

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'term' => [
                    'name',
                    'slug',
                    'taxonomy',
                ],
            ]);
    }
}
