<?php

namespace Tests\Feature\TermTaxonomy;

use App\Models\Taxonomy;
use App\Models\TermRelationship;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        Taxonomy::factory(5)
            ->create();
    }

    public function test_用語一覧とページネーションを返却()
    {
        $taxonomyName = $this->faker->randomElement(['category', 'tag']);
        $response     = $this->json('get', route('term-taxonomy.' . $taxonomyName . '.index'));

        $response
            ->assertStatus(200);
            // TODO: 終わってない
            // ->assertJsonStructure([
            //     'products' => [
            //         '*' => [
            //             'id',
            //             'name',
            //             'slug',
            //             'content',
            //         ],
            //     ],
            //     'meta' => [
            //         'current_page',
            //         'last_page',
            //         'per_page',
            //         'from',
            //         'to',
            //         'total',
            //     ],
            // ]);
    }
}
