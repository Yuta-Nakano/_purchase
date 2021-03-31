<?php

namespace Tests\Feature\TermTaxonomy;

use App\Models\TermRelationship;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        TermRelationship::factory(20)
            ->create();
    }

    public function test_用語分類と用語を作成し返却()
    {
        $taxonomyName = $this->faker->randomElement(['category','tag']);
        $body         = [
            'term' => [
                'name' => $this->faker->word,
                'slug' => $this->faker->regexify('[a-zA-Z0-9_-]{3,12}'),
            ],
            'taxonomy'   => [
                'name'      => $taxonomyName,
                'parent_id' => null,
            ],
        ];

        $response = $this->json('post', route('term-taxonomy.' . $taxonomyName . '.store'), $body);

        $response
            ->assertStatus(201)
            ->assertJsonStructure([
                'term' => [
                    'name',
                    'slug',
                    'taxonomy',
                ],
            ]);
    }
}
