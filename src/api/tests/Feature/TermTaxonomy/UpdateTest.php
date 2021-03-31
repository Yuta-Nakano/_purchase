<?php

namespace Tests\Feature\TermTaxonomy;

use App\Models\Term;
use App\Models\TermRelationship;
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
        TermRelationship::factory(20)
            ->create();
        $this->term = Term::get()->random();
        $this->taxonomy = $this->term->taxonomy;
    }

    public function test_用語分類と用語を更新し返却()
    {
        $body = [
            'term' => [
                'name' => $this->faker->word,
                'slug' => $this->faker->regexify('[a-zA-Z0-9_-]{3,12}'),
            ],
            'taxonomy'   => [
                'name'      => $this->taxonomy->name,
                'parent_id' => $this->taxonomy->parent_id ?? null,
            ],
        ];

        $response = $this
            ->json('patch', route('term-taxonomy.' . $this->taxonomy->name . '.update', [
                'term' => $this->term->slug,
            ]), $body);

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
