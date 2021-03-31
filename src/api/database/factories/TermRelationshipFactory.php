<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\TermRelationship;
use App\Models\Taxonomy;
use Illuminate\Database\Eloquent\Factories\Factory;

class TermRelationshipFactory extends Factory
{
    protected $model = TermRelationship::class;

    public function definition(): array
    {
        $relation = $this->faker->randomElement([
            Product::factory()->create()
        ]);
        $relationType = $this->faker->randomElement([
            'product',
        ]);
        return [
            'relation_type' => $relationType,
            'relation_id'   => $relation->id,
            'taxonomy_id'   => Taxonomy::factory()->create(),
        ];
    }
}
