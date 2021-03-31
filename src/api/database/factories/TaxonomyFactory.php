<?php

namespace Database\Factories;

use App\Models\Term;
use App\Models\Taxonomy;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaxonomyFactory extends Factory
{
    protected $model = Taxonomy::class;

    public function definition(): array
    {
        $terms  = Term::all();
        $name   = $this->faker->randomElement(['category','tag']);
        $parent = null;

        if ($terms->count()) {
            $parent = $this->faker->optional()->randomElement($terms);
        }

        if ($parent->taxonomy ?? null) {
            $name = $parent->taxonomy->name;
        }

        return [
            'name'      => $name,
            'term_id'   => Term::factory()->create(),
            'parent_id' => $parent,
        ];
    }
}
