<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name'    => $this->faker->lexify('商品????'),
            'slug'    => $this->faker->unique()->lexify('slug????'),
            'content' => $this->faker->optional()->realText,
        ];
    }
}
