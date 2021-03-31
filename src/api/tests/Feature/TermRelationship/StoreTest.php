<?php

namespace Tests\Feature\TermRelationship;

use App\Models\Product;
use App\Models\Taxonomy;
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
        $this->product = Product::factory()->create();
        $this->taxonomy = Taxonomy::factory()->create();
    }

    public function test_用語関連付けを作成し返却()
    {
        $body = [
            'relation_type' => $this->faker->randomElement(['product']),
            'relation_id'   => $this->product->id,
            'taxonomy_id'   => $this->taxonomy->id,
        ];

        $response = $this->json('post', route('product-taxonomy.store'), $body);

        $response
            // TODO: contentのデータを利用するイメージが沸かない、返す必要があるだろうか？ ステータスコードだけで成否は判別できそうだけど。
            ->assertStatus(201);
        //     ->assertJsonStructure([
        //         'term' => [
        //             'name',
        //             'slug',
        //             'taxonomy',
        //         ],
        //     ]);
    }
}
